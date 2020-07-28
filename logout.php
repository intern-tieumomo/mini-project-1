<?php 
	session_start();
	session_destroy();
	setcookie("cookie_id", "");
	header("Location: login.php");
	exit;
?>
