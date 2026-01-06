<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodwastemanagement";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Insert member data into the database
    $sql = "INSERT INTO members (name, role, status) VALUES ('$name', '$role', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "New member added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>