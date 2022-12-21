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
                  <h3>Cyril Charles O Alvez</h3>
                </div>
              </div>
              <div class="slidebarNavArea">
                <nav>
                  <ul>
                    <li class="navItem"><a href="Dashboard.php">Dashboard</a></li>
                    <li class="navItem"><a href="">Withdraw</a></li>
                    <li class="navItem"><a href="">Deposit</a></li>
                    <li class="navItem submenu">
                      <a href="DTransfer.php">Transfer
                        <span class="pull-right-container">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20" class="iconify" data-icon="dashicons:arrow-right-alt2" data-inline="false" style="transform: rotate(360deg);">
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
                    <li class="navItem submenu show active">
                      <a href="">Support
                        <span class="pull-right-container">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20" class="iconify" data-icon="dashicons:arrow-right-alt2" data-inline="false" style="transform: rotate(360deg);">
                              <path fill="currentColor" d="m6 15l5-5l-5-5l1-2l7 7l-7 7z">
                              </path>
                            </svg>
                        </span>
                      </a>
                      <ul class="submenu">
                        <li><a href="">Write a ticket</a></li>
                        <li><a href="">Contact Us</a></li>
                      </ul>
                    </li>
                    <li class="navItem submenu"><a href="">Settings</a></li>
                    <li class="navItem"><a href="">Logout</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </section>
  <!-- ========== End Section ========== -->
  <!-- ========== footer Section ========== -->s
  <?php include_once 'D_footer.php'; ?>
  <!-- ========== End Section ========== -->
</body>
</html>