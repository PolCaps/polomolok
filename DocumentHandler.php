<?php
include('Sessions/DocumentHandler.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets2/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/imgbg/BGImage.png">
  <title>
    Document Monitoring
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets2/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets2/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets2/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets2/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-list"
          viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg>
        <span class="ms-2 font-weight-bold">Menu</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="DocumentHandler.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-primary text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-shop"
                viewBox="0 0 16 16">
                <path
                  d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="DHMVendorDocuments.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-file-earmark-medical" viewBox="0 0 16 16">
                <path
                  d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z" />
                <path
                  d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Vendor's Document</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 mt-5">
      <div class="card card-background shadow-none card-background-mask-info" id="sidenavCard">
        <div class="full-background" style="background-image: url('assets2/img/curved-images/white-curved.jpg')"></div>
        <div class="card-body text-start p-3 w-100">
          <img src="image/profile.jpg" alt="profile"
            style="min-width: 20px; min-height: 20px; height: 100px; width: 100px; border-radius: 10px; margin-left: 40px;">
          <h5 class="text-center">
            <?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['middle_name']) . ' ' . htmlspecialchars($user['last_name']); ?>
          </h5>
          <hr class="horizontal dark mt-0">
        </div>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Document Handler</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Modules</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Search for...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Document Handler</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row mt-4">
        <div class="col-lg-5 mb-lg-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-lg text-info mb-3 text-start mx-2">Staff Profile</h5>
              <div class="row">
              <div class="col-md-4">
                  <?php
                  // Check if the user has a profile picture set; if not, use a default image
                  $profilePicture = !empty($user['picture_profile']) ? $user['picture_profile'] : 'image/profile.jpg';
                  ?>
                  <img src="<?php echo htmlspecialchars($profilePicture); ?>" class="img-fluid rounded-circle"
                    alt="Admin Profile Picture" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <div class="col-md-8 my-3">
                  <h6 class="card-subtitle mb-2 text-muted">Name:
                    <?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['middle_name']) . ' ' . htmlspecialchars($user['last_name']); ?>
                  </h6>
                  <p class="card-text">Username: <?php echo htmlspecialchars($user['username']); ?></p>
                  <p class="card-text">Role: <?php echo htmlspecialchars($user['user_type']); ?></p>
                </div>
              </div>
              <hr class="horizontal dark my-3">
              <div class="d-flex my-4 mx-5">
                <button class="accordion-button btn-outline-info" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Change Password
                </button>
                <button class="accordion-button btn-outline-info" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Change Profile Picture
                </button>
              </div>
              <div class="accordion" id="profile-accordion">
                <div class="accordion-item">
                  <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                    data-bs-parent="#profile-accordion">
                    <div class="accordion-body">
                      <form action="" method="POST">
                        <div class="mb-3">
                          <label for="current_password" class="form-label">Current Password:</label>
                          <input type="password" id="current_password" name="current_password" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="new_password" class="form-label">New Password:</label>
                          <input type="password" id="new_password" name="new_password" class="form-control">
                        </div>
                        <?php

                        // Check if the session is already started
                        if (session_status() === PHP_SESSION_NONE) {
                          session_start();
                        }

                        // Include database configuration
                        include('database_config.php');

                        // Create a new MySQLi connection
                        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                        // Check the connection
                        if ($conn->connect_error) {
                          die("Database connection failed: " . $conn->connect_error);
                        }

                        // Enable error reporting for debugging
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);

                        // Initialize feedback message
                        $feedback_message = "";
                        // Check if the form is submitted
                        if (isset($_POST['submit'])) {
                          // Check if vendor_id is set in session
                          if (!isset($_SESSION['id'])) {
                            echo "<script>alert('User not logged in.');</script>";
                            exit;
                          }

                          // Assuming vendor ID is stored in the session
                          $user_id = $_SESSION['id'];

                          // Get form inputs
                          $current_password = $_POST['current_password'];
                          $new_password = $_POST['new_password'];

                          // Validate inputs
                          if (empty($current_password) || empty($new_password)) {
                            echo "<script>alert('Please fill in both fields.');</script>";
                          } else {
                            // Start a transaction
                            $conn->begin_transaction();

                            try {
                              // Retrieve the current password from the database
                              $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
                              $stmt->bind_param("i", $user_id);
                              $stmt->execute();
                              $result = $stmt->get_result();
                              $user = $result->fetch_assoc();

                              if ($user && $current_password === $user['password']) {
                                // Update the password in the database
                                $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                                $update_stmt->bind_param("si", $new_password, $user_id);
                                $update_stmt->execute();

                                if ($update_stmt->affected_rows > 0) {
                                  // Commit the transaction if everything is successful
                                  $conn->commit();
                                  echo "<script>alert('Password changed successfully.');</script>";
                                } else {
                                  // Rollback the transaction if update fails
                                  $conn->rollback();
                                  echo "<script>alert('Failed to change the password.');</script>";
                                }

                                $update_stmt->close();
                              } else {
                                // Rollback the transaction if the current password is incorrect
                                $conn->rollback();
                                echo "<script>alert('Current password is incorrect.');</script>";
                              }

                              $stmt->close();
                            } catch (Exception $e) {
                              // Rollback the transaction in case of an exception
                              $conn->rollback();
                              echo "<script>alert('An error occurred: " . htmlspecialchars($e->getMessage()) . "');</script>";
                            }
                          }

                          // Close the connection
// $conn->close();
                        }
                        ?>
                        <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#profile-accordion">
                    <div class="accordion-body">
                      <form id="uploadForm" action="documentPicUpload.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="profile-picture" class="form-label">Profile Picture</label>
                          <input type="file" class="form-control" id="profile-picture" name="profile-picture" required>
                        </div>
                        <?php

                        // Get the user ID from the session
                        $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

                        // Check if user_id is available and set it in the hidden input
                        if ($user_id !== null) {
                          echo '<input type="hidden" name="id" id="id" value="' . htmlspecialchars($user_id) . '">';
                        } else {
                          echo '<p>Error: User ID is not set in the session.</p>';
                        }
                        ?>
                        <button type="submit" class="btn btn-primary">Update Profile Picture</button>
                      </form>
                    </div>
                  </div>
                </div>


                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                  $(document).ready(function () {
                    $('#uploadForm').on('submit', function (e) {
                      e.preventDefault(); // Prevent default form submission

                      var formData = new FormData(this); // Create FormData object with form data

                      $.ajax({
                        url: $(this).attr('action'), // URL to send the request to
                        type: 'POST', // Request method
                        data: formData, // Form data
                        contentType: false, // Prevent setting Content-Type header
                        processData: false, // Prevent jQuery from processing data
                        success: function (response) {
                          alert(response); // Display response as an alert, regardless of success or error
                        }
                      });
                    });
                  });
                </script>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>

    <?php

    // Check if the session is already started
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    // Include database configuration
    include('database_config.php');

    // Create a new MySQLi connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check the connection
    if ($conn->connect_error) {
      die("Database connection failed: " . $conn->connect_error);
    }


    // Assuming vendor ID is stored in the session
    $user_id = $_SESSION['id'];

    // Fetch vendor information
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
      die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if vendor data is retrieved
    if (!$user) {
      die("No User found with ID " . htmlspecialchars($user_id));
    }

    ?>

  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-wechat py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="card-text">Username: <span
              class="card-text text-info"><?php echo htmlspecialchars($user['username']); ?></span></h5>
          <p class="card-text">Role: <span
              class="card-text text-info"><?php echo htmlspecialchars($user['user_type']); ?></span></p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <a class="btn bg-gradient-info w-85 text-white mx-4" href="#">Edit Profile</a>
        <a class="btn btn-outline-info w-85 mx-4" href="index.php">Logout</a>
        <hr class="horizontal dark my-1">
        <div class="text-small">Fixed Navbar</div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
      </div>
    </div>
  </div>




  <!--   Core JS Files   -->
  <script src="assets2/js/core/popper.min.js"></script>
  <script src="assets2/js/core/bootstrap.min.js"></script>
  <script src="assets2/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets2/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets2/js/plugins/chartjs.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets2/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>