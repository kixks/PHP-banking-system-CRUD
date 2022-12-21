<?php
include 'config.php';
session_start();
$account_number_err = "";
$deposit_amount_err = "";
$sql = "SELECT * FROM customers Where customer_id = $_SESSION[account_number]";
$account_num = $_SESSION['account_number'];
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
if(isset($_POST['submit_deposit'])){

    if(empty(trim($_POST["account_number"]))){
        $account_number_err = "Please Enter Account Number";
    }else if(trim($_POST['account_number']) != $account_num){
        $account_number_err = "The Account Number you entered doesnt match to your own account number";
    }else{
        $account_number = trim($_POST['account_number']);
    }

    if(empty(trim($_POST["deposit_amount"]))){
        $deposit_amount_err = "Please Enter Amount";
    }else{
        $deposit_amount = trim($_POST['deposit_amount']);
    }


    if(empty($account_number_err)&&empty($deposit_amount_err)) {
        $total_credit = $row['total_credit'] + $deposit_amount;
        $net_balance = $row['net_balance'] + $deposit_amount;

        $transaction_id = mt_rand(100, 999) . mt_rand(1000, 9999) . mt_rand(10, 99);

        date_default_timezone_set('Asia/Manila');
        $transaction_date = date("d/m/y h:i:s A");

        $remark = "Cash Deposit";

        $description = "Cash Deposit";

        $conn->autocommit(FALSE);

        $sql1 = "UPDATE customers SET net_balance = '$net_balance' WHERE customer_id = '$account_number' ";
        $sql2 = "UPDATE customers SET total_credit = '$total_credit' WHERE customer_id = '$account_number' ";

        $sql3 = "INSERT INTO passbook_$account_number(Transaction_id,Transaction_date,Description,Cr_amount,Dr_amount,Net_Balance,Remark)
        VALUES('$transaction_id','$transaction_date','$description','$deposit_amount','0','$net_balance','$remark')";

        if ($conn->query($sql1) == TRUE && $conn->query($sql2) == TRUE && $conn->query($sql3) == TRUE) {
            $conn->commit();
            echo '<script>alert("Deposit Successfull")
                 location="DepositPage.php"</script>';
        } else {
            echo '<script>alert("Transaction failed\n\nReason:\n\n' . $conn->error . '")</script>';
            $conn->rollback();
        }
    }

}
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
                                        <li class="navItem active"><a href="DepositPage.php">Deposit</a></li>
                                        <li class="navItem submenu">
                                            <a href="DTransferown.php">Transfer
                                                <span class="pull-right-container">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                        focusable="false" width="1em" height="1em"
                                                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"
                                                        class="iconify" data-icon="dashicons:arrow-right-alt2"
                                                        data-inline="false" style="transform: rotate(360deg);">
                                                        <path fill="currentColor" d="m6 15l5-5l-5-5l1-2l7 7l-7 7z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </a>
                                            <ul class="submenu">
                                                <li><a href="">Own Bank Transfer</a></li>
                                                <li><a href="">Other Bank Transfer</a></li>
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
                                        <h4>DEPOSIT</h4>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="container">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="mb-3" style="margin-top: 20px;">
                                        <label>Account Number</label>
                                        <?php if (!empty($account_number_err)) {echo '<div class="alert alert-danger col-lg-4 p-2" style="text-align:center;">' . $account_number_err . '</div>';}
                                        ?>
                                        <input type="text" style="margin-top: 10px;" class="form-control" name="account_number">
                                    </div>
                                    <div class="mb-3" style="margin-top: 20px;">
                                        <label>Deposit Amount</label>
                                        <?php if (!empty($deposit_amount_err)) {echo '<div class="alert alert-danger col-lg-4 p-2" style="text-align:center;">' . $deposit_amount_err . '</div>';}?>                                      
                                        <input type="text" style="margin-top: 10px;" class="form-control" name="deposit_amount">
                                    </div>
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn buttColor" name="submit_deposit">Submit</button>
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