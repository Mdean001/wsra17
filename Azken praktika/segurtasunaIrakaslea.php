<?php
error_reporting(E_ALL ^ E_NOTICE); 
session_start();
if($_SESSION['rola'] != "IRAKASLEA"){
	session_destroy();
	echo '<script language="javascript" type="text/javascript"> location.href="logIn.php"</script>';
	exit();
}
?>