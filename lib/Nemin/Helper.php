<?php
namespace Nemin;

class Helper
{
	/**
	 * @param $integer
	 *
	 *  Возвращает вариант окончания после числительных
	 *
	 *  <li> 21 пирог
	 *  <li> 22 пирога
	 *  <li> 26 пирогов
	 *
	 * @return int
	 */
	static public function getNumberEnding($integer){
		$ending = 3;
		$number = $integer % 100;
		if($number < 5 || $number > 20){
			$index = $number % 10;
			if($index == 1){
				$ending = 1;
			}elseif(in_array($index, array(2,3,4))){
				$ending = 2;
			}
		}
		return $ending;
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