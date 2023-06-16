<?php
// Check if the ID and checked parameters are provided
if (isset($_POST['id'], $_POST['checked'])) {
    $itemId = $_POST['id'];
    $checked = $_POST['checked'];

    require_once 'db_connect.php';

    // Prepare the SQL statement to update the checked status of the item
    $sql = "UPDATE todos SET checked = ? WHERE id = ?";

    // Prepare and bind the parameters
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $checked, $itemId);

    // Execute the statement
    if ($stmt->execute()) {
        // If the item is successfully updated, prepare the response
        $response = array(
            'success' => true,
            'message' => 'Item updated successfully.'
        );

        // Send the response as JSON
        echo json_encode($response);
    } else {
        // If the item update fails, prepare the response
        $response = array(
            'success' => false,
            'message' => 'Failed to update the item.'
        );

        // Send the response as JSON
        echo json_encode($response);
    }

    // Close the statement and the database connection
    $stmt->close();
    $mysqli->close();
} else {
    // If the ID and checked parameters are not provided, prepare the response
    $response = array(
        'success' => false,
        'message' => 'Missing parameters.'
    );

    // Send the response as JSON
    echo json_encode($response);
}
