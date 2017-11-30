<?php include 'segurtasunaAnonimoa.php'; ?>
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
			
			var xhro = new XMLHttpRequest();
			var xhro2 = new XMLHttpRequest();
			
			xhro.onreadystatechange = function(){
				if((xhro.readyState==4)&&(xhro.status==200)){
					var erantzuna = xhro.responseText;
					console.log(erantzuna);
					if(erantzuna == "BAI"){
						document.getElementById("wsMatrikulatua").innerHTML = "Eposta hori WS irakasgaian matrikulatuta dago."
						document.getElementById("wsMatrikulatua").style.color = "green";
					}else{
						document.getElementById("wsMatrikulatua").innerHTML = "Eposta hori ez dago WS irakasgaian matrikulatuta."
						document.getElementById("wsMatrikulatua").style.color = "red";
					}
				}
			}

			xhro2.onreadystatechange = function(){
				if((xhro2.readyState==4)&&(xhro2.status==200)){
					var pasaErantzuna = xhro2.responseText;
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
			
			function egiaztatuMatrikula(){
				var eposta = $("#eposta").val();
				console.log(eposta);
				xhro.open("GET","egiMatriBEZEROA.php?eposta="+ eposta, true);
				xhro.send();
			}
			
			function egiaztatuPasahitzSendoa(){
				var pasahitza = $("#pasahitza").val();
				xhro2.open("POST", "egiPasaBEZEROA.php", true);
				xhro2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhro2.send("pasahitza="+pasahitza);
			}
				
			function egiaztapena(){
				if($("#eposta").val().length > 0 && $("#deitura").val().length > 0 && $("#nick").val().length > 0 && $("#pasahitza").val().length > 0
					&& $("#pasahitzaErre").val().length > 0){
						var patPosta = /^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.(eus|es)$/
						if(patPosta.test( $("#eposta").val() )){
							
							var epostaMatri = xhro.responseText;
							if(epostaMatri == "BAI"){
							
								var patDeitura = /^([A-Z]{1})([a-z]{1,})( ([A-Z]{1})([a-z]{1,}))+$/
								if(patDeitura.test($("#deitura").val())){
									var patNick = /^([^\s]{1,})$/
									if(patNick.test($("#nick").val())){
										var patPass = /^([^\s]{6,})$/
										if(patPass.test($("#pasahitza").val())){
											
											var pasahitzSendoa = xhro2.responseText;
											if(pasahitzSendoa == "BALIOZKOA"){
											
												if($("#pasahitza").val() == $("#pasahitzaErre").val()){
													return true									
												}else{
													alert("Pasahitzek ez dute bat egiten!!")
													return false
												}	
											}else{
												alert("Pasahitza ez da sendoa!!")
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
								alert("Eposta ez dago WS matrikulatuta!!!!")
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
			}
			//})				
		//})
	</script>
  </head>
  <body>
	<br/>
	<header class='main' id='h1'>
		<h2 style="color:black">Sign Up</h2>
	</header>
	<br/>
	<h4>&#40;&#42;&#41; duten eremuak derrigorrezkoak dira</h4>
	<form id="erregistratuForm" name="erregistratuForm" action="signUp.php" method="POST" enctype="multipart/form-data" onSubmit="return egiaztapena()">
		<br/>
		Eposta &#40;&#42;&#41;: <input type="text" id="eposta" name="eposta" size="35" onchange="egiaztatuMatrikula()"/>
		<span id="wsMatrikulatua"></span>
		<br/>
		<br/>
		Deitura &#40;&#42;&#41;: <input type="text" id="deitura" name="deitura" size="50"/>
		<br/>
		<br/>
		Nick-a &#40;&#42;&#41;: <input type="text" id="nick" name="nick" size="50"/>
		<br/>
		<br/>
		Pasahitza &#40;&#42;&#41;: <input type="password" id="pasahitza" name="pasahitza" size="50" onchange="egiaztatuPasahitzSendoa()"/>
		<span id="pasahitzSendoaTestua"></span>
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
			
			function irudiaTestuaBorratu() {
				var i = document.getElementById('irudia');
				i.style.display = 'none';
				document.getElementById('wsMatrikulatua').innerHTML = "";
			}
		</script>
		<br/>
		<input type="submit" id="erregistratu" name="erregistratu" value="Erregistratu"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri" onClick="irudiaTestuaBorratu()"/>
  </form>
  <br/>
  <img src="" id="irudia" style="display: none;"/>
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
	$deitura = $_POST['deitura'];
	$nick = $_POST['nick'];
	$pasahitza = $_POST['pasahitza'];
	$trimEposta = trim($eposta);
	$trimDeitura = trim($deitura);
	$trimNick = trim($nick);
	$trimPasahitza = trim($pasahitza);
	
	$patternEzHutsa = '/^.+$/' ;
	if(preg_match($patternEzHutsa,$trimEposta) == 1 && preg_match($patternEzHutsa,$trimDeitura) == 1 && preg_match($patternEzHutsa,$trimNick) == 1 &&
	   preg_match($patternEzHutsa,$trimPasahitza) == 1){
		   
			$patPosta = '/^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.(eus|es)$/';
			if(preg_match($patPosta, $trimEposta) == 1){
				
				$patDeitura = '/^([A-Z]{1})([a-z]{1,})( ([A-Z]{1})([a-z]{1,}))+$/';
				if(preg_match($patDeitura, $trimDeitura) == 1){
					
					$patNick = '/^([^\s]{1,})$/';
					if(preg_match($patNick, $trimNick) == 1){
						
						$patPass = '/^([^\s]{6,})$/';
						if(preg_match($patPass, $trimPasahitza) == 1){
	
							$iru = $_FILES['gehituIrudia']['tmp_name'];
							$irudia = addslashes(file_get_contents($iru));
							
							$pasahitzaKodetuta = crypt($trimPasahitza, "wsPasahitzaKodetuta");
							
							$sql = "INSERT INTO users(Eposta, Deitura, Nick, Pasahitza, Irudia) VALUES ('$trimEposta','$trimDeitura','$trimNick','$pasahitzaKodetuta','$irudia')";
							
							if ($connection->query($sql) === TRUE) {
								//echo "<script> alert('Ondo erregistratu zara.') </script>";
								//header('location: layoutR.html');
								
								$xml = simplexml_load_file('counter.xml');
								$xml->children()->itemBody->p = $xml->children()->itemBody->p + 1;
								$xml->asXML('counter.xml');
								
								echo '<script language="javascript" type="text/javascript"> alert("Erregistroa zuzen burutu da.Ongi etorri!!!"); location.href="logIn.php"</script>';
							}else{
								/*echo "Error: " . $sql . "<br>" . $connection->error;
								echo "Ezinezkoa izan da erregistroa burutzea. Saiatu berriro <br/>";
								echo "<a href='signUp.php'> Erregistrora </a> <br/>";*/
								echo "<script> alert('Ezinezkoa izan da erregistroa burutzea. Eposta hori dagoeneko existitzen da.') </script>";
							}
						}else{
							echo "<script> alert('Errorea: Pasahitzak gutxienez 6 karaktere eduki behar ditu.') </script>";
						}
					}else{
						echo "<script> alert('Errorea: Sartu duzun nick-a ez da egokia.') </script>";
					}
				}else{
					echo "<script> alert('Errorea: Sartu duzun deitura ez da egokia.') </script>";
				}
			}else{
				echo "<script> alert('Errorea: Sartu duzun eposta ez da egokia.') </script>";
			}
		}else{
		   echo "<script> alert('Errorea: Derrigorrezko eremuran bat hutsik dago.') </script>";
		}
}
?>