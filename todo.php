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
