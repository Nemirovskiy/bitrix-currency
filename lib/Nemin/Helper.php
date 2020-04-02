<?php
namespace Nemin;

class Helper
{
	/**
	 * Метод получения окончания слова после числа
	 *
	 * Возвращает строку с вариантом окончания после числительных
	 *
	 * @param integer $integer  - Число
	 * @param array $arMessage  - Массив из трех вариантов окончаний
	 *
	 * $arMess = array("пирог", "пирога", "пирогов");
	 *
	 * @return string Строка с правильным окончанием
	 */
	static public function getNumberEnding($integer,$arMessage){
		if(count($arMessage) !== 3){
			return "";
		}
		$ending = 2;
		$number = $integer % 100;
		if($number < 5 || $number > 20){
			$index = $number % 10;
			if($index == 1){
				$ending = 0;
			}elseif(in_array($index, array(2,3,4))){
				$ending = 1;
			}
		}
		return $arMessage[$ending];
	}


	/**
	 *
	 * @param string $string
	 * @param string $tag
	 *
	 * @return string
	 */
	static public function getStringTag($string,$tag = "p"){
		$result = "";
		if($string && $tag){
			$result .= "<$tag>";
			$result .= htmlspecialcharsEx($string);
			$result .= "</$tag>";
		}
		echo $result;
	}
}