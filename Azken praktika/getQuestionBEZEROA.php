<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

if(isset($_GET['identifikazioa'])){

	$identifikazioa = $_GET['identifikazioa'];

	$soapclient = new nusoap_client('http://localhost:1234/wsproiektua17/Lab7/getQuestionWZ.php?wsdl', true);

	$erantzuna = $soapclient->call('getQuestion', array('x'=>$identifikazioa));

	echo $erantzuna;
}

?>