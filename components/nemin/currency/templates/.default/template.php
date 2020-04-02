<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
?>
<p>
    <?if($arResult["VALUE"]):?>
        <?=$arResult["NOMINAL"]?> <?=$arResult["NAME"]?> = <?=$arResult["VALUE"]?> &#8381;
    <?else:?>
        <?= Loc::getMessage("NEMIN_CURRENCY_ERROR_TITLE") ?>
    <?endif;?>
</p>
<p>
    <?=$arResult["VALUE"]?>
    <?=Loc::getMessage('NEMIN_CURRENCY_VALUE_'.\Nemin\Helper::getNumberEnding(intval($arResult["VALUE"])))?>
</p>