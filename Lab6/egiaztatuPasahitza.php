<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$ns="https://hodei818.000webhostapp.com/Lab6/egiaztatuPasahitza.php?wsdl";
$server = new soap_server;
$server->configureWSDL('egiaztatuP',$ns);
$server->wsdl->schemaTargetNamespace = $ns;

$server->register('egiaztatuP',array('p'=>'xsd:string'),array('e'=>'xsd:string'),$ns);

function egiaztatuP($p){
	$badago = 0;
	$texto = file("toppasswords.txt");
	foreach($texto as $palabra){
		if(strstr($palabra,$p)){
			$badago = 1;
			break;
		}
	}
	if($badago == 0){
		return "BALIOZKOA";
	}else{
		return "BALIOGABEA";
	}
}

if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>