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

  <section class="backgroundForhome">
    <div class="pt-150 pb-100">
      <div class="container" id="homestyle">
        <h1>NORTHLAND BANK</h1><br>
        <div class="container p-5">
          <p><span>"<span> Where Savings and Investing are made Simplier and Better <span>"<span></p>
          <div class="container p-5 startnow"><button class="loginbutton"><a href="applicationPage.php">START BANKING
                WITH US NOW</a></button></div>
        </div>

      </div>
    </div>
  </section>

  <main id="main">
    <section id="Services" class="bgservice">
      <div class="container servicePadding">
        <div class="row align-items-center plr-100">
          <div class="col-lg-6 plr-100 sectionLetter">
            <h1>Services We Offer</h1><br>
            <ul>
              <li>Less Hassle Online Banking</li><br>
              <li>Incentives</li><br>
              <li>Debit & Credit Cards</li><br>
              <li>Insurance</li><br>
              <li>Wealth management</li><br>
            </ul>
          </div>
          <div class="col-lg-6 plr-100">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                  <img src="Pictures/Background1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                  <img src="Pictures/crsl2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="Pictures/crsl4.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="About" class="backgroundForhome">
      <div class="container servicePadding">
        <div class="row align-items-center plr-100">
          <div class="container" id="center">
            <h1>ABOUT US</h1>
            <p> Our company is absolute in giving our clients the best services by offering a hassle-free money
              transactions. Our aim is to simply provide a dynamic act of securing our customers assets with honesty in
              exchange for their trust. Making customers be our first priority with the wealthy management and offering
              incentives that they can get benefits.</p>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- ========== End Section ========== -->

  <!-- ========== footer Section ========== -->
  <?php include_once 'footer.php'; ?>
  <!-- ========== End Section ========== -->

</body>
</html>