<?php
require_once("dbConfig.php ");
include("adminAuth.php");
if (isset($_GET['roomId'])) {
	$roomId = $_GET['roomId'];
	$sql = " delete from room where room_id='" . $roomId . "'";

	$result = $db->query($sql);

	if ($result) {
		header("location:roomList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:roomList2.php");
}
