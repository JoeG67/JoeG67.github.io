<?php

require_once("dbConfig.php ");
include("adminAuth.php");

if (isset($_GET['requestId']) && isset($_GET['request_status'])) {
	$requestId = $_GET['requestId'];
	$status = $_GET['request_status'];
	
	$sql = "update request set request_status = '" . $status . "' where request_id='" . $requestId . "'";

	$result = mysqli_query($db,$sql);

	if ($result) {
		header("location:requestList.php");
	} else {
		echo 'Testing';
	}
} else {
	header("location:dwwdwdwd.php");
}
