<?php
	require_once 'connect.php';

	if(isset($_POST['company'])){
		$company = $_POST['company'];
		$contact = $_POST['contact'];
		$country = $_POST['country'];

		$sql = "insert into tb_company(company, contact, country, created_at, updated_at) values('$company', '$contact', '$country', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
		$res = mysqli_query($conn, $sql);
		if(mysqli_errno($conn) != 0){
			echo mysqli_error($conn);
		} else {
			echo $conn->insert_id;
		}
	}
?>