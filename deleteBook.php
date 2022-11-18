<?php
require_once("dbConfig.php ");
include("adminAuth.php");
if (isset($_GET['bookId'])) {
	$bookId = $_GET['bookId'];
	$sql = " delete from book where book_id='" . $bookId . "'";

	$result = $db->query($sql);

	if ($result) {
		header("location:bookList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:bookList.php");
}
