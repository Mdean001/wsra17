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
	//echo "Zuzen konektatuta";
	echo "<br/>";

	$eposta = $_GET['eposta'];

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
					
					$iru = $_FILES['gehituIrudia']['tmp_name'];
					$irudia = addslashes(file_get_contents($iru));

					$sql = "INSERT INTO questions(Eposta, Galdera, ErantzunZuzena, ErantzunOkerra1, ErantzunOkerra2, ErantzunOkerra3, Zailtasuna, GaiArloa, Irudia) VALUES ('$eposta','$galdera','$eranZuzen','$eranOker1','$eranOker2','$eranOker3','$zailtasun','$gaia', '$irudia')";

					if ($connection->query($sql) === TRUE) {
						echo "Datu-basean galdera zuzen txertatu da <br/>";
						echo "<a href=showQuestionsWithImage.php?eposta=$eposta> Ikusi datu-baseko galderak irudiarekin</a><br/>";
						echo "<a href=showQuestions.php?eposta=$eposta>Ikusi datu-baseko galderak </a> <br/>";
						echo "<a href=addQuestionFormularioa.php?eposta=$eposta> Beste galdera bat txertatu </a><br/>";
					} else {
						echo "Error: " . $sql . "<br>" . $connection->error;
						echo "Errorea: Galdera datu-basean txertatzea ez da posible izan <br/>";
						echo "<a href=addQuestionFormularioa.php?eposta=$eposta> Beste galdera bat txertatu </a><br/>";
					}
				}else{
					echo "Errorea: Zailtasunaren balioa, zenbaki osokoa eta, 1 eta 5 artekoa, biak barne!!! <br/>";
					echo "<a href = addQuestionFormularioa.php?eposta=$eposta>Saiatu berriro galdera txertatzen </a> <br/>";
				}
				
			}else{
				echo "Errorea: Sartu duzun eposta ez da egokia!!! <br/>";
				echo "<a href = addQuestionFormularioa.php?eposta=$eposta>Saiatu berriro galdera txertatzen </a> <br/>";
			}
	}else{
		echo "Errorea: Derrigorrezko eremuran bat hutsik dago. <br/>";
		echo "<a href = addQuestionFormularioa.php?eposta=$eposta>Saiatu berriro galdera txertatzen </a> <br/>";
	}



	$connection->close();
}
?> 