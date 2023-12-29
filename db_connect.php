<?php
// Database credentials
$host = 'localhost'; // Replace with your host name
$dbUsername = 'root'; // Replace with your database username
$dbPassword = ''; // Replace with your database password
$dbName = 'todo'; // Replace with your database name

// Create a new MySQLi object and establish the connection
$mysqli = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($mysqli->connect_error) {
    die('Connect Error: ' . $mysqli->connect_error);
}
?>
