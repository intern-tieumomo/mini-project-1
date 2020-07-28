<?php
	require_once 'connect.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];

		$sql = "delete from tb_company where id = $id";
		$res = mysqli_query($conn, $sql);
		echo "<pre>";
		print_r($res);
		echo "</pre>";
	}
?>