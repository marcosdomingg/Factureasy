<?php
session_start();

if (!isset($_SESSION['dbUser']) || !isset($_SESSION['dbPass']) || !isset($_SESSION['dbName'])) {
    die("Database connection details not found. Please set them through the login form.");
}

$host = $_SESSION['dbHost'];
$db = $_SESSION['dbName'];
$user = $_SESSION['dbUser'];
$pass = $_SESSION['dbPass'];

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Connection failed: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
