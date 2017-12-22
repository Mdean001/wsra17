<?php

session_start();
include 'konfigurazioa.php';
$connection = new mysqli($servername, $username, $password, $dbname);

	// Check connection
if ($connection->connect_error) {
	die("Konekxioak kale egin: " . $conn->connect_error);
}

$nick = trim($_POST['nick']);
$pattern = '/^([^\s]{1,})$/';
if( preg_match($pattern, $nick) == 1 ){
	$erabiltzaileak = $connection->query("SELECT * FROM users WHERE Nick='$nick'");
	$saiakeraNickak = $connection->query("SELECT * FROM saiakerak WHERE Nick='$nick'");
	if($erabiltzaileak->num_rows > 0 || $saiakeraNickak->num_rows > 0){
		echo "BALIOGABEA";
	}else{
		$zuzenKop = 0;
		$gaizkiKop = 0;
		foreach($_SESSION['emaitzak'] as $emaitza){
			if($emaitza == "ZUZENA"){
				$zuzenKop = $zuzenKop + 1;
			}else{
				$gaizkiKop = $gaizkiKop + 1;
			}
		}
		$result = $connection->query("INSERT INTO saiakerak(Nick, ZuzenKop, OkerKop) VALUES ('$nick', '$zuzenKop', '$gaizkiKop')");
		if($result === TRUE){
			echo "BALIOZKOA";
		}else{
			echo "Error: " . $result . "<br>" . $connection->error;
			echo "ERROREA";
		}
	}
}else{
	echo "BALIOGABEA2";
}
?>