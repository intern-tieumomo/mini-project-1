<?php
	require_once 'connect.php';

	if(isset($_POST['company'])){
		$id = $_POST['id'];
		$company = $_POST['company'];
		$contact = $_POST['contact'];
		$country = $_POST['country'];

		$sql = "update tb_company set company = '$company', contact = '$contact', country = '$country', updated_at = CURRENT_TIMESTAMP where id = '$id'";
		$res = mysqli_query($conn, $sql);
		if(mysqli_errno($conn) != 0){
			echo mysqli_error($conn);
		} else {
			echo $conn->insert_id;
		}
	}
?>