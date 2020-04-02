<?php
namespace Nemin;

use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\XmlWriter;

class Currency extends \CBitrixComponent
{
	private $URL_DAILY = "https://www.cbr.ru/scripts/XML_daily.asp";

	public function executeComponent()
	{
		if($this->startResultCache($this->arParams["CACHE_TIME"],md5(serialize($this->arParams)))){
			$value = false;
			$this->setResultCacheKeys(["VALUE"]);
			$client = new HttpClient();
			$valXml = $client->get($this->URL_DAILY);
			global $APPLICATION;
			$valXml = $APPLICATION->ConvertCharset($valXml, "Windows-1251", SITE_CHARSET);
			$xml = new \CDataXML();
			$xml->LoadString($valXml);
			if($xml){
				$node = $xml->SelectNodes("/ValCurs");
				if($node){
					$arChildren = $node->children();
					foreach($arChildren as $item){
						if($item->getAttribute('ID') === $this->arParams["TYPE"]){
							$value = $item->elementsByName('Value')[0]->textContent();
							$nominal = $item->elementsByName('Nominal')[0]->textContent();
							$name = $item->elementsByName('Name')[0]->textContent();
							break;
						}
					}
				}
			}
			if(!$value){
				$this->abortResultCache();
			}
			$this->arResult["VALUE"] = $value;
			$this->arResult["NOMINAL"] = $nominal;
			$this->arResult["NAME"] = $name;
			$this->endResultCache();
		}
		$this->includeComponentTemplate();
	}
}