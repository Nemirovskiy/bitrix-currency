<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
?>
<p>
    <?if($arResult["VALUE"]):?>
        <?=$arResult["NOMINAL"]?> <?=$arResult["NAME"]?> = <?=$arResult["VALUE"]?>
	    <?= \Nemin\Helper::getNumberEnding(
		    $arResult["VALUE"],
		    array(
			    Loc::getMessage('NEMIN_CURRENCY_VALUE_1'),
			    Loc::getMessage('NEMIN_CURRENCY_VALUE_2'),
			    Loc::getMessage('NEMIN_CURRENCY_VALUE_3'),
		    )
	    )?>
    <?else:?>
        <?= Loc::getMessage("NEMIN_CURRENCY_ERROR_TITLE") ?>
    <?endif;?>
</p>