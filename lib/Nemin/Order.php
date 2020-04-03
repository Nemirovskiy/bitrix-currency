<?php


namespace Nemin;


use \Bitrix\Main\Event;
use \Bitrix\Sale\Compatible\EventCompatibility;

class Order
{

	static public function sendEmail($event, &$lid, &$arFields, &$message_id, &$files, &$languageId){
		\Bitrix\Main\Loader::includeModule('sale');
		$eventName = EventCompatibility::EVENT_COMPATIBILITY_ORDER_NEW_SEND_EMAIL_EVENT_NAME;
		if($event === $eventName && $arFields["ORDER_ID"]> 0){
			$storeID = self::getStoreID($arFields["ORDER_ID"]);
			if($storeID > 0){
				$arStore = self::getStore($storeID);
				$address = "<p><b>";
				$address .= $arStore["TITLE"] ."</b> ";
				$address .= ($arStore["ADDRESS_LINK"])?$arStore["ADDRESS_LINK"]:$arStore["ADDRESS"];
				$address .= "<br>" .$arStore["PHONE"];
				$address .= "<br>" .$arStore["SCHEDULE"];
				$address .= "</p>";
				$arFields["ADDRESS"] = $address;
			}

		}
	}

	private static function getStore($id){
		\Bitrix\Main\Loader::includeModule('catalog');
		$arList = array(
			"select"=>array(
				"TITLE",
				"ADDRESS",
				"DESCRIPTION",
				"GPS_N",
				"GPS_S",
				"PHONE",
				"SCHEDULE",
			),
			"filter"=>array("ID"=>$id),
			"cache" => array("TTL"=>36000)
		);
		$rsStore = \Bitrix\Catalog\StoreTable::getList($arList);
		if($arStore = $rsStore->fetch()){
			if($arStore["GPS_N"] && $arStore["GPS_S"]){
				$s = $arStore["GPS_S"];
				$n = $arStore["GPS_N"];
				$link = "<a target='_blank' href=\"https://yandex.ru/maps/?pt=$s,$n&z=18&l=map\">";
				$link .= $arStore["ADDRESS"];
				$link .= "</a>";
				$arStore["ADDRESS_LINK"] = $link;
			}
		}else{
			$arStore = array();
		}
		return $arStore;
	}

	private static function getStoreID($orderID){
		\Bitrix\Main\Loader::includeModule('sale');
		$order = \Bitrix\Sale\Order::load($orderID);
		$id = 0;
		$collection = $order->getShipmentCollection();
		foreach($collection as $shipment){
			if($id = $shipment->getStoreId()){
				break;
			}
		}
		return $id;
	}
}