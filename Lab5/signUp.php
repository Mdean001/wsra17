<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Sign Up</title>
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
			$("#erregistratuForm").submit(function(){
				if($("#eposta").val().length > 0 && $("#deitura").val().length > 0 && $("#nick").val().length > 0 && $("#pasahitza").val().length > 0
					&& $("#pasahitzaErre").val().length > 0){
						var patPosta = /^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.(eus|es)$/
						if(patPosta.test( $("#eposta").val() )){
							var patDeitura = /^([A-Z]{1})([a-z]{1,})( ([A-Z]{1})([a-z]{1,}))+$/
							if(patDeitura.test($("#deitura").val())){
								//var patNick = /^([A-Z]{1})([a-z]{1,})$/
								var patNick = /^([^\s]{1,})$/
								if(patNick.test($("#nick").val())){
									//var patPass = /^([a-z0-9]{6,})$/
									var patPass = /^([^\s]{6,})$/
									if(patPass.test($("#pasahitza").val())){
										if($("#pasahitza").val() == $("#pasahitzaErre").val()){
											return true									
											
										}else{
											alert("Pasahitzek ez dute bat egiten!!")
											return false
										}
									}else{
										alert("Pasahitza ez da egokia!!")
										return false
									}
								}else{
									alert("Sartu duzun nick-a ez da egokia!!!")
									return false									
								}
							}else{
								alert("Sartu duzun deitura ez da egokia!!")
								return false
							}
						}else{
							alert("Sartu duzun eposta ez da egokia!!!")
							return false
						}
				}else{
					alert("Derrigorrezko eremuren bat hutsik utzi duzu!!!")
					return false
				}
			})				
		})
	</script>
  </head>
  <body>
	<br/>
	<header class='main' id='h1'>
		<h2 style="color:black">Sign Up</h2>
	</header>
	<br/>
	<h4>&#40;&#42;&#41; duten eremuak derrigorrezkoak dira</h4>
	<form id="erregistratuForm" name="erregistratuForm" action="signUp.php" method="POST" enctype="multipart/form-data">
		<br/>
		Eposta &#40;&#42;&#41;: <input type="text" id="eposta" name="eposta" size="35"/>
		<br/>
		<br/>
		Deitura &#40;&#42;&#41;: <input type="text" id="deitura" name="deitura" size="50"/>
		<br/>
		<br/>
		Nick-a &#40;&#42;&#41;: <input type="text" id="nick" name="nick" size="50"/>
		<br/>
		<br/>
		Pasahitza &#40;&#42;&#41;: <input type="password" id="pasahitza" name="pasahitza" size="50"/>
		<br/>
		<br/>
		Pasahitza errepikatu &#40;&#42;&#41;: <input type="password" id="pasahitzaErre" name="pasahitzaErre"/>
		<br/>
		<br/> 
		Irudia : <input type="file" id="gehituIrudia" name="gehituIrudia" onchange="irudiaGehitu()"/>
		<br/>
		<script type="text/javascript">
			function irudiaGehitu(){
				var preview = document.querySelector('img');
				var file = document.querySelector('input[type=file]').files[0];
				var reader = new FileReader();
				reader.onloadend = function () {
					preview.src = reader.result;
					preview.height = "75";
					preview.width = "75";
				}
				if (file) {
					reader.readAsDataURL(file);
				} else {
					preview.src = "";
				}
				var i = document.getElementById('irudia');
				i.style.display = 'block';
			}
			
			function irudiaBorratu() {
				var i = document.getElementById('irudia');
				i.style.display = 'none';
			}
		</script>
		<br/>
		<input type="submit" id="erregistratu" name="erregistratu" value="Erregistratu"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri" onClick="irudiaBorratu()"/>
  </form>
  <br/>
  <img src="" id="irudia" style="display: none;"/>
  <br/>
  <a href="layout.html"> Atzera </a>
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
	
	$deitura = $_POST['deitura'];
	
	$nick = $_POST['nick'];
	
	$pasahitza = $_POST['pasahitza'];
	
	$iru = $_FILES['gehituIrudia']['tmp_name'];
	$irudia = addslashes(file_get_contents($iru));
	
	//$pasahitzaErre = $_POST['pasahitzaErre'];
	
	$sql = "INSERT INTO users(Eposta, Deitura, Nick, Pasahitza, Irudia) VALUES ('$eposta','$deitura','$nick','$pasahitza','$irudia')";
	
	if ($connection->query($sql) === TRUE) {
		//echo "<script> alert('Ondo erregistratu zara.') </script>";
		//header('location: layoutR.html');
		echo '<script language="javascript" type="text/javascript"> alert("Erregistroa zuzen burutu da.Ongi etorri!!!"); location.href="layoutR.php?eposta='.$eposta.' "</script>';
	}else{
		/*echo "Error: " . $sql . "<br>" . $connection->error;
		echo "Ezinezkoa izan da erregistroa burutzea. Saiatu berriro <br/>";
		echo "<a href='signUp.php'> Erregistrora </a> <br/>";*/
		echo "<script> alert('Ezinezkoa izan da erregistroa burutzea. Eposta hori dagoeneko existitzen da.') </script>";
	}
}
?>