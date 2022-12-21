<html>

<head>
    <title>CREDIT CUSTOMER</title>
</head>

<body>
    <form action="" method="post">
        <label for="">ENTER AMOUNT TO CREDIT</label>
        <input class="customer" type="text" name="credit_amount" placeholder="Amount" required><br>
        <input class="customer" type="submit" name="credit_btn" value="Credit">
        <button class="btn btn-secondary"><a href="admin_view_customer.php">CANCEL</a></button>
    </form>
</body>

</html>

<?php
if (isset($_POST['credit_btn'])) {
    $customer_id = $_GET['credit_cust'];
    $credit_amount = $_POST['credit_amount'];

    if (!is_numeric($_POST['credit_amount'])) {
        echo '<script>alert("Invalid amount")</script>';
    } else {
        include 'config.php';
        $sql = "SELECT * FROM customers WHERE customer_id = '$customer_id' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $net_balance = $row['net_balance'] + $credit_amount;

            $transaction_id = mt_rand(100, 999) . mt_rand(1000, 9999) . mt_rand(10, 99);

            date_default_timezone_set('Asia/Kolkata');
            $transaction_date = date("d/m/y h:i:s A");

            $remark = "Cash Deposit";

            $description = "Cash Deposit";

            $conn->autocommit(FALSE);

            $sql1 = "UPDATE customers SET net_balance = '$net_balance' WHERE customer_id = '$customer_id' ";

            $sql2 = "INSERT INTO passbook_$customer_id(Transaction_id,Transaction_date,Description,Cr_amount,Dr_amount,Net_Balance,Remark)
        VALUES('$transaction_id','$transaction_date','$description','$credit_amount','0','$net_balance','$remark')";

            if ($conn->query($sql1) == TRUE && $conn->query($sql2) == TRUE) {
                $conn->commit();
                echo '<script>alert("Customer Credited Successfully")
                location="admin_view_customer.php"</script>';
               
               
                
            } else {
                echo '<script>alert("Transaction failed\n\nReason:\n\n' . $conn->error . '")</script>';
                $conn->rollback();
            }
            
        }
    }
}
?>
