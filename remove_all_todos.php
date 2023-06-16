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

// Remove all todo items from the database
$mysqli->query("TRUNCATE TABLE todos");

// Close the database connection
$mysqli->close();

// Prepare the response
$response = array('success' => true, 'message' => 'All todos removed successfully.');

// Return the response as JSON
echo json_encode($response);
?>
