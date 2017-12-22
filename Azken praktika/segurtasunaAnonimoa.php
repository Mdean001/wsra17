<?php
error_reporting(E_ALL ^ E_NOTICE); 
session_start();
if(!(empty($_SESSION['rola']))){
	session_destroy();
	echo '<script language="javascript" type="text/javascript"> location.href="layout.php"</script>';
	exit();
}
?>