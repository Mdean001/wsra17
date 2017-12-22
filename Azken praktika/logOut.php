<?php
error_reporting(E_ALL ^ E_NOTICE); 
session_start();
if($_SESSION['rola'] != "IKASLEA" && $_SESSION['rola'] != "IRAKASLEA"){
	session_destroy();
	echo '<script language="javascript" type="text/javascript"> location.href="logIn.php"</script>';
	exit();
}else{
	$xml = simplexml_load_file('counter.xml');
	$xml->children()->itemBody->p = $xml->children()->itemBody->p - 1;
	$xml->asXML('counter.xml');

	session_destroy();

	echo "Saioa itxi duzu. Hurrrengora arte!!<br/>";
	echo "<a href=layout.php> Itzuli orri nagusira </a>";
}
?>