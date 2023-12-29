<?php
// Check if the ID parameter is provided
if (isset($_POST['id'])) {
    $itemId = $_POST['id'];

    require_once 'db_connect.php';

    // Prepare the SQL statement to delete the item from the database
    $sql = "DELETE FROM todos WHERE id = ?";

    // Prepare and bind the parameters
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $itemId);

    // Execute the statement
    if ($stmt->execute()) {
        // If the item is successfully deleted, prepare the response
        $response = array(
            'success' => true,
            'message' => 'Item removed successfully.'
        );
    } else {
        // If there is an error while deleting the item, prepare the error response
        $response = array(
            'success' => false,
            'message' => 'Error removing item from the database.'
        );
    }

    // Close the statement and the database connection
    $stmt->close();
    $mysqli->close();

    // Send the JSON response
    echo json_encode($response);
} else {
    // If the ID parameter is not provided, return an error response
    $response = array(
        'success' => false,
        'message' => 'Invalid request.'
    );

    // Send the JSON response
    echo json_encode($response);
}
?>
