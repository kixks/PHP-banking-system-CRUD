<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.2.1-dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="default.css">
    <title>CONFIRM DELETE CUSTOMERS</title>
</head>

<body>
    <table border="1px" cellpadding="10">
        <th>#</th>
        <th>CUSTOMER ID</th>
        <th>CUSTOMER NAME</th>
        <th>GENDER</th>
        <th>MOBILE NUMBER</th>
        <th>EMAIL</th>
        <th>FULL ADDRESS</th>
        <th>DATE OF BIRTH</th>
        <th>BRANCH</th>
        <th>DATE CREATED</th>
        <th>NET BALANCE</th>


        <?php
        include 'config.php';
        $customer_id = $_GET['delete_cust'];
        $sql = "SELECT*FROM customers WHERE customer_id = '$customer_id' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $Sl_no = 1;
            while ($row = $result->fetch_assoc()) {
                $customer_id = $row['customer_id'];

                echo '
                        <tr>
                        <td>' . $Sl_no++ . '</td>
                        <td>' . $row['customer_id'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['sex'] . '</td>
                        <td>' . $row['mobile_number'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['full_address'] . '</td>
                        <td>' . $row['date_of_birth'] . '</td>
                        <td>' . $row['branch'] . '</td>
                        <td>' . $row['date_created'] . '</td> 
                        <td>' . $row['net_balance'] . '</td> 
                        </tr>';
            }
        }
        ?>
    </table>
        <form action="" method="post">
            <label for="">CONFIRM DELETING?</label>
            <button class="btn btn-primary" name="confirm_delete">CONFIRM</button>
            <button class="btn btn-secondary"><a href="admin_view_customer.php">CANCEL</a></button>
        </form>
</body>

</html>
<?php
include 'config.php';
if(isset($_POST['confirm_delete'])){
    $customer_id = $_GET['delete_cust'];
    $sql1 = "DELETE FROM customers WHERE customer_id = '$customer_id'";
    $sql2 = "DROP TABLE passbook_$customer_id";

    if( ($conn->query($sql1)  && $conn->query($sql2)) == TRUE ){
        $conn->commit();
        echo '<script>alert("Customer Deleted Successfully")
        location="admin_view_customer.php"</script>';
    }
    else{
        $conn->rollback();
        echo '<script>alert("Customer not deleted")
        location="admin_view_customer.php"</script>';
    }
    
}

?>
