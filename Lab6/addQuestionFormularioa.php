<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>AddQuestion</title>
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
			$("#galdeForm").submit(function(){
			return true;
			})
		})
			/*
				console.log("Sartu da")
				if( $("#eposta").val().length > 0 && $("#galdera").val().length > 0 && $("#eranZuzen").val().length > 0 &&  $("#eranOker1").val().length > 0 && 
					$("#eranOker2").val().length > 0 && $("#eranOker3").val().length > 0 && $("#zailtasun").val().length > 0 && $("#gaia").val().length > 0 ){
						
						if( $("#galdera").val().length >= "10" ){
						
							var patZail = /^([1-5])$/
							
							if( patZail.test( $("#zailtasun").val() ) ){
								
								var patPosta = /^([a-z]{2,})([0-9]{3})@ikasle\.ehu\.(eus|es)$/
								
								if(patPosta.test( $("#eposta").val() ) ){
									return true
								}else{
									alert("Sartu duzun eposta ez da egokia!!!")
									return false
								}
							}else{
								alert("Zailtasunaren balioa, zenbaki osokoa eta, 1 eta 5 artekoa, biak barne!!!")
								return false
							}
						}else{
							alert("Galderaren luzera gutxienez 10ekoa izan behar da!!!")
							return false
						}
				}else{
					alert("Derrigorrezko eremuren bat hutsik utzi duzu!!!")
					return false
				}
			})
		})*/
	</script>
  </head>
  <body>
	<br/>
	<header class='main' id='h1'>
		<h2 style="color:black">Add question to the quiz</h2>
	</header>
	<br/>
	Eposta: <span> <?php echo "$_GET[eposta]";?> </span>
	<br/>
	<br/>
	
	<h4>&#40;&#42;&#41; duten eremuak derrigorrezkoak dira</h4>
	<form id="galdeForm" name="galdeForm" action="addQuestionWithImage.php?eposta=<?php echo "$_GET[eposta]";?>" method="POST" enctype="multipart/form-data">
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
		<input type="submit" id="bidali" name="bidali" value="Bidali"/>
		<input type="reset" id="berrezarri" name="berrezarri" value="Berrezarri" onClick="irudiaBorratu()"/>
  </form>
  <br/>
  <img src="" id="irudia" style="display: none;"/>
  <br/>
  <a href="layoutR.php?eposta=<?php echo "$_GET[eposta]";?>"> Atzera </a>
</body>
</html>