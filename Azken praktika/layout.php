<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
	<script language="javascript">
		var xhro = new XMLHttpRequest();
		
		window.onload = function(){
			ekarriSaiakeraHoberenak();
			setInterval(ekarriSaiakeraHoberenak,30000);
		}
		
		xhro.onreadystatechange = function(){
			if((xhro.readyState==4)&&(xhro.status==200)){
				document.getElementById("saiakerak").innerHTML = xhro.responseText;
			}
		}
		
		function ekarriSaiakeraHoberenak(){
			xhro.open("GET", "ekarriSaiakeraHoberenak.php", true);
			xhro.send();
		}
	</script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<h2>Quiz: crazy questions</h2>
    </header>
	
	<nav class='main' id='n1' role='navigation'>
	<?php
		error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
		if(empty($_SESSION['rola'])){
			echo "<span><a href='layout.php'>Home</a></span>";
			echo "<span><a href='onePlayQuizzes.php'>One-Play Quizzes</a></span>";
			echo "<span><a href='signUp.php'>Sign Up</a></span>";
			echo "<span><a href='logIn.php'>Log In</a></span>";
			echo "<span><a href='credits.php'>Credits</a></span>";
		}else if($_SESSION['rola'] == "IKASLEA"){
			echo "<span><a href='layout.php'>Home</a></span>";
			echo "<span><a href='handlingQuizes.php'>handlingQuizes</a></span>";
			echo "<span><a href='credits.php'>Credits</a></span>";
			echo "<span><a href='logOut.php'>logOut</a></span>";
		}else if($_SESSION['rola'] == "IRAKASLEA"){
			echo "<span><a href='layout.php'>Home</a></span>";
			echo "<span><a href='reviewingQuizes.php'>reviewingQuizes</a></span>";
			echo "<span><a href='removeQuestion.php'>Remove Question</a></span>";
			echo "<span><a href='credits.php'>Credits</a></span>";
			echo "<span><a href='logOut.php'>logOut</a></span>";
		}
	
	?>
	</nav>
	<!--<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Home</a></span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='signUp.php'>Sign Up</a></span>
		<span><a href='logIn.php'>Log In</a></span>
		<span><a href='credits.html'>Credits</a></span>
	</nav>-->
    <section class="main" id="s1">
		<div id="saiakerak"></div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
