<?php
include('Sessions/Cashier.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets2/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/imgbg/BGImage.png">
  <title>
    Cashier
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
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" /> <!-- Bootstrap CSS --></body>
</head>

<body class="g-sidenav-show  bg-gray-100">

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-list" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
        </svg>
        <span class="ms-2 font-weight-bold">Menu</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="Cashier.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        
        <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReceipt"
    aria-expanded="false" aria-controls="collapseReceipt">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
      </svg>
    </div>
    <span class="nav-link-text ms-1">Receipts</span>
  </a>
  <div class="collapse" id="collapseReceipt">
    <div class="right-aligned-links" style="text-align: right;">
      <a class="nav-link" href="CMReceiptVendor.php">Vendors</a>
      
      <!-- Dropdown for Rent Stall Applicants -->
      <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStallApp"
         aria-expanded="false" aria-controls="collapseStallApp">
        Rent Stall Applicants
      </a>
      <div class="collapse" id="collapseStallApp">
        <ul class="nav flex-column ms-3"> <!-- Added 'ms-3' for margin on the left -->
          <li class="nav-item">
            <a class="nav-link" href="CMReceiptApplicantsPaid.php">Paid</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="CMReceiptApplicantsUnpaid.php">Unpaid</a>
          </li>
        </ul>
      </div>
      
    </div>
  </div>
</li>
        <li class="nav-item">
          <a class="nav-link" href="CMReports.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-richtext" viewBox="0 0 16 16">
              <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
              <path d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m1.639-3.708 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V8.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8s1.54-1.274 1.639-1.208M6.25 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5"/>
            </svg>
          </div>
          <span class="nav-link-text ms-1">Monthly Reports</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="#"  data-bs-toggle="collapse" data-bs-target="#collapsePayRem">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Payment Reminder</span>
          </a>
  <div class="collapse" id="collapsePayRem">
    <div class="right-aligned-links" style="text-align: center;">
      <a class="nav-link" href="CMPaymentRem.php">Show All</a>
      <a class="nav-link" href="CMPaymentRemOverdue.php">Overdued</a>
      <a class="nav-link" href="CMPaymentRemUpcoming.php">Within 7 Days</a>
    </div>
  </div>
</li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 mt-5">
      <div class="card card-background shadow-none card-background-mask-info" id="sidenavCard">
        <div class="full-background" style="background-image: url('assets2/img/curved-images/white-curved.jpg')"></div>
        <div class="card-body text-start p-3 w-100">
          <img src="image/profile.jpg" alt="profile" style="min-width: 20px; min-height: 20px; height: 100px; width: 100px; border-radius: 10px; margin-left: 40px;">
          <h5 class="text-center"><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['middle_name']) . ' ' . htmlspecialchars($user['last_name']); ?></h5>
          <hr class="horizontal dark mt-0">
        </div>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Cashier</a></li>
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
                <span class="d-sm-inline d-none">Cashier</span>
              </a>
            </li>

            <?php 
            include('Notification/CashierNotif.php');
            ?>

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

    <?php
// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get total payments from receipts for the current month
$totalPaymentsQuery = "SELECT SUM(totalPay) AS totalPayments 
                       FROM receipts 
                       WHERE MONTH(issued_date) = MONTH(CURRENT_DATE()) 
                       AND YEAR(issued_date) = YEAR(CURRENT_DATE())";
$totalPaymentsResult = $conn->query($totalPaymentsQuery);
if ($totalPaymentsResult) {
    $totalPayments = $totalPaymentsResult->fetch_assoc();
    $data['totalPayments'] = $totalPayments['totalPayments'];
} else {
    $data['totalPayments'] = null;
}

// Query to get inquiries for the current month
$inquiriesQuery = "SELECT name, email_add AS email, subject, message, sent_date 
                   FROM inquiry 
                   WHERE MONTH(sent_date) = MONTH(CURRENT_DATE()) 
                   AND YEAR(sent_date) = YEAR(CURRENT_DATE())";
$inquiriesResult = $conn->query($inquiriesQuery);

// Query to count rent applications for the current month
$rentAppCountQuery = "SELECT COUNT(*) AS rentAppCount 
                      FROM rentapp_payment 
                      WHERE MONTH(payment_date) = MONTH(CURRENT_DATE()) 
                      AND YEAR(payment_date) = YEAR(CURRENT_DATE())";
$rentAppCountResult = $conn->query($rentAppCountQuery);
if ($rentAppCountResult) {
    $rentAppCount = $rentAppCountResult->fetch_assoc();
    $data['rentAppCount'] = $rentAppCount['rentAppCount'];
} else {
    $data['rentAppCount'] = null;
}

// Query to count active vendors
$activeVendorsQuery = "SELECT COUNT(*) AS activeVendorsCount 
                       FROM vendors 
                       WHERE Vendor_Status = 'ACTIVE'";
$activeVendorsResult = $conn->query($activeVendorsQuery);
if ($activeVendorsResult) {
    $activeVendorsCount = $activeVendorsResult->fetch_assoc();
    $data['activeVendorsCount'] = $activeVendorsCount['activeVendorsCount'];
} else {
    $data['activeVendorsCount'] = null;
}

// Close the connection
$conn->close();
?>



<!-- End Navbar -->
<div class="container-fluid py-4">
      <div class="row">



      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">


          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Expected Total Payments from Vendors (This Month)</p>
                    <h5 class="font-weight-bolder mb-0">
                   <span id="totalPay"><?php echo htmlspecialchars(number_format($data['totalPayments'], 2, '.', ',')); ?></span>
                    </h5>
                  </div>
                </div>
                <div class="col-2 text-end">
                  <div class="icon icon-shape bg-info shadow text-center border-radius-md">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Active Vendors this month</p>
                    <h5 class="font-weight-bolder mb-0">
                    <span id="activeVendorsCount"><?php echo htmlspecialchars($data['activeVendorsCount']); ?></span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-info shadow text-center border-radius-md">
                  <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Rent Applications (This Month)</p>
                    <h5 class="font-weight-bolder mb-0">
                    <span id="rentAppCount"><?php echo htmlspecialchars($data['rentAppCount']); ?></span>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-info shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      
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
                  <h6 class="card-subtitle mb-2 text-muted">Name: <?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['middle_name']) . ' ' . htmlspecialchars($user['last_name']); ?></h6>
                    <p class="card-text">Username: <?php echo htmlspecialchars($user['username']); ?></p>
                    <p class="card-text">Role: <?php echo htmlspecialchars($user['user_type']); ?></p>
                  </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="d-flex my-4 mx-5">
                  <button class="accordion-button btn-outline-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Change Password
                  </button>
                  <button class="accordion-button btn-outline-info" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Change Profile Picture
                </button>
                </div>
                <div class="accordion" id="profile-accordion">
                  <div class="accordion-item">
                    <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#profile-accordion">
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
                          <button type="submit" name = "submit"class="btn btn-primary">Change Password</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
            data-bs-parent="#profile-accordion">
            <div class="accordion-body">
              <form id="uploadForm" action="cashierPicUpload.php" method="post" enctype="multipart/form-data">
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
          <h5 class="card-text">Username: <span class="card-text text-info"><?php echo htmlspecialchars($user['username']); ?></span></h5>
          <p class="card-text">Role: <span class="card-text text-info"><?php echo htmlspecialchars($user['user_type']); ?></span></p>
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
</body>

</html>