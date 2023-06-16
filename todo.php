<?php
require_once 'db_connect.php';

// Handle the AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    echo "testing";
    
    if ($action === 'add') {
        $item = $_POST['item'];
        addTodoItem($item);
        $itemId = $mysqli->insert_id;
        $response = array('success' => true, 'itemId' => $itemId);
        echo json_encode($response);
    } elseif ($action === 'remove') {
        $id = $_POST['id'];
        removeTodoItem($id);
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'message' => 'Invalid action');
        echo json_encode($response);
    }
}

// Function to add a todo item
function addTodoItem($item) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO todos (item) VALUES (?)");
    $stmt->bind_param("s", $item);
    $stmt->execute();
    $stmt->close();
}

// Function to remove a todo item
function removeTodoItem($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM todos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Function to retrieve all todo items
function getAllTodoItems() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM todos");
    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[] = $row['item'];
    }
    $result->free();
    return $items;
}

// Close the database connection
$mysqli->close();
?>
