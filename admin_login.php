<?php

session_start();

if (isset($_SESSION['admin_login'])) {
    header('location: admin_dashboard.php');
}
include 'config.php';

    if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] === true) {
        header("location: admin_dashboard.php");
        exit;
    }
    $admin_username = $admin_password = "";
    $admin_username_err = $password_err = $login_err =  "";

    if (isset($_POST['staff_login-btn'])) {

        $select = mysqli_query($conn, "SELECT * FROM admin WHERE username = '" . $_POST['admin_username'] . "'");

        if (mysqli_num_rows($select)) {

            if (empty(trim($_POST["admin_username"]))) {
                $admin_username_err = "Please enter yout Account Number";
            } else {
                $admin_username = trim($_POST["admin_username"]);
            }

            if (empty(trim($_POST["admin_password"]))) {
                $password_err = "Please enter your password.";
            } else {
                $admin_password = trim($_POST["admin_password"]);
            }

            //pag pangita if mag match ang admin input sa database
            $sql = "SELECT * FROM admin WHERE username = '$admin_username'";
            $result = mysqli_query($conn, $sql);

            //pagkuha sa mga elements sa database

            while ($row = $result->fetch_assoc()) {

                if ($admin_username == $row['username']) {

                    if ($admin_password == $row['password']) {

                        $_SESSION['admin_login'] = true;
                        $_SESSION['admin_name'] = $row['name'];
                        $_SESSION['admin_username'] = $row['username'];
                        header('location:admin_dashboard.php');

                    }else $login_err = "Invalid Admin username or password.";

                } else $login_err = "Invalid Admin username or password.";
            }

        } else $login_err = "Invalid Admin username or password.";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.2.1-dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="default.css">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    <title>ADMIN LOGIN</title>
</head>

<body>

    <?php include_once 'admin_out_header.php'; ?>

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
                                <input style="margin-top: 10px;" type="text" name="admin_username" class="form-control" placeholder="Admin Username" required>
                            </div>
                            <div class="mb-3">
                                <input style="margin-top: 10px;" type="password" name="admin_password" class="form-control" placeholder="Password" required>
                                <div style="margin-top: 20px; text-align: center;">
                                    <button type="submit" class="btn submit-btn " name="staff_login-btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once 'admin_footer.php'; ?>

</body>
</html>