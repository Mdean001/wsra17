<?php
include 'konfigurazioa.php';
$connection = new mysqli($servername, $username, $password, $dbname);

	// Check connection
if ($connection->connect_error) {
	die("Konekxioak kale egin: " . $conn->connect_error);
}

$saiakerak = $connection->query("SELECT * FROM saiakerak ORDER BY ZuzenKop DESC");
echo "<h4> Top 10 quizers - Global ranking </h4>";
echo "<ol>";
$kop = 0;
while($saiakera = $saiakerak->fetch_object()){
	$kop = $kop + 1;
	echo "<li>";
	echo "". $saiakera->Nick . " ------------- " . $saiakera->ZuzenKop . "";
	echo "</li>";
	if($kop == 10){
		break;
	}
}
echo "</ol>";
?>