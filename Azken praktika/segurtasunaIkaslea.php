<?php
error_reporting(E_ALL ^ E_NOTICE); 
session_start();
//if(isset($_SESSION['rola'])){
	if($_SESSION['rola'] != "IKASLEA"){
		//echo "Sartu naiz";
		session_destroy();
		echo '<script language="javascript" type="text/javascript"> location.href="logIn.php"</script>';
		exit();
	}
/*}else{
	session_destroy();
	echo '<script language="javascript" type="text/javascript"> location.href="logIn.php"</script>';
	exit();
}*/
?>