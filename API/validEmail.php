<?php

include('../database_integration.php');


// Assuming you have a database connection established

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate the form data (you might want to add more validation)
    $email = $_POST['email'];


    // SQL query to check if the email is present in the 'users' table
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email found, redirect to Reset_Password page
        header("Location: ../Registration/forms/Rest_Password.php?email=$email");
        exit();
    } else {
        // Email not found, redirect to the original page with alert message
        header("Location: ../Registration/forms/forgot-password.php?Email_found=0");
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>
