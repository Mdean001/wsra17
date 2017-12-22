<?php include "segurtasunaIkaslea.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>handlingQuizes</title>
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
			var xhro3 = new XMLHttpRequest();
			var xhro4 = new XMLHttpRequest();
			
			xhro1.onreadystatechange = function(){
				if((xhro1.readyState==4)&&(xhro1.status==200)){
					document.getElementById("txertaketa").innerHTML = xhro1.responseText;
				}
			}
			
			xhro2.onreadystatechange = function(){
				if((xhro2.readyState==4)&&(xhro2.status==200)){
					document.getElementById("galderak").innerHTML = xhro2.responseText;
				}
			}
			
			xhro3.onreadystatechange = function(){
				if((xhro3.readyState==4)&&(xhro3.status==200)){
					var emaitza = xhro3.responseText;
					document.getElementById("galderaKopuruaTestua").innerHTML = "Nire galderak/Galderak guztira DB: " + emaitza;
				}
			}
			
			xhro4.onreadystatechange = function(){
				if((xhro4.readyState==4)&&(xhro4.status==200)){
					var emaitza = xhro4.responseText;
					document.getElementById("erabiltzaileKop").innerHTML = "Momentu honetan kautotutako erabiltzaile kopurua: " + emaitza;
				}
			}
			
			window.onload = function(){
				galderaKopurua();
				erabiltzaileKopurua();
				setInterval(erabiltzaileKopurua,10000);
				setInterval(galderaKopurua,20000);
			}
			
			
			function galderaKopurua(){
				var eposta = "<?php /*error_reporting(E_ALL ^ E_NOTICE); session_start();*/ echo $_SESSION['eposta'];?>";
				xhro3.open("GET","galderaKopurua.php?eposta="+ eposta, true);
				xhro3.send();
			}
			
			function erabiltzaileKopurua(){
				xhro4.open("GET","kautoKopLortu.php", true);
				xhro4.send();
			}
			
			function galderaBidali() {
				if( $("#galdera").val().length > 0 && $("#eranZuzen").val().length > 0 &&  $("#eranOker1").val().length > 0 && 
						$("#eranOker2").val().length > 0 && $("#eranOker3").val().length > 0 && $("#zailtasun").val().length > 0 && $("#gaia").val().length > 0 ){
							
							if( $("#galdera").val().length >= "10" ){
							
								var patZail = /^([1-5])$/;
								
								if( patZail.test( $("#zailtasun").val() ) ){
										var eposta = "<?php /*error_reporting(E_ALL ^ E_NOTICE); session_start();*/ echo $_SESSION['eposta'];?>";
										var galdera = $("#galdera").val();
										var eranZuzen = $("#eranZuzen").val();
										var eranOker1 = $("#eranOker1").val();
										var eranOker2 = $("#eranOker2").val();
										var eranOker3 = $("#eranOker3").val();
										var zailtasun = $("#zailtasun").val();
										var gaia = $("#gaia").val();
										
										xhro1.open("POST","addQuestionAJAX.php", true);
										xhro1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
										xhro1.send("eposta="+ eposta +"&galdera="+ galdera +"&eranZuzen="+ eranZuzen +"&eranOker1="+ eranOker1 +"&eranOker2="+ eranOker2 +"&eranOker3="+ eranOker3 +"&zailtasun="+ zailtasun +"&gaia="+ gaia);
								}else{
									alert("Zailtasunaren balioa, zenbaki osokoa eta, 1 eta 5 artekoa, biak barne!!!");
								}
							}else{
								alert("Galderaren luzera gutxienez 10ekoa izan behar da!!!");
							}
					}else{
						alert("Derrigorrezko eremuren bat hutsik utzi duzu!!!");
					}
			}
			
			function galderakIkusi() {
					xhro2.open("GET","showQuestionsAJAX.php", true);
					xhro2.send();
			}	
	</script>
  </head>
  <body>
	<br/>
	<header class='main' id='h1'>
		<h2 style="color:black">Add question to the quiz</h2>
	</header>
	<br/>
	Eposta: <span> <?php /*error_reporting(E_ALL ^ E_NOTICE); session_start();*/ echo $_SESSION['eposta'];?> </span>
	<br/>
	<br/>
	
	<h4>&#40;&#42;&#41; duten eremuak derrigorrezkoak dira</h4>
	<form id="galdeForm" name="galdeForm">
		<br/>
		Galderaren testua &#40;&#42;&#41;: <input type="text" id="galdera" name="galdera" size="50"/>
		<br/>
		<br/>
		Erantzun zuzena &#40;&#42;&#41;: <input type="text" id="eranZuzen" name="eranZuzen"/>
		<br/>
		<br/>
		Erantzun okerra 1 &#40;&#42;&#41;: <input type="text" id="eranOker1" name="eranOker1"/>
		<br/>
		<br/>
		Erantzun okerra 2 &#40;&#42;&#41;: <input type="text" id="eranOker2" name="eranOker2"/>
		<br/>
		<br/>
		Erantzun okerra 3 &#40;&#42;&#41;: <input type="text" id="eranOker3" name="eranOker3"/>
		<br/>
		<br/>
		Galderaren zailtasuna &#40;1 eta 5 artekoa&#41; &#40;&#42;&#41;: <input type="text" id="zailtasun" name="zailtasun"/>
		<br/>
		<br/>
		Galderaren gai-arloa &#40;&#42;&#41;: <input type="text" id="gaia" name="gaia"/>
		<br/>
		<br/>
		<input type="button" id="bidali" name="bidali" value="Bidali" onclick="galderaBidali()"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri"/>
		<input type="button" id="galdeIkusiBotoia" name="galdeIkusiBotoia" value="Galderak ikusi" onclick="galderakIkusi()"/>
  </form>
  <br/>
  <a href="layout.php"> Atzera </a>
  <br/>
  <br/>
  <div id="erabiltzaileKop">
  </div>
  <br/>
  <div id="galderaKopuruaTestua">
  </div>
  <br/>
  <div id="txertaketa">
  </div>
  <br/>
  <div id="galderak">
  </div>
</body>
</html>