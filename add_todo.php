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

// Prepare the SQL statement
$stmt = $mysqli->prepare("INSERT INTO todos (item) VALUES (?)");
$stmt->bind_param("s", $_POST['item']);

// Execute the statement
$success = $stmt->execute();

// Get the ID of the inserted row
$itemId = $stmt->insert_id;

// Close the statement and database connection
$stmt->close();
$mysqli->close();

// Prepare the response
if ($success) {
    $response = array('success' => true, 'itemId' => $itemId);
} else {
    $response = array('success' => false, 'message' => 'Failed to add the todo.');
}

// Return the response as JSON
echo json_encode($response);
?>
