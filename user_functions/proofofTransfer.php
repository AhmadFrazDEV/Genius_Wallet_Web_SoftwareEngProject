<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm Transaction</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCyIlwnfYj4xDCraUQHRgijb50NPoMGUQvE5g50ogktaz5P1P7QvFCwfK55lHY4" crossorigin="anonymous">

  <style>
    body {
      font-family: sans-serif;
      background-color: #f7f7f7;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    .header {
      background-color: blue;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .transaction-details {
      padding: 20px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
    }

    .confirmation-message {
      color: blue;
      font-weight: bold;
      text-align: center;
    }

    .button-container {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Transaction Confirmation</h1>
    </div>

    <div class="transaction-details">
      <p>Amount: <span id="transactionAmount"><?php echo $_GET['amount']; ?></span></p>
      <p>Sender Email: <span id="transactionDate"><?php echo $_GET['sender']; ?></span></p>
      <p>Receiver Email: <span id="transactionDate"><?php echo $_GET['receiver']; ?></span></p>
      <p>Status: <span id="transactionStatus">Successfull</span></p>
    </div>

    <div class="confirmation-message">
      <p>Your transaction has been successfully processed.</p>
    </div>

    <div class="button-container">
      <a href="../Wallet.php" class="btn btn-primary">Return to Home</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" integrity="sha384-vt50PYvX5X1tTQuGcPoK5u5g/KD2Z/HqHIKlTsk9xymTWoJ9g+4v6OnVl8Yx0i" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-Q6fnB/OpE6lMpoE5Dq7umDbrGE4AKLN7TUHqRg5qcG0sKT5gmzP+s4cZ7KtqY1+7" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPkDaC7TmJ3+Yp6d0q3gEJZ7/WF78rf9v/8fY4ka9K9qO2Z75ebglt4j9PCau" crossorigin="anonymous"></script>

 
</body>