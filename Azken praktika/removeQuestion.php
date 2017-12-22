<?php include 'segurtasunaIrakaslea.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>removeQuestion</title>
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
	<script type="text/javascript" language="javascript">
	
			var xhro1 = new XMLHttpRequest();
			var xhro2 = new XMLHttpRequest();
			
			/// Galdera guztiak ikusteko
			
			window.onload = function(){
				galderakIkusi();
				setInterval(galderakIkusi,20000);
			}
			
			xhro1.onreadystatechange = function(){
				if((xhro1.readyState==4)&&(xhro1.status==200)){
					document.getElementById("galderak").innerHTML = xhro1.responseText;
				}
			}
			
			function galderakIkusi() {
					xhro1.open("GET","showQuestionsAJAXReview.php", true);
					xhro1.send();
			}	
			
			/// Galdera ezabatu
			
			xhro2.onreadystatechange = function(){
				if((xhro2.readyState==4)&&(xhro2.status==200)){
					document.getElementById("ezabaketaEmaitza").innerHTML = xhro2.responseText;
				}
			}
			
			function ezabatuGaldera(){
				var ID = $("#identi").val();
				var patID = /^([1-9][0-9]*)$/;
				if( patID.test(ID)){
					console.log(ID);
					xhro2.open("POST","ezabatuGaldera.php", true);
					xhro2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xhro2.send("ID="+ ID );
				}else{
					alert("Galdera ezabatzeko identifikadore okerra. Osoko zenbaki bat, 1 baino handiagoa.");
				}
			}
	</script>
  </head>
  <body>
	<br/>
	<header class='main' id='h1'>
		<h2 style="color:black">Remove question</h2>
	</header>
	<br/>
	<a href="layout.php"> Atzera </a>
	<br/>
	<br/>
	<div id="galderak">
	</div>
	<br/>
	<br/>
	<form id="formularioID" name="formularioID">
		<br/>
		Ezabatu nahi duzun galderaren identifikadorea: <input type="text" id="identi" name="identi"/>
		<br/>
		<br/>
		<input type="button" id="ezabatu" name="ezabatu" value="Ezabatu" onclick="ezabatuGaldera()"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri"/>
	</form>
	<br/>
	<div id="ezabaketaEmaitza"></div>
	<br/>
  </body>
</html>