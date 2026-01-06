<?php
    // Sanitize user input
    $ngoname = isset($_POST['ngoname']) ? htmlspecialchars($_POST['ngoname']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
    $state = isset($_POST['state']) ? htmlspecialchars($_POST['state']) : '';
    $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
    $dateofregi = isset($_POST['dateofregi']) ? htmlspecialchars($_POST['dateofregi']) : '';
    $regino = isset($_POST['regino']) ? htmlspecialchars($_POST['regino']) : '';

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'foodwastemanagement');
    
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Hash the password for secure storage
       
        
        // Prepare statement to insert data into the tbl_register table
        $stmt = $conn->prepare("INSERT INTO tbl_register (ngoname, email, password, phone, address, state, city, dateofregi, regino) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind the parameters to the statement
        $stmt->bind_param("sssissssi", $ngoname, $email, $password, $phone, $address, $state, $city, $dateofregi, $regino);
        
        // Execute the statement and check if successful
        if ($stmt->execute()) {
            echo "<h2>Registration Successful!</h2>";
            echo "<h3>Collected Data:</h3>";
            echo "NGO Name: " . $ngoname . "<br>";
            echo "Email: " . $email . "<br>";
            echo "Phone: " . $phone . "<br>";
            echo "Address: " . $address . "<br>";
            echo "State: " . $state . "<br>";
            echo "City: " . $city . "<br>";
            echo "Date of Registration: " . $dateofregi . "<br>";
            echo "Registration Number: " . $regino . "<br>";

            // Redirect to login page after successful registration
            header("Location: logintemp.php");
            exit();
        } else {
            echo "Error during registration. Please try again.";
        }
        
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
?>
