<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address = htmlspecialchars($_POST['address']);

    // Database connection
    $servername = "localhost";  // Your server name (often 'localhost' for local development)
    $username = "root";         // Your database username
    $password_db = "";          // Your database password (leave empty if using default settings)
    $dbname = "touchwood";      // Your database name (the one you created)

    // Create connection
    $conn = new mysqli('127.0.0.1', 'root@localhost', '', 'furnitureapp');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, mobile, password, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $mobile, $password, $address);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Thank you, $firstName $lastName. Your registration is successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
