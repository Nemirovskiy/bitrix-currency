<?
$manager = Bitrix\Main\EventManager::getInstance();
$manager->addEventHandler(
	"sale",
	"OnSaleOrderSaved",
	array("\\Nemin\\Order","orderSaved")
);
$manager->addEventHandler(
	"main",
	"OnBeforeEventAdd",
	array("\\Nemin\\Order","sendEmail")
);