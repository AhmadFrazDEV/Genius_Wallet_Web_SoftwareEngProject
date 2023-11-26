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

    // Check if the user already exists in the wallets table
    $checkUserSql = "SELECT * FROM wallets WHERE user_id = ?";
    $checkUserStmt = $conn->prepare($checkUserSql);
    $checkUserStmt->bind_param("i", $userData['user_id']);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, update their balance
        $updateSql = "UPDATE wallets SET balance = balance + $amount WHERE user_id = {$userData['user_id']}";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("di", $amount, $userData['user_id']);
        if ($updateStmt->execute()) {
            header("Location: ../Wallet.php");
            exit();
        } else {
            echo "Error updating balance: " . $updateStmt->error;
        }
        $updateStmt->close();
    } else {
        // User doesn't exist, insert a new row
        $insertSql = "INSERT INTO wallets (user_id, balance, currency) VALUES ('{$userData['user_id']}', '$amount', '$currency')";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ids", $userData['user_id'], $amount, $currency);
        if ($insertStmt->execute()) {
            header("Location: ../Wallet.php");
            exit();
        } else {
            echo "Error inserting data: " . $insertStmt->error;
        }
        $insertStmt->close();
    }

    // Close the statement and connection
    $checkUserStmt->close();
    $conn->close();
}
?>
