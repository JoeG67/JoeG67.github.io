<?php
require_once("dbConfig.php ");
include("adminAuth.php");
if (isset($_GET['pcId'])) {
	$pcId = $_GET['pcId'];
	$sql = " delete from pc where pc_id='" . $pcId . "'";

	$result = $db->query($sql);

	if ($result) {
		header("location:pcList.php");
	} else {
		echo ' Please Check Your Query ';
	}
} else {
	header("location:pcList2.php");
}
