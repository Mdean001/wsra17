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

	$eposta = $_POST['eposta'];

	$galdera = $_POST['galdera'];

	$eranZuzen = $_POST['eranZuzen'];

	$eranOker1 = $_POST['eranOker1'];

	$eranOker2 = $_POST['eranOker2'];

	$eranOker3 = $_POST['eranOker3'];

	$zailtasun = $_POST['zailtasun'];

	$gaia = $_POST['gaia'];

	$i=$_POST['gehituIrudia'];

	$trimEposta = trim($eposta);

	$trimGaldera = trim($galdera);

	$trimEranZuzen = trim($eranZuzen);

	$trimEranOker1= trim($eranOker1);

	$trimEranOker2 = trim($eranOker2);

	$trimEranOker3 = trim($eranOker3);

	$trimZailtasun = trim($zailtasun);

	$trimGaia = trim($gaia);

	$patternEzHutsa = '/^.+$/' ;

	if(preg_match($patternEzHutsa, $trimEposta) == 1 && preg_match($patternEzHutsa, $trimGaldera) == 1 && preg_match($patternEzHutsa, $trimEranZuzen) == 1 
		&& preg_match($patternEzHutsa, $trimEranOker1) == 1 && preg_match($patternEzHutsa, $trimEranOker2) == 1 &&  preg_match($patternEzHutsa, $trimEranOker3) == 1
		&& preg_match($patternEzHutsa, $trimZailtasun) == 1 && preg_match($patternEzHutsa, $trimGaia) == 1 ){
			
			$patternEposta = '/^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.(eus|es)$/';
			if(preg_match($patternEposta, $trimEposta)==1){
				$patternZailtasuna = '/^([1-5])$/' ;
				if(preg_match($patternZailtasuna, $trimZailtasun)==1){
					$patternGaldera = '/^.{10,}$/';
					if(preg_match($patternGaldera, $trimGaldera)==1){
					
						$iru = $_FILES['gehituIrudia']['tmp_name'];
						$irudia = addslashes(file_get_contents($iru));

						$sql = "INSERT INTO questions(Eposta, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, Zailtasuna, GaiArloa, Irudia) VALUES ('$trimEposta','$trimGaldera','$trimEranZuzen','$trimEranOker1','$trimEranOker2','$trimEranOker3','$trimZailtasun','$trimGaia', '$irudia')";
						
						$egokiSartuta = $connection->query($sql);
						
						if ($egokiSartuta === TRUE) {
							$xml = simplexml_load_file('questions.xml');
			
							$galderaXML = $xml->addChild('assessmentItem');
							$galderaXML->addAttribute('complexity',$trimZailtasun);
							$galderaXML->addAttribute('subject',$trimGaia);
							
							$galderarenTestuaXML = $galderaXML->addChild('itemBody');
							$galderarenTestuaXML->addChild('p',$trimGaldera);
							
							$erantzunZuzenaXML = $galderaXML->addChild('correctResponse');
							$erantzunZuzenaXML->addChild('value',$trimEranZuzen);
							
							$erantzunOkerrakXML = $galderaXML->addChild('incorrectResponses');
							$erantzunOkerrakXML->addChild('value',$trimEranOker1);
							$erantzunOkerrakXML->addChild('value',$trimEranOker2);
							$erantzunOkerrakXML->addChild('value',$trimEranOker3);
							
							$xml->asXML('questions.xml');
						}	
						
						if ($egokiSartuta === TRUE) {
							echo "OK: Datu-basean eta XML orrian galdera zuzen txertatu da <br/>";
						} else {
							//echo "Error: " . $sql . "<br>" . $connection->error;
							echo "Errorea: Galdera datu-basean txertatzea ez da posible izan <br/>";
						}
					}else{
						echo "Errorea: Galderaren luzerak gutxienez 10koa izan behar du.<br/>";
					}
				}else{
					echo "Errorea: Zailtasunaren balioa, zenbaki osokoa eta, 1 eta 5 artekoa, biak barne!!! <br/>";
				}
				
			}else{
				echo "Errorea: Sartu duzun eposta ez da egokia!!! <br/>";
			}
	}else{
		echo "Errorea: Derrigorrezko eremuran bat hutsik dago. <br/>";
	}
	
	$connection->close();
}
?> 