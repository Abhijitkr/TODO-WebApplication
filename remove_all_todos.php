<?php
require_once 'db_connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    $response = array('success' => false, 'message' => 'User not authenticated.');
    echo json_encode($response);
    exit();
}

$user_id = $_SESSION['user_id'];

// Remove all todo items for the logged-in user from the database
$stmt = $mysqli->prepare("DELETE FROM todos WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$success = $stmt->execute();
$stmt->close();

// Close the database connection
$mysqli->close();

// Prepare the response
if ($success) {
    $response = array('success' => true, 'message' => 'All todos removed successfully.');
} else {
    $response = array('success' => false, 'message' => 'Failed to remove todos.');
}

// Return the response as JSON
echo json_encode($response);
?>
