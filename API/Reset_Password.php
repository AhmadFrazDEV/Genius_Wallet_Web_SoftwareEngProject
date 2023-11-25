<?php

include('../database_integration.php');
// Assuming you have a database connection established

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate the form data (you might want to add more validation)
    $email = $_GET['email'];
    $newPassword = $_POST['password'];

    // Hash the new password before updating it in the database
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // SQL query to update the user password in the 'users' table
    $sql = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result) {
        // Password updated successfully, you can redirect the user to a success page
        header("Location: ../Registration/forms/login.php?pass_update=1");
        exit();
    } else {
        // Password update failed, you can redirect the user to a failure page or show an error message
        header("Location: Password_Reset_Failure.php");
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>
