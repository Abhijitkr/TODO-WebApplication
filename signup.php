<?php
require_once 'db_connect.php';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($password)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        $stmt->execute();

        $stmt->close();
        $mysqli->close();

        echo "<script>alert('Signup successful!');</script>";
        echo "<script>window.location.href = 'signin.php';</script>";
        exit();
    } else {
        echo "<script>alert('Please fill in all the required fields.');</script>";
    }
}
?>
