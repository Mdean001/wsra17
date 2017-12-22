<?php
include 'konfigurazioa.php';

error_reporting(E_ALL ^ E_NOTICE);

if(isset($_POST['ID'])){
	// Create connection
	$connection = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($connection->connect_error) {
		die("Konekxioak kale egin: " . $conn->connect_error);
	}
	echo "<br/>";
	
	$ID = $_POST['ID'];

	$trimID = trim($ID);

	$patternEzHutsa = '/^.+$/' ;

	if( preg_match($patternEzHutsa,$trimID) == 1 ){
			
			$patternZenbakia = '/^([1-9][0-9]*)$/' ;
			if(preg_match($patternZenbakia, $trimID)==1){
				
				$sqlBadago = "SELECT * FROM questions WHERE ID = '$trimID'";
				$result = $connection->query($sqlBadago);
				if(!($result)){
					echo "Errorea: Arazoren bat egon da galdera ezabatzean.";
				}else{
					$rows = $result->num_rows;
					if($rows == 1){
						$sqlEzabatu = "DELETE FROM questions WHERE ID = '$trimID'";
						
						$egokiEzabatuta = $connection->query($sqlEzabatu);
						
						if ($egokiEzabatuta === TRUE) {
							echo "OK: Datu-basean galdera zuzen ezabatu da. <br/>";
						} else {
							//echo "Error: " . $sql . "<br>" . $connection->error;
							echo "Errorea: Galdera datu-basean ezabatzea ez da posible izan. <br/>";
						}
					}else{
						echo "Galdera hori datu-basean ez da existitzen. <br/>";
					}
				}
			}else{
				echo "Errorea: Galdera ezabatzeko identifikadore okerra. Osoko zenbaki bat, 1 baino handiagoa. <br/>";
			}
	}else{
		echo "Errorea: Galdera ezabatzeko identifikadorea ezin da hutsa izan. Osoko zenbaki bat, 1 baino handiagoa. <br/>";
	}
	
	$connection->close();
}
?>