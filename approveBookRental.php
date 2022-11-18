<?php

require_once("dbConfig.php ");
include("adminAuth.php");

if (isset($_GET['bookRentalId']) && isset($_GET['status'])) {
	$bookRentalId = $_GET['bookRentalId'];
	$status = $_GET['status'];
	
	$sql = "update book_rental set status = '" . $status . "' where book_rental_id='" . $bookRentalId . "'";

	$result = mysqli_query($db,$sql);

	if ($result) {
		header("location:bookRentalList.php");
	} else {
		echo 'Testing';
	}
} else {
	header("location:dwwdwdwd.php");
}
