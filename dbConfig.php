<?php
//db Local
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'lmsdb';

//Connect and select the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

?>

