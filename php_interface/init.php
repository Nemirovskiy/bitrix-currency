<?
$arClass = array(
	"\\Nemin\\Helper" => '/local/lib/Nemin/Helper.php',
	"\\Nemin\\Order" => '/local/lib/Nemin/Order.php',
);
Bitrix\Main\Loader::registerAutoLoadClasses(null, $arClass);
$root = Bitrix\Main\Context::getCurrent()->getServer()->getDocumentRoot();
require $root."/local/php_interface/include/events.php";