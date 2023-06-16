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
echo json_encode($response);
?>
