<?php
require_once('/lib/nusoap.php');
require_once('/lib/class.wsdlcache.php');

$pasahitza = $_POST['pasahitza'];

$soapclient = new nusoap_client('http://localhost:1234/wsproiektua17/Lab7/egiaztatuPasahitza.php?wsdl', true);

$erantzuna = $soapclient->call('egiaztatuP', array('p'=>$pasahitza));

echo "$erantzuna";

?>