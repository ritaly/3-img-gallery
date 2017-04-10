<?php
// tablica z obrazami
$img_array= array (
	'Image1' => './img/1.jpg' ,
	'Image2' => './img/2.jpg' ,
	'Image3' => './img/3.jpg' ,
	'Image4' => './img/4.jpg' ,
	'Image5' => './img/5.jpg' ,
	'Image6' => './img/6.jpg' ,
	'Image7' => './img/7.jpg' ,
	'Image8' => './img/8.jpg' ,
	'Image9' => './img/9.jpg' ,
	'Image10' => './img/10.jpg',
	'Image11' => './img/11.jpg',
	'Image12' => './img/12.jpg',
	'Image13' => './img/13.jpg',
	'Image14' => './img/14.jpg',
	'Image15' => './img/15.jpg',
);

function arrayToXml ($data, &$xml) {
	foreach ($data as $key => $value) {
		$key=preg_replace('/[0-9]+/', '', $key);
        $xml->addChild("$key",htmlspecialchars("$value"));
	}
}
// odczytywanie getem na której stronie
$actual_page=$_GET["page"];
$ipp=$_GET["itemsPerPage"];		//stale=3, no ale niech sobie odczyta,bo moze :P

// tworzenie xml pasujecego do index.php
$position = 0 + $actual_page * $ipp; 				//od ktorej pozycji
$temp = array(); 									//tymczasowa tablica
$temp=array_slice($img_array, $position, $ipp);		//wyciety kawalek


$xml = new SimpleXMLElement('<imageTag/>');			//opakowuje Image w element DOM wyzej
arrayToXml($temp,$xml); 

//echowanie go 
echo $xml->asXML();

?>