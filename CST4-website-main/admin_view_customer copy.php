<?php

session_start();

if (isset($_SESSION['admin_login'])) {
    
} else header('location: admin_login.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.2.1-dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="default.css">
    <title>ACTIVE CUSTOMERS</title>
</head>

<body>

    <?php
    include 'admin_header.php';
    ?>
    <section>
        <div class="dashboardArea pt-150 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebaArea">
                            <div class="sidebarTopArea text-center">
                                <div class="userName">
                                    <h3><?php echo $row['name'];?></h3>
                                </div>
                            </div>
                            <div class="slidebarNavArea">
                                <nav>
                                    <ul>
                                        <li class="navItem"><a href="admin_dashboard.php">Dashboard</a></li>
                                        <li class="navItem active"><a href="admin_view_customer.php">View User</a></li>
                                        <li class="navItem"><a href="admin_pending_customers.php">View Pending Customer</a></li>
                                        <li class="navItem"><a href="">Settings</a></li>
                                        <li class="navItem"><a href="admin_logout.php">Logout</a></li>
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
                                        <h4>Active Users</h4>
                                    </div>
                                </div>
                                <div class="card" style="margin-top: 40px;">
                                    <div class="card-body table-responsive">
                                        <div class="table-loader text-center">
                                            <span class="loader" style="display: none;">
                                                <img src="https://e-bank.amcoders.com/frontend/assets/img/loader.gif" alt="" width="100">
                                            </span>
                                        </div>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Branch</th>
                                                    <th scope="col">Date Created</th>
                                                    <th scope="col">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody class="transactions">
                                                <?php
                                                $sql = "SELECT*FROM customers";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    $Sl_no = 1;
                                                    while ($row = $result->fetch_assoc()) {
                                                        $customer_id = $row['customer_id'];

                                                        echo '
                                                        <tr>
                                                            <td scope="col-2">' . $Sl_no++ . '</td>
                                                            <td scope="col-2">' . $row['name'] . '</td>
                                                            <td scope="col-2">' . $row['email'] . '</td>
                                                            <td scope="col-2">' . $row['branch'] . '</td>
                                                            <td scope="col-2">' . $row['date_created'] . '</td>
                                                            <td scope="col-2">
                                                                <div >
                                                                        <button class="btn btn-primary"><a href="admin_credit_customer.php?credit_cust='.$customer_id.'" style = "color:white";>Credit</a></button>
                                                                        <button class="btn btn-warning"><a href="admin_delete_customer.php?delete_cust='.$customer_id.'" style = "color:white";>Delete</a></button>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                    }
                                                }

                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once'admin_footer.php';?>

</body>

</html>
