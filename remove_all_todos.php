<?php
require_once 'db_connect.php';

// Remove all todo items from the database
$mysqli->query("TRUNCATE TABLE todos");

// Close the database connection
$mysqli->close();

// Prepare the response
$response = array('success' => true, 'message' => 'All todos removed successfully.');

// Return the response as JSON
echo json_encode($response);
?>
