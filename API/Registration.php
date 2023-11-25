<?php

include('../database_integration.php');

// Assuming you have a database connection established

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Validate the form data (you might want to add more validation)
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    
    
    // SQL query to insert data into the 'users' table
    $sql = "INSERT INTO users (username, email, country, password, created_at) VALUES ('$name', '$email', '$country', '$password', NOW())";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to login page with success message
        header("Location: ../Registration/forms/login.php?registration_success=1");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}
?>
