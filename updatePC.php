<?php

require('dbConfig.php');
include("adminAuth.php");
$pcId = $_GET['pcId'];

if (isset($_POST['pcName'])) {

	$pcName = $_POST['pcName'];
	$rentalStatus = $_POST['rentalStatus'];
	
	$sql = "update pc set pc_name = '" . $pcName . "', rental_status ='" . $rentalStatus . "' where pc_id = '" . $pcId . "'";

	$result = mysqli_query($db, $sql);

	if ($result) {
		header("location:pcList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:pcList2.php");
}
