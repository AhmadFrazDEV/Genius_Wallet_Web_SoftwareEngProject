<?php 
include('./database_integration.php');
session_start();
$userData =  $_SESSION['user'];
// echo $userData['user_id'] .' '. $userData['username'];
if(!isset($userData['user_id']) && !isset($userData['username']) && !isset($userData['email']))
{
    header("Location: ./index.html");
    exit();
}

// {Functions}
// Get the balance
$balance = 0.0;
$currency = 'pak';
                        // Assuming $userData['user_id'] holds the user's ID
                        $userId = $userData['user_id'];

                        // Fetch balance from the wallets table for the given user ID
                        $balanceQuery = "SELECT * FROM wallets WHERE user_id = '$userId'";
                        $balanceResult = mysqli_query($conn, $balanceQuery);

                        // Check if the query was successful
                        if ($balanceResult) {
                            $row = mysqli_fetch_assoc($balanceResult);
                        
                            // Check if the user has a balance record
                            if ($row) {
                                $balance = $row['balance'] ?? 0.0;
                                $currency = $row['currency'] ?? '';
                                
                            } else {
                                // echo "<h1>No balance record found for the user</h1>";
                            }
                        } else {
                            // echo "<h1>Error fetching balance</h1>";
                        }
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genius Admin- Merchant Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-JmrRs0rW2uFGej6H5O8r13m//He27UpWoj9LmM5Zj0K0jIuI2PnEJKkBlUfsVmXEWdwPHocUIksa1RV5MS9jEA=="
        crossorigin="anonymous" />
    <link rel="shortcut icon" href="./assets/images/5480339181644482400.png">
    <link rel="stylesheet" href="./assets/merchant/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/merchant/css/font-awsome.min.css">
    <link rel="stylesheet" href="./assets/merchant/css/selectric.css">
    <link rel="stylesheet" href="./assets/merchant/css/jquery-ui.min.css">
    <link rel="stylesheet" href="./assets/merchant/css/select2.min.css">
    <link rel="stylesheet" href="./assets/merchant/css/tagify.css">
    <link rel="stylesheet" href="./assets/merchant/css/summernote.css">
    <link rel="stylesheet" href="./assets/merchant/css/bootstrap-iconpicker.min.css">
    <link rel="stylesheet" href="./assets/merchant/css/colorpicker.css">
    <link rel="stylesheet" href="./assets/merchant/css/style.css">
    <link rel="stylesheet" href="./assets/merchant/css/components.css">
    <link rel="stylesheet" href="./assets/merchant/css/custom.css">

</head>


<body>

    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">

                <ul class="navbar-nav mr-auto icon-menu">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-right">



                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="./assets/images/17081516131644467428.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block"><?php echo $userData['email']; ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="./merchant/profile-setting" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile setting </a>
                            <a href="./merchant/change-password" class="dropdown-item has-icon">
                                <i class="fas fa-key"></i> Change Password </a>
                            <div class="dropdown-divider"></div>
                            <a href="./merchant/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="nav-item active">
                            <a href="./merchant" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>

                        <li class="nav-item ">
                            <a href="./user_functions/addBalance.html" class="nav-link"><i class="fas fa-plus"></i>
                                <span>
                                    Add Balance</span></a>
                        </li>



                        <li class="nav-item ">
                            <a href="./merchant/transactions" class="nav-link"><i
                                    class="fas fa-exchange-alt"></i><span>Transactions</span></a>
                        </li>


                        <li class="menu-header">Setting</li>
                        <li class="nav-item ">
                            <a href="./merchant/profile-setting" class="nav-link"><i
                                    class="far fa-user"></i><span>Profile Setting</span></a>
                        </li>
                        <li class="nav-item ">
                            <a href="./merchant/change-password" class="nav-link"><i class="fas fa-key"></i><span>Change
                                    Password</span></a>
                        </li>
                        <li class="nav-item ">
                            <a href="./merchant/two-step/authentication" class="nav-link"><i
                                    class="fas fa-lock"></i><span>Two Step Security</span></a>
                        </li>
                        <li class="nav-item ">
                            <a href="./merchant/support/tickets" class="nav-link"><i
                                    class="fas fa-ticket-alt"></i><span>Support Ticket</span></a>
                        </li>
                        <li class="nav-item ">
                            <a href="./merchant/logout" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Log
                                    Out</span></a>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">

                <section class="section">
                    <div class="section-header">
                        <h1>
                            Welcome Back
                            <span style="color: #0da8ee ; text-transform: uppercase;">
                                <?php echo $userData['username']; ?>
                            </span>

                        </h1>

                    </div>
                    <a href="./user_functions/sendMoney.php"><button type="button" class="btn btn-info  float-right">Send Money</button></a>
                </section>
                <div style="margin-top: 20px; text-align: center;">
                    <h1><?php echo $balance .' '. $currency; ?></h1>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h6>Wallets</h6>
                    </div>
                    <div class="col-xl-3 col-md-6 currency--card">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary text-white">
                                US </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>United State Dollar</h4>
                                </div>
                                <div class="card-body">
                                    1,765,751.28 USD
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 currency--card">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary text-white">
                                BDT
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Pakistani Currency</h4>
                                </div>
                                <div class="card-body">
                                <?php echo $balance  ?> PKR
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 currency--card">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary text-white">
                                EUR
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>European Currency</h4>
                                </div>
                                <div class="card-body">
                                    83,933.46 EUR
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xl-3 col-md-6 currency--card">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary text-white">
                                GBP
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Greate British Pound</h4>
                                </div>
                                <div class="card-body">
                                    8.42 GBP
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 currency--card">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary text-white">
                                INR
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Indian Rupee</h4>
                                </div>
                                <div class="card-body">
                                    93,578.87 INR
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 currency--card">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary text-white">
                                BTC
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Bitcoin</h4>
                                </div>
                                <div class="card-body">
                                    31.51114889 BTC
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 currency--card">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary text-white">
                                NGN
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Nigerian naira</h4>
                                </div>
                                <div class="card-body">
                                    508,699.34 NGN
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-xl-3 col-md-6 currency--card">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary text-white">
                                JPY
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Japanese Yen</h4>
                                </div>
                                <div class="card-body">
                                    224.58 JPY
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="row row-deck row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <!-- <h4>Recent Transactions</h4> -->
                <!-- Button to toggle the transactions table -->
                <button class="btn btn-primary btn-sm float-right" data-toggle="collapse" href="#transactionsTable"><i class="fas fa-chevron-down ml-2"></i>All Transections</button>
            </div>
            <div class="table-responsive collapse" id="transactionsTable">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Description</th>
                            <th>Remark</th>
                            <th>Amount</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Add your transactions here -->
                        <tr>
                            <!-- Transaction data -->
                            <tr>
                                            <td data-label="Date">02-Mar-2022</td>
                                            <td data-label="Transaction ID">EVZG0GKK1NLD</td>
                                            <td data-label="Description">
                                                Payment received from : demouser@gmail.com
                                            </td>
                                            <td data-label="Remark">
                                                <span class="badge badge-dark">Merchant Payment</span>
                                            </td>
                                            <td data-label="Amount">
                                                <span class="text-success">+ 37.50 USD</span>
                                            </td>
                                            <td data-label="Details" class="text-end">
                                                <button class="btn btn-primary btn-sm details"
                                                    data-data="{&quot;id&quot;:4,&quot;trnx&quot;:&quot;EVZG0GKK1NLD&quot;,&quot;user_id&quot;:&quot;15&quot;,&quot;user_type&quot;:&quot;2&quot;,&quot;currency_id&quot;:&quot;1&quot;,&quot;wallet_id&quot;:&quot;32&quot;,&quot;charge&quot;:&quot;12.5000000000&quot;,&quot;amount&quot;:&quot;37.5000000000&quot;,&quot;remark&quot;:&quot;merchant_payment&quot;,&quot;type&quot;:&quot;+&quot;,&quot;details&quot;:&quot;Payment received from : demouser@gmail.com&quot;,&quot;invoice_num&quot;:null,&quot;created_at&quot;:&quot;2022-03-02T16:15:18.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-03-02T16:15:18.000000Z&quot;,&quot;currency&quot;:{&quot;id&quot;:1,&quot;default&quot;:&quot;1&quot;,&quot;symbol&quot;:&quot;$&quot;,&quot;code&quot;:&quot;USD&quot;,&quot;curr_name&quot;:&quot;United State Dollar&quot;,&quot;type&quot;:&quot;1&quot;,&quot;status&quot;:&quot;1&quot;,&quot;rate&quot;:&quot;1.0000000000&quot;,&quot;created_at&quot;:&quot;2021-12-19T21:12:58.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-06-25T23:38:18.000000Z&quot;}}">Details</button>
                                            </td>
                                        </tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>



                <!-- <div class="row row-deck row-cards">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Recent Withdraws</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Transaction</th>
                                            <th>Amount</th>
                                            <th>Charge</th>
                                            <th>Total Amount</th>
                                            <th>Method Name</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-label="Transaction">Y4F4E9YDRDTD</td>
                                            <td data-label="Amount">10.00 USD</td>
                                            <td data-label="Charge">2.50 USD</td>
                                            <td data-label="Total Amount">12.50 USD</td>
                                            <td data-label="Method Name">Test</td>
                                            <td data-label="Status">
                                                <span class="badge bg-success">Accepted</span>
                                            </td>
                                            <td data-label="Date">07 Mar 2022 -- 06:28 am</td>
                                        </tr>
                                        <tr>
                                            <td data-label="Transaction">DDUYELRWRCHI</td>
                                            <td data-label="Amount">10.00 USD</td>
                                            <td data-label="Charge">2.50 USD</td>
                                            <td data-label="Total Amount">12.50 USD</td>
                                            <td data-label="Method Name">Test</td>
                                            <td data-label="Status">
                                                <span class="badge bg-success">Accepted</span>
                                            </td>
                                            <td data-label="Date">07 Mar 2022 -- 08:28 am</td>
                                        </tr>
                                        <tr>
                                            <td data-label="Transaction">MB8S8EIRPAGS</td>
                                            <td data-label="Amount">10.00 USD</td>
                                            <td data-label="Charge">2.50 USD</td>
                                            <td data-label="Total Amount">12.50 USD</td>
                                            <td data-label="Method Name">Test</td>
                                            <td data-label="Status">
                                                <span class="badge badge-danger">Rejected</span>
                                                <button class="btn btn-sm bg-dark text-white reason"
                                                    data-bs-toggle="modal" data-bs-target="#modal-team"
                                                    data-reason="jlkjlkj"><i class="fas fa-info"></i></button>
                                            </td>
                                            <td data-label="Date">07 Mar 2022 -- 08:29 am</td>
                                        </tr>
                                        <tr>
                                            <td data-label="Transaction">MET7TWHEB6VT</td>
                                            <td data-label="Amount">50.00 EUR</td>
                                            <td data-label="Charge">3.00 EUR</td>
                                            <td data-label="Total Amount">53.00 EUR</td>
                                            <td data-label="Method Name">demo - euro2</td>
                                            <td data-label="Status">
                                                <span class="badge badge-warning">Pending</span>
                                            </td>
                                            <td data-label="Date">16 Mar 2022 -- 01:15 am</td>
                                        </tr>
                                        <tr>
                                            <td data-label="Transaction">BNEKR6FGYUXK</td>
                                            <td data-label="Amount">50.00 USD</td>
                                            <td data-label="Charge">4.50 USD</td>
                                            <td data-label="Total Amount">54.50 USD</td>
                                            <td data-label="Method Name">Test</td>
                                            <td data-label="Status">
                                                <span class="badge badge-warning">Pending</span>
                                            </td>
                                            <td data-label="Date">16 Mar 2022 -- 04:09 pm</td>
                                        </tr>
                                        <tr>
                                            <td data-label="Transaction">ECC76WW2HQNK</td>
                                            <td data-label="Amount">11.00 EUR</td>
                                            <td data-label="Charge">1.44 EUR</td>
                                            <td data-label="Total Amount">12.44 EUR</td>
                                            <td data-label="Method Name">demo - euro2</td>
                                            <td data-label="Status">
                                                <span class="badge badge-warning">Pending</span>
                                            </td>
                                            <td data-label="Date">17 Mar 2022 -- 08:30 pm</td>
                                        </tr>
                                        <tr>
                                            <td data-label="Transaction">4YKWIQG52FVH</td>
                                            <td data-label="Amount">1,000.00 BDT</td>
                                            <td data-label="Charge">42.00 BDT</td>
                                            <td data-label="Total Amount">1,042.00 BDT</td>
                                            <td data-label="Method Name">demo - BDT</td>
                                            <td data-label="Status">
                                                <span class="badge badge-warning">Pending</span>
                                            </td>
                                            <td data-label="Date">18 Mar 2022 -- 06:55 am</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reject Reasons</h5>

                            </div>
                            <div class="modal-body">
                                <div>
                                    <textarea class="form-control reject-reason" rows="5" disabled></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark ms-auto" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center py-4">
                                <h3>Transaction Details</h3>
                                <p class="trx_details"></p>
                                <ul class="list-group mt-2">

                                </ul>
                            </div>
                            <div class="modal-footer">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col"><a href="#" class="btn w-100 btn-dark" data-dismiss="modal">
                                                Close </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="cleardb" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <input type="hidden" name="_token" value="Ko3KpGmXjO1HseWsMG4uHmro4coCzxuGTK9gkQ4r">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@changeLang('Clear Database')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p>@changeLang('Are You Sure To Clear Database')</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">@changeLang('Close')</button>
                        <button type="submit" class="btn btn-danger">@changeLang('Clear Database')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script src="./assets/admin/js/sweetalert2@9.js"></script>






    <script>
    function toast(type, msg) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: type,
            title: msg
        })
    }

    function amount(amount, type) {
        if (type == 2) {
            return amount.toFixed(8);
        } else {
            return amount.toFixed();
        }
    }
    </script>
    <script src="./assets/merchant/js/jquery.min.js"></script>
    <script src="./assets/merchant/js/popper.min.js"></script>
    <script src="./assets/merchant/js/bootstrap.min.js"></script>
    <script src="./assets/merchant/js/jquery-ui.min.js"></script>
    <script src="./assets/merchant/js/nicescroll.min.js"></script>
    <script src="./assets/merchant/js/summernote.js"></script>
    <script src="./assets/merchant/js/select2.min.js"></script>
    <script src="./assets/merchant/js/tagify.js"></script>
    <script src="./assets/merchant/js/sortable.js"></script>
    <script src="./assets/merchant/js/moment-a.js"></script>
    <script src="./assets/merchant/js/stisla.js"></script>
    <script src="./assets/merchant/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script src="./assets/merchant/js/colorpicker.js"></script>
    <script src="./assets/merchant/js/jquery.uploadpreview.min.js"></script>
    <script src="./assets/merchant/js/chart.min.js"></script>
    <script src="./assets/merchant/js/scripts.js"></script>
    <script src="./assets/merchant/js/custom.js"></script>


    <script>
    var form_error = "Please fill all the required fields";
    var mainurl = ".";
    var lang = {
        'new': 'ADD NEW',
        'edit': 'EDIT',
        'details': 'DETAILS',
        'update': 'Status Updated Successfully.',
        'sss': 'Success !',
        'active': 'Activated',
        'deactive': 'Deactivated',
        'loading': 'Please wait Data Processing...',
        'submit': 'Submit',
        'enter_name': 'Enter Name',
        'enter_price': 'Enter Price',
        'per_day': 'Per Day',
        'per_month': 'Per Month',
        'per_year': 'Per Year',
        'one_time': 'One Time',
        'enter_title': 'Enter Title',
        'enter_content': 'Enter Content',
        'extra_price_name': 'Enter Name',
        'extra_price': 'Enter Price',
        'policy_title': 'Enter Title',
        'policy_content': 'Enter Content',
    };
    </script>


    <script>
    $(function() {
        'use strict'
        $('.reason').on('click', function() {
            $('#modal-reason').find('.reason-text').val($(this).data('reason'))
            $('#modal-reason').modal('show')
        })

    })

    $('.summernote').summernote()
    </script>
    <script>
    'use strict';

    $('.details').on('click', function() {
        var url = "./merchant/transaction/details" + '/' + $(this).data('data').id
        $('.trx_details').text($(this).data('data').details)
        $.get(url, function(res) {
            if (res == 'empty') {
                $('.list-group').html('<p>No details found!</p>')
            } else {
                $('.list-group').html(res)
            }
            $('#modal-success').modal('show')
        })
    })

    $('.reason').on('click', function() {
        $('#modal-team').find('.reject-reason').val($(this).data('reason'))
        $('#modal-team').modal('show')
    })
    </script>

</body>

</html>