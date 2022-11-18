<?php

require_once("dbConfig.php ");
include("adminAuth.php");
if (isset($_GET['roleId'])) {
	$roleId = $_GET['roleId'];
	$sql = " delete from role where role_id='" . $roleId . "'";

	$result = $db->query($sql);

	if ($result) {
		header("location:roleList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:roleList.php");
}
