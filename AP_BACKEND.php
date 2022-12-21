<?php
$name_err = $sex_err = $mobile_number_err = $email_err = $full_address_err = $date_of_birth_err = $branch_err = "";
if (isset($_POST['submit'])) {
    include 'config.php';

    if(empty(trim($_POST['name']))){
        $name_err = "Please enter a username";
    }else{
        $sql1 = "SELECT id FROM customers WHERE name = ?";

        if($stmt = mysqli_prepare($conn, $sql1)){
            mysqli_stmt_bind_param($stmt,"s",$param_name);
            $param_name = trim($_POST['name']);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)==1){
                    $name_err = "This username is already taken";
                }else{
                    $name = ($_POST['name']);
                }
            }
            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST['sex']))){
        $sex_err = "Please Enter Gender";
    }else{
        $sex = ($_POST['sex']);
    }

    if(empty(trim($_POST['mobile_number']))){
        $mobile_number_err = "Please Enter mobile number";
    }else{
        $mobile_number = ($_POST['mobile_number']);
    }

    if(empty(trim($_POST['email']))){
        $email_err = "Please Enter your email";
    }else{
        $email = ($_POST['email']);
    }

    if(empty(trim($_POST['full_address']))){
        $full_address_err = "Please Enter your full address";
    }else{
        $full_address = ($_POST['full_address']);
    }

    if(empty(trim($_POST['date_of_birth']))){
        $date_of_birth_err = "Please Enter your birthday";
    }else{
        $date_of_birth = ($_POST['date_of_birth']);
    }

    if(empty(trim($_POST['branch']))){
        $branch_err = "Please Enter your branch";
    }else{
        $branch =($_POST['branch']);
    }

    $application_num = rand(1000, 9999) . mt_rand(10000, 99999);

    if(empty($name_err)&&empty($sex_err)&&empty($mobile_number_err)&&empty($email_err)&&empty($full_address_err)&&empty($date_of_birth_err)&&empty($branch_err)){  
       
        $sql = "INSERT INTO pending_accounts (name, sex, mobile_number, email, full_address, date_of_birth, branch, application_num) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($conn, $sql))
        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $sex, $mobile_number, $email, $full_address, $date_of_birth, $branch, $application_num);

        if(mysqli_stmt_execute($stmt)){
            echo  '<script>alert("Application submitted successfully\n\nApplication number : ' . $application_num . '\n\nPlease visit bank with application number for account approval")
        location="index.php"</script>';
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_close($conn);
}


?>