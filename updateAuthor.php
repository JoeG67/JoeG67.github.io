<?php

require('dbConfig.php');
include("adminAuth.php");
$authorId = $_GET['authorId'];

if (isset($_POST['authorName'])) {

	$authorName = $_POST['authorName'];
	
	$sql = "update author set author_name = '" . $authorName . "' where author_id = '" . $authorId . "'";

	$result = mysqli_query($db, $sql);

	if ($result) {
		header("location:authorList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:authorList2.php");
}
