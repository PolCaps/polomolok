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
            

            <svg id="bx" version="1.1" viewBox="0 0 1122.7 1588" xmlns="http://www.w3.org/2000/svg">
 <defs id="by">
  <clipPath id="bw">
   <path id="bz" transform="translate(-2.0833e-7 -.00020833)" d="m585 714h5866v8292h-5866v-8292"/>
  </clipPath>
  <clipPath id="bv">
   <path id="ca" transform="translate(-2.0833e-7 -.00020833)" d="m585 714h5866v8292h-5866v-8292"/>
  </clipPath>
  <clipPath id="bu">
   <path id="cb" transform="matrix(1,0,0,-1,-3133,8623)" d="m585 714h5866v8292h-5866v-8292"/>
  </clipPath>
  <clipPath id="bt">
   <path id="cc" transform="translate(-2.0833e-7 -.00020833)" d="m585 714h5866v8292h-5866v-8292"/>
  </clipPath>
  <clipPath id="bs">
   <path id="cd" transform="matrix(1 0 0 -1 -1593 1618)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="br">
   <path id="ce" transform="matrix(1 0 0 -1 -2074 1523)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bq">
   <path id="cf" transform="matrix(1 0 0 -1 -2725 1545)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bp">
   <path id="cg" transform="matrix(1 0 0 -1 -4345 1562)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bo">
   <path id="ch" transform="matrix(1 0 0 -1 -4966 1547)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bn">
   <path id="ci" transform="matrix(1 0 0 -1 -4328 2068)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bm">
   <path id="cj" transform="matrix(1 0 0 -1 -4220 1839)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bl">
   <path id="ck" transform="matrix(1 0 0 -1 -4217 1757)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bk">
   <path id="cl" transform="matrix(1 0 0 -1 -4929 1968)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bj">
   <path id="cm" transform="matrix(1 0 0 -1 -2751 1983)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bi">
   <path id="cn" transform="matrix(1 0 0 -1 -2137 1981)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bh">
   <path id="co" transform="matrix(1 0 0 -1 -2535 2613)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bg">
   <path id="cp" transform="matrix(1,0,0,-1,-1144,6080)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bf">
   <path id="cq" transform="matrix(1,0,0,-1,-1208,6689)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="be">
   <path id="cr" transform="matrix(1,0,0,-1,-1176,7802)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bd">
   <path id="cs" transform="matrix(1,0,0,-1,-1139,7258)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bc">
   <path id="ct" transform="matrix(1,0,0,-1,-1147,8451)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="bb">
   <path id="cu" transform="matrix(1,0,0,-1,-1583,8449)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ba">
   <path id="cv" transform="matrix(1,0,0,-1,-1571,7808)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="az">
   <path id="cw" transform="matrix(1,0,0,-1,-1591,7255)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ay">
   <path id="cx" transform="matrix(1,0,0,-1,-1632,6676)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ax">
   <path id="cy" transform="matrix(1,0,0,-1,-1607,6060)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="aw">
   <path id="cz" transform="matrix(1,0,0,-1,-1571,4179)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="av">
   <path id="da" transform="matrix(1 0 0 -1 -1567 3551)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="au">
   <path id="db" transform="matrix(1 0 0 -1 -1578 2893)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="at">
   <path id="dc" transform="matrix(1 0 0 -1 -1557 2328)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="as">
   <path id="dd" transform="matrix(1 0 0 -1 -5923 2206)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ar">
   <path id="de" transform="matrix(1,0,0,-1,-4691,8476)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="aq">
   <path id="df" transform="matrix(1 0 0 -1 -5933 2849)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ap">
   <path id="dg" transform="matrix(1,0,0,-1,-5961,4065)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ao">
   <path id="dh" transform="matrix(1,0,0,-1,-5930,4796)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="an">
   <path id="di" transform="matrix(1,0,0,-1,-6009,6055)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="am">
   <path id="dj" transform="matrix(1,0,0,-1,-5997,6672)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="al">
   <path id="dk" transform="matrix(1,0,0,-1,-5963,7280)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ak">
   <path id="dl" transform="matrix(1,0,0,-1,-5956,7866)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="aj">
   <path id="dm" transform="matrix(1,0,0,-1,-5952,8474)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ai">
   <path id="dn" transform="matrix(1,0,0,-1,-5484,8465)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ah">
   <path id="do" transform="matrix(1,0,0,-1,-5454,7880)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ag">
   <path id="dp" transform="matrix(1,0,0,-1,-5491,7271)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="af">
   <path id="dq" transform="matrix(1,0,0,-1,-5451,6642)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ae">
   <path id="dr" transform="matrix(1,0,0,-1,-5466,6060)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ad">
   <path id="ds" transform="matrix(1,0,0,-1,-5472,4796)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ac">
   <path id="dt" transform="matrix(1,0,0,-1,-5514,4059)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="ab">
   <path id="du" transform="matrix(1 0 0 -1 -5466 3461)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="aa">
   <path id="dv" transform="matrix(1 0 0 -1 -5464 2831)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="z">
   <path id="dw" transform="matrix(1 0 0 -1 -5549 2179)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="y">
   <path id="dx" transform="matrix(1,0,0,-1,-4220,8507)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="x">
   <path id="dy" transform="matrix(1,0,0,-1,-3381,8448)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="w">
   <path id="dz" transform="matrix(1,0,0,-1,-2746,8461)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="v">
   <path id="ea" transform="matrix(1,0,0,-1,-2298,8462)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="u">
   <path id="eb" transform="matrix(1 0 0 -1 -2226 3463)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="t">
   <path id="ec" transform="matrix(1 0 0 -1 -2860 2841)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="s">
   <path id="ed" transform="matrix(1 0 0 -1 -2857 2789)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="r">
   <path id="ee" transform="matrix(1 0 0 -1 -2856 2738)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="q">
   <path id="ef" transform="matrix(1 0 0 -1 -5015 2890)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="p">
   <path id="eg" transform="matrix(1 0 0 -1 -4877 3488)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="o">
   <path id="eh" transform="matrix(1,0,0,-1,-4847,3984)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="n">
   <path id="ei" transform="matrix(1 0 0 -1 -2099 2959)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="m">
   <path id="ej" transform="matrix(1,0,0,-1,-2215,3951)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="l">
   <path id="ek" transform="matrix(1,0,0,-1,-2968,7809)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="k">
   <path id="el" transform="matrix(1,0,0,-1,-3550,7826)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="j">
   <path id="em" transform="matrix(1,0,0,-1,-4070,7784)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="i">
   <path id="en" transform="matrix(1 0 0 -1 -5933 3467)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="h">
   <path id="eo" transform="matrix(1 0 0 -1 -2914 2625)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="g">
   <path id="ep" transform="matrix(1 0 0 -1 -4169 2622)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="f">
   <path id="eq" transform="matrix(1 0 0 -1 -4523 2610)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="e">
   <path id="er" transform="matrix(1,0,0,-1,-1125,4187)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="d">
   <path id="es" transform="matrix(1 0 0 -1 -1129 3549)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="c">
   <path id="et" transform="matrix(1 0 0 -1 -1143 2904)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="b">
   <path id="eu" transform="matrix(1 0 0 -1 -1134 2211)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
  <clipPath id="a">
   <path id="ev" transform="matrix(1 0 0 -1 -3276 2762)" d="m0 315h6978v9254h-6978v-9254"/>
  </clipPath>
 </defs>
 <g id="ew" transform="matrix(1.1444 0 0 1.1634 -82.742 -134.92)">
  <g id="ex" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="ey" stroke-width="4">
    <path id="ez" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938h83v-51h-83v51"/>
    <path id="fa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401h41v-41h-41v41"/>
    <path id="fb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401h41v-41h-41v41"/>
    <path id="fc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561h83v-52h-83v52"/>
    <path id="fd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810h83v-52h-83v52"/>
    <path id="fe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432h83v-52h-83v52"/>
    <path id="ff" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054h83v-52h-83v52"/>
    <path id="fg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676h83v-52h-83v52"/>
    <path id="fh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298h83v-52h-83v52"/>
    <path id="fi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542h83v-51h-83v51" clip-path="url(#bw)"/>
   </g>
   <g id="fj" stroke-width="2">
    <path id="fk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938h-83v-51h83v51" clip-path="url(#bv)"/>
    <path id="fl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432h-83v-52h83v52"/>
    <path id="fm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054h-83v-52h83v52"/>
    <path id="fn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676h-83v-52h83v52"/>
    <path id="fo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298h-83v-52h83v52"/>
    <path id="fp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401h-41v-41h41v41"/>
    <path id="fq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401h-42v-41h42v41"/>
   </g>
   <g id="fr" stroke-width="4">
    <path id="fs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 6915h41v-41h-41v41"/>
    <path id="ft" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 6915h41v-41h-41v41"/>
    <path id="fu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 6293h41v-41h-41v41"/>
    <path id="fv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 5671h41v-41h-41v41"/>
    <path id="fw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 5671h41v-41h-41v41"/>
    <path id="fx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 5049h41v-42h-41v42"/>
    <path id="fy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 5049h41v-42h-41v42"/>
    <path id="fz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 4427h41v-42h-41v42"/>
    <path id="ga" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 3805h41v-42h-41v42"/>
    <path id="gb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 5049h42v-42h-42v42"/>
    <path id="gc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 3805h42v-42h-42v42"/>
    <path id="gd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 3183h42v-42h-42v42"/>
    <path id="ge" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401h42v-41h-42v41"/>
   </g>
   <g id="gf" stroke-width="2">
    <path id="gg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401h-42v-41h42v41"/>
    <path id="gh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401h-42v-41h42v41"/>
    <path id="gi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 6293h41v-41h-41v41"/>
    <path id="gj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 6293h42v-41h-42v41"/>
    <path id="gk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 5671h41v-41h-41v41"/>
    <path id="gl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 5671h42v-41h-42v41"/>
    <path id="gm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 5049h41v-42h-41v42"/>
    <path id="gn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 5049h42v-42h-42v42"/>
    <path id="go" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 4427h41v-42h-41v42"/>
    <path id="gp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 3805h41v-42h-41v42"/>
    <path id="gq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 2555h41v-41h-41v41"/>
   </g>
   <g id="gr" stroke-width="4">
    <path id="gs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542h83v-51h-83v51"/>
    <path id="gt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920h83v-51h-83v51"/>
    <path id="gu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188h83v-52h-83v52"/>
    <path id="gv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 3183h41v-42h-41v42"/>
    <path id="gw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159v-41h41v41h-41 41v-41h-41v41"/>
    <path id="gx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41v-41h-41v41"/>
   </g>
   <g id="gy" stroke-width="2">
    <path id="gz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4130 2296h-41v-41h41v41"/>
    <path id="ha" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 3183h-41v-42h41v42"/>
    <path id="hb" transform="matrix(0 -.16 -.16 0 533.63 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
    <path id="hc" transform="matrix(0 -.16 -.16 0 627.07 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   </g>
   <g id="hd" stroke-width="4">
    <path id="he" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401h41v-41h-41v41"/>
    <path id="hf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41v-41h-41v41"/>
    <path id="hg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 6915h42v-41h-42v41"/>
    <path id="hh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1013 7558v-16"/>
    <path id="hi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 7558v-16"/>
    <path id="hj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 5049h-42v-42h42v42"/>
   </g>
   <g id="hk" stroke-width="2">
    <path id="hl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810h-83v-52h83v52"/>
    <path id="hm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 4427h42v-42h-42v42"/>
    <path id="hn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 3805h42v-42h-42v42"/>
    <path id="ho" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 3183h42v-42h-42v42"/>
    <path id="hp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 2555h42v-41h-42v41"/>
    <path id="hq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4130 1933h-41v-41h41v41"/>
    <path id="hr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1933h-42v-41h42v41"/>
    <path id="hs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 2296h-42v-41h42v41"/>
    <path id="ht" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1933h41v-41h-41v41"/>
   </g>
   <path id="hu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1933h-42v-41h42v41" stroke-width="4"/>
   <path id="hv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 2296h-42v-41h42v41" stroke-width="4"/>
   <path id="hw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3136 1933h-41v-41h41v41" stroke-width="2"/>
   <path id="hx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3136 2296h-41v-41h41v41" stroke-width="4"/>
   <path id="hy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1933h-41v-41h41v41" stroke-width="4"/>
   <path id="hz" transform="matrix(0 -.16 -.16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5" stroke-width="2"/>
   <path id="ia" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 2555h41v-41h-41v41" stroke-width="4"/>
   <path id="ib" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1933h41v-41h-41v41" stroke-width="4"/>
   <g id="ic" stroke-width="2">
    <path id="id" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 2296h-42v-41h42v41"/>
    <path id="ie" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 1933h-42v-41h42v41"/>
    <path id="if" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401h-41v-41h41v41"/>
    <path id="ig" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672h-42v-41h42v41"/>
    <path id="ih" transform="matrix(0 -.16 -.16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
    <path id="ii" transform="matrix(0 -.16 -.16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
    <path id="ij" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 2923h-42v-41h42v41"/>
    <path id="ik" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1933h42v-41h-42v41"/>
    <path id="il" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4180 1173 1959 1"/>
    <path id="im" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 5624h-42v52h42"/>
    <path id="in" transform="matrix(0 -.16 -.16 0 580.19 1365.7)" d="m-198.51 570.98c-243.07-84.508-405.99-313.64-405.99-570.98s162.92-486.47 405.99-570.98"/>
    <path id="io" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 2923h-42v-41h42v41"/>
    <path id="ip" transform="matrix(0 -.16 -.16 0 660.35 1364.3)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   </g>
  </g>
  <g id="iq" fill="none" stroke="#72001c" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <path id="ir" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920h83v-51h-83v51" stroke-width="3"/>
   <path id="is" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2409 6027v1" stroke-width="3"/>
   <g id="it" stroke-width="2">
    <path id="iu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3373 8756v-32"/>
    <path id="iv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7273h3"/>
    <path id="iw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7273h3"/>
    <path id="ix" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4450 7242h4"/>
   </g>
   <g id="iy" stroke-width="3">
    <path id="iz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6393v356"/>
    <path id="ja" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 3048v10"/>
    <path id="jb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2965 7150h10"/>
    <path id="jc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4811 6027v1"/>
    <path id="jd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4929 5355v-1"/>
    <path id="je" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6150h-185"/>
    <path id="jf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 4149"/>
    <path id="jg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4916 6043v92"/>
    <path id="jh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5702h11"/>
    <path id="ji" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5639h11"/>
    <path id="jj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5577h11"/>
    <path id="jk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5764h11"/>
    <path id="jl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5515h11"/>
    <path id="jm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5888h11"/>
   </g>
   <g id="jn" stroke-width="2">
    <path id="jo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7273h-3"/>
    <path id="jp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7273h-3"/>
    <path id="jq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2770 7242h-5"/>
   </g>
  </g>
  <g id="jr" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="js" stroke-width="2">
    <path id="jt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561h-83v-52h83v52"/>
    <path id="ju" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542h-83v-51h83v51"/>
    <path id="jv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41v-41h-41v41"/>
    <path id="jw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41v-41h-41v41"/>
    <path id="jx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42v-41h-42v41"/>
    <path id="jy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42v-41h-42v41"/>
    <path id="jz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41v-41h-41v41"/>
    <path id="ka" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42v-41h-42v41"/>
    <path id="kb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42v-41h-42v41"/>
    <path id="kc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41v-41h-41v41"/>
   </g>
   <g id="kd" stroke-width="4">
    <path id="ke" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298h83v-52h-83v52"/>
    <path id="kf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054h83v-52h-83v52"/>
    <path id="kg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432h83v-52h-83v52"/>
    <path id="kh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810h83v-52h-83v52"/>
   </g>
   <g id="ki" stroke-width="2">
    <path id="kj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938h83v-51h-83v51"/>
    <path id="kk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561h83v-52h-83v52"/>
    <path id="kl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054h83v-52h-83v52"/>
    <path id="km" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676h83v-52h-83v52"/>
    <path id="kn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298h83v-52h-83v52"/>
   </g>
   <path id="ko" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188h83v-52h-83v52" stroke-width="4"/>
   <g id="kp" stroke-width="2">
    <path id="kq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41v-41h-41v41"/>
    <path id="kr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 7599h-42v-41h42v41"/>
    <path id="ks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 7599h-42v-41h42v41"/>
    <path id="kt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 7599h-41v-41h41v41"/>
    <path id="ku" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599h-42v-41h42v41"/>
    <path id="kv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188h-83v-52h83v52"/>
    <path id="kw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432h83v-52h-83v52"/>
    <path id="kx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810h83v-52h-83v52"/>
    <path id="ky" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5956 7511h-10"/>
    <path id="kz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5540 7511h-11"/>
   </g>
  </g>
  <g id="la" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="lb">
    <path id="lc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920h-83v-51h83v51"/>
    <path id="ld" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 7537h41v-41h-41v41"/>
    <path id="le" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 7537h41v-41h-41v41"/>
   </g>
   <path id="lf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 7537h42v-41h-42v41" stroke-width="3"/>
   <path id="lg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 6293h42v-41h-42v41" stroke-width="3"/>
   <g id="lh">
    <path id="li" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8159h41v-41h-41v41"/>
    <path id="lj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8159h41v-41h-41v41"/>
    <path id="lk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8159h42v-41h-42v41"/>
    <path id="ll" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8159h42v-41h-42v41"/>
    <path id="lm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42v-41h-42v41"/>
    <path id="ln" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8159h41v-41h-41v41"/>
    <path id="lo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8159h42v-41h-42v41"/>
    <path id="lp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 7537h41v-41h-41v41"/>
    <path id="lq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 7537h42v-41h-42v41"/>
   </g>
   <path id="lr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7537h42v-41h-42v41" stroke-width="3"/>
   <path id="ls" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 6915h41v-41h-41v41"/>
   <path id="lt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 6915h42v-41h-42v41"/>
   <path id="lu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6915h42v-41h-42v41" stroke-width="3"/>
   <g id="lv">
    <path id="lw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8159h41v-41h-41v41"/>
    <path id="lx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8159h42v-41h-42v41"/>
    <path id="ly" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4150 8159h42v-41h-42v41"/>
   </g>
   <g id="lz" stroke-width="3">
    <path id="ma" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 6538h10"/>
    <path id="mb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 3763v-580"/>
    <path id="mc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3763v-580"/>
   </g>
   <g id="md">
    <path id="me" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920h83v-51h-83v51"/>
    <path id="mf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542h83v-51h-83v51"/>
    <path id="mg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41v-41h-41v41"/>
    <path id="mh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41v-41h-41v41"/>
    <path id="mi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42v-41h-42v41"/>
    <path id="mj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41v-41h-41v41"/>
    <path id="mk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42v-41h-42v41"/>
    <path id="ml" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42v-41h-42v41"/>
    <path id="mm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42v-41h-42v41"/>
    <path id="mn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42v-41h-42v41"/>
    <path id="mo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41v-41h-41v41"/>
    <path id="mp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 8740v-581"/>
    <path id="mq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1856 8740v-581"/>
    <path id="mr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41v-41h-41v41"/>
   </g>
   <g id="ms" stroke-width="3">
    <path id="mt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3187 8756v-146"/>
    <path id="mu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3218 8756v-146"/>
    <path id="mv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3249 8756v-146"/>
    <path id="mw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3280 8756v-125"/>
    <path id="mx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3311 8756v-94"/>
    <path id="my" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3342 8756v-78"/>
    <path id="mz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8605h128"/>
    <path id="na" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8574h128"/>
    <path id="nb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8543h128"/>
    <path id="nc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8512h128"/>
    <path id="nd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8481h128"/>
    <path id="ne" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 7563h-10"/>
    <path id="nf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3033 7594h32v-31h-32v31"/>
    <path id="ng" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 7599h42v-41h-42v41"/>
   </g>
   <path id="nh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 7599h41v-41h-41v41"/>
   <path id="ni" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 7599h41v-41h-41v41"/>
   <path id="nj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3594 7594h31v-31h-31v31" stroke-width="3"/>
   <path id="nk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4155 7594h31v-31h-31v31" stroke-width="3"/>
  </g>
  <path id="nl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3652h379l-379 10zm379 0-379 10h379z" stroke="#000" stroke-linecap="round" stroke-miterlimit="10"/>
  <path id="nm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 3164h353l-353 11zm353 0-353 11h353z" stroke="#000" stroke-linecap="round" stroke-miterlimit="10"/>
  <g id="nn" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="no" stroke-width="3">
    <path id="np" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7304h156"/>
    <path id="nq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7335h156"/>
    <path id="nr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4434 7273h103"/>
    <path id="ns" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4434 7273h103"/>
    <path id="nt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7242h51"/>
    <path id="nu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4464 7242h8"/>
    <path id="nv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4481 7242h56"/>
    <path id="nw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7211h98"/>
    <path id="nx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7180h146"/>
    <path id="ny" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7335v-187h156v37"/>
   </g>
   <g id="nz">
    <path id="oa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 7558v-21"/>
    <path id="ob" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1856 7558v-21"/>
    <path id="oc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 7599h41v-41h-41v41"/>
    <path id="od" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 7599h41v-41h-41v41"/>
   </g>
   <path id="oe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 7599h42v-41h-42v41" stroke-width="3"/>
   <g id="of">
    <path id="og" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8159h42v-41h-42v41"/>
    <path id="oh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599h-42v-41h42v41"/>
    <path id="oi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 7599h-41v-41h41v41"/>
    <path id="oj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 7599h-42v-41h42v41"/>
   </g>
   <path id="ok" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 7599h-42v-41h42v41" stroke-width="3"/>
   <path id="ol" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8159h-42v-41h42v41"/>
   <g id="om" stroke-width="3">
    <path id="on" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1445 5630v-221"/>
    <path id="oo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1477 5645v-236"/>
    <path id="op" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1508 5645v-236"/>
    <path id="oq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1539 5645v-236"/>
    <path id="or" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1570 5597v-188"/>
    <path id="os" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1601 5642v-233"/>
    <path id="ot" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1632 5404v238"/>
    <path id="ou" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5409h609"/>
    <path id="ov" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1264 5404h368"/>
    <path id="ow" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1631 5642-71-105-18 4 22-30-18 4-71-106"/>
    <path id="ox" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1570 5645v-48"/>
   </g>
   <path id="oy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1162 5364v160h124v-34l43 34-36 34" stroke-width="5"/>
   <g id="oz" stroke-width="3">
    <path id="pa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 6915h-42v-41h42v41"/>
    <path id="pb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3033 7579v-11"/>
    <path id="pc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 7558v-21h-11v21h11"/>
    <path id="pd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7558v-21h10v21h-10"/>
    <path id="pe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3091 8528v150h170v27l38-27-31-22"/>
   </g>
  </g>
  <text id="pf" transform="matrix(.16 0 0 .16 503.95 205.65)" clip-path="url(#bu)" xml:space="preserve"><tspan id="pg" x="0 22.959999" y="0" fill="#000000" font-family="Tahoma" font-size="35px">UP</tspan></text>
  <g id="ph" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="pi" stroke-width="3">
    <path id="pj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3259 8610 58 58-13 28 55-26-12 28 58 58" clip-path="url(#bt)"/>
    <path id="pk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7275 64-42 10 16-2-45 12 16 72-47"/>
    <path id="pl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7307 74-48 10 15-2-44 12 16 62-41"/>
    <path id="pm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4421 7148h-1649"/>
   </g>
   <g id="pn">
    <path id="po" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2214 5964h279v-11h-279v11"/>
    <path id="pp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 7827v-449"/>
    <path id="pq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2096 7827v-449"/>
   </g>
   <g id="pr" stroke-width="3">
    <path id="ps" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7352h104v-104h-104v104"/>
    <path id="pt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7248h104v-103h-104v103"/>
    <path id="pu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7145h104v-104h-104v104"/>
    <path id="pv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7041h104v-104h-104v104"/>
    <path id="pw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 6937h104v-103h-104v103"/>
    <path id="px" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 6834h104v-104h-104v104"/>
    <path id="py" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7352h103v-104h-103v104"/>
    <path id="pz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7248h103v-103h-103v103"/>
    <path id="qa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7145h103v-104h-103v104"/>
    <path id="qb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7041h103v-104h-103v104"/>
    <path id="qc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 6803h103v-103h-103v103"/>
    <path id="qd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 6730h104v-104h-104v104"/>
    <path id="qe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 6700h103v-104h-103v104"/>
    <path id="qf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 6368h-10v114h155v-10h-145v-104"/>
    <path id="qg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 6482h-10v114h155v-10h-145v-104"/>
    <path id="qh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 6368h155v-10h-155v10"/>
    <path id="qi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2231 6368h-124v-10h124v10"/>
    <path id="qj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2221 6275h137v-11h-137v11"/>
    <path id="qk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2292 6264v-114h10v114h-10"/>
    <path id="ql" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2221 6352v-72h10v72h-10"/>
    <path id="qm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2364 6352v-72h10v72h-10"/>
    <path id="qn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2374 6275v-11h-16v11h16"/>
   </g>
   <path id="qo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2301 6038v-74h11v74h-11"/>
   <path id="qp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2304 6043v92" stroke-width="3"/>
   <g id="qq" stroke-width="2">
    <path id="qr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 5971h26v-26h-26v26"/>
    <path id="qs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 4157h26v-26h-26v26"/>
    <path id="qt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 6604h26v-26h-26v26"/>
    <path id="qu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 7378h26v-26h-26v26"/>
   </g>
   <path id="qv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2114 7846 60 59" stroke-width="3"/>
   <path id="qw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 7853 63 63" stroke-width="3"/>
   <path id="qx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4192 8144v-11"/>
   <path id="qy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 6937h103v-134h-103v134" stroke-width="3"/>
   <path id="qz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 7853h26v-26h-26v26" stroke-width="2"/>
   <path id="ra" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 7923h26v-25h-26v25" stroke-width="2"/>
  </g>
  <g id="rb" stroke="#000" stroke-linecap="round" stroke-miterlimit="10">
   <path id="rc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5048 4139h-321zm0 0h-321v10z"/>
   <path id="rd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4149h321v-10z"/>
   <path id="re" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5048 5440h58l-58 10zm58 0-58 10h58z"/>
   <path id="rf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5440h321l-321 10zm321 0-321 10h321z"/>
   <path id="rg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 4139h-58zm0 0h-58v10z"/>
   <path id="rh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5048 4149h58v-10z"/>
  </g>
  <path id="ri" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 5450h-379v-10h379" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="3"/>
  <path id="rj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4849h397l-397 10zm397 0-397 10h397z" stroke="#000" stroke-linecap="round" stroke-miterlimit="10"/>
  <g id="rk" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="rl" stroke-width="3">
    <path id="rm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 4859h-397v-10h397v10"/>
    <path id="rn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 4149h-379v-10h379"/>
    <path id="ro" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 7853h-25v-26h25v26"/>
    <path id="rp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 7923h-26v-25h26v25"/>
   </g>
   <path id="rq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5624v-357"/>
   <path id="rr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1013 5267v357h10"/>
   <g id="rs" stroke-width="3">
    <path id="rt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1013 5261h10"/>
    <path id="ru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5624h-10v-5h10v5"/>
    <path id="rv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5261h-10v6h10v-6"/>
   </g>
   <path id="rw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 6578h-11" stroke-width="2"/>
   <g id="rx" stroke-width="3">
    <path id="ry" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 5619v-31"/>
    <path id="rz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m940 8968h5340-921"/>
    <path id="sa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3259 8605h-72v-129"/>
    <path id="sb" transform="matrix(0 -.16 -.16 0 512.19 229.09)" d="m0 2.5c-1.3807 0-2.5-1.1193-2.5-2.5s1.1193-2.5 2.5-2.5"/>
    <path id="sc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3182 8476v134h77"/>
    <path id="sd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 3652v10h-379v-10h379"/>
    <path id="se" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 3164v11h-353v-11h353"/>
    <path id="sf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8612v154"/>
    <path id="sg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8610v156"/>
    <path id="sh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8756h144"/>
    <path id="si" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3318 7923h26v-25h-26v25"/>
    <path id="sj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4529 7923h26v-25h-26v25"/>
    <path id="sk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m810 1445v7393"/>
    <path id="sl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6409 1445v7393"/>
    <path id="sm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5407 5409h181v-5h-181v5"/>
    <path id="sn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 1913h-219"/>
    <path id="so" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1881h-235"/>
    <path id="sp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3146 1881h-31"/>
    <path id="sq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1850h-235"/>
    <path id="sr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3246 1850h-7"/>
    <path id="ss" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3190 1850h-75"/>
    <path id="st" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1819h-235"/>
    <path id="su" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3243 1819h-128"/>
    <path id="sv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1788h-235"/>
    <path id="sw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3278 1788h-27"/>
    <path id="sx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3240 1788h-125"/>
    <path id="sy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1757h-235"/>
    <path id="sz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3321 1757h-206"/>
    <path id="ta" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1726h-235"/>
    <path id="tb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3350 1726h-235"/>
    <path id="tc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1695h-235"/>
    <path id="td" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3350 1695h-235"/>
    <path id="te" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1664h-235"/>
    <path id="tf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3350 1736v-72h-235"/>
    <path id="tg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3370 1913v-249"/>
    <path id="th" transform="matrix(0 -.16 -.16 0 540.35 1319)" d="m0 10.5c-5.799 0-10.5-4.701-10.5-10.5s4.701-10.5 10.5-10.5"/>
    <path id="ti" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3131 1892 92-65 24 35-9-92 23 31 89-65"/>
    <path id="tj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6280 8968 129-130"/>
    <path id="tk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m940 8968-130-130"/>
    <path id="tl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4968 2501 166 166"/>
   </g>
   <path id="tm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42v-41h-42v41"/>
   <path id="tn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1082 1173h1956" stroke-width="3"/>
   <path id="to" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3906 1405h-8"/>
   <g id="tp" stroke-width="2">
    <path id="tq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 6158h26v-26h-26v26"/>
    <path id="tr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7511v11h-111v-11h111"/>
    <path id="ts" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7898v-148"/>
   </g>
   <path id="tt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2754 7923h26v-25h-26v25" stroke-width="3"/>
   <g id="tu" stroke-width="2">
    <path id="tv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2498 7599h11v299h-11v-299"/>
    <path id="tw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7511h10v387h-10v-387"/>
    <path id="tx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 7352h-16v-437h16v437"/>
    <path id="ty" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7373h-16v-458h16v458"/>
    <path id="tz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4537 7148h10v363h-10v-363"/>
    <path id="ua" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7363v-11h119v11h-119"/>
    <path id="ub" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 7485h10v11h-10v-11"/>
    <path id="uc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 7363h10v10h-10v-10"/>
    <path id="ud" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4724 7496h-10v-11h10v11"/>
    <path id="ue" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4721 7898h-10v-299h10v299"/>
    <path id="uf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4537 7511v11h-1765v-11h1765"/>
    <path id="ug" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 8377h10"/>
    <path id="uh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 8377v389h10v-389"/>
    <path id="ui" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 8766h-10v-394h10v394"/>
    <path id="uj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 8387h153v218h10v-218"/>
    <path id="uk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8419h-153"/>
    <path id="ul" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8450h-153"/>
    <path id="um" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8481h-153"/>
    <path id="un" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8512h-153"/>
    <path id="uo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8543h-153"/>
    <path id="up" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8574h-153"/>
    <path id="uq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8605h-153"/>
    <path id="ur" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8387 56 51-19 21 71-23-23 29 53 47"/>
    <path id="us" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8605h138"/>
    <path id="ut" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8574h138"/>
    <path id="uu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8543h138"/>
    <path id="uv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8512h138"/>
    <path id="uw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8481h102"/>
    <path id="ux" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8450h46"/>
    <path id="uy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2095 8450h31"/>
    <path id="uz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8419h35"/>
    <path id="va" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1939 8402v261h159v-107h-19l19-35 21 35"/>
   </g>
  </g>
  <text id="vb" transform="matrix(.16 0 0 .16 323.31 196.05)" xml:space="preserve"><tspan id="vc" x="0 22.959999" y="0" fill="#000000" font-family="Tahoma" font-size="35px">UP</tspan></text>
  <g id="vd" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
   <path id="ve" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5354 8387h-153v218h-10v-218"/>
   <path id="vf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8419h153"/>
   <path id="vg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8450h153"/>
   <path id="vh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8481h153"/>
   <path id="vi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8512h153"/>
   <path id="vj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8543h153"/>
   <path id="vk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8574h153"/>
   <path id="vl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8605h153"/>
   <path id="vm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8387-56 51 19 21-71-23 23 29-53 47"/>
   <path id="vn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8605h-138"/>
   <path id="vo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8574h-138"/>
   <path id="vp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8543h-138"/>
   <path id="vq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8512h-138"/>
   <path id="vr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8481h-103"/>
   <path id="vs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8450h-46"/>
   <path id="vt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 8450h-31"/>
   <path id="vu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8419h-35"/>
   <path id="vv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5280 8402v261h-158v-107h19l-19-35-21 35"/>
  </g>
  <text id="vw" transform="matrix(.16 0 0 .16 831.31 196.05)" xml:space="preserve"><tspan id="vx" x="0 22.959999" y="0" fill="#000000" font-family="Tahoma" font-size="35px">UP</tspan></text>
  <g id="vy" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="vz" stroke-width="2">
    <path id="wa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3105 1892h10v-491h-10v491"/>
    <path id="wb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 2923h-941"/>
    <path id="wc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253 2530 7-7"/>
    <path id="wd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253 2530 393 393h943v-10h-939l-390-390"/>
    <path id="we" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3219 2913h-10v-402h10v402"/>
    <path id="wf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2804 2913h-10v-161h10v161"/>
    <path id="wg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2794 2511h10v210h-10v-210"/>
    <path id="wh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4961 2523 8 7"/>
    <path id="wi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4961 2523-390 390h-441v10h446l393-393"/>
    <path id="wj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4416 2516h10v205h-10v-205"/>
    <path id="wk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4416 2752h10v161h-10v-161"/>
   </g>
   <path id="wl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42v-41h-42v41"/>
   <g id="wm" stroke-width="2">
    <path id="wn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5364 8740h-10v-581h10v581"/>
    <path id="wo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5645v10h-360v-10h360"/>
    <path id="wp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 5655v-10h380v10h-380"/>
    <path id="wq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 3183h26v-26h-26v26"/>
    <path id="wr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 3164v11h-353v-11h353"/>
    <path id="ws" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2108 2676 8-8"/>
    <path id="wt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2108 2676 219 218v270h11l-1-274-221-222"/>
    <path id="wu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 2955h-155"/>
    <path id="wv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 3670h26v-26h-26v26"/>
    <path id="ww" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3652v10h-379v-10h379"/>
    <path id="wx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4139v10h-379v-10h379"/>
    <path id="wy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 4655h-11v-498h11v498"/>
    <path id="wz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 4680h26v-25h-26v25"/>
    <path id="xa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4849v10"/>
    <path id="xb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4849h-397v218h397v-11h-386v-197h386"/>
    <path id="xc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 5453h26v-26h-26v26"/>
    <path id="xd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5435v10h-379v-10h379"/>
    <path id="xe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 5945h-11v-492h11v492"/>
    <path id="xf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 6140v10h-379v-10h379"/>
    <path id="xg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 6578h-11v-420h11v420"/>
    <path id="xh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 7352h-11v-748h11v748"/>
    <path id="xi" transform="matrix(0 -.16 -.16 0 399.07 321.25)" d="m2.3511 90.469c-25.173 0.65419-49.48-9.2094-67.079-27.22-17.599-18.01-26.898-42.539-25.663-67.69"/>
    <path id="xj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2382 7905v11"/>
    <path id="xk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2382 7905h-208l-60-59-7 7 63 63h212"/>
    <path id="xl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 7905v11h-6v-11h6"/>
    <path id="xm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2754 7905v11h-237v-11h237"/>
    <path id="xn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2658 7536 77 44"/>
    <path id="xo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2732 7585-76-44 2-5 77 44-3 5"/>
    <path id="xp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2664 7522 4 4"/>
    <path id="xq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2669 7522 10 10"/>
    <path id="xr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7522h1l15 16"/>
    <path id="xs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2678 7522 22 22"/>
    <path id="xt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2683 7522 27 28"/>
    <path id="xu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2687 7522 34 34"/>
    <path id="xv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2692 7522 40 40"/>
    <path id="xw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2697 7522 45 45"/>
    <path id="xx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2701 7522 52 51"/>
    <path id="xy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2706 7522 56 56"/>
    <path id="xz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2711 7522 51 51"/>
    <path id="ya" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2715 7522 47 46"/>
    <path id="yb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2720 7522 42 42"/>
    <path id="yc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2725 7522 37 37"/>
    <path id="yd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2729 7522 33 32"/>
    <path id="ye" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2734 7522 28 28"/>
    <path id="yf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2739 7522 23 23"/>
    <path id="yg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2743 7522 19 18"/>
    <path id="yh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2748 7522 14 14"/>
    <path id="yi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2752 7522 10 9"/>
    <path id="yj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2757 7522 5 4"/>
    <path id="yk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2547 7750v10h-38v-10h38"/>
    <path id="yl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2640 7905h-10v-145h10v145"/>
    <path id="ym" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 7567 88 50 3-6 9 6-8 14-92-52"/>
    <path id="yn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2654 7518 9 5-5 8-9-5 5-8"/>
    <path id="yo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2592 7625-55 96"/>
    <path id="yp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2537 7750v-29"/>
    <path id="yq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4614 7765 5 9"/>
    <path id="yr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4614 7765-7 3v137h11v-131h1"/>
    <path id="ys" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7578-99-55 1-1h98v56"/>
    <path id="yt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2646 7750v10h-21v-10h21"/>
    <path id="yu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7750v10h-39v-10h39"/>
    <path id="yv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2651 7533-44 76"/>
    <path id="yw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7578 5 3"/>
    <path id="yx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4555 7905v11"/>
    <path id="yy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4463 7522h-10"/>
    <path id="yz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4529 7905h-98"/>
    <path id="za" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4529 7916h-108"/>
    <path id="zb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 7843 7 8"/>
    <path id="zc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 7843-62 62h-205v11h209l65-65"/>
    <path id="zd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 7827h-11v-449h11v449"/>
    <path id="ze" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4555 7916v-11h148v11h-148"/>
   </g>
   <path id="zf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4045 7923h26v-25h-26v25" stroke-width="3"/>
   <g id="zg" stroke-width="2">
    <path id="zh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7541-77 45"/>
    <path id="zi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4473 7590 76-44-2-5-77 45 3 4"/>
    <path id="zj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4605 7617 5 9"/>
    <path id="zk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4613 7631"/>
    <path id="zl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4596 7622 8 14"/>
    <path id="zm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4609 7645"/>
    <path id="zn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4552 7525-9 6 4 6 9-6-4-6"/>
    <path id="zo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4633 7636 51 88"/>
    <path id="zp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7709-30 17 5 9 25-15"/>
    <path id="zq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4554 7538 44 77"/>
    <path id="zr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4604 7636h107v-10h-101"/>
    <path id="zs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7148h164"/>
    <path id="zt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7180h164"/>
    <path id="zu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7211h164"/>
    <path id="zv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7242h164"/>
    <path id="zw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7273h164"/>
    <path id="zx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4621 7767 58-34"/>
    <path id="zy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4715 7706 5 9-34 20-5-9 34-20"/>
    <path id="zz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4599 7157v61h-12l13 19 14-19"/>
   </g>
  </g>
  <text id="aaa" transform="matrix(.16 0 0 .16 740.27 440.37)" xml:space="preserve"><tspan id="aab" x="0 18.983999 38.807999 64.064003" y="0" fill="#000000" font-family="Tahoma" font-size="28px">DOWN</tspan></text>
  <g id="aac" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="aad" stroke-width="2">
    <path id="aae" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5676h-10v104h10v-104"/>
    <path id="aaf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6298h-10v104h10v-104"/>
    <path id="aag" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6920h-10v104h10v-104"/>
    <path id="aah" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 7542h-10v104h10v-104"/>
    <path id="aai" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 8159h-10v104h10v-104"/>
    <path id="aaj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 8636h-10v104h10v-104"/>
    <path id="aak" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 8014h-10v104h10v-104"/>
    <path id="aal" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 7387h-10v104h10v-104"/>
    <path id="aam" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6765h-10v104h10v-104"/>
    <path id="aan" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6143h-10v103h10v-103"/>
    <path id="aao" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3219 2913h-10v-402h10v402"/>
    <path id="aap" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3400 2825v83h-10v-83h10"/>
    <path id="aaq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3986 2770v-20h-5v13h1v7h4"/>
    <path id="aar" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4105 2516h10v366h-10v-366"/>
    <path id="aas" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360h-20"/>
    <path id="aat" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5781 1174 150-1"/>
    <path id="aau" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5931 1360h-20"/>
    <path id="aav" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672h10-10v109h10v-109 109h-10v-109"/>
    <path id="aaw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1781"/>
    <path id="aax" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672"/>
    <path id="aay" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781"/>
    <path id="aaz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
    <path id="aba" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781"/>
    <path id="abb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
    <path id="abc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672h10-10v109h10v-109 109h-10v-109"/>
    <path id="abd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1781"/>
    <path id="abe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672"/>
    <path id="abf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781"/>
    <path id="abg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
    <path id="abh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781"/>
    <path id="abi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
    <path id="abj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777h10-10v110h10v-110 110h-10v-110"/>
    <path id="abk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887"/>
    <path id="abl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777"/>
    <path id="abm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
    <path id="abn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
    <path id="abo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
    <path id="abp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
    <path id="abq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777h10-10v110h10v-110 110h-10v-110"/>
    <path id="abr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887"/>
    <path id="abs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777"/>
    <path id="abt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
    <path id="abu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
    <path id="abv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
    <path id="abw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
    <path id="abx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777v5h-10v-5h10-10v5h10v-5"/>
    <path id="aby" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
    <path id="abz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1782"/>
    <path id="aca" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
    <path id="acb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1782"/>
    <path id="acc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777"/>
    <path id="acd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1881v6h-10v-6h10-10v6h10v-6"/>
    <path id="ace" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1881"/>
    <path id="acf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
    <path id="acg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1881"/>
    <path id="ach" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887"/>
    <path id="aci" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1881"/>
    <path id="acj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672v6h-10v-6h10-10v6h10v-6"/>
    <path id="ack" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
    <path id="acl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1678"/>
    <path id="acm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
    <path id="acn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1678"/>
    <path id="aco" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672"/>
    <path id="acp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6202 2509v-571"/>
    <path id="acq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 2509v-571"/>
    <path id="acr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6212 2509v-571"/>
    <path id="acs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6202 1938h-41v-51h36v-215"/>
   </g>
   <g id="act" stroke-width="3">
    <path id="acu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7304h-155"/>
    <path id="acv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7335h-155"/>
    <path id="acw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2786 7273h-103"/>
    <path id="acx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2786 7273h-103"/>
    <path id="acy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7242h-50"/>
    <path id="acz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2756 7242h-8"/>
    <path id="ada" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2739 7242h-56"/>
    <path id="adb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7211h-97"/>
    <path id="adc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7180h-145"/>
    <path id="add" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7335v-187h-155v37"/>
    <path id="ade" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7275-63-42-10 16 2-45-12 16-72-47"/>
    <path id="adf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7307-73-48-10 15 2-44-12 16-62-41"/>
   </g>
   <g id="adg" stroke-width="2">
    <path id="adh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7148h-164"/>
    <path id="adi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7180h-164"/>
    <path id="adj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7211h-164"/>
    <path id="adk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7242h-164"/>
    <path id="adl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7273h-164"/>
    <path id="adm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2621 7157v61h11l-12 19-14-19"/>
   </g>
  </g>
  <g id="adn">
   <path id="ado" transform="matrix(.16 0 0 -.16 417.23 438.77)" d="m0 0v-3h1v-2l1-1v-1h1v-1h1v-1h2v-1h10v21h-6v-1h-4l-1-1h-1v-1h-1v-1h-1v-1h-1v-2l-1-1zm3 0v4h1v1l2 2h1v1h7v-16h-6v1h-2v1h-1v1h-1v2h-1z"/>
   <path id="adp" transform="matrix(.16 0 0 -.16 414.35 437.49)" d="m0 0v-1h-1v-3h-1v-8h1v-2l1-1v-1h1v-1h1v-1h3v-1h4v1h3v1h1v1h1v1h1v2h1v10h-1v2h-1v1l-1 1h-1v1h-2v1h-6v-1h-2v-1h-1v-1zm1-8v4l1 1v1l1 1h1v1h2l1 1h1v-1h2l2-2v-1h1v-10h-1v-1l-1-1h-1v-1h-6v1h-1v1h-1v2h-1z"/>
   <path id="adq" transform="matrix(.16 0 0 -.16 409.87 437.17)" d="m0 0 5-20h3l4 17 4-17h3l6 20h-3l-4-17-5 17h-2l-4-17-5 17z"/>
   <path id="adr" transform="matrix(.16 0 0 -.16 406.99 440.37)" d="m0 0h3l10 18v-18h2v20h-4l-8-16v16h-3z"/>
  </g>
  <g id="ads" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
   <path id="adt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7148h10v363h-10v-363"/>
   <path id="adu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4673v-11h239v11h-239"/>
   <path id="adv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5056 4673v-11h50v11h-50"/>
   <path id="adw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5056 4149v401h57"/>
   <path id="adx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4900 4673h11v74h-11v-74"/>
   <path id="ady" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4900 4849h11v-11h-11v11"/>
   <path id="adz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4446 7097v61h-12l13 19 14-19"/>
  </g>
  <text id="aea" transform="matrix(.16 0 0 .16 715.47 445.49)" xml:space="preserve"><tspan id="aeb" x="0 18.368" y="0" fill="#000000" font-family="Tahoma" font-size="28px">UP</tspan></text>
  <path id="aec" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2754 7098v61h-12l13 19 14-19" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
  <text id="aed" transform="matrix(.16 0 0 .16 444.75 445.33)" xml:space="preserve"><tspan id="aee" x="0 18.368" y="0" fill="#000000" font-family="Tahoma" font-size="28px">UP</tspan></text>
  <g id="aef" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="aeg" stroke-width="2">
    <path id="aeh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4673v-11h-239v11h239"/>
    <path id="aei" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2164 4673v-11h-50v11h50"/>
    <path id="aej" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2164 4149v401h-57"/>
    <path id="aek" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2320 4673h-11v74h11v-74"/>
    <path id="ael" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2320 4849h-11v-11h11v11"/>
    <path id="aem" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4856 6358h-10v-6h10v6"/>
    <path id="aen" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4989 6358h10v-6h-10v6"/>
    <path id="aeo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6596v-10"/>
    <path id="aep" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6596h155v-25h-10v15h-145"/>
    <path id="aeq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 6471v11h-145v-11h145"/>
    <path id="aer" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 6457h10v37h-10v-37"/>
    <path id="aes" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6368v-10"/>
    <path id="aet" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6368h145v12h10v-22h-155"/>
    <path id="aeu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6185 1627-7 7-230-229 8-7 229 229"/>
    <path id="aev" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1375v11h-110v-11h110"/>
    <path id="aew" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1264 1398 8 7-230 229-7-7 229-229"/>
    <path id="aex" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 1887h-10v-215h10v215"/>
    <path id="aey" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6151 1161 271 271"/>
    <path id="aez" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3473 1959v-423h-233v102"/>
    <path id="afa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3483 1959v-434h-253v113h-17l22 43"/>
    <path id="afb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3240 1638h17l-22 43"/>
    <path id="afc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3473 1959h10"/>
    <path id="afd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4716 7923v57"/>
    <path id="afe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4426 7923v57"/>
    <path id="aff" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4167 7923v57"/>
    <path id="afg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4426 7522v394"/>
    <path id="afh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4421 7522v394"/>
    <path id="afi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4431 7522v383"/>
    <path id="afj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4542 7923v-82"/>
    <path id="afk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4613 7905v-20"/>
   </g>
   <path id="afl" d="m251.47 703.91 56.431 0.99003v38.611l123.75-0.99003 1.98 360.37h36.631" style="opacity:0;stroke-width:8"/>
   <path id="afm" d="m265.5 707.3c8.3739-0.27592 16.752-0.25435 25.129-0.20677 5.9896 0.11068 11.914-0.56331 17.838-1.3215 1.983-0.21807 1.02-0.12366 2.8886-0.2872l-12.112-8.6094c-1.852 0.22302-0.89923 0.10001-2.858 0.37207-5.7203 0.86176-11.448 1.6074-17.255 1.4924-8.5667 0.0494-17.134 0.059-25.698-0.20678z" style="opacity:0;stroke-width:8"/>
   <path id="afn" d="m559.32 707.13c-1.4607 0.29119-2.9086 0.65613-4.3822 0.87356-6.9911 1.0316-14.636 1.5958-21.591 2.017-6.9046 0.4181-13.813 0.78256-20.725 1.0504-19.357 0.74995-33.512 0.87535-53.01 1.2028-42.863 0.7939-85.733 0.0227-128.6 0.37868-2.1857 0.0344-13.523 0.1952-16.605 0.30062-1.6396 0.0561-3.2936 8e-3 -4.9148 0.25861-1.0808 0.16735-2.6332 0.0121-3.1291 0.98686-1.9358 3.8048 4.3876 10.054 5.4066 11.471 3.4042 3.6192 6.6205 7.4248 10.212 10.858 9.782 9.3487 29.173 25.792 39.394 33.477 8.2706 6.2182 16.613 12.393 25.46 17.759 11.584 7.0257 23.276 14.045 35.74 19.357 8.7438 3.727 18.324 5.0616 27.486 7.5924 7.9563 0.56064 15.932 2.4736 23.869 1.6819 14.671-1.4635 31.414-11.569 34.003-27.252 1.4877-9.0118-2.2224-12.874-6.2375-20.056-2.7403-1.8456-5.2238-4.1466-8.221-5.5367-6.5886-3.0558-13.312-6.0245-20.373-7.725-3.2399-0.78029-13.33 1.2226-14.802 5.5702-0.29306 0.86515 0.1819 1.8178 0.27284 2.7267 6.0821 7.9448 16.579 12.135 26.366 11.628 2.1753-0.2532 4.3079-0.61516 6.5-0.61889l-12.005-8.6609c-2.1603 0.13645-4.2889 0.4762-6.4459 0.6492-2.2177 8e-3 -4.3937-0.10775-6.5615-0.64455-0.86575-0.21438-3.2763-1.3212-2.5538-0.79838 2.5041 1.8122 14.861 9.4514 7.9747 4.7324-0.33888-0.53527-1.0776-0.97523-1.0166-1.6058 0.21958-2.2708 4.0682-3.8554 5.4329-4.1788 2.4706-0.58535 5.958 1.2018 7.5798-0.75169 1.2322-1.4843-4.6394-5.0702-2.7108-5.1133 3.2913-0.0736 5.6848 3.3222 8.5271 4.9832 4.1874 6.7025 8.0828 10.468 7.1069 19.167-0.44649 3.9796-1.8553 7.9989-4.1701 11.267-5.9136 8.3484-17.248 14.703-27.245 15.902-7.6354 0.91588-15.355-0.87626-23.033-1.3144-8.9511-2.453-18.165-4.095-26.853-7.359-15.186-5.7053-32.649-18.377-44.957-27.721-7.2436-5.4997-14.15-11.437-21.003-17.417-14.955-13.048-14.03-12.645-25.282-25.204-1.4944-2.0568-3.0659-4.0597-4.4833-6.1703-0.53181-0.79194-1.6961-1.6312-1.3535-2.5215 0.33656-0.87467 1.7452-0.72015 2.6666-0.89105 1.5045-0.27903 3.0427-0.33187 4.5682-0.45075 4.1721-0.32512 11.953-0.70249 15.732-0.90178 42.057-1.7206 84.162-1.6661 126.25-2.0656 96.212-0.93122-37.82 0.36349 53.99-0.5153 16.6-0.15889 33.374 0.18211 49.868-2.044z" style="opacity:0;stroke-width:8"/>
  </g>
  <text id="afo" transform="matrix(.16 0 0 .16 257.55 1326.5)" clip-path="url(#bs)" xml:space="preserve"><tspan id="afp" x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">1</tspan></text>
  <text id="afq" transform="matrix(.16 0 0 .16 334.51 1341.7)" clip-path="url(#br)" xml:space="preserve"><tspan id="afr" x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">2</tspan></text>
  <text id="afs" transform="matrix(.16 0 0 .16 438.67 1338.1)" clip-path="url(#bq)" xml:space="preserve"><tspan id="aft" x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">3</tspan></text>
  <text id="afu" transform="matrix(.16 0 0 .16 697.87 1335.4)" clip-path="url(#bp)" xml:space="preserve"><tspan id="afv" x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">4</tspan></text>
  <text id="afw" transform="matrix(.16 0 0 .16 797.23 1337.8)" clip-path="url(#bo)" xml:space="preserve"><tspan id="afx" x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">5</tspan></text>
  <text id="afy" transform="matrix(.16 0 0 .16 695.15 1254.5)" clip-path="url(#bn)" xml:space="preserve"><tspan id="afz" x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">8</tspan></text>
  <text id="aga" transform="matrix(.16 0 0 .16 677.87 1291.1)" clip-path="url(#bm)" xml:space="preserve"><tspan id="agb" x="0 46.765999 99.495003 155.976 196.377 245.42101 286.69299 329.03699" y="0" fill="#000000" font-family="Verdana" font-size="67px">COMPUTER</tspan></text>
  <text id="agc" transform="matrix(.16 0 0 .16 677.39 1304.2)" clip-path="url(#bl)" xml:space="preserve"><tspan id="agd" x="0 37.319 65.526001 111.488 158.05299 203.881 250.446" y="0" fill="#000000" font-family="Verdana" font-size="67px">LIBRARY</tspan></text>
  <text id="age" transform="matrix(.16 0 0 .16 791.31 1270.5)" clip-path="url(#bk)" xml:space="preserve"><tspan id="agf" x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">7</tspan></text>
  <text id="agg" transform="matrix(.16 0 0 .16 442.83 1268.1)" clip-path="url(#bj)" xml:space="preserve"><tspan id="agh" x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">9</tspan></text>
  <text id="agi" transform="matrix(.16 0 0 .16 344.59 1268.4)" clip-path="url(#bi)" xml:space="preserve"><tspan id="agj" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">10</tspan></text>
  <text id="agk" transform="matrix(.16 0 0 .16 408.27 1167.3)" clip-path="url(#bh)" xml:space="preserve"><tspan id="agl" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">11</tspan></text>
  <text id="agm" transform="matrix(.16 0 0 .16 185.71 612.53)" clip-path="url(#bg)" xml:space="preserve"><tspan id="agn" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">45</tspan></text>
  <text id="ago" transform="matrix(.16 0 0 .16 195.95 515.09)" clip-path="url(#bf)" xml:space="preserve"><tspan id="agp" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">44</tspan></text>
  <text id="agq" transform="matrix(.16 0 0 .16 190.83 337.01)" clip-path="url(#be)" xml:space="preserve"><tspan id="agr" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">42</tspan></text>
  <text id="ags" transform="matrix(.16 0 0 .16 184.91 424.05)" clip-path="url(#bd)" xml:space="preserve"><tspan id="agt" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">43</tspan></text>
  <text id="agu" transform="matrix(.16 0 0 .16 186.19 233.17)" clip-path="url(#bc)" xml:space="preserve"><tspan id="agv" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">41</tspan></text>
  <text id="agw" transform="matrix(.16 0 0 .16 255.95 233.49)" clip-path="url(#bb)" xml:space="preserve"><tspan id="agx" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">40</tspan></text>
  <text id="agy" transform="matrix(.16 0 0 .16 254.03 336.05)" clip-path="url(#ba)" xml:space="preserve"><tspan id="agz" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">51</tspan></text>
  <text id="aha" transform="matrix(.16 0 0 .16 257.23 424.53)" clip-path="url(#az)" xml:space="preserve"><tspan id="ahb" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">52</tspan></text>
  <text id="ahc" transform="matrix(.16 0 0 .16 263.79 517.17)" clip-path="url(#ay)" xml:space="preserve"><tspan id="ahd" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">53</tspan></text>
  <text id="ahe" transform="matrix(.16 0 0 .16 259.79 615.73)" clip-path="url(#ax)" xml:space="preserve"><tspan id="ahf" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">54</tspan></text>
  <text id="ahg" transform="matrix(.16 0 0 .16 254.03 916.69)" clip-path="url(#aw)" xml:space="preserve"><tspan id="ahh" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">56</tspan></text>
  <text id="ahi" transform="matrix(.16 0 0 .16 253.39 1017.2)" clip-path="url(#av)" xml:space="preserve"><tspan id="ahj" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">57</tspan></text>
  <text id="ahk" transform="matrix(.16 0 0 .16 255.15 1122.5)" clip-path="url(#au)" xml:space="preserve"><tspan id="ahl" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">58</tspan></text>
  <text id="ahm" transform="matrix(.16 0 0 .16 251.79 1212.9)" clip-path="url(#at)" xml:space="preserve"><tspan id="ahn" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">59</tspan></text>
  <text id="aho" transform="matrix(.16 0 0 .16 950.35 1232.4)" clip-path="url(#as)" xml:space="preserve"><tspan id="ahp" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">15</tspan></text>
  <text id="ahq" transform="matrix(.16 0 0 .16 753.23 229.17)" clip-path="url(#ar)" xml:space="preserve"><tspan id="ahr" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">35</tspan></text>
  <text id="ahs" transform="matrix(.16 0 0 .16 951.95 1129.5)" clip-path="url(#aq)" xml:space="preserve"><tspan id="aht" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">16</tspan></text>
  <text id="ahu" transform="matrix(.16 0 0 .16 956.43 934.93)" clip-path="url(#ap)" xml:space="preserve"><tspan id="ahv" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">18</tspan></text>
  <text id="ahw" transform="matrix(.16 0 0 .16 951.47 817.97)" clip-path="url(#ao)" xml:space="preserve"><tspan id="ahx" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">19</tspan></text>
  <text id="ahy" transform="matrix(.16 0 0 .16 964.11 616.53)" clip-path="url(#an)" xml:space="preserve"><tspan id="ahz" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">20</tspan></text>
  <text id="aia" transform="matrix(.16 0 0 .16 962.19 517.81)" clip-path="url(#am)" xml:space="preserve"><tspan id="aib" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">21</tspan></text>
  <text id="aic" transform="matrix(.16 0 0 .16 956.75 420.53)" clip-path="url(#al)" xml:space="preserve"><tspan id="aid" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">22</tspan></text>
  <text id="aie" transform="matrix(.16 0 0 .16 955.63 326.77)" clip-path="url(#ak)" xml:space="preserve"><tspan id="aif" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">23</tspan></text>
  <text id="aig" transform="matrix(.16 0 0 .16 954.99 229.49)" clip-path="url(#aj)" xml:space="preserve"><tspan id="aih" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">33</tspan></text>
  <text id="aii" transform="matrix(.16 0 0 .16 880.11 230.93)" clip-path="url(#ai)" xml:space="preserve"><tspan id="aij" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">34</tspan></text>
  <text id="aik" transform="matrix(.16 0 0 .16 875.31 324.53)" clip-path="url(#ah)" xml:space="preserve"><tspan id="ail" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">32</tspan></text>
  <text id="aim" transform="matrix(.16 0 0 .16 881.23 421.97)" clip-path="url(#ag)" xml:space="preserve"><tspan id="ain" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">31</tspan></text>
  <text id="aio" transform="matrix(.16 0 0 .16 874.83 522.61)" clip-path="url(#af)" xml:space="preserve"><tspan id="aip" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">30</tspan></text>
  <text id="aiq" transform="matrix(.16 0 0 .16 877.23 615.73)" clip-path="url(#ae)" xml:space="preserve"><tspan id="air" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">29</tspan></text>
  <text id="ais" transform="matrix(.16 0 0 .16 878.19 817.97)" clip-path="url(#ad)" xml:space="preserve"><tspan id="ait" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">28</tspan></text>
  <text id="aiu" transform="matrix(.16 0 0 .16 884.91 935.89)" clip-path="url(#ac)" xml:space="preserve"><tspan id="aiv" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">27</tspan></text>
  <text id="aiw" transform="matrix(.16 0 0 .16 877.23 1031.6)" clip-path="url(#ab)" xml:space="preserve"><tspan id="aix" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">26</tspan></text>
  <text id="aiy" transform="matrix(.16 0 0 .16 876.91 1132.4)" clip-path="url(#aa)" xml:space="preserve"><tspan id="aiz" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">25</tspan></text>
  <text id="aja" transform="matrix(.16 0 0 .16 890.51 1236.7)" clip-path="url(#z)" xml:space="preserve"><tspan id="ajb" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">24</tspan></text>
  <text id="ajc" transform="matrix(.16 0 0 .16 677.87 224.21)" clip-path="url(#y)" xml:space="preserve"><tspan id="ajd" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">36</tspan></text>
  <text id="aje" transform="matrix(.16 0 0 .16 543.63 233.65)" clip-path="url(#x)" xml:space="preserve"><tspan id="ajf" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">37</tspan></text>
  <text id="ajg" transform="matrix(.16 0 0 .16 442.03 231.57)" clip-path="url(#w)" xml:space="preserve"><tspan id="ajh" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">38</tspan></text>
  <text id="aji" transform="matrix(.16 0 0 .16 370.35 231.41)" clip-path="url(#v)" xml:space="preserve"><tspan id="ajj" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">39</tspan></text>
  <text id="ajk" transform="matrix(.16 0 0 .16 358.83 1031.3)" clip-path="url(#u)" xml:space="preserve"><tspan id="ajl" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">61</tspan></text>
  <text id="ajm" transform="matrix(.16 0 0 .16 460.27 1130.8)" clip-path="url(#t)" xml:space="preserve"><tspan id="ajn" x="0 25.872 55.062 81.606003 110.334 139.062" y="0" fill="#000000" font-family="Verdana" font-size="42px">TREAS.</tspan></text>
  <text id="ajo" transform="matrix(.16 0 0 .16 459.79 1139.1)" clip-path="url(#s)" xml:space="preserve"><tspan id="ajp" x="0 28.728001 54.599998 87.653999 116.844" y="0" fill="#000000" font-family="Verdana" font-size="42px">STORE</tspan></text>
  <text id="ajq" transform="matrix(.16 0 0 .16 459.63 1147.3)" clip-path="url(#r)" xml:space="preserve"><tspan id="ajr" x="0 29.190001 64.596001" y="0" fill="#000000" font-family="Verdana" font-size="42px">RM.</tspan></text>
  <text id="ajs" transform="matrix(.16 0 0 .16 805.07 1122.9)" clip-path="url(#q)" xml:space="preserve"><tspan id="ajt" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">68</tspan></text>
  <text id="aju" transform="matrix(.16 0 0 .16 782.99 1027.3)" clip-path="url(#p)" xml:space="preserve"><tspan id="ajv" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">67</tspan></text>
  <text id="ajw" transform="matrix(.16 0 0 .16 778.19 947.89)" clip-path="url(#o)" xml:space="preserve"><tspan id="ajx" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">66</tspan></text>
  <text id="ajy" transform="matrix(.16 0 0 .16 338.51 1111.9)" clip-path="url(#n)" xml:space="preserve"><tspan id="ajz" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">60</tspan></text>
  <text id="aka" transform="matrix(.16 0 0 .16 357.07 953.17)" clip-path="url(#m)" xml:space="preserve"><tspan id="akb" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">62</tspan></text>
  <text id="akc" transform="matrix(.16 0 0 .16 477.55 335.89)" clip-path="url(#l)" xml:space="preserve"><tspan id="akd" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">63</tspan></text>
  <text id="ake" transform="matrix(.16 0 0 .16 570.67 333.17)" clip-path="url(#k)" xml:space="preserve"><tspan id="akf" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">64</tspan></text>
  <text id="akg" transform="matrix(.16 0 0 .16 653.87 339.89)" clip-path="url(#j)" xml:space="preserve"><tspan id="akh" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">65</tspan></text>
  <text id="aki" transform="matrix(.16 0 0 .16 951.95 1030.6)" clip-path="url(#i)" xml:space="preserve"><tspan id="akj" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">17</tspan></text>
  <text id="akk" transform="matrix(.16 0 0 .16 468.91 1165.3)" clip-path="url(#h)" xml:space="preserve"><tspan id="akl" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">12</tspan></text>
  <text id="akm" transform="matrix(.16 0 0 .16 669.71 1165.8)" clip-path="url(#g)" xml:space="preserve"><tspan id="akn" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">13</tspan></text>
  <text id="ako" transform="matrix(.16 0 0 .16 726.35 1167.7)" clip-path="url(#f)" xml:space="preserve"><tspan id="akp" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">14</tspan></text>
  <text id="akq" transform="matrix(.16 0 0 .16 182.67 915.41)" clip-path="url(#e)" xml:space="preserve"><tspan id="akr" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">47</tspan></text>
  <text id="aks" transform="matrix(.16 0 0 .16 183.31 1017.5)" clip-path="url(#d)" xml:space="preserve"><tspan id="akt" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">48</tspan></text>
  <text id="aku" transform="matrix(.16 0 0 .16 185.55 1120.7)" clip-path="url(#c)" xml:space="preserve"><tspan id="akv" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">49</tspan></text>
  <text id="akw" transform="matrix(.16 0 0 .16 184.11 1231.6)" clip-path="url(#b)" xml:space="preserve"><tspan id="akx" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">50</tspan></text>
  <text id="aky" transform="matrix(.16 0 0 .16 526.83 1143.4)" clip-path="url(#a)" xml:space="preserve"><tspan id="akz" x="0 17.681999 49.098 73.248001 106.302 121.59 136.37399 165.10201 194.29201 220.836" y="0" fill="#000000" font-family="Verdana" font-size="42px">INFO. AREA</tspan></text>
  <text id="ala" transform="matrix(.16 0 0 .16 176.91 816.53)" xml:space="preserve"><tspan id="alb" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">46</tspan></text>
  <text id="alc" transform="matrix(.16 0 0 .16 257.23 814.77)" xml:space="preserve"><tspan id="ald" x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">55</tspan></text>
  <text id="ale" transform="matrix(.16 0 0 .16 884.75 1325.8)" xml:space="preserve"><tspan id="alf" x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">6</tspan></text>
  <path id="alg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1042 9169v-8l-24 4z" fill="#0f0" stroke="#0f0" stroke-linecap="round" stroke-miterlimit="10"/>
  <path id="alh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6177 9169v-8l24 4z" fill="#0f0" stroke="#0f0" stroke-linecap="round" stroke-miterlimit="10"/>
  <path id="ali" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m563 8736h8l-4 24z" fill="#0f0" stroke="#0f0" stroke-linecap="round" stroke-miterlimit="10"/>
  <g id="alj" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <path id="alk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 6293h41v-41h-41v41" stroke-width="4"/>
   <path id="all" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 4427h41v-42h-41v42"/>
   <path id="alm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 3805h41v-42h-41v42"/>
   <path id="aln" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 5671h42v-41h-42v41" stroke-width="4"/>
   <path id="alo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4130 2923h-41v-41h41v41" stroke-width="2"/>
   <g id="alp" stroke-width="4">
    <path id="alq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3805v580"/>
    <path id="alr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 3805v580"/>
    <path id="als" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4427v73"/>
    <path id="alt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 4427v73"/>
    <path id="alu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4385v622"/>
    <path id="alv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 4385v622"/>
    <path id="alw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5049v581"/>
    <path id="alx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 5049v581"/>
    <path id="aly" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5671v581"/>
    <path id="alz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 5671v581"/>
    <path id="ama" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 6293v581"/>
    <path id="amb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 6293v581"/>
    <path id="amc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5655h360"/>
    <path id="amd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5645h360"/>
    <path id="ame" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 5655h380"/>
    <path id="amf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 5645h380"/>
   </g>
   <g id="amg">
    <path id="amh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4411h360"/>
    <path id="ami" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4401h360"/>
    <path id="amj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 5007v-580"/>
    <path id="amk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 5007v-580"/>
    <path id="aml" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3789h360"/>
    <path id="amm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3779h360"/>
    <path id="amn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 3805v580"/>
    <path id="amo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 3805v580"/>
    <path id="amp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2540h360"/>
    <path id="amq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2529h360"/>
    <path id="amr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 3183v580"/>
    <path id="ams" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 3183v580"/>
    <path id="amt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 4411h380"/>
    <path id="amu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 4401h380"/>
    <path id="amv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 3789h380"/>
    <path id="amw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 3779h380"/>
    <path id="amx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 2540h380"/>
    <path id="amy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 2529h380"/>
    <path id="amz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6278h360"/>
    <path id="ana" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6267h360"/>
    <path id="anb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 6278h380"/>
    <path id="anc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 6267h380"/>
    <path id="and" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 6252v-581"/>
    <path id="ane" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 6252v-581"/>
    <path id="anf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6900h360"/>
    <path id="ang" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6889h360"/>
    <path id="anh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 6900h380"/>
    <path id="ani" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 6889h380"/>
    <path id="anj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 6874v-581"/>
    <path id="ank" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 6874v-581"/>
    <path id="anl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7522h360"/>
    <path id="anm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7511h360"/>
    <path id="ann" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 7496v-581"/>
    <path id="ano" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 7496v-581"/>
   </g>
   <g id="anp" stroke-width="2">
    <path id="anq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3183v580"/>
    <path id="anr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3183v580"/>
    <path id="ans" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3805v580"/>
    <path id="ant" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3805v580"/>
    <path id="anu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3805v1202"/>
    <path id="anv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3805v1202"/>
    <path id="anw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 5049v1203"/>
    <path id="anx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5049v1203"/>
    <path id="any" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6293v581"/>
    <path id="anz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6293v581"/>
   </g>
   <g id="aoa">
    <path id="aob" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8144h381"/>
    <path id="aoc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8133h381"/>
    <path id="aod" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8144h380"/>
    <path id="aoe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8133h380"/>
    <path id="aof" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 7522h380"/>
    <path id="aog" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 7511h380"/>
    <path id="aoh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1178 7511h-10"/>
    <path id="aoi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 3183h41v-42h-41v42"/>
    <path id="aoj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 8740v-581"/>
    <path id="aok" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 8740v-581"/>
    <path id="aol" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 8118v-519"/>
    <path id="aom" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 8118v-519"/>
   </g>
   <g id="aon" stroke-width="2">
    <path id="aoo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 3141v-78"/>
    <path id="aop" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3141v-94"/>
    <path id="aoq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4130 2923h-41v-41h41v41"/>
   </g>
   <g id="aor">
    <path id="aos" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 2555v586"/>
    <path id="aot" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 2555v586"/>
    <path id="aou" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3167h360"/>
    <path id="aov" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3157h360"/>
    <path id="aow" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 3167h380"/>
    <path id="aox" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 3157h380"/>
    <path id="aoy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 1933v581"/>
    <path id="aoz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 1933v581"/>
   </g>
   <path id="apa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3805v1202" stroke-width="4"/>
   <path id="apb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3805v1202" stroke-width="4"/>
   <path id="apc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3141v-78" stroke-width="2"/>
   <path id="apd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3141v-94" stroke-width="2"/>
   <g id="ape">
    <path id="apf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 3141h-21"/>
    <path id="apg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 3141v-186"/>
    <path id="aph" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 3141h26v-186h16v186"/>
   </g>
   <g id="api" stroke-width="2">
    <path id="apj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3032-56 50 15 18-53-17 16 20-77 61"/>
    <path id="apk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2870 2923v135"/>
    <path id="apl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 3048h-1511"/>
    <path id="apm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 3058h-1511v-10"/>
    <path id="apn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2870 3058h415"/>
   </g>
   <g id="apo">
    <path id="app" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4835 3141h26"/>
    <path id="apq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4802 3110h49"/>
    <path id="apr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4773 3079h78"/>
    <path id="aps" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4742 3048h109"/>
    <path id="apt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3017h124"/>
    <path id="apu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 2986h124"/>
    <path id="apv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 2955h124"/>
    <path id="apw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3141v-186"/>
    <path id="apx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 2923h-124v218-186"/>
    <path id="apy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3141h-16"/>
    <path id="apz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3110h-49"/>
    <path id="aqa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3079h-78"/>
    <path id="aqb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3048h-109"/>
    <path id="aqc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3017h-124"/>
    <path id="aqd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 2986h-124"/>
    <path id="aqe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 2955h-140v186"/>
    <path id="aqf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 2923v241"/>
    <path id="aqg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 2927v237"/>
   </g>
   <path id="aqh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3032 54 55-13 13 38-13-10 17 55 53" stroke-width="2"/>
   <path id="aqi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4929 5349v-293" stroke-width="4"/>
   <path id="aqj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5349v-293" stroke-width="4"/>
   <path id="aqk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5432v-78" stroke-width="3"/>
   <g id="aql" stroke-width="4">
    <path id="aqm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4994 5964h-267v-11h267v11"/>
    <path id="aqn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6150v-10h397v10"/>
    <path id="aqo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6150h-185"/>
    <path id="aqp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4917 6150h-190"/>
    <path id="aqq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4918 6038v-74h-10v74h10"/>
    <path id="aqr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5020 5067h-293v-11h293"/>
    <path id="aqs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 4859h11v208h-11v-208"/>
   </g>
   <g id="aqt">
    <path id="aqu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3044 8740v-581h10v581h-10"/>
    <path id="aqv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2605 8133v623h-96v10h106v-633h-10"/>
    <path id="aqw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8289h21"/>
    <path id="aqx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3187 8289h64v-156"/>
    <path id="aqy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8299h21"/>
    <path id="aqz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3187 8299h64"/>
    <path id="ara" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8346v-213"/>
    <path id="arb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8299v47"/>
    <path id="arc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 2671-216 216"/>
    <path id="ard" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 2891-31 32"/>
    <path id="are" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 2686-202 201"/>
    <path id="arf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 2906-21 21"/>
    <path id="arg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 2923v241"/>
    <path id="arh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 2927v237"/>
    <path id="ari" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8610v-152h10v-112h-10v112"/>
    <path id="arj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8458v154"/>
    <path id="ark" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 2555h41v-41h-41v41"/>
    <path id="arl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 6273h843"/>
    <path id="arm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 7517h843"/>
    <path id="arn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3326 7522h10v376h-10v-376"/>
    <path id="aro" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4552 8133h10"/>
    <path id="arp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4552 8133v633h159v-10h-149v-623"/>
    <path id="arq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5364 1892h-10v-491h10v491"/>
    <path id="arr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 1892h-10v-491h10v491"/>
    <path id="ars" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 2255h-10v-322h10v322"/>
    <path id="art" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5354 1790v11h-617v-11h617"/>
    <path id="aru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1856 1892h10v-491h-10v491"/>
    <path id="arv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 1892h10v-491h-10v491"/>
    <path id="arw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 2255h10v-322h-10v322"/>
    <path id="arx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 1790v11h612v-11h-612"/>
    <path id="ary" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 1790v11h617v-11h-617"/>
    <path id="arz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8133v11h-380v-11h380"/>
    <path id="asa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8133v11h380v-11h-380"/>
    <path id="asb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 8740h-11v-581h11v581"/>
    <path id="asc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 3141h-11v-586h11v586"/>
    <path id="asd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3157v10h-360v-10h360"/>
    <path id="ase" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 3167v-10h380v10h-380"/>
    <path id="asf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 3763h-11v-580h11v580"/>
    <path id="asg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 4385h-11v-580h11v580"/>
    <path id="ash" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 5007h-11v-580h11v580"/>
    <path id="asi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 6252h-11v-581h11v581"/>
    <path id="asj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 6874h-11v-581h11v581"/>
    <path id="ask" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 7496h-11v-581h11v581"/>
    <path id="asl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 8118h-11v-519h11v519"/>
    <path id="asm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2529v11h-360v-11h360"/>
    <path id="asn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 2540v-11h380v11h-380"/>
    <path id="aso" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3779v10h-360v-10h360"/>
    <path id="asp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 3789v-10h380v10h-380"/>
    <path id="asq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4401v10h-360v-10h360"/>
    <path id="asr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 4411v-10h380v10h-380"/>
    <path id="ass" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5023v10h-360v-10h360"/>
    <path id="ast" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 5033v-10h380v10h-380"/>
    <path id="asu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6267v11h-360v-11h360"/>
    <path id="asv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 6278v-11h380v11h-380"/>
    <path id="asw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6889v11h-360v-11h360"/>
    <path id="asx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 6900v-11h380v11h-380"/>
    <path id="asy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7511v11h-360v-11h360"/>
    <path id="asz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 7522v-11h380v11h-380"/>
    <path id="ata" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5033h360"/>
    <path id="atb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5023h360"/>
    <path id="atc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 5033h380"/>
    <path id="atd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 5023h380"/>
    <path id="ate" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1612 7511h-11"/>
    <path id="atf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 2514h-11v-581h11v581"/>
    <path id="atg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3814 7522h11v376h-11v-376"/>
   </g>
  </g>
  <g id="ath" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="ati" stroke-width="2">
    <path id="atj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3183h42v-42h-42v42"/>
    <path id="atk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6293h42v-41h-42v41"/>
    <path id="atl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 5049h42v-42h-42v42"/>
    <path id="atm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3805h42v-42h-42v42"/>
    <path id="atn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2252 2532h31v-31h-31v31"/>
   </g>
   <path id="ato" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 2667h-31v31h31v-31" stroke-width="4"/>
   <path id="atp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2337 2887h-31v31h31v-31" stroke-width="4"/>
   <g id="atq" stroke-width="2">
    <path id="atr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2504 2721h-32v31h32v-31"/>
    <path id="ats" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2815 2721h-31v31h31v-31"/>
    <path id="att" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4968 2532h-31v-31h31v31"/>
    <path id="atu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 2667h31v31h-31v-31"/>
    <path id="atv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 2887h31v31h-31v-31"/>
    <path id="atw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4716 2721h31v31h-31v-31"/>
    <path id="atx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4405 2721h31v31h-31v-31"/>
   </g>
   <path id="aty" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 6293h-42v-41h42v41" stroke-width="4"/>
   <path id="atz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 3670h26v-26h-26v26" stroke-width="4"/>
  </g>
  <g id="aua" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="aub" stroke="#000" stroke-width="2">
    <path id="auc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 5049v1203"/>
    <path id="aud" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5049v1203"/>
    <path id="aue" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5049v1203"/>
    <path id="auf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 5049v1203"/>
   </g>
   <g id="aug" stroke="#545454" stroke-width="2">
    <path id="auh" transform="matrix(-.16 0 0 .16 344.83 537.89)" d="m4.3655-6.0986c1.304 0.93339 2.2744 2.2602 2.769 3.7856"/>
    <path id="aui" transform="matrix(-.16 0 0 .16 360.35 540.13)" d="m104.19-16.56c0.74647 4.6968 1.1745 9.4386 1.2812 14.193"/>
    <path id="auj" transform="matrix(-.16 0 0 .16 353.63 540.45)" d="m60.894-24.129c2.5818 6.5156 4.1011 13.403 4.5 20.401"/>
    <path id="auk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 6510h4l1-1v1h4l1 1h2l2 2 2 1 1 2 1 1 4 8v13l-3 6-1 1-1 2-1 1-2 1-1 1-2 1-1 1h-2l-1 1h-4l-2-1h-1"/>
    <path id="aul" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2139 6504 2 1h2l3 1 4 2 2 2 2 1 2 2 1 2 1 3 1 2 2 6v11l-1 2-2 6-2 4-4 4-2 1-2 2-2 1h-3l-2 1h-5l-2-1h-2l-3-1-2-2-2-1-2-2-1-2-2-2-1-2-2-6-1-2v-11l2-6 1-2 1-3 2-2 1-2 2-1 2-2 2-1 3-1 2-1h2l3-1"/>
    <path id="aum" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2139 6507h5l6 3 2 2 1 2 2 2 4 8v14l-1 2-1 3-2 4-5 5-6 3h-2l-2 1h-3l-2-1h-2l-6-3-1-2-2-1-1-2-2-2-1-2-1-3v-2l-1-2v-9l1-3v-2l2-4 2-2 1-2 2-2 1-2 6-3h6"/>
    <path id="aun" transform="matrix(-.16 0 0 .16 344.19 540.29)" d="m-3.2813-1.2179c0.43625-1.1754 1.4678-2.0276 2.7044-2.2342 1.2366-0.20664 2.4892 0.26391 3.2839 1.2336"/>
    <path id="auo" transform="matrix(-.16 0 0 .16 344.19 540.29)" d="m-1.6675-1.8626c0.75051-0.67189 1.8309-0.82771 2.7407-0.39528"/>
    <path id="aup" transform="matrix(-.16 0 0 .16 344.83 542.53)" d="m7.1342 2.3137c-0.49469 1.5254-1.4653 2.8521-2.7693 3.7853"/>
    <path id="auq" transform="matrix(-.16 0 0 .16 360.35 540.29)" d="m105.48 2.0329c-0.0939 4.8696-0.5248 9.7268-1.2898 14.537"/>
    <path id="aur" transform="matrix(-.16 0 0 .16 343.23 540.29)" d="m2.4993-0.058c0.03203 1.3802-1.0608 2.5252-2.4411 2.5573"/>
    <path id="aus" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6529 7 1"/>
    <path id="aut" transform="matrix(-.16 0 0 .16 344.35 540.29)" d="m-0.19831 1.4868c-0.77291-0.10308-1.3379-0.78117-1.2999-1.56"/>
    <path id="auu" transform="matrix(-.16 0 0 .16 344.19 540.29)" d="m2.707 2.2186c-0.7947 0.96966-2.0473 1.4402-3.2839 1.2336-1.2366-0.20663-2.2682-1.0589-2.7044-2.2342"/>
    <path id="auv" transform="matrix(-.16 0 0 .16 344.19 540.29)" d="m1.0732 2.2579c-0.90978 0.43243-1.9902 0.27661-2.7407-0.39528"/>
    <path id="auw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 6533v-1"/>
    <path id="aux" transform="matrix(-.16 0 0 .16 344.83 540.29)" d="m-1.4988 0.05967c-0.03259-0.8187 0.59778-1.5121 1.4159-1.5574"/>
    <path id="auy" transform="matrix(-.16 0 0 .16 344.83 540.29)" d="m-0.08294 1.4977c-0.81809-0.04531-1.4485-0.73868-1.4159-1.5574"/>
    <path id="auz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 6530h2"/>
    <path id="ava" transform="matrix(-.16 0 0 .16 344.51 540.13)" d="m-0.18233 1.4889c-0.18054-0.02211-0.35556-0.07688-0.51651-0.16162"/>
    <path id="avb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 6530-5-1h-3l-3-1"/>
    <path id="avc" transform="matrix(-.16 0 0 .16 342.75 540.29)" d="m3.4998-0.0396c0.02184 1.9309-1.5243 3.5147-3.4552 3.5393"/>
    <path id="avd" transform="matrix(-.16 0 0 .16 342.75 540.29)" d="m0.04496-3.4997c1.9309 0.02481 3.4768 1.6087 3.4548 3.5396"/>
    <path id="ave" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 6534h6l5-1"/>
    <path id="avf" transform="matrix(-.16 0 0 .16 344.51 540.29)" d="m-0.69884-1.3273c0.16095-0.08474 0.33597-0.13951 0.51651-0.16162"/>
    <path id="avg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 6533h2"/>
    <path id="avh" transform="matrix(-.16 0 0 .16 343.23 540.29)" d="m-0.37441-2.4718c0.72566-0.10992 1.463 0.10458 2.0164 0.58663 0.55344 0.48204 0.8671 1.1829 0.85781 1.9168"/>
    <path id="avi" transform="matrix(-.16 0 0 .16 343.23 540.29)" d="m2.4998-0.0314c0.00922 0.73384-0.30447 1.4347-0.8579 1.9166s-1.2907 0.69647-2.0163 0.58655"/>
    <path id="avj" transform="matrix(-.16 0 0 .16 343.23 540.29)" d="m0.05848-2.4993c1.3802 0.0323 2.473 1.1773 2.4408 2.5576"/>
    <path id="avk" transform="matrix(-.16 0 0 .16 344.83 540.29)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
    <path id="avl" transform="matrix(-.16 0 0 .16 344.83 540.29)" d="m-0.98107 1.1347c-0.34892-0.30169-0.53964-0.74714-0.51714-1.2079"/>
    <path id="avm" transform="matrix(-.16 0 0 .16 344.83 540.29)" d="m-0.19831 1.4868c-0.28965-0.03863-0.56171-0.16102-0.78276-0.35214"/>
    <path id="avn" transform="matrix(-.16 0 0 .16 344.51 540.13)" d="m-0.69884 1.3273c-0.43508-0.22908-0.73027-0.65686-0.79004-1.1449"/>
    <path id="avo" transform="matrix(-.16 0 0 .16 344.51 540.29)" d="m-1.4889-0.18233c0.05977-0.48807 0.35496-0.91585 0.79004-1.1449"/>
    <path id="avp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6534 7-1"/>
    <path id="avq" transform="matrix(-.16 0 0 .16 344.35 540.29)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
    <path id="avr" transform="matrix(-.16 0 0 .16 342.43 540.29)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
    <path id="avs" transform="matrix(-.16 0 0 .16 342.43 540.29)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="avt" transform="matrix(-.16 0 0 .16 343.39 540.29)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="avu" transform="matrix(-.16 0 0 .16 343.39 540.29)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="avv" transform="matrix(-.16 0 0 .16 353.63 540.13)" d="m65.412 3.3895c-0.36868 7.1149-1.8957 14.122-4.5208 20.745"/>
    <path id="avw" transform="matrix(-.16 0 0 .16 345.31 553.09)" d="m4.3655-6.0986c1.304 0.93339 2.2744 2.2602 2.769 3.7856"/>
    <path id="avx" transform="matrix(-.16 0 0 .16 360.67 555.33)" d="m104.19-16.56c0.74647 4.6968 1.1745 9.4386 1.2812 14.193"/>
    <path id="avy" transform="matrix(-.16 0 0 .16 354.11 555.65)" d="m60.894-24.129c2.5818 6.5156 4.1011 13.403 4.5 20.401"/>
    <path id="avz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 6415h9l1 1h2l1 1 2 1 1 1 1 2 1 1 4 8v3l1 2v2l-1 2v4l-3 6-1 1-1 2-1 1-2 1-2 2-2 1h-1l-2 1h-4l-2-1h-1"/>
    <path id="awa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2141 6409 2 1h3l6 3 2 2 2 1 2 2 1 2 2 3 1 2v3l1 3v2l1 3-1 3v3l-1 2v3l-1 3-2 2-1 2-4 4-2 1-2 2-2 1h-2l-3 1h-5l-2-1h-2l-3-1-2-2-2-1-1-2-4-4-1-2-2-6-1-2v-11l2-6 1-2 1-3 7-7 2-1 3-1 2-1h2l3-1"/>
    <path id="awb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2141 6412h5l6 3 2 2 1 2 2 2 4 8v5l1 2-1 2v5l-1 2-1 3-2 4-5 5-6 3h-2l-1 1h-4l-2-1h-2l-4-2-3-3-2-1-1-2-2-2-1-2v-3l-2-4v-9l1-3 1-2v-2l1-2 2-2 1-2 5-5 4-2h6"/>
    <path id="awc" transform="matrix(-.16 0 0 .16 344.51 555.49)" d="m-3.2813-1.2179c0.43625-1.1754 1.4678-2.0276 2.7044-2.2342 1.2366-0.20664 2.4892 0.26391 3.2839 1.2336"/>
    <path id="awd" transform="matrix(-.16 0 0 .16 344.51 555.49)" d="m-1.6675-1.8626c0.75051-0.67189 1.8309-0.82771 2.7407-0.39528"/>
    <path id="awe" transform="matrix(-.16 0 0 .16 345.31 557.73)" d="m7.1342 2.3137c-0.49469 1.5254-1.4653 2.8521-2.7693 3.7853"/>
    <path id="awf" transform="matrix(-.16 0 0 .16 360.67 555.49)" d="m105.48 2.0329c-0.0939 4.8696-0.5248 9.7268-1.2898 14.537"/>
    <path id="awg" transform="matrix(-.16 0 0 .16 343.55 555.49)" d="m2.4993-0.058c0.03203 1.3802-1.0608 2.5252-2.4411 2.5573"/>
    <path id="awh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130 6434 8 1"/>
    <path id="awi" transform="matrix(-.16 0 0 .16 344.67 555.49)" d="m-0.19831 1.4868c-0.77291-0.10308-1.3379-0.78117-1.2999-1.56"/>
    <path id="awj" transform="matrix(-.16 0 0 .16 344.51 555.49)" d="m2.707 2.2186c-0.7947 0.96966-2.0473 1.4402-3.2839 1.2336-1.2366-0.20663-2.2682-1.0589-2.7044-2.2342"/>
    <path id="awk" transform="matrix(-.16 0 0 .16 344.51 555.49)" d="m1.0732 2.2579c-0.90978 0.43243-1.9902 0.27661-2.7407-0.39528"/>
    <path id="awl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2140 6438 1-1"/>
    <path id="awm" transform="matrix(-.16 0 0 .16 345.31 555.49)" d="m-1.4988 0.05967c-0.03259-0.8187 0.59778-1.5121 1.4159-1.5574"/>
    <path id="awn" transform="matrix(-.16 0 0 .16 345.31 555.49)" d="m-0.08294 1.4977c-0.81809-0.04531-1.4485-0.73868-1.4159-1.5574"/>
    <path id="awo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2141 6435h-2"/>
    <path id="awp" transform="matrix(-.16 0 0 .16 344.83 555.33)" d="m-0.18233 1.4889c-0.18054-0.02211-0.35556-0.07688-0.51651-0.16162"/>
    <path id="awq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 6435-4-1h-4l-3-1"/>
    <path id="awr" transform="matrix(-.16 0 0 .16 343.07 555.49)" d="m3.4998-0.0396c0.02184 1.9309-1.5243 3.5147-3.4552 3.5393"/>
    <path id="aws" transform="matrix(-.16 0 0 .16 343.07 555.49)" d="m0.04496-3.4997c1.9309 0.02481 3.4768 1.6087 3.4548 3.5396"/>
    <path id="awt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 6439h7l4-1"/>
    <path id="awu" transform="matrix(-.16 0 0 .16 344.83 555.49)" d="m-0.69884-1.3273c0.16095-0.08474 0.33597-0.13951 0.51651-0.16162"/>
    <path id="awv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2139 6438h1"/>
    <path id="aww" transform="matrix(-.16 0 0 .16 343.55 555.49)" d="m-0.37441-2.4718c0.72566-0.10992 1.463 0.10458 2.0164 0.58663 0.55344 0.48204 0.8671 1.1829 0.85781 1.9168"/>
    <path id="awx" transform="matrix(-.16 0 0 .16 343.55 555.49)" d="m2.4998-0.0314c0.00922 0.73384-0.30447 1.4347-0.8579 1.9166s-1.2907 0.69647-2.0163 0.58655"/>
    <path id="awy" transform="matrix(-.16 0 0 .16 343.55 555.49)" d="m0.05848-2.4993c1.3802 0.0323 2.473 1.1773 2.4408 2.5576"/>
    <path id="awz" transform="matrix(-.16 0 0 .16 345.15 555.49)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
    <path id="axa" transform="matrix(-.16 0 0 .16 345.15 555.49)" d="m-0.98107 1.1347c-0.34892-0.30169-0.53964-0.74714-0.51714-1.2079"/>
    <path id="axb" transform="matrix(-.16 0 0 .16 345.15 555.49)" d="m-0.19831 1.4868c-0.28965-0.03863-0.56171-0.16102-0.78276-0.35214"/>
    <path id="axc" transform="matrix(-.16 0 0 .16 344.83 555.33)" d="m-0.69884 1.3273c-0.43508-0.22908-0.73027-0.65686-0.79004-1.1449"/>
    <path id="axd" transform="matrix(-.16 0 0 .16 344.83 555.49)" d="m-1.4889-0.18233c0.05977-0.48807 0.35496-0.91585 0.79004-1.1449"/>
    <path id="axe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130 6439 8-1"/>
    <path id="axf" transform="matrix(-.16 0 0 .16 344.67 555.49)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
    <path id="axg" transform="matrix(-.16 0 0 .16 342.75 555.49)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
    <path id="axh" transform="matrix(-.16 0 0 .16 342.75 555.49)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="axi" transform="matrix(-.16 0 0 .16 343.71 555.49)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="axj" transform="matrix(-.16 0 0 .16 343.71 555.49)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="axk" transform="matrix(-.16 0 0 .16 354.11 555.33)" d="m65.412 3.3895c-0.36868 7.1149-1.8957 14.122-4.5208 20.745"/>
   </g>
   <path id="axl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2317.8 6208.7c-0.4363 1.1753-1.4678 2.0278-2.7044 2.2343-1.2366 0.2066-2.4892-0.2641-3.2839-1.2334" stroke="#808080"/>
   <path id="axm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2319.7 6209.4c-0.6856 1.8466-2.3067 3.186-4.2498 3.5107s-3.9116-0.4146-5.1604-1.9385" stroke="#808080"/>
   <path id="axn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2314 6206-6-2h-3" stroke="#000" stroke-width="3"/>
   <path id="axo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6210h3l6-1" stroke="#000" stroke-width="3"/>
   <g id="axp" stroke="#808080">
    <path id="axq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6210h3l6-2"/>
    <path id="axr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6209h3l6-1"/>
    <path id="axs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6208h3l5-1"/>
   </g>
   <path id="axt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2309.6 6205c1.1648-2.2495 3.7158-3.4126 6.178-2.8169 2.4624 0.5962 4.1992 2.7969 4.2063 5.3301 0.01 2.5337-1.717 4.7441-4.176 5.354-2.459 0.6098-5.0164-0.5391-6.1939-2.7823" stroke="#000" stroke-width="3"/>
   <path id="axu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2309.6 6205c1.1648-2.2495 3.7158-3.4126 6.178-2.8169 2.4624 0.5962 4.1992 2.7969 4.2063 5.3301 0.01 2.5337-1.717 4.7441-4.176 5.354-2.459 0.6098-5.0164-0.5391-6.1939-2.7823" stroke="#000" stroke-width="2"/>
   <g id="axv" stroke="#808080">
    <path id="axw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2311.8 6205.3c0.7947-0.9692 2.0473-1.4399 3.2839-1.2334 1.2366 0.2066 2.2681 1.0591 2.7044 2.2344"/>
    <path id="axx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2310.2 6204c1.2488-1.524 3.2173-2.2632 5.1604-1.9385s3.5642 1.6641 4.2498 3.5107"/>
    <path id="axy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2320 6207h-3"/>
    <path id="axz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2314 6213v-3"/>
    <path id="aya" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2314 6205v-3"/>
   </g>
   <path id="ayb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2312.7 6205.7c0.9666-0.9663 2.5303-0.977 3.5103-0.024 0.98 0.9527 1.0132 2.5161 0.074 3.5098-0.9389 0.9931-2.5014 1.0483-3.5083 0.124" stroke="#000" stroke-width="3"/>
   <g id="ayc" stroke="#808080">
    <path id="ayd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2318 6211-2-2"/>
    <path id="aye" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 6205 2-2"/>
    <path id="ayf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2310 6211 2-2"/>
    <path id="ayg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2312 6205-1-2"/>
   </g>
   <path id="ayh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2315.1 6206.1c0.553 0.2335 0.9131 0.7745 0.9158 1.375 0 0.6001-0.353 1.1441-0.9038 1.3829" stroke="#000" stroke-width="3"/>
   <g id="ayi" stroke="#808080">
    <g id="ayj" stroke-width="2">
     <path id="ayk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2315.2 6206.2c0.5066 0.2568 0.8247 0.7778 0.8215 1.3462 0 0.5679-0.3267 1.0854-0.8362 1.3369"/>
     <path id="ayl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2314.7 6207.1c0.1526 0.086 0.2493 0.2456 0.2547 0.4204 0.01 0.1748-0.081 0.3403-0.2281 0.4355"/>
     <path id="aym" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2314 6207"/>
    </g>
    <g id="ayn">
     <path id="ayo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6204 3 1 6 1"/>
     <path id="ayp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6205h3l6 2"/>
     <path id="ayq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6206h3l5 1"/>
    </g>
   </g>
   <g id="ayr" stroke="#000">
    <path id="ays" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2302 6210v-6" stroke-width="2"/>
    <path id="ayt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6210h-3" stroke-width="3"/>
    <path id="ayu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6204h-3" stroke-width="3"/>
   </g>
   <g id="ayv" stroke="#808080">
    <path id="ayw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6210h-3"/>
    <path id="ayx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6209h-3"/>
    <path id="ayy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6208h-3"/>
    <path id="ayz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6206h-3"/>
    <path id="aza" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6205h-3"/>
    <path id="azb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6204h-3"/>
   </g>
   <g id="azc" stroke="#000" stroke-width="3">
    <path id="azd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 6175 4-4"/>
    <path id="aze" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6174 4-3 2-2v-1"/>
    <path id="azf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2469 6173 3-4 2-2"/>
    <path id="azg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 6169 3-2"/>
    <path id="azh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2469 6173h1l5 1"/>
    <path id="azi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 6170 4 1 5 1"/>
    <path id="azj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2469 6168 3 1h3l2 1"/>
    <path id="azk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6166 3 1"/>
    <path id="azl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6167 1 5 1 3"/>
    <path id="azm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6166 1 4v1l1 4"/>
    <path id="azn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2474 6167 2 4v2"/>
    <path id="azo" transform="matrix(0 -.16 -.16 0 398.43 597.89)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
    <path id="azp" transform="matrix(0 -.16 -.16 0 398.43 597.89)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
    <path id="azq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2478 6176v-11h-11v11h11"/>
   </g>
   <path id="azr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2283.2 6209.7c-0.7946 0.9693-2.0473 1.44-3.2839 1.2334-1.2366-0.2065-2.2681-1.059-2.7043-2.2343" stroke="#808080"/>
   <path id="azs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2284.8 6211c-1.2488 1.5239-3.2173 2.2632-5.1604 1.9385s-3.5642-1.6641-4.2497-3.5107" stroke="#808080"/>
   <path id="azt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280 6206 7-2h3" stroke="#000" stroke-width="3"/>
   <path id="azu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6210h-3l-7-1" stroke="#000" stroke-width="3"/>
   <g id="azv" stroke="#808080">
    <path id="azw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6210h-3l-7-2"/>
    <path id="azx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6209h-3l-7-1"/>
    <path id="azy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6208h-3l-5-1"/>
   </g>
   <path id="azz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2285.4 6210.1c-1.1777 2.2432-3.7353 3.3916-6.1941 2.7818-2.4589-0.6104-4.1828-2.8213-4.1755-5.3545 0.01-2.5332 1.7444-4.7339 4.2068-5.3296s5.0132 0.5674 6.1777 2.8174" stroke="#000" stroke-width="3"/>
   <path id="baa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2285.4 6210.1c-1.1777 2.2432-3.7353 3.3916-6.1941 2.7818-2.4589-0.6104-4.1828-2.8213-4.1755-5.3545 0.01-2.5332 1.7444-4.7339 4.2068-5.3296s5.0132 0.5674 6.1777 2.8174" stroke="#000" stroke-width="2"/>
   <g id="bab" stroke="#808080">
    <path id="bac" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2277.2 6206.3c0.4365-1.1753 1.468-2.0273 2.7048-2.2339 1.2366-0.2065 2.489 0.2642 3.2837 1.2339"/>
    <path id="bad" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.3 6205.6c0.6855-1.8466 2.3069-3.186 4.25-3.5102 1.9431-0.3247 3.9116 0.415 5.1602 1.939"/>
    <path id="bae" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 6207h3"/>
    <path id="baf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280 6213v-3"/>
    <path id="bag" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280 6205v-3"/>
   </g>
   <path id="bah" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2282.2 6209.3c-1.0068 0.9248-2.5693 0.8691-3.508-0.1245-0.9388-0.9937-0.9056-2.5566 0.075-3.5093 0.98-0.9531 2.5437-0.9419 3.5102 0.025" stroke="#000" stroke-width="3"/>
   <g id="bai" stroke="#808080">
    <path id="baj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2276 6211 2-2"/>
    <path id="bak" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2279 6205-2-2"/>
    <path id="bal" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2285 6211-2-2"/>
    <path id="bam" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2282 6205 2-2"/>
   </g>
   <path id="ban" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280.9 6208.9c-0.551-0.2388-0.9065-0.7828-0.9038-1.3833 0-0.6001 0.363-1.1411 0.9158-1.375" stroke="#000" stroke-width="3"/>
   <g id="bao" stroke="#808080">
    <g id="bap" stroke-width="2">
     <path id="baq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280.8 6208.8c-0.5095-0.2515-0.833-0.769-0.8362-1.3374 0-0.5679 0.3152-1.0889 0.8218-1.3457"/>
     <path id="bar" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2281.2 6207.9c-0.147-0.095-0.2334-0.2607-0.2281-0.4355 0.01-0.1748 0.1021-0.3345 0.2547-0.4204"/>
     <path id="bas" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2281 6207"/>
    </g>
    <g id="bat">
     <path id="bau" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6204-3 1-7 1"/>
     <path id="bav" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6205h-3l-7 2"/>
     <path id="baw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6206h-3l-5 1"/>
    </g>
   </g>
   <g id="bax" stroke="#000">
    <path id="bay" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2292 6210v-6" stroke-width="2"/>
    <path id="baz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6210h2" stroke-width="3"/>
    <path id="bba" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6204h2" stroke-width="3"/>
   </g>
   <g id="bbb" stroke="#808080">
    <path id="bbc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6210h2"/>
    <path id="bbd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6209h2"/>
    <path id="bbe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6208h2"/>
    <path id="bbf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6206h2"/>
    <path id="bbg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6205h2"/>
    <path id="bbh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6204h2"/>
   </g>
   <g id="bbi" stroke="#000">
    <g id="bbj" stroke-width="3">
     <path id="bbk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6169-2-3"/>
     <path id="bbl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6172-6-6"/>
     <path id="bbm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 6174-6-6"/>
     <path id="bbn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 6174-4-3v-1"/>
     <path id="bbo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 6166h-2"/>
     <path id="bbp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6167-6 2h-2"/>
     <path id="bbq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 6170-4 1-5 1"/>
     <path id="bbr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6172h-1l-5 2"/>
     <path id="bbs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2123 6166-1 3-1 2v2"/>
     <path id="bbt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 6166-2 8"/>
     <path id="bbu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 6170"/>
     <path id="bbv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 6167-1 5-1 2"/>
     <path id="bbw" transform="matrix(0 -.16 -.16 0 342.59 598.05)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
     <path id="bbx" transform="matrix(0 -.16 -.16 0 342.59 598.05)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
     <path id="bby" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 6176v-12h12v12h-12"/>
     <path id="bbz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2219 5953v-83h10v83h-10"/>
     <path id="bca" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 5767h72v-186h-72v186"/>
    </g>
    <g id="bcb" stroke-width="2">
     <path id="bcc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5574h-141v3h141v-3"/>
     <path id="bcd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5628v-51h3v51"/>
     <path id="bce" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5630 2-2h-3"/>
     <path id="bcf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5695v7h3v-7"/>
    </g>
    <g id="bcg" stroke-width="3">
     <path id="bch" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 5891v62h3v-62h-3"/>
     <path id="bci" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2388 5891v62h3v-62h-3"/>
     <path id="bcj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2452 5869h41v3h-41v-3"/>
     <path id="bck" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2431 5789h62v-3h-62v3"/>
     <path id="bcl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 5570h145v11h-145v-11"/>
    </g>
   </g>
   <g id="bcm" stroke="#545454" stroke-width="2">
    <path id="bcn" transform="matrix(-.16 0 0 .16 345.63 681.57)" d="m4.3655-6.0986c1.304 0.93339 2.2744 2.2602 2.769 3.7856"/>
    <path id="bco" transform="matrix(-.16 0 0 .16 360.99 683.81)" d="m104.19-16.56c0.74647 4.6968 1.1745 9.4386 1.2812 14.193"/>
    <path id="bcp" transform="matrix(-.16 0 0 .16 354.43 684.13)" d="m60.894-24.129c2.5818 6.5156 4.1011 13.403 4.5 20.401"/>
    <path id="bcq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 5612h9l2 1h1l2 1 5 5 2 4v2l1 2v1l1 2v6l-1 2v2l-1 2v2l-1 2-5 5-2 1-1 1-2 1h-1l-2 1h-4l-1-1h-2"/>
    <path id="bcr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5607h5l4 2 3 1 5 5 2 3 2 4 1 3v3l1 2v6l-1 3v2l-2 6-1 2-4 4-1 2-2 1-3 2-2 1h-2l-3 1h-4l-3-1h-2l-2-1-2-2-2-1-4-4-1-2-2-2-2-6v-2l-1-3v-6l1-2v-3l1-3 1-2 2-2 1-3 2-2 2-1 2-2 6-3h5"/>
    <path id="bcs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5609h4l2 1h2l2 1 1 2 2 1 2 2 5 10v3l1 2v5l-1 2v2l-1 2-1 3-3 6-2 1-3 3-4 2h-2l-2 1h-4l-2-1h-2l-1-1-4-2-5-5-2-4-1-3-1-2v-2l-1-2v-5l1-2v-3l4-8 2-2 1-2 2-1 2-2 2-1h1l2-1h4"/>
    <path id="bct" transform="matrix(-.16 0 0 .16 344.99 683.97)" d="m-3.2813-1.2179c0.43625-1.1754 1.4678-2.0276 2.7044-2.2342 1.2366-0.20664 2.4892 0.26391 3.2839 1.2336"/>
    <path id="bcu" transform="matrix(-.16 0 0 .16 344.99 683.97)" d="m-1.6675-1.8626c0.75051-0.67189 1.8309-0.82771 2.7407-0.39528"/>
    <path id="bcv" transform="matrix(-.16 0 0 .16 345.63 686.21)" d="m7.1342 2.3137c-0.49469 1.5254-1.4653 2.8521-2.7693 3.7853"/>
    <path id="bcw" transform="matrix(-.16 0 0 .16 360.99 683.97)" d="m105.48 2.0329c-0.0939 4.8696-0.5248 9.7268-1.2898 14.537"/>
    <path id="bcx" transform="matrix(-.16 0 0 .16 343.87 683.97)" d="m2.4993-0.058c0.03203 1.3802-1.0608 2.5252-2.4411 2.5573"/>
    <path id="bcy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 5631 8 1"/>
    <path id="bcz" transform="matrix(-.16 0 0 .16 345.15 683.97)" d="m-0.19831 1.4868c-0.77291-0.10308-1.3379-0.78117-1.2999-1.56"/>
    <path id="bda" transform="matrix(-.16 0 0 .16 344.99 683.97)" d="m2.707 2.2186c-0.7947 0.96966-2.0473 1.4402-3.2839 1.2336-1.2366-0.20663-2.2682-1.0589-2.7044-2.2342"/>
    <path id="bdb" transform="matrix(-.16 0 0 .16 344.99 683.97)" d="m1.0732 2.2579c-0.90978 0.43243-1.9902 0.27661-2.7407-0.39528"/>
    <path id="bdc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2142 5635h1"/>
    <path id="bdd" transform="matrix(-.16 0 0 .16 345.63 683.97)" d="m-1.4988 0.05967c-0.03259-0.8187 0.59778-1.5121 1.4159-1.5574"/>
    <path id="bde" transform="matrix(-.16 0 0 .16 345.63 683.97)" d="m-0.08294 1.4977c-0.81809-0.04531-1.4485-0.73868-1.4159-1.5574"/>
    <path id="bdf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5632h-2"/>
    <path id="bdg" transform="matrix(-.16 0 0 .16 345.15 683.81)" d="m-0.18233 1.4889c-0.18054-0.02211-0.35556-0.07688-0.51651-0.16162"/>
    <path id="bdh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2140 5632-4-1h-3l-4-1"/>
    <path id="bdi" transform="matrix(-.16 0 0 .16 343.39 683.97)" d="m3.4998-0.0396c0.02184 1.9309-1.5243 3.5147-3.4552 3.5393"/>
    <path id="bdj" transform="matrix(-.16 0 0 .16 343.39 683.97)" d="m0.04496-3.4997c1.9309 0.02481 3.4768 1.6087 3.4548 3.5396"/>
    <path id="bdk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 5636h7l4-1"/>
    <path id="bdl" transform="matrix(-.16 0 0 .16 345.15 683.97)" d="m-0.69884-1.3273c0.16095-0.08474 0.33597-0.13951 0.51651-0.16162"/>
    <path id="bdm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2141 5635h1"/>
    <path id="bdn" transform="matrix(-.16 0 0 .16 343.87 683.97)" d="m-0.37441-2.4718c0.72566-0.10992 1.463 0.10458 2.0164 0.58663 0.55344 0.48204 0.8671 1.1829 0.85781 1.9168"/>
    <path id="bdo" transform="matrix(-.16 0 0 .16 343.87 683.97)" d="m2.4998-0.0314c0.00922 0.73384-0.30447 1.4347-0.8579 1.9166s-1.2907 0.69647-2.0163 0.58655"/>
    <path id="bdp" transform="matrix(-.16 0 0 .16 343.87 683.97)" d="m0.05848-2.4993c1.3802 0.0323 2.473 1.1773 2.4408 2.5576"/>
    <path id="bdq" transform="matrix(-.16 0 0 .16 345.47 683.97)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
    <path id="bdr" transform="matrix(-.16 0 0 .16 345.47 683.97)" d="m-0.98107 1.1347c-0.34892-0.30169-0.53964-0.74714-0.51714-1.2079"/>
    <path id="bds" transform="matrix(-.16 0 0 .16 345.47 683.97)" d="m-0.19831 1.4868c-0.28965-0.03863-0.56171-0.16102-0.78276-0.35214"/>
    <path id="bdt" transform="matrix(-.16 0 0 .16 345.15 683.81)" d="m-0.69884 1.3273c-0.43508-0.22908-0.73027-0.65686-0.79004-1.1449"/>
    <path id="bdu" transform="matrix(-.16 0 0 .16 345.15 683.97)" d="m-1.4889-0.18233c0.05977-0.48807 0.35496-0.91585 0.79004-1.1449"/>
    <path id="bdv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 5636 8-1"/>
    <path id="bdw" transform="matrix(-.16 0 0 .16 345.15 683.97)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
    <path id="bdx" transform="matrix(-.16 0 0 .16 343.23 683.97)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
    <path id="bdy" transform="matrix(-.16 0 0 .16 343.23 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bdz" transform="matrix(-.16 0 0 .16 344.19 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bea" transform="matrix(-.16 0 0 .16 344.19 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="beb" transform="matrix(-.16 0 0 .16 354.43 683.81)" d="m65.412 3.3895c-0.36868 7.1149-1.8957 14.122-4.5208 20.745"/>
    <path id="bec" transform="matrix(-.16 0 0 .16 345.63 668.93)" d="m4.3655-6.0986c1.304 0.93339 2.2744 2.2602 2.769 3.7856"/>
    <path id="bed" transform="matrix(-.16 0 0 .16 360.99 671.17)" d="m104.19-16.56c0.74647 4.6968 1.1745 9.4386 1.2812 14.193"/>
    <path id="bee" transform="matrix(-.16 0 0 .16 354.43 671.33)" d="m60.894-24.129c2.5818 6.5156 4.1011 13.403 4.5 20.401"/>
    <path id="bef" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 5692h2l1-1h5l1 1h2l1 1 2 1 5 5 2 4v1l1 2v2l1 2v6l-1 2v2l-1 2v2l-1 1-1 2-4 4-2 1-1 1-2 1h-3l-1 1h-1l-2-1h-3"/>
    <path id="beg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5686h2l3 1 4 2 3 1 2 1 1 2 4 4 1 3 1 2 1 3v2l1 3v6l-1 2v3l-1 3-1 2-1 3-4 4-1 2-2 1-3 1-4 2h-3l-2 1-2-1h-3l-8-4-4-4-1-2-2-3-1-2-1-3v-3l-1-2v-6l1-3v-2l1-3 1-2 2-3 1-2 4-4 8-4 3-1h2"/>
    <path id="beh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5688h2l2 1h2l4 2 3 3 2 1 2 4 1 3 2 4v2l1 3v4l-1 3v2l-2 4-1 3-1 2-6 6-4 2h-4l-2 1-2-1h-4l-1-1-4-2-2-2-1-2-2-1-1-2-1-3-2-4v-2l-1-3v-4l1-3v-2l2-4 1-3 1-2 5-5 4-2 1-1h2l2-1h2"/>
    <path id="bei" transform="matrix(-.16 0 0 .16 344.99 671.17)" d="m-3.2813-1.2179c0.43625-1.1754 1.4678-2.0276 2.7044-2.2342 1.2366-0.20664 2.4892 0.26391 3.2839 1.2336"/>
    <path id="bej" transform="matrix(-.16 0 0 .16 344.99 671.17)" d="m-1.6675-1.8626c0.75051-0.67189 1.8309-0.82771 2.7407-0.39528"/>
    <path id="bek" transform="matrix(-.16 0 0 .16 345.63 673.57)" d="m7.1342 2.3137c-0.49469 1.5254-1.4653 2.8521-2.7693 3.7853"/>
    <path id="bel" transform="matrix(-.16 0 0 .16 360.99 671.17)" d="m105.48 2.0329c-0.0939 4.8696-0.5248 9.7268-1.2898 14.537"/>
    <path id="bem" transform="matrix(-.16 0 0 .16 343.87 671.17)" d="m2.4993-0.058c0.03203 1.3802-1.0608 2.5252-2.4411 2.5573"/>
    <path id="ben" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 5711 8 1"/>
    <path id="beo" transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-0.19831 1.4868c-0.77291-0.10308-1.3379-0.78117-1.2999-1.56"/>
    <path id="bep" transform="matrix(-.16 0 0 .16 344.99 671.17)" d="m2.707 2.2186c-0.7947 0.96966-2.0473 1.4402-3.2839 1.2336-1.2366-0.20663-2.2682-1.0589-2.7044-2.2342"/>
    <path id="beq" transform="matrix(-.16 0 0 .16 344.99 671.17)" d="m1.0732 2.2579c-0.90978 0.43243-1.9902 0.27661-2.7407-0.39528"/>
    <path id="ber" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2142 5714h1"/>
    <path id="bes" transform="matrix(-.16 0 0 .16 345.63 671.17)" d="m-1.4988 0.05967c-0.03259-0.8187 0.59778-1.5121 1.4159-1.5574"/>
    <path id="bet" transform="matrix(-.16 0 0 .16 345.63 671.17)" d="m-0.08294 1.4977c-0.81809-0.04531-1.4485-0.73868-1.4159-1.5574"/>
    <path id="beu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5712h-2"/>
    <path id="bev" transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-0.18233 1.4889c-0.18054-0.02211-0.35556-0.07688-0.51651-0.16162"/>
    <path id="bew" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2140 5711h-4l-3-1h-4"/>
    <path id="bex" transform="matrix(-.16 0 0 .16 343.39 671.17)" d="m3.4998-0.0396c0.02184 1.9309-1.5243 3.5147-3.4552 3.5393"/>
    <path id="bey" transform="matrix(-.16 0 0 .16 343.39 671.17)" d="m0.04496-3.4997c1.9309 0.02481 3.4768 1.6087 3.4548 3.5396"/>
    <path id="bez" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 5716h4l3-1h4"/>
    <path id="bfa" transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-0.69884-1.3273c0.16095-0.08474 0.33597-0.13951 0.51651-0.16162"/>
    <path id="bfb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2141 5715 1-1"/>
    <path id="bfc" transform="matrix(-.16 0 0 .16 343.87 671.17)" d="m-0.37441-2.4718c0.72566-0.10992 1.463 0.10458 2.0164 0.58663 0.55344 0.48204 0.8671 1.1829 0.85781 1.9168"/>
    <path id="bfd" transform="matrix(-.16 0 0 .16 343.87 671.17)" d="m2.4998-0.0314c0.00922 0.73384-0.30447 1.4347-0.8579 1.9166s-1.2907 0.69647-2.0163 0.58655"/>
    <path id="bfe" transform="matrix(-.16 0 0 .16 343.87 671.17)" d="m0.05848-2.4993c1.3802 0.0323 2.473 1.1773 2.4408 2.5576"/>
    <path id="bff" transform="matrix(-.16 0 0 .16 345.47 671.17)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
    <path id="bfg" transform="matrix(-.16 0 0 .16 345.47 671.17)" d="m-0.98107 1.1347c-0.34892-0.30169-0.53964-0.74714-0.51714-1.2079"/>
    <path id="bfh" transform="matrix(-.16 0 0 .16 345.47 671.17)" d="m-0.19831 1.4868c-0.28965-0.03863-0.56171-0.16102-0.78276-0.35214"/>
    <path id="bfi" transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-0.69884 1.3273c-0.43508-0.22908-0.73027-0.65686-0.79004-1.1449"/>
    <path id="bfj" transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-1.4889-0.18233c0.05977-0.48807 0.35496-0.91585 0.79004-1.1449"/>
    <path id="bfk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 5715 8-1"/>
    <path id="bfl" transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
    <path id="bfm" transform="matrix(-.16 0 0 .16 343.23 671.17)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
    <path id="bfn" transform="matrix(-.16 0 0 .16 343.23 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bfo" transform="matrix(-.16 0 0 .16 344.19 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bfp" transform="matrix(-.16 0 0 .16 344.19 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bfq" transform="matrix(-.16 0 0 .16 354.43 671.01)" d="m65.412 3.3895c-0.36868 7.1149-1.8957 14.122-4.5208 20.745"/>
   </g>
   <g id="bfr" stroke="#000">
    <g id="bfs">
     <path id="bft" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2389 5964v5"/>
     <path id="bfu" transform="matrix(0 -.16 -.16 0 385.79 630.21)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5"/>
     <path id="bfv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2394 5974h83"/>
     <path id="bfw" transform="matrix(0 -.16 -.16 0 399.07 628.61)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5"/>
     <path id="bfx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5979v83"/>
     <path id="bfy" transform="matrix(0 -.16 -.16 0 400.67 615.33)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5"/>
     <path id="bfz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 6067h6"/>
     <path id="bga" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2393 5964v5"/>
     <path id="bgb" transform="matrix(0 -.16 -.16 0 385.79 630.21)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5"/>
     <path id="bgc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2394 5970h83"/>
     <path id="bgd" transform="matrix(0 -.16 -.16 0 399.07 628.61)" d="m-9.5 0c0-5.2467 4.2533-9.5 9.5-9.5"/>
     <path id="bge" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5979v83"/>
     <path id="bgf" transform="matrix(0 -.16 -.16 0 400.67 615.33)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5"/>
     <path id="bgg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 6063h6"/>
    </g>
    <g id="bgh" stroke-width="2">
     <path id="bgi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5704h-141v-2h141v2"/>
     <path id="bgj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2248 5565v5h-3v-5"/>
     <path id="bgk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2247 5563-2 2h3"/>
    </g>
    <path id="bgl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2248 5493h-3" stroke-width="3"/>
    <path id="bgm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5565v9h3v-9" stroke-width="2"/>
    <path id="bgn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5563 2 2h-3" stroke-width="2"/>
    <g id="bgo" stroke-width="3">
     <path id="bgp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2241 5445v48h11v-48"/>
     <path id="bgq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2358 5450v43h-10v-42"/>
     <path id="bgr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5450v32h-96v11h96v-11"/>
    </g>
    <path id="bgs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2248 5493v5h-3v-5h3" stroke-width="2"/>
    <path id="bgt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5493v5h3v-5h-3" stroke-width="2"/>
    <g id="bgu" stroke-width="3">
     <path id="bgv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 7352h-103v-104h103v104"/>
     <path id="bgw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 7248h-103v-103h103v103"/>
     <path id="bgx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 7145h-103v-104h103v104"/>
     <path id="bgy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 7041h-103v-104h103v104"/>
     <path id="bgz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6937h-103v-103h103v103"/>
     <path id="bha" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6834h-103v-104h103v104"/>
     <path id="bhb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7352h-103v-104h103v104"/>
     <path id="bhc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7248h-103v-103h103v103"/>
     <path id="bhd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7145h-103v-104h103v104"/>
     <path id="bhe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7041h-103v-104h103v104"/>
     <path id="bhf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 6803h-103v-103h103v103"/>
     <path id="bhg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6730h-103v-104h103v104"/>
     <path id="bhh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 6700h-103v-104h103v104"/>
    </g>
   </g>
   <g id="bhi" stroke="#545454" stroke-width="2">
    <path id="bhj" transform="matrix(-.16 0 0 .16 815.87 537.89)" d="m-7.1342-2.3137c0.49469-1.5254 1.4653-2.8521 2.7693-3.7853"/>
    <path id="bhk" transform="matrix(-.16 0 0 .16 800.51 540.13)" d="m-105.47-2.3768c0.10713-4.7545 0.53564-9.4963 1.2826-14.193"/>
    <path id="bhl" transform="matrix(-.16 0 0 .16 807.07 540.29)" d="m-65.393-3.7344c0.39959-6.9971 1.9196-13.885 4.502-20.4"/>
    <path id="bhm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 6511h-2l-1-1h-5l-1 1h-1l-2 1-1 1-2 1-1 1-2 1-3 6v1l-1 2v2l-1 2v6l1 2v2l1 2v1l2 4 2 1 1 2 1 1 2 1 1 1 2 1h3l1 1h2l1-1h3"/>
    <path id="bhn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 6505h-2l-3 1h-2l-2 1-2 2-2 1-6 6-1 3-1 2-1 3v2l-1 3v6l1 2v3l1 3 1 2 1 3 4 4 2 1 2 2 6 3h3l2 1 2-1h3l6-3 2-2 2-1 2-2 1-2 2-3 1-2 1-3v-3l1-2v-6l-1-3v-2l-1-3-1-2-2-3-1-2-4-4-2-1-2-2-2-1h-2l-3-1h-2"/>
    <path id="bho" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 6507h-2l-2 1h-2l-2 1-1 1-2 1-2 2-2 1-3 6-1 3-1 2v2l-1 3v4l1 3v2l3 6 1 3 5 5 2 1 1 1 2 1h12l1-1 4-2 2-2 1-2 2-1 1-3 3-6v-2l1-3v-4l-1-3v-2l-1-2-1-3-2-4-5-5-4-2-1-1h-2l-2-1h-2"/>
    <path id="bhp" transform="matrix(-.16 0 0 .16 816.51 540.13)" d="m-2.7068-2.2188c0.79478-0.96959 2.0475-1.44 3.284-1.2333 1.2365 0.20675 2.268 1.0591 2.7042 2.2345"/>
    <path id="bhq" transform="matrix(-.16 0 0 .16 816.51 540.13)" d="m-1.073-2.258c0.90982-0.43234 1.9902-0.27642 2.7407 0.39554"/>
    <path id="bhr" transform="matrix(-.16 0 0 .16 815.87 542.53)" d="m-4.3649 6.099c-1.304-0.93327-2.2746-2.26-2.7693-3.7853"/>
    <path id="bhs" transform="matrix(-.16 0 0 .16 800.51 540.13)" d="m-104.19 16.57c-0.76495-4.81-1.1959-9.6673-1.2898-14.537"/>
    <path id="bht" transform="matrix(-.16 0 0 .16 817.63 540.13)" d="m-0.05824 2.4993c-1.3803-0.03216-2.4732-1.1772-2.4411-2.5576"/>
    <path id="bhu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 6530-8 1"/>
    <path id="bhv" transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m1.4982-0.07303c0.03796 0.77878-0.52705 1.4568-1.2999 1.5599"/>
    <path id="bhw" transform="matrix(-.16 0 0 .16 816.51 540.13)" d="m3.2813 1.2179c-0.43625 1.1754-1.4678 2.0276-2.7044 2.2342-1.2366 0.20664-2.4892-0.26391-3.2839-1.2336"/>
    <path id="bhx" transform="matrix(-.16 0 0 .16 816.51 540.13)" d="m1.6675 1.8626c-0.75051 0.67189-1.8309 0.82771-2.7407 0.39528"/>
    <path id="bhy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5083 6533h-1"/>
    <path id="bhz" transform="matrix(-.16 0 0 .16 815.87 540.13)" d="m0.08308-1.4977c0.81803 0.04538 1.4483 0.73873 1.4157 1.5574"/>
    <path id="bia" transform="matrix(-.16 0 0 .16 815.87 540.13)" d="m1.4988-0.05952c0.03251 0.81864-0.59785 1.5119-1.4159 1.5572"/>
    <path id="bib" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 6531h2"/>
    <path id="bic" transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m0.69884 1.3273c-0.16095 0.08474-0.33597 0.13951-0.51651 0.16162"/>
    <path id="bid" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 6530h4l4-1h3"/>
    <path id="bie" transform="matrix(-.16 0 0 .16 818.11 540.13)" d="m-0.04463 3.4997c-1.931-0.02463-3.4772-1.6086-3.4551-3.5396"/>
    <path id="bif" transform="matrix(-.16 0 0 .16 818.11 540.13)" d="m-3.4998 0.03993c-0.02203-1.931 1.5241-3.515 3.4551-3.5396"/>
    <path id="big" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 6535h-3l-4-1h-4"/>
    <path id="bih" transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m0.18247-1.4889c0.18055 0.02213 0.35556 0.07691 0.51649 0.16166"/>
    <path id="bii" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5084 6534-1-1"/>
    <path id="bij" transform="matrix(-.16 0 0 .16 817.63 540.13)" d="m-2.4998 0.0314c-0.00922-0.73388 0.30451-1.4347 0.85799-1.9167 0.55349-0.48199 1.2908-0.69643 2.0165-0.58644"/>
    <path id="bik" transform="matrix(-.16 0 0 .16 817.63 540.13)" d="m0.37441 2.4718c-0.72566 0.10992-1.463-0.10458-2.0164-0.58663-0.55344-0.48204-0.8671-1.1829-0.85781-1.9168"/>
    <path id="bil" transform="matrix(-.16 0 0 .16 817.63 540.13)" d="m-2.4993 0.05824c-0.03217-1.3803 1.0607-2.5254 2.4411-2.5576"/>
    <path id="bim" transform="matrix(-.16 0 0 .16 816.03 540.13)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
    <path id="bin" transform="matrix(-.16 0 0 .16 816.03 540.13)" d="m1.4982-0.07303c0.02246 0.46067-0.16826 0.90606-0.51715 1.2077"/>
    <path id="bio" transform="matrix(-.16 0 0 .16 816.03 540.13)" d="m0.98107 1.1347c-0.22105 0.19112-0.49311 0.31351-0.78276 0.35214"/>
    <path id="bip" transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m1.4889 0.18233c-0.05977 0.48807-0.35496 0.91585-0.79004 1.1449"/>
    <path id="biq" transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m0.69896-1.3272c0.43507 0.22913 0.73021 0.65694 0.78993 1.145"/>
    <path id="bir" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 6534-8-1"/>
    <path id="bis" transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
    <path id="bit" transform="matrix(-.16 0 0 .16 818.27 540.13)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
    <path id="biu" transform="matrix(-.16 0 0 .16 818.27 540.13)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="biv" transform="matrix(-.16 0 0 .16 817.31 540.13)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="biw" transform="matrix(-.16 0 0 .16 817.31 540.13)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bix" transform="matrix(-.16 0 0 .16 807.07 539.97)" d="m-60.891 24.135c-2.6243-6.6212-4.1512-13.626-4.5204-20.739"/>
    <path id="biy" transform="matrix(-.16 0 0 .16 815.71 552.77)" d="m-7.1342-2.3137c0.49469-1.5254 1.4653-2.8521 2.7693-3.7853"/>
    <path id="biz" transform="matrix(-.16 0 0 .16 800.35 555.01)" d="m-105.47-2.3768c0.10713-4.7545 0.53564-9.4963 1.2826-14.193"/>
    <path id="bja" transform="matrix(-.16 0 0 .16 806.91 555.17)" d="m-65.393-3.7344c0.39959-6.9971 1.9196-13.885 4.502-20.4"/>
    <path id="bjb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 6418h-2l-1-1h-5l-1 1h-2l-1 1-2 1-1 1-2 1-1 1-2 4-1 1-1 2v2l-1 2v10l1 2v2l1 1 2 4 5 5 2 1h1l2 1h9"/>
    <path id="bjc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5081 6412h-3l-2 1h-2l-3 1-2 2-2 1-2 2-1 2-2 2-1 2-2 6-1 2v11l2 6 2 4 2 3 1 2 2 1 2 2 2 1 3 1 2 1h9l3-1 4-2 2-2 2-1 2-2 1-3 2-4 2-6v-11l-1-2-2-6-2-4-4-4-2-1-2-2-2-1h-3l-2-1h-2"/>
    <path id="bjd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5081 6414h-2l-2 1h-2l-6 3-1 2-2 1-1 2-2 2-1 2-1 3v2l-1 2v9l1 3v2l2 4 2 2 1 2 5 5 2 1h2l2 1h7l2-1h2l2-1 2-2 2-1 1-2 2-2 3-6v-2l1-3v-9l-1-2v-2l-1-3-2-4-5-5-6-3h-2l-2-1h-1"/>
    <path id="bje" transform="matrix(-.16 0 0 .16 816.35 555.01)" d="m-2.7068-2.2188c0.79478-0.96959 2.0475-1.44 3.284-1.2333 1.2365 0.20675 2.268 1.0591 2.7042 2.2345"/>
    <path id="bjf" transform="matrix(-.16 0 0 .16 816.35 555.01)" d="m-1.073-2.258c0.90982-0.43234 1.9902-0.27642 2.7407 0.39554"/>
    <path id="bjg" transform="matrix(-.16 0 0 .16 815.71 557.41)" d="m-4.3649 6.099c-1.304-0.93327-2.2746-2.26-2.7693-3.7853"/>
    <path id="bjh" transform="matrix(-.16 0 0 .16 800.35 555.17)" d="m-104.19 16.57c-0.76495-4.81-1.1959-9.6673-1.2898-14.537"/>
    <path id="bji" transform="matrix(-.16 0 0 .16 817.31 555.01)" d="m-0.05824 2.4993c-1.3803-0.03216-2.4732-1.1772-2.4411-2.5576"/>
    <path id="bjj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 6437-7 1"/>
    <path id="bjk" transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m1.4982-0.07303c0.03796 0.77878-0.52705 1.4568-1.2999 1.5599"/>
    <path id="bjl" transform="matrix(-.16 0 0 .16 816.35 555.01)" d="m3.2813 1.2179c-0.43625 1.1754-1.4678 2.0276-2.7044 2.2342-1.2366 0.20664-2.4892-0.26391-3.2839-1.2336"/>
    <path id="bjm" transform="matrix(-.16 0 0 .16 816.35 555.01)" d="m1.6675 1.8626c-0.75051 0.67189-1.8309 0.82771-2.7407 0.39528"/>
    <path id="bjn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 6440h-1"/>
    <path id="bjo" transform="matrix(-.16 0 0 .16 815.71 555.01)" d="m0.08308-1.4977c0.81803 0.04538 1.4483 0.73873 1.4157 1.5574"/>
    <path id="bjp" transform="matrix(-.16 0 0 .16 815.71 555.01)" d="m1.4988-0.05952c0.03251 0.81864-0.59785 1.5119-1.4159 1.5572"/>
    <path id="bjq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5081 6438h1l1-1"/>
    <path id="bjr" transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m0.69884 1.3273c-0.16095 0.08474-0.33597 0.13951-0.51651 0.16162"/>
    <path id="bjs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5083 6437h5l3-1h3"/>
    <path id="bjt" transform="matrix(-.16 0 0 .16 817.79 555.01)" d="m-0.04463 3.4997c-1.931-0.02463-3.4772-1.6086-3.4551-3.5396"/>
    <path id="bju" transform="matrix(-.16 0 0 .16 817.79 555.01)" d="m-3.4998 0.03993c-0.02203-1.931 1.5241-3.515 3.4551-3.5396"/>
    <path id="bjv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5094 6442h-3l-3-1h-5"/>
    <path id="bjw" transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m0.18247-1.4889c0.18055 0.02213 0.35556 0.07691 0.51649 0.16166"/>
    <path id="bjx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5083 6440h-1"/>
    <path id="bjy" transform="matrix(-.16 0 0 .16 817.47 555.01)" d="m-2.4998 0.0314c-0.00922-0.73388 0.30451-1.4347 0.85799-1.9167 0.55349-0.48199 1.2908-0.69643 2.0165-0.58644"/>
    <path id="bjz" transform="matrix(-.16 0 0 .16 817.47 555.01)" d="m0.37441 2.4718c-0.72566 0.10992-1.463-0.10458-2.0164-0.58663-0.55344-0.48204-0.8671-1.1829-0.85781-1.9168"/>
    <path id="bka" transform="matrix(-.16 0 0 .16 817.31 555.01)" d="m-2.4993 0.05824c-0.03217-1.3803 1.0607-2.5254 2.4411-2.5576"/>
    <path id="bkb" transform="matrix(-.16 0 0 .16 815.87 555.01)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
    <path id="bkc" transform="matrix(-.16 0 0 .16 815.87 555.01)" d="m1.4982-0.07303c0.02246 0.46067-0.16826 0.90606-0.51715 1.2077"/>
    <path id="bkd" transform="matrix(-.16 0 0 .16 815.87 555.01)" d="m0.98107 1.1347c-0.22105 0.19112-0.49311 0.31351-0.78276 0.35214"/>
    <path id="bke" transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m1.4889 0.18233c-0.05977 0.48807-0.35496 0.91585-0.79004 1.1449"/>
    <path id="bkf" transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m0.69896-1.3272c0.43507 0.22913 0.73021 0.65694 0.78993 1.145"/>
    <path id="bkg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 6441-7-1"/>
    <path id="bkh" transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
    <path id="bki" transform="matrix(-.16 0 0 .16 818.11 555.01)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
    <path id="bkj" transform="matrix(-.16 0 0 .16 818.11 555.01)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bkk" transform="matrix(-.16 0 0 .16 817.15 555.01)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bkl" transform="matrix(-.16 0 0 .16 817.15 555.01)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bkm" transform="matrix(-.16 0 0 .16 806.91 554.85)" d="m-60.891 24.135c-2.6243-6.6212-4.1512-13.626-4.5204-20.739"/>
   </g>
   <g id="bkn" stroke="#000" stroke-width="2">
    <path id="bko" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6578v-210h-62v228h55"/>
    <path id="bkp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6358h-124v10h124"/>
    <path id="bkq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4928 6264h71v11h-138"/>
    <path id="bkr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 6264h56"/>
    <path id="bks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4928 6264v-114"/>
    <path id="bkt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4917 6150v114"/>
   </g>
   <path id="bku" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4909.2 6209.7c-0.7949 0.9693-2.0473 1.44-3.2837 1.2334-1.2368-0.2065-2.2685-1.059-2.7046-2.2343" stroke="#808080"/>
   <path id="bkv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4910.8 6211c-1.249 1.5239-3.2173 2.2632-5.1606 1.9385-1.9429-0.3247-3.564-1.6641-4.2496-3.5107" stroke="#808080"/>
   <path id="bkw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4905 6206 7-2h3" stroke="#000" stroke-width="3"/>
   <path id="bkx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6210h-3l-7-1" stroke="#000" stroke-width="3"/>
   <g id="bky" stroke="#808080">
    <path id="bkz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6210h-3l-7-2"/>
    <path id="bla" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6209h-3l-6-1"/>
    <path id="blb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6208h-3l-5-1"/>
   </g>
   <path id="blc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4911.4 6210.1c-1.1777 2.2432-3.7353 3.3916-6.1943 2.7818-2.4585-0.6104-4.1826-2.8213-4.1753-5.3545 0.01-2.5332 1.7441-4.7339 4.2065-5.3296s5.0132 0.5674 6.1778 2.8174" stroke="#000" stroke-width="3"/>
   <path id="bld" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4911.4 6210.1c-1.1777 2.2432-3.7353 3.3916-6.1943 2.7818-2.4585-0.6104-4.1826-2.8213-4.1753-5.3545 0.01-2.5332 1.7441-4.7339 4.2065-5.3296s5.0132 0.5674 6.1778 2.8174" stroke="#000" stroke-width="2"/>
   <g id="ble" stroke="#808080">
    <path id="blf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4903.2 6206.3c0.4366-1.1753 1.4683-2.0273 2.7046-2.2339 1.2369-0.2065 2.4893 0.2642 3.2837 1.2339"/>
    <path id="blg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4901.3 6205.6c0.6861-1.8466 2.3072-3.186 4.2505-3.5102 1.9429-0.3247 3.9112 0.415 5.1602 1.939"/>
    <path id="blh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4900 6207h3"/>
    <path id="bli" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4906 6213v-3"/>
    <path id="blj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4906 6205v-3"/>
   </g>
   <path id="blk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4908.2 6209.3c-1.0068 0.9248-2.5693 0.8691-3.5083-0.1245-0.9385-0.9937-0.9053-2.5566 0.075-3.5093 0.9805-0.9531 2.544-0.9419 3.5103 0.025" stroke="#000" stroke-width="3"/>
   <g id="bll" stroke="#808080">
    <path id="blm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4902 6211 2-2"/>
    <path id="bln" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4904 6205-2-2"/>
    <path id="blo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4910 6211-2-2"/>
    <path id="blp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4907 6205 2-2"/>
   </g>
   <path id="blq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4905.9 6208.9c-0.5508-0.2388-0.9062-0.7828-0.9038-1.3833 0-0.6001 0.3628-1.1411 0.916-1.375" stroke="#000" stroke-width="3"/>
   <g id="blr" stroke="#808080">
    <g id="bls" stroke-width="2">
     <path id="blt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4905.8 6208.8c-0.5092-0.2515-0.833-0.769-0.8359-1.3374 0-0.5679 0.3149-1.0889 0.8218-1.3457"/>
     <path id="blu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4906.2 6207.9c-0.147-0.095-0.2334-0.2607-0.228-0.4355 0.01-0.1748 0.1025-0.3345 0.2549-0.4204"/>
     <path id="blv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4906 6207"/>
    </g>
    <g id="blw">
     <path id="blx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6204-3 1-7 1"/>
     <path id="bly" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6205h-3l-6 2"/>
     <path id="blz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6206h-3l-5 1"/>
    </g>
   </g>
   <g id="bma" stroke="#000">
    <path id="bmb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4917 6210v-6" stroke-width="2"/>
    <path id="bmc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6210h2" stroke-width="3"/>
    <path id="bmd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6204h2" stroke-width="3"/>
   </g>
   <g id="bme" stroke="#808080">
    <path id="bmf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6210h2"/>
    <path id="bmg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6209h2"/>
    <path id="bmh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6208h2"/>
    <path id="bmi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6206h2"/>
    <path id="bmj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6205h2"/>
    <path id="bmk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6204h2"/>
   </g>
   <g id="bml" stroke="#000">
    <g id="bmm">
     <path id="bmn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 6169-3-2"/>
     <path id="bmo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 6173-3-4-3-2"/>
     <path id="bmp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4750 6174-4-3-2-2v-1"/>
     <path id="bmq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 6175-4-4"/>
     <path id="bmr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 6166-2 1"/>
     <path id="bms" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 6168-3 1h-3l-2 1"/>
     <path id="bmt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 6170-4 1-5 1"/>
     <path id="bmu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 6173h-1l-5 1"/>
     <path id="bmv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 6167-2 4v2"/>
     <path id="bmw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 6166-1 4v1l-1 4"/>
     <path id="bmx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4750 6167-1 5-1 3"/>
    </g>
    <g id="bmy" stroke-width="2">
     <path id="bmz" transform="matrix(0 -.16 -.16 0 762.27 597.89)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
     <path id="bna" transform="matrix(0 -.16 -.16 0 762.27 597.89)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
     <path id="bnb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 6176v-11h12v11h-12"/>
    </g>
   </g>
   <path id="bnc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942.8 6208.7c-0.436 1.1753-1.4677 2.0278-2.7045 2.2343-1.2364 0.2066-2.4888-0.2641-3.2837-1.2334" stroke="#808080"/>
   <path id="bnd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4944.7 6209.4c-0.6856 1.8466-2.3067 3.186-4.2496 3.5107-1.9433 0.3247-3.9116-0.4146-5.1606-1.9385" stroke="#808080"/>
   <path id="bne" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940 6206-7-2h-3" stroke="#000" stroke-width="3"/>
   <path id="bnf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6210h3l7-1" stroke="#000" stroke-width="3"/>
   <g id="bng" stroke="#808080">
    <path id="bnh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6210h3l7-2"/>
    <path id="bni" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6209h3l6-1"/>
    <path id="bnj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6208h3l5-1"/>
   </g>
   <path id="bnk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934.6 6205c1.1651-2.2495 3.7158-3.4126 6.1782-2.8169 2.462 0.5962 4.1988 2.7969 4.2061 5.3301 0.01 2.5337-1.7173 4.7441-4.1758 5.354-2.459 0.6098-5.0166-0.5391-6.1938-2.7823" stroke="#000" stroke-width="3"/>
   <path id="bnl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934.6 6205c1.1651-2.2495 3.7158-3.4126 6.1782-2.8169 2.462 0.5962 4.1988 2.7969 4.2061 5.3301 0.01 2.5337-1.7173 4.7441-4.1758 5.354-2.459 0.6098-5.0166-0.5391-6.1938-2.7823" stroke="#000" stroke-width="2"/>
   <g id="bnm" stroke="#808080">
    <path id="bnn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4936.8 6205.3c0.7949-0.9692 2.0473-1.4399 3.2837-1.2334 1.2368 0.2066 2.2685 1.0591 2.7045 2.2344"/>
    <path id="bno" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.2 6204c1.249-1.524 3.2173-2.2632 5.1606-1.9385 1.9429 0.3247 3.564 1.6641 4.2496 3.5107"/>
    <path id="bnp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4945 6207h-3"/>
    <path id="bnq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 6213v-3"/>
    <path id="bnr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 6205v-3"/>
   </g>
   <path id="bns" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937.7 6205.7c0.9668-0.9663 2.5303-0.977 3.5103-0.024 0.98 0.9527 1.0132 2.5161 0.074 3.5098-0.9385 0.9931-2.5015 1.0483-3.5078 0.124" stroke="#000" stroke-width="3"/>
   <g id="bnt" stroke="#808080">
    <path id="bnu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4944 6211-3-2"/>
    <path id="bnv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 6205 2-2"/>
    <path id="bnw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 6211 2-2"/>
    <path id="bnx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 6205-2-2"/>
   </g>
   <path id="bny" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940.1 6206.1c0.5527 0.2335 0.9131 0.7745 0.9155 1.375 0 0.6001-0.353 1.1441-0.9038 1.3829" stroke="#000" stroke-width="3"/>
   <g id="bnz" stroke="#808080">
    <g id="boa" stroke-width="2">
     <path id="bob" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940.2 6206.2c0.5069 0.2568 0.8247 0.7778 0.8218 1.3462 0 0.5679-0.3267 1.0854-0.8359 1.3369"/>
     <path id="boc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939.7 6207.1c0.1528 0.086 0.249 0.2456 0.2549 0.4204 0.01 0.1748-0.081 0.3403-0.228 0.4355"/>
     <path id="bod" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 6207"/>
    </g>
    <g id="boe">
     <path id="bof" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6204 3 1 7 1"/>
     <path id="bog" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6205h3l6 2"/>
     <path id="boh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6206h3l5 1"/>
    </g>
   </g>
   <g id="boi" stroke="#000">
    <path id="boj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4928 6210v-6" stroke-width="2"/>
    <path id="bok" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6210h-2" stroke-width="3"/>
    <path id="bol" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6204h-2" stroke-width="3"/>
   </g>
   <g id="bom" stroke="#808080">
    <path id="bon" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6210h-2"/>
    <path id="boo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6209h-2"/>
    <path id="bop" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6208h-2"/>
    <path id="boq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6206h-2"/>
    <path id="bor" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6205h-2"/>
    <path id="bos" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6204h-2"/>
   </g>
   <g id="bot" stroke="#000">
    <g id="bou">
     <path id="bov" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 6174 4-4"/>
     <path id="bow" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 6174 6-6"/>
     <path id="box" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092 6172 3-3 2-3"/>
     <path id="boy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 6169 3-3"/>
     <path id="boz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092 6172h1l5 2"/>
     <path id="bpa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 6170 4 1 5 1"/>
     <path id="bpb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092 6167 6 2h2"/>
     <path id="bpc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 6166h3"/>
     <path id="bpd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 6167 1 5 1 2"/>
     <path id="bpe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 6166 2 8"/>
     <path id="bpf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 6170"/>
     <path id="bpg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 6166 1 3 1 2v2"/>
    </g>
    <g id="bph" stroke-width="2">
     <path id="bpi" transform="matrix(0 -.16 -.16 0 818.11 598.05)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
     <path id="bpj" transform="matrix(0 -.16 -.16 0 818.11 598.05)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
     <path id="bpk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5101 6176v-12h-11v12h11"/>
     <path id="bpl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4846 6275v-11h15"/>
    </g>
    <path id="bpm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 6275h-15" stroke-width="3"/>
    <path id="bpn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4994 5953v-83h-11v83h11" stroke-width="2"/>
    <path id="bpo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5767h-72v-186h72v186" stroke-width="3"/>
    <g id="bpp" stroke-width="2">
     <path id="bpq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5574h141v3h-141v-3"/>
     <path id="bpr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5603v-26h-3v26"/>
     <path id="bps" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5605-2-2h3"/>
    </g>
    <path id="bpt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5670h-3" stroke-width="3"/>
    <g id="bpu" stroke-width="2">
     <path id="bpv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5670v32h-3v-32"/>
     <path id="bpw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 5891v62h-3v-62h3"/>
     <path id="bpx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4832 5891v62h-3v-62h3"/>
     <path id="bpy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4768 5869h-41v3h41v-3"/>
     <path id="bpz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4789 5789h-62v-3h62v3"/>
    </g>
    <path id="bqa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5570h-145v11h145v-11" stroke-width="3"/>
   </g>
   <g id="bqb" stroke="#545454" stroke-width="2">
    <path id="bqc" transform="matrix(-.16 0 0 .16 815.07 681.57)" d="m-7.1342-2.3137c0.49469-1.5254 1.4653-2.8521 2.7693-3.7853"/>
    <path id="bqd" transform="matrix(-.16 0 0 .16 799.71 683.81)" d="m-105.47-2.3768c0.10713-4.7545 0.53564-9.4963 1.2826-14.193"/>
    <path id="bqe" transform="matrix(-.16 0 0 .16 806.27 684.13)" d="m-65.393-3.7344c0.39959-6.9971 1.9196-13.885 4.502-20.4"/>
    <path id="bqf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 5612h-9l-2 1h-1l-2 1-5 5-3 6v2l-1 1v10l1 2v2l2 4 1 1 1 2 2 1 1 1 2 1 1 1 2 1h1l1 1h5l1-1h2"/>
    <path id="bqg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5607h-5l-2 1-3 1-2 1-2 2-2 1-1 2-2 3-2 4-2 6v11l1 2 2 6 1 2 2 2 1 2 2 2 2 1 2 2 3 1h2l2 1h5l2-1h3l2-1 2-2 2-1 4-4 1-2 2-2 1-3v-3l1-2v-3l1-3-1-3v-2l-1-3v-3l-1-2-2-2-1-3-2-2-2-1-2-2-4-2-3-1h-4"/>
    <path id="bqh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5609h-4l-2 1h-2l-2 1-1 2-2 1-2 2-1 2-2 2-1 2v2l-1 2-1 3v9l2 4v3l1 2 2 2 1 2 2 1 3 3 4 2h2l2 1h4l1-1h2l6-3 5-5 2-4 1-3 1-2v-14l-4-8-2-2-1-2-2-1-2-2-2-1h-2l-2-1h-3"/>
    <path id="bqi" transform="matrix(-.16 0 0 .16 815.71 683.97)" d="m-2.7068-2.2188c0.79478-0.96959 2.0475-1.44 3.284-1.2333 1.2365 0.20675 2.268 1.0591 2.7042 2.2345"/>
    <path id="bqj" transform="matrix(-.16 0 0 .16 815.71 683.97)" d="m-1.073-2.258c0.90982-0.43234 1.9902-0.27642 2.7407 0.39554"/>
    <path id="bqk" transform="matrix(-.16 0 0 .16 815.07 686.21)" d="m-4.3649 6.099c-1.304-0.93327-2.2746-2.26-2.7693-3.7853"/>
    <path id="bql" transform="matrix(-.16 0 0 .16 799.71 683.97)" d="m-104.19 16.57c-0.76495-4.81-1.1959-9.6673-1.2898-14.537"/>
    <path id="bqm" transform="matrix(-.16 0 0 .16 816.67 683.97)" d="m-0.05824 2.4993c-1.3803-0.03216-2.4732-1.1772-2.4411-2.5576"/>
    <path id="bqn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 5631-8 1"/>
    <path id="bqo" transform="matrix(-.16 0 0 .16 815.55 683.97)" d="m1.4982-0.07303c0.03796 0.77878-0.52705 1.4568-1.2999 1.5599"/>
    <path id="bqp" transform="matrix(-.16 0 0 .16 815.71 683.97)" d="m3.2813 1.2179c-0.43625 1.1754-1.4678 2.0276-2.7044 2.2342-1.2366 0.20664-2.4892-0.26391-3.2839-1.2336"/>
    <path id="bqq" transform="matrix(-.16 0 0 .16 815.71 683.97)" d="m1.6675 1.8626c-0.75051 0.67189-1.8309 0.82771-2.7407 0.39528"/>
    <path id="bqr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5078 5635h-1"/>
    <path id="bqs" transform="matrix(-.16 0 0 .16 815.07 683.97)" d="m0.08308-1.4977c0.81803 0.04538 1.4483 0.73873 1.4157 1.5574"/>
    <path id="bqt" transform="matrix(-.16 0 0 .16 815.07 683.97)" d="m1.4988-0.05952c0.03251 0.81864-0.59785 1.5119-1.4159 1.5572"/>
    <path id="bqu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5632h2"/>
    <path id="bqv" transform="matrix(-.16 0 0 .16 815.55 683.81)" d="m0.69884 1.3273c-0.16095 0.08474-0.33597 0.13951-0.51651 0.16162"/>
    <path id="bqw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5080 5632 4-1h3l4-1"/>
    <path id="bqx" transform="matrix(-.16 0 0 .16 817.31 683.97)" d="m-0.04463 3.4997c-1.931-0.02463-3.4772-1.6086-3.4551-3.5396"/>
    <path id="bqy" transform="matrix(-.16 0 0 .16 817.31 683.97)" d="m-3.4998 0.03993c-0.02203-1.931 1.5241-3.515 3.4551-3.5396"/>
    <path id="bqz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 5636h-7l-4-1"/>
    <path id="bra" transform="matrix(-.16 0 0 .16 815.55 683.97)" d="m0.18247-1.4889c0.18055 0.02213 0.35556 0.07691 0.51649 0.16166"/>
    <path id="brb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5079 5635h-1"/>
    <path id="brc" transform="matrix(-.16 0 0 .16 816.83 683.97)" d="m-2.4998 0.0314c-0.00922-0.73388 0.30451-1.4347 0.85799-1.9167 0.55349-0.48199 1.2908-0.69643 2.0165-0.58644"/>
    <path id="brd" transform="matrix(-.16 0 0 .16 816.83 683.97)" d="m0.37441 2.4718c-0.72566 0.10992-1.463-0.10458-2.0164-0.58663-0.55344-0.48204-0.8671-1.1829-0.85781-1.9168"/>
    <path id="bre" transform="matrix(-.16 0 0 .16 816.67 683.97)" d="m-2.4993 0.05824c-0.03217-1.3803 1.0607-2.5254 2.4411-2.5576"/>
    <path id="brf" transform="matrix(-.16 0 0 .16 815.23 683.97)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
    <path id="brg" transform="matrix(-.16 0 0 .16 815.23 683.97)" d="m1.4982-0.07303c0.02246 0.46067-0.16826 0.90606-0.51715 1.2077"/>
    <path id="brh" transform="matrix(-.16 0 0 .16 815.23 683.97)" d="m0.98107 1.1347c-0.22105 0.19112-0.49311 0.31351-0.78276 0.35214"/>
    <path id="bri" transform="matrix(-.16 0 0 .16 815.55 683.81)" d="m1.4889 0.18233c-0.05977 0.48807-0.35496 0.91585-0.79004 1.1449"/>
    <path id="brj" transform="matrix(-.16 0 0 .16 815.55 683.97)" d="m0.69896-1.3272c0.43507 0.22913 0.73021 0.65694 0.78993 1.145"/>
    <path id="brk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 5636-8-1"/>
    <path id="brl" transform="matrix(-.16 0 0 .16 815.55 683.97)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
    <path id="brm" transform="matrix(-.16 0 0 .16 817.47 683.97)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
    <path id="brn" transform="matrix(-.16 0 0 .16 817.47 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bro" transform="matrix(-.16 0 0 .16 816.51 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="brp" transform="matrix(-.16 0 0 .16 816.51 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="brq" transform="matrix(-.16 0 0 .16 806.27 683.81)" d="m-60.891 24.135c-2.6243-6.6212-4.1512-13.626-4.5204-20.739"/>
    <path id="brr" transform="matrix(-.16 0 0 .16 815.07 668.93)" d="m-7.1342-2.3137c0.49469-1.5254 1.4653-2.8521 2.7693-3.7853"/>
    <path id="brs" transform="matrix(-.16 0 0 .16 799.71 671.17)" d="m-105.47-2.3768c0.10713-4.7545 0.53564-9.4963 1.2826-14.193"/>
    <path id="brt" transform="matrix(-.16 0 0 .16 806.27 671.33)" d="m-65.393-3.7344c0.39959-6.9971 1.9196-13.885 4.502-20.4"/>
    <path id="bru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 5692h-2l-1-1h-5l-1 1h-2l-1 1-2 1-5 5-2 4-1 1v2l-1 2v10l1 2v2l1 2 1 1 2 4 2 1 1 1 2 1 1 1 2 1h2l2 1h1l2-1h3"/>
    <path id="brv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5686h-3l-4 2-3 1-4 2-2 2-1 2-2 2-1 3-1 2-1 3-1 2v11l2 6 1 2 1 3 2 2 1 2 2 2 4 2 3 1 2 1h2l3 1 2-1h2l3-1 6-3 4-4 1-2 2-3 1-2v-3l1-3v-2l1-3-1-3v-3l-1-2v-3l-1-2-2-3-1-2-4-4-6-3-3-1-2-1h-2"/>
    <path id="brw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5688h-2l-2 1h-2l-4 2-3 3-2 1-1 2-2 2-1 3v2l-2 4v10l2 4v2l1 3 8 8 4 2h4l2 1 2-1h3l6-3 2-2 1-2 2-1 1-2 1-3 2-4v-14l-2-4-1-3-1-2-5-5-6-3h-2l-1-1h-2"/>
    <path id="brx" transform="matrix(-.16 0 0 .16 815.71 671.17)" d="m-2.7068-2.2188c0.79478-0.96959 2.0475-1.44 3.284-1.2333 1.2365 0.20675 2.268 1.0591 2.7042 2.2345"/>
    <path id="bry" transform="matrix(-.16 0 0 .16 815.71 671.17)" d="m-1.073-2.258c0.90982-0.43234 1.9902-0.27642 2.7407 0.39554"/>
    <path id="brz" transform="matrix(-.16 0 0 .16 815.07 673.57)" d="m-4.3649 6.099c-1.304-0.93327-2.2746-2.26-2.7693-3.7853"/>
    <path id="bsa" transform="matrix(-.16 0 0 .16 799.71 671.17)" d="m-104.19 16.57c-0.76495-4.81-1.1959-9.6673-1.2898-14.537"/>
    <path id="bsb" transform="matrix(-.16 0 0 .16 816.67 671.17)" d="m-0.05824 2.4993c-1.3803-0.03216-2.4732-1.1772-2.4411-2.5576"/>
    <path id="bsc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 5711-8 1"/>
    <path id="bsd" transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m1.4982-0.07303c0.03796 0.77878-0.52705 1.4568-1.2999 1.5599"/>
    <path id="bse" transform="matrix(-.16 0 0 .16 815.71 671.17)" d="m3.2813 1.2179c-0.43625 1.1754-1.4678 2.0276-2.7044 2.2342-1.2366 0.20664-2.4892-0.26391-3.2839-1.2336"/>
    <path id="bsf" transform="matrix(-.16 0 0 .16 815.71 671.17)" d="m1.6675 1.8626c-0.75051 0.67189-1.8309 0.82771-2.7407 0.39528"/>
    <path id="bsg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5078 5714h-1"/>
    <path id="bsh" transform="matrix(-.16 0 0 .16 815.07 671.17)" d="m0.08308-1.4977c0.81803 0.04538 1.4483 0.73873 1.4157 1.5574"/>
    <path id="bsi" transform="matrix(-.16 0 0 .16 815.07 671.17)" d="m1.4988-0.05952c0.03251 0.81864-0.59785 1.5119-1.4159 1.5572"/>
    <path id="bsj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5712h2"/>
    <path id="bsk" transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m0.69884 1.3273c-0.16095 0.08474-0.33597 0.13951-0.51651 0.16162"/>
    <path id="bsl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5080 5711h4l3-1h4"/>
    <path id="bsm" transform="matrix(-.16 0 0 .16 817.31 671.17)" d="m-0.04463 3.4997c-1.931-0.02463-3.4772-1.6086-3.4551-3.5396"/>
    <path id="bsn" transform="matrix(-.16 0 0 .16 817.31 671.17)" d="m-3.4998 0.03993c-0.02203-1.931 1.5241-3.515 3.4551-3.5396"/>
    <path id="bso" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 5716h-4l-3-1h-4"/>
    <path id="bsp" transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m0.18247-1.4889c0.18055 0.02213 0.35556 0.07691 0.51649 0.16166"/>
    <path id="bsq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5079 5715-1-1"/>
    <path id="bsr" transform="matrix(-.16 0 0 .16 816.83 671.17)" d="m-2.4998 0.0314c-0.00922-0.73388 0.30451-1.4347 0.85799-1.9167 0.55349-0.48199 1.2908-0.69643 2.0165-0.58644"/>
    <path id="bss" transform="matrix(-.16 0 0 .16 816.83 671.17)" d="m0.37441 2.4718c-0.72566 0.10992-1.463-0.10458-2.0164-0.58663-0.55344-0.48204-0.8671-1.1829-0.85781-1.9168"/>
    <path id="bst" transform="matrix(-.16 0 0 .16 816.67 671.17)" d="m-2.4993 0.05824c-0.03217-1.3803 1.0607-2.5254 2.4411-2.5576"/>
    <path id="bsu" transform="matrix(-.16 0 0 .16 815.23 671.17)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
    <path id="bsv" transform="matrix(-.16 0 0 .16 815.23 671.17)" d="m1.4982-0.07303c0.02246 0.46067-0.16826 0.90606-0.51715 1.2077"/>
    <path id="bsw" transform="matrix(-.16 0 0 .16 815.23 671.17)" d="m0.98107 1.1347c-0.22105 0.19112-0.49311 0.31351-0.78276 0.35214"/>
    <path id="bsx" transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m1.4889 0.18233c-0.05977 0.48807-0.35496 0.91585-0.79004 1.1449"/>
    <path id="bsy" transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m0.69896-1.3272c0.43507 0.22913 0.73021 0.65694 0.78993 1.145"/>
    <path id="bsz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 5715-8-1"/>
    <path id="bta" transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
    <path id="btb" transform="matrix(-.16 0 0 .16 817.47 671.17)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
    <path id="btc" transform="matrix(-.16 0 0 .16 817.47 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="btd" transform="matrix(-.16 0 0 .16 816.51 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bte" transform="matrix(-.16 0 0 .16 816.51 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="btf" transform="matrix(-.16 0 0 .16 806.27 671.01)" d="m-60.891 24.135c-2.6243-6.6212-4.1512-13.626-4.5204-20.739"/>
   </g>
   <g id="btg" stroke="#000">
    <g id="bth">
     <path id="bti" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4831 5964v5"/>
     <path id="btj" transform="matrix(0 -.16 -.16 0 774.91 630.21)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5"/>
     <path id="btk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4826 5974h-83"/>
     <path id="btl" transform="matrix(0 -.16 -.16 0 761.63 628.61)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5"/>
     <path id="btm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5979v83"/>
     <path id="btn" transform="matrix(0 -.16 -.16 0 760.03 615.33)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5"/>
     <path id="bto" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 6067h-6"/>
     <path id="btp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4827 5964v5"/>
     <path id="btq" transform="matrix(0 -.16 -.16 0 774.91 630.21)" d="m1.4e-4 -1.5c0.82837 8e-5 1.4999 0.67163 1.4999 1.5"/>
     <path id="btr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4826 5970h-83"/>
     <path id="bts" transform="matrix(0 -.16 -.16 0 761.63 628.61)" d="m0 9.5c-5.2467 0-9.5-4.2533-9.5-9.5"/>
     <path id="btt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5979v83"/>
     <path id="btu" transform="matrix(0 -.16 -.16 0 760.03 615.33)" d="m1.4e-4 -1.5c0.82837 8e-5 1.4999 0.67163 1.4999 1.5"/>
     <path id="btv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 6063h-6"/>
    </g>
    <g id="btw" stroke-width="2">
     <path id="btx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5704h141v-2h-141v2"/>
     <path id="bty" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4972 5565v5h3v-5"/>
     <path id="btz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4973 5563 2 2h-3"/>
    </g>
    <path id="bua" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4972 5493h3" stroke-width="3"/>
    <path id="bub" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5565v9h-3v-9" stroke-width="2"/>
    <path id="buc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5563-2 2h3" stroke-width="2"/>
    <g id="bud" stroke-width="3">
     <path id="bue" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4979 5445v48h-11v-48"/>
     <path id="buf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 5450v43h11v-42"/>
     <path id="bug" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5450v32h96v11h-96v-11"/>
    </g>
    <g id="buh" stroke-width="2">
     <path id="bui" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4972 5493v5h3v-5h-3"/>
     <path id="buj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5493v5h-3v-5h3"/>
     <path id="buk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4831 4673v5"/>
     <path id="bul" transform="matrix(0 -.16 -.16 0 774.91 836.77)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5"/>
     <path id="bum" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4826 4683h-83"/>
     <path id="bun" transform="matrix(0 -.16 -.16 0 761.63 835.17)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5"/>
     <path id="buo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 4688v83"/>
     <path id="bup" transform="matrix(0 -.16 -.16 0 760.03 821.89)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5"/>
     <path id="buq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 4776h-6"/>
     <path id="bur" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4827 4673v5"/>
     <path id="bus" transform="matrix(0 -.16 -.16 0 774.91 836.77)" d="m1.4e-4 -1.5c0.82837 8e-5 1.4999 0.67163 1.4999 1.5"/>
     <path id="but" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4826 4679h-83"/>
     <path id="buu" transform="matrix(0 -.16 -.16 0 761.63 835.17)" d="m0 9.5c-5.2467 0-9.5-4.2533-9.5-9.5"/>
     <path id="buv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 4688v83"/>
     <path id="buw" transform="matrix(0 -.16 -.16 0 760.03 821.89)" d="m1.4e-4 -1.5c0.82837 8e-5 1.4999 0.67163 1.4999 1.5"/>
     <path id="bux" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 4772h-6"/>
    </g>
    <path id="buy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6874v-71h103v134h-103v-22" stroke-width="3"/>
   </g>
   <g id="buz" stroke="#545454" stroke-width="2">
    <path id="bva" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090.9 4333.4c1.3042 0.9336 2.2744 2.2602 2.7691 3.7856"/>
    <path id="bvb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.7 4336.9c0.7466 4.6968 1.1743 9.4385 1.2812 14.193"/>
    <path id="bvc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092.4 4330.4c2.5821 6.5156 4.1016 13.404 4.5005 20.401"/>
    <path id="bvd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 4374h-1l-2 1h-3l-1-1h-3l-2-1-2-2-2-1-1-2-1-1-2-4-1-1-1-2v-12l1-2v-2l1-2 1-1 2-4 1-1 2-1 1-1 2-1 1-1h2l1-1h4l2 1h1"/>
    <path id="bve" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4380h-2l-2-1-3-1-6-3-4-4-1-2-1-3-1-2-1-3-1-2v-12l1-2 1-3 1-2 1-3 1-2 4-4 6-3 3-1 2-1h5l4 2 3 1 4 2 2 2 1 2 2 2 1 3 1 2 1 3 1 2v12l-1 2-1 3-1 2-1 3-2 2-1 2-2 2-4 2-3 1-4 2h-3"/>
    <path id="bvf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4378-1-1h-4l-6-3-5-5-1-2-1-3-2-4v-14l2-4 1-3 1-2 5-5 6-3h2l2-1h3l2 1h2l6 3 1 2 2 1 1 2 2 2 1 3 1 2v2l1 2v10l-1 2v2l-1 2-1 3-2 2-1 2-2 1-1 2-6 3h-4l-2 1"/>
    <path id="bvg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.2 4352.3c0.4361-1.1753 1.4678-2.0278 2.7046-2.2344 1.2364-0.2065 2.4888 0.2642 3.2837 1.2334"/>
    <path id="bvh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.8 4351.6c0.7505-0.6719 1.8311-0.8276 2.7407-0.395"/>
    <path id="bvi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.6 4369.8c-0.4947 1.5254-1.4654 2.852-2.7696 3.7856"/>
    <path id="bvj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 4355.5c-0.094 4.8696-0.5249 9.7271-1.2901 14.537"/>
    <path id="bvk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4353.4c0.032 1.3804-1.061 2.5254-2.4414 2.5576"/>
    <path id="bvl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4355-7-1"/>
    <path id="bvm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5089.3 4355c-0.773-0.103-1.3379-0.7812-1.2999-1.56"/>
    <path id="bvn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.2 4355.7c-0.7949 0.9693-2.0473 1.44-3.2837 1.2334-1.2368-0.2065-2.2685-1.059-2.7046-2.2343"/>
    <path id="bvo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091.6 4355.8c-0.9096 0.4326-1.9902 0.2769-2.7407-0.395"/>
    <path id="bvp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 4352"/>
    <path id="bvq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4353.6c-0.032-0.8184 0.5981-1.5122 1.416-1.5572"/>
    <path id="bvr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.4 4355c-0.8179-0.045-1.4483-0.7388-1.416-1.5572"/>
    <path id="bvs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4354h-2"/>
    <path id="bvt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.3 4355c-0.1807-0.022-0.356-0.077-0.5166-0.1617"/>
    <path id="bvu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4354 5 1 3 1h3"/>
    <path id="bvv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4353.5c0.021 1.9307-1.5244 3.5147-3.4556 3.5391"/>
    <path id="bvw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099.5 4350c1.9312 0.024 3.4771 1.6084 3.4551 3.5395"/>
    <path id="bvx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4350h-3l-3 1h-5"/>
    <path id="bvy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4352.2c0.1606-0.085 0.3359-0.1396 0.5166-0.1616"/>
    <path id="bvz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4351-2 1"/>
    <path id="bwa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.1 4351c0.7256-0.1098 1.4629 0.1045 2.0166 0.5864 0.5532 0.482 0.8672 1.1831 0.8579 1.917"/>
    <path id="bwb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4353.5c0.01 0.7339-0.3047 1.4346-0.8579 1.9165-0.5537 0.482-1.291 0.6963-2.0166 0.5865"/>
    <path id="bwc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.6 4351c1.3799 0.033 2.4726 1.1777 2.4409 2.5576"/>
    <path id="bwd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4353.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
    <path id="bwe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085.5 4354.6c-0.3491-0.3018-0.5395-0.7471-0.5171-1.208"/>
    <path id="bwf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.3 4355c-0.2896-0.039-0.5621-0.1611-0.7828-0.352"/>
    <path id="bwg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4354.8c-0.4351-0.229-0.7305-0.6567-0.7901-1.145"/>
    <path id="bwh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 4353.3c0.06-0.4883 0.355-0.916 0.7901-1.1451"/>
    <path id="bwi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4351-7 1"/>
    <path id="bwj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4353.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
    <path id="bwk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5102 4353.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
    <path id="bwl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4353.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="bwm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4353.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="bwn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4353.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="bwo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.9 4355.9c-0.3686 7.1148-1.8955 14.122-4.5205 20.745"/>
   </g>
   <g id="bwp" stroke="#000" stroke-width="3">
    <path id="bwq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4252h147v2h-147v-2"/>
    <path id="bwr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4357h147v2h-147v-2"/>
    <path id="bws" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 4346v11h-2v-11"/>
    <path id="bwt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4279v-25h2v25"/>
    <path id="bwu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 4279h3"/>
    <path id="bwv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4344-1 2h2"/>
    <path id="bww" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5695h-3"/>
   </g>
   <g id="bwx" stroke="#545454" stroke-width="2">
    <path id="bwy" transform="matrix(-.13857 .079995 .079995 .13857 408.67 360.13)" d="m4.3655-6.0986c1.304 0.93339 2.2744 2.2602 2.769 3.7856"/>
    <path id="bwz" transform="matrix(-.13857 .079995 .079995 .13857 423.23 354.37)" d="m104.19-16.56c0.74647 4.6968 1.1745 9.4386 1.2812 14.193"/>
    <path id="bxa" transform="matrix(-.13857 .079995 .079995 .13857 417.63 357.73)" d="m60.894-24.129c2.5818 6.5156 4.1011 13.403 4.5 20.401"/>
    <path id="bxb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2551 7624 1 1h2l1 1h1v1h2l1 1 1 2 2 2v2l1 2v4l1 2-1 2v4l-1 1-1 2v2l-1 2-2 1-1 2-4 4-4 2h-1l-2 1h-2l-2 1h-2l-1-1h-3l-1-1-2-1-3-3"/>
    <path id="bxc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2558 7622 2 1 5 5 1 2 1 3 1 2v3l1 2-1 3v5l-2 6-2 2-1 3-6 6-2 1-2 2-3 1-2 1h-5l-2 1-3-1h-2l-3-1-4-2-1-2-4-4-2-4v-3l-1-2v-8l2-6 1-2 1-3 1-2 8-8 3-1 4-2 3-1h7l3 1 4 2"/>
    <path id="bxd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2557 7623 2 1 1 2 4 4 1 2v3l1 2v9l-1 3v2l-2 4-2 2-1 2-5 5-6 3-3 1h-10l-4-2-1-1-2-1-1-2-1-1-4-8v-10l2-4 1-3 2-4 6-6 3-2 4-2h2l2-1h7l2 1 1 1h2"/>
    <path id="bxe" transform="matrix(-.13857 .079995 .079995 .13857 409.31 362.37)" d="m-3.2813-1.2179c0.43625-1.1754 1.4678-2.0276 2.7044-2.2342 1.2366-0.20664 2.4892 0.26391 3.2839 1.2336"/>
    <path id="bxf" transform="matrix(-.13857 .079995 .079995 .13857 409.31 362.37)" d="m-1.6675-1.8626c0.75051-0.67189 1.8309-0.82771 2.7407-0.39528"/>
    <path id="bxg" transform="matrix(-.13857 .079995 .079995 .13857 411.07 364.13)" d="m7.1342 2.3137c-0.49469 1.5254-1.4653 2.8521-2.7693 3.7853"/>
    <path id="bxh" transform="matrix(-.13857 .079995 .079995 .13857 423.23 354.53)" d="m105.48 2.0329c-0.0939 4.8696-0.5248 9.7268-1.2898 14.537"/>
    <path id="bxi" transform="matrix(-.13857 .079995 .079995 .13857 408.35 362.85)" d="m2.4993-0.058c0.03203 1.3802-1.0608 2.5252-2.4411 2.5573"/>
    <path id="bxj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2536 7638 6 4"/>
    <path id="bxk" transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.37)" d="m-0.19831 1.4868c-0.77291-0.10308-1.3379-0.78117-1.2999-1.56"/>
    <path id="bxl" transform="matrix(-.13857 .079995 .079995 .13857 409.31 362.37)" d="m2.707 2.2186c-0.7947 0.96966-2.0473 1.4402-3.2839 1.2336-1.2366-0.20663-2.2682-1.0589-2.7044-2.2342"/>
    <path id="bxm" transform="matrix(-.13857 .079995 .079995 .13857 409.31 362.37)" d="m1.0732 2.2579c-0.90978 0.43243-1.9902 0.27661-2.7407-0.39528"/>
    <path id="bxn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2543 7646h1"/>
    <path id="bxo" transform="matrix(-.13857 .079995 .079995 .13857 409.79 362.05)" d="m-1.4988 0.05967c-0.03259-0.8187 0.59778-1.5121 1.4159-1.5574"/>
    <path id="bxp" transform="matrix(-.13857 .079995 .079995 .13857 409.79 362.05)" d="m-0.08294 1.4977c-0.81809-0.04531-1.4485-0.73868-1.4159-1.5574"/>
    <path id="bxq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2545 7644-1-1h-1"/>
    <path id="bxr" transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.21)" d="m-0.18233 1.4889c-0.18054-0.02211-0.35556-0.07688-0.51651-0.16162"/>
    <path id="bxs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2543 7642-3-3-6-4"/>
    <path id="bxt" transform="matrix(-.13857 .079995 .079995 .13857 408.03 363.17)" d="m3.4998-0.0396c0.02184 1.9309-1.5243 3.5147-3.4552 3.5393"/>
    <path id="bxu" transform="matrix(-.13857 .079995 .079995 .13857 408.03 363.17)" d="m0.04496-3.4997c1.9309 0.02481 3.4768 1.6087 3.4548 3.5396"/>
    <path id="bxv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2531 7641 6 2 4 2"/>
    <path id="bxw" transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.37)" d="m-0.69884-1.3273c0.16095-0.08474 0.33597-0.13951 0.51651-0.16162"/>
    <path id="bxx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2542 7645 1 1"/>
    <path id="bxy" transform="matrix(-.13857 .079995 .079995 .13857 408.35 363.01)" d="m-0.37441-2.4718c0.72566-0.10992 1.463 0.10458 2.0164 0.58663 0.55344 0.48204 0.8671 1.1829 0.85781 1.9168"/>
    <path id="bxz" transform="matrix(-.13857 .079995 .079995 .13857 408.35 363.01)" d="m2.4998-0.0314c0.00922 0.73384-0.30447 1.4347-0.8579 1.9166s-1.2907 0.69647-2.0163 0.58655"/>
    <path id="bya" transform="matrix(-.13857 .079995 .079995 .13857 408.35 362.85)" d="m0.05848-2.4993c1.3802 0.0323 2.473 1.1773 2.4408 2.5576"/>
    <path id="byb" transform="matrix(-.13857 .079995 .079995 .13857 409.79 362.21)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
    <path id="byc" transform="matrix(-.13857 .079995 .079995 .13857 409.79 362.21)" d="m-0.98107 1.1347c-0.34892-0.30169-0.53964-0.74714-0.51714-1.2079"/>
    <path id="byd" transform="matrix(-.13857 .079995 .079995 .13857 409.79 362.21)" d="m-0.19831 1.4868c-0.28965-0.03863-0.56171-0.16102-0.78276-0.35214"/>
    <path id="bye" transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.21)" d="m-0.69884 1.3273c-0.43508-0.22908-0.73027-0.65686-0.79004-1.1449"/>
    <path id="byf" transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.37)" d="m-1.4889-0.18233c0.05977-0.48807 0.35496-0.91585 0.79004-1.1449"/>
    <path id="byg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2534 7642 7 2"/>
    <path id="byh" transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.37)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
    <path id="byi" transform="matrix(-.13857 .079995 .079995 .13857 407.71 363.33)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
    <path id="byj" transform="matrix(-.13857 .079995 .079995 .13857 407.71 363.33)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="byk" transform="matrix(-.13857 .079995 .079995 .13857 408.51 362.85)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="byl" transform="matrix(-.13857 .079995 .079995 .13857 408.51 362.85)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bym" transform="matrix(-.13857 .079995 .079995 .13857 417.47 357.57)" d="m65.412 3.3895c-0.36868 7.1149-1.8957 14.122-4.5208 20.745"/>
    <path id="byn" transform="matrix(-.13857 -.079995 -.079995 .13857 753.15 356.29)" d="m-7.1342-2.3137c0.49469-1.5254 1.4653-2.8521 2.7693-3.7853"/>
    <path id="byo" transform="matrix(-.13857 -.079995 -.079995 .13857 738.75 350.53)" d="m-105.47-2.3768c0.10713-4.7545 0.53564-9.4963 1.2826-14.193"/>
    <path id="byp" transform="matrix(-.13857 -.079995 -.079995 .13857 744.35 353.89)" d="m-65.393-3.7344c0.39959-6.9971 1.9196-13.885 4.502-20.4"/>
    <path id="byq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4677 7649h-4l-6 6-1 2-1 1-1 2v10l1 2v2l1 1 3 6 5 5 6 3h2l1 1h5l2-1h1l2-1h1l3-3"/>
    <path id="byr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4669 7646-2 1-2 2-1 2-2 2-2 4-1 3v10l1 3v2l2 3 1 2 1 3 8 8 2 1 3 1 2 1h3l2 1h5l3-1 6-3 5-5 1-3 2-4v-14l-1-2-1-3-2-2-1-3-6-6-2-1-2-2-3-1-2-1h-3l-2-1h-3l-2 1h-2l-3 1-2 1"/>
    <path id="bys" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4670 7648-1 1-2 1-1 1-1 2-2 2v2l-2 4v10l6 12 5 5 2 1 3 2 2 1h2l2 1h5l2-1h1l4-2 1-1 2-1 3-3 2-4v-2l1-2v-10l-1-2v-2l-2-4-2-2-1-2-2-2-1-2-6-3-3-1-2-1h-2l-2-1h-2l-2 1h-2l-4 2"/>
    <path id="byt" transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.53)" d="m-2.7068-2.2188c0.79478-0.96959 2.0475-1.44 3.284-1.2333 1.2365 0.20675 2.268 1.0591 2.7042 2.2345"/>
    <path id="byu" transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.53)" d="m-1.073-2.258c0.90982-0.43234 1.9902-0.27642 2.7407 0.39554"/>
    <path id="byv" transform="matrix(-.13857 -.079995 -.079995 .13857 750.91 360.29)" d="m-4.3649 6.099c-1.304-0.93327-2.2746-2.26-2.7693-3.7853"/>
    <path id="byw" transform="matrix(-.13857 -.079995 -.079995 .13857 738.59 350.53)" d="m-104.19 16.57c-0.76495-4.81-1.1959-9.6673-1.2898-14.537"/>
    <path id="byx" transform="matrix(-.13857 -.079995 -.079995 .13857 753.47 359.01)" d="m-0.05824 2.4993c-1.3803-0.03216-2.4732-1.1772-2.4411-2.5576"/>
    <path id="byy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4691 7662-6 5"/>
    <path id="byz" transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.53)" d="m1.4982-0.07303c0.03796 0.77878-0.52705 1.4568-1.2999 1.5599"/>
    <path id="bza" transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.53)" d="m3.2813 1.2179c-0.43625 1.1754-1.4678 2.0276-2.7044 2.2342-1.2366 0.20664-2.4892-0.26391-3.2839-1.2336"/>
    <path id="bzb" transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.53)" d="m1.6675 1.8626c-0.75051 0.67189-1.8309 0.82771-2.7407 0.39528"/>
    <path id="bzc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4684 7670h-1"/>
    <path id="bzd" transform="matrix(-.13857 -.079995 -.079995 .13857 752.03 358.21)" d="m0.08308-1.4977c0.81803 0.04538 1.4483 0.73873 1.4157 1.5574"/>
    <path id="bze" transform="matrix(-.13857 -.079995 -.079995 .13857 752.03 358.21)" d="m1.4988-0.05952c0.03251 0.81864-0.59785 1.5119-1.4159 1.5572"/>
    <path id="bzf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4682 7668h1l1-1"/>
    <path id="bzg" transform="matrix(-.13857 -.079995 -.079995 .13857 752.35 358.37)" d="m0.69884 1.3273c-0.16095 0.08474-0.33597 0.13951-0.51651 0.16162"/>
    <path id="bzh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4684 7666 4-2 2-3 3-1"/>
    <path id="bzi" transform="matrix(-.13857 -.079995 -.079995 .13857 753.95 359.33)" d="m-0.04463 3.4997c-1.931-0.02463-3.4772-1.6086-3.4551-3.5396"/>
    <path id="bzj" transform="matrix(-.13857 -.079995 -.079995 .13857 753.95 359.33)" d="m-3.4998 0.03993c-0.02203-1.931 1.5241-3.515 3.4551-3.5396"/>
    <path id="bzk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4696 7665-3 1-3 2-4 1"/>
    <path id="bzl" transform="matrix(-.13857 -.079995 -.079995 .13857 752.35 358.53)" d="m0.18247-1.4889c0.18055 0.02213 0.35556 0.07691 0.51649 0.16166"/>
    <path id="bzm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4685 7669-1 1"/>
    <path id="bzn" transform="matrix(-.13857 -.079995 -.079995 .13857 753.47 359.01)" d="m-2.4998 0.0314c-0.00922-0.73388 0.30451-1.4347 0.85799-1.9167 0.55349-0.48199 1.2908-0.69643 2.0165-0.58644"/>
    <path id="bzo" transform="matrix(-.13857 -.079995 -.079995 .13857 753.47 359.01)" d="m0.37441 2.4718c-0.72566 0.10992-1.463-0.10458-2.0164-0.58663-0.55344-0.48204-0.8671-1.1829-0.85781-1.9168"/>
    <path id="bzp" transform="matrix(-.13857 -.079995 -.079995 .13857 753.47 359.01)" d="m-2.4993 0.05824c-0.03217-1.3803 1.0607-2.5254 2.4411-2.5576"/>
    <path id="bzq" transform="matrix(-.13857 -.079995 -.079995 .13857 752.19 358.21)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
    <path id="bzr" transform="matrix(-.13857 -.079995 -.079995 .13857 752.19 358.21)" d="m1.4982-0.07303c0.02246 0.46067-0.16826 0.90606-0.51715 1.2077"/>
    <path id="bzs" transform="matrix(-.13857 -.079995 -.079995 .13857 752.19 358.21)" d="m0.98107 1.1347c-0.22105 0.19112-0.49311 0.31351-0.78276 0.35214"/>
    <path id="bzt" transform="matrix(-.13857 -.079995 -.079995 .13857 752.35 358.37)" d="m1.4889 0.18233c-0.05977 0.48807-0.35496 0.91585-0.79004 1.1449"/>
    <path id="bzu" transform="matrix(-.13857 -.079995 -.079995 .13857 752.35 358.53)" d="m0.69896-1.3272c0.43507 0.22913 0.73021 0.65694 0.78993 1.145"/>
    <path id="bzv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4693 7666-7 3"/>
    <path id="bzw" transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.37)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
    <path id="bzx" transform="matrix(-.13857 -.079995 -.079995 .13857 754.11 359.33)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
    <path id="bzy" transform="matrix(-.13857 -.079995 -.079995 .13857 754.11 359.33)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="bzz" transform="matrix(-.13857 -.079995 -.079995 .13857 753.31 359.01)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="caa" transform="matrix(-.13857 -.079995 -.079995 .13857 753.31 359.01)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
    <path id="cab" transform="matrix(-.13857 -.079995 -.079995 .13857 744.35 353.73)" d="m-60.891 24.135c-2.6243-6.6212-4.1512-13.626-4.5204-20.739"/>
   </g>
   <g id="cac" stroke="#000">
    <path id="cad" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4680 7725-4 2 6 12 5-3-7-11" stroke-width="2"/>
    <path id="cae" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4613 7764 4-3 7 11-5 3-6-11" stroke-width="2"/>
    <g id="caf" stroke-width="3">
     <path id="cag" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4252h147v2h-147v-2"/>
     <path id="cah" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 4241v11h-2v-11"/>
     <path id="cai" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4174v-25h2v25"/>
     <path id="caj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 4174h3"/>
     <path id="cak" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4239-1 2h2"/>
     <path id="cal" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4462h147v2h-147v-2"/>
     <path id="cam" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 4451v11h-2v-11"/>
     <path id="can" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4384v-25h2v25"/>
     <path id="cao" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 4384h3"/>
     <path id="cap" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4449-1 2h2"/>
     <path id="caq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4567h147v2h-147v-2"/>
     <path id="car" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 4556v11h-2v-11"/>
     <path id="cas" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4489v-25h2v25"/>
     <path id="cat" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 4489h3"/>
     <path id="cau" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4554-1 2h2"/>
     <path id="cav" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4582-1-2"/>
     <path id="caw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 4580v-11h-2v11"/>
     <path id="cax" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4647v15h2v-15"/>
     <path id="cay" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4580h2"/>
    </g>
   </g>
   <g id="caz" stroke="#545454" stroke-width="2">
    <path id="cba" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090.9 4441.4c1.3042 0.9336 2.2744 2.2602 2.7691 3.7856"/>
    <path id="cbb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.7 4444.9c0.7466 4.6968 1.1743 9.4385 1.2812 14.193"/>
    <path id="cbc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092.4 4438.4c2.5821 6.5156 4.1016 13.404 4.5005 20.401"/>
    <path id="cbd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 4482-1 1h-8l-1-1-2-1h-1l-4-4-1-2-1-1-3-6v-11l1-2v-2l3-6 5-5 2-1h1l2-1h7l1 1"/>
    <path id="cbe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4488h-4l-3-1-4-2-6-6-2-4-1-3-1-2-1-3v-11l1-3 1-2 1-3 2-4 6-6 4-2 3-1h9l2 1 3 1 2 1 4 4 1 2 2 2 1 2 1 3 1 2 1 3v11l-1 3-1 2-1 3-1 2-2 2-1 2-4 4-2 1-3 1-2 1h-5"/>
    <path id="cbf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4486h-3l-10-5-1-2-2-2-3-6-1-3v-13l1-3 3-6 2-2 1-2 10-5h7l8 4 3 3 1 2 2 2 2 4v3l1 2v9l-1 2v3l-2 4-2 2-1 2-3 3-8 4h-4"/>
    <path id="cbg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.2 4460.3c0.4361-1.1753 1.4678-2.0278 2.7046-2.2344 1.2364-0.2065 2.4888 0.2642 3.2837 1.2334"/>
    <path id="cbh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.8 4459.6c0.7505-0.6719 1.8311-0.8276 2.7407-0.395"/>
    <path id="cbi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.6 4478.8c-0.4947 1.5254-1.4654 2.852-2.7696 3.7856"/>
    <path id="cbj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 4464.5c-0.094 4.8696-0.5249 9.7271-1.2901 14.537"/>
    <path id="cbk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4461.4c0.032 1.3804-1.061 2.5254-2.4414 2.5576"/>
    <path id="cbl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4464-7-1"/>
    <path id="cbm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5089.3 4463c-0.773-0.103-1.3379-0.7812-1.2999-1.56"/>
    <path id="cbn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.2 4463.7c-0.7949 0.9693-2.0473 1.44-3.2837 1.2334-1.2368-0.2065-2.2685-1.059-2.7046-2.2343"/>
    <path id="cbo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091.6 4463.8c-0.9096 0.4326-1.9902 0.2769-2.7407-0.395"/>
    <path id="cbp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 4460"/>
    <path id="cbq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4461.6c-0.032-0.8184 0.5981-1.5122 1.416-1.5572"/>
    <path id="cbr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.4 4463c-0.8179-0.045-1.4483-0.7388-1.416-1.5572"/>
    <path id="cbs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4463h-2"/>
    <path id="cbt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.3 4463c-0.1807-0.022-0.356-0.077-0.5166-0.1617"/>
    <path id="cbu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4463 5 1h6"/>
    <path id="cbv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4461.5c0.021 1.9307-1.5244 3.5147-3.4556 3.5391"/>
    <path id="cbw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099.5 4458c1.9312 0.024 3.4771 1.6084 3.4551 3.5395"/>
    <path id="cbx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4458-3 1h-3l-5 1"/>
    <path id="cby" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4461.2c0.1606-0.085 0.3359-0.1396 0.5166-0.1616"/>
    <path id="cbz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4460h-2"/>
    <path id="cca" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.1 4459c0.7256-0.1098 1.4629 0.1045 2.0166 0.5864 0.5532 0.482 0.8672 1.1831 0.8579 1.917"/>
    <path id="ccb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4461.5c0.01 0.7339-0.3047 1.4346-0.8579 1.9165-0.5537 0.482-1.291 0.6963-2.0166 0.5865"/>
    <path id="ccc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.6 4459c1.3799 0.033 2.4726 1.1777 2.4409 2.5576"/>
    <path id="ccd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4461.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
    <path id="cce" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085.5 4462.6c-0.3491-0.3018-0.5395-0.7471-0.5171-1.208"/>
    <path id="ccf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.3 4463c-0.2896-0.039-0.5621-0.1611-0.7828-0.352"/>
    <path id="ccg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4462.8c-0.4351-0.229-0.7305-0.6567-0.7901-1.145"/>
    <path id="cch" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 4462.3c0.06-0.4883 0.355-0.916 0.7901-1.1451"/>
    <path id="cci" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4459-7 1"/>
    <path id="ccj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4461.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
    <path id="cck" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5102 4461.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
    <path id="ccl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4461.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="ccm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4461.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="ccn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4461.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="cco" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.9 4464.9c-0.3686 7.1148-1.8955 14.122-4.5205 20.745"/>
    <path id="ccp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090.9 4223.4c1.3042 0.9336 2.2744 2.2602 2.7691 3.7856"/>
    <path id="ccq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.7 4227.9c0.7466 4.6968 1.1743 9.4385 1.2812 14.193"/>
    <path id="ccr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092.4 4221.4c2.5821 6.5156 4.1016 13.404 4.5005 20.401"/>
    <path id="ccs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 4265h-3l-1 1h-2l-1-1h-3l-2-1-2-2-2-1-1-2-1-1-3-6-1-1v-12l1-2v-2l1-2 1-1 2-4 1-1 2-1 1-1 2-1 1-1h2l1-1h4l2 1h1"/>
    <path id="cct" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4271-2-1h-2l-3-1-6-3-4-4-1-2-1-3-1-2-2-6v-11l1-2 1-3 1-2 1-3 1-2 4-4 6-3 3-1 2-1h5l4 2 3 1 4 2 2 2 1 2 2 2 1 3 1 2 1 3 1 2v11l-2 6-1 2-1 3-2 2-1 2-2 2-4 2-3 1-2 1h-2l-3 1"/>
    <path id="ccu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4269-1-1h-4l-6-3-2-2-1-2-2-1-1-2-1-3-2-4v-14l2-4 1-3 1-2 5-5 6-3h2l2-1h3l2 1h2l6 3 1 2 2 1 1 2 2 2 1 3 1 2v2l1 2v10l-1 2v2l-1 2-1 3-5 5-1 2-6 3h-4l-2 1"/>
    <path id="ccv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.2 4243.3c0.4361-1.1753 1.4678-2.0278 2.7046-2.2344 1.2364-0.2065 2.4888 0.2642 3.2837 1.2334"/>
    <path id="ccw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.8 4242.6c0.7505-0.6719 1.8311-0.8276 2.7407-0.395"/>
    <path id="ccx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.6 4260.8c-0.4947 1.5254-1.4654 2.852-2.7696 3.7856"/>
    <path id="ccy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 4246.5c-0.094 4.8696-0.5249 9.7271-1.2901 14.537"/>
    <path id="ccz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4244.4c0.032 1.3804-1.061 2.5254-2.4414 2.5576"/>
    <path id="cda" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4246-7-1"/>
    <path id="cdb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5089.3 4246c-0.773-0.103-1.3379-0.7812-1.2999-1.56"/>
    <path id="cdc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.2 4246.7c-0.7949 0.9693-2.0473 1.44-3.2837 1.2334-1.2368-0.2065-2.2685-1.059-2.7046-2.2343"/>
    <path id="cdd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091.6 4246.8c-0.9096 0.4326-1.9902 0.2769-2.7407-0.395"/>
    <path id="cde" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 4243"/>
    <path id="cdf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4244.6c-0.032-0.8184 0.5981-1.5122 1.416-1.5572"/>
    <path id="cdg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.4 4246c-0.8179-0.045-1.4483-0.7388-1.416-1.5572"/>
    <path id="cdh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4245h-2"/>
    <path id="cdi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.3 4246c-0.1807-0.022-0.356-0.077-0.5166-0.1617"/>
    <path id="cdj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4245 5 1 3 1h3"/>
    <path id="cdk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4244.5c0.021 1.9307-1.5244 3.5147-3.4556 3.5391"/>
    <path id="cdl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099.5 4241c1.9312 0.024 3.4771 1.6084 3.4551 3.5395"/>
    <path id="cdm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4241h-6l-5 1"/>
    <path id="cdn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4243.2c0.1606-0.085 0.3359-0.1396 0.5166-0.1616"/>
    <path id="cdo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4242-2 1"/>
    <path id="cdp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.1 4242c0.7256-0.1098 1.4629 0.1045 2.0166 0.5864 0.5532 0.482 0.8672 1.1831 0.8579 1.917"/>
    <path id="cdq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4244.5c0.01 0.7339-0.3047 1.4346-0.8579 1.9165-0.5537 0.482-1.291 0.6963-2.0166 0.5865"/>
    <path id="cdr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.6 4242c1.3799 0.033 2.4726 1.1777 2.4409 2.5576"/>
    <path id="cds" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4244.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
    <path id="cdt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085.5 4245.6c-0.3491-0.3018-0.5395-0.7471-0.5171-1.208"/>
    <path id="cdu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.3 4246c-0.2896-0.039-0.5621-0.1611-0.7828-0.352"/>
    <path id="cdv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4245.8c-0.4351-0.229-0.7305-0.6567-0.7901-1.145"/>
    <path id="cdw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 4244.3c0.06-0.4883 0.355-0.916 0.7901-1.1451"/>
    <path id="cdx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4241-7 2"/>
    <path id="cdy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4244.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
    <path id="cdz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5102 4244.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
    <path id="cea" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4244.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="ceb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4244.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="cec" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4244.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="ced" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.9 4246.9c-0.3686 7.1148-1.8955 14.122-4.5205 20.745"/>
   </g>
   <g id="cee" stroke="#000" stroke-width="2">
    <path id="cef" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2389 4673v5"/>
    <path id="ceg" transform="matrix(0 -.16 -.16 0 385.79 836.77)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5"/>
    <path id="ceh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2394 4683h83"/>
    <path id="cei" transform="matrix(0 -.16 -.16 0 399.07 835.17)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5"/>
    <path id="cej" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 4688v83"/>
    <path id="cek" transform="matrix(0 -.16 -.16 0 400.67 821.89)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5"/>
    <path id="cel" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 4776h6"/>
    <path id="cem" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2393 4673v5"/>
    <path id="cen" transform="matrix(0 -.16 -.16 0 385.79 836.77)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5"/>
    <path id="ceo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2394 4679h83"/>
    <path id="cep" transform="matrix(0 -.16 -.16 0 399.07 835.17)" d="m-9.5 0c0-5.2467 4.2533-9.5 9.5-9.5"/>
    <path id="ceq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 4688v83"/>
    <path id="cer" transform="matrix(0 -.16 -.16 0 400.67 821.89)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5"/>
    <path id="ces" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 4772h6"/>
   </g>
   <g id="cet" stroke="#545454" stroke-width="2">
    <path id="ceu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.4 4337.2c0.4949-1.5254 1.4654-2.852 2.7693-3.7856"/>
    <path id="cev" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 4351.1c0.1071-4.7544 0.5356-9.496 1.2824-14.193"/>
    <path id="cew" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.1 4350.8c0.3997-6.9971 1.9197-13.885 4.5022-20.4"/>
    <path id="cex" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 4374h2l2 1h2l2-1h3l1-1 2-1 1-1 2-1 1-2 1-1 2-4 1-1v-2l1-2v-10l-1-2v-2l-1-2-1-1-2-4-1-1-2-1-1-1-2-1-1-1h-2l-1-1h-5l-1 1h-2"/>
    <path id="cey" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4380h3l2-1 3-1 6-3 2-2 1-2 2-2 1-3 1-2 1-3 1-2v-12l-1-2-1-3-1-2-1-3-2-2-1-2-2-2-6-3-3-1-2-1h-5l-2 1-3 1-6 3-2 2-1 2-2 2-1 3-1 2-1 3-1 2v12l1 2 1 3 1 2 1 3 2 2 1 2 2 2 6 3 3 1 2 1h2"/>
    <path id="cez" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4378 2-1h4l6-3 1-2 2-1 1-2 2-2 1-3 1-2v-2l1-2v-10l-1-2v-2l-1-2-1-3-2-2-1-2-2-1-1-2-6-3h-2l-2-1h-3l-2 1h-2l-6 3-1 2-2 1-2 2-1 2-1 3-1 2v2l-1 2v10l1 2v2l1 2 1 3 1 2 2 2 2 1 1 2 6 3h4l1 1"/>
    <path id="cfa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.8 4351.3c0.7947-0.9697 2.0474-1.4399 3.284-1.2334 1.2365 0.2071 2.268 1.0591 2.7043 2.2344"/>
    <path id="cfb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129.4 4351.2c0.9099-0.4326 1.9902-0.2769 2.7407 0.3955"/>
    <path id="cfc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130.1 4373.6c-1.3039-0.9336-2.2744-2.2602-2.7693-3.7856"/>
    <path id="cfd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2126.3 4370.1c-0.7649-4.81-1.1958-9.6675-1.2898-14.537"/>
    <path id="cfe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.4 4356c-1.3802-0.032-2.4732-1.1772-2.441-2.5576"/>
    <path id="cff" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4355 7-1"/>
    <path id="cfg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4353.4c0.038 0.7788-0.5271 1.457-1.3001 1.56"/>
    <path id="cfh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.8 4354.7c-0.4363 1.1753-1.4678 2.0278-2.7044 2.2343-1.2366 0.2066-2.4892-0.2641-3.2839-1.2334"/>
    <path id="cfi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4355.4c-0.7505 0.6719-1.8308 0.8276-2.7407 0.395"/>
    <path id="cfj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4352"/>
    <path id="cfk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.6 4352c0.8181 0.045 1.4485 0.7388 1.4158 1.5572"/>
    <path id="cfl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 4353.4c0.033 0.8189-0.5979 1.5122-1.4158 1.5572"/>
    <path id="cfm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4354h2"/>
    <path id="cfn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4354.8c-0.1609 0.085-0.3359 0.1397-0.5163 0.1617"/>
    <path id="cfo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4354-5 1-3 1h-3"/>
    <path id="cfp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121.5 4357c-1.9309-0.024-3.477-1.6084-3.4551-3.5395"/>
    <path id="cfq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 4353.5c-0.022-1.9311 1.5242-3.5151 3.4551-3.5395"/>
    <path id="cfr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4350h3l3 1h5"/>
    <path id="cfs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4352c0.1806 0.022 0.3557 0.077 0.5166 0.1616"/>
    <path id="cft" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4351 2 1"/>
    <path id="cfu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4353.5c-0.01-0.7338 0.3045-1.4345 0.858-1.9165 0.5534-0.4819 1.2907-0.6962 2.0166-0.5864"/>
    <path id="cfv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2123.9 4356c-0.7258 0.1098-1.4631-0.1045-2.0166-0.5865-0.5532-0.4819-0.8669-1.1831-0.8577-1.9169"/>
    <path id="cfw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2122 4353.6c-0.032-1.3804 1.0608-2.5254 2.441-2.5576"/>
    <path id="cfx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.7 4352c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
    <path id="cfy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2135 4353.4c0.022 0.4609-0.1685 0.9062-0.5173 1.208"/>
    <path id="cfz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.5 4354.6c-0.221 0.1909-0.493 0.3134-0.7828 0.352"/>
    <path id="cga" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4353.7c-0.06 0.4883-0.3548 0.916-0.7901 1.145"/>
    <path id="cgb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4352.2c0.435 0.2291 0.7302 0.6568 0.79 1.1451"/>
    <path id="cgc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4351 7 1"/>
    <path id="cgd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4352c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
    <path id="cge" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2120 4353.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
    <path id="cgf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4353.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="cgg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4353.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="cgh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4353.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="cgi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128.6 4376.6c-2.6245-6.6216-4.1513-13.626-4.5205-20.739"/>
   </g>
   <g id="cgj" stroke="#000" stroke-width="3">
    <path id="cgk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4252h-148v2h148v-2"/>
    <path id="cgl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4357h-148v2h148v-2"/>
    <path id="cgm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 4346v11h3v-11"/>
    <path id="cgn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4279v-25h-3v25"/>
    <path id="cgo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 4279h-3"/>
    <path id="cgp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4344 1 2h-3"/>
    <path id="cgq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4252h-148v2h148v-2"/>
    <path id="cgr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 4241v11h3v-11"/>
    <path id="cgs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4174v-25h-3v25"/>
    <path id="cgt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 4174h-3"/>
    <path id="cgu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4239 1 2h-3"/>
    <path id="cgv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4462h-148v2h148v-2"/>
    <path id="cgw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 4451v11h3v-11"/>
    <path id="cgx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4384v-25h-3v25"/>
    <path id="cgy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 4384h-3"/>
    <path id="cgz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4449 1 2h-3"/>
    <path id="cha" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4567h-148v2h148v-2"/>
    <path id="chb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 4556v11h3v-11"/>
    <path id="chc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4489v-25h-3v25"/>
    <path id="chd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 4489h-3"/>
    <path id="che" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4554 1 2h-3"/>
    <path id="chf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4582 1-2"/>
    <path id="chg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 4580v-11h3v11"/>
    <path id="chh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4647v15h-3v-15"/>
    <path id="chi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4580h-3"/>
   </g>
   <g id="chj" stroke="#545454" stroke-width="2">
    <path id="chk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.4 4445.2c0.4949-1.5254 1.4654-2.852 2.7693-3.7856"/>
    <path id="chl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 4459.1c0.1071-4.7544 0.5356-9.496 1.2824-14.193"/>
    <path id="chm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.1 4458.8c0.3997-6.9971 1.9197-13.885 4.5022-20.4"/>
    <path id="chn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 4482 2 1h7l2-1 1-1h2l4-4 1-2 1-1 2-4v-2l1-2v-9l-1-2v-2l-3-6-5-5-2-1h-1l-2-1h-7l-2 1"/>
    <path id="cho" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4488h5l3-1 4-2 4-4 1-2 2-2 1-2 1-3 1-2 1-3v-11l-1-3-1-2-1-3-1-2-2-2-1-2-4-4-4-2-3-1h-9l-3 1-4 2-4 4-1 2-2 2-1 2-1 3-1 2-1 3v11l1 3 1 2 1 3 1 2 2 2 1 2 4 4 4 2 3 1h4"/>
    <path id="chp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4486h4l8-4 3-3 1-2 2-2 2-4v-3l1-2v-9l-1-2v-3l-2-4-2-2-1-2-3-3-8-4h-7l-8 4-5 5-3 6v3l-1 2v9l1 2v3l3 6 5 5 8 4h3"/>
    <path id="chq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.8 4459.3c0.7947-0.9697 2.0474-1.4399 3.284-1.2334 1.2365 0.2071 2.268 1.0591 2.7043 2.2344"/>
    <path id="chr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129.4 4459.2c0.9099-0.4326 1.9902-0.2769 2.7407 0.3955"/>
    <path id="chs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130.1 4482.6c-1.3039-0.9336-2.2744-2.2602-2.7693-3.7856"/>
    <path id="cht" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2126.3 4479.1c-0.7649-4.81-1.1958-9.6675-1.2898-14.537"/>
    <path id="chu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.4 4464c-1.3802-0.032-2.4732-1.1772-2.441-2.5576"/>
    <path id="chv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4464 7-1"/>
    <path id="chw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4461.4c0.038 0.7788-0.5271 1.457-1.3001 1.56"/>
    <path id="chx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.8 4462.7c-0.4363 1.1753-1.4678 2.0278-2.7044 2.2343-1.2366 0.2066-2.4892-0.2641-3.2839-1.2334"/>
    <path id="chy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4463.4c-0.7505 0.6719-1.8308 0.8276-2.7407 0.395"/>
    <path id="chz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4460"/>
    <path id="cia" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.6 4460c0.8181 0.045 1.4485 0.7388 1.4158 1.5572"/>
    <path id="cib" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 4461.4c0.033 0.8189-0.5979 1.5122-1.4158 1.5572"/>
    <path id="cic" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4463h2"/>
    <path id="cid" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4462.8c-0.1609 0.085-0.3359 0.1397-0.5163 0.1617"/>
    <path id="cie" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4463-5 1h-6"/>
    <path id="cif" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121.5 4465c-1.9309-0.024-3.477-1.6084-3.4551-3.5395"/>
    <path id="cig" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 4461.5c-0.022-1.9311 1.5242-3.5151 3.4551-3.5395"/>
    <path id="cih" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4458 3 1h3l5 1"/>
    <path id="cii" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4461c0.1806 0.022 0.3557 0.077 0.5166 0.1616"/>
    <path id="cij" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4460h2"/>
    <path id="cik" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4461.5c-0.01-0.7338 0.3045-1.4345 0.858-1.9165 0.5534-0.4819 1.2907-0.6962 2.0166-0.5864"/>
    <path id="cil" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2123.9 4464c-0.7258 0.1098-1.4631-0.1045-2.0166-0.5865-0.5532-0.4819-0.8669-1.1831-0.8577-1.9169"/>
    <path id="cim" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2122 4461.6c-0.032-1.3804 1.0608-2.5254 2.441-2.5576"/>
    <path id="cin" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.7 4460c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
    <path id="cio" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2135 4461.4c0.022 0.4609-0.1685 0.9062-0.5173 1.208"/>
    <path id="cip" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.5 4462.6c-0.221 0.1909-0.493 0.3134-0.7828 0.352"/>
    <path id="ciq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4461.7c-0.06 0.4883-0.3548 0.916-0.7901 1.145"/>
    <path id="cir" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4461.2c0.435 0.2291 0.7302 0.6568 0.79 1.1451"/>
    <path id="cis" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4459 7 1"/>
    <path id="cit" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4460c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
    <path id="ciu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2120 4461.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
    <path id="civ" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4461.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="ciw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4461.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="cix" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4461.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="ciy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128.6 4485.6c-2.6245-6.6216-4.1513-13.626-4.5205-20.739"/>
    <path id="ciz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.4 4227.2c0.4949-1.5254 1.4654-2.852 2.7693-3.7856"/>
    <path id="cja" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 4242.1c0.1071-4.7544 0.5356-9.496 1.2824-14.193"/>
    <path id="cjb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.1 4241.8c0.3997-6.9971 1.9197-13.885 4.5022-20.4"/>
    <path id="cjc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 4265h4l1 1h1l2-1h3l1-1 2-1 1-1 2-1 1-2 1-1 3-6v-1l1-2v-10l-1-2v-2l-1-2-1-1-2-4-1-1-2-1-1-1-2-1-1-1h-2l-1-1h-5l-1 1h-2"/>
    <path id="cjd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4271 3-1h2l3-1 6-3 2-2 1-2 2-2 1-3 1-2 2-6v-11l-1-2-1-3-1-2-1-3-2-2-1-2-2-2-6-3-3-1-2-1h-5l-2 1-3 1-6 3-2 2-1 2-2 2-1 3-1 2-1 3-1 2v11l2 6 1 2 1 3 2 2 1 2 2 2 6 3 3 1h2l2 1"/>
    <path id="cje" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4269 2-1h4l6-3 1-2 5-5 1-3 1-2v-2l1-2v-10l-1-2v-2l-1-2-1-3-2-2-1-2-2-1-1-2-6-3h-2l-2-1h-3l-2 1h-2l-6 3-1 2-2 1-2 2-1 2-1 3-1 2v2l-1 2v10l1 2v2l1 2 1 3 1 2 2 1 2 2 1 2 6 3h4l1 1"/>
    <path id="cjf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.8 4242.3c0.7947-0.9697 2.0474-1.4399 3.284-1.2334 1.2365 0.2071 2.268 1.0591 2.7043 2.2344"/>
    <path id="cjg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129.4 4242.2c0.9099-0.4326 1.9902-0.2769 2.7407 0.3955"/>
    <path id="cjh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130.1 4264.6c-1.3039-0.9336-2.2744-2.2602-2.7693-3.7856"/>
    <path id="cji" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2126.3 4261.1c-0.7649-4.81-1.1958-9.6675-1.2898-14.537"/>
    <path id="cjj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.4 4247c-1.3802-0.032-2.4732-1.1772-2.441-2.5576"/>
    <path id="cjk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4246 7-1"/>
    <path id="cjl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4244.4c0.038 0.7788-0.5271 1.457-1.3001 1.56"/>
    <path id="cjm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.8 4245.7c-0.4363 1.1753-1.4678 2.0278-2.7044 2.2343-1.2366 0.2066-2.4892-0.2641-3.2839-1.2334"/>
    <path id="cjn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4246.4c-0.7505 0.6719-1.8308 0.8276-2.7407 0.395"/>
    <path id="cjo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4243"/>
    <path id="cjp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.6 4243c0.8181 0.045 1.4485 0.7388 1.4158 1.5572"/>
    <path id="cjq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 4244.4c0.033 0.8189-0.5979 1.5122-1.4158 1.5572"/>
    <path id="cjr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4245h2"/>
    <path id="cjs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4245.8c-0.1609 0.085-0.3359 0.1397-0.5163 0.1617"/>
    <path id="cjt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4245-5 1-3 1h-3"/>
    <path id="cju" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121.5 4248c-1.9309-0.024-3.477-1.6084-3.4551-3.5395"/>
    <path id="cjv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 4244.5c-0.022-1.9311 1.5242-3.5151 3.4551-3.5395"/>
    <path id="cjw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4241h6l5 1"/>
    <path id="cjx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4243c0.1806 0.022 0.3557 0.077 0.5166 0.1616"/>
    <path id="cjy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4242 2 1"/>
    <path id="cjz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4244.5c-0.01-0.7338 0.3045-1.4345 0.858-1.9165 0.5534-0.4819 1.2907-0.6962 2.0166-0.5864"/>
    <path id="cka" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2123.9 4247c-0.7258 0.1098-1.4631-0.1045-2.0166-0.5865-0.5532-0.4819-0.8669-1.1831-0.8577-1.9169"/>
    <path id="ckb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2122 4244.6c-0.032-1.3804 1.0608-2.5254 2.441-2.5576"/>
    <path id="ckc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.7 4243c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
    <path id="ckd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2135 4244.4c0.022 0.4609-0.1685 0.9062-0.5173 1.208"/>
    <path id="cke" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.5 4245.6c-0.221 0.1909-0.493 0.3134-0.7828 0.352"/>
    <path id="ckf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4244.7c-0.06 0.4883-0.3548 0.916-0.7901 1.145"/>
    <path id="ckg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4243.2c0.435 0.2291 0.7302 0.6568 0.79 1.1451"/>
    <path id="ckh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4241 7 2"/>
    <path id="cki" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4243c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
    <path id="ckj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2120 4244.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
    <path id="ckk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4244.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="ckl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4244.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="ckm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4244.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
    <path id="ckn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128.6 4267.6c-2.6245-6.6216-4.1513-13.626-4.5205-20.739"/>
   </g>
  </g>
  <g id="cko" stroke="#000" stroke-linecap="round" stroke-miterlimit="10">
   <g id="ckp">
    <path id="ckq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6803h16l-16 71zm16 0-16 71h16z"/>
    <path id="ckr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6700h16l-16 103zm16 0-16 103h16z"/>
    <path id="cks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6293h16l-16 407zm16 0-16 407h16z"/>
    <path id="ckt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3141h10l-10 23zm10 0-10 23h10z"/>
   </g>
   <g id="cku" fill="none" stroke-linejoin="round" stroke-width="3">
    <path id="ckv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 4157v498h-11v-498"/>
    <path id="ckw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 6578v-428"/>
    <path id="ckx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5945v-487"/>
    <path id="cky" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5458v487"/>
    <path id="ckz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 5055h5v12h-5v-12"/>
    <path id="cla" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5055h11"/>
    <path id="clb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5119 5945v-487 24"/>
    <path id="clc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5826h11"/>
    <path id="cld" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6358v-208"/>
   </g>
  </g>
  <g id="cle" stroke="#000" stroke-linecap="round" stroke-miterlimit="10">
   <path id="clf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2835 6552h-5l5-2901zm-5 0 5-2901-5-5zm5-2901-5-5 1555 5zm-5-5 1555 5 5-5zm1555 5 5-5-5 2903zm5-5-5 2903 5 5zm-5 2903 5 5-1558-5zm5 5-1558-5v5z"/>
   <path id="clg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2832 5103v-5l1556 5zm0-5 1556 5v-5z"/>
   <path id="clh" transform="matrix(0 -.16 -.16 0 580.35 769.25)" d="m186.5 0c0 103-83.499 186.5-186.5 186.5s-186.5-83.499-186.5-186.5 83.499-186.5 186.5-186.5 186.5 83.499 186.5 186.5" fill="none" stroke-linejoin="round" stroke-width="4"/>
   <path id="cli" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3423 5127 5-1-7-26zm5-1-7-26h5zm-7-26h5l-3-27zm5 0-3-27 5 1zm-3-27 5 1v-27zm5 1v-27l5 1zm0-27 5 1 5-26zm5 1 5-26 5 2zm5-26 5 2 8-26zm5 2 8-26 4 3zm8-26 4 3 12-25zm4 3 12-25 4 4zm12-25 4 4 15-23zm4 4 15-23 3 4zm15-23 3 4 19-20zm3 4 19-20 2 4zm19-20 2 4 21-17zm2 4 21-17 2 5zm21-17 2 5 24-14zm2 5 24-14 1 5zm24-14 1 5 25-11zm1 5 25-11 1 5zm25-11 1 5 26-7zm1 5 26-7v5zm26-7v5l27-3zm0 5 27-3-1 5zm27-3-1 5 27 1zm-1 5 27 1-1 5zm27 1-1 5 27 4zm-1 5 27 4-3 5zm27 4-3 5 26 8zm-3 5 26 8-3 4zm26 8-3 4 25 12zm-3 4 25 12-4 4zm25 12-4 4 23 15zm-4 4 23 15-4 4zm23 15-4 4 20 18zm-4 4 20 18-4 3zm20 18-4 3 17 21zm-4 3 17 21-5 2zm17 21-5 2 14 23zm-5 2 14 23-4 1zm14 23-4 1 10 25zm-4 1 10 25-5 1zm10 25-5 1 7 26zm-5 1 7 26h-5zm7 26h-5l3 27zm-5 0 3 27-5-1zm3 27-5-1-1 28zm-5-1-1 28-4-2zm-1 28-4-2-5 27zm-4-2-5 27-5-2zm-5 27-5-2-8 26zm-5-2-8 26-4-3zm-8 26-4-3-12 24zm-4-3-12 24-4-3zm-12 24-4-3-15 22zm-4-3-15 22-4-4zm-15 22-4-4-18 20zm-4-4-18 20-3-4zm-18 20-3-4-20 17zm-3-4-20 17-3-4zm-20 17-3-4-23 14zm-3-4-23 14-1-5zm-23 14-1-5-25 11zm-1-5-25 11-1-6zm-25 11-1-6-26 7zm-1-6-26 7v-5zm-26 7v-5l-27 4zm0-5-27 4 1-6zm-27 4 1-6h-27zm1-6h-27l1-5zm-27 0 1-5-27-5zm1-5-27-5 2-4zm-27-5 2-4-25-9zm2-4-25-9 2-4zm-25-9 2-4-24-12zm2-4-24-12 3-4zm-24-12 3-4-22-15zm3-4-22-15 4-3zm-22-15 4-3-20-18zm4-3-20-18 4-3zm-20-18 4-3-17-21zm4-3-17-21 5-2zm-17-21 5-2-15-23zm5-2-15-23 5-2zm-15-23 5-2-10-25zm5-2-10-25 5-1z"/>
   <path id="clj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3618 3790v-17" fill="none" stroke-linejoin="round" stroke-width="4"/>
   <path id="clk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3602 3790v-17" fill="none" stroke-linejoin="round" stroke-width="4"/>
   <g id="cll">
    <path id="clm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3296 3649 5-1 120 605zm5-1 120 605 4-6zm120 605 4-6 374 6zm4-6 374 6-5-6zm374 6-5-6 130-598zm-5-6 130-598-6-1z"/>
    <path id="cln" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3865 3957-5-1 13-39zm-5-1 13-39-5-1z"/>
    <path id="clo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3421 4250h5l-4-21zm5 0-4-21h5z"/>
    <path id="clp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3425 4213 5 1-2-17zm5 1-2-17 5 1zm-2-17 5 1 1-16zm5 1 1-16 5 1z"/>
    <path id="clq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3440 4167 5 2 6-21zm5 2 6-21 4 3zm6-21 4 3 2-12zm4 3 2-12 4 3z"/>
   </g>
   <path id="clr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3467 4126 4 4" fill="none" stroke-linejoin="round"/>
   <g id="cls">
    <path id="clt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3467 4126 4 4 15-23zm4 4 15-23 3 4zm15-23 3 4 1-7zm3 4 1-7 4 4z"/>
    <path id="clu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3503 4094 3 4 2-7zm3 4 2-7 2 4zm2-7 2 4 21-17zm2 4 21-17 2 5z"/>
    <path id="clv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3546 4072 2 5 9-9zm2 5 9-9 1 5zm9-9 1 5 20-9zm1 5 20-9 1 5z"/>
    <path id="clw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3594 4062v5l16-6zm0 5 16-6v5zm16-6v5l16-4zm0 5 16-4v5z"/>
    <path id="clx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3642 4064-1 5 22-1zm-1 5 22-1-1 5zm22-1-1 5 11-1zm-1 5 11-1-1 5z"/>
    <path id="cly" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3689 4078-3 5 26 8zm-3 5 26 8-3 4zm26 8-3 4 8-1zm-3 4 8-1-3 4z"/>
    <path id="clz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3730 4104-4 4 8-1zm-4 4 8-1-4 4zm8-1-4 4 23 15zm-4 4 23 15-4 4z"/>
   </g>
   <path id="cma" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3749 4130 4-4" fill="none" stroke-linejoin="round"/>
   <g id="cmb">
    <path id="cmc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3763 4139-5 3 11 6zm-5 3 11 6-4 3zm11 6-4 3 14 16zm-4 3 14 16-4 2z"/>
    <path id="cmd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3786 4182-5 1 10 14zm-5 1 10 14-4 1zm10 14-4 1 8 15zm-4 1 8 15-5 1z"/>
    <path id="cme" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3798 4229h-6l7 21zm-6 0 7 21h-5z"/>
   </g>
   <g id="cmf">
    <path id="cmg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3799 4250h-5" fill="none" stroke-linejoin="round"/>
    <path id="cmh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3799 4250h-5l3 27zm-5 0 3 27-5-1zm3 27-5-1-1 27zm-5-1-1 27-4-1zm-1 27-4-1-5 27zm-4-1-5 27-5-3zm-5 27-5-3-8 26zm-5-3-8 26-4-2zm-8 26-4-2-12 24zm-4-2-12 24-4-3zm-12 24-4-3-15 22zm-4-3-15 22-4-4zm-15 22-4-4-18 20zm-4-4-18 20-3-4zm-18 20-3-4-20 17zm-3-4-20 17-3-5zm-20 17-3-5-23 15zm-3-5-23 15-1-5zm-23 15-1-5-25 10zm-1-5-25 10-1-5zm-25 10-1-5-26 7zm-1-5-26 7v-5zm-26 7v-5l-27 3zm0-5-27 3 1-5zm-27 3 1-5h-27zm1-5h-27l1-5zm-27 0 1-5-27-5zm1-5-27-5 2-5zm-27-5 2-5-25-8zm2-5-25-8 2-4zm-25-8 2-4-24-12zm2-4-24-12 3-4zm-24-12 3-4-22-15zm3-4-22-15 4-3zm-22-15 4-3-20-19zm4-3-20-19 4-2zm-20-19 4-2-17-21zm4-2-17-21 5-3zm-17-21 5-3-15-23zm5-3-15-23 5-1zm-15-23 5-1-10-25zm5-1-10-25 5-1zm-10-25 5-1-7-26zm5-1-7-26h5z"/>
    <path id="cmi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3517 3776v-5l186 5zm0-5 186 5v-5z"/>
   </g>
   <path id="cmj" transform="matrix(0 -.16 -.16 0 580.35 975.33)" d="m23.5 0c0 12.979-10.521 23.5-23.5 23.5s-23.5-10.521-23.5-23.5 10.521-23.5 23.5-23.5 23.5 10.521 23.5 23.5" fill="none" stroke-linejoin="round" stroke-width="4"/>
   <g id="cmk">
    <path id="cml" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3884 3829 1-5 11 8zm1-5 11 8 1-6z"/>
    <path id="cmm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3839 4045 1-5 12 7zm1-5 12 7 1-5z"/>
    <path id="cmn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3820 4136 1-5 12 8zm1-5 12 8 1-5z"/>
    <path id="cmo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3360 3956-5 1-4-41zm-5 1-4-41-5 1z"/>
    <path id="cmp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3335 3824 1 5-14-3zm1 5-14-3 1 6z"/>
    <path id="cmq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3380 4040 1 5-14-3zm1 5-14-3 1 5z"/>
    <path id="cmr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3399 4131 1 5-14-2zm1 5-14-2 1 5z"/>
    <path id="cms" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4261 3812h-6l4 51zm-6 0 4 51h-6zm4 51h-6v51zm-6 0v51l-6-1zm0 51-6-1-4 51zm-6-1-4 51-5-1zm-4 51-5-1-9 50zm-5-1-9 50-5-2zm-9 50-5-2-13 50zm-5-2-13 50-5-2zm-13 50-5-2-16 48zm-5-2-16 48-5-2zm-16 48-5-2-20 47zm-5-2-20 47-5-3zm-20 47-5-3-24 45zm-5-3-24 45-4-3zm-24 45-4-3-27 44zm-4-3-27 44-4-4zm-27 44-4-4-31 41zm-4-4-31 41-4-4zm-31 41-4-4-34 39zm-4-4-34 39-3-4zm-34 39-3-4-37 35zm-3-4-37 35-3-4zm-37 35-3-4-39 33zm-3-4-39 33-3-5zm-39 33-3-5-42 30zm-3-5-42 30-2-5zm-42 30-2-5-44 26zm-2-5-44 26-2-5zm-44 26-2-5-46 23zm-2-5-46 23-2-5zm-46 23-2-5-47 19zm-2-5-47 19-1-5zm-47 19-1-5-49 15zm-1-5-49 15-1-6zm-49 15-1-6-50 12zm-1-6-50 12v-6zm-50 12v-6l-51 8zm0-6-51 8v-6zm-51 8v-6l-51 4zm0-6-51 4v-6zm-51 4v-6h-51zm0-6h-51l1-6zm-51 0 1-6-51-4zm1-6-51-4 1-5zm-51-4 1-5-50-9zm1-5-50-9 1-5zm-50-9 1-5-49-13zm1-5-49-13 2-5zm-49-13 2-5-48-16zm2-5-48-16 2-5zm-48-16 2-5-47-20zm2-5-47-20 3-5zm-47-20 3-5-46-24zm3-5-46-24 4-4zm-46-24 4-4-44-27zm4-4-44-27 4-4zm-44-27 4-4-41-31zm4-4-41-31 4-4zm-41-31 4-4-39-33zm4-4-39-33 4-4zm-39-33 4-4-35-37zm4-4-35-37 4-3zm-35-37 4-3-33-39zm4-3-33-39 5-3zm-33-39 5-3-30-42zm5-3-30-42 5-2zm-30-42 5-2-26-44zm5-2-26-44 5-2zm-26-44 5-2-23-46zm5-2-23-46 5-2zm-23-46 5-2-19-47zm5-2-19-47 5-1zm-19-47 5-1-15-49zm5-1-15-49 5-1zm-15-49 5-1-11-50zm5-1-11-50h5zm-11-50h5l-7-51zm5 0-7-51h5z"/>
    <path id="cmt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2964 3812h-5l5-163zm-5 0 5-163h-5z"/>
    <path id="cmu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4261 3812h-6l6-163zm-6 0 6-163h-6z"/>
   </g>
   <path id="cmv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3618 6410v17" fill="none" stroke-linejoin="round" stroke-width="4"/>
   <path id="cmw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3602 6410v17" fill="none" stroke-linejoin="round" stroke-width="4"/>
   <g id="cmx">
    <path id="cmy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3301 6552-5-1 129-598zm-5-1 129-598-4-5zm129-598-4-5 373 5zm-4-5 373 5 5-5zm373 5 5-5 119 604zm5-5 119 604 6-1z"/>
    <path id="cmz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3860 6244 5-1 3 42zm5-1 3 42 5-1z"/>
    <path id="cna" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3799 5950h-5l4 22zm-5 0 4 22-6-1z"/>
    <path id="cnb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3795 5988-5-1 1 17zm-5-1 1 17-4-2zm1 17-4-2-1 17zm-4-2-1 17-5-2z"/>
    <path id="cnc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3779 6034-4-3-6 22zm-4-3-6 22-4-3zm-6 22-4-3-2 11zm-4-3-2 11-5-3z"/>
   </g>
   <path id="cnd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3753 6074-4-3" fill="none" stroke-linejoin="round"/>
   <g id="cne">
    <path id="cnf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3753 6074-4-3-15 22zm-4-3-15 22-4-3zm-15 22-4-3v7zm-4-3v7l-4-4z"/>
    <path id="cng" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3717 6106-3-4-2 8zm-3-4-2 8-3-5zm-2 8-3-5-20 18zm-3-5-20 18-3-5z"/>
    <path id="cnh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3673 6128-1-5-9 9zm-1-5-9 9-1-5zm-9 9-1-5-20 10zm-1-5-20 10-1-6z"/>
    <path id="cni" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3626 6138v-5l-16 7zm0-5-16 7v-6zm-16 7v-6l-16 4zm0-6-16 4v-5z"/>
    <path id="cnj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3578 6137 1-6-22 1zm1-6-22 1 1-5zm-22 1 1-5-12 1zm1-5-12 1 2-5z"/>
    <path id="cnk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3531 6123 2-5-25-8zm2-5-25-8 2-5zm-25-8 2-5-7 1zm2-5-7 1 3-4z"/>
    <path id="cnl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3490 6097 4-4h-8zm4-4h-8l3-3zm-8 0 3-3-22-16zm3-3-22-16 4-3z"/>
   </g>
   <path id="cnm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3471 6071-4 3" fill="none" stroke-linejoin="round"/>
   <g id="cnn">
    <path id="cno" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3457 6061 4-3-10-5zm4-3-10-5 4-3zm-10-5 4-3-15-16zm4-3-15-16 5-3z"/>
    <path id="cnp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3434 6019 5-2-11-13zm5-2-11-13 5-2zm-11-13 5-2-8-14zm5-2-8-14 5-1z"/>
    <path id="cnq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3422 5972 5-1-6-21zm5-1-6-21h5zm-6-21h5l-3-27zm5 0-3-27 5 1zm-3-27 5 1v-27zm5 1v-27l5 2zm0-27 5 2 5-27zm5 2 5-27 5 2zm5-27 5 2 8-26zm5 2 8-26 4 3zm8-26 4 3 12-24zm4 3 12-24 4 3zm12-24 4 3 15-23zm4 3 15-23 3 4zm15-23 3 4 19-20zm3 4 19-20 2 5zm19-20 2 5 21-18zm2 5 21-18 2 5zm21-18 2 5 24-14zm2 5 24-14 1 5zm24-14 1 5 25-11zm1 5 25-11 1 5zm25-11 1 5 26-7zm1 5 26-7v5zm26-7v5l27-3zm0 5 27-3-1 5zm27-3-1 5 27 1zm-1 5 27 1-1 5zm27 1-1 5 27 4zm-1 5 27 4-3 5zm27 4-3 5 26 8zm-3 5 26 8-3 5zm26 8-3 5 25 11zm-3 5 25 11-4 4zm25 11-4 4 23 16zm-4 4 23 16-4 3zm23 16-4 3 20 18zm-4 3 20 18-4 3zm20 18-4 3 17 21zm-4 3 17 21-5 2zm17 21-5 2 14 23zm-5 2 14 23-4 2zm14 23-4 2 10 24zm-4 2 10 24-5 1zm10 24-5 1 7 26zm-5 1 7 26h-5z"/>
    <path id="cnr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3517 6430v-5l186 5zm0-5 186 5v-5z"/>
   </g>
   <path id="cns" transform="matrix(0 -.16 -.16 0 580.35 563.17)" d="m23.5 0c0 12.979-10.521 23.5-23.5 23.5s-23.5-10.521-23.5-23.5 10.521-23.5 23.5-23.5 23.5 10.521 23.5 23.5" fill="none" stroke-linejoin="round" stroke-width="4"/>
   <g id="cnt">
    <path id="cnu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3885 6377-1-5 13 2zm-1-5 13 2-1-5z"/>
    <path id="cnv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3840 6161-1-5 14 2zm-1-5 14 2-1-5z"/>
    <path id="cnw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3821 6070-1-6 14 3zm-1-6 14 3-1-5z"/>
    <path id="cnx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3355 6243 5 1-14 40zm5 1-14 40 5 1z"/>
    <path id="cny" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3336 6372-1 5-12-8zm-1 5-12-8-1 5z"/>
    <path id="cnz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3381 6156-1 5-12-8zm-1 5-12-8-1 5z"/>
    <path id="coa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3400 6064-1 6-12-8zm-1 6-12-8-1 5z"/>
    <path id="cob" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2959 6388h5l-3-51zm5 0-3-51 5 1zm-3-51 5 1 1-51zm5 1 1-51 5 1zm1-51 5 1 5-51zm5 1 5-51 5 1zm5-51 5 1 9-51zm5 1 9-51 5 2zm9-51 5 2 13-49zm5 2 13-49 5 1zm13-49 5 1 16-48zm5 1 16-48 5 2zm16-48 5 2 20-46zm5 2 20-46 5 2zm20-46 5 2 24-45zm5 2 24-45 4 3zm24-45 4 3 27-43zm4 3 27-43 4 3zm27-43 4 3 31-41zm4 3 31-41 4 4zm31-41 4 4 33-38zm4 4 33-38 4 4zm33-38 4 4 36-36zm4 4 36-36 4 4zm36-36 4 4 39-32zm4 4 39-32 3 4zm39-32 3 4 42-29zm3 4 42-29 2 4zm42-29 2 4 44-26zm2 4 44-26 2 5zm44-26 2 5 46-22zm2 5 46-22 1 5zm46-22 1 5 48-19zm1 5 48-19 1 5zm48-19 1 5 49-15zm1 5 49-15 1 5zm49-15 1 5 50-11zm1 5 50-11v5zm50-11v5l51-7zm0 5 51-7v5zm51-7v5l51-3zm0 5 51-3v5zm51-3v5l51 1zm0 5 51 1-1 5zm51 1-1 5 51 5zm-1 5 51 5-1 5zm51 5-1 5 50 9zm-1 5 50 9-2 5zm50 9-2 5 50 12zm-2 5 50 12-2 5zm50 12-2 5 48 17zm-2 5 48 17-2 4zm48 17-2 4 47 21zm-2 4 47 21-3 4zm47 21-3 4 45 24zm-3 4 45 24-3 4zm45 24-3 4 43 28zm-3 4 43 28-3 4zm43 28-3 4 41 30zm-3 4 41 30-4 4zm41 30-4 4 39 34zm-4 4 39 34-4 3zm39 34-4 3 35 37zm-4 3 35 37-4 3zm35 37-4 3 33 40zm-4 3 33 40-5 2zm33 40-5 2 30 42zm-5 2 30 42-5 2zm30 42-5 2 26 45zm-5 2 26 45-5 1zm26 45-5 1 23 46zm-5 1 23 46-5 2zm23 46-5 2 19 48zm-5 2 19 48-5 1zm19 48-5 1 15 49zm-5 1 15 49-6 1zm15 49-6 1 12 49zm-6 1 12 49-6 1zm12 49-6 1 8 50zm-6 1 8 50h-6z"/>
    <path id="coc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2959 6388h5l-5 164zm5 0-5 164h5z"/>
    <path id="cod" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4255 6388h6l-6 164zm6 0-6 164h6z"/>
   </g>
  </g>
  <g id="coe" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="cof" stroke-width="4">
    <path id="cog" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1259 5645v-329"/>
    <path id="coh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1264 5399v-83"/>
    <path id="coi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1352 5645v-236"/>
    <path id="coj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1383 5645v-236"/>
    <path id="cok" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1414 5645v-236"/>
    <path id="col" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5378h236"/>
    <path id="com" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5347h236"/>
    <path id="con" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5316h236"/>
   </g>
   <g id="coo" stroke-width="2">
    <path id="cop" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5961 5645v-298"/>
    <path id="coq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5956 5404v-57"/>
    <path id="cor" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5930 5645v-236"/>
    <path id="cos" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5899 5645v-236"/>
    <path id="cot" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5868 5645v-236"/>
    <path id="cou" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5837 5645v-236"/>
    <path id="cov" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5805 5645v-236"/>
    <path id="cow" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5774 5630v-221"/>
    <path id="cox" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5645v-188"/>
    <path id="coy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5453v-6"/>
    <path id="coz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5444v-7"/>
    <path id="cpa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5434v-6"/>
    <path id="cpb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5424v-6"/>
    <path id="cpc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5415v-6"/>
    <path id="cpd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5645v-141"/>
    <path id="cpe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5500v-6"/>
    <path id="cpf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5491v-7"/>
    <path id="cpg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5481v-7"/>
    <path id="cph" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5471v-6"/>
    <path id="cpi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5461v-6"/>
    <path id="cpj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5452v-7"/>
    <path id="cpk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5442v-7"/>
    <path id="cpl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5432v-6"/>
    <path id="cpm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5423v-7"/>
    <path id="cpn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5413v-4"/>
    <path id="cpo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5645v-99"/>
    <path id="cpp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5542v-6"/>
    <path id="cpq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5533v-7"/>
    <path id="cpr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5523v-7"/>
    <path id="cps" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5513v-6"/>
    <path id="cpt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5503v-6"/>
    <path id="cpu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5494v-7"/>
    <path id="cpv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5484v-7"/>
    <path id="cpw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5474v-6"/>
    <path id="cpx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5465v-7"/>
    <path id="cpy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5455v-7"/>
    <path id="cpz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5445v-6"/>
    <path id="cqa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5435v-6"/>
    <path id="cqb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5426v-7"/>
    <path id="cqc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5416v-7"/>
    <path id="cqd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5597v-5"/>
    <path id="cqe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5589v-6"/>
    <path id="cqf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5579v-6"/>
    <path id="cqg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5570v-7"/>
    <path id="cqh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5560v-6"/>
    <path id="cqi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5550v-6"/>
    <path id="cqj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5541v-7"/>
    <path id="cqk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5531v-7"/>
    <path id="cql" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5521v-6"/>
    <path id="cqm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5511v-6"/>
    <path id="cqn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5502v-7"/>
    <path id="cqo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5492v-7"/>
    <path id="cqp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5482v-6"/>
    <path id="cqq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5473v-7"/>
    <path id="cqr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5463v-7"/>
    <path id="cqs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5453v-6"/>
    <path id="cqt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5443v-6"/>
    <path id="cqu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5434v-7"/>
    <path id="cqv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5424v-7"/>
    <path id="cqw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5414v-5"/>
    <path id="cqx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5642v-3"/>
    <path id="cqy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5636v-6"/>
    <path id="cqz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5626v-6"/>
    <path id="cra" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5617v-7"/>
    <path id="crb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5607v-7"/>
    <path id="crc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5597v-6"/>
    <path id="crd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5587v-6"/>
    <path id="cre" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5578v-7"/>
    <path id="crf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5568v-7"/>
    <path id="crg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5558v-6"/>
    <path id="crh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5549v-7"/>
    <path id="cri" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5539v-7"/>
    <path id="crj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5529v-6"/>
    <path id="crk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5519v-6"/>
    <path id="crl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5510v-7"/>
    <path id="crm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5500v-7"/>
    <path id="crn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5490v-6"/>
    <path id="cro" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5480v-6"/>
    <path id="crp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5471v-7"/>
    <path id="crq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5461v-6"/>
    <path id="crr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5451v-6"/>
    <path id="crs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5442v-7"/>
    <path id="crt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5432v-7"/>
    <path id="cru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5422v-6"/>
    <path id="crv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5412v-3"/>
    <path id="crw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5404v6"/>
    <path id="crx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5413v7"/>
    <path id="cry" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5423v6"/>
    <path id="crz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5433v6"/>
    <path id="csa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5442v7"/>
    <path id="csb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5452v6"/>
    <path id="csc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5462v6"/>
    <path id="csd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5471v7"/>
    <path id="cse" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5481v7"/>
    <path id="csf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5491v6"/>
    <path id="csg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5501v6"/>
    <path id="csh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5510v7"/>
    <path id="csi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5520v6"/>
    <path id="csj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5530v6"/>
    <path id="csk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5539v7"/>
    <path id="csl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5549v7"/>
    <path id="csm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5559v6"/>
    <path id="csn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5569v6"/>
    <path id="cso" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5578v7"/>
    <path id="csp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5588v7"/>
    <path id="csq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5598v6"/>
    <path id="csr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5607v7"/>
    <path id="css" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5617v7"/>
    <path id="cst" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5627v6"/>
    <path id="csu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5637v5"/>
    <path id="csv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5409h-433"/>
    <path id="csw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 5409h-6"/>
    <path id="csx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5751 5409h-7"/>
    <path id="csy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5741 5409h-7"/>
    <path id="csz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5731 5409h-6"/>
    <path id="cta" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5721 5409h-6"/>
    <path id="ctb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5409h-7"/>
    <path id="ctc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5702 5409h-7"/>
    <path id="ctd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5692 5409h-6"/>
    <path id="cte" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5682 5409h-6"/>
    <path id="ctf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5673 5409h-7"/>
    <path id="ctg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5663 5409h-6"/>
    <path id="cth" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5653 5409h-6"/>
    <path id="cti" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5644 5409h-7"/>
    <path id="ctj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5634 5409h-7"/>
    <path id="ctk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5624 5409h-6"/>
    <path id="ctl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5614 5409h-6"/>
    <path id="ctm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5605 5409h-7"/>
    <path id="ctn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5595 5409h-7"/>
    <path id="cto" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5956 5404h-186"/>
    <path id="ctp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5767 5404h-7"/>
    <path id="ctq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5757 5404h-6"/>
    <path id="ctr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5747 5404h-6"/>
    <path id="cts" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5738 5404h-7"/>
    <path id="ctt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5728 5404h-6"/>
    <path id="ctu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5718 5404h-6"/>
    <path id="ctv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5709 5404h-7"/>
    <path id="ctw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5699 5404h-7"/>
    <path id="ctx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5689 5404h-6"/>
    <path id="cty" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5679 5404h-6"/>
    <path id="ctz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5670 5404h-7"/>
    <path id="cua" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5660 5404h-6"/>
    <path id="cub" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5404h-6"/>
    <path id="cuc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5641 5404h-7"/>
    <path id="cud" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5631 5404h-7"/>
    <path id="cue" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5621 5404h-6"/>
    <path id="cuf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5611 5404h-6"/>
    <path id="cug" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 5404h-7"/>
    <path id="cuh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5592 5404h-4"/>
    <path id="cui" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5378h-236"/>
    <path id="cuj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5347h-233"/>
    <path id="cuk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5642 70-105 19 4-23-30 19 4 70-106"/>
    <path id="cul" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5645v-48"/>
    <path id="cum" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5961 5645v-329"/>
    <path id="cun" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5956 5404v-88"/>
    <path id="cuo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5930 5645v-236"/>
    <path id="cup" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5899 5645v-236"/>
    <path id="cuq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5868 5645v-236"/>
    <path id="cur" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5837 5645v-236"/>
    <path id="cus" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5805 5645v-236"/>
    <path id="cut" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5774 5630v-221"/>
    <path id="cuu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5645v-183"/>
    <path id="cuv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5645v-141"/>
    <path id="cuw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5500v-6"/>
    <path id="cux" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5491v-7"/>
    <path id="cuy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5481v-7"/>
    <path id="cuz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5471v-6"/>
    <path id="cva" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5461v-6"/>
    <path id="cvb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5452v-7"/>
    <path id="cvc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5442v-7"/>
    <path id="cvd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5432v-6"/>
    <path id="cve" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5423v-7"/>
    <path id="cvf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5413v-4"/>
    <path id="cvg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5645v-99"/>
    <path id="cvh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5542v-6"/>
    <path id="cvi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5533v-7"/>
    <path id="cvj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5523v-7"/>
    <path id="cvk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5513v-6"/>
    <path id="cvl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5503v-6"/>
    <path id="cvm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5494v-7"/>
    <path id="cvn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5484v-7"/>
    <path id="cvo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5474v-6"/>
    <path id="cvp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5465v-7"/>
    <path id="cvq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5455v-7"/>
    <path id="cvr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5445v-6"/>
    <path id="cvs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5435v-6"/>
    <path id="cvt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5426v-7"/>
    <path id="cvu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5416v-7"/>
    <path id="cvv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5597v-5"/>
    <path id="cvw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5589v-6"/>
    <path id="cvx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5579v-6"/>
    <path id="cvy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5570v-7"/>
    <path id="cvz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5560v-6"/>
    <path id="cwa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5550v-6"/>
    <path id="cwb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5541v-7"/>
    <path id="cwc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5531v-7"/>
    <path id="cwd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5521v-6"/>
    <path id="cwe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5511v-6"/>
    <path id="cwf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5502v-7"/>
    <path id="cwg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5492v-7"/>
    <path id="cwh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5482v-6"/>
    <path id="cwi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5473v-7"/>
    <path id="cwj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5463v-7"/>
    <path id="cwk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5453v-6"/>
    <path id="cwl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5443v-6"/>
    <path id="cwm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5434v-7"/>
    <path id="cwn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5424v-7"/>
    <path id="cwo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5414v-5"/>
    <path id="cwp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5642v-3"/>
    <path id="cwq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5636v-6"/>
    <path id="cwr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5626v-6"/>
    <path id="cws" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5617v-7"/>
    <path id="cwt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5607v-7"/>
    <path id="cwu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5597v-6"/>
    <path id="cwv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5587v-6"/>
    <path id="cww" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5578v-7"/>
    <path id="cwx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5568v-7"/>
    <path id="cwy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5558v-6"/>
    <path id="cwz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5549v-7"/>
    <path id="cxa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5539v-7"/>
    <path id="cxb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5529v-6"/>
    <path id="cxc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5519v-6"/>
    <path id="cxd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5510v-7"/>
    <path id="cxe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5500v-7"/>
    <path id="cxf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5490v-6"/>
    <path id="cxg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5480v-6"/>
    <path id="cxh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5471v-7"/>
    <path id="cxi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5461v-6"/>
    <path id="cxj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5451v-6"/>
    <path id="cxk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5442v-7"/>
    <path id="cxl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5432v-7"/>
    <path id="cxm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5422v-6"/>
    <path id="cxn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5412v-3"/>
    <path id="cxo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5404v6"/>
    <path id="cxp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5413v7"/>
    <path id="cxq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5423v6"/>
    <path id="cxr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5433v6"/>
    <path id="cxs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5442v7"/>
    <path id="cxt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5452v6"/>
    <path id="cxu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5462v6"/>
    <path id="cxv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5471v7"/>
    <path id="cxw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5481v7"/>
    <path id="cxx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5491v6"/>
    <path id="cxy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5501v6"/>
    <path id="cxz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5510v7"/>
    <path id="cya" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5520v6"/>
    <path id="cyb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5530v6"/>
    <path id="cyc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5539v7"/>
    <path id="cyd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5549v7"/>
    <path id="cye" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5559v6"/>
    <path id="cyf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5569v6"/>
    <path id="cyg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5578v7"/>
    <path id="cyh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5588v7"/>
    <path id="cyi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5598v6"/>
    <path id="cyj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5607v7"/>
    <path id="cyk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5617v7"/>
    <path id="cyl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5627v6"/>
    <path id="cym" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5637v5"/>
    <path id="cyn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5409h-426"/>
    <path id="cyo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5956 5404h-182"/>
    <path id="cyp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5378h-236"/>
    <path id="cyq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5347h-236"/>
    <path id="cyr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5316h-241"/>
    <path id="cys" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5642 70-105 19 4-23-30"/>
    <path id="cyt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5704 5515 70-106"/>
    <path id="cyu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5645v-48"/>
   </g>
  </g>
  <g id="cyv" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4">
   <path id="cyw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 3048v-125"/>
   <path id="cyx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4350 3048v-125"/>
   <path id="cyy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4319 3048v-125"/>
   <path id="cyz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4288 3048v-125"/>
   <path id="cza" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2962 3048v-125"/>
   <path id="czb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2931 3048v-125"/>
   <path id="czc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2900 3048v-125"/>
  </g>
  <g id="czd" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4">
   <path id="cze" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 3048v-125"/>
   <path id="czf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4350 3048v-125"/>
   <path id="czg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4319 3048v-125"/>
   <path id="czh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4288 3048v-125"/>
   <path id="czi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2962 3048v-125"/>
   <path id="czj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2931 3048v-125"/>
   <path id="czk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2900 3048v-125"/>
  </g>
  <g id="czl" fill="none" stroke="#00f" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <g id="czm" stroke-width="2">
    <path id="czn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1905 406 350"/>
    <path id="czo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1933-404 348"/>
    <path id="czp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5364 1933-391 337"/>
   </g>
   <path id="czq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5349v-282" stroke-width="7"/>
   <path id="czr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 5619v-352" stroke-width="7"/>
   <g id="czs" stroke-width="2">
    <path id="czt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8766h-192v-10h192"/>
    <path id="czu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8761h182"/>
    <path id="czv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5347v277"/>
    <path id="czw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5619v-352"/>
    <path id="czx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 5267v357"/>
    <path id="czy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6202 5624v-357"/>
   </g>
   <g id="czz" stroke-width="7">
    <path id="daa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5062h202"/>
    <path id="dab" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5062h81"/>
    <path id="dac" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5119 4859v196"/>
   </g>
   <g id="dad" stroke-width="2">
    <path id="dae" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5267h10"/>
    <path id="daf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3768 2752v16h-137v-16h137"/>
    <path id="dag" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4105 2752v16h-119v-16h119"/>
    <path id="dah" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8133v11"/>
    <path id="dai" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8133h-69l-231 232v12h10v-8l225-225h65"/>
    <path id="daj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2605 8133v11h-96v-11h96"/>
    <path id="dak" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2615 8144v-11h413v11h-413"/>
    <path id="dal" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8133v11h-328v-11h328"/>
    <path id="dam" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8144v-11"/>
    <path id="dan" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8144h97v612h-97v10h108v-633h-108"/>
    <path id="dao" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3739 8455v-10l43-1v11h-43"/>
    <path id="dap" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3998 8455v-11h44v11h-44"/>
    <path id="daq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4150 8144v-11"/>
    <path id="dar" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4150 8144h-97v612h97v10h-108v-633h108"/>
    <path id="das" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4552 8133v11h-360v-11h360"/>
    <path id="dat" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8144v-11"/>
    <path id="dau" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8144h65l225 225v3h10v-7l-231-232h-69"/>
    <path id="dav" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4562 8144v-11h149v11h-149"/>
    <path id="daw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 8766v-10h285v10h-285"/>
    <path id="dax" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 8756v10h-286v-10h286"/>
    <path id="day" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5770 1401h11"/>
    <path id="daz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5770 1401v182l-797 687h-4v11h7l805-693v-187"/>
    <path id="dba" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887h-10v-215h10v215"/>
    <path id="dbb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1902v-10h360v10h-360"/>
    <path id="dbc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1891 7 8"/>
    <path id="dbd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1891-419 361v8h11v-3l415-358"/>
    <path id="dbe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4115 1892h-10v-485h10v485"/>
    <path id="dbf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4115 2255h-10v-322h10v322"/>
    <path id="dbg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1902v-10h360v10h-360"/>
    <path id="dbh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1457 1903 6-8"/>
    <path id="dbi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1457 1903 416 358v3h10v-8l-420-361"/>
    <path id="dbj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1375v11h110v-11h-110"/>
    <path id="dbk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1450 1401h-11"/>
    <path id="dbl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1450 1401v182l797 687h4v11h-8l-804-693v-187"/>
    <path id="dbm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3105 2255h10v-322h-10v322"/>
    <path id="dbn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1386v-11"/>
    <path id="dbo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1386h264v506h10v-517h-274"/>
    <path id="dbp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1385v-11h156v11h-156"/>
    <path id="dbq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4084 1375v11h-21v-11h21"/>
    <path id="dbr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3639 1375v11h-24v-11h24"/>
    <path id="dbs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4105 2516h10v366h-10v-366"/>
    <path id="dbt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3390 2739h10v-62h-10v62"/>
    <path id="dbu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3219 2521h171v-10h-171v10"/>
    <path id="dbv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3390 2562h10v-51h-10v51"/>
    <path id="dbw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3400 2635h148l83 83v164"/>
    <path id="dbx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3400 2636h147l83 83v163"/>
    <path id="dby" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3620 2882h11v-5h-11v5"/>
    <path id="dbz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3406 2646v-11h-6v11h6"/>
    <path id="dca" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3623 2726 8-8-4-3-7 7 3 4"/>
    <path id="dcb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3544 2646 7-7-3-4-8 8 4 3"/>
    <path id="dcc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1375v11h-575v-11h575"/>
    <path id="dcd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 2270v11h-581v-11h581"/>
   </g>
  </g>
  <g id="dce" stroke-linecap="round" stroke-miterlimit="10">
   <g id="dcf" fill="none" stroke="#f0f" stroke-linejoin="round">
    <path id="dcg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2403 6271v5h-13v-5h13"/>
    <path id="dch" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2396 6276-58 34 3 4 58-34-3-4"/>
    <path id="dci" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390.7 6344c-20.721 0.4649-39.912-10.863-49.517-29.23"/>
    <path id="dcj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2403 6348v-5h-13v5h13"/>
    <path id="dck" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2377 6494v5h-13v-5h13"/>
    <path id="dcl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2370 6499-58 34 3 4 58-34-3-4"/>
    <path id="dcm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2364.7 6567c-20.721 0.4649-39.912-10.863-49.517-29.23"/>
    <path id="dcn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2377 6571v-5h-13v5h13"/>
    <path id="dco" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2192 6271v5h13v-5h-13"/>
    <path id="dcp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2198 6276 59 34-3 4-58-34 2-4"/>
    <path id="dcq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2254.8 6314.8c-9.605 18.366-28.796 29.694-49.517 29.23"/>
    <path id="dcr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2192 6348v-5h13v5h-13"/>
   </g>
   <g id="dcs" fill="#f0f" stroke="#f0f">
    <path id="dct" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2411 5668-2-1h2z"/>
    <path id="dcu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5666h5l-3 1zm5 0-3 1h2z"/>
    <path id="dcv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5666-52-35h4zm-52-35h4l-4-3z"/>
    <path id="dcw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5666h5l-53-35z"/>
   </g>
   <g id="dcx" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dcy" transform="matrix(0 -.16 -.16 0 380.19 683.81)" d="m31.536-52.799c20.097 12.004 31.637 34.376 29.767 57.711"/>
    <path id="dcz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5628 57 38"/>
    <path id="dda" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5630 58 38"/>
   </g>
   <g id="ddb" fill="#f0f" stroke="#f0f">
    <path id="ddc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2245 5565-5-3h5z"/>
    <path id="ddd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2188 5527h4l48 35zm4 0 48 35h5z"/>
    <path id="dde" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2188 5527v-1h3zm0-1h3l-2-1z"/>
    <path id="ddf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2188 5527h4l-1-1z"/>
   </g>
   <g id="ddg" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="ddh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2245 5565-57-38"/>
    <path id="ddi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2247 5563-58-38"/>
    <path id="ddj" transform="matrix(0 -.16 -.16 0 361.15 695.81)" d="m-31.516 52.811c-20.116-12.005-31.666-34.396-29.786-57.747"/>
   </g>
   <g id="ddk" fill="#f0f" stroke="#f0f">
    <path id="ddl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5565v-3h4z"/>
    <path id="ddm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5527h5l-57 35zm5 0-57 35h4z"/>
    <path id="ddn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5527 2-1h2zm2-1h2v-1z"/>
    <path id="ddo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5527h5l-1-1z"/>
   </g>
   <g id="ddp" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="ddq" stroke-width="3">
     <path id="ddr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5565 57-38"/>
     <path id="dds" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5563 58-38"/>
     <path id="ddt" transform="matrix(0 -.16 -.16 0 380.19 695.81)" d="m-61.304 4.9122c-1.87-23.337 9.672-45.711 29.772-57.714"/>
    </g>
    <g id="ddu">
     <path id="ddv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4986 2-2"/>
     <path id="ddw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4988 4-4"/>
     <path id="ddx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4991 5-6"/>
     <path id="ddy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4993 5-5"/>
     <path id="ddz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4995 5-5"/>
     <path id="dea" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4998 5-6"/>
     <path id="deb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5e3 5-5"/>
     <path id="dec" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5002 5-5"/>
     <path id="ded" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5005 5-6"/>
     <path id="dee" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5007 5-5"/>
     <path id="def" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5009 5-5"/>
     <path id="deg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5012 5-6"/>
     <path id="deh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5014 5-5"/>
     <path id="dei" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5016 5-5"/>
     <path id="dej" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5019 5-6"/>
     <path id="dek" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5021 5-5"/>
     <path id="del" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5023 5-5"/>
     <path id="dem" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5026 5-6"/>
     <path id="den" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5028 5-5"/>
     <path id="deo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5030 5-5"/>
     <path id="dep" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5033 5-6"/>
     <path id="deq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5035 5-5"/>
     <path id="der" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5037 5-5"/>
     <path id="des" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5040 5-6"/>
     <path id="det" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5042 5-5"/>
     <path id="deu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5044 5-5"/>
     <path id="dev" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5047 5-6"/>
     <path id="dew" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5049 5-5"/>
     <path id="dex" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5051 5-5"/>
     <path id="dey" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5054 5-6"/>
     <path id="dez" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5056 5-5"/>
     <path id="dfa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5058 5-5"/>
     <path id="dfb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5060 5-5"/>
     <path id="dfc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 5062 4-4"/>
     <path id="dfd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 5062 1-2"/>
    </g>
    <path id="dfe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4984v78h5v-78h-5" stroke-width="3"/>
    <path id="dff" transform="matrix(0 -.16 -.16 0 341.47 775.49)" d="m-77.346-4.8858c2.6121-41.351 37.286-73.333 78.713-72.602"/>
    <path id="dfg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2112 5055h5v13h-5v-13" stroke-width="3"/>
    <path id="dfh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2195 5055h5v13h-5v-13" stroke-width="3"/>
    <g id="dfi">
     <path id="dfj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4858 5432-2-2"/>
     <path id="dfk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 5432-5-4"/>
     <path id="dfl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4863 5432-5-5"/>
     <path id="dfm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5432-5-5"/>
     <path id="dfn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5432-5-5"/>
     <path id="dfo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870 5432-5-5"/>
     <path id="dfp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5432-5-5"/>
     <path id="dfq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4875 5432-5-5"/>
     <path id="dfr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5432-5-5"/>
     <path id="dfs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4879 5432-5-5"/>
     <path id="dft" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 5432-5-5"/>
     <path id="dfu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5432-5-5"/>
     <path id="dfv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886 5432-5-5"/>
     <path id="dfw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4889 5432-5-5"/>
     <path id="dfx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4891 5432-5-5"/>
     <path id="dfy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4893 5432-5-5"/>
     <path id="dfz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4896 5432-6-5"/>
     <path id="dga" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4898 5432-5-5"/>
     <path id="dgb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4900 5432-5-5"/>
     <path id="dgc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4903 5432-6-5"/>
     <path id="dgd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4905 5432-5-5"/>
     <path id="dge" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4907 5432-5-5"/>
     <path id="dgf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4910 5432-6-5"/>
     <path id="dgg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4912 5432-5-5"/>
     <path id="dgh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4914 5432-5-5"/>
     <path id="dgi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4917 5432-6-5"/>
     <path id="dgj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4919 5432-5-5"/>
     <path id="dgk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4921 5432-5-5"/>
     <path id="dgl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4924 5432-6-5"/>
     <path id="dgm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4926 5432-5-5"/>
     <path id="dgn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4928 5432-5-5"/>
     <path id="dgo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4931 5432-6-5"/>
     <path id="dgp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933 5432-5-5"/>
     <path id="dgq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5431-4-4"/>
     <path id="dgr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5429-2-2"/>
    </g>
    <path id="dgs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4856 5432h78v-5h-78v5" stroke-width="3"/>
    <path id="dgt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4856.2 5427.6c2.6118-41.351 37.286-73.333 78.713-72.602"/>
    <path id="dgu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4927 5437v-5h13v5h-13" stroke-width="3"/>
    <path id="dgv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4927 5354v-5h13v5h-13" stroke-width="3"/>
    <g id="dgw">
     <path id="dgx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870 6379v6h13v-6h-13"/>
     <path id="dgy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 6385 58 33-2 5-59-34 3-4"/>
     <path id="dgz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.8 6423.8c-9.605 18.366-28.796 29.694-49.517 29.23"/>
     <path id="dha" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870 6457v-5h13v5h-13"/>
     <path id="dhb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870 6494v5h13v-5h-13"/>
     <path id="dhc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 6499 58 34-2 4-59-34 3-4"/>
     <path id="dhd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.8 6537.8c-9.605 18.366-28.796 29.694-49.517 29.23"/>
     <path id="dhe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870 6571v-5h13v5h-13"/>
    </g>
   </g>
   <g id="dhf" fill="#f0f" stroke="#f0f">
    <path id="dhg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4809 5643-1-1h3z"/>
    <path id="dhh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5641h5l-5 1zm5 0-5 1h3z"/>
    <path id="dhi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5641 53-35h4zm53-35h4v-3z"/>
    <path id="dhj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5641h5l52-35z"/>
   </g>
   <g id="dhk" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dhl" transform="matrix(0 -.16 -.16 0 780.35 687.81)" d="m61.304-4.9064c1.8675 23.335-9.6743 45.706-29.773 57.708"/>
    <path id="dhm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5603-57 38"/>
    <path id="dhn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5605-58 38"/>
   </g>
   <g id="dho" fill="#f0f" stroke="#f0f">
    <path id="dhp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4975 5565v-3h4z"/>
    <path id="dhq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5027 5527h5l-57 35zm5 0-57 35h4z"/>
    <path id="dhr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5027 5527 2-1h2zm2-1h2v-1z"/>
    <path id="dhs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5027 5527h5l-1-1z"/>
   </g>
   <g id="dht" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dhu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4975 5565 57-38"/>
    <path id="dhv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4973 5563 58-38"/>
    <path id="dhw" transform="matrix(0 -.16 -.16 0 799.55 695.81)" d="m-61.302 4.9357c-1.8801-23.351 9.6691-45.742 29.786-57.747"/>
   </g>
   <g id="dhx" fill="#f0f" stroke="#f0f">
    <path id="dhy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5565-4-3h4z"/>
    <path id="dhz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5527h5l48 35zm5 0 48 35h4z"/>
    <path id="dia" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5527v-1h3zm0-1h3l-2-1z"/>
    <path id="dib" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5527h5l-2-1z"/>
   </g>
   <g id="dic" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="did" stroke-width="3">
     <path id="die" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5565-57-38"/>
     <path id="dif" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5563-58-38"/>
     <path id="dig" transform="matrix(0 -.16 -.16 0 780.35 695.81)" d="m-31.531 52.802c-20.1-12.003-31.642-34.377-29.772-57.714"/>
    </g>
    <g id="dih">
     <path id="dii" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4986-2-2"/>
     <path id="dij" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4988-5-4"/>
     <path id="dik" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4991-5-6"/>
     <path id="dil" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4993-5-5"/>
     <path id="dim" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4995-5-5"/>
     <path id="din" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4998-5-6"/>
     <path id="dio" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5e3 -5-5"/>
     <path id="dip" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5002-5-5"/>
     <path id="diq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5005-5-6"/>
     <path id="dir" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5007-5-5"/>
     <path id="dis" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5009-5-5"/>
     <path id="dit" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5012-5-6"/>
     <path id="diu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5014-5-5"/>
     <path id="div" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5016-5-5"/>
     <path id="diw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5019-5-6"/>
     <path id="dix" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5021-5-5"/>
     <path id="diy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5023-5-5"/>
     <path id="diz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5026-5-6"/>
     <path id="dja" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5028-5-5"/>
     <path id="djb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5030-5-5"/>
     <path id="djc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5033-5-6"/>
     <path id="djd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5035-5-5"/>
     <path id="dje" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5037-5-5"/>
     <path id="djf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5040-5-6"/>
     <path id="djg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5042-5-5"/>
     <path id="djh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5044-5-5"/>
     <path id="dji" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5047-5-6"/>
     <path id="djj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5049-5-5"/>
     <path id="djk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5051-5-5"/>
     <path id="djl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5054-5-6"/>
     <path id="djm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5056-5-5"/>
     <path id="djn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5058-5-5"/>
     <path id="djo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5060-5-5"/>
     <path id="djp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5102 5062-4-4"/>
     <path id="djq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 5062-1-2"/>
    </g>
    <path id="djr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4984v78h-5v-78h5" stroke-width="3"/>
    <path id="djs" transform="matrix(0 .16 .16 0 819.23 775.49)" d="m-1.3597-77.488c41.427-0.72689 76.098 31.259 78.706 72.61"/>
    <path id="djt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 5055h-5v13h5v-13" stroke-width="3"/>
    <path id="dju" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5025 5055h-5v13h5v-13" stroke-width="3"/>
   </g>
   <g id="djv" fill="#f0f" stroke="#f0f">
    <path id="djw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4346-5-3h5z"/>
    <path id="djx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4309h5l48 34zm5 0 48 34h5z"/>
    <path id="djy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4309 1-1h2zm1-1h2l-1-2z"/>
    <path id="djz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4309h5l-2-1z"/>
   </g>
   <g id="dka" fill="none" stroke-linejoin="round">
    <g id="dkb" stroke="#f0f" stroke-width="3">
     <path id="dkc" transform="matrix(0 -.16 -.16 0 781.47 890.85)" d="m-31.531 52.802c-20.1-12.003-31.642-34.377-29.772-57.714"/>
     <path id="dkd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4346-58-37"/>
     <path id="dke" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4344-57-38"/>
    </g>
    <g id="dkf" stroke="#0037dd">
     <path id="dkg" transform="matrix(0 -.16 -.16 0 163.71 741.09)" d="m-115.95-11.263c5.1022-52.526 44.875-95.061 96.94-103.67"/>
     <g id="dkh" stroke-width="4">
      <path id="dki" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1026 5262h95"/>
      <path id="dkj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1121 5257h-95"/>
      <path id="dkk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1026 5262v5"/>
      <path id="dkl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1026 5267h-16v-6"/>
      <path id="dkm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1010 5261h10v1h6v-5"/>
      <path id="dkn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1121 5262v-5"/>
     </g>
     <path id="dko" transform="matrix(0 -.16 -.16 0 163.71 778.21)" d="m19.025-114.94c52.064 8.6181 91.833 51.158 96.93 103.68"/>
     <g id="dkp" stroke-width="4">
      <path id="dkq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1026 5058h95"/>
      <path id="dkr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1121 5063h-95"/>
      <path id="dks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1010 5059h10v-1h6v-4h-16"/>
      <path id="dkt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1026 5063v-5"/>
      <path id="dku" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1121 5058v5"/>
      <path id="dkv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1010 5054v5"/>
     </g>
    </g>
   </g>
   <path id="dkw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3786 8457h4l-4 104zm4 0-4 104h4z" fill="#f0f" stroke="#f0f"/>
   <path id="dkx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3990 8457h4l-4 104zm4 0-4 104h4z" fill="#f0f" stroke="#f0f"/>
   <g id="dky" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dkz" stroke-width="3">
     <path id="dla" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3786 8561v-104h4v104h-4"/>
     <path id="dlb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3786 8457h-4"/>
     <path id="dlc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3782 8457v-15h5"/>
     <path id="dld" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3787 8442v10h-1v5"/>
     <path id="dle" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3994 8561v-104h-4v104h4"/>
     <path id="dlf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3994 8457h4"/>
     <path id="dlg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3998 8457v-15h-5"/>
     <path id="dlh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3993 8442v10h1v5"/>
    </g>
    <path id="dli" transform="matrix(0 -.16 -.16 0 642.11 232.45)" d="m106.3 6.4695c-3.3545 55.12-48.283 98.532-103.49 99.993"/>
    <path id="dlj" transform="matrix(0 -.16 -.16 0 608.03 232.45)" d="m2.828-106.46c55.202 1.4664 100.13 44.883 103.48 100"/>
    <g id="dlk" stroke-width="3">
     <path id="dll" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3182 8286h5"/>
     <path id="dlm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3187 8286v16h-6"/>
     <path id="dln" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3181 8302v-11h1v-5"/>
    </g>
   </g>
   <path id="dlo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3084 8286h-5l5-103zm-5 0 5-103h-5z" fill="#f0f" stroke="#f0f"/>
   <g id="dlp" fill="none" stroke-linejoin="round">
    <g id="dlq" stroke="#f0f">
     <g id="dlr" stroke-width="3">
      <path id="dls" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3079 8286v-103"/>
      <path id="dlt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3084 8183v103"/>
      <path id="dlu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3079 8286h-4"/>
      <path id="dlv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3075 8286v16h5"/>
      <path id="dlw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3080 8302v-11h-1v-5h5"/>
      <path id="dlx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3079 8183h5"/>
     </g>
     <path id="dly" transform="matrix(0 .16 .16 0 495.39 259.49)" d="m103.37 5.1776c-2.7588 55.08-48.221 98.322-103.37 98.322"/>
    </g>
    <g id="dlz" stroke="#0037dd">
     <path id="dma" transform="matrix(0 .16 .16 0 996.83 741.09)" d="m19.025-114.94c52.064 8.6181 91.833 51.158 96.93 103.68"/>
     <g id="dmb" stroke-width="4">
      <path id="dmc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5262h-96"/>
      <path id="dmd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6098 5257h96"/>
      <path id="dme" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5262v5"/>
      <path id="dmf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5267h16v-6"/>
      <path id="dmg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6210 5261h-10v1h-6v-5"/>
      <path id="dmh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6098 5262v-5"/>
     </g>
     <path id="dmi" transform="matrix(0 .16 .16 0 996.83 778.21)" d="m-115.95-11.263c5.1022-52.526 44.875-95.061 96.94-103.67"/>
     <g id="dmj" stroke-width="4">
      <path id="dmk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5058h-96"/>
      <path id="dml" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6098 5063h96"/>
      <path id="dmm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6210 5059h-10v-1h-6v-4h16"/>
      <path id="dmn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5063v-5"/>
      <path id="dmo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6098 5058v5"/>
      <path id="dmp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6210 5054v5"/>
     </g>
    </g>
    <g id="dmq" stroke="#f0f" stroke-width="3">
     <path id="dmr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4998 5950h-4"/>
     <path id="dms" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4994 5950v16h5"/>
     <path id="dmt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4999 5966v-10h-1v-6"/>
    </g>
   </g>
   <path id="dmu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 5950h5l-5-103zm5 0-5-103h5z" fill="#f0f" stroke="#f0f"/>
   <g id="dmv" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dmw" stroke-width="3">
     <path id="dmx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5101 5950v-103"/>
     <path id="dmy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 5847v103"/>
     <path id="dmz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5101 5950h5"/>
     <path id="dna" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 5950v16h-6"/>
     <path id="dnb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5100 5966v-10h1v-6h-5"/>
     <path id="dnc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5101 5847h-5"/>
    </g>
    <g id="dnd">
     <path id="dne" transform="matrix(0 -.16 -.16 0 818.91 633.25)" d="m0 103.5c-55.149 0-100.61-43.242-103.37-98.322"/>
     <path id="dnf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2625 7749h-5v12h5v-12"/>
     <path id="dng" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2620 7755-34 58-5-2 34-59 5 3"/>
     <path id="dnh" transform="matrix(0 -.16 -.16 0 419.71 343.17)" d="m48.294 25.257c-9.605 18.366-28.796 29.694-49.517 29.229"/>
     <path id="dni" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2547 7749h5v12h-5v-12"/>
    </g>
    <g id="dnj" stroke-width="3">
     <path id="dnk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7481v4"/>
     <path id="dnl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7485h16v-5"/>
     <path id="dnm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2496 7480h-11v1h-5"/>
    </g>
   </g>
   <path id="dnn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7382v-5l-103 5zm0-5-103 5v-5z" fill="#f0f" stroke="#f0f"/>
   <g id="dno" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dnp" stroke-width="3">
     <path id="dnq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7377h-103"/>
     <path id="dnr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2377 7382h103"/>
     <path id="dns" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7377v-4"/>
     <path id="dnt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7373h16v5"/>
     <path id="dnu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2496 7378h-11v-1h-5v5"/>
     <path id="dnv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2377 7377v5"/>
    </g>
    <path id="dnw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480.5 7481c-55.149 0-100.61-43.243-103.37-98.322"/>
    <g id="dnx" stroke-width="3">
     <path id="dny" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7481v4"/>
     <path id="dnz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7485h-16v-5"/>
     <path id="doa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7480h10v1h6"/>
    </g>
   </g>
   <path id="dob" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7382v-5l103 5zm0-5 103 5v-5z" fill="#f0f" stroke="#f0f"/>
   <g id="doc" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dod" stroke-width="3">
     <path id="doe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7377h103"/>
     <path id="dof" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7382h-103"/>
     <path id="dog" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7377v-4"/>
     <path id="doh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7373h-16v5"/>
     <path id="doi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7378h10v-1h6v5"/>
     <path id="doj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7377v5"/>
    </g>
    <path id="dok" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830.9 7382.7c-2.7588 55.08-48.222 98.322-103.37 98.322"/>
    <g id="dol" stroke-width="3">
     <path id="dom" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 7903v-94"/>
     <path id="don" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 7809v94"/>
     <path id="doo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 7903h4"/>
     <path id="dop" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 7903v15h-5"/>
     <path id="doq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7918v-10h1v-5h-5"/>
     <path id="dor" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2386 7908v-5"/>
     <path id="dos" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2382 7903v15"/>
     <path id="dot" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2387 7908h-1"/>
     <path id="dou" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2382 7918h5v-10"/>
     <path id="dov" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2386 7903h-4"/>
     <path id="dow" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 7809h-5"/>
     <path id="dox" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2613 7614-2 4"/>
     <path id="doy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2611 7618-13-8 2-4"/>
     <path id="doz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2600 7606 9 5v1l4 2"/>
     <path id="dpa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2658 7536 2-3"/>
     <path id="dpb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2660 7533-13-8-3 4"/>
     <path id="dpc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2644 7529 9 5h1l4 2-2 5"/>
    </g>
    <g id="dpd">
     <path id="dpe" transform="matrix(.079995 .13857 .13857 -.079995 427.87 379.65)" d="m-5.1944 90.351c-47.138-2.71-84.271-41.203-85.285-88.407"/>
     <path id="dpf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2646 7749h5v12h-5v-12"/>
     <path id="dpg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2651 7755 34 58 4-2-34-59-4 3"/>
     <path id="dph" transform="matrix(0 .16 .16 0 428.99 343.17)" d="m1.2226 54.486c-20.721 0.46493-39.912-10.863-49.517-29.229"/>
     <path id="dpi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2723 7749h-5v12h5v-12"/>
    </g>
    <g id="dpj" stroke-width="3">
     <path id="dpk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4837 7903h4"/>
     <path id="dpl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4841 7903v15h-5"/>
     <path id="dpm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4836 7918v-10h1v-5"/>
    </g>
   </g>
   <path id="dpn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 7903h-6l6-104zm-6 0 6-104h-6z" fill="#f0f" stroke="#f0f"/>
   <g id="dpo" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dpp" stroke-width="3">
     <path id="dpq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 7903v-104"/>
     <path id="dpr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 7799v104"/>
     <path id="dps" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 7903h-4"/>
     <path id="dpt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 7903v15h5"/>
     <path id="dpu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 7918v-10h-1v-5h6"/>
     <path id="dpv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 7799h6"/>
    </g>
    <path id="dpw" transform="matrix(0 .16 .16 0 760.03 320.77)" d="m103.37 5.1776c-2.7588 55.08-48.221 98.322-103.37 98.322"/>
    <g id="dpx" stroke-width="3">
     <path id="dpy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592 7620 2 3"/>
     <path id="dpz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4594 7623 13-8-2-4"/>
     <path id="dqa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4605 7611-9 5v1l-4 3"/>
     <path id="dqb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7541-2-3"/>
     <path id="dqc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4545 7538 13-8 3 5"/>
     <path id="dqd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4561 7535-9 5-1-1-4 2 2 5"/>
    </g>
    <path id="dqe" transform="matrix(.079995 -.13857 -.13857 -.079995 730.43 378.85)" d="m90.479 1.9434c-1.0139 47.204-38.147 85.697-85.285 88.407"/>
    <path id="dqf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4679 7733 25 63-5 2-25-63 5-2" stroke-width="2"/>
    <path id="dqg" transform="matrix(0 -.16 -.16 0 750.91 346.53)" d="m55.987-22.927c11.399 27.836 0.61686 59.818-25.308 75.071" stroke-width="2"/>
    <g id="dqh" stroke-width="3">
     <path id="dqi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3327 2524h4"/>
     <path id="dqj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3331 2524v-16h-5"/>
     <path id="dqk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3326 2508v11h1v5"/>
    </g>
   </g>
   <path id="dql" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3228 2524h-5l5 104zm-5 0 5 104h-5z" fill="#f0f" stroke="#f0f"/>
   <g id="dqm" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dqn" stroke-width="3">
     <path id="dqo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3223 2524v104"/>
     <path id="dqp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3228 2628v-104"/>
     <path id="dqq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3223 2524h-4"/>
     <path id="dqr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3219 2524v-16h5"/>
     <path id="dqs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3224 2508v11h-1v5h5"/>
     <path id="dqt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3223 2628h5"/>
    </g>
    <path id="dqu" transform="matrix(0 .16 .16 0 518.43 1181.4)" d="m0 103.5c-55.149 0-100.61-43.242-103.37-98.322"/>
    <g id="dqv" stroke-width="3">
     <path id="dqw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3875 2768h5"/>
     <path id="dqx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3880 2768v-16h-6"/>
     <path id="dqy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3874 2752v11h1v5"/>
    </g>
   </g>
   <path id="dqz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3777 2768h-5l5 104zm-5 0 5 104h-5z" fill="#f0f" stroke="#f0f"/>
   <g id="dra" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="drb" stroke-width="3">
     <path id="drc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3772 2768v104"/>
     <path id="drd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3777 2872v-104"/>
     <path id="dre" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3772 2768h-4"/>
     <path id="drf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3768 2768v-16h5"/>
     <path id="drg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3773 2752v11h-1v5h5"/>
     <path id="drh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3772 2872h5"/>
    </g>
    <path id="dri" transform="matrix(0 .16 .16 0 606.27 1142.4)" d="m0 103.5c-55.149 0-100.61-43.242-103.37-98.322"/>
    <g id="drj" stroke-width="3">
     <path id="drk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3879 2768h-5"/>
     <path id="drl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3874 2768v-16h6"/>
     <path id="drm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3880 2752v11h-1v5"/>
    </g>
   </g>
   <path id="drn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3977 2768h5l-5 104zm5 0-5 104h5z" fill="#f0f" stroke="#f0f"/>
   <g id="dro" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="drp" stroke-width="3">
     <path id="drq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3982 2768v104"/>
     <path id="drr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3977 2872v-104"/>
     <path id="drs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3982 2768h4"/>
     <path id="drt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3986 2768v-16h-5"/>
     <path id="dru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3981 2752v11h1v5h-5"/>
     <path id="drv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3982 2872h-5"/>
    </g>
    <path id="drw" transform="matrix(0 -.16 -.16 0 639.87 1142.4)" d="m103.37 5.1776c-2.7588 55.08-48.221 98.322-103.37 98.322"/>
    <path id="drx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3982 2872h-5v-104h5v104" stroke-width="2"/>
   </g>
   <g id="dry" fill="#f0f" stroke="#f0f">
    <path id="drz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4241-5-3h5z"/>
    <path id="dsa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4204h5l48 34zm5 0 48 34h5z"/>
    <path id="dsb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4204 1-1h2zm1-1h2l-1-2z"/>
    <path id="dsc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4204h5l-2-1z"/>
   </g>
   <g id="dsd" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dse" transform="matrix(0 -.16 -.16 0 781.47 907.65)" d="m-31.531 52.802c-20.1-12.003-31.642-34.377-29.772-57.714"/>
    <path id="dsf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4241-58-37"/>
    <path id="dsg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4239-57-38"/>
   </g>
   <g id="dsh" fill="#f0f" stroke="#f0f">
    <path id="dsi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4451-5-3h5z"/>
    <path id="dsj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4414h5l48 34zm5 0 48 34h5z"/>
    <path id="dsk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4414 1-2h2zm1-2h2l-1-1z"/>
    <path id="dsl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4414h5l-2-2z"/>
   </g>
   <g id="dsm" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dsn" transform="matrix(0 -.16 -.16 0 781.47 874.05)" d="m-31.531 52.802c-20.1-12.003-31.642-34.377-29.772-57.714"/>
    <path id="dso" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4451-58-37"/>
    <path id="dsp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4449-57-38"/>
   </g>
   <g id="dsq" fill="#f0f" stroke="#f0f">
    <path id="dsr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4556-5-3h5z"/>
    <path id="dss" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4519h5l48 34zm5 0 48 34h5z"/>
    <path id="dst" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4519 1-2h2zm1-2h2l-1-1z"/>
    <path id="dsu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4519h5l-2-2z"/>
   </g>
   <g id="dsv" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dsw" transform="matrix(0 -.16 -.16 0 781.47 857.25)" d="m-31.531 52.802c-20.1-12.003-31.642-34.377-29.772-57.714"/>
    <path id="dsx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4556-58-37"/>
    <path id="dsy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4554-57-38"/>
   </g>
   <g id="dsz" fill="#f0f" stroke="#f0f">
    <path id="dta" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4816 4620-1-2h2z"/>
    <path id="dtb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4617h5l-4 1zm5 0-4 1h2z"/>
    <path id="dtc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4617 53-34h5zm53-34h5v-3z"/>
    <path id="dtd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4617h5l53-34z"/>
   </g>
   <g id="dte" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dtf" transform="matrix(0 -.16 -.16 0 781.47 851.49)" d="m61.304-4.9064c1.8675 23.335-9.6743 45.706-29.773 57.708"/>
    <path id="dtg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4580-58 37"/>
    <path id="dth" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4582-57 38"/>
    <path id="dti" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4751v-4"/>
    <path id="dtj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4747h13v4"/>
    <path id="dtk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4912 4751h-13"/>
   </g>
   <path id="dtl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4830v5l-84-5zm0 5-84-5v5z" fill="#f0f" stroke="#f0f"/>
   <g id="dtm" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dtn" stroke-width="3">
     <path id="dto" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4835h-84"/>
     <path id="dtp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4815 4830h84"/>
     <path id="dtq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4835v3"/>
     <path id="dtr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4838h13v-4"/>
     <path id="dts" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4912 4834h-9v1h-4v-5"/>
     <path id="dtt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4815 4835v-5"/>
    </g>
    <path id="dtu" transform="matrix(-.16 0 0 .16 786.59 811.65)" d="m83.395 4.1771c-2.2257 44.436-38.903 79.323-83.395 79.323"/>
    <g id="dtv" stroke-width="3">
     <path id="dtw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4969 4661h-3"/>
     <path id="dtx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4966 4661v13h4"/>
     <path id="dty" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4970 4674v-9h-1v-4"/>
    </g>
   </g>
   <path id="dtz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5049 4661h4l-4-84zm4 0-4-84h4z" fill="#f0f" stroke="#f0f"/>
   <g id="dua" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dub" stroke-width="3">
     <path id="duc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 4661v-84"/>
     <path id="dud" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5049 4577v84"/>
     <path id="due" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 4661h3"/>
     <path id="duf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5056 4661v13h-4"/>
     <path id="dug" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5052 4674v-9h1v-4h-4"/>
     <path id="duh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 4577h-4"/>
    </g>
    <path id="dui" transform="matrix(0 -.16 -.16 0 811.23 839.49)" d="m0 83.5c-44.492 0-81.17-34.886-83.395-79.323"/>
   </g>
   <g id="duj" fill="#f0f" stroke="#f0f">
    <path id="duk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4346v-3h5z"/>
    <path id="dul" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4309h5l-58 34zm5 0-58 34h5z"/>
    <path id="dum" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4309 2-1h2zm2-1h2l-1-2z"/>
    <path id="dun" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4309h5l-1-1z"/>
   </g>
   <g id="duo" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dup" transform="matrix(0 -.16 -.16 0 379.23 890.85)" d="m-61.304 4.9122c-1.87-23.337 9.672-45.711 29.772-57.714"/>
    <path id="duq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4346 58-37"/>
    <path id="dur" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4344 57-38"/>
   </g>
   <g id="dus" fill="#f0f" stroke="#f0f">
    <path id="dut" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4241v-3h5z"/>
    <path id="duu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4204h5l-58 34zm5 0-58 34h5z"/>
    <path id="duv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4204 2-1h2zm2-1h2l-1-2z"/>
    <path id="duw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4204h5l-1-1z"/>
   </g>
   <g id="dux" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="duy" transform="matrix(0 -.16 -.16 0 379.23 907.65)" d="m-61.304 4.9122c-1.87-23.337 9.672-45.711 29.772-57.714"/>
    <path id="duz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4241 58-37"/>
    <path id="dva" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4239 57-38"/>
   </g>
   <g id="dvb" fill="#f0f" stroke="#f0f">
    <path id="dvc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4451v-3h5z"/>
    <path id="dvd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4414h5l-58 34zm5 0-58 34h5z"/>
    <path id="dve" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4414 2-2h2zm2-2h2l-1-1z"/>
    <path id="dvf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4414h5l-1-2z"/>
   </g>
   <g id="dvg" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dvh" transform="matrix(0 -.16 -.16 0 379.23 874.05)" d="m-61.304 4.9122c-1.87-23.337 9.672-45.711 29.772-57.714"/>
    <path id="dvi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4451 58-37"/>
    <path id="dvj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4449 57-38"/>
   </g>
   <g id="dvk" fill="#f0f" stroke="#f0f">
    <path id="dvl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4556v-3h5z"/>
    <path id="dvm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4519h5l-58 34zm5 0-58 34h5z"/>
    <path id="dvn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4519 2-2h2zm2-2h2l-1-1z"/>
    <path id="dvo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4519h5l-1-2z"/>
   </g>
   <g id="dvp" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dvq" transform="matrix(0 -.16 -.16 0 379.23 857.25)" d="m-61.304 4.9122c-1.87-23.337 9.672-45.711 29.772-57.714"/>
    <path id="dvr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4556 58-37"/>
    <path id="dvs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4554 57-38"/>
   </g>
   <g id="dvt" fill="#f0f" stroke="#f0f">
    <path id="dvu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2404 4620-1-2h2z"/>
    <path id="dvv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4617h5l-3 1zm5 0-3 1h2z"/>
    <path id="dvw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4617-53-34h5zm-53-34h5l-5-3z"/>
    <path id="dvx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4617h5l-53-34z"/>
   </g>
   <g id="dvy" fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
    <path id="dvz" transform="matrix(0 -.16 -.16 0 379.23 851.49)" d="m31.536-52.799c20.097 12.004 31.637 34.376 29.767 57.711"/>
    <path id="dwa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4580 58 37"/>
    <path id="dwb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4582 57 38"/>
    <path id="dwc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4751v-4"/>
    <path id="dwd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4747h-13v4"/>
    <path id="dwe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2308 4751h13"/>
   </g>
   <path id="dwf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4830v5l84-5zm0 5 84-5v5z" fill="#f0f" stroke="#f0f"/>
   <g id="dwg" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dwh" stroke-width="3">
     <path id="dwi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4835h84"/>
     <path id="dwj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2405 4830h-84"/>
     <path id="dwk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4835v3"/>
     <path id="dwl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4838h-13v-4"/>
     <path id="dwm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2308 4834h8v1h5v-5"/>
     <path id="dwn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2405 4835v-5"/>
    </g>
    <path id="dwo" transform="matrix(-.16 0 0 .16 374.11 811.65)" d="m0 83.5c-44.492 0-81.17-34.886-83.395-79.323"/>
    <g id="dwp" stroke-width="3">
     <path id="dwq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2251 4661h3"/>
     <path id="dwr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2254 4661v13h-4"/>
     <path id="dws" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2250 4674v-9h1v-4"/>
    </g>
   </g>
   <path id="dwt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2171 4661h-4l4-84zm-4 0 4-84h-4z" fill="#f0f" stroke="#f0f"/>
   <g id="dwu" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dwv" stroke-width="3">
     <path id="dww" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 4661v-84"/>
     <path id="dwx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2171 4577v84"/>
     <path id="dwy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 4661h-3"/>
     <path id="dwz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2164 4661v13h4"/>
     <path id="dxa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2168 4674v-9h-1v-4h4"/>
     <path id="dxb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 4577h4"/>
    </g>
    <g id="dxc">
     <path id="dxd" transform="matrix(0 .16 .16 0 349.47 839.49)" d="m83.395 4.1771c-2.2257 44.436-38.903 79.323-83.395 79.323"/>
     <path id="dxe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4988 6275v5h13v-5h-13"/>
     <path id="dxf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4994 6280 58 34-2 4-59-34 3-4"/>
     <path id="dxg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5050.8 6318.8c-9.605 18.366-28.796 29.694-49.517 29.23"/>
     <path id="dxh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4988 6352v-5h13v5h-13"/>
     <path id="dxi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4858 6275v5h-13v-5h13"/>
     <path id="dxj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 6280-58 34 2 4 59-34-3-4"/>
     <path id="dxk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4844.7 6348c-20.721 0.4649-39.912-10.863-49.517-29.23"/>
     <path id="dxl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4858 6352v-5h-13v5h13"/>
    </g>
   </g>
   <path id="dxm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3644 1388h4l-4 114zm4 0-4 114h4z" fill="#f0f" stroke="#f0f"/>
   <path id="dxn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3868 1388h4l-4 114zm4 0-4 114h4z" fill="#f0f" stroke="#f0f"/>
   <g id="dxo" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dxp" stroke-width="3">
     <path id="dxq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3644 1502v-114h4v114h-4"/>
     <path id="dxr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3644 1388h-5"/>
     <path id="dxs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3639 1388v-17h6"/>
     <path id="dxt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3645 1371v11h-1v6"/>
     <path id="dxu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3872 1502v-114h-4v114h4"/>
     <path id="dxv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3872 1388h4"/>
     <path id="dxw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 1388v-17h-5"/>
     <path id="dxx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3871 1371v11h1v6"/>
    </g>
    <path id="dxy" transform="matrix(0 -.16 -.16 0 622.75 1363.7)" d="m117.28 7.1377c-3.701 60.813-53.27 108.71-114.17 110.32"/>
    <path id="dxz" transform="matrix(0 -.16 -.16 0 585.31 1363.7)" d="m3.1201-117.46c60.904 1.6178 110.47 49.519 114.16 110.33"/>
    <g id="dya" stroke-width="3">
     <path id="dyb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3933 1390h-5"/>
     <path id="dyc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1390v-19h6"/>
     <path id="dyd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3934 1371v12h-1v7"/>
    </g>
   </g>
   <path id="dye" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4052 1390h6l-6 125zm6 0-6 125h6z" fill="#f0f" stroke="#f0f"/>
   <g id="dyf" fill="none" stroke="#f0f" stroke-linejoin="round">
    <g id="dyg" stroke-width="3">
     <path id="dyh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4058 1390v125"/>
     <path id="dyi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4052 1515v-125"/>
     <path id="dyj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4058 1390h5"/>
     <path id="dyk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4063 1390v-19h-6"/>
     <path id="dyl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4057 1371v12h1v7h-6"/>
     <path id="dym" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4058 1515h-6"/>
    </g>
    <path id="dyn" transform="matrix(0 -.16 -.16 0 652.03 1362.9)" d="m125.34 6.2782c-3.3453 66.788-58.471 119.22-125.34 119.22"/>
   </g>
  </g>
  <g id="dyo" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
   <path id="dyp" transform="matrix(0 -.16 -.16 0 392.35 542.85)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
   <path id="dyq" transform="matrix(0 -.16 -.16 0 392.51 549.89)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
   <path id="dyr" transform="matrix(0 -.16 -.16 0 396.19 538.69)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="dys" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6541v-13"/>
   <path id="dyt" transform="matrix(0 -.16 -.16 0 393.79 537.73)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
   <path id="dyu" transform="matrix(0 -.16 -.16 0 392.99 535.81)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
   <path id="dyv" transform="matrix(0 -.16 -.16 0 391.55 540.13)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
   <path id="dyw" transform="matrix(0 -.16 -.16 0 390.11 540.77)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
   <path id="dyx" transform="matrix(0 -.16 -.16 0 390.11 540.77)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
   <path id="dyy" transform="matrix(0 -.16 -.16 0 391.55 541.25)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
   <path id="dyz" transform="matrix(0 -.16 -.16 0 392.99 545.57)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
   <path id="dza" transform="matrix(0 -.16 -.16 0 393.79 543.81)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
   <path id="dzb" transform="matrix(0 -.16 -.16 0 392.35 538.53)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
   <path id="dzc" transform="matrix(0 -.16 -.16 0 392.51 531.49)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
   <path id="dzd" transform="matrix(0 -.16 -.16 0 396.19 542.69)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="dze" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6516v12"/>
   <path id="dzf" transform="matrix(0 -.16 -.16 0 398.27 537.41)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="dzg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6551h16"/>
   <path id="dzh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 6528v-26h-19"/>
   <path id="dzi" transform="matrix(0 -.16 -.16 0 398.59 544.29)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
   <path id="dzj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6506v7l-7-1"/>
   <path id="dzk" transform="matrix(0 -.16 -.16 0 398.27 543.97)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="dzl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6506h16"/>
   <path id="dzm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6545 7-1v7"/>
   <path id="dzn" transform="matrix(0 -.16 -.16 0 398.59 537.09)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
   <path id="dzo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2474 6555h19v-27"/>
   <path id="dzp" transform="matrix(0 -.16 -.16 0 396.35 538.69)" d="m-0.07507-4.4994c1.4954-0.02495 2.9054 0.69467 3.7626 1.9202"/>
   <path id="dzq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6541v-3"/>
   <path id="dzr" transform="matrix(0 -.16 -.16 0 411.07 481.73)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
   <path id="dzs" transform="matrix(0 -.16 -.16 0 397.31 539.33)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="dzt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6535h-1v-7"/>
   <path id="dzu" transform="matrix(0 -.16 -.16 0 396.99 541.41)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="dzv" transform="matrix(0 -.16 -.16 0 397.15 542.69)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
   <path id="dzw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6519"/>
   <path id="dzx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6528v-6h1"/>
   <path id="dzy" transform="matrix(0 -.16 -.16 0 397.31 542.05)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="dzz" transform="matrix(0 -.16 -.16 0 411.07 599.65)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
   <path id="eaa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6519v-3"/>
   <path id="eab" transform="matrix(0 -.16 -.16 0 396.35 542.69)" d="m-3.6876-2.5791c0.85718-1.2256 2.2672-1.9452 3.7626-1.9202"/>
   <path id="eac" transform="matrix(0 -.16 -.16 0 397.15 538.69)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
   <path id="ead" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6538"/>
   <path id="eae" transform="matrix(0 -.16 -.16 0 396.99 539.97)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="eaf" transform="matrix(0 -.16 -.16 0 396.35 542.69)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
   <path id="eag" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6536 2-1"/>
   <path id="eah" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6538h2"/>
   <path id="eai" transform="matrix(0 -.16 -.16 0 396.35 538.69)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
   <path id="eaj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 6540h-4"/>
   <path id="eak" transform="matrix(0 -.16 -.16 0 396.03 539.01)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="eal" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2457 6539 1-11v9"/>
   <path id="eam" transform="matrix(0 -.16 -.16 0 396.51 539.33)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="ean" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2458 6528v-8"/>
   <path id="eao" transform="matrix(0 -.16 -.16 0 396.51 542.05)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="eap" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 6517h-4"/>
   <path id="eaq" transform="matrix(0 -.16 -.16 0 396.03 542.37)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="ear" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2457 6518 1 10"/>
   <path id="eas" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6544v-31"/>
   <path id="eat" transform="matrix(0 -.16 -.16 0 392.35 560.77)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
   <path id="eau" transform="matrix(0 -.16 -.16 0 392.51 567.81)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
   <path id="eav" transform="matrix(0 -.16 -.16 0 396.19 556.61)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="eaw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6429v-13"/>
   <path id="eax" transform="matrix(0 -.16 -.16 0 393.79 555.65)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
   <path id="eay" transform="matrix(0 -.16 -.16 0 392.99 553.73)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
   <path id="eaz" transform="matrix(0 -.16 -.16 0 391.55 558.21)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
   <path id="eba" transform="matrix(0 -.16 -.16 0 390.11 558.69)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
   <path id="ebb" transform="matrix(0 -.16 -.16 0 390.11 558.69)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
   <path id="ebc" transform="matrix(0 -.16 -.16 0 391.55 559.17)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
   <path id="ebd" transform="matrix(0 -.16 -.16 0 392.99 563.65)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
   <path id="ebe" transform="matrix(0 -.16 -.16 0 393.79 561.73)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
   <path id="ebf" transform="matrix(0 -.16 -.16 0 392.35 556.45)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
   <path id="ebg" transform="matrix(0 -.16 -.16 0 392.51 549.41)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
   <path id="ebh" transform="matrix(0 -.16 -.16 0 396.19 560.61)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="ebi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6404v12"/>
   <path id="ebj" transform="matrix(0 -.16 -.16 0 398.27 555.49)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="ebk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6438h16"/>
   <path id="ebl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 6416v-27h-19"/>
   <path id="ebm" transform="matrix(0 -.16 -.16 0 398.59 562.21)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
   <path id="ebn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6394v7l-7-2"/>
   <path id="ebo" transform="matrix(0 -.16 -.16 0 398.27 561.89)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="ebp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6394h16"/>
   <path id="ebq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6433 7-2v8"/>
   <path id="ebr" transform="matrix(0 -.16 -.16 0 398.59 555.01)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
   <path id="ebs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2474 6443h19v-27"/>
   <path id="ebt" transform="matrix(0 -.16 -.16 0 396.35 556.61)" d="m-0.07507-4.4994c1.4954-0.02495 2.9054 0.69467 3.7626 1.9202"/>
   <path id="ebu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6429v-3"/>
   <path id="ebv" transform="matrix(0 -.16 -.16 0 411.07 499.65)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
   <path id="ebw" transform="matrix(0 -.16 -.16 0 397.31 557.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="ebx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6423h-1v-7"/>
   <path id="eby" transform="matrix(0 -.16 -.16 0 396.99 559.33)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="ebz" transform="matrix(0 -.16 -.16 0 397.15 560.61)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
   <path id="eca" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6407"/>
   <path id="ecb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6416v-7h1"/>
   <path id="ecc" transform="matrix(0 -.16 -.16 0 397.31 559.97)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="ecd" transform="matrix(0 -.16 -.16 0 411.07 617.73)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
   <path id="ece" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6406v-3"/>
   <path id="ecf" transform="matrix(0 -.16 -.16 0 396.35 560.77)" d="m-3.6876-2.5791c0.85718-1.2256 2.2672-1.9452 3.7626-1.9202"/>
   <path id="ecg" transform="matrix(0 -.16 -.16 0 397.15 556.77)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
   <path id="ech" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6425"/>
   <path id="eci" transform="matrix(0 -.16 -.16 0 396.99 558.05)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="ecj" transform="matrix(0 -.16 -.16 0 396.35 560.77)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
   <path id="eck" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6423h2"/>
   <path id="ecl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6425 2 1"/>
   <path id="ecm" transform="matrix(0 -.16 -.16 0 396.35 556.61)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
   <path id="ecn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 6427h-4"/>
   <path id="eco" transform="matrix(0 -.16 -.16 0 396.03 557.09)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="ecp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2457 6427 1-11v9"/>
   <path id="ecq" transform="matrix(0 -.16 -.16 0 396.51 557.25)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="ecr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2458 6416v-8"/>
   <path id="ecs" transform="matrix(0 -.16 -.16 0 396.51 559.97)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="ect" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 6405h-4"/>
   <path id="ecu" transform="matrix(0 -.16 -.16 0 396.03 560.29)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="ecv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2457 6406 1 10"/>
   <path id="ecw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6431v-30"/>
   <path id="ecx" transform="matrix(0 -.16 -.16 0 393.47 703.65)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="ecy" transform="matrix(0 -.16 -.16 0 393.47 697.41)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="ecz" transform="matrix(0 -.16 -.16 0 396.83 707.17)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="eda" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 5488v11"/>
   <path id="edb" transform="matrix(0 -.16 -.16 0 394.75 708.13)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="edc" transform="matrix(0 -.16 -.16 0 393.95 709.73)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="edd" transform="matrix(0 -.16 -.16 0 392.67 705.89)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="ede" transform="matrix(0 -.16 -.16 0 391.39 705.41)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="edf" transform="matrix(0 -.16 -.16 0 391.39 705.41)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="edg" transform="matrix(0 -.16 -.16 0 392.67 705.09)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="edh" transform="matrix(0 -.16 -.16 0 393.95 701.25)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="edi" transform="matrix(0 -.16 -.16 0 394.75 702.85)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="edj" transform="matrix(0 -.16 -.16 0 393.47 707.33)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="edk" transform="matrix(0 -.16 -.16 0 393.47 713.57)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="edl" transform="matrix(0 -.16 -.16 0 396.83 703.81)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="edm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 5509v-10"/>
   <path id="edn" transform="matrix(0 -.16 -.16 0 398.43 708.29)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="edo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 5479h15"/>
   <path id="edp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5499v23h-16"/>
   <path id="edq" transform="matrix(0 -.16 -.16 0 398.91 702.37)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="edr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 5518v-6l-6 1"/>
   <path id="eds" transform="matrix(0 -.16 -.16 0 398.43 702.69)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="edt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 5518h15"/>
   <path id="edu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 5484 6 1v-6"/>
   <path id="edv" transform="matrix(0 -.16 -.16 0 398.91 708.61)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="edw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 5475h16v24"/>
   <path id="edx" transform="matrix(0 -.16 -.16 0 396.83 707.33)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
   <path id="edy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 5487v3"/>
   <path id="edz" transform="matrix(0 -.16 -.16 0 409.63 756.77)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="eea" transform="matrix(0 -.16 -.16 0 397.63 706.69)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="eeb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 5492v7"/>
   <path id="eec" transform="matrix(0 -.16 -.16 0 397.47 704.93)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="eed" transform="matrix(0 -.16 -.16 0 397.63 703.81)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="eee" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 5506"/>
   <path id="eef" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 5499v6"/>
   <path id="eeg" transform="matrix(0 -.16 -.16 0 397.63 704.29)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="eeh" transform="matrix(0 -.16 -.16 0 409.63 654.21)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="eei" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 5507v3"/>
   <path id="eej" transform="matrix(0 -.16 -.16 0 396.83 703.65)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
   <path id="eek" transform="matrix(0 -.16 -.16 0 397.63 707.17)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="eel" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 5491"/>
   <path id="eem" transform="matrix(0 -.16 -.16 0 397.47 706.05)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="een" transform="matrix(0 -.16 -.16 0 396.83 703.65)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="eeo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 5492 1 1"/>
   <path id="eep" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 5490h2"/>
   <path id="eeq" transform="matrix(0 -.16 -.16 0 396.83 707.33)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="eer" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 5489h-3"/>
   <path id="ees" transform="matrix(0 -.16 -.16 0 396.67 706.85)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="eet" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 5489v10"/>
   <path id="eeu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 5499v-8"/>
   <path id="eev" transform="matrix(0 -.16 -.16 0 396.99 706.69)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="eew" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 5499v7"/>
   <path id="eex" transform="matrix(0 -.16 -.16 0 396.99 704.29)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="eey" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 5508h-3"/>
   <path id="eez" transform="matrix(0 -.16 -.16 0 396.67 703.97)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="efa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 5508v-9"/>
   <path id="efb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 5485v27"/>
   <path id="efc" transform="matrix(0 -.16 -.16 0 389.47 683.01)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="efd" transform="matrix(0 -.16 -.16 0 389.47 676.93)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="efe" transform="matrix(0 -.16 -.16 0 392.67 686.69)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="eff" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2441 5616v11"/>
   <path id="efg" transform="matrix(0 -.16 -.16 0 390.59 687.49)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="efh" transform="matrix(0 -.16 -.16 0 389.95 689.25)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="efi" transform="matrix(0 -.16 -.16 0 388.67 685.41)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="efj" transform="matrix(0 -.16 -.16 0 387.39 684.93)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="efk" transform="matrix(0 -.16 -.16 0 387.39 684.93)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="efl" transform="matrix(0 -.16 -.16 0 388.67 684.45)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="efm" transform="matrix(0 -.16 -.16 0 389.95 680.61)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="efn" transform="matrix(0 -.16 -.16 0 390.59 682.21)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="efo" transform="matrix(0 -.16 -.16 0 389.47 686.85)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="efp" transform="matrix(0 -.16 -.16 0 389.47 692.93)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="efq" transform="matrix(0 -.16 -.16 0 392.67 683.17)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="efr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2441 5638v-11"/>
   <path id="efs" transform="matrix(0 -.16 -.16 0 394.43 687.81)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="eft" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 5608h14"/>
   <path id="efu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 5627v23h-17"/>
   <path id="efv" transform="matrix(0 -.16 -.16 0 394.75 681.73)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="efw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2447 5647v-7l-7 2"/>
   <path id="efx" transform="matrix(0 -.16 -.16 0 394.43 682.05)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="efy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 5646h14"/>
   <path id="efz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2440 5613 7 1v-6"/>
   <path id="ega" transform="matrix(0 -.16 -.16 0 394.75 687.97)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="egb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2450 5604h17v23"/>
   <path id="egc" transform="matrix(0 -.16 -.16 0 392.83 686.69)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
   <path id="egd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2442 5616v3"/>
   <path id="ege" transform="matrix(0 -.16 -.16 0 405.63 736.29)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="egf" transform="matrix(0 -.16 -.16 0 393.63 686.05)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="egg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2443 5621h-1v6"/>
   <path id="egh" transform="matrix(0 -.16 -.16 0 393.31 684.29)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="egi" transform="matrix(0 -.16 -.16 0 393.47 683.17)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="egj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2443 5635"/>
   <path id="egk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2442 5627v6h1"/>
   <path id="egl" transform="matrix(0 -.16 -.16 0 393.63 683.81)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="egm" transform="matrix(0 -.16 -.16 0 405.63 633.57)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="egn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2442 5636v2"/>
   <path id="ego" transform="matrix(0 -.16 -.16 0 392.83 683.17)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
   <path id="egp" transform="matrix(0 -.16 -.16 0 393.47 686.53)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="egq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2443 5619"/>
   <path id="egr" transform="matrix(0 -.16 -.16 0 393.31 685.41)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="egs" transform="matrix(0 -.16 -.16 0 392.83 683.17)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="egt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2441 5621h1"/>
   <path id="egu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2441 5619h1"/>
   <path id="egv" transform="matrix(0 -.16 -.16 0 392.83 686.69)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="egw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2440 5617h-3"/>
   <path id="egx" transform="matrix(0 -.16 -.16 0 392.67 686.37)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="egy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2436 5618v9-7"/>
   <path id="egz" transform="matrix(0 -.16 -.16 0 392.99 686.05)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="eha" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2436 5627v8"/>
   <path id="ehb" transform="matrix(0 -.16 -.16 0 392.99 683.65)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="ehc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2440 5637h-3"/>
   <path id="ehd" transform="matrix(0 -.16 -.16 0 392.67 683.49)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="ehe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2436 5636v-9"/>
   <path id="ehf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2447 5614v26"/>
   <path id="ehg" transform="matrix(0 -.16 -.16 0 391.39 620.61)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="ehh" transform="matrix(0 -.16 -.16 0 391.39 614.53)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="ehi" transform="matrix(0 -.16 -.16 0 394.75 624.29)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="ehj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 6006v11"/>
   <path id="ehk" transform="matrix(0 -.16 -.16 0 392.67 625.25)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="ehl" transform="matrix(0 -.16 -.16 0 391.87 626.85)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="ehm" transform="matrix(0 -.16 -.16 0 390.59 623.01)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="ehn" transform="matrix(0 -.16 -.16 0 389.31 622.53)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="eho" transform="matrix(0 -.16 -.16 0 389.31 622.53)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="ehp" transform="matrix(0 -.16 -.16 0 390.59 622.05)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="ehq" transform="matrix(0 -.16 -.16 0 391.87 618.21)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="ehr" transform="matrix(0 -.16 -.16 0 392.67 619.97)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="ehs" transform="matrix(0 -.16 -.16 0 391.39 624.45)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="eht" transform="matrix(0 -.16 -.16 0 391.39 630.53)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="ehu" transform="matrix(0 -.16 -.16 0 394.75 620.77)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="ehv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 6028v-11"/>
   <path id="ehw" transform="matrix(0 -.16 -.16 0 396.35 625.41)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="ehx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 5998h14"/>
   <path id="ehy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2479 6017v23h-16"/>
   <path id="ehz" transform="matrix(0 -.16 -.16 0 396.83 619.49)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="eia" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2459 6036v-6l-6 1"/>
   <path id="eib" transform="matrix(0 -.16 -.16 0 396.35 619.65)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="eic" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 6036h14"/>
   <path id="eid" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 6002 6 2v-7"/>
   <path id="eie" transform="matrix(0 -.16 -.16 0 396.83 625.73)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="eif" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 5994h16v23"/>
   <path id="eig" transform="matrix(0 -.16 -.16 0 394.91 624.29)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
   <path id="eih" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2454 6006v2"/>
   <path id="eii" transform="matrix(0 -.16 -.16 0 407.55 673.89)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="eij" transform="matrix(0 -.16 -.16 0 395.55 623.65)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="eik" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 6011h-1v6"/>
   <path id="eil" transform="matrix(0 -.16 -.16 0 395.39 622.05)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="eim" transform="matrix(0 -.16 -.16 0 395.55 620.93)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="ein" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 6025"/>
   <path id="eio" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2455 6017v6h1"/>
   <path id="eip" transform="matrix(0 -.16 -.16 0 395.55 621.41)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="eiq" transform="matrix(0 -.16 -.16 0 407.55 571.17)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="eir" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2454 6025v3"/>
   <path id="eis" transform="matrix(0 -.16 -.16 0 394.91 620.77)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
   <path id="eit" transform="matrix(0 -.16 -.16 0 395.55 624.29)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="eiu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 6009"/>
   <path id="eiv" transform="matrix(0 -.16 -.16 0 395.39 623.17)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="eiw" transform="matrix(0 -.16 -.16 0 394.91 620.77)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="eix" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 6011h2"/>
   <path id="eiy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 6009 2-1"/>
   <path id="eiz" transform="matrix(0 -.16 -.16 0 394.91 624.29)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="eja" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2452 6007h-3"/>
   <path id="ejb" transform="matrix(0 -.16 -.16 0 394.59 623.97)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="ejc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 6008v9"/>
   <path id="ejd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2449 6017v-8"/>
   <path id="eje" transform="matrix(0 -.16 -.16 0 394.91 623.81)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="ejf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2449 6017v7"/>
   <path id="ejg" transform="matrix(0 -.16 -.16 0 394.91 621.41)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="ejh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2452 6027h-3"/>
   <path id="eji" transform="matrix(0 -.16 -.16 0 394.59 621.09)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="ejj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 6026v-9"/>
   <path id="ejk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2459 6004v26"/>
   <path id="ejl" transform="matrix(0 .16 .16 0 347.87 701.09)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="ejm" transform="matrix(0 .16 .16 0 347.71 695.01)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="ejn" transform="matrix(0 .16 .16 0 344.51 704.77)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="ejo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 5503v11"/>
   <path id="ejp" transform="matrix(0 .16 .16 0 346.59 705.57)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="ejq" transform="matrix(0 .16 .16 0 347.23 707.33)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="ejr" transform="matrix(0 .16 .16 0 348.51 703.49)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="ejs" transform="matrix(0 .16 .16 0 349.79 703.01)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="ejt" transform="matrix(0 .16 .16 0 349.79 703.01)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="eju" transform="matrix(0 .16 .16 0 348.51 702.53)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="ejv" transform="matrix(0 .16 .16 0 347.23 698.69)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="ejw" transform="matrix(0 .16 .16 0 346.59 700.29)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="ejx" transform="matrix(0 .16 .16 0 347.87 704.93)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="ejy" transform="matrix(0 .16 .16 0 347.71 711.01)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="ejz" transform="matrix(0 .16 .16 0 344.51 701.25)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="eka" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 5525v-11"/>
   <path id="ekb" transform="matrix(0 .16 .16 0 342.75 705.89)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="ekc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 5495h-14"/>
   <path id="ekd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 5514v23h16"/>
   <path id="eke" transform="matrix(0 .16 .16 0 342.43 699.81)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="ekf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 5534v-7l6 2"/>
   <path id="ekg" transform="matrix(0 .16 .16 0 342.75 700.13)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="ekh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 5533h-14"/>
   <path id="eki" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 5500-6 1v-6"/>
   <path id="ekj" transform="matrix(0 .16 .16 0 342.43 706.05)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="ekk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2123 5491h-16v23"/>
   <path id="ekl" transform="matrix(0 .16 .16 0 344.35 704.77)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
   <path id="ekm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131 5503v3"/>
   <path id="ekn" transform="matrix(0 .16 .16 0 331.71 754.37)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="eko" transform="matrix(0 .16 .16 0 343.71 704.13)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="ekp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130 5508h1v6"/>
   <path id="ekq" transform="matrix(0 .16 .16 0 343.87 702.37)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="ekr" transform="matrix(0 .16 .16 0 343.71 701.25)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="eks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130 5522"/>
   <path id="ekt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131 5514v6h-1"/>
   <path id="eku" transform="matrix(0 .16 .16 0 343.71 701.89)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="ekv" transform="matrix(0 .16 .16 0 331.71 651.65)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="ekw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131 5523v2"/>
   <path id="ekx" transform="matrix(0 .16 .16 0 344.35 701.25)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
   <path id="eky" transform="matrix(0 .16 .16 0 343.71 704.61)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="ekz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130 5506"/>
   <path id="ela" transform="matrix(0 .16 .16 0 343.87 703.49)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="elb" transform="matrix(0 .16 .16 0 344.35 701.25)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="elc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 5508h-1"/>
   <path id="eld" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 5506h-2"/>
   <path id="ele" transform="matrix(0 .16 .16 0 344.35 704.77)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="elf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 5504h3"/>
   <path id="elg" transform="matrix(0 .16 .16 0 344.67 704.45)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="elh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 5505v9"/>
   <path id="eli" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2137 5514v-7"/>
   <path id="elj" transform="matrix(0 .16 .16 0 344.35 704.13)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="elk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2137 5514v8"/>
   <path id="ell" transform="matrix(0 .16 .16 0 344.35 701.73)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="elm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 5524h3"/>
   <path id="eln" transform="matrix(0 .16 .16 0 344.67 701.57)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="elo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 5523v-9"/>
   <path id="elp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 5501v26"/>
   <path id="elq" transform="matrix(0 .16 .16 0 768.19 542.21)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
   <path id="elr" transform="matrix(0 .16 .16 0 768.19 549.25)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
   <path id="els" transform="matrix(0 .16 .16 0 764.35 538.05)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="elt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6545v-13"/>
   <path id="elu" transform="matrix(0 .16 .16 0 766.75 537.09)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
   <path id="elv" transform="matrix(0 .16 .16 0 767.71 535.17)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
   <path id="elw" transform="matrix(0 .16 .16 0 769.15 539.65)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
   <path id="elx" transform="matrix(0 .16 .16 0 770.59 540.13)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
   <path id="ely" transform="matrix(0 .16 .16 0 770.59 540.13)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
   <path id="elz" transform="matrix(0 .16 .16 0 769.15 540.61)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
   <path id="ema" transform="matrix(0 .16 .16 0 767.71 544.93)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
   <path id="emb" transform="matrix(0 .16 .16 0 766.75 543.17)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
   <path id="emc" transform="matrix(0 .16 .16 0 768.19 537.89)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
   <path id="emd" transform="matrix(0 .16 .16 0 768.19 530.85)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
   <path id="eme" transform="matrix(0 .16 .16 0 764.35 542.05)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="emf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6520v12"/>
   <path id="emg" transform="matrix(0 .16 .16 0 762.43 536.93)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="emh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 6554h-16"/>
   <path id="emi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6532v-27h19"/>
   <path id="emj" transform="matrix(0 .16 .16 0 762.11 543.65)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
   <path id="emk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4750 6510v7l7-1"/>
   <path id="eml" transform="matrix(0 .16 .16 0 762.43 543.33)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="emm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 6510h-16"/>
   <path id="emn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6549-7-2v8"/>
   <path id="emo" transform="matrix(0 .16 .16 0 762.11 536.45)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
   <path id="emp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 6559h-19v-27"/>
   <path id="emq" transform="matrix(0 .16 .16 0 764.35 538.05)" d="m-3.6873-2.5795c0.8573-1.2255 2.2674-1.945 3.7628-1.9199"/>
   <path id="emr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6545v-3"/>
   <path id="ems" transform="matrix(0 .16 .16 0 749.63 481.09)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
   <path id="emt" transform="matrix(0 .16 .16 0 763.39 538.85)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="emu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 6539h1v-7"/>
   <path id="emv" transform="matrix(0 .16 .16 0 763.71 540.77)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="emw" transform="matrix(0 .16 .16 0 763.55 542.05)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
   <path id="emx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 6523"/>
   <path id="emy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6532v-6l-1-1"/>
   <path id="emz" transform="matrix(0 .16 .16 0 763.39 541.41)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="ena" transform="matrix(0 .16 .16 0 749.63 599.17)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
   <path id="enb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6522v-3"/>
   <path id="enc" transform="matrix(0 .16 .16 0 764.35 542.21)" d="m-0.07463-4.4994c1.4954-0.02481 2.9054 0.69495 3.7624 1.9206"/>
   <path id="end" transform="matrix(0 .16 .16 0 763.55 538.21)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
   <path id="ene" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 6541"/>
   <path id="enf" transform="matrix(0 .16 .16 0 763.71 539.49)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="eng" transform="matrix(0 .16 .16 0 764.35 542.21)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
   <path id="enh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4756 6539h-1"/>
   <path id="eni" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6542h-2"/>
   <path id="enj" transform="matrix(0 .16 .16 0 764.35 538.05)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
   <path id="enk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 6544h3"/>
   <path id="enl" transform="matrix(0 .16 .16 0 764.51 538.37)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="enm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4762 6543v-11 9"/>
   <path id="enn" transform="matrix(0 .16 .16 0 764.19 538.69)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="eno" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4762 6532v-8"/>
   <path id="enp" transform="matrix(0 .16 .16 0 764.19 541.41)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="enq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 6521h3"/>
   <path id="enr" transform="matrix(0 .16 .16 0 764.51 541.73)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="ens" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4762 6522v10"/>
   <path id="ent" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4750 6547v-30"/>
   <path id="enu" transform="matrix(0 .16 .16 0 768.35 560.45)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
   <path id="env" transform="matrix(0 .16 .16 0 768.35 567.49)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
   <path id="enw" transform="matrix(0 .16 .16 0 764.51 556.29)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="enx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6431v-13"/>
   <path id="eny" transform="matrix(0 .16 .16 0 766.91 555.33)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
   <path id="enz" transform="matrix(0 .16 .16 0 767.71 553.41)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
   <path id="eoa" transform="matrix(0 .16 .16 0 769.31 557.89)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
   <path id="eob" transform="matrix(0 .16 .16 0 770.75 558.37)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
   <path id="eoc" transform="matrix(0 .16 .16 0 770.75 558.37)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
   <path id="eod" transform="matrix(0 .16 .16 0 769.31 558.85)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
   <path id="eoe" transform="matrix(0 .16 .16 0 767.71 563.17)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
   <path id="eof" transform="matrix(0 .16 .16 0 766.91 561.41)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
   <path id="eog" transform="matrix(0 .16 .16 0 768.35 556.13)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
   <path id="eoh" transform="matrix(0 .16 .16 0 768.35 549.09)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
   <path id="eoi" transform="matrix(0 .16 .16 0 764.51 560.29)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="eoj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6406v12"/>
   <path id="eok" transform="matrix(0 .16 .16 0 762.59 555.01)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="eol" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4749 6440h-17"/>
   <path id="eom" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6418v-26h19"/>
   <path id="eon" transform="matrix(0 .16 .16 0 762.11 561.89)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
   <path id="eoo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 6396v7l7-1"/>
   <path id="eop" transform="matrix(0 .16 .16 0 762.59 561.57)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="eoq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4749 6396h-17"/>
   <path id="eor" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 6435-7-1v7"/>
   <path id="eos" transform="matrix(0 .16 .16 0 762.11 554.69)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
   <path id="eot" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 6445h-19v-27"/>
   <path id="eou" transform="matrix(0 .16 .16 0 764.35 556.29)" d="m-3.6873-2.5795c0.8573-1.2255 2.2674-1.945 3.7628-1.9199"/>
   <path id="eov" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4756 6431v-3"/>
   <path id="eow" transform="matrix(0 .16 .16 0 749.79 499.33)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
   <path id="eox" transform="matrix(0 .16 .16 0 763.55 556.93)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="eoy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6425h1v-7"/>
   <path id="eoz" transform="matrix(0 .16 .16 0 763.87 559.01)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="epa" transform="matrix(0 .16 .16 0 763.71 560.29)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
   <path id="epb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6409"/>
   <path id="epc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4756 6418v-6l-1-1"/>
   <path id="epd" transform="matrix(0 .16 .16 0 763.55 559.65)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="epe" transform="matrix(0 .16 .16 0 749.79 617.41)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
   <path id="epf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4756 6409v-4"/>
   <path id="epg" transform="matrix(0 .16 .16 0 764.35 560.45)" d="m-0.07463-4.4994c1.4954-0.02481 2.9054 0.69495 3.7624 1.9206"/>
   <path id="eph" transform="matrix(0 .16 .16 0 763.71 556.45)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
   <path id="epi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6427"/>
   <path id="epj" transform="matrix(0 .16 .16 0 763.87 557.73)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="epk" transform="matrix(0 .16 .16 0 764.35 560.45)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
   <path id="epl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6426-1-1"/>
   <path id="epm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6428h-1"/>
   <path id="epn" transform="matrix(0 .16 .16 0 764.35 556.29)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
   <path id="epo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 6430h4"/>
   <path id="epp" transform="matrix(0 .16 .16 0 764.67 556.61)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="epq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 6429v-11"/>
   <path id="epr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4762 6418v9"/>
   <path id="eps" transform="matrix(0 .16 .16 0 764.35 556.93)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="ept" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4762 6418v-8"/>
   <path id="epu" transform="matrix(0 .16 .16 0 764.35 559.65)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="epv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 6407h4"/>
   <path id="epw" transform="matrix(0 .16 .16 0 764.67 559.97)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="epx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 6408v10"/>
   <path id="epy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 6434v-31"/>
   <path id="epz" transform="matrix(0 .16 .16 0 769.31 620.61)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="eqa" transform="matrix(0 .16 .16 0 769.15 614.53)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="eqb" transform="matrix(0 .16 .16 0 765.95 624.29)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="eqc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 6006v11"/>
   <path id="eqd" transform="matrix(0 .16 .16 0 768.03 625.25)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="eqe" transform="matrix(0 .16 .16 0 768.83 626.85)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="eqf" transform="matrix(0 .16 .16 0 770.11 623.01)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="eqg" transform="matrix(0 .16 .16 0 771.23 622.53)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="eqh" transform="matrix(0 .16 .16 0 771.23 622.53)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="eqi" transform="matrix(0 .16 .16 0 770.11 622.05)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="eqj" transform="matrix(0 .16 .16 0 768.83 618.21)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="eqk" transform="matrix(0 .16 .16 0 768.03 619.97)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="eql" transform="matrix(0 .16 .16 0 769.31 624.45)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="eqm" transform="matrix(0 .16 .16 0 769.15 630.53)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="eqn" transform="matrix(0 .16 .16 0 765.95 620.77)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="eqo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 6028v-11"/>
   <path id="eqp" transform="matrix(0 .16 .16 0 764.19 625.41)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="eqq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 5998h-14"/>
   <path id="eqr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 6017v23h16"/>
   <path id="eqs" transform="matrix(0 .16 .16 0 763.87 619.49)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="eqt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4761 6036v-6l6 1"/>
   <path id="equ" transform="matrix(0 .16 .16 0 764.19 619.65)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="eqv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 6036h-14"/>
   <path id="eqw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 6002-6 2v-7"/>
   <path id="eqx" transform="matrix(0 .16 .16 0 763.87 625.73)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="eqy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 5994h-16v23"/>
   <path id="eqz" transform="matrix(0 .16 .16 0 765.79 624.29)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
   <path id="era" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 6006v2"/>
   <path id="erb" transform="matrix(0 .16 .16 0 753.15 673.89)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="erc" transform="matrix(0 .16 .16 0 765.15 623.65)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="erd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 6011h1v6"/>
   <path id="ere" transform="matrix(0 .16 .16 0 765.31 622.05)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="erf" transform="matrix(0 .16 .16 0 765.15 620.93)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="erg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 6025"/>
   <path id="erh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 6017v6h-1"/>
   <path id="eri" transform="matrix(0 .16 .16 0 765.15 621.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="erj" transform="matrix(0 .16 .16 0 753.15 571.17)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="erk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 6025v3"/>
   <path id="erl" transform="matrix(0 .16 .16 0 765.79 620.77)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
   <path id="erm" transform="matrix(0 .16 .16 0 765.15 624.29)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="ern" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 6009"/>
   <path id="ero" transform="matrix(0 .16 .16 0 765.31 623.17)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="erp" transform="matrix(0 .16 .16 0 765.79 620.77)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="erq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 6011h-2"/>
   <path id="err" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 6009-2-1"/>
   <path id="ers" transform="matrix(0 .16 .16 0 765.79 624.29)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="ert" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4768 6007h3"/>
   <path id="eru" transform="matrix(0 .16 .16 0 766.11 623.97)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="erv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4772 6008v9"/>
   <path id="erw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4771 6017v-8"/>
   <path id="erx" transform="matrix(0 .16 .16 0 765.79 623.81)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="ery" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4771 6017v7"/>
   <path id="erz" transform="matrix(0 .16 .16 0 765.79 621.41)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="esa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4768 6027h3"/>
   <path id="esb" transform="matrix(0 .16 .16 0 766.11 621.09)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="esc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4772 6026v-9"/>
   <path id="esd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4761 6004v26"/>
   <path id="ese" transform="matrix(0 -.16 -.16 0 812.83 701.09)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="esf" transform="matrix(0 -.16 -.16 0 812.83 695.01)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="esg" transform="matrix(0 -.16 -.16 0 816.19 704.77)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="esh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 5503v11"/>
   <path id="esi" transform="matrix(0 -.16 -.16 0 814.11 705.57)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="esj" transform="matrix(0 -.16 -.16 0 813.31 707.33)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="esk" transform="matrix(0 -.16 -.16 0 812.03 703.49)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="esl" transform="matrix(0 -.16 -.16 0 810.75 703.01)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="esm" transform="matrix(0 -.16 -.16 0 810.75 703.01)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="esn" transform="matrix(0 -.16 -.16 0 812.03 702.53)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="eso" transform="matrix(0 -.16 -.16 0 813.31 698.69)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="esp" transform="matrix(0 -.16 -.16 0 814.11 700.29)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="esq" transform="matrix(0 -.16 -.16 0 812.83 704.93)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="esr" transform="matrix(0 -.16 -.16 0 812.83 711.01)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="ess" transform="matrix(0 -.16 -.16 0 816.19 701.25)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="est" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 5525v-11"/>
   <path id="esu" transform="matrix(0 -.16 -.16 0 817.79 705.89)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="esv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 5495h14"/>
   <path id="esw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5514v23h-16"/>
   <path id="esx" transform="matrix(0 -.16 -.16 0 818.27 699.81)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="esy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 5534v-7l-6 2"/>
   <path id="esz" transform="matrix(0 -.16 -.16 0 817.79 700.13)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="eta" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 5533h14"/>
   <path id="etb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 5500 6 1v-6"/>
   <path id="etc" transform="matrix(0 -.16 -.16 0 818.27 706.05)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="etd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 5491h16v23"/>
   <path id="ete" transform="matrix(0 -.16 -.16 0 816.35 704.77)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
   <path id="etf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5089 5503-1 3"/>
   <path id="etg" transform="matrix(0 -.16 -.16 0 828.99 754.37)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="eth" transform="matrix(0 -.16 -.16 0 816.99 704.13)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="eti" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 5508h-1v6"/>
   <path id="etj" transform="matrix(0 -.16 -.16 0 816.83 702.37)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="etk" transform="matrix(0 -.16 -.16 0 816.99 701.25)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="etl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 5522"/>
   <path id="etm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5089 5514v6h1"/>
   <path id="etn" transform="matrix(0 -.16 -.16 0 816.99 701.89)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="eto" transform="matrix(0 -.16 -.16 0 828.99 651.65)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="etp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 5523 1 2"/>
   <path id="etq" transform="matrix(0 -.16 -.16 0 816.35 701.25)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
   <path id="etr" transform="matrix(0 -.16 -.16 0 816.99 704.61)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="ets" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 5506"/>
   <path id="ett" transform="matrix(0 -.16 -.16 0 816.83 703.49)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="etu" transform="matrix(0 -.16 -.16 0 816.35 701.25)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="etv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 5508h2"/>
   <path id="etw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 5506h2"/>
   <path id="etx" transform="matrix(0 -.16 -.16 0 816.35 704.77)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="ety" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 5504h-3"/>
   <path id="etz" transform="matrix(0 -.16 -.16 0 816.03 704.45)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="eua" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 5505v9"/>
   <path id="eub" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5083 5514v-7"/>
   <path id="euc" transform="matrix(0 -.16 -.16 0 816.35 704.13)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="eud" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5083 5514v8"/>
   <path id="eue" transform="matrix(0 -.16 -.16 0 816.35 701.73)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="euf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 5524h-3"/>
   <path id="eug" transform="matrix(0 -.16 -.16 0 816.03 701.57)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="euh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 5523v-9"/>
   <path id="eui" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 5501v26"/>
   <path id="euj" transform="matrix(0 .16 .16 0 769.31 827.17)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="euk" transform="matrix(0 .16 .16 0 769.15 821.09)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="eul" transform="matrix(0 .16 .16 0 765.95 830.85)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="eum" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 4715v11"/>
   <path id="eun" transform="matrix(0 .16 .16 0 768.03 831.65)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="euo" transform="matrix(0 .16 .16 0 768.83 833.41)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="eup" transform="matrix(0 .16 .16 0 770.11 829.57)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="euq" transform="matrix(0 .16 .16 0 771.23 829.09)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="eur" transform="matrix(0 .16 .16 0 771.23 829.09)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="eus" transform="matrix(0 .16 .16 0 770.11 828.61)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="eut" transform="matrix(0 .16 .16 0 768.83 824.77)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="euu" transform="matrix(0 .16 .16 0 768.03 826.37)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="euv" transform="matrix(0 .16 .16 0 769.31 831.01)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="euw" transform="matrix(0 .16 .16 0 769.15 837.09)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="eux" transform="matrix(0 .16 .16 0 765.95 827.33)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="euy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 4737v-11"/>
   <path id="euz" transform="matrix(0 .16 .16 0 764.19 831.97)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="eva" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4707h-14"/>
   <path id="evb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 4726v23h16"/>
   <path id="evc" transform="matrix(0 .16 .16 0 763.87 825.89)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="evd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4761 4746v-7l6 2"/>
   <path id="eve" transform="matrix(0 .16 .16 0 764.19 826.21)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="evf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4745h-14"/>
   <path id="evg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 4712-6 1v-6"/>
   <path id="evh" transform="matrix(0 .16 .16 0 763.87 832.13)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="evi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 4703h-16v23"/>
   <path id="evj" transform="matrix(0 .16 .16 0 765.79 830.85)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
   <path id="evk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 4715v3"/>
   <path id="evl" transform="matrix(0 .16 .16 0 753.15 880.45)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="evm" transform="matrix(0 .16 .16 0 765.15 830.21)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="evn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 4720h1v6"/>
   <path id="evo" transform="matrix(0 .16 .16 0 765.31 828.45)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="evp" transform="matrix(0 .16 .16 0 765.15 827.33)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="evq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 4734"/>
   <path id="evr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 4726v6h-1"/>
   <path id="evs" transform="matrix(0 .16 .16 0 765.15 827.97)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="evt" transform="matrix(0 .16 .16 0 753.15 777.73)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="evu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 4735v2"/>
   <path id="evv" transform="matrix(0 .16 .16 0 765.79 827.33)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
   <path id="evw" transform="matrix(0 .16 .16 0 765.15 830.69)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="evx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 4718"/>
   <path id="evy" transform="matrix(0 .16 .16 0 765.31 829.57)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="evz" transform="matrix(0 .16 .16 0 765.79 827.33)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="ewa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 4720h-2"/>
   <path id="ewb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 4718h-2"/>
   <path id="ewc" transform="matrix(0 .16 .16 0 765.79 830.85)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="ewd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4768 4716h3"/>
   <path id="ewe" transform="matrix(0 .16 .16 0 766.11 830.53)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="ewf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4772 4717v9"/>
   <path id="ewg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4771 4726v-7"/>
   <path id="ewh" transform="matrix(0 .16 .16 0 765.79 830.21)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="ewi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4771 4726v8"/>
   <path id="ewj" transform="matrix(0 .16 .16 0 765.79 827.81)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="ewk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4768 4736h3"/>
   <path id="ewl" transform="matrix(0 .16 .16 0 766.11 827.65)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="ewm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4772 4735v-9"/>
   <path id="ewn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4761 4713v26"/>
   <path id="ewo" transform="matrix(0 .16 .16 0 767.23 897.57)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="ewp" transform="matrix(0 .16 .16 0 767.23 903.65)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="ewq" transform="matrix(0 .16 .16 0 763.87 893.89)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="ewr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4321v-11"/>
   <path id="ews" transform="matrix(0 .16 .16 0 765.95 892.93)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="ewt" transform="matrix(0 .16 .16 0 766.75 891.33)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="ewu" transform="matrix(0 .16 .16 0 768.03 895.17)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="ewv" transform="matrix(0 .16 .16 0 769.15 895.65)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="eww" transform="matrix(0 .16 .16 0 769.15 895.65)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="ewx" transform="matrix(0 .16 .16 0 768.03 896.13)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="ewy" transform="matrix(0 .16 .16 0 766.75 899.97)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="ewz" transform="matrix(0 .16 .16 0 765.95 898.21)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="exa" transform="matrix(0 .16 .16 0 767.23 893.73)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="exb" transform="matrix(0 .16 .16 0 767.23 887.65)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="exc" transform="matrix(0 .16 .16 0 763.87 897.41)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="exd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4299v11"/>
   <path id="exe" transform="matrix(0 .16 .16 0 762.11 892.77)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="exf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4329h-14"/>
   <path id="exg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 4310v-23h16"/>
   <path id="exh" transform="matrix(0 .16 .16 0 761.79 898.69)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="exi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4291v6l6-1"/>
   <path id="exj" transform="matrix(0 .16 .16 0 762.11 898.53)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="exk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4291h-14"/>
   <path id="exl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4325-6-2v7"/>
   <path id="exm" transform="matrix(0 .16 .16 0 761.79 892.45)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="exn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4744 4333h-16v-23"/>
   <path id="exo" transform="matrix(0 .16 .16 0 763.71 893.89)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
   <path id="exp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4321v-2"/>
   <path id="exq" transform="matrix(0 .16 .16 0 751.07 844.29)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="exr" transform="matrix(0 .16 .16 0 763.07 894.53)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="exs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4316h1v-6"/>
   <path id="ext" transform="matrix(0 .16 .16 0 763.23 896.13)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="exu" transform="matrix(0 .16 .16 0 763.07 897.25)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="exv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4302"/>
   <path id="exw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4310v-6h-1"/>
   <path id="exx" transform="matrix(0 .16 .16 0 763.07 896.77)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="exy" transform="matrix(0 .16 .16 0 751.07 947.01)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="exz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4302v-3"/>
   <path id="eya" transform="matrix(0 .16 .16 0 763.71 897.41)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
   <path id="eyb" transform="matrix(0 .16 .16 0 763.07 893.89)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="eyc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4318"/>
   <path id="eyd" transform="matrix(0 .16 .16 0 763.23 895.01)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="eye" transform="matrix(0 .16 .16 0 763.71 897.41)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="eyf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4316h-2"/>
   <path id="eyg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4318-2 1"/>
   <path id="eyh" transform="matrix(0 .16 .16 0 763.71 893.89)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="eyi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4320h3"/>
   <path id="eyj" transform="matrix(0 .16 .16 0 764.03 894.21)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="eyk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4319v-9"/>
   <path id="eyl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4310v8"/>
   <path id="eym" transform="matrix(0 .16 .16 0 763.71 894.37)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="eyn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4310v-7"/>
   <path id="eyo" transform="matrix(0 .16 .16 0 763.71 896.77)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="eyp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4300h3"/>
   <path id="eyq" transform="matrix(0 .16 .16 0 764.03 897.09)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="eyr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4301v9"/>
   <path id="eys" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4323v-26"/>
   <path id="eyt" transform="matrix(-.16 0 0 .16 439.55 330.21)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
   <path id="eyu" transform="matrix(-.16 0 0 .16 446.59 330.21)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
   <path id="eyv" transform="matrix(-.16 0 0 .16 435.39 326.37)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="eyw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2704 7872h13"/>
   <path id="eyx" transform="matrix(-.16 0 0 .16 434.43 328.77)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
   <path id="eyy" transform="matrix(-.16 0 0 .16 432.51 329.57)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
   <path id="eyz" transform="matrix(-.16 0 0 .16 436.99 331.01)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
   <path id="eza" transform="matrix(-.16 0 0 .16 437.47 332.45)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
   <path id="ezb" transform="matrix(-.16 0 0 .16 437.47 332.45)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
   <path id="ezc" transform="matrix(-.16 0 0 .16 437.95 331.01)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
   <path id="ezd" transform="matrix(-.16 0 0 .16 442.27 329.57)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
   <path id="eze" transform="matrix(-.16 0 0 .16 440.51 328.77)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
   <path id="ezf" transform="matrix(-.16 0 0 .16 435.23 330.21)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
   <path id="ezg" transform="matrix(-.16 0 0 .16 428.19 330.21)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
   <path id="ezh" transform="matrix(-.16 0 0 .16 439.39 326.37)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="ezi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2729 7872h-12"/>
   <path id="ezj" transform="matrix(-.16 0 0 .16 434.27 324.45)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="ezk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2695 7880v17"/>
   <path id="ezl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2717 7902h27v-19"/>
   <path id="ezm" transform="matrix(-.16 0 0 .16 440.99 323.97)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
   <path id="ezn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2739 7879h-7l1-8"/>
   <path id="ezo" transform="matrix(-.16 0 0 .16 440.67 324.45)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="ezp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2739 7880v17"/>
   <path id="ezq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2700 7871 2 8h-8"/>
   <path id="ezr" transform="matrix(-.16 0 0 .16 433.79 323.97)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
   <path id="ezs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2690 7883v19h27"/>
   <path id="ezt" transform="matrix(-.16 0 0 .16 435.39 326.21)" d="m-0.07507-4.4994c1.4954-0.02495 2.9054 0.69467 3.7626 1.9202"/>
   <path id="ezu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2704 7873h3"/>
   <path id="ezv" transform="matrix(-.16 0 0 .16 378.43 311.65)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
   <path id="ezw" transform="matrix(-.16 0 0 .16 436.19 325.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="ezx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2710 7875v-2h7"/>
   <path id="ezy" transform="matrix(-.16 0 0 .16 438.11 325.57)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="ezz" transform="matrix(-.16 0 0 .16 439.39 325.41)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
   <path id="faa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2726 7875"/>
   <path id="fab" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2717 7873h6l1 2"/>
   <path id="fac" transform="matrix(-.16 0 0 .16 438.75 325.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="fad" transform="matrix(-.16 0 0 .16 496.51 311.65)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
   <path id="fae" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2727 7873h3"/>
   <path id="faf" transform="matrix(-.16 0 0 .16 439.55 326.21)" d="m-3.6876-2.5791c0.85718-1.2256 2.2672-1.9452 3.7626-1.9202"/>
   <path id="fag" transform="matrix(-.16 0 0 .16 435.55 325.41)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
   <path id="fah" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2708 7875"/>
   <path id="fai" transform="matrix(-.16 0 0 .16 436.83 325.57)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="faj" transform="matrix(-.16 0 0 .16 439.55 326.21)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
   <path id="fak" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2710 7872v1"/>
   <path id="fal" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2707 7872v1"/>
   <path id="fam" transform="matrix(-.16 0 0 .16 435.39 326.21)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
   <path id="fan" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2705 7871v-4"/>
   <path id="fao" transform="matrix(-.16 0 0 .16 435.71 326.53)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fap" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2706 7866h11"/>
   <path id="faq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2717 7867h-9"/>
   <path id="far" transform="matrix(-.16 0 0 .16 436.03 326.05)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fas" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2717 7867h8"/>
   <path id="fat" transform="matrix(-.16 0 0 .16 438.75 326.05)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="fau" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2728 7871v-4"/>
   <path id="fav" transform="matrix(-.16 0 0 .16 439.07 326.53)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="faw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2727 7866h-10"/>
   <path id="fax" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2702 7879h30"/>
   <path id="fay" transform="matrix(-.16 0 0 .16 414.43 330.21)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
   <path id="faz" transform="matrix(-.16 0 0 .16 421.47 330.21)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
   <path id="fba" transform="matrix(-.16 0 0 .16 410.27 326.37)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="fbb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2547 7872h13"/>
   <path id="fbc" transform="matrix(-.16 0 0 .16 409.31 328.77)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
   <path id="fbd" transform="matrix(-.16 0 0 .16 407.39 329.57)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
   <path id="fbe" transform="matrix(-.16 0 0 .16 411.87 331.01)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
   <path id="fbf" transform="matrix(-.16 0 0 .16 412.35 332.45)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
   <path id="fbg" transform="matrix(-.16 0 0 .16 412.35 332.45)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
   <path id="fbh" transform="matrix(-.16 0 0 .16 412.83 331.01)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
   <path id="fbi" transform="matrix(-.16 0 0 .16 417.15 329.57)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
   <path id="fbj" transform="matrix(-.16 0 0 .16 415.39 328.77)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
   <path id="fbk" transform="matrix(-.16 0 0 .16 410.11 330.21)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
   <path id="fbl" transform="matrix(-.16 0 0 .16 403.07 330.21)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
   <path id="fbm" transform="matrix(-.16 0 0 .16 414.27 326.37)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="fbn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2572 7872h-12"/>
   <path id="fbo" transform="matrix(-.16 0 0 .16 408.99 324.45)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fbp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2538 7880v17"/>
   <path id="fbq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2560 7902h26v-19"/>
   <path id="fbr" transform="matrix(-.16 0 0 .16 415.87 323.97)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
   <path id="fbs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2582 7879h-7l1-8"/>
   <path id="fbt" transform="matrix(-.16 0 0 .16 415.55 324.45)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="fbu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2582 7880v17"/>
   <path id="fbv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2543 7871 1 8h-7"/>
   <path id="fbw" transform="matrix(-.16 0 0 .16 408.67 323.97)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
   <path id="fbx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2533 7883v19h27"/>
   <path id="fby" transform="matrix(-.16 0 0 .16 410.27 326.21)" d="m-0.07507-4.4994c1.4954-0.02495 2.9054 0.69467 3.7626 1.9202"/>
   <path id="fbz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2547 7873h3"/>
   <path id="fca" transform="matrix(-.16 0 0 .16 353.31 311.65)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
   <path id="fcb" transform="matrix(-.16 0 0 .16 410.91 325.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="fcc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2553 7875v-2h7"/>
   <path id="fcd" transform="matrix(-.16 0 0 .16 412.99 325.57)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="fce" transform="matrix(-.16 0 0 .16 414.27 325.41)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
   <path id="fcf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2569 7875"/>
   <path id="fcg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2560 7873h6l1 2"/>
   <path id="fch" transform="matrix(-.16 0 0 .16 413.63 325.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="fci" transform="matrix(-.16 0 0 .16 471.39 311.65)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
   <path id="fcj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2569 7873h4"/>
   <path id="fck" transform="matrix(-.16 0 0 .16 414.43 326.21)" d="m-3.6876-2.5791c0.85718-1.2256 2.2672-1.9452 3.7626-1.9202"/>
   <path id="fcl" transform="matrix(-.16 0 0 .16 410.43 325.41)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
   <path id="fcm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2551 7875"/>
   <path id="fcn" transform="matrix(-.16 0 0 .16 411.71 325.57)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="fco" transform="matrix(-.16 0 0 .16 414.43 326.21)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
   <path id="fcp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2552 7872 1 1"/>
   <path id="fcq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2550 7872v1"/>
   <path id="fcr" transform="matrix(-.16 0 0 .16 410.27 326.21)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
   <path id="fcs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2548 7871v-4"/>
   <path id="fct" transform="matrix(-.16 0 0 .16 410.59 326.53)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fcu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2549 7866h11"/>
   <path id="fcv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2560 7867h-9"/>
   <path id="fcw" transform="matrix(-.16 0 0 .16 410.91 326.05)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fcx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2560 7867h8"/>
   <path id="fcy" transform="matrix(-.16 0 0 .16 413.63 326.05)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="fcz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2571 7871v-4"/>
   <path id="fda" transform="matrix(-.16 0 0 .16 413.95 326.53)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fdb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2570 7866h-10"/>
   <path id="fdc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2544 7879h31"/>
   <path id="fdd" transform="matrix(-.16 0 0 .16 751.07 329.89)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
   <path id="fde" transform="matrix(-.16 0 0 .16 758.11 329.73)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
   <path id="fdf" transform="matrix(-.16 0 0 .16 746.91 326.05)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="fdg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4651 7874h13"/>
   <path id="fdh" transform="matrix(-.16 0 0 .16 745.95 328.45)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
   <path id="fdi" transform="matrix(-.16 0 0 .16 744.03 329.25)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
   <path id="fdj" transform="matrix(-.16 0 0 .16 748.51 330.69)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
   <path id="fdk" transform="matrix(-.16 0 0 .16 748.99 332.13)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
   <path id="fdl" transform="matrix(-.16 0 0 .16 748.99 332.13)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
   <path id="fdm" transform="matrix(-.16 0 0 .16 749.47 330.69)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
   <path id="fdn" transform="matrix(-.16 0 0 .16 753.95 329.25)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
   <path id="fdo" transform="matrix(-.16 0 0 .16 752.03 328.45)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
   <path id="fdp" transform="matrix(-.16 0 0 .16 746.75 329.89)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
   <path id="fdq" transform="matrix(-.16 0 0 .16 739.71 329.73)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
   <path id="fdr" transform="matrix(-.16 0 0 .16 750.91 326.05)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="fds" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4676 7874h-12"/>
   <path id="fdt" transform="matrix(-.16 0 0 .16 745.79 323.97)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fdu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4642 7883v16"/>
   <path id="fdv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4664 7904h27v-19"/>
   <path id="fdw" transform="matrix(-.16 0 0 .16 752.51 323.65)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
   <path id="fdx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4686 7881h-7l1-7"/>
   <path id="fdy" transform="matrix(-.16 0 0 .16 752.19 323.97)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="fdz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4686 7883v16"/>
   <path id="fea" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4647 7874 2 7h-8"/>
   <path id="feb" transform="matrix(-.16 0 0 .16 745.31 323.65)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
   <path id="fec" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4637 7885v19h27"/>
   <path id="fed" transform="matrix(-.16 0 0 .16 746.91 325.89)" d="m-0.07507-4.4994c1.4954-0.02495 2.9054 0.69467 3.7626 1.9202"/>
   <path id="fee" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4651 7876h3"/>
   <path id="fef" transform="matrix(-.16 0 0 .16 689.95 311.17)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
   <path id="feg" transform="matrix(-.16 0 0 .16 747.71 324.93)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="feh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4657 7877v-1h7"/>
   <path id="fei" transform="matrix(-.16 0 0 .16 749.63 325.25)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="fej" transform="matrix(-.16 0 0 .16 750.91 325.09)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
   <path id="fek" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4673 7877"/>
   <path id="fel" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4664 7876h7v1"/>
   <path id="fem" transform="matrix(-.16 0 0 .16 750.27 324.93)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="fen" transform="matrix(-.16 0 0 .16 808.03 311.17)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
   <path id="feo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4674 7876h3"/>
   <path id="fep" transform="matrix(-.16 0 0 .16 751.07 325.89)" d="m-3.6876-2.5791c0.85718-1.2256 2.2672-1.9452 3.7626-1.9202"/>
   <path id="feq" transform="matrix(-.16 0 0 .16 747.07 325.09)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
   <path id="fer" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4655 7877"/>
   <path id="fes" transform="matrix(-.16 0 0 .16 748.35 325.25)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="fet" transform="matrix(-.16 0 0 .16 751.07 325.89)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
   <path id="feu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4657 7874v2"/>
   <path id="fev" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4655 7874-1 2"/>
   <path id="few" transform="matrix(-.16 0 0 .16 746.91 325.89)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
   <path id="fex" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4653 7873v-4"/>
   <path id="fey" transform="matrix(-.16 0 0 .16 747.39 326.21)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fez" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4653 7868 11 1h-9"/>
   <path id="ffa" transform="matrix(-.16 0 0 .16 747.55 325.73)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="ffb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4664 7869h8"/>
   <path id="ffc" transform="matrix(-.16 0 0 .16 750.27 325.73)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="ffd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4675 7873v-4"/>
   <path id="ffe" transform="matrix(-.16 0 0 .16 750.59 326.21)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fff" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4674 7868-10 1"/>
   <path id="ffg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4649 7881h30"/>
   <path id="ffh" transform="matrix(0 .16 .16 0 767.23 914.37)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="ffi" transform="matrix(0 .16 .16 0 767.23 920.45)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="ffj" transform="matrix(0 .16 .16 0 763.87 910.69)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="ffk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4216v-11"/>
   <path id="ffl" transform="matrix(0 .16 .16 0 765.95 909.73)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="ffm" transform="matrix(0 .16 .16 0 766.75 908.13)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="ffn" transform="matrix(0 .16 .16 0 768.03 911.97)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="ffo" transform="matrix(0 .16 .16 0 769.15 912.45)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="ffp" transform="matrix(0 .16 .16 0 769.15 912.45)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="ffq" transform="matrix(0 .16 .16 0 768.03 912.93)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="ffr" transform="matrix(0 .16 .16 0 766.75 916.77)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="ffs" transform="matrix(0 .16 .16 0 765.95 915.01)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="fft" transform="matrix(0 .16 .16 0 767.23 910.53)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="ffu" transform="matrix(0 .16 .16 0 767.23 904.45)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="ffv" transform="matrix(0 .16 .16 0 763.87 914.21)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="ffw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4194v11"/>
   <path id="ffx" transform="matrix(0 .16 .16 0 762.11 909.57)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="ffy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4224h-14"/>
   <path id="ffz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 4205v-23h16"/>
   <path id="fga" transform="matrix(0 .16 .16 0 761.79 915.49)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="fgb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4186v6l6-1"/>
   <path id="fgc" transform="matrix(0 .16 .16 0 762.11 915.17)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fgd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4186h-14"/>
   <path id="fge" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4220-6-2v7"/>
   <path id="fgf" transform="matrix(0 .16 .16 0 761.79 909.25)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="fgg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4744 4228h-16v-23"/>
   <path id="fgh" transform="matrix(0 .16 .16 0 763.71 910.69)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
   <path id="fgi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4216v-2"/>
   <path id="fgj" transform="matrix(0 .16 .16 0 751.07 861.09)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="fgk" transform="matrix(0 .16 .16 0 763.07 911.33)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="fgl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4211h1v-6"/>
   <path id="fgm" transform="matrix(0 .16 .16 0 763.23 912.93)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="fgn" transform="matrix(0 .16 .16 0 763.07 914.05)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="fgo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4197"/>
   <path id="fgp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4205v-6h-1"/>
   <path id="fgq" transform="matrix(0 .16 .16 0 763.07 913.57)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="fgr" transform="matrix(0 .16 .16 0 751.07 963.81)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="fgs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4197v-3"/>
   <path id="fgt" transform="matrix(0 .16 .16 0 763.71 914.21)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
   <path id="fgu" transform="matrix(0 .16 .16 0 763.07 910.69)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="fgv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4213"/>
   <path id="fgw" transform="matrix(0 .16 .16 0 763.23 911.81)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="fgx" transform="matrix(0 .16 .16 0 763.71 914.21)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="fgy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4211h-2"/>
   <path id="fgz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4213-2 1"/>
   <path id="fha" transform="matrix(0 .16 .16 0 763.71 910.69)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="fhb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4215h3"/>
   <path id="fhc" transform="matrix(0 .16 .16 0 764.03 911.01)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fhd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4214v-9"/>
   <path id="fhe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4205v8"/>
   <path id="fhf" transform="matrix(0 .16 .16 0 763.71 911.17)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="fhg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4205v-7"/>
   <path id="fhh" transform="matrix(0 .16 .16 0 763.71 913.57)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fhi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4195h3"/>
   <path id="fhj" transform="matrix(0 .16 .16 0 764.03 913.89)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fhk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4196v9"/>
   <path id="fhl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4218v-26"/>
   <path id="fhm" transform="matrix(0 .16 .16 0 767.23 880.77)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="fhn" transform="matrix(0 .16 .16 0 767.23 886.85)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="fho" transform="matrix(0 .16 .16 0 763.87 877.09)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="fhp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4426v-11"/>
   <path id="fhq" transform="matrix(0 .16 .16 0 765.95 876.13)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="fhr" transform="matrix(0 .16 .16 0 766.75 874.53)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="fhs" transform="matrix(0 .16 .16 0 768.03 878.37)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="fht" transform="matrix(0 .16 .16 0 769.15 878.85)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="fhu" transform="matrix(0 .16 .16 0 769.15 878.85)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="fhv" transform="matrix(0 .16 .16 0 768.03 879.33)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="fhw" transform="matrix(0 .16 .16 0 766.75 883.17)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="fhx" transform="matrix(0 .16 .16 0 765.95 881.41)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="fhy" transform="matrix(0 .16 .16 0 767.23 876.93)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="fhz" transform="matrix(0 .16 .16 0 767.23 870.85)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="fia" transform="matrix(0 .16 .16 0 763.87 880.61)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="fib" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4404v11"/>
   <path id="fic" transform="matrix(0 .16 .16 0 762.11 875.97)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="fid" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4434h-14"/>
   <path id="fie" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 4415v-23h16"/>
   <path id="fif" transform="matrix(0 .16 .16 0 761.79 881.89)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="fig" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4396v6l6-1"/>
   <path id="fih" transform="matrix(0 .16 .16 0 762.11 881.73)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fii" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4396h-14"/>
   <path id="fij" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4430-6-2v7"/>
   <path id="fik" transform="matrix(0 .16 .16 0 761.79 875.65)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="fil" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4744 4438h-16v-23"/>
   <path id="fim" transform="matrix(0 .16 .16 0 763.71 877.09)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
   <path id="fin" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4426v-2"/>
   <path id="fio" transform="matrix(0 .16 .16 0 751.07 827.49)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="fip" transform="matrix(0 .16 .16 0 763.07 877.73)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="fiq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4421h1v-6"/>
   <path id="fir" transform="matrix(0 .16 .16 0 763.23 879.33)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="fis" transform="matrix(0 .16 .16 0 763.07 880.45)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="fit" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4407"/>
   <path id="fiu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4415v-6h-1"/>
   <path id="fiv" transform="matrix(0 .16 .16 0 763.07 879.97)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="fiw" transform="matrix(0 .16 .16 0 751.07 930.21)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="fix" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4407v-3"/>
   <path id="fiy" transform="matrix(0 .16 .16 0 763.71 880.61)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
   <path id="fiz" transform="matrix(0 .16 .16 0 763.07 877.09)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="fja" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4423"/>
   <path id="fjb" transform="matrix(0 .16 .16 0 763.23 878.21)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="fjc" transform="matrix(0 .16 .16 0 763.71 880.61)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="fjd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4421h-2"/>
   <path id="fje" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4423-2 1"/>
   <path id="fjf" transform="matrix(0 .16 .16 0 763.71 877.09)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="fjg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4425h3"/>
   <path id="fjh" transform="matrix(0 .16 .16 0 764.03 877.41)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fji" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4424v-9"/>
   <path id="fjj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4415v8"/>
   <path id="fjk" transform="matrix(0 .16 .16 0 763.71 877.57)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="fjl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4415v-7"/>
   <path id="fjm" transform="matrix(0 .16 .16 0 763.71 879.97)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fjn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4405h3"/>
   <path id="fjo" transform="matrix(0 .16 .16 0 764.03 880.29)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fjp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4406v9"/>
   <path id="fjq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4428v-26"/>
   <path id="fjr" transform="matrix(0 .16 .16 0 767.23 863.97)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="fjs" transform="matrix(0 .16 .16 0 767.23 870.05)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="fjt" transform="matrix(0 .16 .16 0 763.87 860.29)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="fju" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4531v-11"/>
   <path id="fjv" transform="matrix(0 .16 .16 0 765.95 859.33)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="fjw" transform="matrix(0 .16 .16 0 766.75 857.73)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="fjx" transform="matrix(0 .16 .16 0 768.03 861.57)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="fjy" transform="matrix(0 .16 .16 0 769.15 862.05)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="fjz" transform="matrix(0 .16 .16 0 769.15 862.05)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="fka" transform="matrix(0 .16 .16 0 768.03 862.53)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="fkb" transform="matrix(0 .16 .16 0 766.75 866.37)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="fkc" transform="matrix(0 .16 .16 0 765.95 864.77)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="fkd" transform="matrix(0 .16 .16 0 767.23 860.13)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="fke" transform="matrix(0 .16 .16 0 767.23 854.05)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="fkf" transform="matrix(0 .16 .16 0 763.87 863.81)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="fkg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4509v11"/>
   <path id="fkh" transform="matrix(0 .16 .16 0 762.11 859.17)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="fki" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4539h-14"/>
   <path id="fkj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 4520v-23h16"/>
   <path id="fkk" transform="matrix(0 .16 .16 0 761.79 865.09)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="fkl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4501v6l6-1"/>
   <path id="fkm" transform="matrix(0 .16 .16 0 762.11 864.93)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fkn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4501h-14"/>
   <path id="fko" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4535-6-2v7"/>
   <path id="fkp" transform="matrix(0 .16 .16 0 761.79 858.85)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="fkq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4744 4543h-16v-23"/>
   <path id="fkr" transform="matrix(0 .16 .16 0 763.71 860.29)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
   <path id="fks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4531v-2"/>
   <path id="fkt" transform="matrix(0 .16 .16 0 751.07 810.69)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="fku" transform="matrix(0 .16 .16 0 763.07 860.93)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="fkv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4526h1v-6"/>
   <path id="fkw" transform="matrix(0 .16 .16 0 763.23 862.53)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="fkx" transform="matrix(0 .16 .16 0 763.07 863.65)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="fky" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4512"/>
   <path id="fkz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4520v-6h-1"/>
   <path id="fla" transform="matrix(0 .16 .16 0 763.07 863.17)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="flb" transform="matrix(0 .16 .16 0 751.07 913.41)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="flc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4512v-3"/>
   <path id="fld" transform="matrix(0 .16 .16 0 763.71 863.81)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
   <path id="fle" transform="matrix(0 .16 .16 0 763.07 860.29)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="flf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4528"/>
   <path id="flg" transform="matrix(0 .16 .16 0 763.23 861.41)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="flh" transform="matrix(0 .16 .16 0 763.71 863.81)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="fli" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4526h-2"/>
   <path id="flj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4528-2 1"/>
   <path id="flk" transform="matrix(0 .16 .16 0 763.71 860.29)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="fll" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4530h3"/>
   <path id="flm" transform="matrix(0 .16 .16 0 764.03 860.61)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fln" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4529v-9"/>
   <path id="flo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4520v7"/>
   <path id="flp" transform="matrix(0 .16 .16 0 763.71 860.93)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="flq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4520v-7"/>
   <path id="flr" transform="matrix(0 .16 .16 0 763.71 863.17)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fls" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4510h3"/>
   <path id="flt" transform="matrix(0 .16 .16 0 764.03 863.49)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="flu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4511v9"/>
   <path id="flv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4533v-26"/>
   <path id="flw" transform="matrix(0 .16 .16 0 767.23 844.93)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="flx" transform="matrix(0 .16 .16 0 767.23 838.69)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="fly" transform="matrix(0 .16 .16 0 763.87 848.45)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="flz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4605v11"/>
   <path id="fma" transform="matrix(0 .16 .16 0 765.95 849.41)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="fmb" transform="matrix(0 .16 .16 0 766.75 851.01)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="fmc" transform="matrix(0 .16 .16 0 768.03 847.17)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="fmd" transform="matrix(0 .16 .16 0 769.15 846.69)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="fme" transform="matrix(0 .16 .16 0 769.15 846.69)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="fmf" transform="matrix(0 .16 .16 0 768.03 846.21)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="fmg" transform="matrix(0 .16 .16 0 766.75 842.37)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="fmh" transform="matrix(0 .16 .16 0 765.95 844.13)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="fmi" transform="matrix(0 .16 .16 0 767.23 848.61)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="fmj" transform="matrix(0 .16 .16 0 767.23 854.69)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="fmk" transform="matrix(0 .16 .16 0 763.87 844.93)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="fml" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4627v-11"/>
   <path id="fmm" transform="matrix(0 .16 .16 0 762.11 849.57)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fmn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4597h-14"/>
   <path id="fmo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 4616v23h16"/>
   <path id="fmp" transform="matrix(0 .16 .16 0 761.79 843.65)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="fmq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4635v-6l6 1"/>
   <path id="fmr" transform="matrix(0 .16 .16 0 762.11 843.97)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="fms" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4635h-14"/>
   <path id="fmt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4601-6 2v-7"/>
   <path id="fmu" transform="matrix(0 .16 .16 0 761.79 849.89)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="fmv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4744 4593h-16v23"/>
   <path id="fmw" transform="matrix(0 .16 .16 0 763.71 848.45)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
   <path id="fmx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4605v2"/>
   <path id="fmy" transform="matrix(0 .16 .16 0 751.07 898.05)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="fmz" transform="matrix(0 .16 .16 0 763.07 847.81)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="fna" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4610h1v6"/>
   <path id="fnb" transform="matrix(0 .16 .16 0 763.23 846.21)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="fnc" transform="matrix(0 .16 .16 0 763.07 845.09)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="fnd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4624"/>
   <path id="fne" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4616v6h-1"/>
   <path id="fnf" transform="matrix(0 .16 .16 0 763.07 845.57)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="fng" transform="matrix(0 .16 .16 0 751.07 795.33)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="fnh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4624v3"/>
   <path id="fni" transform="matrix(0 .16 .16 0 763.71 844.93)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
   <path id="fnj" transform="matrix(0 .16 .16 0 763.07 848.45)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="fnk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4608"/>
   <path id="fnl" transform="matrix(0 .16 .16 0 763.23 847.33)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="fnm" transform="matrix(0 .16 .16 0 763.71 844.93)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="fnn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4610h-2"/>
   <path id="fno" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4608-2-1"/>
   <path id="fnp" transform="matrix(0 .16 .16 0 763.71 848.45)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="fnq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4606h3"/>
   <path id="fnr" transform="matrix(0 .16 .16 0 764.03 848.13)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fns" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4607v9"/>
   <path id="fnt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4616v-8"/>
   <path id="fnu" transform="matrix(0 .16 .16 0 763.71 847.97)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fnv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4616v7"/>
   <path id="fnw" transform="matrix(0 .16 .16 0 763.71 845.57)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="fnx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4626h3"/>
   <path id="fny" transform="matrix(0 .16 .16 0 764.03 845.25)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fnz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4625v-9"/>
   <path id="foa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4603v26"/>
   <path id="fob" transform="matrix(0 -.16 -.16 0 391.39 827.17)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="foc" transform="matrix(0 -.16 -.16 0 391.39 821.09)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="fod" transform="matrix(0 -.16 -.16 0 394.75 830.85)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="foe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 4715v11"/>
   <path id="fof" transform="matrix(0 -.16 -.16 0 392.67 831.65)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="fog" transform="matrix(0 -.16 -.16 0 391.87 833.41)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="foh" transform="matrix(0 -.16 -.16 0 390.59 829.57)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="foi" transform="matrix(0 -.16 -.16 0 389.31 829.09)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="foj" transform="matrix(0 -.16 -.16 0 389.31 829.09)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="fok" transform="matrix(0 -.16 -.16 0 390.59 828.61)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="fol" transform="matrix(0 -.16 -.16 0 391.87 824.77)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="fom" transform="matrix(0 -.16 -.16 0 392.67 826.37)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="fon" transform="matrix(0 -.16 -.16 0 391.39 831.01)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="foo" transform="matrix(0 -.16 -.16 0 391.39 837.09)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="fop" transform="matrix(0 -.16 -.16 0 394.75 827.33)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="foq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 4737v-11"/>
   <path id="for" transform="matrix(0 -.16 -.16 0 396.35 831.97)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="fos" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4707h14"/>
   <path id="fot" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2479 4726v23h-16"/>
   <path id="fou" transform="matrix(0 -.16 -.16 0 396.83 825.89)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="fov" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2459 4746v-7l-6 2"/>
   <path id="fow" transform="matrix(0 -.16 -.16 0 396.35 826.21)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fox" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4745h14"/>
   <path id="foy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 4712 6 1v-6"/>
   <path id="foz" transform="matrix(0 -.16 -.16 0 396.83 832.13)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="fpa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 4703h16v23"/>
   <path id="fpb" transform="matrix(0 -.16 -.16 0 394.91 830.85)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
   <path id="fpc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2454 4715v3"/>
   <path id="fpd" transform="matrix(0 -.16 -.16 0 407.55 880.45)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="fpe" transform="matrix(0 -.16 -.16 0 395.55 830.21)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="fpf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 4720h-1v6"/>
   <path id="fpg" transform="matrix(0 -.16 -.16 0 395.39 828.45)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="fph" transform="matrix(0 -.16 -.16 0 395.55 827.33)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="fpi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 4734"/>
   <path id="fpj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2455 4726v6h1"/>
   <path id="fpk" transform="matrix(0 -.16 -.16 0 395.55 827.97)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="fpl" transform="matrix(0 -.16 -.16 0 407.55 777.73)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="fpm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2454 4735v2"/>
   <path id="fpn" transform="matrix(0 -.16 -.16 0 394.91 827.33)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
   <path id="fpo" transform="matrix(0 -.16 -.16 0 395.55 830.69)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="fpp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 4718"/>
   <path id="fpq" transform="matrix(0 -.16 -.16 0 395.39 829.57)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="fpr" transform="matrix(0 -.16 -.16 0 394.91 827.33)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="fps" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 4720h2"/>
   <path id="fpt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 4718h2"/>
   <path id="fpu" transform="matrix(0 -.16 -.16 0 394.91 830.85)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="fpv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2452 4716h-3"/>
   <path id="fpw" transform="matrix(0 -.16 -.16 0 394.59 830.53)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fpx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 4717v9"/>
   <path id="fpy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2449 4726v-7"/>
   <path id="fpz" transform="matrix(0 -.16 -.16 0 394.91 830.21)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="fqa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2449 4726v8"/>
   <path id="fqb" transform="matrix(0 -.16 -.16 0 394.91 827.81)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fqc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2452 4736h-3"/>
   <path id="fqd" transform="matrix(0 -.16 -.16 0 394.59 827.65)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fqe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 4735v-9"/>
   <path id="fqf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2459 4713v26"/>
   <path id="fqg" transform="matrix(0 -.16 -.16 0 393.47 897.57)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="fqh" transform="matrix(0 -.16 -.16 0 393.47 903.65)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="fqi" transform="matrix(0 -.16 -.16 0 396.83 893.89)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="fqj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4321v-11"/>
   <path id="fqk" transform="matrix(0 -.16 -.16 0 394.75 892.93)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="fql" transform="matrix(0 -.16 -.16 0 393.95 891.33)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="fqm" transform="matrix(0 -.16 -.16 0 392.67 895.17)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="fqn" transform="matrix(0 -.16 -.16 0 391.39 895.65)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="fqo" transform="matrix(0 -.16 -.16 0 391.39 895.65)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="fqp" transform="matrix(0 -.16 -.16 0 392.67 896.13)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="fqq" transform="matrix(0 -.16 -.16 0 393.95 899.97)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="fqr" transform="matrix(0 -.16 -.16 0 394.75 898.21)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="fqs" transform="matrix(0 -.16 -.16 0 393.47 893.73)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="fqt" transform="matrix(0 -.16 -.16 0 393.47 887.65)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="fqu" transform="matrix(0 -.16 -.16 0 396.83 897.41)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="fqv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4299v11"/>
   <path id="fqw" transform="matrix(0 -.16 -.16 0 398.43 892.77)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fqx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4329h15"/>
   <path id="fqy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 4310v-23h-16"/>
   <path id="fqz" transform="matrix(0 -.16 -.16 0 398.91 898.69)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="fra" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4291v6l-6-1"/>
   <path id="frb" transform="matrix(0 -.16 -.16 0 398.43 898.53)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="frc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4291h15"/>
   <path id="frd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4325 6-2v7"/>
   <path id="fre" transform="matrix(0 -.16 -.16 0 398.91 892.45)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="frf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 4333h16v-23"/>
   <path id="frg" transform="matrix(0 -.16 -.16 0 396.83 893.89)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
   <path id="frh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4321v-2"/>
   <path id="fri" transform="matrix(0 -.16 -.16 0 409.63 844.29)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="frj" transform="matrix(0 -.16 -.16 0 397.63 894.53)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="frk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4316v-6"/>
   <path id="frl" transform="matrix(0 -.16 -.16 0 397.47 896.13)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="frm" transform="matrix(0 -.16 -.16 0 397.63 897.25)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="frn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4302"/>
   <path id="fro" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4310v-6"/>
   <path id="frp" transform="matrix(0 -.16 -.16 0 397.63 896.77)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="frq" transform="matrix(0 -.16 -.16 0 409.63 947.01)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="frr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4302v-3"/>
   <path id="frs" transform="matrix(0 -.16 -.16 0 396.83 897.41)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
   <path id="frt" transform="matrix(0 -.16 -.16 0 397.63 893.89)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="fru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4318"/>
   <path id="frv" transform="matrix(0 -.16 -.16 0 397.47 895.01)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="frw" transform="matrix(0 -.16 -.16 0 396.83 897.41)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="frx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4316h1"/>
   <path id="fry" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4318 2 1"/>
   <path id="frz" transform="matrix(0 -.16 -.16 0 396.83 893.89)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="fsa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4320h-3"/>
   <path id="fsb" transform="matrix(0 -.16 -.16 0 396.67 894.21)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fsc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4319v-9"/>
   <path id="fsd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4310v8"/>
   <path id="fse" transform="matrix(0 -.16 -.16 0 396.99 894.37)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fsf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4310v-7"/>
   <path id="fsg" transform="matrix(0 -.16 -.16 0 396.99 896.77)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="fsh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4300h-3"/>
   <path id="fsi" transform="matrix(0 -.16 -.16 0 396.67 897.09)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fsj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4301v9"/>
   <path id="fsk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4323v-26"/>
   <path id="fsl" transform="matrix(0 -.16 -.16 0 393.47 914.37)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="fsm" transform="matrix(0 -.16 -.16 0 393.47 920.45)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="fsn" transform="matrix(0 -.16 -.16 0 396.83 910.69)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="fso" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4216v-11"/>
   <path id="fsp" transform="matrix(0 -.16 -.16 0 394.75 909.73)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="fsq" transform="matrix(0 -.16 -.16 0 393.95 908.13)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="fsr" transform="matrix(0 -.16 -.16 0 392.67 911.97)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="fss" transform="matrix(0 -.16 -.16 0 391.39 912.45)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="fst" transform="matrix(0 -.16 -.16 0 391.39 912.45)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="fsu" transform="matrix(0 -.16 -.16 0 392.67 912.93)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="fsv" transform="matrix(0 -.16 -.16 0 393.95 916.77)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="fsw" transform="matrix(0 -.16 -.16 0 394.75 915.01)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="fsx" transform="matrix(0 -.16 -.16 0 393.47 910.53)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="fsy" transform="matrix(0 -.16 -.16 0 393.47 904.45)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="fsz" transform="matrix(0 -.16 -.16 0 396.83 914.21)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="fta" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4194v11"/>
   <path id="ftb" transform="matrix(0 -.16 -.16 0 398.43 909.57)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="ftc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4224h15"/>
   <path id="ftd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 4205v-23h-16"/>
   <path id="fte" transform="matrix(0 -.16 -.16 0 398.91 915.49)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="ftf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4186v6l-6-1"/>
   <path id="ftg" transform="matrix(0 -.16 -.16 0 398.43 915.17)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="fth" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4186h15"/>
   <path id="fti" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4220 6-2v7"/>
   <path id="ftj" transform="matrix(0 -.16 -.16 0 398.91 909.25)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="ftk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 4228h16v-23"/>
   <path id="ftl" transform="matrix(0 -.16 -.16 0 396.83 910.69)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
   <path id="ftm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4216v-2"/>
   <path id="ftn" transform="matrix(0 -.16 -.16 0 409.63 861.09)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="fto" transform="matrix(0 -.16 -.16 0 397.63 911.33)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="ftp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4211v-6"/>
   <path id="ftq" transform="matrix(0 -.16 -.16 0 397.47 912.93)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="ftr" transform="matrix(0 -.16 -.16 0 397.63 914.05)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="fts" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4197"/>
   <path id="ftt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4205v-6"/>
   <path id="ftu" transform="matrix(0 -.16 -.16 0 397.63 913.57)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="ftv" transform="matrix(0 -.16 -.16 0 409.63 963.81)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="ftw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4197v-3"/>
   <path id="ftx" transform="matrix(0 -.16 -.16 0 396.83 914.21)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
   <path id="fty" transform="matrix(0 -.16 -.16 0 397.63 910.69)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="ftz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4213"/>
   <path id="fua" transform="matrix(0 -.16 -.16 0 397.47 911.81)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="fub" transform="matrix(0 -.16 -.16 0 396.83 914.21)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="fuc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4211h1"/>
   <path id="fud" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4213 2 1"/>
   <path id="fue" transform="matrix(0 -.16 -.16 0 396.83 910.69)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="fuf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4215h-3"/>
   <path id="fug" transform="matrix(0 -.16 -.16 0 396.67 911.01)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fuh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4214v-9"/>
   <path id="fui" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4205v8"/>
   <path id="fuj" transform="matrix(0 -.16 -.16 0 396.99 911.17)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fuk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4205v-7"/>
   <path id="ful" transform="matrix(0 -.16 -.16 0 396.99 913.57)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="fum" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4195h-3"/>
   <path id="fun" transform="matrix(0 -.16 -.16 0 396.67 913.89)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fuo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4196v9"/>
   <path id="fup" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4218v-26"/>
   <path id="fuq" transform="matrix(0 -.16 -.16 0 393.47 880.77)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="fur" transform="matrix(0 -.16 -.16 0 393.47 886.85)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="fus" transform="matrix(0 -.16 -.16 0 396.83 877.09)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="fut" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4426v-11"/>
   <path id="fuu" transform="matrix(0 -.16 -.16 0 394.75 876.13)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="fuv" transform="matrix(0 -.16 -.16 0 393.95 874.53)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="fuw" transform="matrix(0 -.16 -.16 0 392.67 878.37)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="fux" transform="matrix(0 -.16 -.16 0 391.39 878.85)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="fuy" transform="matrix(0 -.16 -.16 0 391.39 878.85)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="fuz" transform="matrix(0 -.16 -.16 0 392.67 879.33)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="fva" transform="matrix(0 -.16 -.16 0 393.95 883.17)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="fvb" transform="matrix(0 -.16 -.16 0 394.75 881.41)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="fvc" transform="matrix(0 -.16 -.16 0 393.47 876.93)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="fvd" transform="matrix(0 -.16 -.16 0 393.47 870.85)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="fve" transform="matrix(0 -.16 -.16 0 396.83 880.61)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="fvf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4404v11"/>
   <path id="fvg" transform="matrix(0 -.16 -.16 0 398.43 875.97)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fvh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4434h15"/>
   <path id="fvi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 4415v-23h-16"/>
   <path id="fvj" transform="matrix(0 -.16 -.16 0 398.91 881.89)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="fvk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4396v6l-6-1"/>
   <path id="fvl" transform="matrix(0 -.16 -.16 0 398.43 881.73)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="fvm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4396h15"/>
   <path id="fvn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4430 6-2v7"/>
   <path id="fvo" transform="matrix(0 -.16 -.16 0 398.91 875.65)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="fvp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 4438h16v-23"/>
   <path id="fvq" transform="matrix(0 -.16 -.16 0 396.83 877.09)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
   <path id="fvr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4426v-2"/>
   <path id="fvs" transform="matrix(0 -.16 -.16 0 409.63 827.49)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="fvt" transform="matrix(0 -.16 -.16 0 397.63 877.73)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="fvu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4421v-6"/>
   <path id="fvv" transform="matrix(0 -.16 -.16 0 397.47 879.33)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="fvw" transform="matrix(0 -.16 -.16 0 397.63 880.45)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="fvx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4407"/>
   <path id="fvy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4415v-6"/>
   <path id="fvz" transform="matrix(0 -.16 -.16 0 397.63 879.97)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="fwa" transform="matrix(0 -.16 -.16 0 409.63 930.21)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="fwb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4407v-3"/>
   <path id="fwc" transform="matrix(0 -.16 -.16 0 396.83 880.61)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
   <path id="fwd" transform="matrix(0 -.16 -.16 0 397.63 877.09)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="fwe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4423"/>
   <path id="fwf" transform="matrix(0 -.16 -.16 0 397.47 878.21)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="fwg" transform="matrix(0 -.16 -.16 0 396.83 880.61)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="fwh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4421h1"/>
   <path id="fwi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4423 2 1"/>
   <path id="fwj" transform="matrix(0 -.16 -.16 0 396.83 877.09)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="fwk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4425h-3"/>
   <path id="fwl" transform="matrix(0 -.16 -.16 0 396.67 877.41)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fwm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4424v-9"/>
   <path id="fwn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4415v8"/>
   <path id="fwo" transform="matrix(0 -.16 -.16 0 396.99 877.57)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fwp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4415v-7"/>
   <path id="fwq" transform="matrix(0 -.16 -.16 0 396.99 879.97)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="fwr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4405h-3"/>
   <path id="fws" transform="matrix(0 -.16 -.16 0 396.67 880.29)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fwt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4406v9"/>
   <path id="fwu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4428v-26"/>
   <path id="fwv" transform="matrix(0 -.16 -.16 0 393.47 863.97)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="fww" transform="matrix(0 -.16 -.16 0 393.47 870.05)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="fwx" transform="matrix(0 -.16 -.16 0 396.83 860.29)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
   <path id="fwy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4531v-11"/>
   <path id="fwz" transform="matrix(0 -.16 -.16 0 394.75 859.33)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="fxa" transform="matrix(0 -.16 -.16 0 393.95 857.73)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="fxb" transform="matrix(0 -.16 -.16 0 392.67 861.57)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="fxc" transform="matrix(0 -.16 -.16 0 391.39 862.05)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="fxd" transform="matrix(0 -.16 -.16 0 391.39 862.05)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="fxe" transform="matrix(0 -.16 -.16 0 392.67 862.53)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="fxf" transform="matrix(0 -.16 -.16 0 393.95 866.37)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="fxg" transform="matrix(0 -.16 -.16 0 394.75 864.77)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="fxh" transform="matrix(0 -.16 -.16 0 393.47 860.13)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="fxi" transform="matrix(0 -.16 -.16 0 393.47 854.05)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="fxj" transform="matrix(0 -.16 -.16 0 396.83 863.81)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
   <path id="fxk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4509v11"/>
   <path id="fxl" transform="matrix(0 -.16 -.16 0 398.43 859.17)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fxm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4539h15"/>
   <path id="fxn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 4520v-23h-16"/>
   <path id="fxo" transform="matrix(0 -.16 -.16 0 398.91 865.09)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="fxp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4501v6l-6-1"/>
   <path id="fxq" transform="matrix(0 -.16 -.16 0 398.43 864.93)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="fxr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4501h15"/>
   <path id="fxs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4535 6-2v7"/>
   <path id="fxt" transform="matrix(0 -.16 -.16 0 398.91 858.85)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="fxu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 4543h16v-23"/>
   <path id="fxv" transform="matrix(0 -.16 -.16 0 396.83 860.29)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
   <path id="fxw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4531v-2"/>
   <path id="fxx" transform="matrix(0 -.16 -.16 0 409.63 810.69)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="fxy" transform="matrix(0 -.16 -.16 0 397.63 860.93)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="fxz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4526v-6"/>
   <path id="fya" transform="matrix(0 -.16 -.16 0 397.47 862.53)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="fyb" transform="matrix(0 -.16 -.16 0 397.63 863.65)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="fyc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4512"/>
   <path id="fyd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4520v-6"/>
   <path id="fye" transform="matrix(0 -.16 -.16 0 397.63 863.17)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
   <path id="fyf" transform="matrix(0 -.16 -.16 0 409.63 913.41)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="fyg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4512v-3"/>
   <path id="fyh" transform="matrix(0 -.16 -.16 0 396.83 863.81)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
   <path id="fyi" transform="matrix(0 -.16 -.16 0 397.63 860.29)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="fyj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4528"/>
   <path id="fyk" transform="matrix(0 -.16 -.16 0 397.47 861.41)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="fyl" transform="matrix(0 -.16 -.16 0 396.83 863.81)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="fym" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4526h1"/>
   <path id="fyn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4528 2 1"/>
   <path id="fyo" transform="matrix(0 -.16 -.16 0 396.83 860.29)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="fyp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4530h-3"/>
   <path id="fyq" transform="matrix(0 -.16 -.16 0 396.67 860.61)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="fyr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4529v-9"/>
   <path id="fys" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4520v7"/>
   <path id="fyt" transform="matrix(0 -.16 -.16 0 396.99 860.93)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="fyu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4520v-7"/>
   <path id="fyv" transform="matrix(0 -.16 -.16 0 396.99 863.17)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="fyw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4510h-3"/>
   <path id="fyx" transform="matrix(0 -.16 -.16 0 396.67 863.49)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="fyy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4511v9"/>
   <path id="fyz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4533v-26"/>
   <path id="fza" transform="matrix(0 -.16 -.16 0 393.47 844.93)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
   <path id="fzb" transform="matrix(0 -.16 -.16 0 393.47 838.69)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
   <path id="fzc" transform="matrix(0 -.16 -.16 0 396.83 848.45)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
   <path id="fzd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4605v11"/>
   <path id="fze" transform="matrix(0 -.16 -.16 0 394.75 849.41)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
   <path id="fzf" transform="matrix(0 -.16 -.16 0 393.95 851.01)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
   <path id="fzg" transform="matrix(0 -.16 -.16 0 392.67 847.17)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
   <path id="fzh" transform="matrix(0 -.16 -.16 0 391.39 846.69)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
   <path id="fzi" transform="matrix(0 -.16 -.16 0 391.39 846.69)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
   <path id="fzj" transform="matrix(0 -.16 -.16 0 392.67 846.21)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
   <path id="fzk" transform="matrix(0 -.16 -.16 0 393.95 842.37)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
   <path id="fzl" transform="matrix(0 -.16 -.16 0 394.75 844.13)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
   <path id="fzm" transform="matrix(0 -.16 -.16 0 393.47 848.61)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
   <path id="fzn" transform="matrix(0 -.16 -.16 0 393.47 854.69)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
   <path id="fzo" transform="matrix(0 -.16 -.16 0 396.83 844.93)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
   <path id="fzp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4627v-11"/>
   <path id="fzq" transform="matrix(0 -.16 -.16 0 398.43 849.57)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
   <path id="fzr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4597h15"/>
   <path id="fzs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 4616v23h-16"/>
   <path id="fzt" transform="matrix(0 -.16 -.16 0 398.91 843.65)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
   <path id="fzu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4635v-6l-6 1"/>
   <path id="fzv" transform="matrix(0 -.16 -.16 0 398.43 843.97)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
   <path id="fzw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4635h15"/>
   <path id="fzx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4601 6 2v-7"/>
   <path id="fzy" transform="matrix(0 -.16 -.16 0 398.91 849.89)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
   <path id="fzz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 4593h16v23"/>
   <path id="gaa" transform="matrix(0 -.16 -.16 0 396.83 848.45)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
   <path id="gab" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4605v2"/>
   <path id="gac" transform="matrix(0 -.16 -.16 0 409.63 898.05)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
   <path id="gad" transform="matrix(0 -.16 -.16 0 397.63 847.81)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="gae" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4610v6"/>
   <path id="gaf" transform="matrix(0 -.16 -.16 0 397.47 846.21)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
   <path id="gag" transform="matrix(0 -.16 -.16 0 397.63 845.09)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
   <path id="gah" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4624"/>
   <path id="gai" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4616v6"/>
   <path id="gaj" transform="matrix(0 -.16 -.16 0 397.63 845.57)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
   <path id="gak" transform="matrix(0 -.16 -.16 0 409.63 795.33)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
   <path id="gal" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4624v3"/>
   <path id="gam" transform="matrix(0 -.16 -.16 0 396.83 844.93)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
   <path id="gan" transform="matrix(0 -.16 -.16 0 397.63 848.45)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
   <path id="gao" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4608"/>
   <path id="gap" transform="matrix(0 -.16 -.16 0 397.47 847.33)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
   <path id="gaq" transform="matrix(0 -.16 -.16 0 396.83 844.93)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
   <path id="gar" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4610h1"/>
   <path id="gas" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4608 2-1"/>
   <path id="gat" transform="matrix(0 -.16 -.16 0 396.83 848.45)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
   <path id="gau" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4606h-3"/>
   <path id="gav" transform="matrix(0 -.16 -.16 0 396.67 848.13)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
   <path id="gaw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4607v9"/>
   <path id="gax" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4616v-8"/>
   <path id="gay" transform="matrix(0 -.16 -.16 0 396.99 847.97)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
   <path id="gaz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4616v7"/>
   <path id="gba" transform="matrix(0 -.16 -.16 0 396.99 845.57)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
   <path id="gbb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4626h-3"/>
   <path id="gbc" transform="matrix(0 -.16 -.16 0 396.67 845.25)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
   <path id="gbd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4625v-9"/>
   <path id="gbe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4603v26"/>
  </g>
  <g id="gbf" fill="none" stroke="#545454" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
   <path id="gbg" transform="matrix(0 .16 .16 0 398.27 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gbh" transform="matrix(0 .16 .16 0 397.47 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gbi" transform="matrix(0 .16 .16 0 397.95 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gbj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5735h2v20"/>
   <path id="gbk" transform="matrix(0 .16 .16 0 400.03 664.13)" d="m0.1402 6.4985c-0.06791 0.00146-0.13584 0.00186-0.20376 0.0012"/>
   <path id="gbl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5757v-22"/>
   <path id="gbm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5740v-8"/>
   <path id="gbn" transform="matrix(0 .16 .16 0 399.87 668.13)" d="M 3.4962,-0.16302 C 3.54076,0.79249 3.1923,1.7246 2.53185,2.41655 1.87141,3.1085 0.95655,3.5 0,3.5"/>
   <path id="gbo" transform="matrix(0 .16 .16 0 397.63 666.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gbp" transform="matrix(0 .16 .16 0 398.11 666.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gbq" transform="matrix(0 .16 .16 0 397.63 665.41)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gbr" transform="matrix(0 .16 .16 0 398.11 665.41)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gbs" transform="matrix(0 .16 .16 0 399.87 663.65)" d="m-1.6318 3.0963c-1.2011-0.63299-1.9277-1.9035-1.8644-3.2597"/>
   <path id="gbt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5757"/>
   <path id="gbu" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m3.181 1.4599c-0.50451 1.0992-1.5408 1.8601-2.7407 2.0123s-2.3933-0.32601-3.1562-1.2646"/>
   <path id="gbv" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
   <path id="gbw" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-2.7157-2.2079c0.75129-0.92409 1.9209-1.4027 3.1045-1.2704 1.1836 0.13229 2.2187 0.85736 2.7474 1.9245"/>
   <path id="gbx" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
   <path id="gby" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5740v-5"/>
   <path id="gbz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5740v-5"/>
   <path id="gca" transform="matrix(0 .16 .16 0 400.35 667.33)" d="m2.4049-0.68294c0.12681 0.44655 0.12679 0.91958-6e-5 1.3661"/>
   <path id="gcb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5735"/>
   <path id="gcc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5735"/>
   <path id="gcd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5742v1-1"/>
   <path id="gce" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5743v-1"/>
   <path id="gcf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5743v-1"/>
   <path id="gcg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5743v-1"/>
   <path id="gch" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5743v-1"/>
   <path id="gci" transform="matrix(0 .16 .16 0 400.35 666.21)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
   <path id="gcj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5740h-1"/>
   <path id="gck" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5740h3-3"/>
   <path id="gcl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5742h-3"/>
   <path id="gcm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5740"/>
   <path id="gcn" transform="matrix(0 .16 .16 0 400.19 666.85)" d="m0.03367-0.49886c0.19712 0.0133 0.36792 0.14143 0.43585 0.32694"/>
   <path id="gco" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5742h-1v-2"/>
   <path id="gcp" transform="matrix(0 .16 .16 0 400.03 666.53)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="gcq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5740"/>
   <path id="gcr" transform="matrix(0 .16 .16 0 400.35 666.85)" d="m0.4695 0.17196c-0.06795 0.18551-0.23876 0.31362-0.43587 0.32691"/>
   <path id="gcs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5742v-2"/>
   <path id="gct" transform="matrix(0 .16 .16 0 400.51 666.53)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="gcu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5742h-1"/>
   <path id="gcv" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
   <path id="gcw" transform="matrix(0 .16 .16 0 400.35 666.85)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
   <path id="gcx" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
   <path id="gcy" transform="matrix(0 .16 .16 0 400.35 665.73)" d="m4.1238-1.8011c0.50159 1.1485 0.50153 2.4541-1.7e-4 3.6026"/>
   <path id="gcz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5743h-3 3"/>
   <path id="gda" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-0.95427-2.3107c0.6113-0.25245 1.2977-0.25239 1.909 1.9e-4"/>
   <path id="gdb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5747v-2"/>
   <path id="gdc" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
   <path id="gdd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5744 2-1h-1v1"/>
   <path id="gde" transform="matrix(0 .16 .16 0 400.03 666.53)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="gdf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5743"/>
   <path id="gdg" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
   <path id="gdh" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
   <path id="gdi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5745v2"/>
   <path id="gdj" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
   <path id="gdk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5743 2 1"/>
   <path id="gdl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5744v-1"/>
   <path id="gdm" transform="matrix(0 .16 .16 0 400.51 666.53)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="gdn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5743h1"/>
   <path id="gdo" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
   <path id="gdp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5756v1"/>
   <path id="gdq" transform="matrix(0 .16 .16 0 400.83 664.13)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="gdr" transform="matrix(0 .16 .16 0 400.83 664.13)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
   <path id="gds" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5757v3"/>
   <path id="gdt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5756v5"/>
   <path id="gdu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5761v-5 5"/>
   <path id="gdv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5761v-4"/>
   <path id="gdw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5755v7"/>
   <path id="gdx" transform="matrix(0 .16 .16 0 405.63 663.81)" d="m-3.1542-27.319c2.0976-0.24219 4.2162-0.24199 6.3137 6.1e-4"/>
   <path id="gdy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5755v7"/>
   <path id="gdz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5753v-2"/>
   <path id="gea" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5753v-2"/>
   <path id="geb" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
   <path id="gec" transform="matrix(0 .16 .16 0 400.35 666.53)" d="m-7.1856 2.1489c-0.41927-1.4019-0.41927-2.8959 0-4.2978"/>
   <path id="ged" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5748v3h5-5"/>
   <path id="gee" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
   <path id="gef" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5749-2-1"/>
   <path id="geg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5751v-3"/>
   <path id="geh" transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
   <path id="gei" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5748-2 1"/>
   <path id="gej" transform="matrix(0 .16 .16 0 400.35 665.25)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
   <path id="gek" transform="matrix(0 .16 .16 0 400.35 664.13)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
   <path id="gel" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5753h-4"/>
   <path id="gem" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5754h-4"/>
   <path id="gen" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5756h5"/>
   <path id="geo" transform="matrix(0 .16 .16 0 400.35 663.65)" d="m2.8518-2.029c0.86427 1.2148 0.86419 2.8436-1.9e-4 4.0583"/>
   <path id="gep" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5756v-2"/>
   <path id="geq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5753v1-1"/>
   <path id="ger" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5754v-1"/>
   <path id="ges" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5753"/>
   <path id="get" transform="matrix(0 .16 .16 0 400.03 664.61)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="geu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5754"/>
   <path id="gev" transform="matrix(0 .16 .16 0 400.03 664.77)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="gew" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5756h2"/>
   <path id="gex" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5757"/>
   <path id="gey" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5757h1v-1"/>
   <path id="gez" transform="matrix(0 .16 .16 0 399.87 664.29)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
   <path id="gfa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5756v-3"/>
   <path id="gfb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5753v1-1"/>
   <path id="gfc" transform="matrix(0 .16 .16 0 400.67 664.61)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="gfd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5753"/>
   <path id="gfe" transform="matrix(0 .16 .16 0 400.67 664.77)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="gff" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5754"/>
   <path id="gfg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5756"/>
   <path id="gfh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5756"/>
   <path id="gfi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5757h-1"/>
   <path id="gfj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5756h-2"/>
   <path id="gfk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5755h1"/>
   <path id="gfl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5762"/>
   <path id="gfm" transform="matrix(0 .16 .16 0 400.35 664.29)" d="m-5.115 2.0217c-0.51338-1.2989-0.51338-2.7444 0-4.0433"/>
   <path id="gfn" transform="matrix(0 .16 .16 0 401.47 663.81)" d="m-1.3742-12.424c0.91414-0.10111 1.8367-0.10103 2.7508 2.6e-4"/>
   <path id="gfo" transform="matrix(0 .16 .16 0 399.55 663.81)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
   <path id="gfp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5758h1v1h-1"/>
   <path id="gfq" transform="matrix(0 .16 .16 0 399.87 663.49)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
   <path id="gfr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5760v1"/>
   <path id="gfs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5761"/>
   <path id="gft" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5761"/>
   <path id="gfu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5760h1"/>
   <path id="gfv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5761h-2"/>
   <path id="gfw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5758v2"/>
   <path id="gfx" transform="matrix(0 .16 .16 0 400.67 663.81)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
   <path id="gfy" transform="matrix(0 .16 .16 0 401.15 663.81)" d="m-0.96136-2.3078c0.61544-0.25637 1.3078-0.2563 1.9232 1.9e-4"/>
   <path id="gfz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5757h1v1h-1"/>
   <path id="gga" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5762"/>
   <path id="ggb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5761"/>
   <path id="ggc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5760h-1"/>
   <path id="ggd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5761h-2"/>
   <path id="gge" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5760v1"/>
   <path id="ggf" transform="matrix(0 .16 .16 0 400.83 663.65)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="ggg" transform="matrix(0 .16 .16 0 400.83 663.65)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
   <path id="ggh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5760h1-1"/>
   <path id="ggi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5762h-1"/>
   <path id="ggj" transform="matrix(0 .16 .16 0 400.03 667.65)" d="m5.0615 4.0781c-1.2648 1.5698-3.1863 2.4639-5.2017 2.4204"/>
   <path id="ggk" transform="matrix(0 .16 .16 0 400.19 667.81)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
   <path id="ggl" transform="matrix(0 .16 .16 0 399.71 661.89)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
   <path id="ggm" transform="matrix(0 .16 .16 0 398.59 665.73)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
   <path id="ggn" transform="matrix(0 .16 .16 0 398.59 666.05)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
   <path id="ggo" transform="matrix(0 .16 .16 0 399.71 669.89)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
   <path id="ggp" transform="matrix(0 .16 .16 0 400.19 663.97)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
   <path id="ggq" transform="matrix(0 .16 .16 0 400.03 664.13)" d="m-3.2022 5.6565c-0.71381-0.4041-1.3447-0.93965-1.8593-1.5784"/>
   <path id="ggr" transform="matrix(0 .16 .16 0 398.91 668.77)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
   <path id="ggs" transform="matrix(0 .16 .16 0 399.23 663.97)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
   <path id="ggt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2479 5758v-23"/>
   <path id="ggu" transform="matrix(0 .16 .16 0 399.23 667.65)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
   <path id="ggv" transform="matrix(0 .16 .16 0 398.91 663.01)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
   <path id="ggw" transform="matrix(0 .16 .16 0 398.11 665.89)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
   <path id="ggx" transform="matrix(0 .16 .16 0 398.11 665.89)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
   <path id="ggy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265 5932.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ggz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265 5927.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="gha" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265 5929.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ghb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253 5950v1h20"/>
   <path id="ghc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.6 5950c-0.068 0-0.1358 5e-4 -0.2036 0"/>
   <path id="ghd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5950h-21"/>
   <path id="ghe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258 5945h-8"/>
   <path id="ghf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2250.5 5945c-0.9565 0-1.8716-0.3916-2.532-1.0835s-1.0088-1.6245-0.9641-2.5801"/>
   <path id="ghg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2262 5928.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ghh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2262 5931.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ghi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267 5928.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ghj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267 5931.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ghk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2281 5941.3c0.063 1.356-0.6633 2.6265-1.8643 3.2593"/>
   <path id="ghl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5950"/>
   <path id="ghm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267.2 5946.7c-0.7627 0.9385-1.9563 1.417-3.156 1.2647-1.1999-0.1524-2.2363-0.9131-2.7407-2.0122"/>
   <path id="ghn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2266 5946.5c-0.1746 0.1343-0.3657 0.2447-0.5691 0.3286"/>
   <path id="gho" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261.4 5942.9c0.5288-1.0669 1.564-1.792 2.7476-1.9243 1.1836-0.1319 2.3532 0.3467 3.1042 1.271"/>
   <path id="ghp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265.5 5942.2c0.2032 0.084 0.3946 0.1944 0.5691 0.3287"/>
   <path id="ghq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2257 5945h-5"/>
   <path id="ghr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2257 5944-5-1"/>
   <path id="ghs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2252.1 5945.2c-0.1269-0.4468-0.1269-0.9194 0-1.3662"/>
   <path id="ght" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2252 5944"/>
   <path id="ghu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2252 5945"/>
   <path id="ghv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260 5946h-1"/>
   <path id="ghw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5945h1-1"/>
   <path id="ghx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5943h1-1"/>
   <path id="ghy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260 5942h-1"/>
   <path id="ghz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.2 5945.4c-0.2014-0.5528-0.2014-1.1592 0-1.712"/>
   <path id="gia" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2257 5945v-1"/>
   <path id="gib" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258 5943v3-3"/>
   <path id="gic" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5946v-3"/>
   <path id="gid" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258 5943"/>
   <path id="gie" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258 5944.3c0.068-0.1855 0.2388-0.3135 0.4358-0.3271"/>
   <path id="gif" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5943h-1"/>
   <path id="gig" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.1 5943.8c-0.1643-0.188-0.1643-0.4692 0-0.6572"/>
   <path id="gih" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258 5946"/>
   <path id="gii" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258.5 5946c-0.197-0.014-0.3679-0.1416-0.4358-0.3271"/>
   <path id="gij" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5946h-1"/>
   <path id="gik" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.1 5946.8c-0.1643-0.188-0.1643-0.4692 0-0.6572"/>
   <path id="gil" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5945"/>
   <path id="gim" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2262 5944.8c-0.029-0.2183-0.029-0.439 0-0.6572"/>
   <path id="gin" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.8 5943.6c0.2012 0.5528 0.2012 1.1587-2e-4 1.7115"/>
   <path id="gio" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2266 5944.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
   <path id="gip" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261.4 5946.3c-0.5017-1.1485-0.5017-2.4541 0-3.6026"/>
   <path id="giq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5946v-3 3"/>
   <path id="gir" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263.5 5942.2c0.6113-0.2524 1.2979-0.2524 1.9092 0"/>
   <path id="gis" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265 5942h-2"/>
   <path id="git" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2262 5944.2c0.087-0.6558 0.4302-1.2505 0.9546-1.6533"/>
   <path id="giu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2262 5942-1 2"/>
   <path id="giv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260 5943"/>
   <path id="giw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5943"/>
   <path id="gix" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.9 5943.2c0.1643 0.1885 0.1643 0.4692 0 0.6572"/>
   <path id="giy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5943"/>
   <path id="giz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263 5942.5c0.1746-0.1343 0.3657-0.2447 0.5691-0.3287"/>
   <path id="gja" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265.5 5946.8c-0.6113 0.2525-1.2979 0.2525-1.9092 0"/>
   <path id="gjb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263 5947h2"/>
   <path id="gjc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263 5946.5c-0.5244-0.4028-0.8677-0.9975-0.9546-1.6533"/>
   <path id="gjd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5945 1 1"/>
   <path id="gje" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5946"/>
   <path id="gjf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.9 5946.2c0.1643 0.1885 0.1643 0.4692 0 0.6572"/>
   <path id="gjg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5946"/>
   <path id="gjh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260 5945"/>
   <path id="gji" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263.5 5946.8c-0.2034-0.084-0.3945-0.1943-0.5691-0.3286"/>
   <path id="gjj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5947h1"/>
   <path id="gjk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.9 5948.8c-0.091 0.1464-0.2517 0.2358-0.4246 0.2358-0.1728 0-0.3333-0.089-0.4246-0.2358"/>
   <path id="gjl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.1 5948.2c0.095-0.1049 0.2297-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
   <path id="gjm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5949h3"/>
   <path id="gjn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5946h6"/>
   <path id="gjo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5942h6"/>
   <path id="gjp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5942h4"/>
   <path id="gjq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5940"/>
   <path id="gjr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5940h4"/>
   <path id="gjs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5951h7"/>
   <path id="gjt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273.3 5950.2c2.0977-0.2422 4.2163-0.2422 6.314 0"/>
   <path id="gju" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5951h7"/>
   <path id="gjv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2270 5946h-1"/>
   <path id="gjw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2270 5942h-1"/>
   <path id="gjx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267 5944.2c0.029 0.2182 0.029 0.4389 0 0.6572"/>
   <path id="gjy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2266.7 5942.4c0.4189 1.4018 0.4189 2.8955-2e-4 4.2973"/>
   <path id="gjz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2266 5942h3v4-4"/>
   <path id="gka" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2266 5942.5c0.5244 0.4033 0.8675 0.998 0.9544 1.6533"/>
   <path id="gkb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267 5944-2-2"/>
   <path id="gkc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2269 5946h-3"/>
   <path id="gkd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267 5944.8c-0.087 0.6558-0.4302 1.2505-0.9546 1.6533"/>
   <path id="gke" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265 5946 2-1"/>
   <path id="gkf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272.8 5943.3c0.2188 0.7886 0.2188 1.6211-2e-4 2.4092"/>
   <path id="gkg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271.2 5945.7c-0.219-0.7881-0.219-1.6211 0-2.4092"/>
   <path id="gkh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2270 5946v-4"/>
   <path id="gki" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5946v-4"/>
   <path id="gkj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5942v4"/>
   <path id="gkk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274.6 5946.5c-0.8645-1.2149-0.8645-2.8438 0-4.0586"/>
   <path id="gkl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5942h-1"/>
   <path id="gkm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271 5943h1-1"/>
   <path id="gkn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5942h-1"/>
   <path id="gko" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271 5943"/>
   <path id="gkp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271.2 5943.3c-0.2771-0.4702-0.2771-1.0532 0-1.5234"/>
   <path id="gkq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5943"/>
   <path id="gkr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272.8 5941.7c0.2768 0.4697 0.2766 1.0527-3e-4 1.5229"/>
   <path id="gks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5942"/>
   <path id="gkt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5942v-2"/>
   <path id="gku" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5941"/>
   <path id="gkv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5940"/>
   <path id="gkw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5940v1h-1"/>
   <path id="gkx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5942.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
   <path id="gky" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5946h-1"/>
   <path id="gkz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5947h-1"/>
   <path id="gla" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5945h-1"/>
   <path id="glb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5946h-1"/>
   <path id="glc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271.2 5947.3c-0.2771-0.4702-0.2771-1.0532 0-1.5234"/>
   <path id="gld" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271 5946v-1"/>
   <path id="gle" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272.8 5945.7c0.2768 0.4697 0.2766 1.0527-3e-4 1.5229"/>
   <path id="glf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5946v-1"/>
   <path id="glg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5950"/>
   <path id="glh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5946"/>
   <path id="gli" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5950v-1"/>
   <path id="glj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5948v-1"/>
   <path id="glk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5951v-1"/>
   <path id="gll" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280 5951v-1"/>
   <path id="glm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278.6 5942.5c0.5132 1.2988 0.513 2.7441-2e-4 4.0425"/>
   <path id="gln" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.1 5940.1c0.9143-0.1011 1.8367-0.1011 2.751 0"/>
   <path id="glo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2276.9 5940.8c-0.094 0.1265-0.2427 0.2007-0.4004 0.2007s-0.3061-0.074-0.4004-0.2007"/>
   <path id="glp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2276 5940v1h1v-1"/>
   <path id="glq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2279.2 5942.9c-0.1425-0.083-0.2351-0.2309-0.247-0.3955"/>
   <path id="glr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5941"/>
   <path id="gls" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5940"/>
   <path id="glt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5941"/>
   <path id="glu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5942v-2 1"/>
   <path id="glv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5947h2"/>
   <path id="glw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2277.7 5948.7c-0.7351 0.3921-1.6175 0.3921-2.3526 0"/>
   <path id="glx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.5 5948.2c0.6155-0.2564 1.3079-0.2564 1.9234 0"/>
   <path id="gly" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5947v1-1"/>
   <path id="glz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2279 5950"/>
   <path id="gma" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2279 5947"/>
   <path id="gmb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5950v-1"/>
   <path id="gmc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5948v-1h-1"/>
   <path id="gmd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278.9 5948.8c-0.091 0.1464-0.2517 0.2358-0.4246 0.2358-0.1728 0-0.3333-0.089-0.4246-0.2358"/>
   <path id="gme" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278.1 5948.2c0.095-0.1049 0.2297-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
   <path id="gmf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2277 5947v1-1"/>
   <path id="gmg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280 5951"/>
   <path id="gmh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253.6 5950c-2.0153 0.044-3.9367-0.8506-5.2016-2.4204"/>
   <path id="gmi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2248.2 5948c-0.6926-0.8594-1.1106-1.9077-1.1995-3.0078"/>
   <path id="gmj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2247.1 5944.8c-0.3731-4.8574 0.092-9.7426 1.3747-14.442"/>
   <path id="gmk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2248.3 5930.1c1.5342-7.8628 8.2114-13.68 16.21-14.122"/>
   <path id="gml" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2264.5 5916c7.9988 0.4428 14.675 6.2602 16.209 14.123"/>
   <path id="gmm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280.5 5930.3c1.282 4.6987 1.7465 9.5825 1.3737 14.438"/>
   <path id="gmn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2282 5944.9c-0.089 1.1001-0.5069 2.1484-1.1995 3.0078"/>
   <path id="gmo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280.6 5947.6c-0.5146 0.6387-1.1455 1.1743-1.8593 1.5782"/>
   <path id="gmp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274.8 5924.9c1.6699 4.2026 2.4153 8.7153 2.1855 13.232"/>
   <path id="gmq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2277 5937.6c-0.043 0.7964-0.7004 1.4199-1.4978 1.4199"/>
   <path id="gmr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5939h-23"/>
   <path id="gms" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2252.5 5939c-0.7974 0-1.4553-0.6235-1.4978-1.4199"/>
   <path id="gmt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2251 5938.1c-0.2298-4.5176 0.5158-9.0313 2.1867-13.235"/>
   <path id="gmu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253.5 5924.5c2.1326-3.9155 6.1895-6.3984 10.646-6.5166"/>
   <path id="gmv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263.8 5918c4.4571 0.1186 8.5137 2.602 10.646 6.5176"/>
   <path id="gmw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351 5932.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="gmx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351 5927.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="gmy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351 5929.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="gmz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2360 5950v1h-19"/>
   <path id="gna" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339.6 5950h-0.2036"/>
   <path id="gnb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5950h21"/>
   <path id="gnc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5945h7"/>
   <path id="gnd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2367 5941.3c0.045 0.9556-0.3037 1.8877-0.9644 2.5796-0.6604 0.6919-1.5752 1.0835-2.5317 1.0835"/>
   <path id="gne" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5928.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="gnf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5931.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="gng" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5928.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="gnh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5931.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="gni" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2334.9 5944.6c-1.2012-0.6328-1.9278-1.9033-1.8643-3.2598"/>
   <path id="gnj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5950"/>
   <path id="gnk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353.7 5946c-0.5044 1.0991-1.5408 1.8598-2.7407 2.0122-1.1997 0.1523-2.3933-0.3262-3.156-1.2647"/>
   <path id="gnl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349.5 5946.8c-0.2034-0.084-0.3945-0.1943-0.5691-0.3286"/>
   <path id="gnm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347.8 5942.3c0.7514-0.9238 1.9209-1.4028 3.1045-1.2705s2.2187 0.8574 2.7475 1.9248"/>
   <path id="gnn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349 5942.5c0.1746-0.1343 0.3657-0.2447 0.5691-0.3287"/>
   <path id="gno" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5945h5"/>
   <path id="gnp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5944 5-1"/>
   <path id="gnq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2361.9 5943.8c0.1267 0.4468 0.1267 0.9199-2e-4 1.3662"/>
   <path id="gnr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2361 5944"/>
   <path id="gns" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2361 5945"/>
   <path id="gnt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5946h1"/>
   <path id="gnu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5945h-1 1"/>
   <path id="gnv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5943h-1 1"/>
   <path id="gnw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5942h1"/>
   <path id="gnx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354.8 5943.6c0.2012 0.5528 0.2012 1.1587-2e-4 1.7115"/>
   <path id="gny" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5945v-1"/>
   <path id="gnz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5946v-3"/>
   <path id="goa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5946v-3"/>
   <path id="gob" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5946v-3"/>
   <path id="goc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5943h1"/>
   <path id="god" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356.5 5944c0.197 0.014 0.3679 0.1416 0.4358 0.3271"/>
   <path id="goe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5943h1"/>
   <path id="gof" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354.9 5943.2c0.1643 0.1885 0.1643 0.4692 0 0.6572"/>
   <path id="gog" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5946h-1"/>
   <path id="goh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2357 5945.7c-0.068 0.1855-0.2388 0.3134-0.4358 0.3271"/>
   <path id="goi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5946h1"/>
   <path id="goj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354.9 5946.2c0.1643 0.1885 0.1643 0.4692 0 0.6572"/>
   <path id="gok" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5945"/>
   <path id="gol" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5944.2c0.029 0.2182 0.029 0.4389 0 0.6572"/>
   <path id="gom" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353.2 5945.4c-0.2014-0.5528-0.2014-1.1592 0-1.712"/>
   <path id="gon" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5944.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
   <path id="goo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352.6 5942.7c0.5017 1.1485 0.5017 2.4541 0 3.6026"/>
   <path id="gop" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5946v-3 3"/>
   <path id="goq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349.5 5942.2c0.6113-0.2524 1.2978-0.2524 1.9091 0"/>
   <path id="gor" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349 5942h2"/>
   <path id="gos" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5942.5c0.5244 0.4033 0.8675 0.998 0.9544 1.6533"/>
   <path id="got" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351 5942 1 2"/>
   <path id="gou" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5943"/>
   <path id="gov" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5943"/>
   <path id="gow" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353.1 5943.8c-0.1643-0.188-0.1643-0.4692 0-0.6572"/>
   <path id="gox" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5943h-1"/>
   <path id="goy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351.5 5942.2c0.2032 0.084 0.3946 0.1944 0.5691 0.3287"/>
   <path id="goz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351.5 5946.8c-0.6113 0.2525-1.2979 0.2525-1.9092 0"/>
   <path id="gpa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351 5947h-2"/>
   <path id="gpb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5944.8c-0.087 0.6558-0.4302 1.2505-0.9546 1.6533"/>
   <path id="gpc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5945-1 1"/>
   <path id="gpd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5946"/>
   <path id="gpe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353.1 5946.8c-0.1643-0.188-0.1643-0.4692 0-0.6572"/>
   <path id="gpf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5946"/>
   <path id="gpg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5946h-1"/>
   <path id="gph" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5945"/>
   <path id="gpi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5946.5c-0.1746 0.1343-0.3657 0.2447-0.5691 0.3286"/>
   <path id="gpj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5947h-1"/>
   <path id="gpk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339.9 5948.8c-0.091 0.1464-0.2517 0.2358-0.4246 0.2358-0.1728 0-0.3333-0.089-0.4246-0.2358"/>
   <path id="gpl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339.1 5948.2c0.095-0.1049 0.2297-0.165 0.3711-0.165 0.1416 0 0.2764 0.06 0.3711 0.165"/>
   <path id="gpm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5949h-4"/>
   <path id="gpn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5946h-5"/>
   <path id="gpo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5942h-5 4"/>
   <path id="gpp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 5940"/>
   <path id="gpq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5940h-4"/>
   <path id="gpr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341 5951h-8"/>
   <path id="gps" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2334.3 5950.2c2.0977-0.2422 4.2163-0.2422 6.3137 5e-4"/>
   <path id="gpt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341 5951h-8"/>
   <path id="gpu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5946h1"/>
   <path id="gpv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5942h1"/>
   <path id="gpw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5944.8c-0.029-0.2183-0.029-0.439 0-0.6572"/>
   <path id="gpx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347.3 5946.6c-0.4192-1.4018-0.4192-2.896 0-4.2978"/>
   <path id="gpy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 5946v-4"/>
   <path id="gpz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2344 5946v-4h4"/>
   <path id="gqa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5944.2c0.087-0.6558 0.4302-1.2505 0.9546-1.6533"/>
   <path id="gqb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 5944 1-2"/>
   <path id="gqc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2344 5946h4"/>
   <path id="gqd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349 5946.5c-0.5244-0.4028-0.8677-0.9975-0.9546-1.6533"/>
   <path id="gqe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5946-1-1"/>
   <path id="gqf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342.2 5945.7c-0.219-0.7881-0.219-1.6211 0-2.4092"/>
   <path id="gqg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343.8 5943.3c0.2188 0.7886 0.2188 1.6211-2e-4 2.4092"/>
   <path id="gqh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5946v-4"/>
   <path id="gqi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341 5946v-4"/>
   <path id="gqj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5942v4"/>
   <path id="gqk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339.4 5942.5c0.8643 1.2143 0.8643 2.8432-2e-4 4.0581"/>
   <path id="gql" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5942h1"/>
   <path id="gqm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5943h-1 1"/>
   <path id="gqn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5942h1"/>
   <path id="gqo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5943"/>
   <path id="gqp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343.8 5941.7c0.2768 0.4697 0.2766 1.0527-3e-4 1.5229"/>
   <path id="gqq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5943"/>
   <path id="gqr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341.2 5943.3c-0.2771-0.4702-0.2771-1.0532 0-1.5234"/>
   <path id="gqs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5942"/>
   <path id="gqt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5942v-2"/>
   <path id="gqu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5941"/>
   <path id="gqv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5940v1"/>
   <path id="gqw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340.2 5942.9c-0.1425-0.083-0.2351-0.2309-0.247-0.3955"/>
   <path id="gqx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5946h1"/>
   <path id="gqy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5947h1"/>
   <path id="gqz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5945h1"/>
   <path id="gra" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5946h1"/>
   <path id="grb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343.8 5945.7c0.2768 0.4697 0.2766 1.0527-3e-4 1.5229"/>
   <path id="grc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5946v-1"/>
   <path id="grd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341.2 5947.3c-0.2771-0.4702-0.2771-1.0532 0-1.5234"/>
   <path id="gre" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5946v-1"/>
   <path id="grf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5950"/>
   <path id="grg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5946"/>
   <path id="grh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5950v-1"/>
   <path id="gri" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5948v-1"/>
   <path id="grj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341 5951-1-1"/>
   <path id="grk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2333 5951 1-1"/>
   <path id="grl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335.4 5946.5c-0.5134-1.2988-0.5134-2.7442 0-4.043"/>
   <path id="grm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2336.1 5940.1c0.9143-0.1011 1.8367-0.1011 2.7508 5e-4"/>
   <path id="grn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2337.9 5940.8c-0.094 0.1265-0.2427 0.2007-0.4004 0.2007s-0.3061-0.074-0.4004-0.2007"/>
   <path id="gro" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 5940v1h-2v-1"/>
   <path id="grp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5942.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
   <path id="grq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5941"/>
   <path id="grr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5940"/>
   <path id="grs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5941"/>
   <path id="grt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5940v1"/>
   <path id="gru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2336 5940"/>
   <path id="grv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5942v-2"/>
   <path id="grw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 5947h-2"/>
   <path id="grx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338.7 5948.7c-0.7351 0.3921-1.6175 0.3921-2.3526 0"/>
   <path id="gry" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2336.5 5948.2c0.6155-0.2564 1.3078-0.2564 1.9233 0"/>
   <path id="grz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 5947v1-1"/>
   <path id="gsa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2334 5950"/>
   <path id="gsb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5947"/>
   <path id="gsc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5950v-1"/>
   <path id="gsd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5948v-1h1"/>
   <path id="gse" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335.9 5948.8c-0.091 0.1464-0.2517 0.2358-0.4246 0.2358-0.1728 0-0.3333-0.089-0.4246-0.2358"/>
   <path id="gsf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335.1 5948.2c0.095-0.1049 0.2297-0.165 0.3711-0.165 0.1416 0 0.2764 0.06 0.3711 0.165"/>
   <path id="gsg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2336 5947v1-1"/>
   <path id="gsh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2333 5951"/>
   <path id="gsi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2365.6 5947.6c-1.2649 1.5698-3.1863 2.4639-5.2016 2.4204"/>
   <path id="gsj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2368 5944.9c-0.089 1.1001-0.5069 2.1484-1.1995 3.0078"/>
   <path id="gsk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2366.5 5930.3c1.282 4.6987 1.7465 9.5825 1.3737 14.438"/>
   <path id="gsl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2350.5 5916c7.9988 0.4428 14.675 6.2602 16.209 14.123"/>
   <path id="gsm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2334.3 5930.1c1.5342-7.8628 8.2114-13.68 16.21-14.122"/>
   <path id="gsn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332.1 5944.8c-0.3731-4.8574 0.092-9.7426 1.3747-14.442"/>
   <path id="gso" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2334.2 5948c-0.6926-0.8594-1.1106-1.9077-1.1995-3.0078"/>
   <path id="gsp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2336.3 5949.2c-0.7139-0.4039-1.3448-0.9395-1.8594-1.5782"/>
   <path id="gsq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2337 5938.1c-0.2298-4.5176 0.5158-9.0313 2.1867-13.235"/>
   <path id="gsr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338.5 5939c-0.7974 0-1.4553-0.6235-1.4978-1.4199"/>
   <path id="gss" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 5939h23"/>
   <path id="gst" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2363 5937.6c-0.043 0.7964-0.7004 1.4199-1.4978 1.4199"/>
   <path id="gsu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2360.8 5924.9c1.6699 4.2026 2.4153 8.7153 2.1855 13.232"/>
   <path id="gsv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349.8 5918c4.4571 0.1186 8.5137 2.602 10.646 6.5176"/>
   <path id="gsw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339.5 5924.5c2.1326-3.9155 6.1895-6.3984 10.646-6.5166"/>
   <path id="gsx" transform="matrix(0 .16 .16 0 398.27 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gsy" transform="matrix(0 .16 .16 0 397.47 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gsz" transform="matrix(0 .16 .16 0 397.95 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gta" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5906h2v19"/>
   <path id="gtb" transform="matrix(0 .16 .16 0 400.03 636.93)" d="m0.1402 6.4985c-0.06791 0.00146-0.13584 0.00186-0.20376 0.0012"/>
   <path id="gtc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5927v-21"/>
   <path id="gtd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5910v-7"/>
   <path id="gte" transform="matrix(0 .16 .16 0 399.87 640.77)" d="M 3.4962,-0.16302 C 3.54076,0.79249 3.1923,1.7246 2.53185,2.41655 1.87141,3.1085 0.95655,3.5 0,3.5"/>
   <path id="gtf" transform="matrix(0 .16 .16 0 397.63 639.01)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gtg" transform="matrix(0 .16 .16 0 398.11 639.01)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gth" transform="matrix(0 .16 .16 0 397.63 638.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gti" transform="matrix(0 .16 .16 0 398.11 638.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gtj" transform="matrix(0 .16 .16 0 399.87 636.45)" d="m-1.6318 3.0963c-1.2011-0.63299-1.9277-1.9035-1.8644-3.2597"/>
   <path id="gtk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5927"/>
   <path id="gtl" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m3.181 1.4599c-0.50451 1.0992-1.5408 1.8601-2.7407 2.0123s-2.3933-0.32601-3.1562-1.2646"/>
   <path id="gtm" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
   <path id="gtn" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-2.7157-2.2079c0.75129-0.92409 1.9209-1.4027 3.1045-1.2704 1.1836 0.13229 2.2187 0.85736 2.7474 1.9245"/>
   <path id="gto" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
   <path id="gtp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5910v-5"/>
   <path id="gtq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5910v-5"/>
   <path id="gtr" transform="matrix(0 .16 .16 0 400.35 640.13)" d="m2.4049-0.68294c0.12681 0.44655 0.12679 0.91958-6e-5 1.3661"/>
   <path id="gts" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5905"/>
   <path id="gtt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5905"/>
   <path id="gtu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5912v1-1"/>
   <path id="gtv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5913v-1"/>
   <path id="gtw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5913v-1"/>
   <path id="gtx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5913v-1"/>
   <path id="gty" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5913v-1"/>
   <path id="gtz" transform="matrix(0 .16 .16 0 400.35 639.01)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
   <path id="gua" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5910h-1"/>
   <path id="gub" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5910h-3"/>
   <path id="guc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5911h-3"/>
   <path id="gud" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5912h-3"/>
   <path id="gue" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5911v-1"/>
   <path id="guf" transform="matrix(0 .16 .16 0 400.19 639.65)" d="m0.03367-0.49886c0.19712 0.0133 0.36792 0.14143 0.43585 0.32694"/>
   <path id="gug" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5912h-1v-1"/>
   <path id="guh" transform="matrix(0 .16 .16 0 400.03 639.17)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="gui" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5910v1"/>
   <path id="guj" transform="matrix(0 .16 .16 0 400.35 639.65)" d="m0.4695 0.17196c-0.06795 0.18551-0.23876 0.31362-0.43587 0.32691"/>
   <path id="guk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5912v-1"/>
   <path id="gul" transform="matrix(0 .16 .16 0 400.51 639.17)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="gum" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5912h-1"/>
   <path id="gun" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
   <path id="guo" transform="matrix(0 .16 .16 0 400.35 639.49)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
   <path id="gup" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
   <path id="guq" transform="matrix(0 .16 .16 0 400.35 638.37)" d="m4.1238-1.8011c0.50159 1.1485 0.50153 2.4541-1.7e-4 3.6026"/>
   <path id="gur" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5913h-3l3 1"/>
   <path id="gus" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-0.95427-2.3107c0.6113-0.25245 1.2977-0.25239 1.909 1.9e-4"/>
   <path id="gut" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5918v-3"/>
   <path id="guu" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
   <path id="guv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5915 2-1"/>
   <path id="guw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5913h-1"/>
   <path id="gux" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5914"/>
   <path id="guy" transform="matrix(0 .16 .16 0 400.03 639.17)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="guz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5913v1"/>
   <path id="gva" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
   <path id="gvb" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
   <path id="gvc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5915v3"/>
   <path id="gvd" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
   <path id="gve" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5914 2 1"/>
   <path id="gvf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5914"/>
   <path id="gvg" transform="matrix(0 .16 .16 0 400.51 639.17)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="gvh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5913"/>
   <path id="gvi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5913h1v1"/>
   <path id="gvj" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
   <path id="gvk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5927v1"/>
   <path id="gvl" transform="matrix(0 .16 .16 0 400.83 636.93)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="gvm" transform="matrix(0 .16 .16 0 400.83 636.93)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
   <path id="gvn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5927v4"/>
   <path id="gvo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5926v5"/>
   <path id="gvp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5926v5-4"/>
   <path id="gvq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5928"/>
   <path id="gvr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5927v4"/>
   <path id="gvs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5925v8"/>
   <path id="gvt" transform="matrix(0 .16 .16 0 405.63 636.61)" d="m-3.1542-27.319c2.0976-0.24219 4.2162-0.24199 6.3137 6.1e-4"/>
   <path id="gvu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5925v8"/>
   <path id="gvv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5923v-1"/>
   <path id="gvw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5923v-1"/>
   <path id="gvx" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
   <path id="gvy" transform="matrix(0 .16 .16 0 400.35 639.33)" d="m-7.1856 2.1489c-0.41927-1.4019-0.41927-2.8959 0-4.2978"/>
   <path id="gvz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5921h-5"/>
   <path id="gwa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5922h-5v-4"/>
   <path id="gwb" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
   <path id="gwc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5919-2-1"/>
   <path id="gwd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5922v-4"/>
   <path id="gwe" transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
   <path id="gwf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5918-2 1"/>
   <path id="gwg" transform="matrix(0 .16 .16 0 400.35 638.05)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
   <path id="gwh" transform="matrix(0 .16 .16 0 400.35 636.93)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
   <path id="gwi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5923h-4"/>
   <path id="gwj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5925h-4"/>
   <path id="gwk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5926h5"/>
   <path id="gwl" transform="matrix(0 .16 .16 0 400.35 636.45)" d="m2.8518-2.029c0.86427 1.2148 0.86419 2.8436-1.9e-4 4.0583"/>
   <path id="gwm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5926v-1"/>
   <path id="gwn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5923v2-2"/>
   <path id="gwo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5925v-2"/>
   <path id="gwp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5923"/>
   <path id="gwq" transform="matrix(0 .16 .16 0 400.03 637.41)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="gwr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5925"/>
   <path id="gws" transform="matrix(0 .16 .16 0 400.03 637.41)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="gwt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5926"/>
   <path id="gwu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5927h-2"/>
   <path id="gwv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5927"/>
   <path id="gww" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5927h1"/>
   <path id="gwx" transform="matrix(0 .16 .16 0 399.87 637.09)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
   <path id="gwy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5926v-3"/>
   <path id="gwz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5923v2-2"/>
   <path id="gxa" transform="matrix(0 .16 .16 0 400.67 637.41)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="gxb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5923"/>
   <path id="gxc" transform="matrix(0 .16 .16 0 400.67 637.41)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="gxd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5925"/>
   <path id="gxe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5926"/>
   <path id="gxf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5926"/>
   <path id="gxg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5927h-3"/>
   <path id="gxh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5925h-1v1"/>
   <path id="gxi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5933v-1"/>
   <path id="gxj" transform="matrix(0 .16 .16 0 400.35 637.09)" d="m-5.115 2.0217c-0.51338-1.2989-0.51338-2.7444 0-4.0433"/>
   <path id="gxk" transform="matrix(0 .16 .16 0 401.47 636.61)" d="m-1.3742-12.424c0.91414-0.10111 1.8367-0.10103 2.7508 2.6e-4"/>
   <path id="gxl" transform="matrix(0 .16 .16 0 399.55 636.61)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
   <path id="gxm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5928h1v2h-1"/>
   <path id="gxn" transform="matrix(0 .16 .16 0 399.87 636.13)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
   <path id="gxo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5931"/>
   <path id="gxp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5931"/>
   <path id="gxq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5931"/>
   <path id="gxr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5931h1"/>
   <path id="gxs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5930"/>
   <path id="gxt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5931h-2"/>
   <path id="gxu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5928v2"/>
   <path id="gxv" transform="matrix(0 .16 .16 0 400.67 636.61)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
   <path id="gxw" transform="matrix(0 .16 .16 0 401.15 636.61)" d="m-0.96136-2.3078c0.61544-0.25637 1.3078-0.2563 1.9232 1.9e-4"/>
   <path id="gxx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5928h1-1"/>
   <path id="gxy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5932"/>
   <path id="gxz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5931"/>
   <path id="gya" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5931h-3"/>
   <path id="gyb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5930v1"/>
   <path id="gyc" transform="matrix(0 .16 .16 0 400.83 636.29)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="gyd" transform="matrix(0 .16 .16 0 400.83 636.29)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
   <path id="gye" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5930h1-1"/>
   <path id="gyf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5933h-1"/>
   <path id="gyg" transform="matrix(0 .16 .16 0 400.03 640.29)" d="m5.0615 4.0781c-1.2648 1.5698-3.1863 2.4639-5.2017 2.4204"/>
   <path id="gyh" transform="matrix(0 .16 .16 0 400.19 640.61)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
   <path id="gyi" transform="matrix(0 .16 .16 0 399.71 634.69)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
   <path id="gyj" transform="matrix(0 .16 .16 0 398.59 638.53)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
   <path id="gyk" transform="matrix(0 .16 .16 0 398.59 638.69)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
   <path id="gyl" transform="matrix(0 .16 .16 0 399.71 642.53)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
   <path id="gym" transform="matrix(0 .16 .16 0 400.19 636.61)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
   <path id="gyn" transform="matrix(0 .16 .16 0 400.03 636.93)" d="m-3.2022 5.6565c-0.71381-0.4041-1.3447-0.93965-1.8593-1.5784"/>
   <path id="gyo" transform="matrix(0 .16 .16 0 398.91 641.57)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
   <path id="gyp" transform="matrix(0 .16 .16 0 399.23 636.77)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
   <path id="gyq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2479 5928v-23"/>
   <path id="gyr" transform="matrix(0 .16 .16 0 399.23 640.45)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
   <path id="gys" transform="matrix(0 .16 .16 0 398.91 635.65)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
   <path id="gyt" transform="matrix(0 .16 .16 0 398.11 638.53)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
   <path id="gyu" transform="matrix(0 .16 .16 0 398.11 638.69)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
   <path id="gyv" transform="matrix(0 .16 .16 0 398.27 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gyw" transform="matrix(0 .16 .16 0 397.47 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gyx" transform="matrix(0 .16 .16 0 397.95 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gyy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5814h2v20"/>
   <path id="gyz" transform="matrix(0 .16 .16 0 400.03 651.49)" d="m0.1402 6.4985c-0.06791 0.00146-0.13584 0.00186-0.20376 0.0012"/>
   <path id="gza" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5836v-22"/>
   <path id="gzb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5819v-8"/>
   <path id="gzc" transform="matrix(0 .16 .16 0 399.87 655.49)" d="M 3.4962,-0.16302 C 3.54076,0.79249 3.1923,1.7246 2.53185,2.41655 1.87141,3.1085 0.95655,3.5 0,3.5"/>
   <path id="gzd" transform="matrix(0 .16 .16 0 397.63 653.73)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gze" transform="matrix(0 .16 .16 0 398.11 653.73)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gzf" transform="matrix(0 .16 .16 0 397.63 652.93)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gzg" transform="matrix(0 .16 .16 0 398.11 652.93)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="gzh" transform="matrix(0 .16 .16 0 399.87 651.17)" d="m-1.6318 3.0963c-1.2011-0.63299-1.9277-1.9035-1.8644-3.2597"/>
   <path id="gzi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5836"/>
   <path id="gzj" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m3.181 1.4599c-0.50451 1.0992-1.5408 1.8601-2.7407 2.0123s-2.3933-0.32601-3.1562-1.2646"/>
   <path id="gzk" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
   <path id="gzl" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-2.7157-2.2079c0.75129-0.92409 1.9209-1.4027 3.1045-1.2704 1.1836 0.13229 2.2187 0.85736 2.7474 1.9245"/>
   <path id="gzm" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
   <path id="gzn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5818v-5"/>
   <path id="gzo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5818v-5"/>
   <path id="gzp" transform="matrix(0 .16 .16 0 400.35 654.85)" d="m2.4049-0.68294c0.12681 0.44655 0.12679 0.91958-6e-5 1.3661"/>
   <path id="gzq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5813"/>
   <path id="gzr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5813"/>
   <path id="gzs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5820v1-1"/>
   <path id="gzt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5821v-1"/>
   <path id="gzu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5821v-1"/>
   <path id="gzv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5821v-1"/>
   <path id="gzw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5821v-1"/>
   <path id="gzx" transform="matrix(0 .16 .16 0 400.35 653.57)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
   <path id="gzy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5818h-1"/>
   <path id="gzz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5819h3-3"/>
   <path id="haa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5820h-3"/>
   <path id="hab" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5819"/>
   <path id="hac" transform="matrix(0 .16 .16 0 400.19 654.21)" d="m0.03367-0.49886c0.19712 0.0133 0.36792 0.14143 0.43585 0.32694"/>
   <path id="had" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5820h-1v-1"/>
   <path id="hae" transform="matrix(0 .16 .16 0 400.03 653.89)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="haf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5819"/>
   <path id="hag" transform="matrix(0 .16 .16 0 400.35 654.21)" d="m0.4695 0.17196c-0.06795 0.18551-0.23876 0.31362-0.43587 0.32691"/>
   <path id="hah" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5820v-1"/>
   <path id="hai" transform="matrix(0 .16 .16 0 400.51 653.89)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="haj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5820h-1"/>
   <path id="hak" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
   <path id="hal" transform="matrix(0 .16 .16 0 400.35 654.21)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
   <path id="ham" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
   <path id="han" transform="matrix(0 .16 .16 0 400.35 653.09)" d="m4.1238-1.8011c0.50159 1.1485 0.50153 2.4541-1.7e-4 3.6026"/>
   <path id="hao" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5822h-3 3"/>
   <path id="hap" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-0.95427-2.3107c0.6113-0.25245 1.2977-0.25239 1.909 1.9e-4"/>
   <path id="haq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5826v-2"/>
   <path id="har" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
   <path id="has" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5823 2-1"/>
   <path id="hat" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5821h-1"/>
   <path id="hau" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5822"/>
   <path id="hav" transform="matrix(0 .16 .16 0 400.03 653.89)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="haw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5822"/>
   <path id="hax" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
   <path id="hay" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
   <path id="haz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5824v2"/>
   <path id="hba" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
   <path id="hbb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5822 2 1"/>
   <path id="hbc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5822"/>
   <path id="hbd" transform="matrix(0 .16 .16 0 400.51 653.89)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="hbe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5822"/>
   <path id="hbf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5821h-1"/>
   <path id="hbg" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
   <path id="hbh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5835v1"/>
   <path id="hbi" transform="matrix(0 .16 .16 0 400.83 651.49)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="hbj" transform="matrix(0 .16 .16 0 400.83 651.49)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
   <path id="hbk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5836v3"/>
   <path id="hbl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5835v5"/>
   <path id="hbm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5840v-5 5"/>
   <path id="hbn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5836"/>
   <path id="hbo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5835v4"/>
   <path id="hbp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5834v7"/>
   <path id="hbq" transform="matrix(0 .16 .16 0 405.63 651.33)" d="m-3.1542-27.319c2.0976-0.24219 4.2162-0.24199 6.3137 6.1e-4"/>
   <path id="hbr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5834v7"/>
   <path id="hbs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5831v-1"/>
   <path id="hbt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5831v-1"/>
   <path id="hbu" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
   <path id="hbv" transform="matrix(0 .16 .16 0 400.35 654.05)" d="m-7.1856 2.1489c-0.41927-1.4019-0.41927-2.8959 0-4.2978"/>
   <path id="hbw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5827v3h5-5"/>
   <path id="hbx" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
   <path id="hby" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5828-2-1"/>
   <path id="hbz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5830v-3"/>
   <path id="hca" transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
   <path id="hcb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5827-2 1"/>
   <path id="hcc" transform="matrix(0 .16 .16 0 400.35 652.61)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
   <path id="hcd" transform="matrix(0 .16 .16 0 400.35 651.49)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
   <path id="hce" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5831h-4"/>
   <path id="hcf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5833h-4"/>
   <path id="hcg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5834h5"/>
   <path id="hch" transform="matrix(0 .16 .16 0 400.35 651.17)" d="m2.8518-2.029c0.86427 1.2148 0.86419 2.8436-1.9e-4 4.0583"/>
   <path id="hci" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5834v-1"/>
   <path id="hcj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5832v1-1"/>
   <path id="hck" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5833v-1"/>
   <path id="hcl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5832"/>
   <path id="hcm" transform="matrix(0 .16 .16 0 400.03 651.97)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="hcn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5833"/>
   <path id="hco" transform="matrix(0 .16 .16 0 400.03 652.13)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="hcp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5834v1h-2"/>
   <path id="hcq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5835"/>
   <path id="hcr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5835"/>
   <path id="hcs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5836h1v-1"/>
   <path id="hct" transform="matrix(0 .16 .16 0 399.87 651.65)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
   <path id="hcu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5834v-2"/>
   <path id="hcv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5832v1-1"/>
   <path id="hcw" transform="matrix(0 .16 .16 0 400.67 651.97)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="hcx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5832"/>
   <path id="hcy" transform="matrix(0 .16 .16 0 400.67 652.13)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="hcz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5833"/>
   <path id="hda" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5834"/>
   <path id="hdb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5834v1"/>
   <path id="hdc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5836h-1"/>
   <path id="hdd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5835h-2"/>
   <path id="hde" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5834h1"/>
   <path id="hdf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5841"/>
   <path id="hdg" transform="matrix(0 .16 .16 0 400.35 651.81)" d="m-5.115 2.0217c-0.51338-1.2989-0.51338-2.7444 0-4.0433"/>
   <path id="hdh" transform="matrix(0 .16 .16 0 401.47 651.33)" d="m-1.3742-12.424c0.91414-0.10111 1.8367-0.10103 2.7508 2.6e-4"/>
   <path id="hdi" transform="matrix(0 .16 .16 0 399.55 651.33)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
   <path id="hdj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5837h1v1h-1"/>
   <path id="hdk" transform="matrix(0 .16 .16 0 399.87 650.85)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
   <path id="hdl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5839v1"/>
   <path id="hdm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5839"/>
   <path id="hdn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5839"/>
   <path id="hdo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5839h1"/>
   <path id="hdp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5840h-2"/>
   <path id="hdq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5836v2"/>
   <path id="hdr" transform="matrix(0 .16 .16 0 400.67 651.33)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
   <path id="hds" transform="matrix(0 .16 .16 0 401.15 651.33)" d="m-0.96136-2.3078c0.61544-0.25637 1.3078-0.2563 1.9232 1.9e-4"/>
   <path id="hdt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5836h1-1"/>
   <path id="hdu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5840"/>
   <path id="hdv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5840"/>
   <path id="hdw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5839h-1"/>
   <path id="hdx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5840h-2"/>
   <path id="hdy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5839v1"/>
   <path id="hdz" transform="matrix(0 .16 .16 0 400.83 651.01)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="hea" transform="matrix(0 .16 .16 0 400.83 651.01)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
   <path id="heb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5838h1v1h-1"/>
   <path id="hec" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5841h-1"/>
   <path id="hed" transform="matrix(0 .16 .16 0 400.03 655.01)" d="m5.0615 4.0781c-1.2648 1.5698-3.1863 2.4639-5.2017 2.4204"/>
   <path id="hee" transform="matrix(0 .16 .16 0 400.19 655.17)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
   <path id="hef" transform="matrix(0 .16 .16 0 399.71 649.25)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
   <path id="heg" transform="matrix(0 .16 .16 0 398.59 653.09)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
   <path id="heh" transform="matrix(0 .16 .16 0 398.59 653.41)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
   <path id="hei" transform="matrix(0 .16 .16 0 399.71 657.25)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
   <path id="hej" transform="matrix(0 .16 .16 0 400.19 651.33)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
   <path id="hek" transform="matrix(0 .16 .16 0 400.03 651.49)" d="m-3.2022 5.6565c-0.71381-0.4041-1.3447-0.93965-1.8593-1.5784"/>
   <path id="hel" transform="matrix(0 .16 .16 0 398.91 656.29)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
   <path id="hem" transform="matrix(0 .16 .16 0 399.23 651.49)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
   <path id="hen" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2479 5836v-23"/>
   <path id="heo" transform="matrix(0 .16 .16 0 399.23 655.17)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
   <path id="hep" transform="matrix(0 .16 .16 0 398.91 650.37)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
   <path id="heq" transform="matrix(0 .16 .16 0 398.11 653.25)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
   <path id="her" transform="matrix(0 .16 .16 0 398.11 653.41)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
   <path id="hes" transform="matrix(0 -.16 -.16 0 762.43 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="het" transform="matrix(0 -.16 -.16 0 763.23 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="heu" transform="matrix(0 -.16 -.16 0 762.75 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hev" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5735h-2v20"/>
   <path id="hew" transform="matrix(0 -.16 -.16 0 760.67 664.13)" d="m0.06356 6.4997c-0.06792 6.6e-4 -0.13585 2.6e-4 -0.20376-0.0012"/>
   <path id="hex" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5757v-22"/>
   <path id="hey" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5740v-8"/>
   <path id="hez" transform="matrix(0 -.16 -.16 0 760.83 668.13)" d="m0 3.5c-0.9566 0-1.8715-0.39154-2.532-1.0836s-1.0089-1.6242-0.96422-2.5798"/>
   <path id="hfa" transform="matrix(0 -.16 -.16 0 763.07 666.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hfb" transform="matrix(0 -.16 -.16 0 762.59 666.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hfc" transform="matrix(0 -.16 -.16 0 763.07 665.41)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hfd" transform="matrix(0 -.16 -.16 0 762.59 665.41)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hfe" transform="matrix(0 -.16 -.16 0 760.83 663.65)" d="m3.4962-0.16302c0.06323 1.3561-0.66341 2.6264-1.8644 3.2593"/>
   <path id="hff" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5757"/>
   <path id="hfg" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m2.7159 2.2076c-0.7629 0.93855-1.9563 1.4167-3.1562 1.2646s-2.2362-0.91301-2.7407-2.0123"/>
   <path id="hfh" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
   <path id="hfi" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-3.136-1.5541c0.52883-1.0671 1.564-1.7921 2.7476-1.9242 1.1836-0.13217 2.3532 0.34658 3.1044 1.2707"/>
   <path id="hfj" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
   <path id="hfk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5740v-5"/>
   <path id="hfl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5740v-5"/>
   <path id="hfm" transform="matrix(0 -.16 -.16 0 760.35 667.33)" d="m-2.4048 0.68317c-0.12687-0.44661-0.12687-0.91973 0-1.3663"/>
   <path id="hfn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5735"/>
   <path id="hfo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5735"/>
   <path id="hfp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5743v-1"/>
   <path id="hfq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5742v1-1"/>
   <path id="hfr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5742v1-1"/>
   <path id="hfs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5743v-1"/>
   <path id="hft" transform="matrix(0 -.16 -.16 0 760.35 666.21)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
   <path id="hfu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5740h1"/>
   <path id="hfv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5740h-3 3"/>
   <path id="hfw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5742h3"/>
   <path id="hfx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5740"/>
   <path id="hfy" transform="matrix(0 -.16 -.16 0 760.51 666.85)" d="m-0.4695-0.17196c0.06795-0.18551 0.23876-0.31362 0.43587-0.32691"/>
   <path id="hfz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5742v-2"/>
   <path id="hga" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5742"/>
   <path id="hgb" transform="matrix(0 -.16 -.16 0 760.67 666.53)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="hgc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5740"/>
   <path id="hgd" transform="matrix(0 -.16 -.16 0 760.35 666.85)" d="m-0.03363 0.49887c-0.19711-0.01329-0.36792-0.1414-0.43587-0.32691"/>
   <path id="hge" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5742v-2"/>
   <path id="hgf" transform="matrix(0 -.16 -.16 0 760.19 666.53)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="hgg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5742"/>
   <path id="hgh" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
   <path id="hgi" transform="matrix(0 -.16 -.16 0 760.35 666.85)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
   <path id="hgj" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
   <path id="hgk" transform="matrix(0 -.16 -.16 0 760.35 665.73)" d="m-4.1237 1.8015c-0.50176-1.1486-0.50176-2.4544 0-3.6029"/>
   <path id="hgl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5743h3-3"/>
   <path id="hgm" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-0.95449-2.3106c0.61127-0.25251 1.2977-0.25251 1.909 0"/>
   <path id="hgn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5747v-2"/>
   <path id="hgo" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
   <path id="hgp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5744-2-1"/>
   <path id="hgq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5744v-1"/>
   <path id="hgr" transform="matrix(0 -.16 -.16 0 760.67 666.53)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="hgs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5743"/>
   <path id="hgt" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
   <path id="hgu" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
   <path id="hgv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5745v2"/>
   <path id="hgw" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
   <path id="hgx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5743-2 1"/>
   <path id="hgy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5744v-1"/>
   <path id="hgz" transform="matrix(0 -.16 -.16 0 760.19 666.53)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="hha" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5743"/>
   <path id="hhb" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
   <path id="hhc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5756v1"/>
   <path id="hhd" transform="matrix(0 -.16 -.16 0 759.87 664.13)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="hhe" transform="matrix(0 -.16 -.16 0 759.87 664.13)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
   <path id="hhf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5757v3"/>
   <path id="hhg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5756v5"/>
   <path id="hhh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5761v-5 5"/>
   <path id="hhi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5761v-4"/>
   <path id="hhj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5755v7"/>
   <path id="hhk" transform="matrix(0 -.16 -.16 0 755.07 663.81)" d="m-3.1569-27.318c2.0976-0.2424 4.2161-0.2424 6.3137 0"/>
   <path id="hhl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5755v7"/>
   <path id="hhm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5753v-2"/>
   <path id="hhn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5753v-2"/>
   <path id="hho" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
   <path id="hhp" transform="matrix(0 -.16 -.16 0 760.35 666.53)" d="m7.1858-2.1482c0.41906 1.4017 0.41898 2.8954-2.1e-4 4.2971"/>
   <path id="hhq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5748v3h-4 4"/>
   <path id="hhr" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
   <path id="hhs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5749 2-1"/>
   <path id="hht" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5751v-3"/>
   <path id="hhu" transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
   <path id="hhv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5748 2 1"/>
   <path id="hhw" transform="matrix(0 -.16 -.16 0 760.35 665.25)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
   <path id="hhx" transform="matrix(0 -.16 -.16 0 760.35 664.13)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
   <path id="hhy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5753h4"/>
   <path id="hhz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5754h4"/>
   <path id="hia" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5756h-4"/>
   <path id="hib" transform="matrix(0 -.16 -.16 0 760.35 663.65)" d="m-2.8517 2.0293c-0.86445-1.2148-0.86445-2.8438 0-4.0586"/>
   <path id="hic" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5756v-3"/>
   <path id="hid" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5754v-1"/>
   <path id="hie" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5754v-1"/>
   <path id="hif" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5753h1"/>
   <path id="hig" transform="matrix(0 -.16 -.16 0 760.67 664.61)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="hih" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5754h1"/>
   <path id="hii" transform="matrix(0 -.16 -.16 0 760.67 664.77)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="hij" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5756h2"/>
   <path id="hik" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 5757"/>
   <path id="hil" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5757h-1v-1"/>
   <path id="him" transform="matrix(0 -.16 -.16 0 760.83 664.29)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
   <path id="hin" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5756v-3"/>
   <path id="hio" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5753v1-1"/>
   <path id="hip" transform="matrix(0 -.16 -.16 0 760.03 664.61)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="hiq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5753"/>
   <path id="hir" transform="matrix(0 -.16 -.16 0 760.03 664.77)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="his" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5754"/>
   <path id="hit" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5756"/>
   <path id="hiu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5756"/>
   <path id="hiv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5757h1"/>
   <path id="hiw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5756h2"/>
   <path id="hix" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5755h1"/>
   <path id="hiy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5762h1"/>
   <path id="hiz" transform="matrix(0 -.16 -.16 0 760.35 664.29)" d="m5.1152-2.0212c0.51319 1.2988 0.51312 2.7441-1.9e-4 4.0428"/>
   <path id="hja" transform="matrix(0 -.16 -.16 0 759.23 663.81)" d="m-1.3754-12.424c0.91414-0.1012 1.8367-0.1012 2.7508 0"/>
   <path id="hjb" transform="matrix(0 -.16 -.16 0 760.99 663.81)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
   <path id="hjc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5758h-1v1h1"/>
   <path id="hjd" transform="matrix(0 -.16 -.16 0 760.83 663.49)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
   <path id="hje" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 5760v1"/>
   <path id="hjf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5760h-1"/>
   <path id="hjg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5761h1"/>
   <path id="hjh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5758v2"/>
   <path id="hji" transform="matrix(0 -.16 -.16 0 760.03 663.81)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
   <path id="hjj" transform="matrix(0 -.16 -.16 0 759.55 663.81)" d="m-0.96158-2.3077c0.61541-0.25643 1.3078-0.25643 1.9232 0"/>
   <path id="hjk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5757h-1v1h1"/>
   <path id="hjl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5762"/>
   <path id="hjm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5761"/>
   <path id="hjn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5760h1"/>
   <path id="hjo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5761h2"/>
   <path id="hjp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5760v1"/>
   <path id="hjq" transform="matrix(0 -.16 -.16 0 759.87 663.65)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="hjr" transform="matrix(0 -.16 -.16 0 759.87 663.65)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
   <path id="hjs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5760h-1 1"/>
   <path id="hjt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5762"/>
   <path id="hju" transform="matrix(0 -.16 -.16 0 760.67 667.65)" d="m0.1402 6.4985c-2.0154 0.04348-3.937-0.85061-5.2017-2.4204"/>
   <path id="hjv" transform="matrix(0 -.16 -.16 0 760.51 667.81)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
   <path id="hjw" transform="matrix(0 -.16 -.16 0 760.83 661.89)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
   <path id="hjx" transform="matrix(0 -.16 -.16 0 762.11 665.73)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
   <path id="hjy" transform="matrix(0 -.16 -.16 0 762.11 666.05)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
   <path id="hjz" transform="matrix(0 -.16 -.16 0 760.83 669.89)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
   <path id="hka" transform="matrix(0 -.16 -.16 0 760.51 663.97)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
   <path id="hkb" transform="matrix(0 -.16 -.16 0 760.67 664.13)" d="m5.0615 4.0781c-0.51463 0.63873-1.1455 1.1743-1.8593 1.5784"/>
   <path id="hkc" transform="matrix(0 -.16 -.16 0 761.79 668.77)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
   <path id="hkd" transform="matrix(0 -.16 -.16 0 761.47 663.97)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
   <path id="hke" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 5758v-23"/>
   <path id="hkf" transform="matrix(0 -.16 -.16 0 761.47 667.65)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
   <path id="hkg" transform="matrix(0 -.16 -.16 0 761.79 663.01)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
   <path id="hkh" transform="matrix(0 -.16 -.16 0 762.59 665.89)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
   <path id="hki" transform="matrix(0 -.16 -.16 0 762.59 665.89)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
   <path id="hkj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950 5932.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hkk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950 5927.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hkl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950 5929.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hkm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4959 5950v1h-19"/>
   <path id="hkn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938.6 5950h-0.2036"/>
   <path id="hko" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5950h21"/>
   <path id="hkp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5945h7"/>
   <path id="hkq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4966 5941.3c0.044 0.9556-0.3037 1.8877-0.9644 2.5796-0.6601 0.6919-1.5752 1.0835-2.5317 1.0835"/>
   <path id="hkr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5928.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5931.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hkt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4947 5928.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hku" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4947 5931.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hkv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.9 5944.6c-1.2012-0.6328-1.9278-1.9033-1.8643-3.2598"/>
   <path id="hkw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5950"/>
   <path id="hkx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952.7 5946c-0.5048 1.0991-1.541 1.8598-2.7407 2.0122-1.2002 0.1523-2.3935-0.3262-3.1562-1.2647"/>
   <path id="hky" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948.5 5946.8c-0.2031-0.084-0.3945-0.1943-0.5688-0.3286"/>
   <path id="hkz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4946.8 5942.3c0.7514-0.9238 1.9209-1.4028 3.1045-1.2705s2.2187 0.8574 2.7475 1.9248"/>
   <path id="hla" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948 5942.5c0.1743-0.1343 0.3657-0.2447 0.5688-0.3287"/>
   <path id="hlb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5945h5"/>
   <path id="hlc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5944 5-1"/>
   <path id="hld" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4960.9 5943.8c0.1269 0.4468 0.1269 0.9199 0 1.3662"/>
   <path id="hle" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4960 5944"/>
   <path id="hlf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4960 5945"/>
   <path id="hlg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5946h1"/>
   <path id="hlh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5945h-1 1"/>
   <path id="hli" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5943h-1 1"/>
   <path id="hlj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5942h1"/>
   <path id="hlk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953.8 5943.6c0.2012 0.5528 0.2012 1.1587 0 1.7115"/>
   <path id="hll" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5945v-1"/>
   <path id="hlm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5946v-3"/>
   <path id="hln" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4954 5946v-3"/>
   <path id="hlo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5946v-3"/>
   <path id="hlp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4954 5943h1"/>
   <path id="hlq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955.5 5944c0.1973 0.014 0.3677 0.1416 0.436 0.3271"/>
   <path id="hlr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5943h1"/>
   <path id="hls" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953.9 5943.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
   <path id="hlt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5946h-1"/>
   <path id="hlu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4956 5945.7c-0.068 0.1855-0.2387 0.3134-0.436 0.3271"/>
   <path id="hlv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5946h1"/>
   <path id="hlw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953.9 5946.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
   <path id="hlx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5945"/>
   <path id="hly" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5944.2c0.029 0.2182 0.029 0.4389 0 0.6572"/>
   <path id="hlz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952.2 5945.4c-0.2012-0.5528-0.2012-1.1592 0-1.712"/>
   <path id="hma" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951 5944.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
   <path id="hmb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951.6 5942.7c0.5015 1.1485 0.5015 2.4541-5e-4 3.6026"/>
   <path id="hmc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5946v-3 3"/>
   <path id="hmd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948.5 5942.2c0.6113-0.2524 1.2974-0.2524 1.9087 0"/>
   <path id="hme" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948 5942h2"/>
   <path id="hmf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951 5942.5c0.5244 0.4033 0.8677 0.998 0.9546 1.6533"/>
   <path id="hmg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951 5942 1 2"/>
   <path id="hmh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5943h-1"/>
   <path id="hmi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953.1 5943.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
   <path id="hmj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5943"/>
   <path id="hmk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950.5 5942.2c0.2036 0.084 0.395 0.1944 0.5693 0.3287"/>
   <path id="hml" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950.5 5946.8c-0.6113 0.2525-1.2979 0.2525-1.9092 0"/>
   <path id="hmm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950 5947h-2"/>
   <path id="hmn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5944.8c-0.087 0.6558-0.4307 1.2505-0.9551 1.6533"/>
   <path id="hmo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5945-1 1h1"/>
   <path id="hmp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951 5946"/>
   <path id="hmq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953.1 5946.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
   <path id="hmr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5946"/>
   <path id="hms" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5945"/>
   <path id="hmt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951 5946.5c-0.1743 0.1343-0.3657 0.2447-0.5688 0.3286"/>
   <path id="hmu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5947h-1"/>
   <path id="hmv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938.9 5948.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
   <path id="hmw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938.1 5948.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
   <path id="hmx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5949h-3"/>
   <path id="hmy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5946h-5"/>
   <path id="hmz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5942h-5 4"/>
   <path id="hna" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5940h4"/>
   <path id="hnb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940 5951h-7"/>
   <path id="hnc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.3 5950.2c2.0977-0.2422 4.2163-0.2422 6.314 5e-4"/>
   <path id="hnd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940 5951h-7"/>
   <path id="hne" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5946h1"/>
   <path id="hnf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5942h1"/>
   <path id="hng" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4947 5944.8c-0.029-0.2183-0.029-0.439 0-0.6572"/>
   <path id="hnh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4946.3 5946.6c-0.4194-1.4018-0.4194-2.896 0-4.2978"/>
   <path id="hni" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4944 5946v-4"/>
   <path id="hnj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4943 5946v-4h4"/>
   <path id="hnk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4947 5944.2c0.087-0.6558 0.4306-1.2505 0.9551-1.6533"/>
   <path id="hnl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4946 5944 1-2"/>
   <path id="hnm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4943 5946h4"/>
   <path id="hnn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948 5946.5c-0.5245-0.4028-0.8682-0.9975-0.9551-1.6533"/>
   <path id="hno" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4947 5946-1-1"/>
   <path id="hnp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941.2 5945.7c-0.2188-0.7881-0.2188-1.6211 0-2.4092"/>
   <path id="hnq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942.8 5943.3c0.2188 0.7886 0.2188 1.6211 0 2.4092"/>
   <path id="hnr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5946v-4"/>
   <path id="hns" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5946v-4"/>
   <path id="hnt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5942v4"/>
   <path id="hnu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938.4 5942.5c0.8642 1.2143 0.8637 2.8432-5e-4 4.0581"/>
   <path id="hnv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5942h2"/>
   <path id="hnw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5943h-1 1"/>
   <path id="hnx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5942h1"/>
   <path id="hny" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5943"/>
   <path id="hnz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942.8 5941.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
   <path id="hoa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5943"/>
   <path id="hob" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941.2 5943.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
   <path id="hoc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5942"/>
   <path id="hod" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5942v-2"/>
   <path id="hoe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5941"/>
   <path id="hof" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5940v1"/>
   <path id="hog" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939.2 5942.9c-0.1425-0.083-0.2348-0.2309-0.247-0.3955"/>
   <path id="hoh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5946h2"/>
   <path id="hoi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5947h1"/>
   <path id="hoj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5945h1"/>
   <path id="hok" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5946h1"/>
   <path id="hol" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942.8 5945.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
   <path id="hom" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5946v-1"/>
   <path id="hon" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941.2 5947.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
   <path id="hoo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5946v-1"/>
   <path id="hop" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5950"/>
   <path id="hoq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5946"/>
   <path id="hor" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5950v-1"/>
   <path id="hos" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5948v-1"/>
   <path id="hot" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5947"/>
   <path id="hou" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940 5951v-1"/>
   <path id="hov" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933 5951v-1"/>
   <path id="how" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934.4 5946.5c-0.5136-1.2988-0.5136-2.7442 0-4.043"/>
   <path id="hox" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.1 5940.1c0.914-0.1011 1.8364-0.1011 2.7505 5e-4"/>
   <path id="hoy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4936.9 5940.8c-0.094 0.1265-0.2427 0.2007-0.4004 0.2007s-0.3062-0.074-0.4004-0.2007"/>
   <path id="hoz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937 5940v1h-1v-1"/>
   <path id="hpa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 5942.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
   <path id="hpb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 5941h-1"/>
   <path id="hpc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5940"/>
   <path id="hpd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5941"/>
   <path id="hpe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 5940v1"/>
   <path id="hpf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5942v-2"/>
   <path id="hpg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937 5947h-2"/>
   <path id="hph" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937.7 5948.7c-0.7354 0.3921-1.6172 0.3921-2.3526 0"/>
   <path id="hpi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.5 5948.2c0.6157-0.2564 1.3076-0.2564 1.9233 0"/>
   <path id="hpj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937 5947v1-1"/>
   <path id="hpk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933 5950"/>
   <path id="hpl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5947"/>
   <path id="hpm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 5950v-1"/>
   <path id="hpn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5948v-1h1"/>
   <path id="hpo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.9 5948.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
   <path id="hpp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.1 5948.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
   <path id="hpq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 5947v1-1"/>
   <path id="hpr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933 5951"/>
   <path id="hps" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4965.6 5947.6c-1.2646 1.5698-3.1865 2.4639-5.2016 2.4204"/>
   <path id="hpt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4967 5944.9c-0.089 1.1001-0.5063 2.1484-1.1992 3.0078"/>
   <path id="hpu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4965.5 5930.3c1.2817 4.6987 1.7465 9.5825 1.374 14.438"/>
   <path id="hpv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4949.5 5916c7.9985 0.4428 14.675 6.2602 16.208 14.123"/>
   <path id="hpw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.3 5930.1c1.5347-7.8628 8.2115-13.68 16.21-14.122"/>
   <path id="hpx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4932.1 5944.8c-0.3726-4.8574 0.092-9.7426 1.375-14.442"/>
   <path id="hpy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.2 5948c-0.6929-0.8594-1.1104-1.9077-1.1992-3.0078"/>
   <path id="hpz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.3 5949.2c-0.7138-0.4039-1.3447-0.9395-1.8593-1.5782"/>
   <path id="hqa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4936 5938.1c-0.2295-4.5176 0.5161-9.0313 2.187-13.235"/>
   <path id="hqb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937.5 5939c-0.7974 0-1.4551-0.6235-1.4981-1.4199"/>
   <path id="hqc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937 5939h23"/>
   <path id="hqd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4962 5937.6c-0.043 0.7964-0.7006 1.4199-1.498 1.4199"/>
   <path id="hqe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4959.8 5924.9c1.67 4.2026 2.4156 8.7153 2.1861 13.232"/>
   <path id="hqf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948.8 5918c4.4571 0.1186 8.5137 2.602 10.646 6.5176"/>
   <path id="hqg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938.5 5924.5c2.1328-3.9155 6.1894-6.3984 10.647-6.5166"/>
   <path id="hqh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871 5932.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hqi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871 5927.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hqj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871 5929.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hqk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4860 5950v1h19"/>
   <path id="hql" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881.6 5950c-0.068 0-0.1358 5e-4 -0.2036 0"/>
   <path id="hqm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5950h-21"/>
   <path id="hqn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5945h-7"/>
   <path id="hqo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4857.5 5945c-0.9565 0-1.8716-0.3916-2.5317-1.0835-0.6607-0.6919-1.0093-1.6245-0.9644-2.5801"/>
   <path id="hqp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5928.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hqq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5931.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hqr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 5928.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hqs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 5931.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="hqt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4888 5941.3c0.063 1.356-0.6631 2.6265-1.8643 3.2593"/>
   <path id="hqu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5950"/>
   <path id="hqv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873.2 5946.7c-0.7627 0.9385-1.956 1.417-3.1562 1.2647-1.1997-0.1524-2.2359-0.9131-2.7408-2.0122"/>
   <path id="hqw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5946.5c-0.1743 0.1343-0.3657 0.2447-0.5688 0.3286"/>
   <path id="hqx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867.4 5942.9c0.5288-1.0669 1.5639-1.792 2.7475-1.9243 1.1836-0.1319 2.3535 0.3467 3.1045 1.271"/>
   <path id="hqy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871.5 5942.2c0.2036 0.084 0.395 0.1944 0.5693 0.3287"/>
   <path id="hqz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5945h-5"/>
   <path id="hra" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5944-5-1"/>
   <path id="hrb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859.1 5945.2c-0.1269-0.4468-0.1269-0.9194 0-1.3662"/>
   <path id="hrc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859 5944"/>
   <path id="hrd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859 5945"/>
   <path id="hre" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5946h-1"/>
   <path id="hrf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5945h1-1"/>
   <path id="hrg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5943h1-1"/>
   <path id="hrh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5942h-1"/>
   <path id="hri" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866.2 5945.4c-0.2012-0.5528-0.2012-1.1592 0-1.712"/>
   <path id="hrj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5945v-1"/>
   <path id="hrk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5946v-3"/>
   <path id="hrl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5946v-3"/>
   <path id="hrm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5946v-3"/>
   <path id="hrn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5943h-1"/>
   <path id="hro" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5944.3c0.068-0.1855 0.2387-0.3135 0.436-0.3271"/>
   <path id="hrp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5943h-1"/>
   <path id="hrq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866.1 5943.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
   <path id="hrr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5946h1"/>
   <path id="hrs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864.5 5946c-0.1973-0.014-0.3677-0.1416-0.436-0.3271"/>
   <path id="hrt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5946h-1"/>
   <path id="hru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866.1 5946.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
   <path id="hrv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5945"/>
   <path id="hrw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5944.8c-0.029-0.2183-0.029-0.439 0-0.6572"/>
   <path id="hrx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867.8 5943.6c0.2012 0.5528 0.2012 1.1587 0 1.7115"/>
   <path id="hry" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5944.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
   <path id="hrz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868.4 5946.3c-0.502-1.1485-0.502-2.4541 0-3.6026"/>
   <path id="hsa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5946v-3 3"/>
   <path id="hsb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869.5 5942.2c0.6113-0.2524 1.2979-0.2524 1.9092 0"/>
   <path id="hsc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871 5942h-2"/>
   <path id="hsd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5944.2c0.087-0.6558 0.4306-1.2505 0.9551-1.6533"/>
   <path id="hse" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5942-2 2"/>
   <path id="hsf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5943h1"/>
   <path id="hsg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866.9 5943.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
   <path id="hsh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5943"/>
   <path id="hsi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5942.5c0.1743-0.1343 0.3657-0.2447 0.5688-0.3287"/>
   <path id="hsj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871.5 5946.8c-0.6113 0.2525-1.2979 0.2525-1.9092 0"/>
   <path id="hsk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5947h2"/>
   <path id="hsl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5946.5c-0.5245-0.4028-0.8682-0.9975-0.9551-1.6533"/>
   <path id="hsm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5945 2 1"/>
   <path id="hsn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5946h-1"/>
   <path id="hso" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866.9 5946.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
   <path id="hsp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5946"/>
   <path id="hsq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5945"/>
   <path id="hsr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869.5 5946.8c-0.2031-0.084-0.3945-0.1943-0.5688-0.3286"/>
   <path id="hss" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5947h1"/>
   <path id="hst" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881.9 5948.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
   <path id="hsu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881.1 5948.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
   <path id="hsv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5949h4"/>
   <path id="hsw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5946h5"/>
   <path id="hsx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5942h5-4"/>
   <path id="hsy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5940h-4"/>
   <path id="hsz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4879 5951h7"/>
   <path id="hta" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880.3 5950.2c2.0976-0.2422 4.2158-0.2422 6.3134 0"/>
   <path id="htb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4879 5951h7"/>
   <path id="htc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5946h-1"/>
   <path id="htd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5942h-1"/>
   <path id="hte" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 5944.2c0.029 0.2182 0.029 0.4389 0 0.6572"/>
   <path id="htf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873.7 5942.4c0.4195 1.4018 0.4195 2.8955 0 4.2973"/>
   <path id="htg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4875 5946v-4"/>
   <path id="hth" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4876 5946v-4h-4"/>
   <path id="hti" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5942.5c0.5244 0.4033 0.8677 0.998 0.9546 1.6533"/>
   <path id="htj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 5944-1-2"/>
   <path id="htk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4876 5946h-4"/>
   <path id="htl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 5944.8c-0.087 0.6558-0.4307 1.2505-0.9551 1.6533"/>
   <path id="htm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5946 1-1"/>
   <path id="htn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878.8 5943.3c0.2188 0.7886 0.2188 1.6211 0 2.4092"/>
   <path id="hto" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877.2 5945.7c-0.2188-0.7881-0.2188-1.6211 0-2.4092"/>
   <path id="htp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5946v-4"/>
   <path id="htq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4879 5946v-4"/>
   <path id="htr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5942v4"/>
   <path id="hts" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881.6 5946.5c-0.8647-1.2149-0.8647-2.8438 0-4.0586"/>
   <path id="htt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5942h-2"/>
   <path id="htu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5943h1-1"/>
   <path id="htv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5942h-1"/>
   <path id="htw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5943"/>
   <path id="htx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877.2 5943.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
   <path id="hty" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5943"/>
   <path id="htz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878.8 5941.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
   <path id="hua" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5942"/>
   <path id="hub" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5942v-2"/>
   <path id="huc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5941"/>
   <path id="hud" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5940v1"/>
   <path id="hue" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5942.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
   <path id="huf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5946h-2"/>
   <path id="hug" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5947h-1"/>
   <path id="huh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5945h-1"/>
   <path id="hui" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5946h-1"/>
   <path id="huj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877.2 5947.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
   <path id="huk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5946v-1"/>
   <path id="hul" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878.8 5945.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
   <path id="hum" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5946v-1"/>
   <path id="hun" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5950"/>
   <path id="huo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5946"/>
   <path id="hup" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5950v-1"/>
   <path id="huq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5948v-1"/>
   <path id="hur" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5947"/>
   <path id="hus" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4879 5951v-1"/>
   <path id="hut" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886 5951v-1"/>
   <path id="huu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885.6 5942.5c0.5132 1.2988 0.5132 2.7441-5e-4 4.0425"/>
   <path id="huv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882.1 5940.1c0.9141-0.1011 1.8369-0.1011 2.751 0"/>
   <path id="huw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4883.9 5940.8c-0.094 0.1265-0.2427 0.2007-0.4004 0.2007s-0.3062-0.074-0.4004-0.2007"/>
   <path id="hux" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 5940v1h1v-1"/>
   <path id="huy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886.2 5942.9c-0.1425-0.083-0.2348-0.2309-0.247-0.3955"/>
   <path id="huz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5941h1"/>
   <path id="hva" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5940"/>
   <path id="hvb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5941"/>
   <path id="hvc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5940v1"/>
   <path id="hvd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5942v-2"/>
   <path id="hve" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 5947h2"/>
   <path id="hvf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884.7 5948.7c-0.7354 0.3921-1.6172 0.3921-2.3526 0"/>
   <path id="hvg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882.5 5948.2c0.6152-0.2564 1.3076-0.2564 1.9228 0"/>
   <path id="hvh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 5947v1-1"/>
   <path id="hvi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886 5950"/>
   <path id="hvj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5947"/>
   <path id="hvk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5950v-1"/>
   <path id="hvl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5948v-1h-1"/>
   <path id="hvm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885.9 5948.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
   <path id="hvn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885.1 5948.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
   <path id="hvo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5947v1-1"/>
   <path id="hvp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886 5951"/>
   <path id="hvq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859.6 5950c-2.0151 0.044-3.937-0.8506-5.2016-2.4204"/>
   <path id="hvr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4854.2 5948c-0.6929-0.8594-1.1104-1.9077-1.1992-3.0078"/>
   <path id="hvs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4853.1 5944.8c-0.3726-4.8574 0.092-9.7426 1.375-14.442"/>
   <path id="hvt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4854.3 5930.1c1.5347-7.8628 8.2115-13.68 16.21-14.122"/>
   <path id="hvu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870.5 5916c7.9985 0.4428 14.675 6.2602 16.208 14.123"/>
   <path id="hvv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886.5 5930.3c1.2817 4.6987 1.7465 9.5825 1.374 14.438"/>
   <path id="hvw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4888 5944.9c-0.089 1.1001-0.5063 2.1484-1.1992 3.0078"/>
   <path id="hvx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886.6 5947.6c-0.5146 0.6387-1.1455 1.1743-1.8594 1.5782"/>
   <path id="hvy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881.8 5924.9c1.67 4.2026 2.4156 8.7153 2.1861 13.232"/>
   <path id="hvz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5937.6c-0.043 0.7964-0.7006 1.4199-1.498 1.4199"/>
   <path id="hwa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 5939h-23"/>
   <path id="hwb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859.5 5939c-0.7974 0-1.4551-0.6235-1.4981-1.4199"/>
   <path id="hwc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4858 5938.1c-0.2295-4.5176 0.5161-9.0313 2.187-13.235"/>
   <path id="hwd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4860.5 5924.5c2.1328-3.9155 6.1894-6.3984 10.647-6.5166"/>
   <path id="hwe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870.8 5918c4.4571 0.1186 8.5137 2.602 10.646 6.5176"/>
   <path id="hwf" transform="matrix(0 -.16 -.16 0 762.43 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hwg" transform="matrix(0 -.16 -.16 0 763.23 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hwh" transform="matrix(0 -.16 -.16 0 762.75 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hwi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5906h-2v19"/>
   <path id="hwj" transform="matrix(0 -.16 -.16 0 760.67 636.93)" d="m0.06356 6.4997c-0.06792 6.6e-4 -0.13585 2.6e-4 -0.20376-0.0012"/>
   <path id="hwk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5927v-21"/>
   <path id="hwl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5910v-7"/>
   <path id="hwm" transform="matrix(0 -.16 -.16 0 760.83 640.77)" d="m0 3.5c-0.9566 0-1.8715-0.39154-2.532-1.0836s-1.0089-1.6242-0.96422-2.5798"/>
   <path id="hwn" transform="matrix(0 -.16 -.16 0 763.07 639.01)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hwo" transform="matrix(0 -.16 -.16 0 762.59 639.01)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hwp" transform="matrix(0 -.16 -.16 0 763.07 638.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hwq" transform="matrix(0 -.16 -.16 0 762.59 638.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="hwr" transform="matrix(0 -.16 -.16 0 760.83 636.45)" d="m3.4962-0.16302c0.06323 1.3561-0.66341 2.6264-1.8644 3.2593"/>
   <path id="hws" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5927"/>
   <path id="hwt" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m2.7159 2.2076c-0.7629 0.93855-1.9563 1.4167-3.1562 1.2646s-2.2362-0.91301-2.7407-2.0123"/>
   <path id="hwu" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
   <path id="hwv" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-3.136-1.5541c0.52883-1.0671 1.564-1.7921 2.7476-1.9242 1.1836-0.13217 2.3532 0.34658 3.1044 1.2707"/>
   <path id="hww" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
   <path id="hwx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5910v-5"/>
   <path id="hwy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5910v-5"/>
   <path id="hwz" transform="matrix(0 -.16 -.16 0 760.35 640.13)" d="m-2.4048 0.68317c-0.12687-0.44661-0.12687-0.91973 0-1.3663"/>
   <path id="hxa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5905"/>
   <path id="hxb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5905"/>
   <path id="hxc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5913v-1"/>
   <path id="hxd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5912v1-1"/>
   <path id="hxe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5912v1-1"/>
   <path id="hxf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5913v-1"/>
   <path id="hxg" transform="matrix(0 -.16 -.16 0 760.35 639.01)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
   <path id="hxh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5910h1"/>
   <path id="hxi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5910h3"/>
   <path id="hxj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5911h3"/>
   <path id="hxk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5912h3"/>
   <path id="hxl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5911v-1"/>
   <path id="hxm" transform="matrix(0 -.16 -.16 0 760.51 639.65)" d="m-0.4695-0.17196c0.06795-0.18551 0.23876-0.31362 0.43587-0.32691"/>
   <path id="hxn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5912v-1"/>
   <path id="hxo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5912"/>
   <path id="hxp" transform="matrix(0 -.16 -.16 0 760.67 639.17)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="hxq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5910v1"/>
   <path id="hxr" transform="matrix(0 -.16 -.16 0 760.35 639.65)" d="m-0.03363 0.49887c-0.19711-0.01329-0.36792-0.1414-0.43587-0.32691"/>
   <path id="hxs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5912v-1"/>
   <path id="hxt" transform="matrix(0 -.16 -.16 0 760.19 639.17)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="hxu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5912"/>
   <path id="hxv" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
   <path id="hxw" transform="matrix(0 -.16 -.16 0 760.35 639.49)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
   <path id="hxx" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
   <path id="hxy" transform="matrix(0 -.16 -.16 0 760.35 638.37)" d="m-4.1237 1.8015c-0.50176-1.1486-0.50176-2.4544 0-3.6029"/>
   <path id="hxz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5913h3l-3 1"/>
   <path id="hya" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-0.95449-2.3106c0.61127-0.25251 1.2977-0.25251 1.909 0"/>
   <path id="hyb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5918v-3"/>
   <path id="hyc" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
   <path id="hyd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5915-2-1"/>
   <path id="hye" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5913"/>
   <path id="hyf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5914"/>
   <path id="hyg" transform="matrix(0 -.16 -.16 0 760.67 639.17)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="hyh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5913v1"/>
   <path id="hyi" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
   <path id="hyj" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
   <path id="hyk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5915v3"/>
   <path id="hyl" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
   <path id="hym" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5914-2 1"/>
   <path id="hyn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5914"/>
   <path id="hyo" transform="matrix(0 -.16 -.16 0 760.19 639.17)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="hyp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5913"/>
   <path id="hyq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5913v1"/>
   <path id="hyr" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
   <path id="hys" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5927v1"/>
   <path id="hyt" transform="matrix(0 -.16 -.16 0 759.87 636.93)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="hyu" transform="matrix(0 -.16 -.16 0 759.87 636.93)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
   <path id="hyv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5927v4"/>
   <path id="hyw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5926v5"/>
   <path id="hyx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5926v5-4"/>
   <path id="hyy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5928"/>
   <path id="hyz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5927v4"/>
   <path id="hza" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5925v8"/>
   <path id="hzb" transform="matrix(0 -.16 -.16 0 755.07 636.61)" d="m-3.1569-27.318c2.0976-0.2424 4.2161-0.2424 6.3137 0"/>
   <path id="hzc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5925v8"/>
   <path id="hzd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5923v-1"/>
   <path id="hze" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5923v-1"/>
   <path id="hzf" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
   <path id="hzg" transform="matrix(0 -.16 -.16 0 760.35 639.33)" d="m7.1858-2.1482c0.41906 1.4017 0.41898 2.8954-2.1e-4 4.2971"/>
   <path id="hzh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5921h4"/>
   <path id="hzi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5922h4v-4"/>
   <path id="hzj" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
   <path id="hzk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5919 2-1"/>
   <path id="hzl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5922v-4"/>
   <path id="hzm" transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
   <path id="hzn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5918 2 1"/>
   <path id="hzo" transform="matrix(0 -.16 -.16 0 760.35 638.05)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
   <path id="hzp" transform="matrix(0 -.16 -.16 0 760.35 636.93)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
   <path id="hzq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5923h4"/>
   <path id="hzr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5925h4"/>
   <path id="hzs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5926h-4"/>
   <path id="hzt" transform="matrix(0 -.16 -.16 0 760.35 636.45)" d="m-2.8517 2.0293c-0.86445-1.2148-0.86445-2.8438 0-4.0586"/>
   <path id="hzu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5926v-3"/>
   <path id="hzv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5925v-2"/>
   <path id="hzw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5925v-2"/>
   <path id="hzx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5923h1"/>
   <path id="hzy" transform="matrix(0 -.16 -.16 0 760.67 637.41)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="hzz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5925h1"/>
   <path id="iaa" transform="matrix(0 -.16 -.16 0 760.67 637.41)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="iab" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5926h1"/>
   <path id="iac" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5927h1"/>
   <path id="iad" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5927h-1"/>
   <path id="iae" transform="matrix(0 -.16 -.16 0 760.83 637.09)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
   <path id="iaf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5926v-3"/>
   <path id="iag" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5923v2-2"/>
   <path id="iah" transform="matrix(0 -.16 -.16 0 760.03 637.41)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="iai" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5923"/>
   <path id="iaj" transform="matrix(0 -.16 -.16 0 760.03 637.41)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="iak" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5925"/>
   <path id="ial" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5926"/>
   <path id="iam" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5926"/>
   <path id="ian" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5927h3"/>
   <path id="iao" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5925 1 1"/>
   <path id="iap" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5933 1-1"/>
   <path id="iaq" transform="matrix(0 -.16 -.16 0 760.35 637.09)" d="m5.1152-2.0212c0.51319 1.2988 0.51312 2.7441-1.9e-4 4.0428"/>
   <path id="iar" transform="matrix(0 -.16 -.16 0 759.23 636.61)" d="m-1.3754-12.424c0.91414-0.1012 1.8367-0.1012 2.7508 0"/>
   <path id="ias" transform="matrix(0 -.16 -.16 0 760.99 636.61)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
   <path id="iat" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5928h-1v2h1"/>
   <path id="iau" transform="matrix(0 -.16 -.16 0 760.83 636.13)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
   <path id="iav" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 5931"/>
   <path id="iaw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5931h-1"/>
   <path id="iax" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5930"/>
   <path id="iay" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5931h1"/>
   <path id="iaz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5928v2"/>
   <path id="iba" transform="matrix(0 -.16 -.16 0 760.03 636.61)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
   <path id="ibb" transform="matrix(0 -.16 -.16 0 759.55 636.61)" d="m-0.96158-2.3077c0.61541-0.25643 1.3078-0.25643 1.9232 0"/>
   <path id="ibc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5928h-1 1"/>
   <path id="ibd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5932"/>
   <path id="ibe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5931"/>
   <path id="ibf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5931h3"/>
   <path id="ibg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5930v1"/>
   <path id="ibh" transform="matrix(0 -.16 -.16 0 759.87 636.29)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="ibi" transform="matrix(0 -.16 -.16 0 759.87 636.29)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
   <path id="ibj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5930h-1 1"/>
   <path id="ibk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5933"/>
   <path id="ibl" transform="matrix(0 -.16 -.16 0 760.67 640.29)" d="m0.1402 6.4985c-2.0154 0.04348-3.937-0.85061-5.2017-2.4204"/>
   <path id="ibm" transform="matrix(0 -.16 -.16 0 760.51 640.61)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
   <path id="ibn" transform="matrix(0 -.16 -.16 0 760.83 634.69)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
   <path id="ibo" transform="matrix(0 -.16 -.16 0 762.11 638.53)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
   <path id="ibp" transform="matrix(0 -.16 -.16 0 762.11 638.69)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
   <path id="ibq" transform="matrix(0 -.16 -.16 0 760.83 642.53)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
   <path id="ibr" transform="matrix(0 -.16 -.16 0 760.51 636.61)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
   <path id="ibs" transform="matrix(0 -.16 -.16 0 760.67 636.93)" d="m5.0615 4.0781c-0.51463 0.63873-1.1455 1.1743-1.8593 1.5784"/>
   <path id="ibt" transform="matrix(0 -.16 -.16 0 761.79 641.57)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
   <path id="ibu" transform="matrix(0 -.16 -.16 0 761.47 636.77)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
   <path id="ibv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 5928v-23"/>
   <path id="ibw" transform="matrix(0 -.16 -.16 0 761.47 640.45)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
   <path id="ibx" transform="matrix(0 -.16 -.16 0 761.79 635.65)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
   <path id="iby" transform="matrix(0 -.16 -.16 0 762.59 638.53)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
   <path id="ibz" transform="matrix(0 -.16 -.16 0 762.59 638.69)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
   <path id="ica" transform="matrix(0 -.16 -.16 0 762.43 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="icb" transform="matrix(0 -.16 -.16 0 763.23 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="icc" transform="matrix(0 -.16 -.16 0 762.75 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="icd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5814h-2v20"/>
   <path id="ice" transform="matrix(0 -.16 -.16 0 760.67 651.49)" d="m0.06356 6.4997c-0.06792 6.6e-4 -0.13585 2.6e-4 -0.20376-0.0012"/>
   <path id="icf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5836v-22"/>
   <path id="icg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5819v-8"/>
   <path id="ich" transform="matrix(0 -.16 -.16 0 760.83 655.49)" d="m0 3.5c-0.9566 0-1.8715-0.39154-2.532-1.0836s-1.0089-1.6242-0.96422-2.5798"/>
   <path id="ici" transform="matrix(0 -.16 -.16 0 763.07 653.73)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="icj" transform="matrix(0 -.16 -.16 0 762.59 653.73)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="ick" transform="matrix(0 -.16 -.16 0 763.07 652.93)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="icl" transform="matrix(0 -.16 -.16 0 762.59 652.93)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
   <path id="icm" transform="matrix(0 -.16 -.16 0 760.83 651.17)" d="m3.4962-0.16302c0.06323 1.3561-0.66341 2.6264-1.8644 3.2593"/>
   <path id="icn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5836"/>
   <path id="ico" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m2.7159 2.2076c-0.7629 0.93855-1.9563 1.4167-3.1562 1.2646s-2.2362-0.91301-2.7407-2.0123"/>
   <path id="icp" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
   <path id="icq" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-3.136-1.5541c0.52883-1.0671 1.564-1.7921 2.7476-1.9242 1.1836-0.13217 2.3532 0.34658 3.1044 1.2707"/>
   <path id="icr" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
   <path id="ics" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5818v-5"/>
   <path id="ict" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5818v-5"/>
   <path id="icu" transform="matrix(0 -.16 -.16 0 760.35 654.85)" d="m-2.4048 0.68317c-0.12687-0.44661-0.12687-0.91973 0-1.3663"/>
   <path id="icv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5813"/>
   <path id="icw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5813"/>
   <path id="icx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5821v-1"/>
   <path id="icy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5820v1-1"/>
   <path id="icz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5820v1-1"/>
   <path id="ida" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5821v-1"/>
   <path id="idb" transform="matrix(0 -.16 -.16 0 760.35 653.57)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
   <path id="idc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5818h1"/>
   <path id="idd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5819h-3 3"/>
   <path id="ide" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5820h3"/>
   <path id="idf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5819"/>
   <path id="idg" transform="matrix(0 -.16 -.16 0 760.51 654.21)" d="m-0.4695-0.17196c0.06795-0.18551 0.23876-0.31362 0.43587-0.32691"/>
   <path id="idh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5820v-1"/>
   <path id="idi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5820"/>
   <path id="idj" transform="matrix(0 -.16 -.16 0 760.67 653.89)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="idk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5819"/>
   <path id="idl" transform="matrix(0 -.16 -.16 0 760.35 654.21)" d="m-0.03363 0.49887c-0.19711-0.01329-0.36792-0.1414-0.43587-0.32691"/>
   <path id="idm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5820v-1"/>
   <path id="idn" transform="matrix(0 -.16 -.16 0 760.19 653.89)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
   <path id="ido" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5820"/>
   <path id="idp" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
   <path id="idq" transform="matrix(0 -.16 -.16 0 760.35 654.21)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
   <path id="idr" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
   <path id="ids" transform="matrix(0 -.16 -.16 0 760.35 653.09)" d="m-4.1237 1.8015c-0.50176-1.1486-0.50176-2.4544 0-3.6029"/>
   <path id="idt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5822h3-3"/>
   <path id="idu" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-0.95449-2.3106c0.61127-0.25251 1.2977-0.25251 1.909 0"/>
   <path id="idv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5826v-2"/>
   <path id="idw" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
   <path id="idx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5823-2-1"/>
   <path id="idy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5821"/>
   <path id="idz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5822"/>
   <path id="iea" transform="matrix(0 -.16 -.16 0 760.67 653.89)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="ieb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5822"/>
   <path id="iec" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
   <path id="ied" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
   <path id="iee" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5824v2"/>
   <path id="ief" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
   <path id="ieg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5822-2 1"/>
   <path id="ieh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5822"/>
   <path id="iei" transform="matrix(0 -.16 -.16 0 760.19 653.89)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
   <path id="iej" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5822"/>
   <path id="iek" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5821"/>
   <path id="iel" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
   <path id="iem" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5835v1"/>
   <path id="ien" transform="matrix(0 -.16 -.16 0 759.87 651.49)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="ieo" transform="matrix(0 -.16 -.16 0 759.87 651.49)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
   <path id="iep" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5836v3"/>
   <path id="ieq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5835v5"/>
   <path id="ier" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5840v-5 5"/>
   <path id="ies" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5836"/>
   <path id="iet" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5835v4"/>
   <path id="ieu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5834v7"/>
   <path id="iev" transform="matrix(0 -.16 -.16 0 755.07 651.33)" d="m-3.1569-27.318c2.0976-0.2424 4.2161-0.2424 6.3137 0"/>
   <path id="iew" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5834v7"/>
   <path id="iex" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5831v-1"/>
   <path id="iey" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5831v-1"/>
   <path id="iez" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
   <path id="ifa" transform="matrix(0 -.16 -.16 0 760.35 654.05)" d="m7.1858-2.1482c0.41906 1.4017 0.41898 2.8954-2.1e-4 4.2971"/>
   <path id="ifb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5827v3h-4 4"/>
   <path id="ifc" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
   <path id="ifd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5828 2-1"/>
   <path id="ife" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5830v-3"/>
   <path id="iff" transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
   <path id="ifg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5827 2 1"/>
   <path id="ifh" transform="matrix(0 -.16 -.16 0 760.35 652.61)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
   <path id="ifi" transform="matrix(0 -.16 -.16 0 760.35 651.49)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
   <path id="ifj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5831h4"/>
   <path id="ifk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5833h4"/>
   <path id="ifl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5834h-4"/>
   <path id="ifm" transform="matrix(0 -.16 -.16 0 760.35 651.17)" d="m-2.8517 2.0293c-0.86445-1.2148-0.86445-2.8438 0-4.0586"/>
   <path id="ifn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5834v-2"/>
   <path id="ifo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5833v-1"/>
   <path id="ifp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5833v-1"/>
   <path id="ifq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5832h1"/>
   <path id="ifr" transform="matrix(0 -.16 -.16 0 760.67 651.97)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="ifs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5833h1"/>
   <path id="ift" transform="matrix(0 -.16 -.16 0 760.67 652.13)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="ifu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5834 1 1h1"/>
   <path id="ifv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5836h-1v-1"/>
   <path id="ifw" transform="matrix(0 -.16 -.16 0 760.83 651.65)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
   <path id="ifx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5834v-2"/>
   <path id="ify" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5832v1-1"/>
   <path id="ifz" transform="matrix(0 -.16 -.16 0 760.03 651.97)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
   <path id="iga" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5832"/>
   <path id="igb" transform="matrix(0 -.16 -.16 0 760.03 652.13)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
   <path id="igc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5833"/>
   <path id="igd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5834"/>
   <path id="ige" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5834v1"/>
   <path id="igf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5836h1"/>
   <path id="igg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5835h2"/>
   <path id="igh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5834h1"/>
   <path id="igi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5841h1"/>
   <path id="igj" transform="matrix(0 -.16 -.16 0 760.35 651.81)" d="m5.1152-2.0212c0.51319 1.2988 0.51312 2.7441-1.9e-4 4.0428"/>
   <path id="igk" transform="matrix(0 -.16 -.16 0 759.23 651.33)" d="m-1.3754-12.424c0.91414-0.1012 1.8367-0.1012 2.7508 0"/>
   <path id="igl" transform="matrix(0 -.16 -.16 0 760.99 651.33)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
   <path id="igm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5837h-1v1h1"/>
   <path id="ign" transform="matrix(0 -.16 -.16 0 760.83 650.85)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
   <path id="igo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 5839v1"/>
   <path id="igp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5839h-1"/>
   <path id="igq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5840h1"/>
   <path id="igr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5836v2"/>
   <path id="igs" transform="matrix(0 -.16 -.16 0 760.03 651.33)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
   <path id="igt" transform="matrix(0 -.16 -.16 0 759.55 651.33)" d="m-0.96158-2.3077c0.61541-0.25643 1.3078-0.25643 1.9232 0"/>
   <path id="igu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5836h-1 1"/>
   <path id="igv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5840"/>
   <path id="igw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5840"/>
   <path id="igx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5839h1"/>
   <path id="igy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5840h2"/>
   <path id="igz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5839v1"/>
   <path id="iha" transform="matrix(0 -.16 -.16 0 759.87 651.01)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
   <path id="ihb" transform="matrix(0 -.16 -.16 0 759.87 651.01)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
   <path id="ihc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5838h-1v1h1"/>
   <path id="ihd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5841"/>
   <path id="ihe" transform="matrix(0 -.16 -.16 0 760.67 655.01)" d="m0.1402 6.4985c-2.0154 0.04348-3.937-0.85061-5.2017-2.4204"/>
   <path id="ihf" transform="matrix(0 -.16 -.16 0 760.51 655.17)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
   <path id="ihg" transform="matrix(0 -.16 -.16 0 760.83 649.25)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
   <path id="ihh" transform="matrix(0 -.16 -.16 0 762.11 653.09)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
   <path id="ihi" transform="matrix(0 -.16 -.16 0 762.11 653.41)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
   <path id="ihj" transform="matrix(0 -.16 -.16 0 760.83 657.25)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
   <path id="ihk" transform="matrix(0 -.16 -.16 0 760.51 651.33)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
   <path id="ihl" transform="matrix(0 -.16 -.16 0 760.67 651.49)" d="m5.0615 4.0781c-0.51463 0.63873-1.1455 1.1743-1.8593 1.5784"/>
   <path id="ihm" transform="matrix(0 -.16 -.16 0 761.79 656.29)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
   <path id="ihn" transform="matrix(0 -.16 -.16 0 761.47 651.49)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
   <path id="iho" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 5836v-23"/>
   <path id="ihp" transform="matrix(0 -.16 -.16 0 761.47 655.17)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
   <path id="ihq" transform="matrix(0 -.16 -.16 0 761.79 650.37)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
   <path id="ihr" transform="matrix(0 -.16 -.16 0 762.59 653.25)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
   <path id="ihs" transform="matrix(0 -.16 -.16 0 762.59 653.41)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
   <path id="iht" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498 7869.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ihu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498 7863.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ihv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498 7866.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ihw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4483 7893v2h26"/>
   <path id="ihx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.6 7893c-0.089 0-0.1777 5e-4 -0.2661 0"/>
   <path id="ihy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7893h-28"/>
   <path id="ihz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7887h-10"/>
   <path id="iia" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4479.5 7887c-1.23 0-2.4063-0.5034-3.2554-1.3931-0.8491-0.8896-1.2973-2.0884-1.2397-3.3169"/>
   <path id="iib" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4495 7864.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="iic" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4495 7868.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="iid" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7864.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="iie" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7868.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="iif" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4520 7882.3c0.081 1.7432-0.853 3.3765-2.397 4.1905"/>
   <path id="iig" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7893"/>
   <path id="iih" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7889.3c-0.9805 1.2065-2.5151 1.8213-4.0576 1.626-1.543-0.1959-2.875-1.1739-3.5239-2.5875"/>
   <path id="iii" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4499.6 7889.3c-0.2441 0.1875-0.5122 0.3423-0.7969 0.46"/>
   <path id="iij" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493.5 7884.5c0.6801-1.372 2.0112-2.3042 3.5327-2.4741 1.522-0.1699 3.0254 0.4458 3.9912 1.6338"/>
   <path id="iik" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498.8 7883.3c0.2847 0.1177 0.5528 0.2725 0.7969 0.4605"/>
   <path id="iil" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7886-7 1"/>
   <path id="iim" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7885h-7"/>
   <path id="iin" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4482.1 7887.5c-0.1777-0.6255-0.1777-1.2876 0-1.913"/>
   <path id="iio" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4482 7885"/>
   <path id="iip" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4482 7886"/>
   <path id="iiq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7888h-2"/>
   <path id="iir" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7887h2-2"/>
   <path id="iis" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7884h2-2"/>
   <path id="iit" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7883h-2"/>
   <path id="iiu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491.2 7887.7c-0.2817-0.7739-0.2817-1.6225 0-2.3964"/>
   <path id="iiv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7886v-1"/>
   <path id="iiw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7887v-3"/>
   <path id="iix" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4490 7888v-4"/>
   <path id="iiy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7888v-4"/>
   <path id="iiz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4490 7884h-1"/>
   <path id="ija" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7885.3c0.068-0.1855 0.2387-0.3135 0.436-0.3271"/>
   <path id="ijb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7884h-1"/>
   <path id="ijc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4492.1 7884.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
   <path id="ijd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7887 1 1"/>
   <path id="ije" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489.5 7887c-0.1973-0.014-0.3677-0.1416-0.436-0.3271"/>
   <path id="ijf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7888h-1"/>
   <path id="ijg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4492.1 7888.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
   <path id="ijh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7887"/>
   <path id="iji" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494 7887c-0.041-0.3052-0.041-0.6148 0-0.92"/>
   <path id="ijj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493.8 7885.3c0.2817 0.7739 0.2817 1.622 0 2.3959"/>
   <path id="ijk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4499 7886.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
   <path id="ijl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494.5 7888.7c-0.6133-1.4039-0.6133-2.9996 0-4.4034"/>
   <path id="ijm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7888v-4 4"/>
   <path id="ijn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4496.2 7883.3c0.8559-0.3535 1.8169-0.3535 2.6728 0"/>
   <path id="ijo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498 7882h-2"/>
   <path id="ijp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494 7886c0.1216-0.9179 0.6025-1.7505 1.3364-2.3149"/>
   <path id="ijq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4495 7883-2 2"/>
   <path id="ijr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7884h1"/>
   <path id="ijs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494 7883"/>
   <path id="ijt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4492.9 7884.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
   <path id="iju" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7884"/>
   <path id="ijv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4495.4 7883.7c0.2441-0.1875 0.5122-0.3423 0.7969-0.46"/>
   <path id="ijw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498.8 7889.7c-0.8559 0.3535-1.8169 0.3535-2.6728 0"/>
   <path id="ijx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4496 7889h2"/>
   <path id="ijy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4495.4 7889.3c-0.7339-0.5645-1.2148-1.397-1.3364-2.3149"/>
   <path id="ijz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7886 2 3"/>
   <path id="ika" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494 7888h-1"/>
   <path id="ikb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4492.9 7888.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
   <path id="ikc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7887v1-1 1-1"/>
   <path id="ikd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4496.2 7889.7c-0.2847-0.1177-0.5528-0.2725-0.7969-0.46"/>
   <path id="ike" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7890h1"/>
   <path id="ikf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.9 7891.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
   <path id="ikg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.1 7890.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
   <path id="ikh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7891h5"/>
   <path id="iki" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7888h7"/>
   <path id="ikj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7883h7"/>
   <path id="ikk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7882h5"/>
   <path id="ikl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4512 7880"/>
   <path id="ikm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7880h5"/>
   <path id="ikn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4509 7894h9"/>
   <path id="iko" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4509.4 7894.2c2.708-0.313 5.4424-0.313 8.1504 0"/>
   <path id="ikp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4509 7895h9"/>
   <path id="ikq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7888h-2"/>
   <path id="ikr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7883h-2"/>
   <path id="iks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7886c0.041 0.3057 0.041 0.6148 0 0.92"/>
   <path id="ikt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4500.6 7883.8c0.5307 1.7759 0.5307 3.6675-5e-4 5.4434"/>
   <path id="iku" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4500 7883h4v5-5"/>
   <path id="ikv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4499.6 7883.7c0.7344 0.5644 1.2148 1.3965 1.3364 2.3144"/>
   <path id="ikw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7885-2-2"/>
   <path id="ikx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4504 7888h-4"/>
   <path id="iky" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7887c-0.1216 0.9179-0.6025 1.7504-1.3364 2.3149"/>
   <path id="ikz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4499 7889 2-3"/>
   <path id="ila" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4507.8 7885c0.2676 0.9634 0.2676 1.9815 0 2.9449"/>
   <path id="ilb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506.2 7888c-0.2676-0.9634-0.2676-1.982 0-2.9454"/>
   <path id="ilc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7888v-5"/>
   <path id="ild" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4508 7888v-5"/>
   <path id="ile" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7883v5"/>
   <path id="ilf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.8 7889.1c-1.1113-1.5615-1.1113-3.6563 0-5.2178"/>
   <path id="ilg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7883h-2"/>
   <path id="ilh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7884h2-2"/>
   <path id="ili" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4508 7882h-2"/>
   <path id="ilj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7884"/>
   <path id="ilk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506.2 7884.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
   <path id="ill" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4508 7884"/>
   <path id="ilm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4507.8 7882.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
   <path id="iln" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7883"/>
   <path id="ilo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7882v-2"/>
   <path id="ilp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7881"/>
   <path id="ilq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7880v1"/>
   <path id="ilr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7882.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
   <path id="ils" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7888h-2"/>
   <path id="ilt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4508 7889h-2"/>
   <path id="ilu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7887h2-2"/>
   <path id="ilv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506.2 7889.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
   <path id="ilw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7887"/>
   <path id="ilx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4507.8 7887.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
   <path id="ily" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4508 7887"/>
   <path id="ilz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4509 7893"/>
   <path id="ima" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7888"/>
   <path id="imb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7893v-4"/>
   <path id="imc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7889"/>
   <path id="imd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4509 7895v-2"/>
   <path id="ime" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4518 7894v-1"/>
   <path id="imf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516.5 7883.7c0.6997 1.7715 0.6997 3.7422 0 5.5132"/>
   <path id="img" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.7 7879.1c1.2065-0.1333 2.4243-0.1333 3.6308 0"/>
   <path id="imh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4514.7 7881.4c-0.2832 0.379-0.7286 0.6021-1.2017 0.6021s-0.9185-0.2231-1.2017-0.6021"/>
   <path id="imi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4513 7880v1h1v-1"/>
   <path id="imj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4517.2 7882.9c-0.1425-0.083-0.2348-0.2309-0.247-0.3955"/>
   <path id="imk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7881h1"/>
   <path id="iml" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 7880"/>
   <path id="imm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 7881"/>
   <path id="imn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7880v1"/>
   <path id="imo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 7882v-2"/>
   <path id="imp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4512 7890h3"/>
   <path id="imq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4514.7 7890.7c-0.7354 0.3921-1.6172 0.3921-2.3526 0"/>
   <path id="imr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4512.2 7890.3c0.8613-0.3588 1.8311-0.3588 2.6924 0"/>
   <path id="ims" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4512 7890v1-1"/>
   <path id="imt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4517 7893"/>
   <path id="imu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 7889"/>
   <path id="imv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7893v-2"/>
   <path id="imw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 7891v-2"/>
   <path id="imx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7890h1"/>
   <path id="imy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516.9 7891.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
   <path id="imz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516.1 7890.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
   <path id="ina" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7890v1-1"/>
   <path id="inb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4518 7895v-1"/>
   <path id="inc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4483.7 7893c-2.6353 0.057-5.1479-1.1123-6.8022-3.165"/>
   <path id="ind" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4476.4 7889.6c-0.8184-1.0156-1.3125-2.2544-1.4175-3.5547"/>
   <path id="ine" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4475.2 7886.7c-0.4781-6.229 0.1186-12.494 1.7631-18.52"/>
   <path id="inf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4476.4 7867.2c1.9727-10.109 10.558-17.588 20.842-18.157"/>
   <path id="ing" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4497.7 7849c10.284 0.5698 18.868 8.0493 20.84 18.159"/>
   <path id="inh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4518.1 7868.2c1.6436 6.0249 2.2398 12.288 1.7617 18.515"/>
   <path id="ini" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4520 7886c-0.105 1.3003-0.5991 2.5391-1.4175 3.5547"/>
   <path id="inj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4518.1 7889.8c-0.6733 0.835-1.498 1.5356-2.4316 2.064"/>
   <path id="ink" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.1 7860.5c2.147 5.4033 3.1055 11.206 2.81 17.013"/>
   <path id="inl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7877.6c-0.071 1.3266-1.168 2.3662-2.4966 2.3662"/>
   <path id="inm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4512 7879h-30"/>
   <path id="inn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4482.5 7880c-1.3286 0-2.4253-1.0396-2.4966-2.3662"/>
   <path id="ino" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4481.1 7877.6c-0.2955-5.8081 0.6635-11.612 2.8115-17.016"/>
   <path id="inp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4484 7860.6c2.8154-5.1685 8.1704-8.4463 14.054-8.602"/>
   <path id="inq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4497.9 7852c5.8833 0.1562 11.238 3.4345 14.053 8.6035"/>
   <path id="inr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4572 7870.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ins" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4572 7863.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="int" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4572 7867.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="inu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4557 7893v3h26"/>
   <path id="inv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.6 7894c-0.089 0-0.1777 5e-4 -0.2661 0"/>
   <path id="inw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7893h-28"/>
   <path id="inx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7887h-10"/>
   <path id="iny" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4553.5 7888c-1.23 0-2.4063-0.5034-3.2554-1.3931-0.8491-0.8896-1.2973-2.0884-1.2397-3.3169"/>
   <path id="inz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4569 7865.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ioa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4569 7868.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="iob" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4576 7865.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="ioc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4576 7868.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
   <path id="iod" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4594 7883.3c0.081 1.7432-0.853 3.3765-2.397 4.1905"/>
   <path id="ioe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7893"/>
   <path id="iof" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4575 7889.3c-0.9805 1.2065-2.5151 1.8213-4.0576 1.626-1.543-0.1959-2.875-1.1739-3.5239-2.5875"/>
   <path id="iog" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4573.6 7889.3c-0.2441 0.1875-0.5122 0.3423-0.7969 0.46"/>
   <path id="ioh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567.5 7884.5c0.6801-1.372 2.0112-2.3042 3.5327-2.4741 1.522-0.1699 3.0254 0.4458 3.9912 1.6338"/>
   <path id="ioi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4572.8 7883.3c0.2847 0.1177 0.5528 0.2725 0.7969 0.4605"/>
   <path id="ioj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7887h-7"/>
   <path id="iok" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7885h-7"/>
   <path id="iol" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4556.1 7887.5c-0.1777-0.6255-0.1777-1.2876 0-1.913"/>
   <path id="iom" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4556 7885"/>
   <path id="ion" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4556 7887"/>
   <path id="ioo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7889h-2"/>
   <path id="iop" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7888h-2"/>
   <path id="ioq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7887h-2"/>
   <path id="ior" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7885h2-2"/>
   <path id="ios" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7884h-2"/>
   <path id="iot" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4566.2 7887.7c-0.2817-0.7739-0.2817-1.6225 0-2.3964"/>
   <path id="iou" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7887v-2"/>
   <path id="iov" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7888v-4"/>
   <path id="iow" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4564 7888v-4"/>
   <path id="iox" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7888v-4"/>
   <path id="ioy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4564 7884h-1"/>
   <path id="ioz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7886.3c0.068-0.1855 0.2387-0.3135 0.436-0.3271"/>
   <path id="ipa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7884h-1"/>
   <path id="ipb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7885"/>
   <path id="ipc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4566.1 7884.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
   <path id="ipd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7888h1"/>
   <path id="ipe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563.5 7888c-0.1973-0.014-0.3677-0.1416-0.436-0.3271"/>
   <path id="ipf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7888h-1"/>
   <path id="ipg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4566.1 7888.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
   <path id="iph" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7888v-1"/>
   <path id="ipi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4568 7887c-0.041-0.3052-0.041-0.6148 0-0.92"/>
   <path id="ipj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567.8 7885.3c0.2817 0.7739 0.2817 1.622 0 2.3959"/>
   <path id="ipk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4573 7886.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
   <path id="ipl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4568.5 7888.7c-0.6133-1.4039-0.6133-2.9996 0-4.4034"/>
   <path id="ipm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7888v-4 4"/>
   <path id="ipn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4570.2 7883.3c0.8559-0.3535 1.8169-0.3535 2.6728 0"/>
   <path id="ipo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4573 7883h-3"/>
   <path id="ipp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4568 7886c0.1216-0.9179 0.6025-1.7505 1.3364-2.3149"/>
   <path id="ipq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4569 7883-2 3"/>
   <path id="ipr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7885"/>
   <path id="ips" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4568 7884h-1"/>
   <path id="ipt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4566.9 7884.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
   <path id="ipu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7884"/>
   <path id="ipv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4569.4 7883.7c0.2441-0.1875 0.5122-0.3423 0.7969-0.46"/>
   <path id="ipw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4572.8 7889.7c-0.8559 0.3535-1.8169 0.3535-2.6728 0"/>
   <path id="ipx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4570 7890h3"/>
   <path id="ipy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4569.4 7889.3c-0.7339-0.5645-1.2148-1.397-1.3364-2.3149"/>
   <path id="ipz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7887 2 2"/>
   <path id="iqa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4568 7888h-1"/>
   <path id="iqb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4566.9 7888.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
   <path id="iqc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7887v1"/>
   <path id="iqd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4570.2 7889.7c-0.2847-0.1177-0.5528-0.2725-0.7969-0.46"/>
   <path id="iqe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7890h1"/>
   <path id="iqf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.9 7891.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
   <path id="iqg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.1 7891.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
   <path id="iqh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7892h5"/>
   <path id="iqi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7889h7"/>
   <path id="iqj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7883h7"/>
   <path id="iqk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7883h5"/>
   <path id="iql" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4586 7880"/>
   <path id="iqm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7880h5"/>
   <path id="iqn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583 7895h9"/>
   <path id="iqo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583.4 7894.2c2.708-0.313 5.4424-0.313 8.1504 0"/>
   <path id="iqp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583 7896h9"/>
   <path id="iqq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7888h-2"/>
   <path id="iqr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7884h-2"/>
   <path id="iqs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4575 7886c0.041 0.3057 0.041 0.6148 0 0.92"/>
   <path id="iqt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4574.6 7883.8c0.5307 1.7759 0.5307 3.6675-5e-4 5.4434"/>
   <path id="iqu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4574 7883h4v6-6"/>
   <path id="iqv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4573.6 7883.7c0.7344 0.5644 1.2148 1.3965 1.3364 2.3144"/>
   <path id="iqw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4575 7886-2-3"/>
   <path id="iqx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4578 7889h-4"/>
   <path id="iqy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4575 7887c-0.1216 0.9179-0.6025 1.7504-1.3364 2.3149"/>
   <path id="iqz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4573 7889 2-2"/>
   <path id="ira" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4581.8 7885c0.2676 0.9634 0.2676 1.9815 0 2.9449"/>
   <path id="irb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580.2 7888c-0.2676-0.9634-0.2676-1.982 0-2.9454"/>
   <path id="irc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7889v-6"/>
   <path id="ird" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7889v-6"/>
   <path id="ire" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7883v6"/>
   <path id="irf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.8 7889.1c-1.1113-1.5615-1.1113-3.6563 0-5.2178"/>
   <path id="irg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7883h-2"/>
   <path id="irh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7884h-2"/>
   <path id="iri" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7885h-2"/>
   <path id="irj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7883h-2"/>
   <path id="irk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7885v-1"/>
   <path id="irl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580.2 7884.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
   <path id="irm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7885v-1"/>
   <path id="irn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4581.8 7882.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
   <path id="iro" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7883"/>
   <path id="irp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7883v-2"/>
   <path id="irq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7880v1"/>
   <path id="irr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7883.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
   <path id="irs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7889h-4"/>
   <path id="irt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7888h2-2"/>
   <path id="iru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580.2 7890.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
   <path id="irv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7888"/>
   <path id="irw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4581.8 7888.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
   <path id="irx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7888"/>
   <path id="iry" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583 7894"/>
   <path id="irz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7889"/>
   <path id="isa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7893v-1"/>
   <path id="isb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7891v-2"/>
   <path id="isc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7889"/>
   <path id="isd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583 7896v-2"/>
   <path id="ise" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592 7895v-1"/>
   <path id="isf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590.5 7883.7c0.6997 1.7715 0.6997 3.7422 0 5.5132"/>
   <path id="isg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.7 7880.1c1.2065-0.1333 2.4243-0.1333 3.6308 0"/>
   <path id="ish" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4588.7 7882.4c-0.2832 0.379-0.7286 0.6021-1.2017 0.6021s-0.9185-0.2231-1.2017-0.6021"/>
   <path id="isi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4587 7880v1h1v-1"/>
   <path id="isj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4591.2 7883.9c-0.1425-0.083-0.2348-0.2309-0.247-0.3955"/>
   <path id="isk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4589 7881h1"/>
   <path id="isl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590 7880"/>
   <path id="ism" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4589 7881v-1"/>
   <path id="isn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590 7883v-2"/>
   <path id="iso" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4586 7890h3"/>
   <path id="isp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4588.7 7891.7c-0.7354 0.3921-1.6172 0.3921-2.3526 0"/>
   <path id="isq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4586.2 7890.3c0.8613-0.3588 1.8311-0.3588 2.6924 0"/>
   <path id="isr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4586 7890v1-1"/>
   <path id="iss" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592 7894"/>
   <path id="ist" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4591 7889"/>
   <path id="isu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590 7893v-1"/>
   <path id="isv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590 7891v-2"/>
   <path id="isw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4589 7890h1"/>
   <path id="isx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590.9 7891.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
   <path id="isy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590.1 7891.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
   <path id="isz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4589 7890v1-1"/>
   <path id="ita" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592 7896v-1"/>
   <path id="itb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4557.7 7894c-2.6353 0.057-5.1479-1.1123-6.8022-3.165"/>
   <path id="itc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4551.4 7890.6c-0.8184-1.0156-1.3125-2.2544-1.4175-3.5547"/>
   <path id="itd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4549.2 7886.7c-0.4781-6.229 0.1186-12.494 1.7631-18.52"/>
   <path id="ite" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4550.4 7868.2c1.9727-10.109 10.558-17.588 20.842-18.157"/>
   <path id="itf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4571.7 7850c10.284 0.5698 18.868 8.0493 20.84 18.159"/>
   <path id="itg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592.1 7868.2c1.6436 6.0249 2.2398 12.288 1.7617 18.515"/>
   <path id="ith" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4594 7887c-0.105 1.3003-0.5991 2.5391-1.4175 3.5547"/>
   <path id="iti" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592.1 7890.8c-0.6733 0.835-1.498 1.5356-2.4316 2.064"/>
   <path id="itj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.1 7860.5c2.147 5.4033 3.1055 11.206 2.81 17.013"/>
   <path id="itk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4589 7877.6c-0.071 1.3266-1.168 2.3662-2.4966 2.3662"/>
   <path id="itl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4586 7879h-30"/>
   <path id="itm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4556.5 7880c-1.3286 0-2.4253-1.0396-2.4966-2.3662"/>
   <path id="itn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4555.1 7877.6c-0.2955-5.8081 0.6635-11.612 2.8115-17.016"/>
   <path id="ito" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4558 7860.6c2.8154-5.1685 8.1704-8.4463 14.054-8.602"/>
   <path id="itp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4571.9 7852c5.8833 0.1562 11.238 3.4345 14.053 8.6035"/>
  </g>
  <g id="itq" stroke="#989898" stroke-linecap="round" stroke-miterlimit="10">
   <g id="itr" fill="none" stroke-linejoin="round" stroke-width="3">
    <path id="its" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5458h-25v-26h25v26"/>
    <path id="itt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5971h-25v-26h25v26"/>
    <path id="itu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 3183h-25v-26h25v26"/>
    <path id="itv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 3670h-25v-26h25v26"/>
    <path id="itw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 4157h-25v-26h25v26"/>
    <path id="itx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 4680h-25v-25h25v25"/>
    <path id="ity" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 6604h-25v-26h25v26"/>
    <path id="itz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 7378h-25v-26h25v26"/>
   </g>
   <path id="iua" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 7352h25l-25 26zm25 0-25 26h25z" fill="#989898"/>
  </g>
  <path id="iub" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1274 5404h-10" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
  <g id="iuc" stroke="#dbdbdb" stroke-linecap="round" stroke-miterlimit="10">
   <g id="iud" fill="none" stroke-linejoin="round">
    <g id="iue">
     <path id="iuf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781v187"/>
     <path id="iug" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 7599v-103 103"/>
     <path id="iuh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8159v130-130"/>
     <path id="iui" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8289h197-197"/>
     <path id="iuj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8289v-130 130"/>
     <path id="iuk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8159h-197 197"/>
     <path id="iul" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8159"/>
     <path id="ium" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8289"/>
     <path id="iun" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8159"/>
     <path id="iuo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8289"/>
     <path id="iup" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8159"/>
     <path id="iuq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 6335h-214"/>
     <path id="iur" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 6210h-214"/>
     <path id="ius" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5945h7v-315h-7 7v315h-7"/>
     <path id="iut" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5630v315-315"/>
     <path id="iuu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5945"/>
     <path id="iuv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5630"/>
     <path id="iuw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5630"/>
     <path id="iux" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5945"/>
     <path id="iuy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5630"/>
     <path id="iuz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5945"/>
     <path id="iva" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5945"/>
     <path id="ivb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5630"/>
     <path id="ivc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1379v22h-21"/>
    </g>
    <g id="ivd" stroke-width="2">
     <path id="ive" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 3164v-237l267-266"/>
     <path id="ivf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4719 5007v-1202"/>
     <path id="ivg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4719 5049v1203"/>
     <path id="ivh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4719 6293v581"/>
     <path id="ivi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 2255-42 41"/>
     <path id="ivj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 2296-42-41"/>
     <path id="ivk" transform="matrix(0 -.16 -.16 0 580.35 1221.3)" d="m20.5 0c0 11.322-9.1782 20.5-20.5 20.5s-20.5-9.1782-20.5-20.5 9.1782-20.5 20.5-20.5 20.5 9.1782 20.5 20.5"/>
     <path id="ivl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938v-51h83v51h-83 83v-51h-83v51"/>
     <path id="ivm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
     <path id="ivn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1887"/>
     <path id="ivo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
     <path id="ivp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1887"/>
     <path id="ivq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938"/>
     <path id="ivr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672v-41h41v41h-41 41v-41h-41v41"/>
     <path id="ivs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
     <path id="ivt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1631"/>
     <path id="ivu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
     <path id="ivv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1631"/>
     <path id="ivw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672"/>
     <path id="ivx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401v-41h41v41h-41 41v-41h-41v41"/>
     <path id="ivy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
     <path id="ivz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1360"/>
     <path id="iwa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
     <path id="iwb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1360"/>
     <path id="iwc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401"/>
     <path id="iwd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401v-41h41v41h-41 41v-41h-41v41"/>
     <path id="iwe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
     <path id="iwf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1360"/>
     <path id="iwg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
     <path id="iwh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1360"/>
     <path id="iwi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401"/>
     <path id="iwj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401v-41h41v41h-41 41v-41h-41v41"/>
     <path id="iwk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
     <path id="iwl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1360"/>
     <path id="iwm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
     <path id="iwn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1360"/>
     <path id="iwo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401"/>
     <path id="iwp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401v-41h42v41h-42 42v-41h-42v41"/>
     <path id="iwq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
     <path id="iwr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1360"/>
     <path id="iws" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
     <path id="iwt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1360"/>
     <path id="iwu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401"/>
     <path id="iwv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401v-41h42v41h-42 42v-41h-42v41"/>
     <path id="iww" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
     <path id="iwx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1360"/>
     <path id="iwy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
     <path id="iwz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1360"/>
     <path id="ixa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401"/>
     <path id="ixb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401v-41h41v41h-41 41v-41h-41v41"/>
     <path id="ixc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
     <path id="ixd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360"/>
     <path id="ixe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
     <path id="ixf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1360"/>
     <path id="ixg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401"/>
     <path id="ixh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401v-41h41v41h-41 41v-41h-41v41"/>
     <path id="ixi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
     <path id="ixj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1360"/>
     <path id="ixk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
     <path id="ixl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1360"/>
     <path id="ixm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401"/>
     <path id="ixn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672v-41h42v41h-42 42v-41h-42v41"/>
     <path id="ixo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
     <path id="ixp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1631"/>
     <path id="ixq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
     <path id="ixr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1631"/>
     <path id="ixs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672"/>
     <path id="ixt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401v-41h42v41h-42 42v-41h-42v41"/>
     <path id="ixu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
     <path id="ixv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1360"/>
     <path id="ixw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
     <path id="ixx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1360"/>
     <path id="ixy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401"/>
     <path id="ixz" transform="matrix(0 .16 .16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="iya" transform="matrix(0 -.16 -.16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="iyb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1354"/>
     <path id="iyc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
     <path id="iyd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1405"/>
     <path id="iye" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3082 1379"/>
     <path id="iyf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
     <path id="iyg" transform="matrix(0 .16 .16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="iyh" transform="matrix(0 -.16 -.16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="iyi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1354"/>
     <path id="iyj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
     <path id="iyk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1405"/>
     <path id="iyl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3290 1379"/>
     <path id="iym" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
     <path id="iyn" transform="matrix(0 .16 .16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="iyo" transform="matrix(0 -.16 -.16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="iyp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1354"/>
     <path id="iyq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
     <path id="iyr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1405"/>
     <path id="iys" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 1379"/>
     <path id="iyt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
     <path id="iyu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938v-51h83v51h-83 83v-51h-83v51"/>
     <path id="iyv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
     <path id="iyw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1887"/>
     <path id="iyx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
     <path id="iyy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1887"/>
     <path id="iyz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938"/>
     <path id="iza" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 1938v571"/>
     <path id="izb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561v-52h83v52h-83 83v-52h-83v52"/>
     <path id="izc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
     <path id="izd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2509"/>
     <path id="ize" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
     <path id="izf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2509"/>
     <path id="izg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561"/>
     <path id="izh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188v-52h83v52h-83 83v-52h-83v52"/>
     <path id="izi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
     <path id="izj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3136"/>
     <path id="izk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
     <path id="izl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3136"/>
     <path id="izm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188"/>
     <path id="izn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810v-52h83v52h-83 83v-52h-83v52"/>
     <path id="izo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
     <path id="izp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3758"/>
     <path id="izq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
     <path id="izr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3758"/>
     <path id="izs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810"/>
     <path id="izt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432v-52h83v52h-83 83v-52h-83v52"/>
     <path id="izu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
     <path id="izv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4380"/>
     <path id="izw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
     <path id="izx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4380"/>
     <path id="izy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432"/>
     <path id="izz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054v-52h83v52h-83 83v-52h-83v52"/>
     <path id="jaa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
     <path id="jab" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5002"/>
     <path id="jac" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
     <path id="jad" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5002"/>
     <path id="jae" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054"/>
     <path id="jaf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676v-52h83v52h-83 83v-52h-83v52"/>
     <path id="jag" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
     <path id="jah" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5624"/>
     <path id="jai" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
     <path id="jaj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5624"/>
     <path id="jak" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676"/>
     <path id="jal" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298v-52h83v52h-83 83v-52h-83v52"/>
     <path id="jam" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
     <path id="jan" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6246"/>
     <path id="jao" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
     <path id="jap" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6246"/>
     <path id="jaq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298"/>
     <path id="jar" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920v-51h83v51h-83 83v-51h-83v51"/>
     <path id="jas" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
     <path id="jat" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6869"/>
     <path id="jau" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
     <path id="jav" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6869"/>
     <path id="jaw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920"/>
     <path id="jax" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542v-51h83v51h-83 83v-51h-83v51"/>
     <path id="jay" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
     <path id="jaz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7491"/>
     <path id="jba" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
     <path id="jbb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7491"/>
     <path id="jbc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542"/>
     <path id="jbd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599v-41 41"/>
     <path id="jbe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558h-41 41"/>
     <path id="jbf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558v41-41"/>
     <path id="jbg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41-41"/>
     <path id="jbh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
     <path id="jbi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558"/>
     <path id="jbj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
     <path id="jbk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558"/>
     <path id="jbl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599"/>
     <path id="jbm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781v-41 41"/>
     <path id="jbn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740h-41 41"/>
     <path id="jbo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740v41-41"/>
     <path id="jbp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41-41"/>
     <path id="jbq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
     <path id="jbr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740"/>
     <path id="jbs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
     <path id="jbt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740"/>
     <path id="jbu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781"/>
     <path id="jbv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159v-41 41"/>
     <path id="jbw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118h-41 41"/>
     <path id="jbx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118v41-41"/>
     <path id="jby" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159h41-41"/>
     <path id="jbz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
     <path id="jca" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118"/>
     <path id="jcb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
     <path id="jcc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118"/>
     <path id="jcd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159"/>
     <path id="jce" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561v-52h83v52h-83 83v-52h-83v52"/>
     <path id="jcf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
     <path id="jcg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2509"/>
     <path id="jch" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
     <path id="jci" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2509"/>
     <path id="jcj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561"/>
     <path id="jck" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188v-52h83v52h-83 83v-52h-83v52"/>
     <path id="jcl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
     <path id="jcm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3136"/>
     <path id="jcn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
     <path id="jco" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3136"/>
     <path id="jcp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188"/>
     <path id="jcq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810v-52h83v52h-83 83v-52h-83v52"/>
     <path id="jcr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
     <path id="jcs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3758"/>
     <path id="jct" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
     <path id="jcu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3758"/>
     <path id="jcv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810"/>
     <path id="jcw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432v-52h83v52h-83 83v-52h-83v52"/>
     <path id="jcx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
     <path id="jcy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4380"/>
     <path id="jcz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
     <path id="jda" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4380"/>
     <path id="jdb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432"/>
     <path id="jdc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054v-52h83v52h-83 83v-52h-83v52"/>
     <path id="jdd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
     <path id="jde" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5002"/>
     <path id="jdf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
     <path id="jdg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5002"/>
     <path id="jdh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054"/>
     <path id="jdi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676v-52h83v52h-83 83v-52h-83v52"/>
     <path id="jdj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
     <path id="jdk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5624"/>
     <path id="jdl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
     <path id="jdm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5624"/>
     <path id="jdn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676"/>
     <path id="jdo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298v-52h83v52h-83 83v-52h-83v52"/>
     <path id="jdp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
     <path id="jdq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6246"/>
     <path id="jdr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
     <path id="jds" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6246"/>
     <path id="jdt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298"/>
     <path id="jdu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920v-51h83v51h-83 83v-51h-83v51"/>
     <path id="jdv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
     <path id="jdw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6869"/>
     <path id="jdx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
     <path id="jdy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6869"/>
     <path id="jdz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920"/>
     <path id="jea" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542v-51h83v51h-83 83v-51h-83v51"/>
     <path id="jeb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
     <path id="jec" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7491"/>
     <path id="jed" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
     <path id="jee" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7491"/>
     <path id="jef" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542"/>
     <path id="jeg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781v-41 41"/>
     <path id="jeh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740h-42 42"/>
     <path id="jei" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740v41-41"/>
     <path id="jej" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42-42"/>
     <path id="jek" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
     <path id="jel" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740"/>
     <path id="jem" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
     <path id="jen" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740"/>
     <path id="jeo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781"/>
     <path id="jep" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159v-41 41"/>
     <path id="jeq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118h-42 42"/>
     <path id="jer" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118v41-41"/>
     <path id="jes" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42-42"/>
     <path id="jet" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
     <path id="jeu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118"/>
     <path id="jev" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
     <path id="jew" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118"/>
     <path id="jex" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159"/>
     <path id="jey" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599v-41 41"/>
     <path id="jez" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558h-42 42"/>
     <path id="jfa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558v41-41"/>
     <path id="jfb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599h42-42"/>
     <path id="jfc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
     <path id="jfd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558"/>
     <path id="jfe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
     <path id="jff" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558"/>
     <path id="jfg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599"/>
     <path id="jfh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781v-41 41"/>
     <path id="jfi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740h-41 41"/>
     <path id="jfj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740v41-41"/>
     <path id="jfk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41-41"/>
     <path id="jfl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
     <path id="jfm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740"/>
     <path id="jfn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
     <path id="jfo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740"/>
     <path id="jfp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781"/>
     <path id="jfq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781v-41 41"/>
     <path id="jfr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740h-41 41"/>
     <path id="jfs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740v41-41"/>
     <path id="jft" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41-41"/>
     <path id="jfu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
     <path id="jfv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740"/>
     <path id="jfw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
     <path id="jfx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740"/>
     <path id="jfy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781"/>
     <path id="jfz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781v-41 41"/>
     <path id="jga" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740h-42 42"/>
     <path id="jgb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740v41-41"/>
     <path id="jgc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42-42"/>
     <path id="jgd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
     <path id="jge" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740"/>
     <path id="jgf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
     <path id="jgg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740"/>
     <path id="jgh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781"/>
     <path id="jgi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781v-41 41"/>
     <path id="jgj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740h-41 41"/>
     <path id="jgk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740v41-41"/>
     <path id="jgl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41-41"/>
     <path id="jgm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
     <path id="jgn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740"/>
     <path id="jgo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
     <path id="jgp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740"/>
     <path id="jgq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781"/>
     <path id="jgr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781v-41 41"/>
     <path id="jgs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740h-42 42"/>
     <path id="jgt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740v41-41"/>
     <path id="jgu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42-42"/>
     <path id="jgv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
     <path id="jgw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740"/>
     <path id="jgx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
     <path id="jgy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740"/>
     <path id="jgz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781"/>
     <path id="jha" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781v-41 41"/>
     <path id="jhb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740h-42 42"/>
     <path id="jhc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740v41-41"/>
     <path id="jhd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42-42"/>
     <path id="jhe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
     <path id="jhf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740"/>
     <path id="jhg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
     <path id="jhh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740"/>
     <path id="jhi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781"/>
     <path id="jhj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781v-41 41"/>
     <path id="jhk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740h-42 42"/>
     <path id="jhl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740v41-41"/>
     <path id="jhm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42-42"/>
     <path id="jhn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
     <path id="jho" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740"/>
     <path id="jhp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
     <path id="jhq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740"/>
     <path id="jhr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781"/>
     <path id="jhs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781v-41 41"/>
     <path id="jht" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740h-42 42"/>
     <path id="jhu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740v41-41"/>
     <path id="jhv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42-42"/>
     <path id="jhw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
     <path id="jhx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740"/>
     <path id="jhy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
     <path id="jhz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740"/>
     <path id="jia" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781"/>
     <path id="jib" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781v-41 41"/>
     <path id="jic" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740h-41 41"/>
     <path id="jid" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740v41-41"/>
     <path id="jie" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41-41"/>
     <path id="jif" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
     <path id="jig" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740"/>
     <path id="jih" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
     <path id="jii" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740"/>
     <path id="jij" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781"/>
     <path id="jik" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938v-51h83v51h-83 83v-51h-83v51"/>
     <path id="jil" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
     <path id="jim" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1887"/>
     <path id="jin" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
     <path id="jio" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1887"/>
     <path id="jip" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938"/>
     <path id="jiq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672v-41h41v41h-41 41v-41h-41v41"/>
     <path id="jir" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
     <path id="jis" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1631"/>
     <path id="jit" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
     <path id="jiu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1631"/>
     <path id="jiv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672"/>
     <path id="jiw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401v-41h41v41h-41 41v-41h-41v41"/>
     <path id="jix" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
     <path id="jiy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1360"/>
     <path id="jiz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
     <path id="jja" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1360"/>
     <path id="jjb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401"/>
     <path id="jjc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401v-41h41v41h-41 41v-41h-41v41"/>
     <path id="jjd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
     <path id="jje" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1360"/>
     <path id="jjf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
     <path id="jjg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1360"/>
     <path id="jjh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401"/>
     <path id="jji" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401v-41h41v41h-41 41v-41h-41v41"/>
     <path id="jjj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
     <path id="jjk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1360"/>
     <path id="jjl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
     <path id="jjm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1360"/>
     <path id="jjn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401"/>
     <path id="jjo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401v-41h42v41h-42 42v-41h-42v41"/>
     <path id="jjp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
     <path id="jjq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1360"/>
     <path id="jjr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
     <path id="jjs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1360"/>
     <path id="jjt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401"/>
     <path id="jju" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401v-41h42v41h-42 42v-41h-42v41"/>
     <path id="jjv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
     <path id="jjw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1360"/>
     <path id="jjx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
     <path id="jjy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1360"/>
     <path id="jjz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401"/>
     <path id="jka" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401v-41h41v41h-41 41v-41h-41v41"/>
     <path id="jkb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
     <path id="jkc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360"/>
     <path id="jkd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
     <path id="jke" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1360"/>
     <path id="jkf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401"/>
     <path id="jkg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401v-41h41v41h-41 41v-41h-41v41"/>
     <path id="jkh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
     <path id="jki" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1360"/>
     <path id="jkj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
     <path id="jkk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1360"/>
     <path id="jkl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401"/>
     <path id="jkm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672v-41h42v41h-42 42v-41h-42v41"/>
     <path id="jkn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
     <path id="jko" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1631"/>
     <path id="jkp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
     <path id="jkq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1631"/>
     <path id="jkr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672"/>
     <path id="jks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401v-41h42v41h-42 42v-41h-42v41"/>
     <path id="jkt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
     <path id="jku" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1360"/>
     <path id="jkv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
     <path id="jkw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1360"/>
     <path id="jkx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401"/>
     <path id="jky" transform="matrix(0 .16 .16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="jkz" transform="matrix(0 -.16 -.16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="jla" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1354"/>
     <path id="jlb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
     <path id="jlc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1405"/>
     <path id="jld" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3082 1379"/>
     <path id="jle" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
     <path id="jlf" transform="matrix(0 .16 .16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="jlg" transform="matrix(0 -.16 -.16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="jlh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1354"/>
     <path id="jli" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
     <path id="jlj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1405"/>
     <path id="jlk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3290 1379"/>
     <path id="jll" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
     <path id="jlm" transform="matrix(0 .16 .16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="jln" transform="matrix(0 -.16 -.16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
     <path id="jlo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1354"/>
     <path id="jlp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
     <path id="jlq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1405"/>
     <path id="jlr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 1379"/>
     <path id="jls" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
     <path id="jlt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938v-51h83v51h-83 83v-51h-83v51"/>
     <path id="jlu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
     <path id="jlv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1887"/>
     <path id="jlw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
     <path id="jlx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1887"/>
     <path id="jly" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938"/>
     <path id="jlz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379h-52"/>
    </g>
   </g>
   <path id="jma" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3084 1379h37l-37 47zm37 0-37 47h37z" fill="#dbdbdb"/>
   <g id="jmb" fill="none" stroke-linejoin="round" stroke-width="2">
    <path id="jmc" transform="matrix(0 .16 .16 0 627.07 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
    <path id="jmd" transform="matrix(0 -.16 -.16 0 627.07 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
    <path id="jme" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 940"/>
    <path id="jmf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 966"/>
    <path id="jmg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 992"/>
    <path id="jmh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 966"/>
    <path id="jmi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 966"/>
    <path id="jmj" transform="matrix(0 .16 .16 0 533.63 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
    <path id="jmk" transform="matrix(0 -.16 -.16 0 533.63 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
    <path id="jml" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3318 940"/>
    <path id="jmm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3343 966"/>
    <path id="jmn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3318 992"/>
    <path id="jmo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3292 966"/>
    <path id="jmp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3343 966"/>
    <path id="jmq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1418 1375h-109v11h109v-11 11h-109v-11h109"/>
    <path id="jmr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1418 1386"/>
    <path id="jms" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1418 1375"/>
    <path id="jmt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1418 1386"/>
    <path id="jmu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1386"/>
    <path id="jmv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1375"/>
    <path id="jmw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672h-10 10"/>
    <path id="jmx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672v109-109"/>
    <path id="jmy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781h10-10"/>
    <path id="jmz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1781v-109 109"/>
    <path id="jna" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672"/>
    <path id="jnb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
    <path id="jnc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672"/>
    <path id="jnd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781"/>
    <path id="jne" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1781"/>
    <path id="jnf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777h-10 10"/>
    <path id="jng" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777v110-110"/>
    <path id="jnh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887h10-10"/>
    <path id="jni" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887v-110 110"/>
    <path id="jnj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777"/>
    <path id="jnk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
    <path id="jnl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777"/>
    <path id="jnm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
    <path id="jnn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887"/>
   </g>
  </g>
  <g id="jno" fill="none" stroke="#989898" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <path id="jnp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1439 1933v581"/>
   <path id="jnq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1439 2555v586"/>
   <path id="jnr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2535h360"/>
   <path id="jns" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 2535h380"/>
   <path id="jnt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8139h381"/>
   <path id="jnu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 7599v519"/>
   <path id="jnv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 8159v581"/>
   <path id="jnw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1861 1401v491"/>
   <path id="jnx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1381h586"/>
   <path id="jny" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 2255v-322"/>
   <path id="jnz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1381h380"/>
   <path id="joa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8139h586"/>
   <path id="job" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8139h519"/>
   <path id="joc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8139h585"/>
  </g>
  <g id="jod" fill="none" stroke="#dbdbdb" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <path id="joe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 6272v628"/>
   <path id="jof" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 5651h843"/>
  </g>
  <g id="jog" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
   <path id="joh" transform="matrix(0 -.16 -.16 0 173.79 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5" stroke-width="2"/>
   <path id="joi" transform="matrix(0 -.16 -.16 0 130.43 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5" stroke-width="2"/>
   <g id="joj" stroke-width="4">
    <path id="jok" transform="matrix(0 -.16 -.16 0 986.91 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
    <path id="jol" transform="matrix(0 -.16 -.16 0 986.91 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
    <path id="jom" transform="matrix(0 -.16 -.16 0 1030.3 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
   </g>
   <g id="jon" stroke-width="2">
    <path id="joo" transform="matrix(0 .16 .16 0 130.43 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
    <path id="jop" transform="matrix(0 -.16 -.16 0 130.43 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
    <path id="joq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m798 1413"/>
    <path id="jor" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m816 1432"/>
    <path id="jos" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m798 1450"/>
    <path id="jot" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m780 1432"/>
    <path id="jou" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m816 1432"/>
    <path id="jov" transform="matrix(0 .16 .16 0 173.79 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
    <path id="jow" transform="matrix(0 -.16 -.16 0 173.79 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
    <path id="jox" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1069 1143"/>
    <path id="joy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1087 1161"/>
    <path id="joz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1069 1179"/>
    <path id="jpa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1051 1161"/>
    <path id="jpb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1087 1161"/>
    <path id="jpc" transform="matrix(0 .16 .16 0 986.91 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
    <path id="jpd" transform="matrix(0 -.16 -.16 0 986.91 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
    <path id="jpe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6151 1143"/>
    <path id="jpf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6169 1161"/>
    <path id="jpg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6151 1179"/>
    <path id="jph" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6133 1161"/>
    <path id="jpi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6169 1161"/>
    <path id="jpj" transform="matrix(0 .16 .16 0 1030.3 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
    <path id="jpk" transform="matrix(0 -.16 -.16 0 1030.3 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
    <path id="jpl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6422 1413"/>
    <path id="jpm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6440 1432"/>
    <path id="jpn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6422 1450"/>
    <path id="jpo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6404 1432"/>
    <path id="jpp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6440 1432"/>
   </g>
  </g>
  <g id="jpq" fill="none" stroke="#dbdbdb" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
   <path id="jpr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jps" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
   <path id="jpt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2509"/>
   <path id="jpu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
   <path id="jpv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2509"/>
   <path id="jpw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561"/>
   <path id="jpx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jpy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
   <path id="jpz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3136"/>
   <path id="jqa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
   <path id="jqb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3136"/>
   <path id="jqc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188"/>
   <path id="jqd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jqe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
   <path id="jqf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3758"/>
   <path id="jqg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
   <path id="jqh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3758"/>
   <path id="jqi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810"/>
   <path id="jqj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jqk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
   <path id="jql" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4380"/>
   <path id="jqm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
   <path id="jqn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4380"/>
   <path id="jqo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432"/>
   <path id="jqp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jqq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
   <path id="jqr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5002"/>
   <path id="jqs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
   <path id="jqt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5002"/>
   <path id="jqu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054"/>
   <path id="jqv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jqw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
   <path id="jqx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5624"/>
   <path id="jqy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
   <path id="jqz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5624"/>
   <path id="jra" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676"/>
   <path id="jrb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jrc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
   <path id="jrd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6246"/>
   <path id="jre" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
   <path id="jrf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6246"/>
   <path id="jrg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298"/>
   <path id="jrh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920v-51h83v51h-83 83v-51h-83v51"/>
   <path id="jri" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
   <path id="jrj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6869"/>
   <path id="jrk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
   <path id="jrl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6869"/>
   <path id="jrm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920"/>
   <path id="jrn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542v-51h83v51h-83 83v-51h-83v51"/>
   <path id="jro" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
   <path id="jrp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7491"/>
   <path id="jrq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
   <path id="jrr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7491"/>
   <path id="jrs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542"/>
   <path id="jrt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781v-41 41"/>
   <path id="jru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740h-42 42"/>
   <path id="jrv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740v41-41"/>
   <path id="jrw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42-42"/>
   <path id="jrx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
   <path id="jry" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740"/>
   <path id="jrz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
   <path id="jsa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740"/>
   <path id="jsb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781"/>
   <path id="jsc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159v-41 41"/>
   <path id="jsd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118h-42 42"/>
   <path id="jse" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118v41-41"/>
   <path id="jsf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42-42"/>
   <path id="jsg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
   <path id="jsh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118"/>
   <path id="jsi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
   <path id="jsj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118"/>
   <path id="jsk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159"/>
   <path id="jsl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599v-41 41"/>
   <path id="jsm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558h-42 42"/>
   <path id="jsn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558v41-41"/>
   <path id="jso" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599h42-42"/>
   <path id="jsp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
   <path id="jsq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558"/>
   <path id="jsr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
   <path id="jss" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558"/>
   <path id="jst" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599"/>
   <path id="jsu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jsv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
   <path id="jsw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2509"/>
   <path id="jsx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
   <path id="jsy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2509"/>
   <path id="jsz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561"/>
   <path id="jta" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jtb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
   <path id="jtc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3136"/>
   <path id="jtd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
   <path id="jte" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3136"/>
   <path id="jtf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188"/>
   <path id="jtg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jth" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
   <path id="jti" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3758"/>
   <path id="jtj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
   <path id="jtk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3758"/>
   <path id="jtl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810"/>
   <path id="jtm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jtn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
   <path id="jto" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4380"/>
   <path id="jtp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
   <path id="jtq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4380"/>
   <path id="jtr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432"/>
   <path id="jts" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jtt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
   <path id="jtu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5002"/>
   <path id="jtv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
   <path id="jtw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5002"/>
   <path id="jtx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054"/>
   <path id="jty" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676v-52h83v52h-83 83v-52h-83v52"/>
   <path id="jtz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
   <path id="jua" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5624"/>
   <path id="jub" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
   <path id="juc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5624"/>
   <path id="jud" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676"/>
   <path id="jue" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298v-52h83v52h-83 83v-52h-83v52"/>
   <path id="juf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
   <path id="jug" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6246"/>
   <path id="juh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
   <path id="jui" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6246"/>
   <path id="juj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298"/>
   <path id="juk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920v-51h83v51h-83 83v-51h-83v51"/>
   <path id="jul" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
   <path id="jum" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6869"/>
   <path id="jun" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
   <path id="juo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6869"/>
   <path id="jup" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920"/>
   <path id="juq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542v-51h83v51h-83 83v-51h-83v51"/>
   <path id="jur" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
   <path id="jus" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7491"/>
   <path id="jut" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
   <path id="juu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7491"/>
   <path id="juv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542"/>
   <path id="juw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781v-41 41"/>
   <path id="jux" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740h-41 41"/>
   <path id="juy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740v41-41"/>
   <path id="juz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41-41"/>
   <path id="jva" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
   <path id="jvb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740"/>
   <path id="jvc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
   <path id="jvd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740"/>
   <path id="jve" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781"/>
   <path id="jvf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159v-41 41"/>
   <path id="jvg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118h-41 41"/>
   <path id="jvh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118v41-41"/>
   <path id="jvi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159h41-41"/>
   <path id="jvj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
   <path id="jvk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118"/>
   <path id="jvl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
   <path id="jvm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118"/>
   <path id="jvn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159"/>
   <path id="jvo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599v-41 41"/>
   <path id="jvp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558h-41 41"/>
   <path id="jvq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558v41-41"/>
   <path id="jvr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41-41"/>
   <path id="jvs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
   <path id="jvt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558"/>
   <path id="jvu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
   <path id="jvv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558"/>
   <path id="jvw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599"/>
   <path id="jvx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781v-41 41"/>
   <path id="jvy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740h-41 41"/>
   <path id="jvz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740v41-41"/>
   <path id="jwa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41-41"/>
   <path id="jwb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
   <path id="jwc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740"/>
   <path id="jwd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
   <path id="jwe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740"/>
   <path id="jwf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781"/>
   <path id="jwg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781v-41 41"/>
   <path id="jwh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740h-41 41"/>
   <path id="jwi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740v41-41"/>
   <path id="jwj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41-41"/>
   <path id="jwk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
   <path id="jwl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740"/>
   <path id="jwm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
   <path id="jwn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740"/>
   <path id="jwo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781"/>
   <path id="jwp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781v-41 41"/>
   <path id="jwq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740h-42 42"/>
   <path id="jwr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740v41-41"/>
   <path id="jws" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42-42"/>
   <path id="jwt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
   <path id="jwu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740"/>
   <path id="jwv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
   <path id="jww" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740"/>
   <path id="jwx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781"/>
   <path id="jwy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781v-41 41"/>
   <path id="jwz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740h-41 41"/>
   <path id="jxa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740v41-41"/>
   <path id="jxb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41-41"/>
   <path id="jxc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
   <path id="jxd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740"/>
   <path id="jxe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
   <path id="jxf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740"/>
   <path id="jxg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781"/>
   <path id="jxh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781v-41 41"/>
   <path id="jxi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740h-42 42"/>
   <path id="jxj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740v41-41"/>
   <path id="jxk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42-42"/>
   <path id="jxl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
   <path id="jxm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740"/>
   <path id="jxn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
   <path id="jxo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740"/>
   <path id="jxp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781"/>
   <path id="jxq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781v-41 41"/>
   <path id="jxr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740h-42 42"/>
   <path id="jxs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740v41-41"/>
   <path id="jxt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42-42"/>
   <path id="jxu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
   <path id="jxv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740"/>
   <path id="jxw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
   <path id="jxx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740"/>
   <path id="jxy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781"/>
   <path id="jxz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781v-41 41"/>
   <path id="jya" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740h-42 42"/>
   <path id="jyb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740v41-41"/>
   <path id="jyc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42-42"/>
   <path id="jyd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
   <path id="jye" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740"/>
   <path id="jyf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
   <path id="jyg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740"/>
   <path id="jyh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781"/>
   <path id="jyi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781v-41 41"/>
   <path id="jyj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740h-42 42"/>
   <path id="jyk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740v41-41"/>
   <path id="jyl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42-42"/>
   <path id="jym" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
   <path id="jyn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740"/>
   <path id="jyo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
   <path id="jyp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740"/>
   <path id="jyq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781"/>
   <path id="jyr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781v-41 41"/>
   <path id="jys" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740h-41 41"/>
   <path id="jyt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740v41-41"/>
   <path id="jyu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41-41"/>
   <path id="jyv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
   <path id="jyw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740"/>
   <path id="jyx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
   <path id="jyy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740"/>
   <path id="jyz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781"/>
  </g>
  <g id="jza" fill="none" stroke="#dbdbdb" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
   <path id="jzb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938v-51h83v51h-83 83v-51h-83v51"/>
   <path id="jzc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
   <path id="jzd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1887"/>
   <path id="jze" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
   <path id="jzf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1887"/>
   <path id="jzg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938"/>
   <path id="jzh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672v-41h41v41h-41 41v-41h-41v41"/>
   <path id="jzi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
   <path id="jzj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1631"/>
   <path id="jzk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
   <path id="jzl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1631"/>
   <path id="jzm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672"/>
   <path id="jzn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401v-41h41v41h-41 41v-41h-41v41"/>
   <path id="jzo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
   <path id="jzp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1360"/>
   <path id="jzq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
   <path id="jzr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1360"/>
   <path id="jzs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401"/>
   <path id="jzt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401v-41h41v41h-41 41v-41h-41v41"/>
   <path id="jzu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
   <path id="jzv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1360"/>
   <path id="jzw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
   <path id="jzx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1360"/>
   <path id="jzy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401"/>
   <path id="jzz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401v-41h41v41h-41 41v-41h-41v41"/>
   <path id="kaa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
   <path id="kab" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1360"/>
   <path id="kac" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
   <path id="kad" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1360"/>
   <path id="kae" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401"/>
   <path id="kaf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401v-41h42v41h-42 42v-41h-42v41"/>
   <path id="kag" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
   <path id="kah" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1360"/>
   <path id="kai" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
   <path id="kaj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1360"/>
   <path id="kak" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401"/>
   <path id="kal" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401v-41h42v41h-42 42v-41h-42v41"/>
   <path id="kam" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
   <path id="kan" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1360"/>
   <path id="kao" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
   <path id="kap" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1360"/>
   <path id="kaq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401"/>
   <path id="kar" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401v-41h41v41h-41 41v-41h-41v41"/>
   <path id="kas" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
   <path id="kat" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360"/>
   <path id="kau" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
   <path id="kav" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1360"/>
   <path id="kaw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401"/>
   <path id="kax" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401v-41h41v41h-41 41v-41h-41v41"/>
   <path id="kay" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
   <path id="kaz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1360"/>
   <path id="kba" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
   <path id="kbb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1360"/>
   <path id="kbc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401"/>
   <path id="kbd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672v-41h42v41h-42 42v-41h-42v41"/>
   <path id="kbe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
   <path id="kbf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1631"/>
   <path id="kbg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
   <path id="kbh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1631"/>
   <path id="kbi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672"/>
   <path id="kbj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401v-41h42v41h-42 42v-41h-42v41"/>
   <path id="kbk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
   <path id="kbl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1360"/>
   <path id="kbm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
   <path id="kbn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1360"/>
   <path id="kbo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401"/>
   <path id="kbp" transform="matrix(0 .16 .16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kbq" transform="matrix(0 -.16 -.16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kbr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1354"/>
   <path id="kbs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
   <path id="kbt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1405"/>
   <path id="kbu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3082 1379"/>
   <path id="kbv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
   <path id="kbw" transform="matrix(0 .16 .16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kbx" transform="matrix(0 -.16 -.16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kby" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1354"/>
   <path id="kbz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
   <path id="kca" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1405"/>
   <path id="kcb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3290 1379"/>
   <path id="kcc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
   <path id="kcd" transform="matrix(0 .16 .16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kce" transform="matrix(0 -.16 -.16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kcf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1354"/>
   <path id="kcg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
   <path id="kch" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1405"/>
   <path id="kci" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 1379"/>
   <path id="kcj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
   <path id="kck" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938v-51h83v51h-83 83v-51h-83v51"/>
   <path id="kcl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
   <path id="kcm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1887"/>
   <path id="kcn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
   <path id="kco" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1887"/>
   <path id="kcp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938"/>
   <path id="kcq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kcr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
   <path id="kcs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2509"/>
   <path id="kct" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
   <path id="kcu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2509"/>
   <path id="kcv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561"/>
   <path id="kcw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kcx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
   <path id="kcy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3136"/>
   <path id="kcz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
   <path id="kda" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3136"/>
   <path id="kdb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188"/>
   <path id="kdc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kdd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
   <path id="kde" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3758"/>
   <path id="kdf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
   <path id="kdg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3758"/>
   <path id="kdh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810"/>
   <path id="kdi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kdj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
   <path id="kdk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4380"/>
   <path id="kdl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
   <path id="kdm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4380"/>
   <path id="kdn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432"/>
   <path id="kdo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kdp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
   <path id="kdq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5002"/>
   <path id="kdr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
   <path id="kds" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5002"/>
   <path id="kdt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054"/>
   <path id="kdu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kdv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
   <path id="kdw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5624"/>
   <path id="kdx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
   <path id="kdy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5624"/>
   <path id="kdz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676"/>
   <path id="kea" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298v-52h83v52h-83 83v-52h-83v52"/>
   <path id="keb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
   <path id="kec" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6246"/>
   <path id="ked" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
   <path id="kee" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6246"/>
   <path id="kef" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298"/>
   <path id="keg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920v-51h83v51h-83 83v-51h-83v51"/>
   <path id="keh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
   <path id="kei" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6869"/>
   <path id="kej" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
   <path id="kek" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6869"/>
   <path id="kel" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920"/>
   <path id="kem" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542v-51h83v51h-83 83v-51h-83v51"/>
   <path id="ken" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
   <path id="keo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7491"/>
   <path id="kep" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
   <path id="keq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7491"/>
   <path id="ker" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542"/>
   <path id="kes" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781v-41 41"/>
   <path id="ket" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740h-42 42"/>
   <path id="keu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740v41-41"/>
   <path id="kev" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42-42"/>
   <path id="kew" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
   <path id="kex" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740"/>
   <path id="key" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
   <path id="kez" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740"/>
   <path id="kfa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781"/>
   <path id="kfb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159v-41 41"/>
   <path id="kfc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118h-42 42"/>
   <path id="kfd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118v41-41"/>
   <path id="kfe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42-42"/>
   <path id="kff" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
   <path id="kfg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118"/>
   <path id="kfh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
   <path id="kfi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118"/>
   <path id="kfj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159"/>
   <path id="kfk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599v-41 41"/>
   <path id="kfl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558h-42 42"/>
   <path id="kfm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558v41-41"/>
   <path id="kfn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599h42-42"/>
   <path id="kfo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
   <path id="kfp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558"/>
   <path id="kfq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
   <path id="kfr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558"/>
   <path id="kfs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599"/>
   <path id="kft" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kfu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
   <path id="kfv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2509"/>
   <path id="kfw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
   <path id="kfx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2509"/>
   <path id="kfy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561"/>
   <path id="kfz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kga" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
   <path id="kgb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3136"/>
   <path id="kgc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
   <path id="kgd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3136"/>
   <path id="kge" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188"/>
   <path id="kgf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kgg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
   <path id="kgh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3758"/>
   <path id="kgi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
   <path id="kgj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3758"/>
   <path id="kgk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810"/>
   <path id="kgl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kgm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
   <path id="kgn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4380"/>
   <path id="kgo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
   <path id="kgp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4380"/>
   <path id="kgq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432"/>
   <path id="kgr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kgs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
   <path id="kgt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5002"/>
   <path id="kgu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
   <path id="kgv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5002"/>
   <path id="kgw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054"/>
   <path id="kgx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kgy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
   <path id="kgz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5624"/>
   <path id="kha" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
   <path id="khb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5624"/>
   <path id="khc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676"/>
   <path id="khd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298v-52h83v52h-83 83v-52h-83v52"/>
   <path id="khe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
   <path id="khf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6246"/>
   <path id="khg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
   <path id="khh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6246"/>
   <path id="khi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298"/>
   <path id="khj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920v-51h83v51h-83 83v-51h-83v51"/>
   <path id="khk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
   <path id="khl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6869"/>
   <path id="khm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
   <path id="khn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6869"/>
   <path id="kho" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920"/>
   <path id="khp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542v-51h83v51h-83 83v-51h-83v51"/>
   <path id="khq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
   <path id="khr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7491"/>
   <path id="khs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
   <path id="kht" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7491"/>
   <path id="khu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542"/>
   <path id="khv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781v-41 41"/>
   <path id="khw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740h-41 41"/>
   <path id="khx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740v41-41"/>
   <path id="khy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41-41"/>
   <path id="khz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
   <path id="kia" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740"/>
   <path id="kib" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
   <path id="kic" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740"/>
   <path id="kid" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781"/>
   <path id="kie" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159v-41 41"/>
   <path id="kif" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118h-41 41"/>
   <path id="kig" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118v41-41"/>
   <path id="kih" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159h41-41"/>
   <path id="kii" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
   <path id="kij" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118"/>
   <path id="kik" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
   <path id="kil" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118"/>
   <path id="kim" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159"/>
   <path id="kin" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599v-41 41"/>
   <path id="kio" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558h-41 41"/>
   <path id="kip" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558v41-41"/>
   <path id="kiq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41-41"/>
   <path id="kir" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
   <path id="kis" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558"/>
   <path id="kit" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
   <path id="kiu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558"/>
   <path id="kiv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599"/>
   <path id="kiw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781v-41 41"/>
   <path id="kix" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740h-41 41"/>
   <path id="kiy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740v41-41"/>
   <path id="kiz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41-41"/>
   <path id="kja" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
   <path id="kjb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740"/>
   <path id="kjc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
   <path id="kjd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740"/>
   <path id="kje" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781"/>
   <path id="kjf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781v-41 41"/>
   <path id="kjg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740h-41 41"/>
   <path id="kjh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740v41-41"/>
   <path id="kji" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41-41"/>
   <path id="kjj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
   <path id="kjk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740"/>
   <path id="kjl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
   <path id="kjm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740"/>
   <path id="kjn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781"/>
   <path id="kjo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781v-41 41"/>
   <path id="kjp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740h-42 42"/>
   <path id="kjq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740v41-41"/>
   <path id="kjr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42-42"/>
   <path id="kjs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
   <path id="kjt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740"/>
   <path id="kju" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
   <path id="kjv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740"/>
   <path id="kjw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781"/>
   <path id="kjx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781v-41 41"/>
   <path id="kjy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740h-41 41"/>
   <path id="kjz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740v41-41"/>
   <path id="kka" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41-41"/>
   <path id="kkb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
   <path id="kkc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740"/>
   <path id="kkd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
   <path id="kke" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740"/>
   <path id="kkf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781"/>
   <path id="kkg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781v-41 41"/>
   <path id="kkh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740h-42 42"/>
   <path id="kki" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740v41-41"/>
   <path id="kkj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42-42"/>
   <path id="kkk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
   <path id="kkl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740"/>
   <path id="kkm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
   <path id="kkn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740"/>
   <path id="kko" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781"/>
   <path id="kkp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781v-41 41"/>
   <path id="kkq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740h-42 42"/>
   <path id="kkr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740v41-41"/>
   <path id="kks" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42-42"/>
   <path id="kkt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
   <path id="kku" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740"/>
   <path id="kkv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
   <path id="kkw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740"/>
   <path id="kkx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781"/>
   <path id="kky" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781v-41 41"/>
   <path id="kkz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740h-42 42"/>
   <path id="kla" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740v41-41"/>
   <path id="klb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42-42"/>
   <path id="klc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
   <path id="kld" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740"/>
   <path id="kle" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
   <path id="klf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740"/>
   <path id="klg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781"/>
   <path id="klh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781v-41 41"/>
   <path id="kli" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740h-42 42"/>
   <path id="klj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740v41-41"/>
   <path id="klk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42-42"/>
   <path id="kll" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
   <path id="klm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740"/>
   <path id="kln" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
   <path id="klo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740"/>
   <path id="klp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781"/>
   <path id="klq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781v-41 41"/>
   <path id="klr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740h-41 41"/>
   <path id="kls" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740v41-41"/>
   <path id="klt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41-41"/>
   <path id="klu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
   <path id="klv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740"/>
   <path id="klw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
   <path id="klx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740"/>
   <path id="kly" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781"/>
   <path id="klz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938v-51h83v51h-83 83v-51h-83v51"/>
   <path id="kma" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
   <path id="kmb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1887"/>
   <path id="kmc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
   <path id="kmd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1887"/>
   <path id="kme" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938"/>
   <path id="kmf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672v-41h41v41h-41 41v-41h-41v41"/>
   <path id="kmg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
   <path id="kmh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1631"/>
   <path id="kmi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
   <path id="kmj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1631"/>
   <path id="kmk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672"/>
   <path id="kml" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401v-41h41v41h-41 41v-41h-41v41"/>
   <path id="kmm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
   <path id="kmn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1360"/>
   <path id="kmo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
   <path id="kmp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1360"/>
   <path id="kmq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401"/>
   <path id="kmr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401v-41h41v41h-41 41v-41h-41v41"/>
   <path id="kms" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
   <path id="kmt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1360"/>
   <path id="kmu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
   <path id="kmv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1360"/>
   <path id="kmw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401"/>
   <path id="kmx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401v-41h41v41h-41 41v-41h-41v41"/>
   <path id="kmy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
   <path id="kmz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1360"/>
   <path id="kna" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
   <path id="knb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1360"/>
   <path id="knc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401"/>
   <path id="knd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401v-41h42v41h-42 42v-41h-42v41"/>
   <path id="kne" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
   <path id="knf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1360"/>
   <path id="kng" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
   <path id="knh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1360"/>
   <path id="kni" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401"/>
   <path id="knj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401v-41h42v41h-42 42v-41h-42v41"/>
   <path id="knk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
   <path id="knl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1360"/>
   <path id="knm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
   <path id="knn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1360"/>
   <path id="kno" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401"/>
   <path id="knp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401v-41h41v41h-41 41v-41h-41v41"/>
   <path id="knq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
   <path id="knr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360"/>
   <path id="kns" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
   <path id="knt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1360"/>
   <path id="knu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401"/>
   <path id="knv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401v-41h41v41h-41 41v-41h-41v41"/>
   <path id="knw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
   <path id="knx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1360"/>
   <path id="kny" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
   <path id="knz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1360"/>
   <path id="koa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401"/>
   <path id="kob" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672v-41h42v41h-42 42v-41h-42v41"/>
   <path id="koc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
   <path id="kod" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1631"/>
   <path id="koe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
   <path id="kof" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1631"/>
   <path id="kog" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672"/>
   <path id="koh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401v-41h42v41h-42 42v-41h-42v41"/>
   <path id="koi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
   <path id="koj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1360"/>
   <path id="kok" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
   <path id="kol" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1360"/>
   <path id="kom" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401"/>
   <path id="kon" transform="matrix(0 .16 .16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="koo" transform="matrix(0 -.16 -.16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kop" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1354"/>
   <path id="koq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
   <path id="kor" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1405"/>
   <path id="kos" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3082 1379"/>
   <path id="kot" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
   <path id="kou" transform="matrix(0 .16 .16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kov" transform="matrix(0 -.16 -.16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kow" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1354"/>
   <path id="kox" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
   <path id="koy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1405"/>
   <path id="koz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3290 1379"/>
   <path id="kpa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
   <path id="kpb" transform="matrix(0 .16 .16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kpc" transform="matrix(0 -.16 -.16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
   <path id="kpd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1354"/>
   <path id="kpe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
   <path id="kpf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1405"/>
   <path id="kpg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 1379"/>
   <path id="kph" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
   <path id="kpi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938v-51h83v51h-83 83v-51h-83v51"/>
   <path id="kpj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
   <path id="kpk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1887"/>
   <path id="kpl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
   <path id="kpm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1887"/>
   <path id="kpn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938"/>
   <path id="kpo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kpp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
   <path id="kpq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2509"/>
   <path id="kpr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
   <path id="kps" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2509"/>
   <path id="kpt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561"/>
   <path id="kpu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kpv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
   <path id="kpw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3136"/>
   <path id="kpx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
   <path id="kpy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3136"/>
   <path id="kpz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188"/>
   <path id="kqa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kqb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
   <path id="kqc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3758"/>
   <path id="kqd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
   <path id="kqe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3758"/>
   <path id="kqf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810"/>
   <path id="kqg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kqh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
   <path id="kqi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4380"/>
   <path id="kqj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
   <path id="kqk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4380"/>
   <path id="kql" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432"/>
   <path id="kqm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kqn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
   <path id="kqo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5002"/>
   <path id="kqp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
   <path id="kqq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5002"/>
   <path id="kqr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054"/>
   <path id="kqs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kqt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
   <path id="kqu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5624"/>
   <path id="kqv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
   <path id="kqw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5624"/>
   <path id="kqx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676"/>
   <path id="kqy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kqz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
   <path id="kra" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6246"/>
   <path id="krb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
   <path id="krc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6246"/>
   <path id="krd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298"/>
   <path id="kre" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920v-51h83v51h-83 83v-51h-83v51"/>
   <path id="krf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
   <path id="krg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6869"/>
   <path id="krh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
   <path id="kri" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6869"/>
   <path id="krj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920"/>
   <path id="krk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542v-51h83v51h-83 83v-51h-83v51"/>
   <path id="krl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
   <path id="krm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7491"/>
   <path id="krn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
   <path id="kro" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7491"/>
   <path id="krp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542"/>
   <path id="krq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781v-41 41"/>
   <path id="krr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740h-42 42"/>
   <path id="krs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740v41-41"/>
   <path id="krt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42-42"/>
   <path id="kru" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
   <path id="krv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740"/>
   <path id="krw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
   <path id="krx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740"/>
   <path id="kry" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781"/>
   <path id="krz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159v-41 41"/>
   <path id="ksa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118h-42 42"/>
   <path id="ksb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118v41-41"/>
   <path id="ksc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42-42"/>
   <path id="ksd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
   <path id="kse" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118"/>
   <path id="ksf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
   <path id="ksg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118"/>
   <path id="ksh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159"/>
   <path id="ksi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599v-41 41"/>
   <path id="ksj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558h-42 42"/>
   <path id="ksk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558v41-41"/>
   <path id="ksl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599h42-42"/>
   <path id="ksm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
   <path id="ksn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558"/>
   <path id="kso" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
   <path id="ksp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558"/>
   <path id="ksq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599"/>
   <path id="ksr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kss" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
   <path id="kst" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2509"/>
   <path id="ksu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
   <path id="ksv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2509"/>
   <path id="ksw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561"/>
   <path id="ksx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188v-52h83v52h-83 83v-52h-83v52"/>
   <path id="ksy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
   <path id="ksz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3136"/>
   <path id="kta" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
   <path id="ktb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3136"/>
   <path id="ktc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188"/>
   <path id="ktd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kte" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
   <path id="ktf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3758"/>
   <path id="ktg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
   <path id="kth" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3758"/>
   <path id="kti" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810"/>
   <path id="ktj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432v-52h83v52h-83 83v-52h-83v52"/>
   <path id="ktk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
   <path id="ktl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4380"/>
   <path id="ktm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
   <path id="ktn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4380"/>
   <path id="kto" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432"/>
   <path id="ktp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054v-52h83v52h-83 83v-52h-83v52"/>
   <path id="ktq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
   <path id="ktr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5002"/>
   <path id="kts" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
   <path id="ktt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5002"/>
   <path id="ktu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054"/>
   <path id="ktv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676v-52h83v52h-83 83v-52h-83v52"/>
   <path id="ktw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
   <path id="ktx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5624"/>
   <path id="kty" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
   <path id="ktz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5624"/>
   <path id="kua" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676"/>
   <path id="kub" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298v-52h83v52h-83 83v-52h-83v52"/>
   <path id="kuc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
   <path id="kud" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6246"/>
   <path id="kue" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
   <path id="kuf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6246"/>
   <path id="kug" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298"/>
   <path id="kuh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920v-51h83v51h-83 83v-51h-83v51"/>
   <path id="kui" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
   <path id="kuj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6869"/>
   <path id="kuk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
   <path id="kul" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6869"/>
   <path id="kum" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920"/>
   <path id="kun" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542v-51h83v51h-83 83v-51h-83v51"/>
   <path id="kuo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
   <path id="kup" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7491"/>
   <path id="kuq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
   <path id="kur" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7491"/>
   <path id="kus" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542"/>
   <path id="kut" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781v-41 41"/>
   <path id="kuu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740h-41 41"/>
   <path id="kuv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740v41-41"/>
   <path id="kuw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41-41"/>
   <path id="kux" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
   <path id="kuy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740"/>
   <path id="kuz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
   <path id="kva" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740"/>
   <path id="kvb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781"/>
   <path id="kvc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159v-41 41"/>
   <path id="kvd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118h-41 41"/>
   <path id="kve" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118v41-41"/>
   <path id="kvf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159h41-41"/>
   <path id="kvg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
   <path id="kvh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118"/>
   <path id="kvi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
   <path id="kvj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118"/>
   <path id="kvk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159"/>
   <path id="kvl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599v-41 41"/>
   <path id="kvm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558h-41 41"/>
   <path id="kvn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558v41-41"/>
   <path id="kvo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41-41"/>
   <path id="kvp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
   <path id="kvq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558"/>
   <path id="kvr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
   <path id="kvs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558"/>
   <path id="kvt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599"/>
   <path id="kvu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781v-41 41"/>
   <path id="kvv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740h-41 41"/>
   <path id="kvw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740v41-41"/>
   <path id="kvx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41-41"/>
   <path id="kvy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
   <path id="kvz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740"/>
   <path id="kwa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
   <path id="kwb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740"/>
   <path id="kwc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781"/>
   <path id="kwd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781v-41 41"/>
   <path id="kwe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740h-41 41"/>
   <path id="kwf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740v41-41"/>
   <path id="kwg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41-41"/>
   <path id="kwh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
   <path id="kwi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740"/>
   <path id="kwj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
   <path id="kwk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740"/>
   <path id="kwl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781"/>
   <path id="kwm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781v-41 41"/>
   <path id="kwn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740h-42 42"/>
   <path id="kwo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740v41-41"/>
   <path id="kwp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42-42"/>
   <path id="kwq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
   <path id="kwr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740"/>
   <path id="kws" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
   <path id="kwt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740"/>
   <path id="kwu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781"/>
   <path id="kwv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781v-41 41"/>
   <path id="kww" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740h-41 41"/>
   <path id="kwx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740v41-41"/>
   <path id="kwy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41-41"/>
   <path id="kwz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
   <path id="kxa" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740"/>
   <path id="kxb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
   <path id="kxc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740"/>
   <path id="kxd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781"/>
   <path id="kxe" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781v-41 41"/>
   <path id="kxf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740h-42 42"/>
   <path id="kxg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740v41-41"/>
   <path id="kxh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42-42"/>
   <path id="kxi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
   <path id="kxj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740"/>
   <path id="kxk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
   <path id="kxl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740"/>
   <path id="kxm" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781"/>
   <path id="kxn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781v-41 41"/>
   <path id="kxo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740h-42 42"/>
   <path id="kxp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740v41-41"/>
   <path id="kxq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42-42"/>
   <path id="kxr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
   <path id="kxs" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740"/>
   <path id="kxt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
   <path id="kxu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740"/>
   <path id="kxv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781"/>
   <path id="kxw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781v-41 41"/>
   <path id="kxx" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740h-42 42"/>
   <path id="kxy" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740v41-41"/>
   <path id="kxz" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42-42"/>
   <path id="kya" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
   <path id="kyb" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740"/>
   <path id="kyc" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
   <path id="kyd" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740"/>
   <path id="kye" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781"/>
   <path id="kyf" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781v-41 41"/>
   <path id="kyg" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740h-42 42"/>
   <path id="kyh" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740v41-41"/>
   <path id="kyi" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42-42"/>
   <path id="kyj" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
   <path id="kyk" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740"/>
   <path id="kyl" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
   <path id="kym" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740"/>
   <path id="kyn" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781"/>
   <path id="kyo" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781v-41 41"/>
   <path id="kyp" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740h-41 41"/>
   <path id="kyq" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740v41-41"/>
   <path id="kyr" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41-41"/>
   <path id="kys" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
   <path id="kyt" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740"/>
   <path id="kyu" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
   <path id="kyv" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740"/>
   <path id="kyw" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781"/>
  </g>
  <g id="kyx" fill-opacity="0">
   <path id="kyy" d="m233.9 1333.1v31.74h65.434l0.48832-87.408z"/>
   <path id="kyz" d="m300.31 1298.4v65.434l99.616-0.9767 0.97663-64.458z"/>
   <path id="kza" d="m402.37 1297.9 96.686 0.9766v65.922l-96.686-2.4416z"/>
   <path id="kzb" d="m400.91 1281.3 100.1-0.9767-0.97663-59.574-99.128-0.4883 0.48831 58.11z"/>
   <path id="kzc" d="m301.29 1279.4v19.044l98.64-0.4883 1.9533-79.107-38.089 0.9767z"/>
   <path id="kzd" d="m302.76 1180.3c1.9533 7.813 0.48831 43.46 0.48831 43.46l-68.364 58.598-0.48832-101.57z"/>
   <path id="kze" d="m230.97 1180.7 1.9533 101.08h-66.899v-100.59z"/>
   <path id="kzf" d="m500.52 1277.9-0.48832 84.967 77.642 2.9299 2.9299-85.943h-77.642z"/>
   <path id="kzg" d="m659.71 1280.4-0.48832 84.478h102.06l-1.4649-84.967z"/>
   <path id="kzh" d="m658.25 1223.7 1.9533 55.18 99.128 0.4883 2.4416-58.11z"/>
   <path id="kzi" d="m759.82 1299.9 0.48831 65.434 97.663-0.9766 0.97663-66.899z"/>
   <path id="kzj" d="m760.31 1297.9v-76.177l38.577 0.4884 58.598 56.156 1.4649 20.021z"/>
   <path id="kzk" d="m861.39 1281.8-0.48831 82.037 66.411 0.4883-0.97663-32.229z"/>
   <path id="kzl" d="m928.77 1279.9-1.9533-101.08-65.923 1.9533-1.4649 43.948z"/>
   <path id="kzm" d="m929.26 1180.7 0.97663 97.663 62.993 0.9766 3.4182-98.64-64.946 1.4649z"/>
   <path id="kzn" d="m926.33 1079.2 1.465 100.1-69.829 0.4884 1.465-103.52z"/>
   <path id="kzo" d="m929.26 1080.6 68.364-0.9766v101.08h-68.852z"/>
   <path id="kzp" d="m926.33 978.09 0.97663 100.59-67.387 0.4883 0.48832-99.128z"/>
   <path id="kzq" d="m930.24 980.05-0.97663 101.08 69.341-0.9767 1.465-97.175z"/>
   <path id="kzr" d="m859.43 880.92 2.9299 101.57 64.946-2.9299v-99.128z"/>
   <path id="kzs" d="m930.24 882.87-1.9533 99.128 68.364-0.97663 1.9533-99.128z"/>
   <path id="kzt" d="m927.8 781.79-1.465 98.64-64.946 0.48831-1.4649-98.64z"/>
   <path id="kzu" d="m929.26 781.79 0.48832 99.128h70.317l-1.465-98.64z"/>
   <path id="kzv" d="m760.79 1300.4 0.97663 63.969h97.663v-61.528z"/>
   <path id="kzw" d="m757.86 1223.2v59.574l-96.198-2.4416-1.465-56.156z"/>
   <path id="kzx" d="m661.18 1285.2v79.107h96.686l2.4416-80.572z"/>
   <path id="kzy" d="m498.08 1301.8 1.465 60.551-97.175 2.4416-0.48831-65.434z"/>
   <path id="kzz" d="m500.03 1282.3v82.037l81.06-0.4883v-84.967l-40.042-0.9766 1.465 40.042-3.4182-8.3014-12.208-12.208-3.9065-8.7896-6.3481 4.3948z"/>
   <path id="laa" d="m502.48 1221.3-2.4416 78.13-102.55-3.9065 3.9065-74.712z"/>
   <path id="lab" d="m397.98 1222.3c0 14.161 3.9065 76.665 3.9065 76.665l-100.59-1.465-0.97663-21.486 62.016-55.668z"/>
   <path id="lac" d="m399.93 1301.4-0.48832 64.458-98.151-1.9532 0.48832-65.434z"/>
   <path id="lad" d="m297.38 1279.9 1.9533 85.455h-67.387l3.4182-35.647z"/>
   <path id="lae" d="m232.93 1279.9v-100.1l-66.899 0.4883 0.97663 100.59z"/>
   <path id="laf" d="m235.37 1177.3 65.923 3.9065s2.9299 40.042 2.4416 42.483c-0.48832 2.4416-69.829 58.11-69.829 58.11z"/>
   <path id="lag" d="m164.07 1081.1v99.128l67.387-2.9299v-96.686z"/>
   <path id="lah" d="m234.88 1080.2-1.465 100.1 68.364-0.9767 0.48831-100.59z"/>
   <path id="lai" d="m337.69 1079.4 1.3812 76.655 36.601-38.673 1.3812-38.672z"/>
   <path id="laj" d="m425.4 1119.4-60.081 62.152h84.942l-1.3812-64.224z"/>
  </g>
  <path id="lak" d="m450.95 1122.2-0.69058 62.843z" fill="#ac9393"/>
  <g id="lal" fill-opacity="0">
   <path id="lam" d="m450.26 1122.2 2.0717 59.39h63.534v-60.771z"/>
   <path id="lan" d="m517.94 1119.4 1.3812 60.771s24.861 4.8341 26.242 2.0718-4.1435-22.099-4.1435-22.099l29.004 2.7623 14.502-15.883-4.1435-24.17z"/>
   <path id="lao" d="m660.89 1120.8v60.771l48.341-3.4529-1.3812-57.318z"/>
   <path id="lap" d="m709.92 1120.1v62.152l83.56 2.0717-59.39-65.605z"/>
   <path id="laq" d="m781.74 1118.7 41.435 37.982v-75.964h-42.816z"/>
   <path id="lar" d="m757.57 1075.9 62.843 0.6906 2.0717-75.964-62.152-0.69054z"/>
   <path id="las" d="m336.31 1000.7 2.7623 78.726 62.843-0.6905v-78.726l-62.152 1.3811z"/>
   <path id="lat" d="m301.09 976.48 2.7623 102.9-70.439-1.3811-1.3812-96.681z"/>
   <path id="lau" d="m231.34 979.94v98.063l-71.82 0.6906 4.1435-99.444z"/>
   <path id="lav" d="m231.34 879.8 1.3812 101.52-71.13-0.69059-0.69058-100.82z"/>
   <path id="law" d="m303.17 881.87-2.0717 99.444-66.986-2.0718-0.69058-95.991z"/>
   <path id="lax" d="m758.95 922.62 2.7623 76.655 60.081 0.69058 2.7623-75.964z"/>
   <path id="lay" d="m759.64 841.13 0.69059 80.798 61.462 1.3812-2.7623-87.704-6.2152 1.3812-3.4529 15.883-2.7623 1.3812-7.5964-7.5964-1.3812-8.9776z"/>
   <path id="laz" d="m158.83 784.5 6.2152 95.991 66.986-1.3812v-98.753z"/>
   <path id="lba" d="m231.34 782.43 5.5247 100.13 62.843-1.3812 2.0718-100.82z"/>
   <path id="lbb" d="m338.38 923.31 1.3812 74.583 66.296-0.69058-6.9058-76.655z"/>
   <path id="lbc" d="m165.05 583.54 2.0717 98.063 67.677-1.3812-2.0717-98.063z"/>
   <path id="lbd" d="m236.18 584.92 0.69059 96.681 64.915-2.7623-3.4529-97.372z"/>
   <path id="lbe" d="m339.77 841.13-2.7623 80.798 60.081-1.3812 3.4529-83.56-37.291 0.69058-2.0718 13.121-3.4529 2.0717-6.9058 2.7623-0.69058-16.574z"/>
   <path id="lbf" d="m857.7 575.94 2.7623 106.35 62.843 0.69058 2.0717-99.444z"/>
   <path id="lbg" d="m930.9 585.61c-15.883 58.699-1.3812 95.991-1.3812 95.991l67.677 1.3812 4.1435-95.991z"/>
   <path id="lbh" d="m858.39 485.48c-1.3812 64.224 0 98.063 0 98.063l70.439-2.7623-2.7623-98.063z"/>
   <path id="lbi" d="m933.67 482.72-2.7623 99.444 66.986 2.7623v-102.21z"/>
   <path id="lbj" d="m859.08 382.58c0 71.13-1.3812 101.52-1.3812 101.52l72.511 2.0718-1.3812-104.28-66.296 2.0717z"/>
   <path id="lbk" d="m928.14 383.27 0.69058 98.753 71.13-0.69058-1.3812-100.13z"/>
   <path id="lbl" d="m159.52 384.65 6.9058 98.753h68.368l0.69058-100.82z"/>
   <path id="lbm" d="m164.36 484.1 0.69059 97.372 71.13 0.69058-1.3812-102.9z"/>
   <path id="lbn" d="m230.65 485.48 4.8341 97.372 70.439-3.4529-4.1435-95.991z"/>
   <path id="lbo" d="m234.8 385.34v95.3l64.224 2.0717 4.1435-98.063z"/>
   <path id="lbp" d="m165.05 282.45 0.69058 99.444 67.677 0.69058-0.69058-100.13z"/>
   <path id="lbq" d="m229.27 282.45 7.5964 99.444 66.296 2.0717 2.0718-100.82z"/>
   <path id="lbr" d="m234.8 187.84-0.69058 95.991h-68.368v-101.52z"/>
   <path id="lbs" d="m234.11 186.46-0.69058 94.61 66.296 0.69058-0.69058-100.13-64.915 2.0718z"/>
   <path id="lbt" d="m350.82 185.77-1.3812 62.152 35.91 33.148 33.148 3.4529 0.69058-98.063z"/>
   <path id="lbu" d="m446.12 323.88-1.3812 54.556 88.394 2.7623 3.4529-62.152z"/>
   <path id="lbv" d="m536.58 323.19-0.69058 58.699 77.345-2.7623 1.3812-57.318z"/>
   <path id="lbw" d="m486.17 182.31 4.1435 100.13-68.368-2.0718v-93.919z"/>
   <path id="lbx" d="m524.84 185.77v98.753l75.273-2.7623-1.3812-97.372z"/>
   <path id="lby" d="m651.22 187.15 1.3812 94.61 78.036 0.69059 2.0717-99.444z"/>
   <path id="lbz" d="m613.93 324.57 2.7623 59.39 93.228-0.69058v-62.843z"/>
   <path id="lca" d="m733.4 186.46 2.0717 95.991 41.435 2.0717 36.601-37.291-5.5246-64.224z"/>
   <path id="lcb" d="m859.77 181.62s-2.0718 99.444 2.0717 99.444 66.986 2.0718 66.986 2.0718l-2.0718-100.82z"/>
   <path id="lcc" d="m859.43 286.4-0.48832 94.001s67.387 2.1974 67.632 0.48832-0.97663-97.663-0.97663-97.663h-66.167z"/>
   <path id="lcd" d="m929.51 283.71c-4.639 20.998-2.1974 96.686-2.1974 96.686l70.073 0.48832-3.4182-95.954z"/>
   <path id="lce" d="m930.73 184.58c7.3247 25.881-1.9533 99.128-1.9533 99.128l64.213 1.7091 1.9533-103.03z"/>
   <path id="lcf" d="m930 182.39-0.73248 99.86 67.143 1.7091-0.48831-101.33z"/>
  </g>
  <?php  
    include 'database_config.php';

    // Create a new MySQLi connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stall_status = 'Status not found'; // Default value

    // Fetch stall_status for stall_no 'A-01'
    $stall_no = 'A-09'; // Example stall ID
    $query = "SELECT stall_status FROM building_a WHERE stall_no = '$stall_no'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            $stall_status = $row['stall_status']; // Update variable if found
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

 </g>
 <g id="lcg">
  <path id="lch" d="m812.39 1123 3.0656 38.831 41.897 49.05 4.0875-91.969z" style="opacity:0;stroke-width:6"/>
 </g>
 
 <a id="A-68" data-stall-no="A-68" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lcg">
  <path id="lch" d="m812.39 1123 3.0656 38.831 41.897 49.05 4.0875-91.969z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

 <a id="A-67" data-stall-no="A-67" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lci">
  <path id="lcj" d="m784.8 1028-1.0219 94.013 75.619-3.0657-1.0219-87.882z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-66" data-stall-no="A-66" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lck">
  <path id="lcl" d="m786.85 940.13c-2.0438 6.1313 0 81.75 0 81.75l65.4 1.0219v-81.75z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 <a id="A-65" data-stall-no="A-65" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lcm">
  <path id="lcn" d="m619.26 235.03 10.219 72.553 102.19 1.0219s4.0875-68.466 0-70.51-112.41-3.0656-112.41-3.0656z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-64" data-stall-no="A-64" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lco">
  <path id="lcp" d="m528.31 237.08 2.0438 73.575 88.903-1.0219 2.0438-76.641z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 

 <a id="A-63" data-stall-no="A-63" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lcq">
  <path id="lcr" d="m429.19 235.03-3.0656 72.553 109.34 3.0656-5.1094-75.619z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 <a id="A-62" data-stall-no="A-62" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lcs">
  <path id="lct" d="m302.48 1027 1.0219-90.947 70.51 2.0438 4.0875 87.882z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 
 <a id="A-61" data-stall-no="A-61" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lcu">
  <path id="lcv" d="m307.59 1034.1-4.0875 83.794 66.422-1.0219 6.1313-83.794z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

 <a id="A-60" data-stall-no="A-60" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lcw">
  <path id="lcx" d="m303.5 1125.1-1.0219 86.86 44.963-41.897 1.0219-50.072z" style="opacity:0;stroke-width:6"/>
 </g>

  </a>
 
 <a id="A-59" data-stall-no="A-59" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lcy">
  <path id="lcz" d="m187 1242.6v106.28s73.575-55.182 74.597-62.335c1.0219-7.1532 0-47.006 0-47.006z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

 <a id="A-58" data-stall-no="A-58" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lda">
  <path id="ldb" d="m187 1122v115.47s82.772 4.0875 79.707 0c-3.0656-4.0875-2.0438-115.47-2.0438-115.47z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 <a id="A-57" data-stall-no="A-57" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ldc">
  <path id="ldd" d="m187 1008.6 3.0656 106.28 68.466 7.1532 1.0219-117.52z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-56" data-stall-no="A-56" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
 <g id="lde">
  <path id="ldf" d="m188.03 893.12-4.0875 111.38 69.488 1.0219 4.0875-115.47z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-55" data-stall-no="A-55" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ldg">
  <path id="ldh" d="m181.89 774.58 1.0219 114.45h78.685v-117.52z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 
 <a id="A-54" data-stall-no="A-54" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ldi">
  <path id="ldj" d="m181.89 544.66 1.0219 111.38 74.597 4.0875-4.0875-123.65z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-53" data-stall-no="A-53" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ldk">
  <path id="ldl" d="m181.89 426.12 3.0656 119.56 75.619-10.219 1.0219-108.32z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-52" data-stall-no="A-52" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ldm">
  <path id="ldn" d="m183.94 315.76 1.0219 112.41 72.553-5.1094 3.0656-113.43z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

  
 <a id="51" data-stall-no="A-51" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ldo">
  <path id="ldp" d="m181.89 195.18 3.0656 113.43 72.553-3.0656-1.0219-107.3z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 
 <a id="A-50" data-stall-no="A-50" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ldq">
  <path id="ldr" d="m107.3 1239.5-4.0875 116.49 80.728-1.0219v-115.47z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-49" data-stall-no="A-49" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lds">
  <path id="ldt" d="m104.23 1123-2.0438 115.47 79.707-1.0219v-114.45z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 <a id="A-48" data-stall-no="A-48" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ldu">
  <path id="ldv" d="m105.25 1005.5v111.38l77.663 2.0437v-112.41z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-47" data-stall-no="A-47" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ldw">
  <path id="ldx" d="m107.3 894.14-5.1094 109.34 79.707 1.0219-1.0219-114.45-77.663 2.0438z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-46" data-stall-no="A-46" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ldy">
  <path id="ldz" d="m102.19 779.69 3.0656 109.34 75.619 1.0219 2.0438-112.41z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 <a id="A-45" data-stall-no="A-45" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
 <g id="lea">
  <path id="leb" d="m107.3 546.71-2.0438 108.32h82.772l-2.0438-109.34z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-44" data-stall-no="A-44" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lec">
  <path id="led" d="m106.28 428.17 1.0219 114.45h71.532v-114.45z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 <a id="A-43" data-stall-no="A-43" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lee">
  <path id="lef" d="m112.41 313.72v111.38l71.532-2.0438 2.0438-108.32z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-42" data-stall-no="A-42" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="leg">
  <path id="leh" d="m106.28 197.22v107.3l78.685-2.0438-3.0656-108.32z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-41" data-stall-no="A-41" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lei">
  <path id="lej" d="m107.3 80.728-1.0219 113.43 75.619-1.0219 2.0438-114.45z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-40" data-stall-no="A-40" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lek">
  <path id="lel" d="m181.89 77.663v117.52l78.685 1.0219 2.0438-117.52z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

 <a id="A-39" data-stall-no="A-39" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lem">
  <path id="len" d="m319.85 78.685-5.1094 71.532 48.028 45.985 32.7-2.0438-1.0219-113.43z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

 <a id="A-38" data-stall-no="A-38" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="leo">
  <path id="lep" d="m396.49 76.641 2.0438 116.49 78.685 1.0219 3.0656-117.52z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

 <a id="A-37" data-stall-no="A-37" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="leq">
  <path id="ler" d="m516.05 77.663 2.0438 116.49h74.597l10.219-114.45z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-36" data-stall-no="A-36" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="les">
  <path id="let" d="m661.16 78.685v110.36l89.925 3.0656 3.0656-109.34-98.1-7.1532z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 <a id="A-35" data-stall-no="A-35" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
 <g id="leu">
  <path id="lev" d="m757.21 75.619v119.56l41.897-3.0656 42.919-38.831 3.0656-75.619z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

 <a id="A-34" data-stall-no="A-34" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lew">
  <path id="lex" d="m905.38 78.685-1.0219 112.41 70.51 1.0219 2.0438-113.43z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

 

 <a id="A-33" data-stall-no="A-33" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="ley">
  <path id="lez" d="m979.98 78.685 1.0219 114.45 77.663 1.0219-1.0219-116.49z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 <a id="A-32" data-stall-no="A-32" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfa">
  <path id="lfb" d="m898.23 196.2-2.0438 105.25h78.685l2.0438-106.28z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-31" data-stall-no="A-31" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfc">
  <path id="lfd" d="m897.21 313.72v111.38s79.707 5.1094 79.707 1.0219v-112.41z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 <a id="A-30" data-stall-no="A-30" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfe">
  <path id="lff" d="m895.17 428.17 3.0656 113.43 80.728 1.0219-2.0438-120.58z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-29" data-stall-no="A-29" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfg">
  <path id="lfh" d="m898.23 538.53 5.1094 119.56 82.772-1.0219-6.1313-114.45z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-28" data-stall-no="A-28" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfi">
  <path id="lfj" d="m900.28 771.52 1.0219 117.52 76.641 2.0438-1.0219-123.65z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-27" data-stall-no="A-27" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfk">
  <path id="lfl" d="m904.36 883.93 2.0438 121.6h72.553l1.0219-118.54z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 <a id="A-26" data-stall-no="A-26" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfm">
  <path id="lfn" d="m902.32 1007.6-1.0219 111.38 77.663-1.0218-1.0219-115.47-84.816 7.1532z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

 <a id="A-25" data-stall-no="A-25" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfo">
  <path id="lfp" d="m899.25 1116.9 3.0656 121.6 76.641-2.0438v-115.47z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 <a id="A-24" data-stall-no="A-24" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfq">
  <path id="lfr" d="m903.34 1239.5-2.0438 53.138s78.685 73.575 78.685 64.378v-120.58z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-23" data-stall-no="A-23" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfs">
  <path id="lft" d="m982.03 195.18-2.0438 110.36s79.707 9.1969 79.707 2.0438c0-7.1532-2.0437-111.38-2.0437-111.38z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 
 <a id="A-22" data-stall-no="A-22" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfu">
  <path id="lfv" d="m979.98 310.65-2.0438 112.41 78.685-1.0219 1.0219-115.47-83.794 7.1532z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-21" data-stall-no="A-21" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfw">
  <path id="lfx" d="m975.89 424.08 4.0875 113.43 78.685-1.0219-5.1094-116.49-72.553 6.1313z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-20" data-stall-no="A-20" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lfy">
  <path id="lfz" d="m981 546.71 1.0219 108.32h72.553l1.0218-113.43z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 
 

 <a id="A-19" data-stall-no="A-19" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lga">
  <path id="lgb" d="m978.96 765.39-2.0438 120.58 81.75-1.0219-7.1532-116.49z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-18" data-stall-no="A-18" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lgc">
  <path id="lgd" d="m977.94 890.06 3.0656 116.49 80.728-1.0218-2.0438-121.6z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

 <a id="A-17" data-stall-no="A-17" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lge">
  <path id="lgf" d="m979.98 1004.5-1.0219 118.54 77.663-3.0656 1.0219-113.43z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>
 

 <a id="A-16" data-stall-no="A-16" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
 <g id="lgg">
  <path id="lgh" d="m984.07 1123-2.0438 113.43 75.619 4.0875-3.0656-116.49z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 <a id="A-15" data-stall-no="A-15" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lgi">
  <path id="lgj" d="m979.98 1237.5 1.0219 116.49 72.553 1.0219-1.0219-117.52z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 <a id="A-14" data-stall-no="A-14" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lgk">
  <path id="lgl" d="m730.64 1167v73.575l92.991 2.0438-67.444-78.685z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 
 <a id="A-13" data-stall-no="A-13" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lgm">
  <path id="lgn" d="m674.44 1170.1 2.0438 69.488h52.116l-2.0438-72.554z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 
 <a id="A-12" data-stall-no="A-12" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g id="lgo">
  <path id="lgp" d="m433.28 1170.1 1.0219 73.575 73.575-2.0438 2.0438-72.553z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>


 
 <a id="A-11" data-stall-no="A-11" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
    <g>
  <path d="m334.15 1241.6 73.575-75.619h23.503l1.0219 73.575z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

  <a id="A-10" data-stall-no="A-10" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="lgs">
  <path id="lgt" d="m331.09 1283.5-71.532 66.422 1.0219 25.547 113.43 1.0218 3.0656-94.013z" style="opacity:0;stroke-width:6"/>
 </g>
</a>
 
 
 <a id="A-09" data-stall-no="A-09" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
    data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
  <g>
  <path d="m377.07 1284.5-2.0438 86.86 112.41 3.0657 2.0438-88.904z" style="opacity:0;stroke-width:6"/>
 </g>
  </a>

  <a id="A-08" data-stall-no="A-08" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="lgw">
  <path id="lgx" d="m672.4 1284.5-2.0438 72.553 113.43-1.0218 4.0875-70.51z" style="opacity:0;stroke-width:6"/>
 </g>
</a>
 

 <a id="A-07" data-stall-no="A-07" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="lgy">
  <path id="lgz" d="m788.89 1285.5 1.0219 85.838 113.43 6.1313-1.0219-22.481-70.51-71.532z" style="opacity:0;stroke-width:6"/>
 </g>
</a>


 <a id="A-06" data-stall-no="A-06" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="lha">
  <path id="lhb" d="m903.34 1351.9v104.23l72.553-2.0438v-44.963z" style="opacity:0;stroke-width:6"/>
 </g>
</a>

 <a id="A-05" data-stall-no="A-05" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="lhc">
  <path id="lhd" d="m789.91 1374.4v81.75h113.43l-3.0656-80.728z" style="opacity:0;stroke-width:6"/>
 </g>
</a>


 <a id="A-04" data-stall-no="A-04" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="lhe">
  <path id="lhf" d="m672.4 1355v98.1l111.38-2.0438 2.0438-97.078z" style="opacity:0;stroke-width:6"/>
 </g>
</a>


 <a id="A-03" data-stall-no="A-03" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g>
       <path d="m376.05 1373.4v81.75l115.47-1.0219-2.0438-75.619z" style="opacity:0;stroke-width:6"/>
   </g>
</a>

<a id="A-02" data-stall-no="A-02" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g>
       <path d="m264.67 1372.4-3.0656 77.663 113.43 2.0438v-74.597z" style="opacity:0;stroke-width:6"/>
   </g>
</a>

<a id="A-01" data-stall-no="A-01" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g>
       <path d="m184.96 1414.3 1.0219 38.831h74.597l1.0219-102.19z" style="opacity:0;stroke-width:6"/>
   </g>
</a>
</svg>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      var stallNo = tooltipTriggerEl.getAttribute('data-stall-no'); // Get stall_no from data attribute

      // Fetch the stall status and occupant via AJAX
      fetch('fetch_stall_statusA.php?stall_no=' + stallNo)
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