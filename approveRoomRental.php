<?php

require_once("dbConfig.php ");
include("adminAuth.php");

if (isset($_GET['roomRentalId']) && isset($_GET['status'])) {
	$roomRentalId = $_GET['roomRentalId'];
	$status = $_GET['status'];
	
	$sql = "update room_rental set status = '" . $status . "' where room_rental_id='" . $roomRentalId . "'";

	$result = mysqli_query($db,$sql);

	if ($result) {
		header("location:roomRentalList.php");
	} else {
		echo 'Testing';
	}
} else {
	header("location:dwwdwdwd.php");
}
