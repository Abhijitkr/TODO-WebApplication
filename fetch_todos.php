<?php
session_start();
require_once 'db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle the unauthorized access as per your requirements
    echo "<script>alert('You are not logged in.');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

// Fetch todos for the logged-in user
$user_id = $_SESSION['user_id'];

// Prepare the SQL statement
$stmt = $mysqli->prepare("SELECT * FROM todos WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all todo items for the user
$todos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $todos[] = $row;
    }
}

// Close the statement and database connection
$stmt->close();
$mysqli->close();

// Return the todos as a JSON response
$response = array('success' => true, 'todos' => $todos);
header('Content-Type: application/json'); // Set the response header as JSON
echo json_encode($response);
?>
