<?php
    include 'config.php';  

if (isset($_GET['approve_cust'])) {
    $application_num = $_GET['approve_cust'];
    echo $application_num;
    //pagpangita japon sa table kung unsay match sa application number.
    $sql = "SELECT * FROM pending_accounts WHERE application_num = '$application_num' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //reassigning sa variables sa content sa table padong diri.
        $name = $row['name'];
        $sex = $row['sex'];
        $mobile_number = $row['mobile_number'];
        $email = $row['email'];
        $full_address = $row['full_address'];
        $date_of_birth = $row['date_of_birth'];
        $branch = $row['branch'];


        include 'config.php';
        //mao ni sya ang mugenerate ug unique customer id na magamit sa customer para magsend/transfer sa kapwa customer
        $sql = "SELECT MAX(customer_id) AS Last_Customer FROM customers";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            //last customer id aron dli magkaparehas ug ma id
            $Last_customer_ID = rand(100, 1000);
            $ifsc = 1011;
            $customer_id = $ifsc . $Last_customer_ID + 1;

            date_default_timezone_set('Asia/Kolkata');
            $ac_opening_date = date("d/m/y h:i:s A");

            $conn->autocommit(FALSE);

            //pag prepare ug assign na sa mga values sa pending account table padulong sa main customer table
            $sql1 = "INSERT INTO customers(name,sex,mobile_number,email,full_address,date_of_birth,branch,customer_id)
            VALUES('$name','$sex','$mobile_number','$email','$full_address','$date_of_birth','$branch','$customer_id')";

            //since na add naman ang pending user sa main oras na para idelete ang kato na user sa pending accounts
            $sql2 = "DELETE FROM pending_accounts WHERE application_num = '$application_num' ";

            //since na approve naman sya as customer buhatan nato sya ug table na para ra specific sa usa ka customer
            $sql3 = "CREATE TABLE passbook_$customer_id
					(id INT(255) AUTO_INCREMENT PRIMARY KEY, 
					Transaction_id VARCHAR(255) NULL,
					Transaction_date VARCHAR(255) NULL,
					Description VARCHAR(255) NULL,
					Cr_amount VARCHAR(255) NULL,
					Dr_amount VARCHAR(255) NULL,
					Net_Balance VARCHAR(255) NULL,
					Remark VARCHAR(255) NULL)";

            //kung mag true tanan ug walay error. icommit na niya ug assign/delete ang mga nasabing table sa taas. pag error kay irollback niya.
            if ($conn->query($sql1) == TRUE && $conn->query($sql2) == TRUE  && $conn->query($sql3) == TRUE) {

                $transaction_id = mt_rand(100, 999) . mt_rand(1000, 9999) . mt_rand(10, 99);

                $sql = "INSERT INTO passbook_$customer_id (Transaction_id,Transaction_date,Description,Cr_Amount,Dr_Amount,Net_Balance) 
						VALUES ('$transaction_id','$ac_opening_date','Account Opening','0','0','0') ";
                $conn->query($sql);

                $conn->commit();

                echo '<script>alert("Account Approved/ Created Successfully")
                location="admin_dashboard.php"</script>';
               
            } else {


                echo "Error Creating Account<br><br>" . $conn->error;
                $conn->rollback();
            }
        } else {

            echo $sql . "<br><br>" . $conn->error;
        }
    } else {

        echo '<script>alert(account not found)</script>';
    }
}
if(isset($_GET['delete_cust'])){
	include 'config.php';
    $application_num = $_GET['delete_cust'];
    $sql5 = "DELETE FROM pending_accounts WHERE application_num = '$application_num'";

    if($conn->query($sql5) == TRUE ){
        $conn->commit();
        echo '<script>alert("Customer Deleted Successfully")
        location="admin_dashboard.php"</script>';
    }
}

?>
