<?php

session_start();
include 'konfigurazioa.php';
$connection = new mysqli($servername, $username, $password, $dbname);

	// Check connection
if ($connection->connect_error) {
	die("Konekxioak kale egin: " . $conn->connect_error);
}

$egindakoKop = sizeof($_SESSION['galderak']);
$galderak = $connection->query("SELECT * from questions");
$guztiraKop = $galderak->num_rows;

if($egindakoKop < $guztiraKop){
	if($egindakoKop > 0){
		$sesiokoAzkena = $_SESSION['galderak'][$egindakoKop - 1];
		$datuak = explode("&", $sesiokoAzkena);
		$azkenId = $datuak[0];
	}else{
		$azkenId = 0;
	}
	$gehi = 1;
	$aurkituta = 0;
	$galderaBerriaGordetzekoa = "";
	$itzultzekoa = "";
	while($aurkituta == 0){
		$bilatuId = $azkenId + $gehi;
		$galderaBek = $connection->query("SELECT * FROM questions WHERE ID=$bilatuId");
		if($galderaBek->num_rows > 0){
			$aurkituta = 1;
			$galdera = $galderaBek->fetch_object();
			$galderaBerriaGordetzekoa = "$galdera->ID&$galdera->Galdera&$galdera->ErantzunZuzena&$galdera->ErantzunOkerra1&$galdera->ErantzunOkerra2&$galdera->ErantzunOkerra3";
			$sorteatu = array($galdera->ErantzunZuzena,$galdera->ErantzunOkerra1,$galdera->ErantzunOkerra2,$galdera->ErantzunOkerra3);
			shuffle($sorteatu);
			$itzultzekoa = "$galdera->Galdera&" . $sorteatu[0] . "&" . $sorteatu[1] . "&" . $sorteatu[2] . "&" . $sorteatu[3] . "";
		}else{
			$gehi = $gehi + 1;
		}
	}
	$_SESSION['galderak'][$egindakoKop] = $galderaBerriaGordetzekoa;
	echo "$itzultzekoa";
}else{
	echo "&&&&";
}
?>