<?php
// Connection to the database
$conn = new mysqli("localhost", "root", "", "foodwastemanagement");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$donation_id = $_POST['donation_id'];

// Retrieve the status of the donation
$sql = "SELECT * FROM donations WHERE id='$donation_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the status of the donation
    while ($row = $result->fetch_assoc()) {
        echo "Donation ID: " . $row['id'] . "<br>";
        echo "Donor Name: " . $row['name'] . "<br>";
        echo "Food: " . $row['food'] . "<br>";
        echo "Quantity: " . $row['quantity'] . "<br>";
        echo "Pickup Address: " . $row['address'] . "<br>";
        echo "Status: " . $row['status'] . "<br>";
    }
} else {
    echo "No donation found with that ID.";
}

$conn->close();
?>
