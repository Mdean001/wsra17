<?php
include 'konfigurazioa.php';

error_reporting(E_ALL ^ E_NOTICE);

if(isset($_POST['galdera'])){
	// Create connection
	$connection = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($connection->connect_error) {
		die("Konekxioak kale egin: " . $conn->connect_error);
	}
	echo "<br/>";
	
	$ID = $_POST['ID'];

	$galdera = $_POST['galdera'];

	$eranZuzen = $_POST['eranZuzen'];

	$eranOker1 = $_POST['eranOker1'];

	$eranOker2 = $_POST['eranOker2'];

	$eranOker3 = $_POST['eranOker3'];

	$zailtasun = $_POST['zailtasun'];

	$gaia = $_POST['gaia'];

	$trimID = trim($ID);

	$trimGaldera = trim($galdera);

	$trimEranZuzen = trim($eranZuzen);

	$trimEranOker1= trim($eranOker1);

	$trimEranOker2 = trim($eranOker2);

	$trimEranOker3 = trim($eranOker3);

	$trimZailtasun = trim($zailtasun);

	$trimGaia = trim($gaia);

	$patternEzHutsa = '/^.+$/' ;

	if( preg_match($patternEzHutsa,$trimID) == 1 && preg_match($patternEzHutsa, $trimGaldera) == 1 
		&& preg_match($patternEzHutsa, $trimEranZuzen) == 1 && preg_match($patternEzHutsa, $trimEranOker1) == 1 && preg_match($patternEzHutsa, $trimEranOker2) == 1 
		&&  preg_match($patternEzHutsa, $trimEranOker3) == 1 && preg_match($patternEzHutsa, $trimZailtasun) == 1 && preg_match($patternEzHutsa, $trimGaia) == 1 ){
			
			$patternZailtasuna = '/^([1-5])$/' ;
			if(preg_match($patternZailtasuna, $trimZailtasun)==1){
				$patternGaldera = '/^.{10,}$/';
				if(preg_match($patternGaldera, $trimGaldera)==1){

					$sql = "UPDATE questions SET Galdera='$trimGaldera', ErantzunZuzena='$trimEranZuzen', ErantzunOkerra1='$trimEranOker1', ErantzunOkerra2='$trimEranOker2', ErantzunOkerra3='$trimEranOker3', Zailtasuna='$trimZailtasun', GaiArloa='$trimGaia' WHERE ID = '$trimID'";
					
					$egokiSartuta = $connection->query($sql);
					
					if ($egokiSartuta === TRUE) {
						echo "OK: Datu-basean galdera zuzen eguneratu da <br/>";
					} else {
						//echo "Error: " . $sql . "<br>" . $connection->error;
						echo "Errorea: Galdera datu-basean eguneratzea ez da posible izan <br/>";
					}
				}else{
					echo "Errorea: Galderaren luzerak gutxienez 10koa izan behar du.<br/>";
				}
			}else{
				echo "Errorea: Zailtasunaren balioa, zenbaki osokoa eta, 1 eta 5 artekoa, biak barne!!! <br/>";
			}
	}else{
		echo "Errorea: Derrigorrezko eremuran bat hutsik dago. <br/>";
	}
	
	$connection->close();
}
?>