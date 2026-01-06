<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ngo_dashboard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all members from the database
$sql = "SELECT * FROM members";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members</title>
</head>
<body>
    <h2>Team Members</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Status</th>
        </tr>
        <?php
        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["role"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No members found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>