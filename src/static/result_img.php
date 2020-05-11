<?php

include_once 'LImageHandler.php';

// Подключаем выбранный шрифт текста
$fontPath = dirname(__FILE__) . '/assets/fonts/montserrat-regular.ttf'; 
$fontPathBold = dirname(__FILE__) . '/assets/fonts/arial-black.ttf';  

 
// Указываем размер шрифта 
$fontSize = 45;
 
// Задаем цвет текста
$color = array(29, 9, 50);
$colorTwo = array(108, 67, 191);
 
// Задаем цвет подложки
$backgroundColor = array(0, 0, 0, 0);
 
// Создаем экземпляр класса LImageHandler
$ih = new LImageHandler;

function compact_values($array) {
  return array_values(array_filter($array ?? []));
}
$exploded_url = explode('/', $_SERVER["REQUEST_URI"]);
$compacted_url = compact_values($exploded_url);
$url = end($compacted_url);
$url = str_replace('.jpg', '', $url);

list($result, $img, $type) = explode('_', $url);
if ($result !== 'result' || $img !== 'img') {
  die();
}

	$result = explode ('=',  urldecode($type));
	
	//echo $result[1];
	$index = 1;

 switch ($result[0]) {
  case "1":	
		$index = 1;	
	break;
	case "2":
		$index = 2;
	break;
	case "3":
		$index = 3;
	break;
	case "4":
		$index = 4;
	break;
	case "5":
		$index = 5;
	break;
}

$vkHeight = 0;
$vkHeightTwo = 0;
$vkFontSize = 0;


if($result[3] == 1) {
	$textMas = explode ('@',  iconv("CP1251", "UTF-8", $result[1]));	
	// Путь к оригинальному изображению
	$imagePath = dirname(__FILE__) . '/assets/img/share/share-vk-'.$index.'.jpg';	
	$vkHeight = 105;
	$vkHeightFirst = 85;
	$vkHeightTwo = 134;
	$vkFontSize = 8;
} else {
	$textMas = explode ('@',  $result[1]);
	// Путь к оригинальному изображению
	$imagePath = dirname(__FILE__) . '/assets/img/share/share-'.$index.'.jpg';
}

// Загружаем изображение
$imgObj = $ih->load($imagePath);

	// ----------------------------------

	
	if(count($textMas) > 1) {
		$imgObj->textWithBackground($textMas[0], $fontPathBold, 40 - $vkFontSize, $color, $backgroundColor, LImageHandler::CORNER_LEFT_TOP, 130, 311 - $vkHeightFirst, 0, 0, 10);
		$imgObj->textWithBackground($textMas[1], $fontPathBold, 40 - $vkFontSize, $color, $backgroundColor, LImageHandler::CORNER_LEFT_TOP, 130, 371- $vkHeight, 0, 0, 10);
	  } else {		  
		  if(iconv_strlen($textMas[0]) > 10) {
			$imgObj->textWithBackground(substr($textMas[0], 0, 16), $fontPathBold, 40 - $vkFontSize, $color, $backgroundColor, LImageHandler::CORNER_LEFT_TOP, 130, 311- $vkHeightFirst, 0, 0, 10);
			$imgObj->textWithBackground(substr($textMas[0], 16 - iconv_strlen($textMas[0])), $fontPathBold, 40 - $vkFontSize, $color, $backgroundColor, LImageHandler::CORNER_LEFT_TOP, 130, 371- $vkHeight, 0, 0, 10);
		  } else {
			$imgObj->textWithBackground($textMas[0], $fontPathBold, 40 - $vkFontSize, $color, $backgroundColor, LImageHandler::CORNER_LEFT_TOP, 130, 336- $vkHeight, 0, 0, 10);
		  }	
	  }
	  
	  
	  $imgObj->textWithBackground($result[2], $fontPathBold, 40 - $vkFontSize, $colorTwo, $backgroundColor, LImageHandler::CORNER_LEFT_TOP, 130, 480- $vkHeightTwo, 0, 0, 10);



$imgObj->show(false, 100);
