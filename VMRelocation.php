<?php
include('Sessions/Vendor.php');

// Include database configuration
include('database_config.php');
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if (!isset($_SESSION['vendor_id'])) {
  header("Location: index.php");
  exit();
}


// Get the vendor ID from the session
$vendor_id = $_SESSION['vendor_id'];

// Include database configuration
include('database_config.php');

// Create a connection


// Fetch vendor information
$sql = "SELECT * FROM vendors WHERE vendor_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
  die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $vendor_id);
$stmt->execute();
$result = $stmt->get_result();
$vendor = $result->fetch_assoc();

// Check if vendor data is retrieved
if (!$vendor) {
  die("No vendor found with ID " . htmlspecialchars($vendor_id));
}



// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets2/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/imgbg/BGImage.png">
  <title>
    Request Relocation
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
          <a class="nav-link" href="Vendor.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
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
          <a class="nav-link" href="VMStalls.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-shop"
                viewBox="0 0 16 16">
                <path
                  d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Stalls Availability</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="VMDocuments.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path
                  d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">My Documents</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active " href="VMRelocation.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-joystick"
                viewBox="0 0 16 16">
                <path
                  d="M10 2a2 2 0 0 1-1.5 1.937v5.087c.863.083 1.5.377 1.5.726 0 .414-.895.75-2 .75s-2-.336-2-.75c0-.35.637-.643 1.5-.726V3.937A2 2 0 1 1 10 2" />
                <path
                  d="M0 9.665v1.717a1 1 0 0 0 .553.894l6.553 3.277a2 2 0 0 0 1.788 0l6.553-3.277a1 1 0 0 0 .553-.894V9.665c0-.1-.06-.19-.152-.23L9.5 6.715v.993l5.227 2.178a.125.125 0 0 1 .001.23l-5.94 2.546a2 2 0 0 1-1.576 0l-5.94-2.546a.125.125 0 0 1 .001-.23L6.5 7.708l-.013-.988L.152 9.435a.25.25 0 0 0-.152.23" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Request Relocation</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="VMRecieptHistory.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-journal-text" viewBox="0 0 16 16">
                <path
                  d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                <path
                  d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                <path
                  d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
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
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-text"
                viewBox="0 0 16 16">
                <path
                  d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105" />
                <path
                  d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8m0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5" />
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
          <img src="image/profile.jpg" alt="profile"
            style="min-width: 20px; min-height: 20px; height: 100px; width: 100px; border-radius: 10px; margin-left: 40px;">
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Vendor</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Module</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Request Relocation</h6>
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
      <div class="d-grid gap-2 d-md-block py-3 px-3">
        <p class="text-title">Actions</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal">
          Make Request
        </button>
      </div>
      <div class="row my-4">
        <div class="col-lg-11 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6 class="mx-1 my-2">Relocation Request</h6>

                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                      <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                      <input type="text" class="form-control px-1" placeholder="Search for...">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive max-height-400 overflow-auto">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Message
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Current Stall
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Relocation Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Rejected Reason</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Relocation Stall</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Relocation Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Relocation Request Submit</th>
                    </tr>
                  </thead>
                  <tbody id="dataTableBody">
                    <?php
                    include('database_config.php');

                    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    }
                    // Get the vendor ID from the session
                    $vendor_id = $_SESSION['vendor_id'];

                   

                    $sql = "SELECT current_stall, relocated_stall, reason, approval_status, reject_reason, request_date, relocation_date, archive FROM relocation_req WHERE vendor_id = ? AND archive = 0";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $vendor_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Display data
                    if ($result->num_rows > 0) { // Check if there are any rows
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr onclick='openModal(".json_encode($row).")' style='cursor: pointer;'>"; // Add cursor pointer for better UX
                        $message = trim($row['reason']);
                        $trimmedMessage = strlen($message) > 20 ? substr($message, 0, 20) . '...' : $message;
                        echo "<td class='text-xs font-weight-bold text-center'>" . htmlspecialchars($trimmedMessage) . "</td>";
                        
                        echo "<td class='text-xs font-weight-bold text-center'>" . htmlspecialchars($row['current_stall']) . "</td>";
                        
                        $approval_status = !empty($row['approval_status']) ? htmlspecialchars($row['approval_status']) : "N/A";
                        echo "<td class='text-xs font-weight-bold text-center'>" . $approval_status . "</td>";
                    
                        $reject_reason = trim($row['reject_reason']);
                        $trimmedReason = !empty($reject_reason) ? (strlen($reject_reason) > 20 ? substr($reject_reason, 0, 20) . '...' : $reject_reason) : "N/A";
                        echo "<td class='text-xs font-weight-bold text-center'>" . htmlspecialchars($trimmedReason) . "</td>";
                    
                        $relocated_stall = !empty($row['relocated_stall']) ? htmlspecialchars($row['relocated_stall']) : "N/A";
                        echo "<td class='text-xs font-weight-bold text-center'>" . $relocated_stall . "</td>";
                    
                        $relocation_date = !empty($row['relocation_date']) ? htmlspecialchars($row['relocation_date']) : "N/A ";
                        echo "<td class='text-xs font-weight-bold text-center'>" . $relocation_date . "</td>";
                    
                        echo "<td class='text-xs font-weight-bold text-center'>" . htmlspecialchars($row['request_date']) . "</td>";
                        echo "</tr>";
                    }
                  } else {
                      // If no results were found, output a message in the table
                      echo "<tr>";
                      echo "<td colspan='9' class='text-center text-xs font-weight-bold mb-0'>You have No Current Request</td>";
                      echo "</tr>";
                  }

                    // Close connections
                    $stmt->close();
                    $conn->close();
                    ?>
                  </tbody>
                </table>
              </div>
            </div>



          </div>
          <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel">Request Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label for="modalMessage" class="form-label">My Message:</label>
          <textarea type="text" class="form-control" id="modalMessage" rows="5"readonly> </textarea>
        </div>
        <div class="mb-3">
          <label for="modalCurrentStall" class="form-label">Current Stall:</label>
          <input type="text" class="form-control" id="modalCurrentStall" readonly>
        </div>
        <div class="mb-3">
          <label for="modalRelocatedStall" class="form-label">Relocated to this Stall:</label>
          <input type="text" class="form-control" id="modalRelocatedStall" readonly>
        </div>
        <div class="mb-3">
          <label for="modalRejectReason" class="form-label">Rejected Reason:</label>
          <textarea type="text" class="form-control" id="modalRejectReason" rows="5"readonly> </textarea>
        </div>
        <div class="mb-3">
          <label for="modalRelocationStatus" class="form-label">Relocation Status:</label>
          <input type="text" class="form-control" id="modalRelocationStatus" readonly>
        </div>
        <div class="mb-3">
          <label for="modalRelocationDate" class="form-label">Relocation Date:</label>
          <input type="text" class="form-control" id="modalRelocationDate" readonly>
        </div>
        <div class="mb-3">
          <label for="modalRequestDate" class="form-label">Relocation Request Submit:</label>
          <input type="text" class="form-control" id="modalRequestDate" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
function openModal(rowData) {
    document.getElementById('modalMessage').value = rowData.reason || 'N/A';
    document.getElementById('modalCurrentStall').value = rowData.current_stall || 'N/A';
    document.getElementById('modalRelocatedStall').value = rowData.relocated_stall || 'N/A';
    document.getElementById('modalRejectReason').value = rowData.reject_reason || 'N/A';
    document.getElementById('modalRelocationStatus').value = rowData.approval_status || 'N/A';
    document.getElementById('modalRelocationDate').value = rowData.relocation_date || 'N/A';
    document.getElementById('modalRequestDate').value = rowData.request_date || 'N/A';

    // Open the modal
    const modal = new bootstrap.Modal(document.getElementById('detailsModal'));
    modal.show();
}
</script>
          <?php
          include('database_config.php');

          // Create a connection
          $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

          // Check the connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $vendor_id = $vendor['vendor_id']; // Assume this is set earlier in your script
          
          // Prepare the SQL query to fetch all stalls for the vendor across all buildings
          $sql = "
              SELECT 'Building A' AS building, stall_no FROM building_a WHERE vendor_id = ?
              UNION ALL
              SELECT 'Building B' AS building, stall_no FROM building_b WHERE vendor_id = ?
              UNION ALL
              SELECT 'Building C' AS building, stall_no FROM building_c WHERE vendor_id = ?
              UNION ALL
              SELECT 'Building D' AS building, stall_no FROM building_d WHERE vendor_id = ?
              UNION ALL
              SELECT 'Building E' AS building, stall_no FROM building_e WHERE vendor_id = ?
              UNION ALL
              SELECT 'Building F' AS building, stall_no FROM building_f WHERE vendor_id = ?
              UNION ALL
              SELECT 'Building G' AS building, stall_no FROM building_g WHERE vendor_id = ?
              UNION ALL
              SELECT 'Building H' AS building, stall_no FROM building_h WHERE vendor_id = ?
              UNION ALL
              SELECT 'Building I' AS building, stall_no FROM building_i WHERE vendor_id = ?
              UNION ALL
              SELECT 'Building J' AS building, stall_no FROM building_j WHERE vendor_id = ?;
          ";

          // Prepare the statement
          $stmt = $conn->prepare($sql);

          // Bind the parameters
          $stmt->bind_param("iiiiiiiiii", $vendor_id, $vendor_id, $vendor_id, $vendor_id, $vendor_id, $vendor_id, $vendor_id, $vendor_id, $vendor_id, $vendor_id);

          // Execute the statement
          $stmt->execute();
          $result = $stmt->get_result();

          // Initialize an array to store the stalls
          $stalls = [];

          // Fetch the stall numbers
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $stalls[] = [
                'building' => htmlspecialchars($row['building']),
                'stall_no' => htmlspecialchars($row['stall_no'])
              ];
            }
          } else {
            echo "No stalls found for vendor ID: " . htmlspecialchars($vendor_id);
          }

          // Close connections
          $stmt->close();
          $conn->close();
          ?>

          <!-- Modal for Relocation Request -->
          <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="messageModalLabel">Request Relocation</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="insert_relocation_req.php" method="post">
                    <div class="mb-3">
                      <label for="vendorId" class="form-label">Vendor Id</label>
                      <input class="form-control" type="text" id="vendorId" name="vendor_id"
                        value="<?php echo htmlspecialchars($vendor_id); ?>" aria-label="Disabled input example"
                        readonly>
                        <input type="hidden" id="vendor_name" name="vendor_name"  value="<?php echo htmlspecialchars($vendor['first_name']) . ' ' . htmlspecialchars($vendor['middle_name']) . ' ' . htmlspecialchars($vendor['last_name']); ?>" 
                        aria-label="Disabled input example">
                    </div>

                    <div class="mb-3">
                      <label for="currentStall" class="form-label">Select your stall to Relocate</label>
                      <select class="form-select" id="currentStall" name="currentStall" required>
                        <?php if (!empty($stalls)): ?>
                          <option value="">Select a stall</option>
                          <?php foreach ($stalls as $stall): ?>
                            <option value="<?php echo $stall['stall_no']; ?>">
                              <?php echo $stall['building'] . " - Stall " . $stall['stall_no']; ?>
                            </option>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <option value="">No stalls available</option>
                        <?php endif; ?>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="messageInput" class="form-label">Message</label>
                      <textarea class="form-control" id="messageInput" name="message" required rows="3"
                        placeholder="Enter your message"></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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


    <!-- <link rel="stylesheet" href="loading.css">
  <script src="loading.js" defer></script>
  <div class="loader"></div> -->
</body>

</html>