<?php
include 'config.php';
session_start();
$transfer_to_err = "";
$amount_err = "";
$sql = "SELECT * FROM customers Where customer_id = $_SESSION[account_number]";
$account_number = $_SESSION['account_number'];
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();

if (isset($_POST['submit_transfer'])) {
    if(empty(trim($_POST['transfer_to']))){
        $transfer_to_err = "Please Enter Account Number";
    }else{
        $sql = "SELECT id FROM customers WHERE customer_id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_customer_id);
            $param_customer_id = trim($_POST["transfer_to"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    if(trim($_POST['transfer_to'])==$account_number){
                    $transfer_to_err = "You cant transfer to yourself bruh";
                    }
                    else{
                        $transfer_to = trim($_POST["transfer_to"]);
                    }
                } 
            }
            mysqli_stmt_close($stmt);
        }
    }
    if(empty(trim($_POST["amount_transfer"]))){
        $amount_err = "Please Enter Amount";
    }else if(trim($_POST['amount_transfer']) > $row['net_balance']){
        $amount_err = "You dont have sufficient Balance";
    }else{
        $amount_transfer = trim($_POST['amount_transfer']);
    }




    if (empty($transfer_to_err) && empty($amount_err)) {
        $total_debit = $row['total_debit'] + $amount_transfer;
        $net_balance = $row['net_balance'] - $amount_transfer;

        $transaction_id = mt_rand(100, 999) . mt_rand(1000, 9999) . mt_rand(10, 99);

        date_default_timezone_set('Asia/Manila');
        $transaction_date = date("d/m/y h:i:s A");

        $remark = "Cash Transfer";

        $description = "Cash Transfer";

        $conn->autocommit(FALSE);

        $sql1 = "UPDATE customers SET net_balance = '$net_balance' WHERE customer_id = '$account_number' ";
        $sql2 = "UPDATE customers SET total_debit = '$total_debit' WHERE customer_id = '$account_number' ";

        $sql3 = "INSERT INTO passbook_$account_number(Transaction_id,Transaction_date,Description,Cr_amount,Dr_amount,Net_Balance,Remark)
        VALUES('$transaction_id','$transaction_date','$description','0','$amount_transfer','$net_balance','$remark')";

        $sql_other = "SELECT * FROM customers WHERE customer_id = '$transfer_to' ";
        $result = mysqli_query($conn, $sql_other);
        $row = $result->fetch_assoc();

        $total_credit = $row['total_credit'] + $amount_transfer;
        $other_net_balance = $row['net_balance'] + $amount_transfer;

        $sql4 = "UPDATE customers SET net_balance = '$other_net_balance' WHERE customer_id = '$transfer_to' ";
        $sql5 = "UPDATE customers SET total_credit = '$total_credit' WHERE customer_id = '$transfer_to' ";

        $sql6 = "INSERT INTO passbook_$transfer_to(Transaction_id,Transaction_date,Description,Cr_amount,Dr_amount,Net_Balance,Remark)
        VALUES('$transaction_id','$transaction_date','$description','$total_credit','0','$other_net_balance','$remark')";

        if ($conn->query($sql1) == TRUE && $conn->query($sql2) == TRUE && $conn->query($sql3) == TRUE  && $conn->query($sql4) == TRUE  && $conn->query($sql5) == TRUE  && $conn->query($sql6) == TRUE) {
            $conn->commit();
            echo '<script>alert("Account Cash Transfer Successfull")
                 location="DTransferown.php"</script>';
        } else {
            echo '<script>alert("Transaction failed\n\nReason:\n\n' . $conn->error . '")</script>';
            $conn->rollback();
        }
    }
}
$sql = "SELECT * FROM customers Where customer_id = $_SESSION[account_number]";
$account_number = $_SESSION['account_number'];
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.2.1-dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="default.css">

    <title>Northland Bank</title>

</head>

<body>
    <!-- ========== Nav bar ========== -->
    <?php include_once 'D_header.php'; ?>
    <!-- ========== End Section ========== -->

    <!-- ========== Dashboard area ========== -->
    <section>
        <div class="dashboardArea pt-150 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebaArea">
                            <div class="sidebarTopArea text-center">
                                <div class="userName">
                                    <h3><?php echo $row['name']; ?></h3>
                                </div>
                            </div>
                            <div class="slidebarNavArea">
                                <nav>
                                    <ul>
                                        <li class="navItem"><a href="Dashboard.php">Dashboard</a></li>
                                        <li class="navItem"><a href="WithdrawPage.php">Withdraw</a></li>
                                        <li class="navItem"><a href="DepositPage.php">Deposit</a></li>
                                        <li class="navItem submenu show active">
                                            <a href="DTransferown.php">Transfer
                                                <span class="pull-right-container">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20" class="iconify" data-icon="dashicons:arrow-right-alt2" data-inline="false" style="transform: rotate(360deg);">
                                                        <path fill="currentColor" d="m6 15l5-5l-5-5l1-2l7 7l-7 7z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </a>
                                            <ul class="submenu">
                                                <li><a href="DTransferown.php">Own Bank Transfer</a></li>
                                                <li><a href="DTransferother.php">Other Bank Transfer</a></li>
                                            </ul>
                                        </li>
                                        <li class="navItem submenu"><a href="DSupport.php">Support</a></li>
                                        <li class="navItem submenu"><a href="">Settings</a></li>
                                        <li class="navItem"><a href="">Logout</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div>
                                        <h4>OWN BANK TRANSFER</h4>
                                    </div>
                                </div>

                            </div>
                            <div class="container">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="mb-3" style="margin-top: 20px;">
                                        <label>Account Number</label>
                                        <?php if (!empty($transfer_to_err)) {
                                            echo '<div class="alert alert-danger col-lg-4 p-2" style="text-align:center;">' . $transfer_to_err . '</div>';
                                        }
                                        ?>
                                        <input type="text" style="margin-top: 10px;" class="form-control" name="transfer_to">
                                    </div>
                                    <div class="mb-3" style="margin-top: 20px;">
                                        <label>Transfer Amount</label>
                                        <?php if (!empty($amount_err)) {
                                            echo '<div class="alert alert-danger col-lg-4 p-2" style="text-align:center;">' . $amount_err . '</div>';
                                        }
                                        ?>
                                        <input type="text" style="margin-top: 10px;" class="form-control" name="amount_transfer">
                                    </div>
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn buttColor" name="submit_transfer">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== footer Section ========== -->
    <?php include_once 'D_footer.php'; ?>
    <!-- ========== End Section ========== -->
</body>

</html>