<?php
require_once 'db_connect.php';

// Fetch all todo items from the database
$result = $mysqli->query("SELECT * FROM todos");
$todos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $todos[] = $row;
    }
}

// Close the database connection
$mysqli->close();

// Return the todos as a JSON response
$response = array('success' => true, 'todos' => $todos);
header('Content-Type: application/json'); // Set the response header as JSON
echo json_encode($response);
?>
