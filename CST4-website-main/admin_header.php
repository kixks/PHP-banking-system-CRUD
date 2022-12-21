<?php
if ($_SESSION['admin_login'] != true) {
}

?>

<html>

<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
    <?php
    include 'config.php';
    //normal select rani sya dinhi aron madisplay ang info sa admin (eg.name).
    $admin_username = $_SESSION['admin_username'];
    $sql = "SELECT * FROM admin WHERE username= '$admin_username' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
        $row = $result->fetch_assoc();

    ?>

    <header>
    <div class="headerArea fixed">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 d-flex flex-wrap justify-content-center justify-content-lg-start">
                    <h3>Northland Bank - <span style="font-size: 15px;">ADMIN</span></h3>
                </div>
                <div class="col-lg-9 d-flex flex-wrap justify-content-center justify-content-lg-end">
                    <div class="headerRightArea">
                        <div class="headerMenu f-right">
                            <nav>
                                <ul>
                                    <li><a href="admin_dashboard.php">Home</a></li>
                                    <li><a href="admin_logout.php">Logout</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
</html>