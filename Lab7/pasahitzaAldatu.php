<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Pasahitza Aldatu</title>
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
	
		var xhro = new XMLHttpRequest();
		
		xhro.onreadystatechange = function(){
			if((xhro.readyState==4)&&(xhro.status==200)){
				var pasaErantzuna = xhro.responseText;
				console.log(pasaErantzuna);
				if(pasaErantzuna == "BALIOZKOA"){
					document.getElementById("pasahitzSendoaTestua").innerHTML = "Sartu duzun pasahitza sendoa da."
					document.getElementById("pasahitzSendoaTestua").style.color = "green";
				}else{
					document.getElementById("pasahitzSendoaTestua").innerHTML = "Sartu duzun pasahitza ez da sendoa. Aldatu."
					document.getElementById("pasahitzSendoaTestua").style.color = "red";
				}
			}
		}
		
		function egiaztatuPasahitzSendoa(){
			var pasahitza = $("#pass").val();
			xhro.open("POST", "egiPasaBEZEROA.php", true);
			xhro.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhro.send("pasahitza="+pasahitza);
		}
		
		function egiaztapena(){
			if($("#pass").val().length > 0 && $("#passErre").val().length > 0){
				var patPass = /^([^\s]{6,})$/
				if(patPass.test($("#pass").val())){
					
					var pasahitzSendoa = xhro.responseText;
					if(pasahitzSendoa == "BALIOZKOA"){
						
						if($("#pass").val()==$("#passErre").val()){
							return true	
						}else{
							alert("Pasahitzek ez dute bat egiten!!!!")
							return false
						}
						
					}else{
						alert("Pasahitza ez da sendoa.Aldatu.")
						return false
					}
				}else{
					alert("Pasahitzak gutxienez 6 karaktere izan behar ditu!!!!!")
					return false
				}
			}else{
				alert("Eremuren bat ez duzu bete!!!!")
				return false
			}
		}
	</script>
  </head>
  <body>
	<br/>
	<header class='main' id='h1'>
		<h2 style="color:black">Pasahitza Aldatu</h2>
	</header>
	<br/>
	
	<form id="pasahitzaAldatu" name="pasahitzaAldatu" action="pasahitzaAldatu.php" method="POST" onSubmit="return egiaztapena()">
		<br/>
		Pasahitza &#40;&#42;&#41;: <input type="password" id="pass" name="pass" size="35" onchange="egiaztatuPasahitzSendoa()"/>
		<span id="pasahitzSendoaTestua"></span>
		<br/>
		<br/>
		Pasahitza Errepikatu &#40;&#42;&#41;: <input type="password" id="passErre" name="passErre" size="35"/>
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
				 
//error_reporting(E_ALL ^ E_NOTICE);

if(isset($_POST['pass'])){
	
	$eposta = $_SESSION['epostaBerreskuratu'];

	$pasahitza = $_POST['pass'];
	
	$pasahitzaErre = $_POST['passErre'];
	
	$trimPasahitza = trim($pasahitza);
	
	$trimPassErre = trim($pasahitzaErre);
	
	$patternEzHutsa = '/^.+$/' ;
	if(preg_match($patternEzHutsa, $trimPasahitza) == 1 && preg_match($patternEzHutsa, $trimPassErre) == 1){
		
		$patPass = '/^([^\s]{6,})$/';
		if(preg_match($patPass, $trimPasahitza)==1){
			if($trimPasahitza == $trimPassErre){
				
				$connection = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($connection->connect_error) {
					die("Konekxioak kale egin: " . $conn->connect_error);
				}else{
					echo "<br/>";
					$sql = "SELECT * FROM users WHERE Eposta='$eposta'";
			
					$result = $connection->query($sql);
			
					if(!($result)){
						echo $result->error;
						echo "<script> alert('Arazoren bat egon da pasahitza berreskuratzean.') </script>";
						//header('location: logIn.php');
					}else{
						$rows = $result->num_rows;
						echo $rows;
						if($rows == 1){
							$passEncrypt = crypt($trimPasahitza, "wsPasahitzaKodetuta");
							$sqlAldatu = "UPDATE users SET Pasahitza='$passEncrypt' WHERE Eposta='$eposta'";
							$egokiSartuta = $connection->query($sqlAldatu);
							if ($egokiSartuta === TRUE) {
								session_destroy();
								echo '<script language="javascript" type="text/javascript"> alert("Pasahitza aldatu duzu."); location.href="logIn.php"</script>';
							}else{
								echo "<script> alert('Arazoren bat egon da pasahitza aldatzean.') </script>";
							}
						}else{
							//echo "hau da.";
							echo "<script> alert('Arazoren bat egon da pasahitza aldatzean.') </script>";
						}
					}
				}
			}else{
				echo "<script> alert('Errorea: Pasahitzek ez dute bat egiten.') </script>";
			}
		}else{
			echo "<script> alert('Errorea: Pasahitzak gutxienez 6 karaktere eduki behar ditu.') </script>";
		}
	}else{
		echo "<script> alert('Derrigorrezko eremuren bat hutsik dago.') </script>";
	}
	
	
}
?>