<?php
include('Sessions/Vendor.php');

// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check for connection errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL query with placeholders (removed r.receipt AS receiptsImg)
$sql = "
  SELECT v.*, 
         v.payment_due AS due_dates,
         buildings.monthly_rentals, 
         buildings.stall_no
  FROM vendors v
  JOIN (
      SELECT vendor_id, monthly_rentals, stall_no FROM building_a
      UNION ALL
      SELECT vendor_id, monthly_rentals, stall_no FROM building_b
      UNION ALL
      SELECT vendor_id, monthly_rentals, stall_no FROM building_c
      UNION ALL
      SELECT vendor_id, monthly_rentals, stall_no FROM building_d
      UNION ALL
      SELECT vendor_id, monthly_rentals, stall_no FROM building_e
      UNION ALL
      SELECT vendor_id, monthly_rentals, stall_no FROM building_f
      UNION ALL
      SELECT vendor_id, monthly_rentals, stall_no FROM building_g
      UNION ALL
      SELECT vendor_id, monthly_rentals, stall_no FROM building_h
      UNION ALL
      SELECT vendor_id, monthly_rentals, stall_no FROM building_i
      UNION ALL
      SELECT vendor_id, monthly_rentals, stall_no FROM building_j
  ) AS buildings ON v.vendor_id = buildings.vendor_id
  WHERE v.vendor_id = ?
";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Check if preparation was successful
if ($stmt === false) {
  die("Error preparing query: " . $conn->error);
}

// Bind the vendor_id parameter to the SQL query
$stmt->bind_param("i", $vendor_id);

// Execute the statement
if (!$stmt->execute()) {
  die("Error executing query: " . $stmt->error);
}

// Get the result
$result = $stmt->get_result();

// Check if data is retrieved
if ($result->num_rows > 0) {
  $vendor = $result->fetch_assoc();
} else {
  // Output an alert message with a redirect to the Vendor.php page
  echo "<script>
    alert('No vendor found.');
    window.location.href = 'Vendor.php';
  </script>";
  exit();
}

if (!isset($vendor['first_name']) || $vendor['first_name'] === "" || !isset($vendor['last_name']) || $vendor['last_name'] === "") {

  echo "<script>
   alert('No information in your account. You need to fill-up your account first!');


  document.addEventListener('DOMContentLoaded', function() {
      var accountModal = new bootstrap.Modal(document.getElementById('accountModal'));
      accountModal.show();

      var form = document.getElementById('createVendorForm');
      var modalElement = document.getElementById('accountModal'); // Reference the entire modal element

      // Handle clicks outside the modal window (including the backdrop)
      document.addEventListener('click', function(event) {
          if (!modalElement.contains(event.target) && !form.checkValidity()) {
              event.preventDefault(); // Prevent closing the modal
              alert('Please fill out all required fields before closing.');
          }
      });

      // Handle close button click
      var closeButton = document.getElementById('closeButton');
      closeButton.addEventListener('click', function() {
          if (form.checkValidity()) {
              accountModal.hide(); // Close the modal if the form is valid
          } else {
              alert('Please fill out all required fields before closing.');
          }
      });

      // Disable accordion interaction (optional, adjust selector if needed)
      var accordions = document.querySelectorAll('.accordion-header, .accordion-toggle');
      accordions.forEach(function(accordion) {
          accordion.style.pointerEvents = 'none';
          accordion.style.opacity = '0.5';
      });

      // Prevent back navigation
      window.history.pushState(null, null, window.location.href);
      window.onpopstate = function() {
          window.history.pushState(null, null, window.location.href);
      };
  });
  </script>";
} else {
  echo "<script>
          console.log('Vendor data available'); // Or handle vendor data as needed
        </script>";
}



$query = "SELECT started_date, payment_due FROM vendors WHERE vendor_id = ?";
$stmt1 = $conn->prepare($query);
$stmt1->bind_param('i', $vendor_id);
$stmt1->execute();
$stmt1->bind_result($started_date, $payment_due);
$stmt1->fetch();
$stmt1->close();

// Close the statement and connection
$stmt->close();
$conn->close();
?>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        const alertClass = "<?php echo isset($_SESSION['alert_class']) ? $_SESSION['alert_class'] : ''; ?>";
        const alertMessage = "<?php echo isset($_SESSION['alert_message']) ? $_SESSION['alert_message'] : ''; ?>";

        if (alertClass && alertMessage) {
            // Display the alert using Achor
            alert(alertMessage); // Replace this with your Achor alert function if you have one

            // Clear session data after displaying the alert
            <?php 
                unset($_SESSION['alert_class']);
                unset($_SESSION['alert_message']);
            ?>
        }
    });




    const startedDate = new Date("<?php echo $started_date; ?>");
    const paymentDue = "<?php echo $payment_due; ?>";
</script>
    
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets2/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/imgbg/BGImage.png">
  <title>
    Vendor Dashboard
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
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
 



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
          <a class="nav-link active" href="Vendor.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-primary text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="VMStalls.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Stalls Availability</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " href="VMDocuments.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">My Documents</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="VMRelocation.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-joystick" viewBox="0 0 16 16">
                <path d="M10 2a2 2 0 0 1-1.5 1.937v5.087c.863.083 1.5.377 1.5.726 0 .414-.895.75-2 .75s-2-.336-2-.75c0-.35.637-.643 1.5-.726V3.937A2 2 0 1 1 10 2"/>
                <path d="M0 9.665v1.717a1 1 0 0 0 .553.894l6.553 3.277a2 2 0 0 0 1.788 0l6.553-3.277a1 1 0 0 0 .553-.894V9.665c0-.1-.06-.19-.152-.23L9.5 6.715v.993l5.227 2.178a.125.125 0 0 1 .001.23l-5.94 2.546a2 2 0 0 1-1.576 0l-5.94-2.546a.125.125 0 0 1 .001-.23L6.5 7.708l-.013-.988L.152 9.435a.25.25 0 0 0-.152.23"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Request Relocation</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="VMRecieptHistory.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Reciept History</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="VMmessages.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-envelope-fill" viewBox="0 0 16 16">
                <path
                  d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Messages</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="VMReminders.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-text" viewBox="0 0 16 16">
                <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8m0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Reminders</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 mt-5">
      <div class="card card-background shadow-none card-background-mask-info" id="sidenavCard">
        <div class="full-background" style="background-image: url('assets2/img/curved-images/white-curved.jpg')"></div>
        <div class="card-body text-start p-3 w-100">
          <img src="image/profile.jpg" alt="profile" style="min-width: 20px; min-height: 20px; height: 100px; width: 100px; border-radius: 10px; margin-left: 40px;">
          <h5 class="text-center">
    <?php 
    if (!isset($vendor['first_name']) || $vendor['first_name'] === "" || !isset($vendor['last_name']) || $vendor['last_name'] === "") {
        echo "EMPTY"; 
    } else {
        echo htmlspecialchars($vendor['first_name']) . ' ' . htmlspecialchars($vendor['middle_name']) . ' ' . htmlspecialchars($vendor['last_name']); 
    }
    ?>
</h5>

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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Vendor</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
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
                <span class="d-sm-inline d-none">Vendor</span>
              </a>
            </li>
            <?php 
            include('Notification/VendorNotif.php');
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
    <div class="container-fluid py-4">
      
     

  <!-- Modal Structure -->
<div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="accountModalLabel">Fill in Your Account Information</h5>
      </div>
      <div class="modal-body">
        <form id="createVendorForm" action="vendorAccountCreate.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="username" class="form-label"><?php echo htmlspecialchars($vendor['username']) ?></label>
            <input type="hidden" id="username" class="form-control" name="username" value="<?php echo htmlspecialchars($vendor['first_name']); ?>">
          </div>
          <div class="mb-3">
            <label for="first_name" class="form-label">First Name:</label>
            <input type="text" id="first_name" class="form-control" name="first_name" required>
          </div>
          <div class="mb-3">
            <label for="middle_name" class="form-label">Middle Name:</label>
            <input type="text" id="middle_name" class="form-control" name="middle_name">
          </div>
          <div class="mb-3">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" id="last_name" class="form-control" name="last_name" required>
          </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age:</label>
            <input type="number" id="age" class="form-control" name="age">
          </div>
          <div class="mb-3">
            <label for="contact_no" class="form-label">Contact Number:</label>
            <input type="tel" id="contact_no" name="contact_number" class="form-control">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <textarea id="address" name="address" class="form-control" style="height: 128px;" required></textarea>
          </div>
          <div class="mb-3">
            <label for="email_add" class="form-label">Email Address:</label>
            <textarea id="email_add" name="email_add" class="form-control"></textarea>
          </div>
          
          <div class="modal-footer">
            <button type="submit" name="submit" id="submit" class="btn btn-info">Create Account</button>
            <button type="button" class="btn btn-secondary" id="closeButton">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createVendorForm" action="vendorAccountCreate.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo htmlspecialchars($vendor_data['first_name'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="middle_name" class="form-label">Middle Name:</label>
                        <input type="text" id="middle_name" class="form-control" name="middle_name" value="<?php echo htmlspecialchars($vendor_data['middle_name'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" id="last_name" class="form-control" name="last_name" value="<?php echo htmlspecialchars($vendor_data['last_name'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age:</label>
                        <input type="number" id="age" class="form-control" name="age" value="<?php echo htmlspecialchars($vendor_data['age'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contact_no" class="form-label">Contact Number:</label>
                        <input type="tel" id="contact_no" name="contact_number" class="form-control" value="<?php echo htmlspecialchars($vendor_data['contact_no'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <textarea id="address" name="address" class="form-control" style="height: 128px;"><?php echo htmlspecialchars($vendor_data['address'] ?? ''); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="email_add" class="form-label">Email Address:</label>
                        <textarea id="email_add" name="email_add" class="form-control"><?php echo htmlspecialchars($vendor_data['email_add'] ?? ''); ?></textarea>
                    </div>
            
                    <div class="modal-footer">
                        <button type="submit" name="submit" id="submit" class="btn btn-info">Edit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#editProfileModal').on('show.bs.modal', function () {
        // Fetch the data from editVendor.php
        fetch('editVendor.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Check if data is returned and populate the form
                if (data && Object.keys(data).length > 0) {
                    populateForm(data);
                } else {
                    console.warn('No data found for the vendor.');
                }
            })
            .catch(error => {
                console.error('Error fetching vendor data:', error);
            });
    });

    function populateForm(data) {
        // Populate the input fields
        document.getElementById('first_name').value = data.first_name || '';
        document.getElementById('middle_name').value = data.middle_name || '';
        document.getElementById('last_name').value = data.last_name || '';
        document.getElementById('age').value = data.age || '';
        document.getElementById('contact_no').value = data.contact_no || '';
        
        // Populate the text areas
        document.getElementById('address').value = data.address || '';
        document.getElementById('email_add').value = data.email_add || '';
    }
});




document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    let reminderDate;

    if (paymentDue === 'MONTHLY') {
        reminderDate = new Date(startedDate.setMonth(startedDate.getMonth() + 1));
    } else if (paymentDue === 'QUARTERLY') {
        reminderDate = new Date(startedDate.setMonth(startedDate.getMonth() + 3));
    } else if (paymentDue === 'YEARLY') {
        reminderDate = new Date(startedDate.setFullYear(startedDate.getFullYear() + 1));
    }

    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = reminderDate.toLocaleDateString(undefined, options);

    if (reminderDate <= today) {
        // Trigger toast reminder for vendor
        showToast('Your next payment is due on: ' + formattedDate);
    }

    // Function to show toast message
    function showToast(message) {
        const toastHTML = `
            <div class="toast" style="position: absolute; top: 0; right: 0;" data-delay="5000">
                <div class="toast-header">
                    <strong class="mr-auto">Payment Reminder</strong>
                    <small>Just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', toastHTML);
        $('.toast').toast('show');
    }
});


    document.getElementById('frmPdfBtn').addEventListener('click', function() {
        // Redirect to the JotForm link
        window.open('https://form.jotform.com/242292954644060', '_blank');
    });
</script>


  <!-- Bootstrap 5.3 scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

      <div class="row mt-4">
          <div class="col-lg-5 mb-lg-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title text-lg text-info mb-3 text-start mx-2">Vendor Profile</h5>
                <div class="row">
                  <div class="col-md-4">
                    <img src="image/profile.jpg" class="img-fluid rounded-circle" alt="Admin Profile Picture">
                  </div>
                  <div class="col-md-8 my-3">
    <h6 class="card-subtitle mb-2 text-muted">
        Name: 
        <?php 
        if (!isset($vendor['first_name']) || $vendor['first_name'] === "" || !isset($vendor['last_name']) || $vendor['last_name'] === "") {
            echo "EMPTY"; 
        } else {
            echo htmlspecialchars($vendor['first_name']) . ' ' . htmlspecialchars($vendor['middle_name']) . ' ' . htmlspecialchars($vendor['last_name']); 
        }
        ?>
    </h6>
    <p class="card-text">
        Username: 
        <?php 
        if (!isset($vendor['first_name']) || $vendor['first_name'] === "" || !isset($vendor['last_name']) || $vendor['last_name'] === "") {
            echo "EMPTY"; 
        } else {
            echo htmlspecialchars($vendor['username']); 
        }
        ?>
    </p>
    <p class="card-text">Role: Vendor</p>
    <p class="card-text">
        Stall No.: 
        <?php 
        if (!isset($vendor['first_name']) || $vendor['first_name'] === "" || !isset($vendor['last_name']) || $vendor['last_name'] === "") {
            echo "EMPTY"; 
        } else {
            echo htmlspecialchars($vendor['stall_no']); 
        }
        ?>
    </p>
</div>

                </div>
                <hr class="horizontal dark my-3">
                <div class="d-flex my-4 mx-5">
                  <button class="accordion-button btn-outline-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Change Password
                  </button>
                  <button class="accordion-button btn-outline-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
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
        <input type="password" id="current_password" name="current_password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="new_password" class="form-label">New Password:</label>
        <input type="password" id="new_password" name="new_password" class="form-control" required>
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
    if (!isset($_SESSION['vendor_id'])) {
        echo "<script>alert('User not logged in.');</script>";
        exit;
    }

    $vendor_id = $_SESSION['vendor_id'];

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    if (empty($current_password) || empty($new_password)) {
        echo "<script>alert('Please fill in both fields.');</script>";
    } else {
   
        $conn->begin_transaction();

        try {
            // Retrieve the current password from the database
            $stmtV = $conn->prepare("SELECT password FROM vendors WHERE vendor_id = ?");
            $stmtV->bind_param("i", $vendor_id);
            $stmtV->execute();
            $resultV = $stmtV->get_result();
            $user = $resultV->fetch_assoc();

            if ($user && $current_password === $user['password']) {
                // Update the password in the database
                $update_stmt = $conn->prepare("UPDATE vendors SET password = ? WHERE vendor_id = ?");
                $update_stmt->bind_param("si", $new_password, $vendor_id);
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

            $stmtV->close();
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
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#profile-accordion">
                      <div class="accordion-body">
                        <form>
                          <div class="mb-3">
                            <label for="profile-picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile-picture" accept="image/*">
                          </div>
                          <button type="submit" class="btn btn-primary">Update Profile Picture</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-6">
                  <div class="d-flex flex-column h-100">
                  
                    <h5 class="font-weight-bolder">Polomolok Pubic Market</h5>
                    <p class="mb-5">OF ALL the places that I could have explored at my hometown, Polomolok, South Cotabato.</p>
                    <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                      Read More
                      <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
                <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                  <div class="bg-gradient-primary border-radius-lg h-100">
                    <img src="assets2/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                    <div class="position-relative d-flex align-items-center justify-content-center h-100">
                      
                      <!-- IMG HERE OR-->

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('image/polpol.jpg');">
              <span class="mask bg-gradient-dark"></span>
              <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                <h5 class="text-white font-weight-bolder mb-4 pt-2">Rehabilitation Of The Polomolok Public Market</h5>
                <p class="text-white">On behalf of the Municipality, Mayor Honey L. Matti...</p>
                <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                  Read More
                  <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      



      
    </div>
  </main>

  
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0"><?php echo htmlspecialchars($vendor['username']); ?></h5>
          <p>Vendor</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
       <!-- Edit Profile Button -->
  <div class="card-body pt-sm-3 pt-0">
    <a class="btn bg-gradient-info w-85 text-white mx-4" href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</a>
    <a class="btn bg-gradient-info w-85 text-white mx-4" href="VMDocuments.php">Fill Documents</a>
  
    <a class="btn btn-outline-info w-85 mx-4" href="index.php">Logout</a>
    <hr class="horizontal dark my-2">
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