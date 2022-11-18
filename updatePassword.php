<?php

require('dbConfig.php');
include("adminAuth.php");


$userId = $_GET['userId'];
echo $_POST['userId'] ;

if (isset($_POST['userId'])) {

	$userId = $_POST['userId'];
	$first_name = $row['first_name'];
    $last_name = $row['last_name'];
	$password = $_POST['password'];
	$address = $row['address'];
	$email = $row['email'];  


	$sql = "update user set first_name = '" . $first_name . "', set last_name = '" . $last_name . "', set address = '" . $address . "', set email = '" . $email . "', set email = '" . $email . "'where user_id='" . $userId . "'";

	$result = mysqli_query($db, $sql);

	if ($result) {
		header("location:userProfile.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:updatePassword.php");
}
