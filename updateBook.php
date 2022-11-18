<?php

require('dbConfig.php');
include("adminAuth.php");
$bookId = $_GET['bookId'];


if (isset($_POST['bookTitle'])) {

	$bookTitle = $_POST['bookTitle'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $ISBN = $_POST['ISBN'];
    $releaseYear = $_POST['releaseYear'];
    $genre = $_POST['genre'];
    $rentalStatus = $_POST['rentalStatus'];
    $synopsis = $_POST['synopsis'];

	$sql = "update book set book_title = '" . $bookTitle . "', author ='" . $author . "', publisher ='" . $publisher . "', ISBN ='" . $ISBN . "', release_year ='" . $releaseYear . "', genre ='" . $genre . "', rental_status ='" . $rentalStatus . "', synopsis='" . $synopsis . "' where book_id='" . $bookId . "'";

	$result = mysqli_query($db, $sql);

	if ($result) {
		header("location:bookList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:no.php");
}
