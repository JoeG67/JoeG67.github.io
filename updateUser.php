<?php

require('dbConfig.php');
include("adminAuth.php");
$userId = $_GET['userId'];


if (isset($_POST['userId'])) {

	$userId = $_POST['userId'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $icNumber = $_POST['icNumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];
	
	

	$sql = "update user set user_id = '" . $userId . "', password ='" . $password . "', role ='" . $role . "', first_name ='" . $firstName . "', last_name ='" . $lastName . "', ic_number ='" . $icNumber . "', email ='" . $email . "', address='" . $address . "' , photo_name='" . $file_user . "'where user_id='" . $userId . "'";

	$result = mysqli_query($db, $sql);

	if ($result) {
		header("location:userList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:no.php");
}
