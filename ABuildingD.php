<?php
include('Sessions/Admin.php');


    include("database_config.php");
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    $sqluser = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sqluser);
    $stmt = $conn->prepare($sqluser);
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
  
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pathId'])) {
      $pathId = $_POST['pathId'];
  
      $sql = "SELECT a.stall_no, a.stall_status AS status, username
      FROM building_a a
      JOIN vendors v on a.vendor_id = v.vendor_id
      WHERE stall_no = ?";
      $stmt = $conn->prepare($sql);
      if ($stmt === false) {
          die("Prepare failed: " . $conn->error);
      }
      $stmt->bind_param("s", $pathId);
      $stmt->execute();
      $result = $stmt->get_result();

      $response = [];

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response['stall_no'] = $row['stall_no'];
            $response['status'] = $row['status'];

            if($row['status'] == 'Vacant') {
              $response['username'] = $row['status'];
          } else if ($row['status'] == 'Occupied') {
            $response['username'] = $row['username'];
          }
        }
    } else {
        $response['username'] = 'NO STALL FOUND';
    }

           // Return JSON response
           header('Content-Type: application/json');
           echo json_encode($response);
           exit();
  
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
              <a class="nav-link" href="ABuildingB.php">Building B</a>
              <a class="nav-link" href="ABuildingC.php">Building C</a>
              <a class="nav-link" href="ABuildingD.php">Building D</a>
              <a class="nav-link" href="ABuildingE.php">Building E</a>
              <a class="nav-link" href="ABuildingF.php">Building F</a>
              <a class="nav-link" href="ABuildingG.php">Building G</a>
              <a class="nav-link" href="ABuildingH.php">Building H</a>
              <a class="nav-link" href="ABuildingI.php">Building I</a>
              <a class="nav-link" href="ABuildingJ.php">Building J</a>
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
              <a class="nav-link" href="AMUser.php">Users</a>
              <a class="nav-link" href="AMVendor.php">Vendors</a>
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
    <div class="col-lg-14 px-5">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Occupied Stalls</p>
                    <h6 class="font-weight-bolder mb-0">
                        <?php
                        // Database connection parameters
                        include("database_config.php");
                        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
                        
                        if ($conn->connect_error) {
                            throw new Exception("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to count vacant stalls from stall 1 to 68
                        $sql = "SELECT COUNT(*) as total_vacant 
                                FROM building_a 
                                WHERE stall_status = 'Occupied' 
                                AND stall_no BETWEEN 'A-01' AND 'A-68'";

                        $result = $conn->query($sql);

                        // Check if query was successful
                        if ($result->num_rows > 0) {
                            // Fetch result
                            $row = $result->fetch_assoc();
                            echo "First Floor: " . $row['total_vacant'];
                        } else {
                            echo "No vacant stalls found.";
                        }

                        $sql = "SELECT stall_no FROM building_a WHERE stall_status = 'Occupied' 
                        AND stall_no BETWEEN 'A-01' AND 'A-68'";
                        $result = $conn->query($sql);

                        $occupied_stalls = [];
                        if ($result->num_rows > 0) {
                            // Fetch all occupied stalls
                            while($row = $result->fetch_assoc()) {
                                $occupied_stalls[] = $row['stall_no'];
                            }
                        } else {
                            $occupied_stalls[] = "No occupied stalls found";
                        }

                        // Close connection
                        $conn->close();
                        ?>
                      </h6>
                  </div>
                </div>


                <style>
                  /* Styling for dropdown */
                  .stall-dropdown {
                      display: none;
                      position: absolute;
                      background-color: #f9f9f9;
                      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
                      z-index: 1;
                      list-style-type: none;
                      padding: 10px;
                      border-radius: 5px;
                      max-height: 200px;
                      overflow-y: auto;
                  }

                  /* Hover effect to display dropdown */
                  .icon:hover .stall-dropdown {
                      display: block;
                  }

                  .stall-dropdown li {
                      padding: 5px 10px;
                      border-bottom: 1px solid #ddd;
                      transition: ease 0.7s;
                  }

                  .stall-dropdown li:hover {
                      background-color: #f1f1f1;
                  }
              </style>

              <!-- Hoverable Div with Dropdown -->
              <div class="icon icon-shape bg-danger shadow text-center border-radius-md">
                  <i class="bi bi-shop text-lg opacity-10" aria-hidden="true"></i>
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-shop mt-2" viewBox="0 0 16 16" aria-hidden="true">
                      <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
                  </svg>

                  <!-- Dropdown that appears on hover -->
                  <ul class="stall-dropdown">
                      <?php foreach ($occupied_stalls as $stall): ?>
                          <li><?php echo "Stall: " . $stall; ?></li>
                      <?php endforeach; ?>
                  </ul>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Vacant</p>
                    <h6 class="font-weight-bolder mb-0">
                        <?php
                        // Database connection parameters
                        include("database_config.php");
                        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
                        
                        if ($conn->connect_error) {
                            throw new Exception("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to count vacant stalls from stall 1 to 68
                        $sql = "SELECT COUNT(*) as total_vacant 
                                FROM building_a 
                                WHERE stall_status = 'Vacant' 
                                AND stall_no BETWEEN 'A-01' AND 'A-68'";

                        $result = $conn->query($sql);

                        // Check if query was successful
                        if ($result->num_rows > 0) {
                            // Fetch result
                            $row = $result->fetch_assoc();
                            echo "First Floor: " . $row['total_vacant'];
                        } else {
                            echo "No vacant stalls found.";
                        }

                        // SQL query to get all vacant stalls
                      $queryGet = "SELECT stall_no 
                      FROM building_a 
                      WHERE stall_status = 'Vacant' 
                      AND stall_no BETWEEN 'A-01' AND 'A-68'";

                      $resultnya = $conn->query($queryGet);

                      // Initialize an array to store vacant stalls
                      $vacant_stalls = [];

                      if ($resultnya->num_rows > 0) {
                      // Fetch all results
                      while($row = $resultnya->fetch_assoc()) {
                      $vacant_stalls[] = $row['stall_no'];  // Store each building_id
                      }
                      } else {
                      echo "No vacant stalls found.";
                      }

                      // Close connection
                      $conn->close();
                        ?>
                      </h6>
                  </div>
                </div>

                <div class="icon icon-shape bg-success shadow text-center border-radius-md">
                  <i class="bi bi-shop text-lg opacity-10" aria-hidden="true"></i>
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-shop-window mt-2" viewBox="0 0 16 16">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5m2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5"/>
                  </svg>

                  <!-- Dropdown that appears on hover -->
                  <ul class="stall-dropdown">
                      <?php foreach ($vacant_stalls as $stall): ?>
                          <li><?php echo "Stall: " . $stall; ?></li>
                      <?php endforeach; ?>
                  </ul>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Stalls</p>
                    <h6 class="font-weight-bolder mb-0">
                    <?php
                      // Database connection parameters
                      include("database_config.php");
                      $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
                      if ($conn->connect_error) {
                          throw new Exception("Connection failed: " . $conn->connect_error);
                      }
                  
                      // SQL query to count vacant stalls
                      $sql = "SELECT COUNT(*) as total_stalls
                              FROM building_a 
                              WHERE stall_no BETWEEN 'A-01' AND 'A-67'";
                      $result = $conn->query($sql);

                      // Check if query was successful
                      if ($result->num_rows > 0) {
                          // Fetch result
                          $row = $result->fetch_assoc();
                          echo "First Floor: " . $row['total_stalls'];
                      } else {
                          echo "No stalls found.";
                      }

                      // Close connection
                      $conn->close();
                      ?>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-info shadow text-center border-radius-md">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-file-ruled mt-2" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1zm9 6H6v2h7zm0 3H6v2h7zm0 3H6v2h6a1 1 0 0 0 1-1zm-8 2v-2H3v1a1 1 0 0 0 1 1zm-2-3h2v-2H3zm0-3h2V7H3z"/>
                  </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Stalls</p>
                    <h6 class="font-weight-bolder mb-0">
                    <?php
                      // Database connection parameters
                      include("database_config.php");
                      $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
                      if ($conn->connect_error) {
                          throw new Exception("Connection failed: " . $conn->connect_error);
                      }
                  
                      // SQL query to count vacant stalls
                      $sql = "SELECT COUNT(*) as total_stalls
                              FROM building_a 
                              WHERE stall_no BETWEEN 'A-01' AND 'A-94'";
                      $result = $conn->query($sql);

                      // Check if query was successful
                      if ($result->num_rows > 0) {
                          // Fetch result
                          $row = $result->fetch_assoc();
                          echo "1st & 2nd Floor: " . $row['total_stalls'];
                      } else {
                          echo "No stalls found.";
                      }

                      // Close connection
                      $conn->close();
                      ?>
                    </h6>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-info shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <br>
        <div class="row mt-2 d-flex flex-column align-items-center">
            <div class="d-flex flex-column py-3 px-3">
              <p class="text-title mb-3">Actions</p>
              <div class="d-flex align-items-center">
                <button type="button" class="btn btn-info me-3" data-bs-toggle="modal" data-bs-target="#addVendorModal">
                  Assign Vendor to Stall
                </button>
                <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#removeVendorModal">
                  Remove Assigned Vendor
                </button>
                <nav aria-label="Page navigation example">
                  <ul class="pagination mb-0">
                    <p class="mt-1 px-3 text-info">Floors</p>
                    <li class="page-item mx-1" data-bs-toggle="tooltip-info" data-bs-placement="top" data-bs-title="Ground Floor">
                      <a class="page-link" href="ABuildingA.php">1</a>
                    </li>
                    <li class="page-item mx-1" data-bs-toggle="tooltip-info" data-bs-placement="top" data-bs-title="Second Floor">
                      <a class="page-link" href="ABuildingA2.php">2</a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
      <br>
      <div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addVendorModalLabel">Assign Vendor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addVendorForm" action="add_vendor.php" method="POST" enctype="multipart/form-data">
            <div class="container-fluid">
              <div class="row">
                <!-- Stall Number -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="stall_no">Stall Number:</label>
                    <input type="text" id="stall_no" name="stall_no" class="form-control" required>
                    <div class="invalid-feedback">Please enter the stall number.</div>
                  </div>
                </div>
                <!-- Building Type -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="building_type">Building Type:</label>
                    <select id="building_type" name="building_type" class="form-control" required>
                      <option value="">Select Building Type</option>
                      <option value="Building A">Building A</option>
                      <option value="Building B">Building B</option>
                      <option value="Building C">Building C</option>
                      <option value="Building D">Building D</option>
                      <option value="Building E">Building E</option>
                      <option value="Building F">Building F</option>
                      <option value="Building G">Building G</option>
                      <option value="Building H">Building H</option>
                      <option value="Building I">Building I</option>
                      <option value="Building J">Building J</option>
                    </select>
                    <div class="invalid-feedback">Please select a building type.</div>
                  </div>
                </div>
                <!-- Building Floor -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="building_floor">Building Floor:</label>
                    <select id="building_floor" name="building_floor" class="form-control" required>
                      <option value="Ground Floor"></option>
                      <option value="Ground Floor">Ground Floor</option>
                      <option value="Second Floor">Second Floor</option>
                    </select>
                    <div class="invalid-feedback">Please select a building floor.</div>
                  </div>
                </div>
                  <!-- Vendor ID -->
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="vendor_id">Vendor ID:</label>
                    <input type="text" id="vendor_id" name="vendor_id" class="form-control" required>
                    <div class="invalid-feedback">Please enter the vendor ID.</div>
                  </div>
                </div>
                  <!-- Monthly Rental -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="started_date">Started Date:</label>
                    <input type="datetime" id="started_date" name="started_date" class="form-control" required>
                    <div class="invalid-feedback">Please enter the monthly rental.</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="monthly_rental">Monthly Rental:</label>
                    <input type="number" id="monthly_rental" name="monthly_rental" class="form-control" required>
                    <div class="invalid-feedback">Please enter the monthly rental.</div>
                  </div>
                </div>


              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer my-2" style="align-items: center; justify-content: center;">
          <button type="submit" form="addVendorForm" class="btn btn-info">Add Vendor</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="removeVendorModal" tabindex="-1" aria-labelledby="removeVendorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeVendorModalLabel">Remove Assigned Vendor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="removeVendorForm" action="remove_vendor.php" method="POST" enctype="multipart/form-data">
            <div class="container-fluid">
              <div class="row">
                <!-- Stall Number -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="stall_no">Stall Number:</label>
                    <input type="text" id="stall_no" name="stall_no" class="form-control" required>
                    <div class="invalid-feedback">Please enter the stall number.</div>
                  </div>
                </div>
                <!-- Building Type -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="building_type">Building Type:</label>
                    <select id="building_type" name="building_type" class="form-control" required>
                      <option value="">Select Building Type</option>
                      <option value="Building A">Building A</option>
                      <option value="Building B">Building B</option>
                      <option value="Building C">Building C</option>
                      <option value="Building D">Building D</option>
                      <option value="Building E">Building E</option>
                      <option value="Building F">Building F</option>
                      <option value="Building G">Building G</option>
                      <option value="Building H">Building H</option>
                      <option value="Building I">Building I</option>
                      <option value="Building J">Building J</option>
                    </select>
                    <div class="invalid-feedback">Please select a building type.</div>
                  </div>
                </div>
                <!-- Building Floor -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="building_floor">Building Floor:</label>
                    <select id="building_floor" name="building_floor" class="form-control" required>
                      <option value="Ground Floor"></option>
                      <option value="Ground Floor">Ground Floor</option>
                      <option value="Second Floor">Second Floor</option>
                    </select>
                    <div class="invalid-feedback">Please select a building floor.</div>
                  </div>
                </div>
                  <!-- Vendor ID -->
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="vendor_id">Vendor ID:</label>
                    <input type="text" id="vendor_id" name="vendor_id" class="form-control" required>
                    <div class="invalid-feedback">Please enter the vendor ID.</div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer my-2" style="align-items: center; justify-content: center;">
          <button type="submit" form="removeVendorForm" class="btn btn-danger">Remove Vendor</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
     <!-- Modal for Adding New Vendor -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <div class="col-lg-14 px-5">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Building A</h6>
              <p class="text-sm">
                <i class="fa fa-building-o fa-lg text-warning"></i>
                <span class="font-weight-bold">Description: </span>
              </p>  
            </div>
            

            <svg id="svg1" version="1.1" viewBox="0 0 1344 816" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
 <g id="g25" transform="matrix(1.2681 0 0 1.187 -30.092 -151.55)">
  <g id="g1">
   <image id="image1" transform="matrix(420.33 0 0 87.067 42.667 663.43)" width="1" height="1" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
   <image id="image2" transform="matrix(474.93 0 0 99.933 29.867 198.43)" width="1" height="1" preserveAspectRatio="none" xlink:href="data:image/png;base64,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Emh+v59bM1LNFGlmLpeLXWY0idXV1SygqGEFxTUpvZ1iZnINK8W6iouL0adPH2zdupWZ544dO9hFSEIRULpNgObMRNq0kUgEtbW10Gg06N69O3755Rc8+eST2L9/f9J1qK+vx3XXXQcAmDNnDm677TZWZO6//358+eWXKCgoQGVlJbp27YqJEyfi9ttv53pHei96J2rlSIKE5p4ELREhtSez2WwKa5pcLeQupppT+k7PPZaorKxkRcBms6G6uhrLli3D559/jmAwiOzsbO4UBcQZ38qVK/Htt98iGAxi5MiROPHEE/H555/zuu3fv59by5Hmv2fPHoVScdJJJ7U41i0Z6P/kESLI5x6r1WoUFhaisLAQffr0wapVq+D3+5Geno6GhgZ88sknuOmmm/jaSCSCU045BSeddBLWrl2LnTt3onPnzjAYDOjdu3cLZj9w4EAusQCaBS255ih7WS57A5rP6iW6yM/PR/fu3XHGGWfA4/FgwYIFnK3/r3/9CzfccANnlX/yySdsQQLAfffdx0010tLScP3112PRokX4/vvvUV9fj61bt6KsrAyjRo0CoIzNJ8s4ppwFEhY33XQTW++xWAybN2/GggUL8MYbb3ASzezZs1FSUoJBgwbxu8llTiaTCcuWLVO0SB02bBjS09Ph8Xh4vaikKTHGSF4CGbIQobyQ0047DSeffDJ74bxeL1577TU8+eST7Hb+/PPP8cILL+Dee+/lZ1FMncoBhw4dyp3EjEYjsrOz0bt3b/zwww/8zE2bNrEhRFagXKUh8yaNRoOLLroIY8eORSwWQ319PQKBAObMmYNnnnkG0WgUlZWVqKysxC233IKzzz4bHo+H8xUGDx6seF+LxYLi4mJ069YNF110EWKxGOfg7N+/H4MHD+a1lWPZ8j2oRO2MM87Aqaeeyp3gysvLsXHjRtx77738uU8//RTLli3jsNn06dPx7bffAoiHQE4//XSUl5ejurqav9McZGRkwOPx4N///jdyc3NbfboQ4ajU0VJskTS9uro67Ny5E4888gjOOOMMjB07Fpdddhk+//xzxTUvv/wyxowZg8mTJ8NisXAJgNFoxN69e3H22Wdj6NChOPvss3HnnXcqiNlgMGDSpEm477778MMPP7B5T+4y2mR0rqF8CLNareYWZA6HQ9GcgJKGqKVdWloaC3EScNRuEogH+V0u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"/>
   <image id="image3" transform="matrix(470.4 0 0 85.193 458.13 667.7)" width="1" height="1" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
   <image id="image4" transform="matrix(445.33 0 0 104.13 494.4 196.29)" width="1" height="1" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
   <image id="image5" transform="matrix(128.93 0 0 108.47 955.13 654.64)" width="1" height="1" style="image-rendering:optimizeSpeed" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
  </g>
 </g>

 <a id="D-01" data-stall-no="D-01" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-1">
  <path id="path26" d="m29.813 651.47-2.2084 80.606 53.001-3.3126-2.2084-76.189z" style="opacity:0"/>
 </g>
</a>

<a id="D-02" data-stall-no="D-02" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-2">
  <path id="path27" d="m83.367 648.71-1.1042 80.606 43.616 2.2084 1.1042-80.054z" style="opacity:0"/>
 </g>
</a>

<a id="D-03" data-stall-no="D-03" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-3">
  <path id="path28" d="m131.95 652.58-0.5521 74.533 41.959 1.6563-1.1042-76.189z" style="opacity:0"/>
 </g>
</a>

<a id="D-04" data-stall-no="D-04" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-4">
  <path id="path29" d="m179.43 652.03v76.189l41.407-1.1042 1.1042-75.085z" style="opacity:0"/>
 </g>
</a>

<a id="D-05" data-stall-no="D-05" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-5">
  <path id="path30" d="m228.02 652.03-2.2084 75.637 40.855 1.6563 0.5521-76.742z" style="opacity:0"/>
 </g>
</a>

<a id="D-06" data-stall-no="D-06" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-6">
  <path id="path31" d="m274.94 652.58-1.6563 75.637 44.168-1.1042 1.6563-75.085z" style="opacity:0"/>
 </g>
</a>

<a id="D-07" data-stall-no="D-07" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-7">
  <path id="path32" d="m324.63 652.03v75.085l39.751 1.6563-0.55209-75.085z" style="opacity:0"/>
 </g>
</a>

<a id="D-08" data-stall-no="D-08" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-8">
  <path id="path33" d="m371.01 653.68-0.55209 73.429h45.272l1.6563-75.085z" style="opacity:0"/>
 </g>
</a>

<a id="D-09" data-stall-no="D-09" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-9">
  <path id="path34" d="m424.01 652.58-0.5521 74.533 40.855-0.55209-0.5521-74.533z" style="opacity:0"/>
 </g>
</a>

<a id="D-10" data-stall-no="D-10" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-10">
  <path id="path35" d="m469.83 652.58-1.1042 75.085 39.751-0.5521-0.5521-77.846z" style="opacity:0"/>
 </g>
</a>

<a id="D-11" data-stall-no="D-11" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-11">
  <path id="path36" d="m512.35 652.58v73.981l38.647 0.55209-1.1042-73.429z" style="opacity:0"/>
 </g>
</a>

<a id="D-12" data-stall-no="D-12" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-12">
  <path id="path37" d="m557.07 652.58 1.1042 76.189 45.824-0.5521 0.5521-73.981z" style="opacity:0"/>
 </g>
</a>

<a id="D-13" data-stall-no="D-13" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-13">
  <path id="path38" d="m611.72 653.68 1.1042 74.533 45.824 2.2084 3.3126-80.054z" style="opacity:0"/>
 </g>
</a>

<a id="D-14" data-stall-no="D-14" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-14">
  <path id="path39" d="m669.14 652.03-1.1042 77.846 45.272-0.5521v-76.189z" style="opacity:0"/>
 </g>
</a>

<a id="D-15" data-stall-no="D-15" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-15">
  <path id="path40" d="m719.94 653.68 0.5521 73.981h44.72l1.6563-75.085z" style="opacity:0"/>
 </g>
</a> 

<a id="D-16" data-stall-no="D-16" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-16">
  <path id="path41" d="m771.28 652.58v74.533l45.824 2.2084 0.55209-76.742z" style="opacity:0"/>
 </g>
</a>

<a id="D-17" data-stall-no="D-17" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-17">
  <path id="path42" d="m825.94 655.89-1.6563 72.325 49.137 2.2084 1.6563-78.398z" style="opacity:0"/>
 </g>
</a>

<a id="D-18" data-stall-no="D-18" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-18">
  <path id="path43" d="m881.7 651.47v75.637h44.168l1.1042-73.981z" style="opacity:0"/>
 </g>
</a>

<a id="D-19" data-stall-no="D-19" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-19">
  <path id="path44" d="m933.6 653.68-1.6563 73.981 50.241 0.5521 2.7605-74.533z" style="opacity:0"/>
 </g>
</a>

<a id="D-20" data-stall-no="D-20" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-20">
  <path id="path45" d="m994.33 651.47-3.3126 76.742 46.928-1.1042 0.5521-73.981z" style="opacity:0"/>
 </g>
</a>

<a id="D-21" data-stall-no="D-21" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-21">
  <path id="path46" d="m1045.1 653.13-2.2084 75.085 43.064 0.5521v-77.294z" style="opacity:0"/>
 </g>
</a>

<a id="D-22" data-stall-no="D-22" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-22">
  <path id="path47" d="m1093.2 652.58-2.2084 75.085 42.512 1.1042-0.5521-74.533z" style="opacity:0"/>
 </g>
</a>

<a id="D-23" data-stall-no="D-23" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-23">
  <path id="path48" d="m1100.1 106 0.2761 72.877 37.819 0.82814 0.276-74.533z" style="opacity:0"/>
 </g>
</a>

<a id="D-24" data-stall-no="D-24" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-24">
  <path id="path49" d="m1055.9 105.17-0.5521 75.637 39.199-0.27605 0.276-75.637z" style="opacity:0"/>
 </g>
</a>

<a id="D-25" data-stall-no="D-25" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-25">
  <path id="path50" d="m1008.1 105.17-2.4844 74.809 44.168 0.27605-0.5521-75.637z" style="opacity:0"/>
 </g>
</a>

<a id="D-26" data-stall-no="D-26" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-26">
  <path id="path51" d="m951.26 104.9 0.82815 75.361 49.965-0.5521-0.276-73.981z" style="opacity:0"/>
 </g>
</a>

<a id="D-27" data-stall-no="D-27" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-27">
  <path id="path52" d="m904.89 104.35-1.6563 77.018 41.959-0.5521 1.9323-74.257z" style="opacity:0"/>
 </g>
</a>

<a id="D-28" data-stall-no="D-28" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-28">
  <path id="path53" d="m852.16 105.17-1.1042 74.257 46.376 0.82815 0.27605-75.085z" style="opacity:0"/>
 </g>
</a>

<a id="D-29" data-stall-no="D-29" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-29">
  <path id="path54" d="m803.58 105.17-1.1042 75.361 41.959 0.5521 0.27605-75.085z" style="opacity:0"/>
 </g>
</a>

<a id="D-30" data-stall-no="D-30" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-30">
  <path id="path55" d="m754.72 106.55-1.1042 76.189 43.34-1.1042 0.27605-76.465z" style="opacity:0"/>
 </g>
</a>

<a id="D-31" data-stall-no="D-31" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-31">
  <path id="path56" d="m704.75 106 0.5521 74.809 42.512-0.27605 1.1042-77.018z" style="opacity:0"/>
 </g>
</a>

<a id="D-32" data-stall-no="D-32" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-32">
  <path id="path57" d="m652.03 106.55-0.82814 75.085 47.48-0.27604v-74.257z" style="opacity:0"/>
 </g>
</a>

<a id="D-33" data-stall-no="D-33" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-33">
  <path id="path58" d="m602.06 103.79-0.27605 77.57 44.996 0.55209v-77.294z" style="opacity:0"/>
 </g>
</a>

<a id="D-34" data-stall-no="D-34" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-34">
  <path id="path59" d="m553.48 106.83 0.5521 73.429 43.34 1.6563-2.2084-77.57z" style="opacity:0"/>
 </g>
   
</a>

<a id="D-35" data-stall-no="D-35" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-35">
  <path id="path60" d="m505.45 105.45 0.55209 75.637 43.616 1.9323-2.2084-77.57z" style="opacity:0"/>
 </g>
</a>


<a id="D-36" data-stall-no="D-36" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-36">
  <path id="path61" d="m456.31 106.55-1.9324 74.809 46.1 0.55209-0.27605-75.361z" style="opacity:0"/>
 </g>
</a>

<a id="D-37" data-stall-no="D-37" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-37">
  <path id="path62" d="m398.06 104.35v76.466l49.965 1.1042 0.82815-77.018z" style="opacity:0"/>
 </g>
</a>

<a id="D-38" data-stall-no="D-38" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-38">
  <path id="path63" d="m347.55 106-1.6563 76.189 44.72-1.1042 0.27605-75.085z" style="opacity:0"/>
 </g>
</a>

<a id="D-39" data-stall-no="D-39" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-39">
  <path id="path65" d="m292.61 105.45-1.9323 76.189 49.137-1.1042-0.27605-75.637z" style="opacity:0"/>
 </g>
</a>

<a id="D-40" data-stall-no="D-40" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-40">
  <path id="path64" d="m238.23 105.73-0.5521 77.018h44.72l2.4844-77.018z" style="opacity:0"/>
 </g>
</a>

<a id="D-41" data-stall-no="D-41" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-41">
  <path id="path66" d="m189.09 106-2.2084 77.57 45.824-1.1042-0.82815-75.085z" style="opacity:0"/>
 </g>
</a>

<a id="D-42" data-stall-no="D-42" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-42">
  <path id="path67" d="m137.2 106.55-1.9323 74.533 44.996 2.4844 1.6563-77.018z" style="opacity:0"/>
 </g>
</a>

<a id="D-43" data-stall-no="D-43" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-43">
  <path id="path68" d="m81.434 104.62-2.4844 78.674 49.689-1.1042v-75.361z" style="opacity:0"/>
 </g>
</a>

<a id="D-44" data-stall-no="D-44" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-44">
  <path id="path69" d="m27.329 107.38v75.085l46.652 0.27605 0.27605-77.846z" style="opacity:0"/>
 </g>
</a>

<a id="D-45" data-stall-no="D-45" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-45">
  <path id="path70" d="m1200.1 648.83v81.982h52.312l5.4655-81.202z" style="opacity:0"/>
 </g>
</a>

<a id="D-46" data-stall-no="D-46" data-bs-toggle="tooltip" type="button" class="btn btn-secondary" 
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="D-46">
  <path id="path71" d="m1264.1 648.83-0.7808 82.763 56.216 1.5616 2.3424-85.105z" style="opacity:0"/>
 </g>
</a>

</svg>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      var stallNo = tooltipTriggerEl.getAttribute('data-stall-no'); // Get stall_no from data attribute

      // Fetch the stall status and occupant via AJAX
      fetch('fetch_stall_statusD.php?stall_no=' + stallNo)
        .then(response => response.json()) // Parse JSON response
        .then(data => {
          // Update the title attribute with both the stall status and occupant
          tooltipTriggerEl.setAttribute('title', 'Status: ' + data.stall_status + ' | Occupant: ' + data.vendor_name);

          // Dynamically set the tooltip background color based on stall status
          var tooltipClass = 'custom-tooltip-' + stallNo; // Unique class for each tooltip
          
          var tooltipStyles = document.createElement('style');
          tooltipStyles.innerHTML = `
            .${tooltipClass} .tooltip-inner {
              background-color: ${data.stall_status === 'Vacant' ? 'green' : 'red'} !important;
            }
          `;
          document.head.appendChild(tooltipStyles);

          // Add the custom class to the tooltip
          tooltipTriggerEl.setAttribute('data-bs-custom-class', tooltipClass);

          // Initialize the tooltip
          new bootstrap.Tooltip(tooltipTriggerEl);
        })
        .catch(error => {
          console.error('Error fetching stall status:', error);
        });
    });
  });
</script>

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
          <h5 class="mt-3 mb-0"><?php echo $user['username'];?></h5>
          <p>Admin</p>
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
</body>

</html>