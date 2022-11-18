<?php

require_once("dbConfig.php ");
include("adminAuth.php");
if (isset($_GET['userId'])) {
	$userId = $_GET['userId'];
	$sql = " delete from user where user_id='" . $userId . "'";

	$result = $db->query($sql);

	if ($result) {
		header("location:userList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:userList2.php");
}
