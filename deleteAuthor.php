<?php
require_once("dbConfig.php ");
include("adminAuth.php");
if (isset($_GET['authorId'])) {
	$authorId = $_GET['authorId'];
	$sql = " delete from author where author_id='" . $authorId . "'";

	$result = $db->query($sql);

	if ($result) {
		header("location:authorList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:authorList2.php");
}
