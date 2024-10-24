<?php
include('Sessions/Vendor.php');

// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch vendor information
$sql = "
    SELECT v.*, b.* 
    FROM vendors v 
    JOIN (
        SELECT * FROM building_a WHERE vendor_id = ?
        UNION
        SELECT * FROM building_b WHERE vendor_id = ?
        UNION
        SELECT * FROM building_c WHERE vendor_id = ?
        UNION
        SELECT * FROM building_d WHERE vendor_id = ?
        UNION
        SELECT * FROM building_e WHERE vendor_id = ?
        UNION
        SELECT * FROM building_f WHERE vendor_id = ?
        UNION
        SELECT * FROM building_g WHERE vendor_id = ?
        UNION
        SELECT * FROM building_h WHERE vendor_id = ?
        UNION
        SELECT * FROM building_i WHERE vendor_id = ?
        UNION
        SELECT * FROM building_j WHERE vendor_id = ?
    ) b ON v.vendor_id = b.vendor_id
";
$values = array_fill(0, 10, $vendor_id);
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$types = str_repeat('i', count($values));
$stmt->bind_param($types, ...$values);
$stmt->execute();
$result = $stmt->get_result();
$vendor = $result->fetch_assoc();


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
          <a class="nav-link" href="Vendor.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
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
          <a class="nav-link active " href="VMmessages.php">
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
    <div class="row mt-4">
        <div class="d-grid gap-2 d-md-block py-3 px-3">
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title">MESSAGES</h5>
                            <p>Welcome, <?php echo htmlspecialchars($vendor['first_name']); ?>!</p>

                            <div class="accordion" id="chatAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Open Chats
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#chatAccordion">
                                        <div class="accordion-body">
                                            <div id="message-box" style="max-height: 300px; overflow-y: auto; border: 1px solid #e0e0e0; padding: 10px; border-radius: 8px;">
                                                <!-- Messages will appear here -->
                                            </div>
                                            <form id="message-form" method="POST" action="send_message.php">
                                                <div class="mb-3">
                                                    
                                                
                                                <label for="recipient-select" class="form-label">Send Message To:</label>
                                                    
                                                <?php
                                                include('database_config.php');

                                                // Create a connection to the database
                                                $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                                                // Check connection
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }

                                                // Query to select only Admin users
                                                $query = "SELECT id, user_type, first_name, last_name FROM users";
                                                $result = $conn->query($query);

                                                // Check if the query returned any results
                                                if ($result && $result->num_rows > 0) {
                                                    echo '<select id="recipient-select" name="recipient_id" class="form-select" required>';
                                                    echo '<option value="">Select Recipient</option>';

                                                    // Loop through each Admin user and add them as options in the dropdown
                                                    while ($users = $result->fetch_assoc()) {
                                                      echo '<option value="' . htmlspecialchars($users['id']) . '">' . htmlspecialchars($users['first_name']) . ' ' . htmlspecialchars($users['last_name']) . ' - ' . htmlspecialchars($users['user_type']) . '</option>';
                                                    }

                                                    echo '</select>';
                                                } else {
                                                    echo '<select id="recipient-select" name="recipient_id" class="form-select" required>';
                                                    echo '<option value="">No one is Available</option>';
                                                    echo '</select>';
                                                }

                                                // Close the database connection
                                                $conn->close();
                                                ?>

                                                </div>
                                                <div class="input-group">
                                                    <input type="text" id="message-input" class="form-control" placeholder="Type a message" required />
                                                    <button type="submit" class="btn btn-primary ms-2">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                const vendorId = <?php echo json_encode($vendor_id); ?>;
                                const messageForm = document.getElementById('message-form');
                                const messageInput = document.getElementById('message-input');
                                const messageBox = document.getElementById('message-box');
                                const recipientSelect = document.getElementById('recipient-select');

                                messageForm.addEventListener('submit', function (e) {
                                    e.preventDefault();
                                    const message = messageInput.value;
                                    const recipientId = recipientSelect.value;

                                    if (!recipientId) {
                                        alert('Please select User to send the message to.');
                                        return;
                                    }

                                    // Create message element with styles
                                    const messageElement = document.createElement('div');
                                    messageElement.className = 'bg-warning text-dark p-2 my-2 rounded';
                                    messageElement.textContent = `You (Vendor): ${message}`;
                                    messageBox.appendChild(messageElement);
                                    messageInput.value = '';

                                    // Send the message to the server
                                    fetch('send_message.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        message: message,
                                        senderId: vendorId, 
                                        recipientId: recipientId,
                                    }),
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data);
                                    // Optionally fetch messages again to update the UI
                                })
                                .catch(error => {
                                    console.error('Error:', error);
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


  <!-- dri rasa nav-item v.vendor_id, v.first_name, v.middle_name, v.last_name, r.receipt AS receiptsImg, 
 
         v.payment_due AS due_dates,
         COALESCE(a.monthly_rentals, b.monthly_rentals, c.monthly_rentals, d.monthly_rentals, 
                  e.monthly_rentals, f.monthly_rentals, g.monthly_rentals, h.monthly_rentals, 
                  i.monthly_rentals, j.monthly_rentals) AS monthly_rentals, 
         COALESCE(a.stall_no, b.stall_no, c.stall_no, d.stall_no, 
                  e.stall_no, f.stall_no, g.stall_no, h.stall_no, 
                  i.stall_no, j.stall_no) AS stall_no,
         v.started_date -->


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