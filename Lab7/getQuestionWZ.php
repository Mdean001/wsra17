<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

$ns="https://hodei818.000webhostapp.com/Lab7/getQuestionWZ.php?wsdl";
$server = new soap_server;
$server->configureWSDL('getQuestion',$ns);
$server->wsdl->schemaTargetNamespace = $ns;

$server->register('getQuestion',array('x'=>'xsd:int'),array('e'=>'xsd:string'),$ns);

function getQuestion($x){
	include 'konfigurazioa.php';
	$connection = new mysqli($servername, $username, $password, $dbname);
	if ($connection->connect_error) {
		die("Konekxioak kale egin: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM questions WHERE ID=$x";
	$galderak = $connection->query($sql);
	
	if ($galderak->num_rows > 0) {
		$galdera = $galderak->fetch_object();
		$erantzuna = "$galdera->ID&$galdera->Galdera&$galdera->ErantzunZuzena&$galdera->ErantzunOkerra1&$galdera->ErantzunOkerra2&$galdera->ErantzunOkerra3&$galdera->Zailtasuna&$galdera->GaiArloa";
		return $erantzuna;
	}else{
		$erantzuna = "&&&&&&&";
		return $erantzuna;
	}
}

if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>