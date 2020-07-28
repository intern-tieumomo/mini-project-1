<?php
	session_start();
	session_destroy(); 
	// echo md5(uniqid(rand(), true));
	// setcookie("cookie_id", "6b2de39e79997378cab44ec73732c2ac", time() + 60*60*24*30);
	// setcookie("email", "");
	// setcookie("password", "");
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	echo "<pre>";
	print_r($_COOKIE);
	echo "</pre>";
?>