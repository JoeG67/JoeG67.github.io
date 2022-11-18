<?php

require('dbConfig.php');
include("adminAuth.php");
$roomId = $_GET['roomId'];

if (isset($_POST['roomName'])) {
	$roomName = $_POST['roomName'];
	$roomLocation = $_POST['roomLocation'];
	$rentalStatus = $_POST['rentalStatus'];
	
	$sql = "update room set room_name = '" . $roomName . "', room_location = '" . $roomLocation . "', rental_status ='" . $rentalStatus . "' where room_id = '" . $roomId . "'";

	$result = mysqli_query($db, $sql);

	if ($result) {
		header("location:roomList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:roomList2.php");
}
