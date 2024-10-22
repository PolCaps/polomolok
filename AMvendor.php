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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets2/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/imgbg/BGImage.png">
  <title>
    Dashboard
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

  <style>
    .alert {
      position: fixed;
      top: 1rem;
      left: 50%;
      transform: translateX(-50%);
      width: auto;
      /* Auto width for better fit */
      max-width: 500px;
      /* Maximum width to keep it from being too wide */
      z-index: 1050;
    }

    .alert-icon {
      font-size: 1.2em;
      /* Adjust the size of the icon */
    }
  </style>
</head>
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
              <a class="nav-link" href="AMRelReqProcessing.php">Pending</a>
              <a class="nav-link" href="AMRelReqDeclined.php">Declined</a>
              <a class="nav-link text-info" href="AMRelReqHistory.php">Archived</a>
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Modules</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Vendors</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control px-1" placeholder="Search for...">

            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Admin</span>
              </a>
            </li>
            <?php
            include('Notification/AdminNotif.php');
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
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Vendors:</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?php
                      include('database_config.php');

                      // Create a connection
                      $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                      // Check the connection
                      if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                      }

                      // SQL query to count the number of vendors
                      $countQuery = "SELECT COUNT(*) as vendor_count FROM vendors";
                      $countResult = $conn->query($countQuery);

                      if ($countResult) {
                        $countRow = $countResult->fetch_assoc();
                        $vendorCount = "Total vendors: " . $countRow['vendor_count'] . "<br>";
                      } else {
                        $vendorCount = "Error: " . $conn->error;
                      }

                      // Echo the vendor count
                      echo $vendorCount;

                      // Close the connection
                      $conn->close();
                      ?>

                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-info shadow text-center border-radius-md">
                    <i class="fa fa-user text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">


        <body>
          <style>
            .accordion-header {
              flex: 1;
              text-align: center;
            }

            .accordion-header button {
              width: 100%;
              text-align: center;
            }

            .accordion-item {
              margin-bottom: 1rem;
            }

            .accordion-button:not(.collapsed) {
              color: #0d6efd;
              background-color: #e9ecef;
            }

            .accordion-button {
              flex: 1;
            }
          </style>


          <!-- update , delete, add stalls button paras sa modals -->
          <div class="header-buttons mb-4">
            <div class="d-flex justify-content-start">
              <button type="button" class="btn btn-primary mx-1" id="updateBtn">UPDATE</button>
              <button type="button" class="btn btn-primary mx-1" id="stallBtn">ADD STALLS</button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                id="deleteBtn">DELETE</button>
            </div>
          </div>

          <!-- Delete Modal -->
          <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Select Vendor to Delete</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Search bar for vendor username -->
                  <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchVendor" placeholder="Search Vendor Username">
                  </div>

                  <!-- Dropdown to select vendor -->
                  <div class="mb-3">
                    <label for="vendorDropdown" class="form-label">Or select from the list:</label>
                    <select class="form-select" id="vendorDropdown">
                      <option selected>Select Vendor</option>
                    </select>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
              </div>
            </div>
          </div>


          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>


          <!-- para sa adding stalls stalls -->
          <div class="modal fade" id="stallModal" tabindex="-1" aria-labelledby="stallModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="stallModalLabel">Stall Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="stallForm" action="stalls_vendor.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                      <label for="vendorselectcheck" class="form-label">select from the list:</label>
                      <select class="form-select" id="vendorselectcheck" name="vendor_id" required>
                        <option value="">Select Vendor</option>
                        <!-- Populate vendor options here -->
                      </select>
                      <div class="invalid-feedback">Please select a vendor.</div>
                    </div>
                    <div class="form-group mb-3">
                      <label for="building_type">Buildings:</label>
                      <select id="building_type" name="building_type" class="form-control" required
                        data-building-type="">
                        <option value="">Select Buildings</option>
                        <option value="building_a">Building A</option>
                        <option value="building_b">Building B</option>
                        <option value="building_c">Building C</option>
                        <option value="building_d">Building D</option>
                        <option value="building_e">Building E</option>
                        <option value="building_f">Building F</option>
                        <option value="building_g">Building G</option>
                        <option value="building_h">Building H</option>
                        <option value="building_i">Building I</option>
                        <option value="building_j">Building J</option>
                      </select>
                      <div class="invalid-feedback">Please select a building type.</div>
                    </div>
                    <div class="form-group mb-3">
                      <label for="building_floor">Building Floor:</label>
                      <select id="building_floor" name="building_floor" class="form-control" required>
                        <option value="">Select Building Floor</option>
                      </select>
                      <div class="invalid-feedback">Please select a building floor.</div>
                    </div>
                    <div class="form-group mb-3">
                      <label for="stall_no">Stall Number:</label>
                      <select id="stall_no" name="stall_no" class="form-control" required>
                        <option value="">Select Stall</option>
                      </select>
                      <div class="invalid-feedback">Please select a stall number.</div>
                    </div>
                    <div class="form-group mb-3">
                      <label for="monthly_rentals">Monthly Rentals:</label>
                      <input type="text" id="monthly_rentals" name="monthly_rentals" class="form-control" required>
                    </div>
                    <p>FILL IF THE VENDOR HAVE TWO OR MORE STALLS.</p>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="stallModalBtn">Confirm</button>
                </div>
              </div>
            </div>
          </div>


          <script>
            document.addEventListener('DOMContentLoaded', function () {
              // kuhaon ang id paras delete action
              document.getElementById('deleteModal').addEventListener('show.bs.modal', function () {
                fetch('populateDeleteVendor.php?action=get_vendors')
                  .then(response => response.json())
                  .then(data => {
                    const vendorDropdown = document.getElementById('vendorDropdown');
                    vendorDropdown.innerHTML = '<option selected>Select Vendor</option>'; // Reset dropdown
                    if (data.vendors && data.vendors.length > 0) {
                      data.vendors.forEach(function (vendor) {
                        const option = document.createElement('option');
                        option.value = vendor.vendor_id;
                        option.textContent = vendor.username;
                        vendorDropdown.appendChild(option);
                      });
                    } else {
                      alert(data.error || "No vendors found.");
                    }
                  });
              });

              // Confirm delete vendor action
              document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
                var selectedVendorID = document.getElementById('vendorDropdown').value;

                if (selectedVendorID && selectedVendorID !== 'Select Vendor username') {
                  if (confirm('Are you sure you want to delete this vendor?')) {
                    fetch('deleteVendor.php', {
                      method: 'POST',
                      headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                      },
                      body: 'vendor_id=' + encodeURIComponent(selectedVendorID)
                    })
                      .then(response => response.text())
                      .then(alertMsg => {
                        alert(alertMsg);
                        window.location.href = 'AMvendor.php';
                        if (!alertMsg.includes('Error')) {
                          window.location.href = 'AMvendor.php';  // Reload the page after alert
                        }
                      })
                      .catch(error => {
                        alert('Error communicating with server: ' + error.message);
                        window.location.href = 'AMvendor.php';
                      });
                  }
                } else {
                  alert('Please select a vendor to delete.');
                  window.location.href = 'AMvendor.php';
                }
              });

              // Populate the dropdown with vendor usernames and IDs when the stall modal opens
              document.getElementById('stallModal').addEventListener('show.bs.modal', function () {
                fetch('getVendorID.php?action=get_vendors')
                  .then(response => response.json())
                  .then(data => {
                    const vendorSelect = document.getElementById('vendorselectcheck');
                    vendorSelect.innerHTML = '<option value="">Select Vendor</option>'; // Reset dropdown
                    if (data.vendors && data.vendors.length > 0) {
                      data.vendors.forEach(function (vendor) {
                        const option = document.createElement('option');
                        option.value = vendor.vendor_id;
                        option.textContent = vendor.username;
                        vendorSelect.appendChild(option);
                      });
                    } else {
                      alert(data.error || "No vendors found.");
                    }
                  })
                  .catch(error => {
                    alert('Error fetching vendors: ' + error.message);
                  });
              });

              // Add stall to vendor
              document.getElementById('stallModalBtn').addEventListener('click', function () {
                var selectedVendor = document.getElementById('vendorselectcheck').value;

                if (selectedVendor && selectedVendor !== '') {
                  if (confirm('Add this stall to vendor?')) {
                    var stallForm = document.getElementById('stallForm');
                    fetch(stallForm.action, {
                      method: 'POST',
                      body: new FormData(stallForm)
                    })
                      .then(response => response.text())
                      .then(alertMsg => {
                        alert(alertMsg);
                        if (!alertMsg.includes('Error')) {
                          window.location.href = 'AMvendor.php';
                        }
                      })
                      .catch(error => {
                        alert('Error communicating with server: ' + error.message);
                      });
                  }
                } else {
                  alert('Please select a vendor.');
                }
              });

              $('#stallModal').on('shown.bs.modal', function () {

                // Check if a building is selected
                function checkBuildingSelected() {
                  var building = document.getElementById('building_type').value;
                  if (!building) {
                    alert('Please select a building first.');
                    document.getElementById('building_type').focus();
                    return false;
                  }
                  return true;
                }

                document.getElementById('building_type').addEventListener('change', function () {
                  var building = this.value;
                  var stallSelect = document.getElementById('stall_no');
                  var floorSelect = document.getElementById('building_floor');
                  var rent = document.getElementById('monthly_rentals');

                  stallSelect.innerHTML = '<option value="">Select Stall</option>';
                  floorSelect.innerHTML = '<option value="">Select Building Floor</option>';
                  rent.value = '';

                  if (building) {
                    $.ajax({
                      url: 'fetch_buildings.php',
                      type: 'GET',
                      data: { building: building },
                      success: function (data) {
                        var stalls = JSON.parse(data);
                        var floors = new Set();

                        if (stalls.length === 0) {
                          stallSelect.innerHTML = '<option value="">No stalls available</option>';
                          floorSelect.innerHTML = '<option value="">No floors available</option>';
                        } else {
                          stalls.forEach(function (stall) {
                            if (stall.stall_status === 'Vacant' && !stall.vendor_id) {
                              var option = document.createElement('option');
                              option.value = stall.stall_no;
                              option.text = stall.stall_no;
                              stallSelect.appendChild(option);

                              floors.add(stall.building_floor);
                            }
                          });

                          floors.forEach(function (floor) {
                            var option = document.createElement('option');
                            option.value = floor;
                            option.text = floor;
                            floorSelect.appendChild(option);
                          });
                        }
                      }
                    });
                  }
                });

                document.getElementById('building_floor').addEventListener('change', function () {
                  var building = document.getElementById('building_type').value;
                  var floor = this.value;
                  var stallSelect = document.getElementById('stall_no');
                  var rent = document.getElementById('monthly_rentals');

                  stallSelect.innerHTML = '<option value="">Select Stall</option>';
                  rent.value = '';

                  if (building && floor) {
                    $.ajax({
                      url: 'fetch_buildings.php',
                      type: 'GET',
                      data: { building: building },
                      success: function (data) {
                        var stalls = JSON.parse(data);

                        if (stalls.length === 0) {
                          stallSelect.innerHTML = '<option value="">No stalls available</option>';
                        } else {
                          stalls.forEach(function (stall) {
                            if (stall.stall_status === 'Vacant' && !stall.vendor_id && stall.building_floor === floor) {
                              var option = document.createElement('option');
                              option.value = stall.stall_no;
                              option.text = stall.stall_no;
                              stallSelect.appendChild(option);
                            }
                          });
                        }
                      }
                    });
                  }
                });


                document.getElementById('stall_no').addEventListener('change', function () {
                  var stallNo = this.value;
                  var building = document.getElementById('building_type').value;
                  var rent = document.getElementById('monthly_rentals');

                  if (stallNo && building) {
                    $.ajax({
                      url: 'fetch_buildings.php',
                      type: 'GET',
                      data: { building: building },
                      success: function (data) {
                        var stalls = JSON.parse(data);
                        var selectedStall = stalls.find(stall => stall.stall_no === stallNo);

                        if (selectedStall) {
                          rent.value = selectedStall.monthly_rentals;
                        } else {
                          rent.value = '';
                        }
                      }
                    });
                  } else {
                    rent.value = '';
                  }
                });

                document.getElementById('building_floor').addEventListener('click', function () {
                  if (!checkBuildingSelected()) {
                    this.blur();
                  }
                });

                document.getElementById('stall_no').addEventListener('click', function () {
                  if (!checkBuildingSelected()) {
                    this.blur();
                  }
                });

                document.getElementById('monthly_rentals').addEventListener('click', function () {
                  if (!checkBuildingSelected()) {
                    this.blur();
                  }
                });
              });


              // Ensure that elements and event listeners only run if the relevant DOM elements exist
              document.getElementById('stallModalBtn')?.addEventListener('click', function () {
                if (checkBuildingSelected()) {
                  alert('Building and stall details confirmed.');
                }
              });

              // Trigger the modal when the stallBtn is clicked
              document.getElementById('stallBtn').addEventListener('click', function () {
                // Show the modal directly when the stallBtn is clicked
                var stallModal = new bootstrap.Modal(document.getElementById('stallModal'));
                stallModal.show();
              });

              // Confirm button inside the modal calls the checkBuildingSelected function
              document.getElementById('stallModalBtn').addEventListener('click', function () {
                if (checkBuildingSelected()) {
                  alert('Building and stall details confirmed.');
                  // Perform additional actions after confirmation if needed
                }
              });
            });
          </script>



          <div class="row my-4">
            <div class="col-lg-11 col-md-6 mb-md-0 mb-4">
              <div class="card">



                <div class="card-header pb-0">
                  <div class="row">
                    <div class="col-lg-6 col-7">
                      <h6>Vendors</h6>
                      <p class="text-sm mb-0">
                        <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                        <span class="font-weight-bold ms-1">Click User to see full details!</span>
                      </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                          <span class="input-group-text text-body"><i class="fas fa-search"
                              aria-hidden="true"></i></span>
                          <input type="text" class="form-control px-1" id="searchInput" placeholder="Search for...">

                          <script>
                            document.getElementById('searchInput').addEventListener('keyup', function () {
                              var filter = this.value.toLowerCase();
                              var rows = document.querySelectorAll('#dataTableBody tr');

                              rows.forEach(function (row) {
                                var text = row.textContent.toLowerCase();
                                row.style.display = text.includes(filter) ? '' : 'none';
                              });
                            });
                          </script>
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
                            Name</th>
                          <th
                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Bulding</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Stall
                            #</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Payment Due</th>
                        </tr>
                      </thead>
                      <tbody id="dataTableBody">
                        <?php
                        include("database_config.php");

                        // Create connection
                        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                        // Check connection
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "
                        SELECT 
                            v.username AS username, 
                            GROUP_CONCAT(a.stall_no ORDER BY a.stall_no ASC) AS stall_nos, 
                            'Building A' AS building, 
                            FORMAT(SUM(COALESCE(CAST(REPLACE(a.monthly_rentals, ',', '') AS DECIMAL(10,2)), 0)), 2) AS payment_due
                        FROM vendors v
                        INNER JOIN building_a a ON v.vendor_id = a.vendor_id
                        GROUP BY v.vendor_id
                        
                        UNION ALL
                        
                        SELECT 
                            v.username AS username, 
                            GROUP_CONCAT(b.stall_no ORDER BY b.stall_no ASC) AS stall_nos, 
                            'Building B' AS building, 
                            FORMAT(SUM(COALESCE(CAST(REPLACE(b.monthly_rentals, ',', '') AS DECIMAL(10,2)), 0)), 2) AS payment_due 
                        FROM vendors v
                        INNER JOIN building_b b ON v.vendor_id = b.vendor_id
                        GROUP BY v.vendor_id
                        
                        UNION ALL
                        
                        SELECT 
                            v.username AS username, 
                            GROUP_CONCAT(c.stall_no ORDER BY c.stall_no ASC) AS stall_nos, 
                            'Building C' AS building, 
                            FORMAT(SUM(COALESCE(CAST(REPLACE(c.monthly_rentals, ',', '') AS DECIMAL(10,2)), 0)), 2) AS payment_due 
                        FROM vendors v
                        INNER JOIN building_c c ON v.vendor_id = c.vendor_id
                        GROUP BY v.vendor_id
                        
                        UNION ALL
                        
                        SELECT 
                            v.username AS username, 
                            GROUP_CONCAT(d.stall_no ORDER BY d.stall_no ASC) AS stall_nos, 
                            'Building D' AS building, 
                            FORMAT(SUM(COALESCE(CAST(REPLACE(d.monthly_rentals, ',', '') AS DECIMAL(10,2)), 0)), 2) AS payment_due 
                        FROM vendors v
                        INNER JOIN building_d d ON v.vendor_id = d.vendor_id
                        GROUP BY v.vendor_id
                        
                        UNION ALL
                        
                        SELECT 
                            v.username AS username, 
                            GROUP_CONCAT(e.stall_no ORDER BY e.stall_no ASC) AS stall_nos, 
                            'Building E' AS building, 
                            FORMAT(SUM(COALESCE(CAST(REPLACE(e.monthly_rentals, ',', '') AS DECIMAL(10,2)), 0)), 2) AS payment_due
                        FROM vendors v
                        INNER JOIN building_e e ON v.vendor_id = e.vendor_id
                        GROUP BY v.vendor_id
                        
                        UNION ALL
                        
                        SELECT 
                            v.username AS username, 
                            GROUP_CONCAT(f.stall_no ORDER BY f.stall_no ASC) AS stall_nos, 
                            'Building F' AS building, 
                            FORMAT(SUM(COALESCE(CAST(REPLACE(f.monthly_rentals, ',', '') AS DECIMAL(10,2)), 0)), 2) AS payment_due
                        FROM vendors v
                        INNER JOIN building_f f ON v.vendor_id = f.vendor_id
                        GROUP BY v.vendor_id
                        
                        UNION ALL
                        
                        SELECT 
                            v.username AS username, 
                            GROUP_CONCAT(g.stall_no ORDER BY g.stall_no ASC) AS stall_nos, 
                            'Building G' AS building, 
                            FORMAT(SUM(COALESCE(CAST(REPLACE(g.monthly_rentals, ',', '') AS DECIMAL(10,2)), 0)), 2) AS payment_due
                        FROM vendors v
                        INNER JOIN building_g g ON v.vendor_id = g.vendor_id
                        GROUP BY v.vendor_id
                        
                        UNION ALL
                        
                        SELECT 
                            v.username AS username, 
                            GROUP_CONCAT(h.stall_no ORDER BY h.stall_no ASC) AS stall_nos, 
                            'Building H' AS building, 
                            FORMAT(SUM(COALESCE(CAST(REPLACE(h.monthly_rentals, ',', '') AS DECIMAL(10,2)), 0)), 2) AS payment_due
                        FROM vendors v
                        INNER JOIN building_h h ON v.vendor_id = h.vendor_id
                        GROUP BY v.vendor_id
                        
                        UNION ALL
                        
                        SELECT 
                            v.username AS username, 
                            GROUP_CONCAT(i.stall_no ORDER BY i.stall_no ASC) AS stall_nos, 
                            'Building I' AS building, 
                            FORMAT(SUM(COALESCE(CAST(REPLACE(i.monthly_rentals, ',', '') AS DECIMAL(10,2)), 0)), 2) AS payment_due 
                        FROM vendors v
                        INNER JOIN building_i i ON v.vendor_id = i.vendor_id
                        GROUP BY v.vendor_id
                        
                        UNION ALL
                        
                        SELECT 
                            v.username AS username, 
                            GROUP_CONCAT(j.stall_no ORDER BY j.stall_no ASC) AS stall_nos, 
                            'Building J' AS building, 
                            FORMAT(SUM(COALESCE(CAST(REPLACE(j.monthly_rentals, ',', '') AS DECIMAL(10,2)), 0)), 2) AS payment_due
                        FROM vendors v
                        INNER JOIN building_j j ON v.vendor_id = j.vendor_id
                        GROUP BY v.vendor_id
                        
                        ORDER BY stall_nos ASC
                    ";
                    

                        $resultV = $conn->query($sql);

                        if ($resultV === false) {
                          die("Error executing query: " . $conn->error);
                        }

                        if ($resultV->num_rows > 0) {
                          while ($rowV = $resultV->fetch_assoc()) {
                            ?>
                            <tr>
                              <td class='text-center text-xs font-weight-bold'><?php echo htmlspecialchars($rowV['username']); ?></td>
                              <td class='text-center text-xs font-weight-bold'><?php echo htmlspecialchars($rowV['building']); ?></td>
                              <td class='text-center text-xs font-weight-bold'><?php echo htmlspecialchars($rowV['stall_nos']); // Display concatenated stalls ?></td>
                              <td class='text-center text-xs font-weight-bold'>
                                <?php echo htmlspecialchars($rowV['payment_due']); ?>
                              </td>
                            </tr>
                            <?php
                          }
                        } else {
                          ?>
                          <tr>
                            <td colspan='5' class='text-center'>No results found.</td>
                          </tr>
                          <?php
                        }
                        //  $conn->close();
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>

            </div>
          </div>

      </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" href="#">
      <i class="fas fa-cog"></i> </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">

          <h5 class="text-center">Username: <span
              class="text-info"><?php echo htmlspecialchars($user['first_name']) ?></span> </h5>
          <p>Role: <span class="text-info"><?php echo htmlspecialchars($user['user_type']) ?></span> </p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <a class="btn bg-gradient-info w-85 text-white mx-4" href="..Admin">Edit Profile</a>
        <a class="btn btn-outline-info w-85 mx-4" href="index.php">Logout</a>
        <hr class="horizontal dark my-1">
        <div class="text-small">Fixed Navbar</div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
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

  <!--     
  <link rel="stylesheet" href="loading.css">
  <script src="loading.js" defer></script>
  <div class="loader"></div> -->

</body>

</html>