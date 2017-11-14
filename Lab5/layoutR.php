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
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layoutR.php?eposta=<?php echo "$_GET[eposta]";?>'>Home</a></span>
		<!--<span><a href='/quizzes'>Quizzes</a></span>-->
		<span><a href='addQuestionFormularioa.php?eposta=<?php echo "$_GET[eposta]";?>'> addQuestion </a></span>
		<span><a href='showQuestionsWithImage.php?eposta=<?php echo "$_GET[eposta]";?>'> showQuestionsWithImage </a></span>
		<span><a href='showQuestions.php?eposta=<?php echo "$_GET[eposta]";?>'> showQuestions </a></span>
		<span><a href='showXMLQuestions.php?eposta=<?php echo "$_GET[eposta]";?>'> showXMLQuestions </a></span>
		<span><a href='handlingQuizes.php?eposta=<?php echo "$_GET[eposta]";?>'> handlingQuizes </a></span>
		<span><a href='logOut.php'> logOut</a></span>
	</nav>
    <section class="main" id="s1">
	
	<div>

	Quizzes and credits will be displayed in this spot in future laboratories ...
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
