<?php include 'segurtasunaAnonimoa.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Log In</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
	<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#logIn").submit(function(){
				if($("#eposta").val().length > 0 && $("#pasahitza").val().length > 0 ){
					return true	
				}else{
					alert("Eremuren bat ez duzu bete!!!!")
					return false
				}
			})
		})
	</script>
  </head>
  <body>
	<br/>
	<header class='main' id='h1'>
		<h2 style="color:black">Log In</h2>
	</header>
	<br/>

	<form id="logIn" name="logIn" action="logIn.php" method="POST">
		<br/>
		Eposta &#40;&#42;&#41;: <input type="text" id="eposta" name="eposta" size="35"/>
		<br/>
		<br/>
		Pasahitza &#40;&#42;&#41;: <input type="password" id="pasahitza" name="pasahitza" size="50"/>
		<br/>
		<br/>
		<input type="submit" id="sartu" name="sartu" value="Sartu"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri"/>
  </form>
  <br/>
  <a href="pasahitzaBerreskuratu.php"> Pasahitza ahaztu zaizu? </a>
  <br/>
  <br/>
  <a href="layout.php"> Atzera </a>
</body>
</html>
<?php
include 'konfigurazioa.php';
				 
error_reporting(E_ALL ^ E_NOTICE);

if(isset($_POST['eposta'])){
	// Create connection
	$connection = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($connection->connect_error) {
		die("Konekxioak kale egin: " . $conn->connect_error);
	}
	//echo "<br/>";
	
	$eposta = $_POST['eposta'];
	
	$pasahitza = $_POST['pasahitza'];
	
	$trimEposta = trim($eposta);
	$trimPasahitza = trim($pasahitza);
	
	$patternEzHutsa = '/^.+$/' ;
	if(preg_match($patternEzHutsa,$trimEposta) == 1 && preg_match($patternEzHutsa,$trimPasahitza) == 1){
		
		$patPostaIkasle = '/^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.(eus|es)$/';
		$patPostaIrakasle = '/^([a-z]{2,})([0-9]{3})@ehu\.(eus|es)$/';
		
		if(preg_match($patPostaIkasle,$trimEposta) == 1 || preg_match($patPostaIrakasle,$trimEposta) == 1){
			
			$pasahitzaKodetuta = crypt($trimPasahitza, "wsPasahitzaKodetuta");
		
			$sql = "SELECT * FROM users WHERE Eposta='$trimEposta' and Pasahitza='$pasahitzaKodetuta'";
			
			$result = $connection->query($sql);
			
			if(!($result)){
				echo $result->error;
				echo "<script> alert('Arazoren bat egon da log in egitean.') </script>";
				//header('location: logIn.php');
			}else{
				$rows = $result->num_rows;
				if($rows == 1){
					$rows = 0;
					//header('location: layoutR.html');
					$xml = simplexml_load_file('counter.xml');
					$xml->children()->itemBody->p = $xml->children()->itemBody->p + 1;
					$xml->asXML('counter.xml');
					
					if(preg_match($patPostaIkasle, $trimEposta) == 1){
						//session_start();
						$_SESSION['rola'] = "IKASLEA";
						$_SESSION['eposta'] = $trimEposta;
						echo '<script language="javascript" type="text/javascript"> alert("Ongi etorri ikasle!!!"); location.href="layout.php"</script>';
					}else{
						//session_start();
						$_SESSION['rola'] = "IRAKASLEA";
						echo '<script language="javascript" type="text/javascript"> alert("Ongi etorri!!!"); location.href="layout.php"</script>';
					}
					
					
				}else{
					echo "<script> alert('Eposta edo pasahitza ez da zuzena.') </script>";
				}
			}
		}else{
			echo "<script> alert('Errorea: Eposta ez dator patroiarekin bat.') </script>";
		}
	}else{
		echo "<script> alert('Errorea: Derrigorrezko eremuran bat hutsik dago.') </script>";
	}
}
?>