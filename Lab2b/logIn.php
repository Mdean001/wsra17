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
			if($("#eposta").val().length >0 && $("#pasahitza").val().length >0 ){
				return true
				
			}else{
				echo "Eremuren bat ez duzu bete!!!! <br/>"
				return false
			}
		}
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
  <a href="layout.html"> Atzera </a>
</body>
</html>

<?php
include 'konfigurazioa.php';
					 
error_reporting(E_ALL ^ E_NOTICE);
// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connection->connect_error) {
	die("Konekxioak kale egin: " . $conn->connect_error);
}
echo "<br/>";

$eposta = $_POST['eposta'];

$pasahitza = $_POST['pasahitza'];

$sql = "SELECT * FROM user WHERE Eposta='$eposta' and Pasahitza='$pasahitza'";

$result = $linki -> query($sql);

	if(!($result)){
		echo "Arazoren bat egon da log in egitean". $result-> error;
	}else{
		$rows = $result->num_rows;
		if($rows ==1){
			$rows = 0;
			header('location: layoutR.html');
		}else{
			echo "<script> alert('Authentication failure!!') </script>";
		}
}

?>






