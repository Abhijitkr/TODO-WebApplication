<?php
session_start();
require_once 'db_connect.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Store the user_id in the session

            echo "<script>alert('Login successful!');</script>";
            echo "<script>window.location.href = 'todolist.php';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
        }

        $stmt->close();
        $mysqli->close();
    } else {
        echo "<script>alert('Please fill in all the required fields.');</script>";
    }
}
?>
