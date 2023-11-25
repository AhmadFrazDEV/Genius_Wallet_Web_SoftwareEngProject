<?php

include('../database_integration.php');
session_start();
$userData =  $_SESSION['user'];


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $currency = filter_var($_POST["currency"], FILTER_SANITIZE_STRING);

    // Additional validation if needed

    

    // Prepare and execute the SQL query to insert data into the wallets table
    $sql = "INSERT INTO wallets (user_id, balance, currency) VALUES ('" . $userData['user_id'] . "', '$amount', '$currency')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ids", $user_id, $amount, $currency);

    // Assuming $user_id is the user's ID, replace it with the actual user ID value
    $user_id = 1; // Replace with your actual user ID

    if ($stmt->execute()) {
        header("Location: ../Wallet.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
