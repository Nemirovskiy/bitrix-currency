<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
$arComponentDescription = array(
	"NAME" => Loc::getMessage("NEMIN_CURRENCY_DESCRIPTION_NAME"),
	"DESCRIPTION" => Loc::getMessage("NEMIN_CURRENCY_DESCRIPTION_DESCR"),
	"CACHE_PATH" => "Y",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "service"
	),
);