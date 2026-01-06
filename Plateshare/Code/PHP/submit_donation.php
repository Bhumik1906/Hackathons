<?php
// Connection to the database
$conn = new mysqli("localhost", "root", "", "foodwastemanagement");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving form data
$name = $_POST['name'];
$food = $_POST['food'];
$quantity = $_POST['quantity'];
$address = $_POST['address'];

// Insert donation data into the database
$sql = "INSERT INTO donations (name, food, quantity, address, status) 
        VALUES ('$name', '$food', '$quantity', '$address', 'Pending NGO Assignment')";

if ($conn->query($sql) === TRUE) {
    // Get the auto-generated donation ID
    $donation_id = $conn->insert_id;

    // Display the donation ID to the user
    echo "<h2>Thank you for your donation!</h2>";
    echo "<p>Your Donation ID is: <strong>" . $donation_id . "</strong></p>";
    echo "<p>Please keep this ID for tracking your donation status.</p>";

    // Optionally, you can send an email to the user with the donation ID (additional feature)
    // Example: mail($email, "Your Donation ID", "Your Donation ID is: " . $donation_id);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
