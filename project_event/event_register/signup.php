<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Adjust if your MySQL username is different
$password = ""; // Set your MySQL password
$dbname = "event_registration";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password

    // Insert data into users table
    $stmt = $conn->prepare("INSERT INTO users (name, email, mobile, address, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $mobile, $address, $password);

    if ($stmt->execute()) {
        echo "Sign-up successful! You can now log in.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
