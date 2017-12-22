<?php include 'segurtasunaIrakaslea.php'; ?>
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
			
			/// Galdera bat osortik ekarri ID-arekin
			
			xhro2.onreadystatechange = function(){
				if((xhro2.readyState==4)&&(xhro2.status==200)){
					var erantzuna = xhro2.responseText;
					var zatiak = erantzuna.split("&");
					console.log("Hau da erantzuna: " + erantzuna);
					console.log(zatiak);
					if(zatiak[0].length > 0){
						document.getElementById("emaitza").innerHTML = "Hona hemen eskatutako galdera:";
					}else{
						document.getElementById("emaitza").innerHTML = "Identifikadore hori duen galderarik ez dago datu-basean.";
					}
					document.getElementById("ID").value = zatiak[0];
					document.getElementById("galdera").value = zatiak[1];
					document.getElementById("eranZuzen").value = zatiak[2];
					document.getElementById("eranOker1").value = zatiak[3];
					document.getElementById("eranOker2").value = zatiak[4];
					document.getElementById("eranOker3").value = zatiak[5];
					document.getElementById("zailtasun").value = zatiak[6];
					document.getElementById("gaia").value = zatiak[7];
				}
			}
			
			function bilatuGaldera(){
				if($("#identi").val().length > 0){
					var patIden = /^(0|[1-9][0-9]*)$/;
					if( patIden.test( $("#identi").val() ) ){
						var id = $("#identi").val();
						console.log("Bidali du");
						xhro2.open("GET","getQuestionBEZEROA.php?identifikazioa=" + id , true);
						xhro2.send();
					}else{
						alert("Identifikadoreak zenbaki osoko eta positibo bat izan behar du.");
					}
				}else{
					alert("Identifikadoreak ezin du hutsa izan.");
				}
			}
			
			/// Galdera eguneratu
			
			xhro3.onreadystatechange = function(){
				if((xhro3.readyState==4)&&(xhro3.status==200)){
					document.getElementById("eguneraketarenErantzuna").innerHTML = xhro3.responseText;
				}
			}
			
			function galderaEguneratu(){
				var ID = $("#ID").val();
				var patID = /^([1-9][0-9]*)$/;
				if( patID.test(ID)){
					if( $("#galdera").val().length > 0 && $("#eranZuzen").val().length > 0 &&  $("#eranOker1").val().length > 0 && 
						$("#eranOker2").val().length > 0 && $("#eranOker3").val().length > 0 && $("#zailtasun").val().length > 0 && $("#gaia").val().length > 0 ){
								
								if( $("#galdera").val().length >= "10" ){
								
									var patZail = /^([1-5])$/;
									
									if( patZail.test( $("#zailtasun").val() ) ){
										var galdera = $("#galdera").val();
										var eranZuzen = $("#eranZuzen").val();
										var eranOker1 = $("#eranOker1").val();
										var eranOker2 = $("#eranOker2").val();
										var eranOker3 = $("#eranOker3").val();
										var zailtasun = $("#zailtasun").val();
										var gaia = $("#gaia").val();
										
										console.log(ID+"&"+galdera+"&"+eranZuzen+"&"+eranOker1+"&"+eranOker2+"&"+eranOker3+"&"+zailtasun+"&"+gaia);
											
										xhro3.open("POST","galderaEguneratu.php", true);
										xhro3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
										xhro3.send("ID="+ ID +"&galdera="+ galdera +"&eranZuzen="+ eranZuzen +"&eranOker1="+ eranOker1 +"&eranOker2="+ eranOker2 +"&eranOker3="+ eranOker3 +"&zailtasun="+ zailtasun +"&gaia="+ gaia);
									}else{
										alert("Zailtasunaren balioa, zenbaki osokoa eta, 1 eta 5 artekoa, biak barne!!!");
									}
								}else{
									alert("Galderaren luzera gutxienez 10ekoa izan behar da!!!");
								}
					}else{
						alert("Derrigorrezko eremuren bat hutsik utzi duzu!!!");
					}
				}else{
					alert("Galdera eguneratzeko galdera bat aukeratu behar duzu.");
				}
			}
	</script>
  </head>
  <body>
	<br/>
	<header class='main' id='h1'>
		<h2 style="color:black">Reviewing quizes</h2>
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
		Eguneratu nahi duzun galderaren identifikadorea: <input type="text" id="identi" name="identi"/>
		<br/>
		<br/>
		<input type="button" id="bilatu" name="bilatu" value="Bilatu" onclick="bilatuGaldera()"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri"/>
	</form>
	<br/>
	<br/>
	<span id="emaitza"></span>
	<br/>
	<br/>
	<h4>&#40;&#42;&#41; duten eremuak derrigorrezkoak dira</h4>
	<form id="galdeForm" name="galdeForm">
		<br/>
		<input type="hidden" id="ID" name="ID" value=""/>
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
		<input type="button" id="eguneratu" name="eguneratu" value="Eguneratu galdera" onclick="galderaEguneratu()"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri"/>
  </form>
  <br/>
  <div id="eguneraketarenErantzuna">
  </div>
  <br/>
</body>
</html>