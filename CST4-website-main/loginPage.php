<?php include_once 'config.php';

session_start();
if (isset($_SESSION['client_login']) && $_SESSION['client_login'] === true) {
    header("location: dashboard.php");
    exit;
}

$account_number = $password = "";
$account_number_err = $password_err = $login_err = "";

if (isset($_POST['submit'])) {

    $select = mysqli_query($conn, "SELECT * FROM customers WHERE customer_id = '".$_POST['account_number']."'");

    if (mysqli_num_rows($select)) {

        if (empty(trim($_POST["account_number"]))) {
            $account_number_err = "Please enter yout Account Number";
        } else {
            $account_number = trim($_POST["account_number"]);
        }
    
    
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }
        
        $sql = "SELECT * FROM customers WHERE customer_id ='$account_number'";  
        $result = mysqli_query($conn, $sql);
    
        while ($row = $result->fetch_assoc()) {
    
            $hashed_password = $row['password'];
    
            if ($account_number == $row['customer_id']) {
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['client_login'] = true;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['account_number'] = $row['customer_id'];
                    header('location:dashboard.php');
                } else $login_err = "Invalid Account Number or password.";
            } else $login_err = "Invalid Account Number or password.";
        }
    } else $login_err = "Invalid Account Number or password.";
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
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    <title>Northland Bank</title>

</head>

<body>
    <!-- ========== Nav bar ========== -->
    <?php include_once 'header.php'; ?>
    <!-- ========== End Section ========== -->

    <!-- ========== Dashboard area ========== -->

    <section class="dashboardArea">
        <div class="pt-150 pb-100">
            <div class="container">
                <div class="col-lg-6 offset-lg-3">
                    <div class="col-lg-12 text-center" style="color: #37517eeb;">
                        <h1>LOG IN</h1>
                    </div>
                    <?php
                    if (!empty($login_err)) {
                        echo '<div class="alert alert-danger col-lg-12" style="text-align:center;">' . $login_err . '</div>';
                    }
                    ?>
                    <div class="container">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="mb-3" style="margin-top: 20px;">
                                <input style="margin-top: 10px;" type="text" name="account_number" class="form-control" placeholder="Account Number" required>

                            </div>
                            <div class="mb-3">
                                <input style="margin-top: 10px;" type="password" name="password" class="form-control" placeholder="Password" required>
                                <div style="margin-top: 20px; text-align: center;">
                                    <button type="submit" class="btn submit-btn " name="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========== End Section ========== -->
    <!-- ========== footer Section ========== -->
    <?php include_once 'footer.php'; ?>
    <!-- ========== End Section ========== -->
</body>

</html>