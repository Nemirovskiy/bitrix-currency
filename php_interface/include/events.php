<?
$manager = Bitrix\Main\EventManager::getInstance();
$manager->addEventHandler(
	"main",
	"OnBeforeEventAdd",
	array("\\Nemin\\Order","sendEmail")
);