<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

if(isset($_GET['identifikazioa'])){

	$identifikazioa = $_GET['identifikazioa'];

	$soapclient = new nusoap_client('https://hodei818.000webhostapp.com/Lab6/getQuestionWZ.php?wsdl', true);

	$erantzuna = $soapclient->call('getQuestion', array('x'=>$identifikazioa));

	echo $erantzuna;
}

?>