<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>GetQuestionByID</title>
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
				console.log("Jaso da");
				document.getElementById("emaitzaGaldera").innerHTML = xhro.responseText;
			}
		}
	
		function bilatuGaldera(){
			if($("#identi").val().length > 0){
				var patIden = /^(0|[1-9][0-9]*)$/;
				if( patIden.test( $("#identi").val() ) ){
					var id = $("#identi").val();
					console.log("Bidali du");
					xhro.open("GET","getQuestionBEZEROA.php?identifikazioa=" + id , true);
					xhro.send();
				}else{
					alert("Identifikadoreak zenbaki osoko eta positibo bat izan behar du.");
				}
			}else{
				alert("Identifikadoreak ezin du hutsa izan.");
			}
		}
	</script>
  </head>
  <body>
	<br/>
	<header class='main' id='h1'>
		<h2 style="color:black">Get question by ID</h2>
	</header>
	<br/>
	<h4>&#40;&#42;&#41; duten eremuak derrigorrezkoak dira</h4>
	<form id="formularioID" name="formularioID">
		<br/>
		Identifikadorea &#40;&#42;&#41;: <input type="text" id="identi" name="identi"/>
		<br/>
		<br/>
		<input type="button" id="bilatu" name="bilatu" value="Bilatu" onclick="bilatuGaldera()"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri"/>
	</form>
  <br/>
  <span id="emaitzaGaldera"></span>
  <br/>
  <br/>
  <a href="layoutR.php?eposta=<?php echo "$_GET[eposta]";?>"> Atzera </a>
</body>
</html>