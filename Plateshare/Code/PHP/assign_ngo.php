<?php
// Connection to the database
$conn = new mysqli("localhost", "root", "", "foodwastemanagement");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the latest donation that has not been assigned an NGO
$sql = "SELECT * FROM donations WHERE ngo_id IS NULL ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the donation details
    $donation = $result->fetch_assoc();
    $donation_id = $donation['id'];
    $donation_location = $donation['address']; // We assume the address helps determine location

    // Find an available NGO (you can modify this logic to match location, availability, etc.)
    $sql_ngo = "SELECT * FROM ngos LIMIT 1"; // Fetch the first available NGO for simplicity
    $ngo_result = $conn->query($sql_ngo);

    if ($ngo_result->num_rows > 0) {
        // Fetch the NGO details
        $ngo = $ngo_result->fetch_assoc();
        $ngo_id = $ngo['id'];
        $ngoname = $ngo['name'];

        // Assign the NGO to the donation
        $update_sql = "UPDATE donations SET ngo_id='$ngo_id', status='NGO Assigned' WHERE id='$donation_id'";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "NGO '" . $ngo_name . "' has been successfully assigned to donation ID: " . $donation_id;
        } else {
            echo "Error updating donation: " . $conn->error;
        }
    } else {
        echo "No available NGOs at the moment.";
    }
} else {
    echo "No donations need NGO assignment.";
}

$conn->close();
?>
