<?php

include('../database_integration.php');
session_start();
$userData = $_SESSION['user'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $recipientEmail = filter_var($_POST["recipientEmail"], FILTER_SANITIZE_EMAIL);
    $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Check if the recipient's email exists in the users table
    $checkRecipientQuery = "SELECT * FROM users WHERE email = '$recipientEmail'";
    $resultCheckRecipient = mysqli_query($conn, $checkRecipientQuery);

    if ($resultCheckRecipient) {
        if (mysqli_num_rows($resultCheckRecipient) > 0) {
            // Recipient's email exists, proceed with the transfer

            // Get the sender's wallet ID
            $getSenderWalletQuery = "SELECT * FROM wallets WHERE user_id = {$userData['user_id']}";
            $resultGetSenderWallet = mysqli_query($conn, $getSenderWalletQuery);
            
            if ($resultGetSenderWallet) {
                if (mysqli_num_rows($resultGetSenderWallet) > 0) {
                    $row = mysqli_fetch_assoc($resultGetSenderWallet);
                    $senderWalletId = $row['wallet_id'];
                    if($row['balance'] < $amount)
                    {
                        header("Location: ../user_functions/sendMoney.php?lessBalance=0");
                        exit();
                    }
                    // Get the recipient's wallet ID
                    $getRecipientWalletQuery = "SELECT wallet_id FROM wallets WHERE user_id IN (SELECT user_id FROM users WHERE email = '$recipientEmail')";
                    $resultGetRecipientWallet = mysqli_query($conn, $getRecipientWalletQuery);

                    if ($resultGetRecipientWallet) {
                        if (mysqli_num_rows($resultGetRecipientWallet) > 0) {
                            $row = mysqli_fetch_assoc($resultGetRecipientWallet);
                            $recipientWalletId = $row['wallet_id'];

                            // Transfer the amount
                            $updateSenderBalanceQuery = "UPDATE wallets SET balance = balance - $amount WHERE wallet_id = $senderWalletId";
                            $resultUpdateSenderBalance = mysqli_query($conn, $updateSenderBalanceQuery);

                            if ($resultUpdateSenderBalance) {
                                $updateRecipientBalanceQuery = "UPDATE wallets SET balance = balance + $amount WHERE wallet_id = $recipientWalletId";
                                $resultUpdateRecipientBalance = mysqli_query($conn, $updateRecipientBalanceQuery);

                                if ($resultUpdateRecipientBalance) {
                                    // Insert into transfers table
                                    $insertTransferQuery = "INSERT INTO transfers (sender_wallet_id, receiver_wallet_id, amount, status) VALUES ($senderWalletId, $recipientWalletId, $amount, 'Completed')";
                                    $resultInsertTransfer = mysqli_query($conn, $insertTransferQuery);

                                    if ($resultInsertTransfer) {
                                        header("Location: ../user_functions/proofofTransfer.php?amount=" . urlencode($amount) . "&sender=" . urlencode($userData['email']) . "&receiver=" . urlencode($recipientEmail));
                                    } else {
                                        echo "Error inserting into transfers table: " . mysqli_error($conn);
                                    }
                                } else {
                                    echo "Error updating recipient's balance: " . mysqli_error($conn);
                                }
                            } else {
                                echo "Error updating sender's balance: " . mysqli_error($conn);
                            }
                        } else {
                            echo "Recipient's wallet not found.";
                        }
                    } else {
                        echo "Error executing getRecipientWalletQuery: " . mysqli_error($conn);
                    }
                } else {
                    echo "Sender's wallet not found.";
                }
            } else {
                echo "Error executing getSenderWalletQuery: " . mysqli_error($conn);
            }
        } else {
            header("Location: ../user_functions/sendMoney.php?emailNotFound=0");
        }
    } else {
        echo "Error executing checkRecipientQuery: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}

?>
