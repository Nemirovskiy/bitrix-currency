<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Web\HttpClient;
global $APPLICATION;
$client = new HttpClient();
$valXml = $client->get("https://www.cbr.ru/scripts/XML_daily.asp");
$valXml = $APPLICATION->ConvertCharset($valXml, "Windows-1251", SITE_CHARSET);
$xml = new \CDataXML;
$xml->LoadString($valXml);
if($xml){
	$node = $xml->SelectNodes('/ValCurs');
	$arName = array();
	if($node){
		$children = $node->children();
		foreach($children as $item){
			$id = $item->getAttribute('ID');
			$name = $item->elementsByName('Name')[0]->textContent();
			if($id && $name){
				$arName[$id] = $name;
			}
		}
	}
}
if(!$arName){
	$arName = array("R01235"=>"USD","R01239"=>"EUR");
}
$arComponentParameters = array(
	"PARAMETERS" => array(
		"TYPE"=> array(
			"NAME"=>Loc::getMessage("NEMIN_CURRENCY_PARAM_TYPE"),
			"TYPE" => "LIST",
			"PARENT" => "DATA_SOURCE",
			"DEFAULT"=>'-',
			"VALUES" => $arName,
		),
		"CACHE_TIME" => Array("DEFAULT"=>"3600"),
	)
);