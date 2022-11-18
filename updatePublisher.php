<?php

require('dbConfig.php');
include("adminAuth.php");
$publisherId = $_GET['publisherId'];

if (isset($_POST['publisherName'])) {

	$publisherName = $_POST['publisherName'];
	
	$sql = "update publisher set publisher_name = '" . $publisherName . "' where publisher_id = '" . $publisherId . "'";

	$result = mysqli_query($db, $sql);

	if ($result) {
		header("location:publisherList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:publisherList.php");
}
