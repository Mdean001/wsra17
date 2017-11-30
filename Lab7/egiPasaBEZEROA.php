<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$pasahitza = $_POST['pasahitza'];

$soapclient = new nusoap_client('https://hodei818.000webhostapp.com/Lab7/egiaztatuPasahitza.php?wsdl', true);

$erantzuna = $soapclient->call('egiaztatuP', array('p'=>$pasahitza));

echo "$erantzuna";

?>