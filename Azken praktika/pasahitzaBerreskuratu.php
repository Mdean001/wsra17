<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Pasahitza Berreskuratu</title>
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
			$("#pasahitzaBerreskuratu").submit(function(){
				if($("#eposta").val().length > 0 && $("#nick").val().length > 0){
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
		<h2 style="color:black">Pasahitza Berreskuratu</h2>
	</header>
	<br/>

	<form id="pasahitzaBerreskuratu" name="pasahitzaBerreskuratu" action="pasahitzaBerreskuratu.php" method="POST">
		<br/>
		Eposta &#40;&#42;&#41;: <input type="text" id="eposta" name="eposta" size="35"/>
		<br/>
		<br/>
		Nick-a &#40;&#42;&#41;: <input type="text" id="nick" name="nick" size="35"/>
		<br/>
		<br/>
		<input type="submit" id="berreskuratu" name="berreskuratu" value="Berreskuratu"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri"/>
  </form>
  <br/>
</body>
</html>
<?php
include 'konfigurazioa.php';
				 
error_reporting(E_ALL ^ E_NOTICE);

if(isset($_POST['eposta'])){
	
	$eposta = $_POST['eposta'];
	
	$nick = $_POST['nick'];
	
	$trimEposta = trim($eposta);
	
	$trimNick = trim($nick);
	
	$patternEzHutsa = '/^.+$/' ;
	if(preg_match($patternEzHutsa, $trimEposta) == 1 && preg_match($patternEzHutsa, $trimNick) == 1){
	
		$patternEpostaIkaslea = '/^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.(eus|es)$/';
		$patternEpostaIrakaslea = '/^([a-z]{2,})([0-9]{3})@ehu\.(eus|es)$/';
		if(preg_match($patternEpostaIkaslea,$trimEposta)==1 || preg_match($patternEpostaIrakaslea,$trimEposta)==1){
			
			$patternNick = '/^([^\s]{1,})$/';
			if(preg_match($patternNick, $trimNick) == 1){
				
				$connection = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($connection->connect_error) {
					die("Konekxioak kale egin: " . $conn->connect_error);
				}
				echo "<br/>";
				
				$sql = "SELECT * FROM users WHERE Eposta='$trimEposta'";
				
				$result = $connection->query($sql);
				
				if(!($result)){
					echo $result->error;
					echo "<script> alert('Arazoren bat egon da pasahitza berreskuratzean.') </script>";
					//header('location: logIn.php');
				}else{
					$rows = $result->num_rows;
					if($rows == 1){
						$galdera = $result->fetch_object();
						if($galdera->Nick == $trimNick){
							$_SESSION['epostaBerreskuratu'] = $trimEposta;
							echo '<script language="javascript" type="text/javascript"> location.href="pasahitzaAldatu.php"</script>';
						}else{
							echo "<script> alert('Epòsta eta nick-a ez datoz bat.') </script>";
						}
						
					}else{
						echo "<script> alert('Eposta hori ez dago erregistratuta.') </script>";
					}
				}
			}else{
				echo "<script> alert('Nick-a ez da zuzena.') </script>";
			}
		}else{
			echo "<script> alert('Eposta ez da zuzena.') </script>";
		}
	}else{
		echo "<script> alert('Derrigorrezko eremuren bat hutsik dago.') </script>";
	}
	
	
}
?>