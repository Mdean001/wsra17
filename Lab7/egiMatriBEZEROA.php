<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$eposta = $_GET['eposta'];

$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);

$erantzuna = $soapclient->call('egiaztatuE', array('x'=>$eposta));

echo "$erantzuna";

?>