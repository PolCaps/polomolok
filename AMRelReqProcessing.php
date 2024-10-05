<?php
include('Sessions/Admin.php');

// Include database configuration
include('database_config.php');
// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
    Administrator Dashboard
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
          <a class="nav-link " href="Admin.php">
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
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMaps"
            aria-expanded="false" aria-controls="collapseMaps">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                <title>office</title>
                <path fill-rule="evenodd"
                  d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z" />
                <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Maps</span>
          </a>
          <div class="collapse" id="collapseMaps">
            <div class="right-aligned-links" style="text-align: right;">
              <a class="nav-link" href="ABuildingA.php">Building A</a>
              <a class="nav-link" href="ABuildingB.html">Building B</a>
              <a class="nav-link" href="ABuildingC.html">Building C</a>
              <a class="nav-link" href="ABuildingD.html">Building D</a>
              <a class="nav-link" href="ABuildingE.html">Building E</a>
              <a class="nav-link" href="ABuildingF.html">Building F</a>
              <a class="nav-link" href="ABuildingG.html">Building G</a>
              <a class="nav-link" href="ABuildingH.html">Building H</a>
              <a class="nav-link" href="ABuildingI.html">Building I</a>
              <a class="nav-link" href="ABuildingJ.html">Building J</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAccounts"
            aria-expanded="false" aria-controls="collapseAccounts">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000"
                class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                <path
                  d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Accounts</span>
          </a>
          <div class="collapse" id="collapseAccounts">
            <div class="right-aligned-links" style="text-align: right;">
            <a class="nav-link" href="AMuser.php">Users</a>
            <a class="nav-link" href="AMvendor.php">Vendors</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="AMmessages.php">
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
          <a class="nav-link " href="AMinquiries.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                <path
                  d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Inquiries</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Vendor and Stall Approval</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVendorApproval"
            aria-expanded="false" aria-controls="collapseVendorApproval">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <img src="image/icons/icons8-approve-48.png" alt="approveicon" width="18px" height="18px">
            </div>
            <span class="nav-link-text ms-1">Vendor Approval</span>
          </a>
          <div class="collapse" id="collapseVendorApproval">
            <div class="right-aligned-links" style="text-align: right;">
              <a class="nav-link" href="AMStallApp.php">Stall Applicants</a>
              <a class="nav-link" href="AMReadydraw.php">Ready for Drawlots</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRelRequest"
            aria-expanded="false" aria-controls="collapseRelRequest">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <img src="image/icons/icons8-kiosk-on-wheels-48.png" alt="relocationimg" width="18px" height="18px">
            </div>
            <span class="nav-link-text ms-1">Relocation Request</span>
          </a>
          <div class="collapse" id="collapseRelRequest">
            <div class="right-aligned-links" style="text-align: right;">
              <a class="nav-link" href="AMRelReqApprove.php">Approved</a>
              <a class="nav-link" href="AMRelReqProcessing.php">Processing</a>
              <a class="nav-link" href="AMRelReqDeclined.php">Declined</a>
            </div>
          </div>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Page Customization</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="HomepageEditor.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <img src="image/icons/icons8-browser-settings-48.png" alt="approveicon" width="18px" height="18px">
            </div>
            <span class="nav-link-text ms-1">Homepage</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 mt-5">
      <div class="card card-background shadow-none card-background-mask-info" id="sidenavCard">
        <div class="full-background" style="background-image: url('assets2/img/curved-images/white-curved.jpg')"></div>
        <div class="card-body text-start p-3 w-100">
          <?php
          // Check if the user has a profile picture set; if not, use a default image
          $profilePicture = !empty($user['picture_profile']) ? $user['picture_profile'] : 'image/profile.jpg';
          ?>
          <img src="<?php echo htmlspecialchars($profilePicture); ?>" class="img-fluid" alt="Admin Profile Picture"
            style="min-width: 20px; min-height: 20px; height: 100px; width: 100px; margin-left: 40px;">
          <h5 class="text-center mt-2">
            <?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['middle_name']) . ' ' . htmlspecialchars($user['last_name']); ?>
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Modules</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Relocation Request</h6>
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
                <span class="d-sm-inline d-none">Admin</span>
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

<div class="row my-4">
    <div class="col-lg-10 col-md-6 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6 class="text-info">Request Relocation / Processing</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4 mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar2-week" viewBox="0 0 16 16" id="filterDate" data-bs-toggle="dropdown" aria-expanded="false">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="filterDate">
                                <li><a class="dropdown-item border-radius-md" href="javascript:;" onclick="filterByDate('today')">Today</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;" onclick="filterByDate('week')">This Week</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;" onclick="filterByDate('month')">This Month</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;" data-bs-toggle="modal" data-bs-target="#customDateModal">Custom Date</a></li>
                            </ul>
                            <div class="modal fade" id="customDateModal" tabindex="-1" aria-labelledby="customDateModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="customDateModalLabel">Select Custom Date</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="customDateForm" method="POST">
                                                <input type="text" id="customStartDate" name="start_date" class="form-control mb-2" placeholder="Start Date">
                                                <!-- <input type="text" id="customEndDate" name="end_date" class="form-control" placeholder="End Date"> -->
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="submitCustomDateForm()">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    flatpickr('#customStartDate', {
                                        dateFormat: 'Y-m-d'
                                    });
                                    flatpickr('#customEndDate', {
                                        dateFormat: 'Y-m-d'
                                    });
                                });

                                function filterByDate(period) {
                                    const today = new Date();
                                    let startDate, endDate;

                                    switch(period) {
                                        case 'today':
                                            startDate = endDate = today.toISOString().split('T')[0];
                                            break;
                                        case 'week':
                                            const firstDayOfWeek = today.getDate() - today.getDay();
                                            startDate = new Date(today.setDate(firstDayOfWeek)).toISOString().split('T')[0];
                                            endDate = new Date(today.setDate(firstDayOfWeek + 6)).toISOString().split('T')[0];
                                            break;
                                        case 'month':
                                            startDate = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split('T')[0];
                                            endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0).toISOString().split('T')[0];
                                            break;
                                    }

                                    document.getElementById('customStartDate').value = startDate;
                                    // document.getElementById('customEndDate').value = endDate;
                                    document.getElementById('customDateForm').submit();
                                }

                                function submitCustomDateForm() {
                                    document.getElementById('customDateForm').submit();
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <style>
            .message {
                max-width: 200px; /* Set the maximum width for the message */
                overflow: hidden; /* Hide the overflowed content */
                text-overflow: ellipsis; /* Add the ellipsis for overflowed content */
                white-space: nowrap; /* Prevent text from wrapping to the next line */
            }
            </style>
            <div class="card-body px-3 pb-2">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vendor ID</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Current Stall</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reason</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Relocation Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Relocation Request Date</th>
                </tr>
            </thead>
            <tbody id="dataTableBody"></tbody>
        </table>
    </div>
</div>
            
<script>
        document.addEventListener('DOMContentLoaded', function () {
                fetch('fetch_RelReqProcessing.php')
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        console.log('Fetched Data:', data); // Log fetched data for debugging

                        const tableBody = document.getElementById('dataTableBody');
                        tableBody.innerHTML = ''; // Clear existing content

                        if (data.length > 0) {
                            data.forEach(item => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.vendor_id}</td>
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.current_stall}</td>
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.fn} ${item.ln}</td>
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.reason.substring(0, 50)}...</td>
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.approval_status}</td>
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.request_date}</td>`;
                                tableBody.appendChild(row);
                            });
                        } else {
                            const row = document.createElement('tr');
                            row.innerHTML = "<td colspan='6' class='text-center text-xs font-weight-bold mb-0'>No Relocation Requests</td>";
                            tableBody.appendChild(row);
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
            </script>

<!-- Modernized Bootstrap Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white text-info">
                <h5 class="modal-title" id="messageModalLabel">Relocation Request</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Vendor and Relocation Information -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="modalVendorID" class="form-label text-muted">Vendor ID</label>
                            <p class="form-control-plaintext" id="modalVendorID">Loading...</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="modalcurrentStall" class="form-label text-muted">Current Stall No.</label>
                            <p class="form-control-plaintext" id="modalcurrentStall">Loading...</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="modalName" class="form-label text-muted">Vendor Name</label>
                            <p class="form-control-plaintext" id="modalName">Loading...</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="modalRequestDate" class="form-label text-muted">Request Date</label>
                            <p class="form-control-plaintext" id="modalRequestDate">Loading...</p>
                        </div>
                    </div>
                </div>

                <!-- Message Section -->
                <div class="form-group mb-4">
                    <label for="messageContent" class="form-label text-muted">Message</label>
                    <textarea class="form-control" id="messageContent" rows="4" readonly></textarea>
                </div>

                <!-- Relocation Status Dropdown -->
                <div class="form-group mb-4">
                    <label for="relocationStatus" class="form-label text-muted">Relocation Status</label>
                    <select class="form-select" id="relocationStatus">
                        <option value="Pending">Pending</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>

                <!-- Accordion for Relocation Details (conditionally shown) -->
                <div class="accordion mb-4" id="relocationAccordion" style="display: none;">
                    <div class="accordion-item">
                        
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#relocationAccordion">
                            <div class="accordion-body">
                                <!-- Relocation Form -->
                                <form id="relocationForm">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="newLocation" class="form-label">Relocate to:</label>
                                                <select class="form-select" id="newLocation" required>
                                                    <option value="">Select Stall</option>
                                                    <option value="Building A">A-02</option>
                                                    <option value="Building B">A-03</option>
                                                    <option value="Building C">A-04</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="relocationDate" class="form-label">Relocation Date</label>
                                                <input type="date" class="form-control" id="relocationDate" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button type="submit" class="btn btn-success">Submit Relocation</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle click event and populate modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('fetch_RelReqProcessing.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('dataTableBody');
            tableBody.innerHTML = ''; // Clear existing content

            if (data.length > 0) {
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.vendor_id}</td>
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.current_stall}</td>
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.fn} ${item.ln}</td>
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.reason.substring(0, 50)}...</td>
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.approval_status}</td>
                                    <td class='text-center text-xs font-weight-bold mb-0'>${item.request_date}</td>`;

                    // Add click event to open the modal with the corresponding details
                    row.addEventListener('click', function () {
                        const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));

                        // Populate modal with the full details from the clicked row
                        document.getElementById('modalVendorID').textContent = item.vendor_id;
                        document.getElementById('modalcurrentStall').textContent = item.current_stall;
                        document.getElementById('modalName').textContent = item.fn + ' ' + item.ln;
                        document.getElementById('messageContent').value = item.reason;
                        document.getElementById('modalRequestDate').textContent = item.request_date;
                        document.getElementById('relocationStatus').value = item.approval_status;

                        // Toggle accordion visibility based on relocation status
                        const relocationAccordion = document.getElementById('relocationAccordion');
                        if (item.relocation_status === 'Accepted') {
                            relocationAccordion.style.display = 'block';
                        } else {
                            relocationAccordion.style.display = 'none';
                        }

                        // Show the modal
                        messageModal.show();
                    });

                    tableBody.appendChild(row);
                });
            } else {
                const row = document.createElement('tr');
                row.innerHTML = "<td colspan='6' class='text-center text-xs font-weight-bold mb-0'>No Pending Relocation Request</td>";
                tableBody.appendChild(row);
            }
        })
        .catch(error => console.error('Error fetching data:', error));
    });

    // Escape HTML function
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function (m) { return map[m]; });
    }

    // Relocation Status Change Logic
    document.getElementById('relocationStatus').addEventListener('change', function () {
        const relocationAccordion = document.getElementById('relocationAccordion');
        if (this.value === 'Accepted') {
            relocationAccordion.style.display = 'block';
        } else {
            relocationAccordion.style.display = 'none';
        }
    });
</script>

  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" href="#">
      <i class="fas fa-cog"></i> </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
        <h5 class="card-text">Username: <span class="card-text text-info"><?php echo htmlspecialchars($user['username']); ?></span></h5>
        <p class="card-text">Role: <span class="card-text text-info"><?php echo htmlspecialchars($user['user_type']); ?></span></p>
       
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fas fa-times"></i>
          </button>
        </div>
        </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <a class="btn bg-gradient-info w-85 text-white mx-4" href="Admin.php">Edit Profile</a>
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

  <link rel="stylesheet" href="loading.css">
  <script src="loading.js" defer></script>
  <div class="loader"></div>
</body>

</html>