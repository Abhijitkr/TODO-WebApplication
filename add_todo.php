<?php
require_once 'db_connect.php';

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
