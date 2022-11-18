<?php

require_once("dbConfig.php ");
include("adminAuth.php");

if (isset($_GET['pcRentalId']) && isset($_GET['status'])) {
	$pcRentalId = $_GET['pcRentalId'];
	$status = $_GET['status'];
	
	$sql = "update pc_rental set status = '" . $status . "' where pc_rental_id='" . $pcRentalId . "'";

	$result = mysqli_query($db,$sql);

	if ($result) {
		header("location:pcRentalList.php");
	} else {
		echo 'Testing';
	}
} else {
	header("location:dwwdwdwd.php");
}
