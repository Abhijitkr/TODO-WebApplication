<?php
session_start();
require_once 'db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    $response = array('success' => false, 'message' => 'User not logged in.');
    echo json_encode($response);
    exit();
}

// Prepare the SQL statement
$stmt = $mysqli->prepare("INSERT INTO todos (user_id, item) VALUES (?, ?)");
$stmt->bind_param("is", $_SESSION['user_id'], $_POST['item']);

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
