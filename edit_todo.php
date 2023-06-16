<?php
// Check if the ID and newText parameters are provided
if (isset($_POST['id']) && isset($_POST['newText']) && !empty(trim($_POST['newText']))) {
    // Retrieve the values from the request
    $itemId = $_POST['id'];
    $newText = $_POST['newText'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "todo";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the update statement
    $stmt = $conn->prepare("UPDATE todos SET item = ? WHERE id = ?");
    $stmt->bind_param("si", $newText, $itemId);
    
    // Check if the update value is not empty
    if (!empty($newText)) {
        $stmt->execute();
    }
    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false, "message" => "Failed to update the todo.");
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();

    // Return the response as JSON
    echo json_encode($response);
} else {
    // If the ID or newText parameters are missing, return an error response
    $response = array("success" => false, "message" => "Invalid request.");
    echo json_encode($response);
}

