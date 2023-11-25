<?php
include('../database_integration.php');
session_start();
// Assuming you have a database connection established

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate the form data (you might want to add more validation)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to check if the email and password are present in the 'users' table
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify the password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, user is authenticated
            // Redirect to User_Account page

            $userData = array(
                'user_id' => $row['user_id'],
                'username' => $row['username'],
                'email' => $row['email'],
                // Add more user data as needed
            );
            
            // Store the user data in the session
            $_SESSION['user'] = $userData;

            header("Location: ../Wallet.php");
            exit();
        } else {
            header("Location: ../Registration/forms/login.php?incorrect_pass=0");
        exit();
        }
    } else {
        // User not found, redirect to login page with error message
        header("Location: ../Registration/forms/login.php?login_error=0");
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>
