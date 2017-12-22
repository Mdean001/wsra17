<?php

session_start();

$erantzunTestua = $_POST["erantzunTestua"];

$azkenPos = sizeof($_SESSION['galderak']);

$sesiokoAzkenErantzuna = $_SESSION['galderak'][$azkenPos - 1];

$datuak = explode("&", $sesiokoAzkenErantzuna);

if($datuak[2] == $erantzunTestua){
	$_SESSION['emaitzak'][$azkenPos - 1] = "ZUZENA";
	echo "Galdera zuzen erantzun duzu.";
}else{
	$_SESSION['emaitzak'][$azkenPos - 1] = "OKERRA";
	echo "Galdera ez duzu zuzen erantzun.";
}
?>