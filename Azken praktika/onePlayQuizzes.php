<?php 
include 'segurtasunaAnonimoa.php';
$bektorea = array();
$bektorea2 = array();
$_SESSION['galderak'] = $bektorea;
$_SESSION['emaitzak'] = $bektorea2;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>One-Play Quizzes</title>
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
		var xhro1 = new XMLHttpRequest();
		var xhro2 = new XMLHttpRequest();
		var xhro3 = new XMLHttpRequest();
		
		window.onload = function(){
			hurrengoGaldera();
		}
		
		// Galdera zuzendu
		
		xhro1.onreadystatechange = function(){
			if((xhro1.readyState==4)&&(xhro1.status==200)){
				document.getElementById("emaitza").innerHTML = xhro1.responseText;
			}
		}
		
		function zuzenduGaldera(){
			if($("#bukatuta").text().length > 0){
				alert("Datu-baseko galdera guztiak amaitu dira");
			}else{
				if($("#emaitza").text().length > 0){
					alert("Galdera dagoeneko zuzendu duzu. Saiatu beste bat egiten");
				}else{
					var erantzunDu = false;
					var aukeratutakoErantzuna = "";
					var radios = document.getElementsByName('erantzunak');
					for (var i = 0, length = radios.length; i < length; i++){
						if (radios[i].checked){
							erantzunDu = true;
							var labela = radios[i].value + "_erantzuna";
							aukeratutakoErantzuna = document.getElementById(labela).textContent;
							break;
						}
					}
					if(erantzunDu === true){
						document.getElementById("erantzun_du").value = "Erantzun du.";
						xhro1.open("POST","zuzendu.php",true);
						xhro1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xhro1.send("erantzunTestua=" + aukeratutakoErantzuna);
					}else{
						alert("Erantzun bat aukeratu behar duzu.");
					}
				}
			}
		}
		
		// Hurrengo galdera ekarri
		
		xhro2.onreadystatechange = function(){
			if((xhro2.readyState==4)&&(xhro2.status==200)){
				console.log("Bidali du");
				var galderakoDatuak = xhro2.responseText;
				console.log(galderakoDatuak);
				var zatiak = galderakoDatuak.split("&");
				if(zatiak[0] == ""){
					document.getElementById("bukatuta").innerHTML = "Datu-baseko galdera guztiak amaitu dira";
					document.getElementById("galderaTestua").innerHTML = "";
					document.getElementById("a_erantzuna").innerHTML = "";
					document.getElementById("b_erantzuna").innerHTML = "";
					document.getElementById("c_erantzuna").innerHTML = "";
					document.getElementById("d_erantzuna").innerHTML = "";
				}else{
					document.getElementById("galderaTestua").innerHTML = zatiak[0];
					document.getElementById("a_erantzuna").innerHTML = zatiak[1];
					document.getElementById("b_erantzuna").innerHTML = zatiak[2];
					document.getElementById("c_erantzuna").innerHTML = zatiak[3];
					document.getElementById("d_erantzuna").innerHTML = zatiak[4];
				}
			}
		}
		
		function hurrengoGaldera(){
			if($("#bukatuta").text().length > 0){
				alert("Datu-baseko galdera guztiak amaitu dira");
			}else{
				if($("#emaitza").text().length > 0){
					$("#emaitza").text("");
					document.getElementById("galderaForm").reset();
					xhro2.open("GET", "hurrengoGaldera.php", true);
					xhro2.send();
				}else{
					alert("Galdera erantzun eta zuzendu behar duzu hurrengoa ikusteko.");
				}
			}
		}
		
		// Nick-a eta emaitzak DB-an gorde eta atzera egin
		
		
		xhro3.onreadystatechange = function(){
			if((xhro3.readyState==4)&&(xhro3.status==200)){
				var erantzuna = xhro3.responseText;
				console.log(erantzuna);
				if( erantzuna == "BALIOZKOA"){
					location.href="layout.php";
				}else if(erantzuna == "BALIOGABEA"){
					alert("Nick hori dagoeneko existitzen da. Sartu beste bat.");
				}else if(erantzuna == "BALIOGABEA2"){
					alert("Nick hori ez da zuzena.");
				}else{
					alert("Arazoren bat egon da nick-a eta emaitzak sartzean.");
				}
			}
		}
		
		function atzera(){
			if($("#erantzun_du").val().length > 0){
				var patNick = /^([^\s]{1,})$/;
				if(patNick.test($("#nicka").val())){
					xhro3.open("POST","nickGalderaGorde.php",true);
					xhro3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xhro3.send("nick=" + $("#nicka").val());
				}else{
					alert("Nick-a sartu behar duzu edo sartu duzuna ez da zuzena.");
				}
			}else{
				location.href = "layout.php";
			}
		}
	</script>
  </head>
  <body>
	<br/>
	<header class='main' id='h1'>
		<h2 style="color:black">One-Play Quizzes</h2>
	</header>
	<input type="button" id="atzera" name="atzera" value="Atzera" onclick="atzera()"/>
	<input type="hidden" id="erantzun_du" name="erantzun_du" />
	<br/>
	<br/>
	<form id="nickForm" name="nickForm">
		Nick-a: <input type="text" id="nicka" name="nicka" />
	</form>
	<br/>
	<div>
		Galdera: <span id="galderaTestua"></span>
	</div>
	<br/>
	<form id="galderaForm" name="galderaForm">
		<br/>
		<input type="radio" name="erantzunak" value="a">
		<label for="a" id="a_erantzuna"></label>
		<br>
		<input type="radio" name="erantzunak" value="b">
		<label for="b" id="b_erantzuna"></label>
		<br>
		<input type="radio" name="erantzunak" value="c">
		<label for="c" id="c_erantzuna"></label>
		<br/>
		<input type="radio" name="erantzunak" value="d">
		<label for="d" id="d_erantzuna"></label>
		<br/>
		<br/>
		<input type="button" id="zuzendu" name="zuzendu" value="Zuzendu" onclick="zuzenduGaldera()"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri"/>
		<input type="button" id="hurrengoa" name="hurrengoa" value="Hurrengoa" onclick="hurrengoGaldera()"/>
  </form>
  <br/>
  <div id="emaitza"> Galdera.</div>
  <br/>
  <div id="bukatuta"></div>
</body>
</html>