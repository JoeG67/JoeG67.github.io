<?php
require_once("dbConfig.php ");
include("adminAuth.php");
if (isset($_GET['publisherId'])) {
	$publisherId = $_GET['publisherId'];
	$sql = " delete from publisher where publisher_id='" . $publisherId . "'";

	$result = $db->query($sql);

	if ($result) {
		header("location:publisherList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:publisherList2.php");
}
