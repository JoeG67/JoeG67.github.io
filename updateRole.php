<?php

require('dbConfig.php');
include("adminAuth.php");
$roleId = $_GET['roleId'];

if (isset($_POST['roleName'])) {

	$roleName = $_POST['roleName'];
	
	$sql = "update role set role_name = '" . $roleName . "' where role_id = '" . $roleId . "'";

	$result = mysqli_query($db, $sql);

	if ($result) {
		header("location:roleList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:roleList.php");
}
