<?php
session_start()

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PolomolokPublicMarket</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="icon" type="image/png" href="assets/imgbg/BGImage.png">
  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon"> -->
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Lightbox CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
  <!-- Lightbox JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

  <!-- Progressive Web Application -->
  <link rel="manifest" href="manifest.json">
  <script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('sw.js');
    };
  </script>

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">


</head>
<style>
  .display6 {
    margin-top: 4px;
    font-weight: 400;
    font-size: 1.2rem;
    /* Default for small devices */
  }

  @media (min-width: 320px) {

    /* Small devices (landscape phones, 576px and up) */
    .display6 {
      margin-top: 4px;
      font-weight: 300;
      font-size: 1rem;
    }
  }

  @media (min-width: 576px) {

    /* Small devices (landscape phones, 576px and up) */
    .display6 {
      margin-top: 4px;
      font-weight: 300;
      font-size: 1.5rem;
    }
  }

  @media (min-width: 768px) {

    /* Medium devices (tablets, 768px and up) */
    .display6 {
      margin-top: 4px;
      font-weight: 300;
      font-size: 1.5rem;
    }
  }

  @media (min-width: 992px) {

    /* Large devices (desktops, 992px and up) */
    .display6 {
      margin-top: 4px;
      font-weight: 300;
      font-size: 1.8rem;
    }
  }

  @media (min-width: 1200px) {

    /* Extra large devices (large desktops, 1200px and up) */
    .display6 {
      margin-top: 4px;
      font-weight: 300;
      font-size: 2rem;
    }
  }
</style>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <img src="assets/imgbg/BGImage.png" alt="Cannot Display Background Image">
        <h2 class="display6">Polomolok Public Market</h2>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="active">Homepage<br></a></li>
          <li class="dropdown"><a href="#hero"><span>Building Directory</span> <i
                class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="DirectoryMaps/BuildingA.php">Building A</a></li>
              <li><a href="DirectoryMaps/BuildingB.php">Building B</a></li>
              <li><a href="DirectoryMaps/BuildingC.php">Building C</a></li>
              <li><a href="DirectoryMaps/BuildingD.php">Building D</a></li>
              <li><a href="DirectoryMaps/BuildingE.php">Building E</a></li>
              <li><a href="DirectoryMaps/BuildingF.php">Building F</a></li>
              <li><a href="DirectoryMaps/BuildingG.php">Building G</a></li>
              <li><a href="DirectoryMaps/BuildingH.php">Building H</a></li>
              <li><a href="DirectoryMaps/BuildingI.php">Building I</a></li>
              <li><a href="DirectoryMaps/BuildingJ.php">Building J</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>

    </div>
  </header>
  <!--Login MOdal-->
  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Login Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php

          if (isset($_SESSION['status'])) {
            ?>
            <!-- Vertically centered modal -->
            <div class="alert alert-danger alert-dismissible fade show" role="alert" data-bs-backdrop="static"
              data-bs-keyboard="false">
              <?php echo $_SESSION['status']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['status']);
          }

          ?>
          <form method="POST" action="check_login2.php" id="login-form">
            <div class="form-floating mb-3">
              <input class="form-control" id="username" name="username" type="text" required
                placeholder="VendorChua21.com" />
              <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3 position-relative">
              <input class="form-control" id="password" name="password" type="password" required placeholder="Password">
              <label for="password">Password</label>
              <i class="bi bi-eye-slash position-absolute mt-3 end-0 pe-2" id="togglePassword"></i>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
              <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
              <a class="small" href="#">Forgot Password?</a>
            </div>
            <script>
              const togglePassword = document.querySelector('#togglePassword');
              const password = document.querySelector('#password');

              togglePassword.addEventListener('click', () => {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                togglePassword.classList.toggle('bi bi-eye-fill');

              });

            </script>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="login">Login</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <main class="main">


  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSide" aria-labelledby="offcanvasSideLabel">
  <br>
  <br>
  <style>
    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease; /* Added transition for box-shadow */
    }

    .card:hover {
      transform: scale(1.1);
      box-shadow: 0 0 15px rgba(0, 123, 255, 0.5); /* Glow effect with info color */
    }

    /* Ensure cards stack vertically */
    .vertical-cards .card {
      width: 100%; /* Full width to stack downward */
      margin-bottom: 20px; /* Space between cards */
    }

    .dropdown:hover .dropdown-menu {
    display: block;
      }

    .dropdown-menu {
          display: none; /* Initially hide the dropdown */
          position: absolute; /* Position the dropdown menu */
          z-index: 1000; /* Ensure the dropdown is above other elements */
      }
  </style>

  <div class="offcanvas-body">
    <div class="container">
      <!-- Use a column-based layout without flex to stack cards downward -->
      <div class="vertical-cards">

        <!-- Card for Restroom -->
        <div class="card">
          <div class="row g-0">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
              <img src="image/icons/toilet-gif.gif" class="img-fluid rounded-start" alt="Restroom" style="width: 50px; height: 50px;">
            </div>
            <div class="col-md-8">
              <div class="card-body d-flex justify-content-center align-items-center">
                <h5 class="card-title mt-2">Restroom</h5>
              </div>
            </div>
          </div>
        </div>
      
        <!-- Card for Exit -->
        <div class="card">
          <div class="row g-0">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
              <img src="image/icons/exit.gif" class="img-fluid rounded-start" alt="Exit" style="width: 50px; height: 50px;">
            </div>
            <div class="col-md-8">
              <div class="card-body d-flex justify-content-center align-items-center">
                <h5 class="card-title mt-2">Exit</h5>
              </div>
            </div>
          </div>
        </div>

        <!-- Card for Offices -->
        <div class="card">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <img src="image/icons/destination.gif" class="img-fluid rounded-start" alt="Office" style="width: 50px; height: 50px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h5 class="card-title mt-2">Office</h5>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="DirectoryMaps/Office1.php">Office 1</a></li>
                                <li><a class="dropdown-item" href="DirectoryMaps/Office2.php">Office 2</a></li>
                                <li><a class="dropdown-item" href="DirectoryMaps/Office3.php">Office 3</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </div>
  </div>
</div>

        <!-- Hero Section -->
    <section id="hero" class="hero section">

      <!-- <img src="assets/img/hero-bg-abstract.jpg" alt="BGImage" data-aos="fade-in" class=""> -->

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 col-lg-2 text-center">
            <h2>Building A</h2>
            <h5>Building Directory Wayfinder</h5>
            <h6>Building Description: chuchuchu</h6>

            <br>
            <br>
    
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSide" aria-controls="offcanvasSide">Actions</button>

            <iframe href="https://www.mappedin.com/" title="Mappedin Map" name="Mappedin Map" allow="clipboard-write; web-share" scrolling="no" width="100%" height="650" frameborder="0" style="border:0" src="https://app.mappedin.com/map/66f38d8142d0ac000b79d820?embedded=true"></iframe>
          </div>
        </div>
      
        
      </div>
      

    </section><!-- /Hero Section -->

        <div class="col-lg-11 col-md-1" data-aos="fade-up">
        
              
          </div>





     

  </main>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>


  <!-- Preloader -->
  <div id="preloader"></div>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>