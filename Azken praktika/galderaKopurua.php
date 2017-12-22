<?php
include 'konfigurazioa.php';
error_reporting(E_ALL ^ E_NOTICE);

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
		die("Konekxioak kale egin: " . $conn->connect_error);
}

$eposta = $_GET['eposta'];

$galderaGuztiak = $connection->query("SELECT * FROM questions");
$nireGalderaGuztiak = $connection->query("SELECT * FROM questions WHERE Eposta='$eposta'");

$nireKop = $nireGalderaGuztiak->num_rows;
$deneraKop = $galderaGuztiak->num_rows;

echo " $nireKop / $deneraKop ";

$galderaGuztiak->close();
$nireGalderaGuztiak->close();
$connection->close();
?>