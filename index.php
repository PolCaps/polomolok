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
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>
  <style>
      .display6 {
        margin-top: 4px;
        font-weight: 400;
        font-size: 1.2rem; /* Default for small devices */
      }
      @media (min-width: 320px) { /* Small devices (landscape phones, 576px and up) */
        .display6 {
          margin-top: 4px;
          font-weight: 300;
          font-size: 1rem;
        }
      }
      @media (min-width: 576px) { /* Small devices (landscape phones, 576px and up) */
        .display6 {
          margin-top: 4px;
          font-weight: 300;
          font-size: 1.5rem;
        }
      }
      @media (min-width: 768px) { /* Medium devices (tablets, 768px and up) */
        .display6 {
          margin-top: 4px;
          font-weight: 300;
          font-size: 1.5rem;
        }
      }
      @media (min-width: 992px) { /* Large devices (desktops, 992px and up) */
        .display6 {
          margin-top: 4px;
          font-weight: 300;
          font-size: 1.8rem;
        }
      }
      @media (min-width: 1200px) { /* Extra large devices (large desktops, 1200px and up) */
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
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li class="dropdown"><a href="#services"><span>Maps</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="ABuildingA.html">Building A</a></li>
              <li><a href="ABuildingB.html">Building B</a></li>
              <li><a href="ABuildingC.html">Building C</a></li>
              <li><a href="ABuildingD.html">Building D</a></li>
              <li><a href="ABuildingE.html">Building E</a></li>
              <li><a href="ABuildingF.html">Building F</a></li>
              <li><a href="ABuildingG.html">Building G</a></li>
              <li><a href="ABuildingH.html">Building H</a></li>
              <li><a href="ABuildingI.html">Building I</a></li>
              <li><a href="ABuildingJ.html">Building J</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>

    </div>
  </header>
  <!--Login MOdal-->
  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Login Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php 
              
              if (isset($_SESSION['status'])) 
              {
                  ?>
                    <!-- Vertically centered modal -->
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" data-bs-backdrop="static" data-bs-keyboard="false">
                    <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php
                  unset($_SESSION['status']);
              }
              
              ?>
                <form method="POST" action="check_login2.php" id="login-form">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="username" name="username" type="text" required placeholder="VendorChua21.com" />
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
                        const type = password.getAttribute('type') === 'password'? 'text' : 'password';
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
        <!-- Hero Section -->
    <section id="hero" class="hero section">

      <img src="assets/img/hero-bg-abstract.jpg" alt="" data-aos="fade-in" class="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-out">
          <div class="col-xl-7 col-lg-9 text-center">
            <h1>Bagong Polomolok, Padayon Polomolok!</h1>
            <p>Municipal Economic Enterprise and Development Office</p>
          </div>
        </div>
        <div class="text-center" data-aos="zoom-out" data-aos-delay="100">
          <a href="#about" class="btn-get-started bg-warning">Get Started</a>
        </div>

        <div class="row gy-4 mt-5">
          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-archive"></i></div>
              <h4 class="title"><a href="">Fresh Products</a></h4>
              <p class="description">Quality of fresh produce available at the marketplace, directly sourced from local farms.</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-basket"></i></div>
              <h4 class="title"><a href="">Wide Selections</a></h4>
              <p class="description">Showcasing the diversity of products offered, from local delicacies to everyday necessities.</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-cash"></i></i></div>
              <h4 class="title"><a href="">Product's Affordability</a></h4>
              <p class="description">marketplace's competitive prices, allowing visitors to find good deals on various products.</p>
            </div>
          </div><!--End Icon Box -->

          <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-person-arms-up"></i></div>
              <h4 class="title"><a href="">Entrepreneurial Spirit</a></h4>
              <p class="description">Showcasing Polomolok's Public Market role in supporting local businesses and entrepreneurs.</p>
            </div>
          </div><!--End Icon Box -->

        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us<br></h2>
        <p>
          This public market is very easy to access by public transportation. 
          Where you can find affordable goods, fruits and different root crops. 
          This building is currently improved with the local government.  Located at French Street  Polomolok, South Cotabato. 
          There are a lot of thing to do in Polomolok South Cotabato, all you need to do is to enjoy the town for their rich culture and attraction as well.
        </p>
      </div><!-- End Section Title -->


      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p>
            Polomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public Market  
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> <span>We sells goods sheets</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Good Things</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Yummy Foodies</span></li>
            </ul>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <p>Polomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public Market</p>
            <a href="#" class="read-more bg-warning"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>

        </div>

      </div>

      </section><!-- /About Section -->
          
      <?php
          include('database_config.php');
          $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          $sql = "SELECT buildings, overall_stalls, vendors, workers FROM pagebuilder_table WHERE stats_id = 1";
          $result = $conn->query($sql);
                  
          if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          } else {
          echo "No data found";
          }
          $conn->close();
      ?>
  

          <!-- Stats Section -->
          <section id="stats" class="stats section">

          <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row gy-4">
          <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $row['buildings'];?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Buildings</p>
          </div>
          </div><!-- End Stats Item -->
          <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $row['overall_stalls'];?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Overall Stalls</p>
          </div>
          </div><!-- End Stats Item -->
          <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $row['vendors'];?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Vendors</p>
          </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $row['workers'];?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Workers</p>
          </div>
          </div><!-- End Stats Item -->
        </div>
      </div>
    </section>


    <!-- Announcements Section -->
<section id="announcements" class="announcements section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Announcements</h2>
  <p>Stay updated with the latest news and events</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
    <script type="application/json" class="swiper-config">
      {
        "loop": true,
        "speed": 600,
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": "auto",
        "pagination": {
          "el": ".swiper-pagination",
          "type": "bullets",
          "clickable": true
        },
        "breakpoints": {
          "320": {
            "slidesPerView": 1,
            "spaceBetween": 40
          },
          "1200": {
            "slidesPerView": 3,
            "spaceBetween": 20
          }
        }
      }
    </script>
    <div class="swiper-wrapper">

      <div class="swiper-slide">
        <div class="announcement-item">
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>Check out our latest events happening this week!</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
          <img src="image/notice.jpg" class="announcement-img" alt="Event 1" style="width: 220px; height: 280px;" >
          <h3>Stall 1</h3>
          <h4>Building E</h4>
        </div>
      </div><!-- End announcement item -->

      <div class="swiper-slide">
        <div class="announcement-item">
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>Important updates about our services.</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
          <img src="image/notice.jpg" class="announcement-img" alt="Update 1" style="width: 220px; height: 280px;">
          <h3>stall 22</h3>
          <h4>Building J</h4>
        </div>
      </div><!-- End announcement item -->

      <div class="swiper-slide">
        <div class="announcement-item">
          <p>
            <i class="bi bi-quote quote-icon-left"></i>
            <span>Join us for our upcoming webinar.</span>
            <i class="bi bi-quote quote-icon-right"></i>
          </p>
          <img src="image/notice.jpg" class="announcement-img" alt="Webinar" style="width: 220px; height: 280px;">
          <h3>stall 67</h3>
          <h4>Building C</h4>
        </div>
      </div><!-- End announcement item -->

      <!-- Add more announcements as needed -->

    </div>
    <div class="swiper-pagination"></div>
  </div>

</div>
</section><!-- End Announcements Section -->

    
    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item" "="">
            <p>
              <i class=" bi bi-quote quote-icon-left"></i>
                <span>Super clean and well-maintained. One of the best public markets in the province. Super cheap veggies and fruits from nearby farms. Market day is Saturday when the place is packed with vendors selling fresh produce from all over.</span>
                <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="image/review/avelmanansala.png" class="testimonial-img" alt="photo">
                <h3>Avel Manansala</h3>
                <h4>Influencer &amp; Blogger</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Market's Map</h2>
        <p>Polomolok Public Market's Maps</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                </svg>
                <i class="bi bi-activity"></i>
              </div>
              <a href="BuildingE.html" class="stretched-link">
                <h3>Building A</h3>
              </a>
              <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                </svg>
                <i class="bi bi-broadcast"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Building B</h3>
              </a>
              <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item item-teal position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,251.2091493199835,5.337323636656869,175.0934190732945,40.62881213300186C97.87086631185822,76.43348514350839,51.98124368387456,156.15599469081315,36.44837278890362,239.84606092416172C21.716077023791087,319.22268207091537,43.775223500013084,401.1760424656574,96.891909868211,461.97329694683043C147.22146801428983,519.5804099606455,223.5754009179313,538.201503339737,300,541.5067337569781"></path>
                </svg>
                <i class="bi bi-easel"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Building C</h3>
              </a>
              <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item item-red position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,503.46388370962813C374.79870501325706,506.71871716319447,464.8034551963731,527.1746412648533,510.4981551193396,467.86667711651364C555.9287308511215,408.9015244558933,512.6030010748507,327.5744911775523,490.211057578863,256.5855673507754C471.097692560561,195.9906835881958,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C329.3053358748298,57.3949838291264,248.02791733380457,8.279543830951368,175.87071277845988,42.242879143198664C103.41431057327972,76.34704239035025,93.79494320519305,170.9812938413882,81.28167332365135,250.07896920659033C70.17666984294237,320.27484674793965,64.84698225790005,396.69656628748305,111.28512138212992,450.4950937839243C156.20124167950087,502.5303643271138,231.32542653798444,500.4755392045468,300,503.46388370962813"></path>
                </svg>
                <i class="bi bi-bounding-box-circles"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Building D</h3>
              </a>
              <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
              <a href="service-details.html" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item item-indigo position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,532.3542879108572C369.38199826031484,532.3153073249985,429.10787420159085,491.63046689027357,474.5244479745417,439.17860296908856C522.8885846962883,383.3225815378663,569.1668002868075,314.3205725914397,550.7432151929288,242.7694973846089C532.6665558377875,172.5657663291529,456.2379748765914,142.6223662098291,390.3689995646985,112.34683881706744C326.66090330228417,83.06452184765237,258.84405631176094,53.51806209861945,193.32584062364296,78.48882559362697C121.61183558270385,105.82097193414197,62.805066853699245,167.19869350419734,48.57481801355237,242.6138429142374C34.843463184063346,315.3850353017275,76.69343916112496,383.4422959591041,125.22947124332185,439.3748458443577C170.7312796277747,491.8107796887764,230.57421082200815,532.3932930995766,300,532.3542879108572"></path>
                </svg>
                <i class="bi bi-calendar4-week icon"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Building E</h3>
              </a>
              <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
              <a href="service-details.html" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item item-pink position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,566.797414625762C385.7384707136149,576.1784315230908,478.7894351017131,552.8928747891023,531.9192734346935,484.94944893311C584.6109503024035,417.5663521118492,582.489472248146,322.67544863468447,553.9536738515405,242.03673114598146C529.1557734026468,171.96086150256528,465.24506316201064,127.66468636344209,395.9583748389544,100.7403814666027C334.2173773831606,76.7482773500951,269.4350130405921,84.62216499799875,207.1952322260088,107.2889140133804C132.92018162631612,134.33871894543012,41.79353780512637,160.00259165414826,22.644507872594943,236.69541883565114C3.319112789854554,314.0945973066697,72.72355303640163,379.243833228382,124.04198916343866,440.3218312028393C172.9286146004772,498.5055451809895,224.45579914871206,558.5317968840102,300,566.797414625762"></path>
                </svg>
                <i class="bi bi-chat-square-text"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Building F</h3>
              </a>
              <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
              <a href="service-details.html" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item item-red position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,503.46388370962813C374.79870501325706,506.71871716319447,464.8034551963731,527.1746412648533,510.4981551193396,467.86667711651364C555.9287308511215,408.9015244558933,512.6030010748507,327.5744911775523,490.211057578863,256.5855673507754C471.097692560561,195.9906835881958,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C329.3053358748298,57.3949838291264,248.02791733380457,8.279543830951368,175.87071277845988,42.242879143198664C103.41431057327972,76.34704239035025,93.79494320519305,170.9812938413882,81.28167332365135,250.07896920659033C70.17666984294237,320.27484674793965,64.84698225790005,396.69656628748305,111.28512138212992,450.4950937839243C156.20124167950087,502.5303643271138,231.32542653798444,500.4755392045468,300,503.46388370962813"></path>
                </svg>
                <i class="bi bi-bounding-box-circles"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Building G</h3>
              </a>
              <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
              <a href="service-details.html" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item item-indigo position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,532.3542879108572C369.38199826031484,532.3153073249985,429.10787420159085,491.63046689027357,474.5244479745417,439.17860296908856C522.8885846962883,383.3225815378663,569.1668002868075,314.3205725914397,550.7432151929288,242.7694973846089C532.6665558377875,172.5657663291529,456.2379748765914,142.6223662098291,390.3689995646985,112.34683881706744C326.66090330228417,83.06452184765237,258.84405631176094,53.51806209861945,193.32584062364296,78.48882559362697C121.61183558270385,105.82097193414197,62.805066853699245,167.19869350419734,48.57481801355237,242.6138429142374C34.843463184063346,315.3850353017275,76.69343916112496,383.4422959591041,125.22947124332185,439.3748458443577C170.7312796277747,491.8107796887764,230.57421082200815,532.3932930995766,300,532.3542879108572"></path>
                </svg>
                <i class="bi bi-calendar4-week icon"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Building H</h3>
              </a>
              <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
              <a href="service-details.html" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item item-pink position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,566.797414625762C385.7384707136149,576.1784315230908,478.7894351017131,552.8928747891023,531.9192734346935,484.94944893311C584.6109503024035,417.5663521118492,582.489472248146,322.67544863468447,553.9536738515405,242.03673114598146C529.1557734026468,171.96086150256528,465.24506316201064,127.66468636344209,395.9583748389544,100.7403814666027C334.2173773831606,76.7482773500951,269.4350130405921,84.62216499799875,207.1952322260088,107.2889140133804C132.92018162631612,134.33871894543012,41.79353780512637,160.00259165414826,22.644507872594943,236.69541883565114C3.319112789854554,314.0945973066697,72.72355303640163,379.243833228382,124.04198916343866,440.3218312028393C172.9286146004772,498.5055451809895,224.45579914871206,558.5317968840102,300,566.797414625762"></path>
                </svg>
                <i class="bi bi-chat-square-text"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Building I</h3>
              </a>
              <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
              <a href="service-details.html" class="stretched-link"></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item item-pink position-relative">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,566.797414625762C385.7384707136149,576.1784315230908,478.7894351017131,552.8928747891023,531.9192734346935,484.94944893311C584.6109503024035,417.5663521118492,582.489472248146,322.67544863468447,553.9536738515405,242.03673114598146C529.1557734026468,171.96086150256528,465.24506316201064,127.66468636344209,395.9583748389544,100.7403814666027C334.2173773831606,76.7482773500951,269.4350130405921,84.62216499799875,207.1952322260088,107.2889140133804C132.92018162631612,134.33871894543012,41.79353780512637,160.00259165414826,22.644507872594943,236.69541883565114C3.319112789854554,314.0945973066697,72.72355303640163,379.243833228382,124.04198916343866,440.3218312028393C172.9286146004772,498.5055451809895,224.45579914871206,558.5317968840102,300,566.797414625762"></path>
                </svg>
                <i class="bi bi-chat-square-text"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Building J</h3>
              </a>
              <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
              <a href="service-details.html" class="stretched-link"></a>
            </div>
          </div>
          
        </div>

        </div>

    </section><!-- /Services Section -->
  

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Interested In Owning a stall?</h3>
              <p>Occupy the stalls with your own liking!</p>
              <a class="cta-btn" data-bs-toggle="modal" data-bs-target="#vendorApplicationModal">Click Here</a>
            </div>
          </div>
        </div>
      </div>
      

      

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </section><!-- /Call To Action Section -->

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Polomolok Public MarketPolomolok Public MarketPolomolok Public MarketPolomolok Public Market</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d942.5222608622341!2d125.06276232580936!3d6.218783400539062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f79aeb6397bd25%3A0xa66c04988ca5666a!2sPolomolok%20Public%20Market!5e1!3m2!1sen!2sph!4v1717487773031!5m2!1sen!2sph" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>6397+H37, French St, Polomolok, South Cotabato</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>083 2252483</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>info@example.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="inquiry_data.php" method="post"  data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">

                  <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                    <label for="name">Your Name</label>
                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email_add" placeholder="Email Address" required>
                    <label for="name">Email Address</label>
                  </div>

                </div>

                <div class="col-md-12">

                  <div class="form-floating mb-3">
                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required>
                    <label for="subject">Subject</label>
                  </div>
                
                </div>

                <div class="col-md-12">
                
                  <div class="form-floating mb-3">
                    <textarea class="form-control" style="height: 150px" name="message" placeholder="Message" id="message" required></textarea>
                    <label for="message">Message</label>
                  </div>
                  
                  

                </div>

                <div class="col-md-12 text-center">
                
                <?php if (isset($_SESSION['alert_class']) && isset($_SESSION['alert_message'])): ?>
            <div class="alert <?php echo $_SESSION['alert_class']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['alert_message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                  <?php
                  unset($_SESSION['alert_class']);
                  unset($_SESSION['alert_message']);
                  ?>
                  <?php endif; ?>
                

                <button type="submit" class="btn btn-warning text-white">Send Message</button>
                </div>
                

              </div>
            </form>
          </div><!-- End Contact Form -->
    <!-- Include Bootstrap JS and Popper.js for toast functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

        </div>
      </div>

      <div class="modal fade" id="vendorApplicationModal" tabindex="-1" aria-labelledby="vendorApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vendorApplicationModalLabel">Rent Application Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="vendorApplicationForm" action="submit_application.php" method="POST">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Personal Details -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" id="first_name" class="form-control" name="first_name" required>
                                    <div class="invalid-feedback">Please enter your first name.</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="middle_name">Middle Name:</label>
                                    <input type="text" id="middle_name" class="form-control" name="middle_name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" id="last_name" class="form-control" name="last_name" required>
                                    <div class="invalid-feedback">Please enter your last name.</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="contact_number">Contact Number:</label>
                                    <input type="tel" id="contact_number" class="form-control" name="contact_number" required>
                                    <div class="invalid-feedback">Please enter your contact number.</div>
                                </div>
                            </div>
                            <!-- Business Details -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="age">Age:</label>
                                    <input type="number" id="age" class="form-control" name="age">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" class="form-control" name="email" required>
                                    <div class="invalid-feedback">Please enter your email.</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address">Address:</label>
                                    <textarea id="address" name="address" class="form-control" required></textarea>
                                    <div class="invalid-feedback">Please enter your address.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-primary d-flex align-items-center" role="alert">
                                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                                    <div>
                                        Submitting the form will download the rent application. Please fill it up and submit it online to our email address or walk into our office.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <div>
                                        Filling up this form does not reserve a stall booth and doesn't guarantee that you will occupy the stall. Please Message us for clarification and inquiries.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer my-2" style="align-items: center; justify-content: center;">
            <div id="alertContainer"></div>
                <button type="button" class="btn btn-primary text-white" id="submitApplicationBtn">Submit Application</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="alertContainer"></div>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#submitApplicationBtn').click(function(e) {
        e.preventDefault();

        // Clear previous alerts
        $('#alertContainer').empty();

        // Submit form via AJAX
        var formData = $('#vendorApplicationForm').serialize();

        $.ajax({
            type: 'POST',
            url: $('#vendorApplicationForm').attr('action'),
            data: formData,
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    // Success alert
                    $('#alertContainer').append(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Application submitted successfully. Please download and fill the rent application form.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);

                    // Trigger file download
                    var downloadUrl = 'DocumentFiles/RentApplication.docx'; // Replace with the actual path to the file
                    var a = document.createElement('a');
                    a.href = downloadUrl;
                    a.download = 'RentApplication.docx';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    document.getElementById('vendorApplicationForm').reset();
                } else {
                    // Error alert
                    $('#alertContainer').append(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> ${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // AJAX error alert
                $('#alertContainer').append(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> An error occurred. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
                console.error('AJAX error:', textStatus, errorThrown);
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>


    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">
    <div class="container footer-top">
      <div class="row gy-4">
        <img src="assets/imgbg/BGImage.png" alt="" style="width: 220px; height: 190px;">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.php" class="logo d-flex align-items-center">
            
            <span class="sitename">Polomolok Public Market</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Products Selling</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Product Management</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>6397+H37, French St.</p>
          <p>Polomolok South Cotabato</p>
          <p>Philippines</p>
          <p class="mt-4"><strong>Phone:</strong> <span>083 2252483</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Polomolok Public Market</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by The Students of STI - Sayre, Samontanes, Panaguiton, Chua</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


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