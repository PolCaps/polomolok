<?php
session_name('admin_session');
session_start();

if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'ADMIN') {
    header("Location: index.php");
    exit();
}
// Get the vendor ID from the session
$user_id = $_SESSION['id'];

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
                                AND building_id BETWEEN 1 AND 69";

                        $result = $conn->query($sql);

                        // Check if query was successful
                        if ($result->num_rows > 0) {
                            // Fetch result
                            $row = $result->fetch_assoc();
                            echo "First Floor: " . $row['total_vacant'];
                        } else {
                            echo "No vacant stalls found.";
                        }

                        $sql = "SELECT stall_no FROM building_a WHERE stall_status = 'Occupied' AND building_id BETWEEN 1 AND 69";
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
                                AND building_id BETWEEN 1 AND 69";

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
                      AND building_id BETWEEN 1 AND 69";

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
                              WHERE building_id BETWEEN 1 AND 69";
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
                              FROM building_a ";
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
                    <li class="page-item mx-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ground Floor">
                      <a class="page-link" href="ABuildingA.php">1</a>
                    </li>
                    <li class="page-item mx-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Second Floor">
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
                <span class="font-weight-bold">Building A</span>
              </p>  
            </div>
            
            <svg id="svg1" version="1.1" viewBox="0 0 1122.7 1588" xmlns="http://www.w3.org/2000/svg">
 <defs id="defs1">
  <clipPath id="clipPath2">
   <path id="path2" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath4">
   <path id="path4" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath8">
   <path id="path8" transform="rotate(-90,-419.5,3895)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath13">
   <path id="path13" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath15">
   <path id="path15" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath17">
   <path id="path17" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath19">
   <path id="path19" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath21">
   <path id="path21" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath23">
   <path id="path23" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath25">
   <path id="path25" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath27">
   <path id="path27" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath29">
   <path id="path29" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath31">
   <path id="path31" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath33">
   <path id="path33" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath35">
   <path id="path35" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath37">
   <path id="path37" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath39">
   <path id="path39" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath41">
   <path id="path41" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath43">
   <path id="path43" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath45">
   <path id="path45" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath47">
   <path id="path47" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath49">
   <path id="path49" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath51">
   <path id="path51" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath53">
   <path id="path53" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath55">
   <path id="path55" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath57">
   <path id="path57" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath59">
   <path id="path59" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath61">
   <path id="path61" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath63">
   <path id="path63" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath65">
   <path id="path65" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath67">
   <path id="path67" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath69">
   <path id="path69" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath71">
   <path id="path71" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath73">
   <path id="path73" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath75">
   <path id="path75" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath77">
   <path id="path77" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath79">
   <path id="path79" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath81">
   <path id="path81" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath83">
   <path id="path83" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath85">
   <path id="path85" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath87">
   <path id="path87" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath89">
   <path id="path89" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath91">
   <path id="path91" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath93">
   <path id="path93" transform="rotate(-90,-1790,5265.5)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath95">
   <path id="path95" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath97">
   <path id="path97" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath99">
   <path id="path99" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath101">
   <path id="path101" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath103">
   <path id="path103" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath105">
   <path id="path105" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath107">
   <path id="path107" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath109">
   <path id="path109" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath111">
   <path id="path111" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath113">
   <path id="path113" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath115">
   <path id="path115" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath117">
   <path id="path117" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath119">
   <path id="path119" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath121">
   <path id="path121" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath123">
   <path id="path123" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath125">
   <path id="path125" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath127">
   <path id="path127" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath129">
   <path id="path129" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath131">
   <path id="path131" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath133">
   <path id="path133" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath135">
   <path id="path135" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath137">
   <path id="path137" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath139">
   <path id="path139" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath141">
   <path id="path141" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath143">
   <path id="path143" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath145">
   <path id="path145" transform="translate(-2.0833e-7 -.00020833)" d="m518 986h5965v8411h-5965v-8411"/>
  </clipPath>
  <clipPath id="clipPath16292">
   <path id="path16292" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16294">
   <path id="path16294" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16305">
   <path id="path16305" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16307">
   <path id="path16307" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16318">
   <path id="path16318" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16320">
   <path id="path16320" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16331">
   <path id="path16331" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16333">
   <path id="path16333" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16344">
   <path id="path16344" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16346">
   <path id="path16346" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16357">
   <path id="path16357" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16359">
   <path id="path16359" transform="translate(-2.0833e-7 -.00020833)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16369">
   <path id="path16369" transform="matrix(1 0 0 -1 -1900 1836)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16370">
   <path id="path16370" transform="matrix(1 0 0 -1 -2537 1851)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16371">
   <path id="path16371" transform="matrix(1 0 0 -1 -4238 1853)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16372">
   <path id="path16372" transform="matrix(1 0 0 -1 -4917 1840)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16373">
   <path id="path16373" transform="matrix(1 0 0 -1 -5763 2428)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16374">
   <path id="path16374" transform="matrix(1 0 0 -1 -5772 3084)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16375">
   <path id="path16375" transform="matrix(1,0,0,-1,-5768,3725)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16376">
   <path id="path16376" transform="matrix(1,0,0,-1,-5700,4961)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16377">
   <path id="path16377" transform="matrix(1,0,0,-1,-5742,4357)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16378">
   <path id="path16378" transform="matrix(1,0,0,-1,-5725,6270)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16379">
   <path id="path16379" transform="matrix(1,0,0,-1,-5745,6927)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16380">
   <path id="path16380" transform="matrix(1,0,0,-1,-5752,7569)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16381">
   <path id="path16381" transform="matrix(1,0,0,-1,-5736,8272)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16382">
   <path id="path16382" transform="matrix(1,0,0,-1,-5709,8894)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16383">
   <path id="path16383" transform="matrix(1 0 0 -1 -992 8236)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16384">
   <path id="path16384" transform="matrix(1,0,0,-1,-1061,8887)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16385">
   <path id="path16385" transform="matrix(1,0,0,-1,-1012,7594)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16386">
   <path id="path16386" transform="matrix(1,0,0,-1,-1034,6922)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16387">
   <path id="path16387" transform="matrix(1,0,0,-1,-1017,6261)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16388">
   <path id="path16388" transform="matrix(1,0,0,-1,-1028,4991)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16389">
   <path id="path16389" transform="matrix(1,0,0,-1,-1022,4328)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16390">
   <path id="path16390" transform="matrix(1,0,0,-1,-1039,3681)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16391">
   <path id="path16391" transform="matrix(1 0 0 -1 -1012 3064)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16392">
   <path id="path16392" transform="matrix(1 0 0 -1 -1010 2451)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16393">
   <path id="path16393" transform="matrix(1,0,0,-1,-4886,8226)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
  <clipPath id="clipPath16394">
   <path id="path16394" transform="matrix(1,0,0,-1,-1906,8231)" d="m387 0h6204v9883h-6204v-9883"/>
  </clipPath>
 </defs>
 <g id="g16491">
  <g id="g16490" transform="matrix(1.1608 0 0 1.1194 -87.799 -93.732)">
   <g id="layer-oc24">
    <g id="g16489">
     <path id="path1" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3672 4142h33l-33 624zm33 0-33 624h33z" clip-path="url(#clipPath2)" style="fill:#ff7f00;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path3" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3245 4142h33l-33 624zm33 0-33 624h33z" clip-path="url(#clipPath4)" style="fill:#ff7f00;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path5" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3377 4273h196" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3377 4265h196" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path7" transform="matrix(0 -.16 -.16 0 558.75 895.01)" d="m24.5 0c0 13.531-10.969 24.5-24.5 24.5s-24.5-10.969-24.5-24.5 10.969-24.5 24.5-24.5 24.5 10.969 24.5 24.5" clip-path="url(#clipPath8)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 5750-15-2h30z" clip-path="url(#clipPath13)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path14" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3447 5743h56l-43 5zm56 0-43 5h30z" clip-path="url(#clipPath15)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path16" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3434 5735h82l-69 8zm82 0-69 8h56z" clip-path="url(#clipPath17)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path18" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3424 5725h102l-92 10zm102 0-92 10h82z" clip-path="url(#clipPath19)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path20" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3416 5713h118l-110 12zm118 0-110 12h102z" clip-path="url(#clipPath21)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path22" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3411 5699h128l-123 14zm128 0-123 14h118z" clip-path="url(#clipPath23)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path24" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3409 5684h132l-130 15zm132 0-130 15h128z" clip-path="url(#clipPath25)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path26" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3411 5670h128l-130 14zm128 0-130 14h132z" clip-path="url(#clipPath27)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path28" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3416 5656h118l-123 14zm118 0-123 14h128z" clip-path="url(#clipPath29)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path30" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3424 5643h102l-110 13zm102 0-110 13h118z" clip-path="url(#clipPath31)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path32" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3434 5633h82l-92 10zm82 0-92 10h102z" clip-path="url(#clipPath33)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path34" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3447 5625h56l-69 8zm56 0-69 8h82z" clip-path="url(#clipPath35)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path36" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3447 5625 13-5h30zm13-5h30l-15-1z" clip-path="url(#clipPath37)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path38" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3447 5625h56l-13-5z" clip-path="url(#clipPath39)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path40" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2655 5687v-6l1640 6zm0-6 1640 6v-6z" clip-path="url(#clipPath41)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path42" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4199 4273h-5l3 55zm-5 0 3 55-5-1zm3 55-5-1-1 54zm-5-1-1 54h-5zm-1 54h-5l-5 54zm-5 0-5 54-5-2zm-5 54-5-2-9 54zm-5-2-9 54-5-2zm-9 54-5-2-13 53zm-5-2-13 53-5-2zm-13 53-5-2-16 52zm-5-2-16 52-5-3zm-16 52-5-3-21 51zm-5-3-21 51-4-3zm-21 51-4-3-24 48zm-4-3-24 48-5-3zm-24 48-5-3-28 47zm-5-3-28 47-4-3zm-28 47-4-3-31 44zm-4-3-31 44-4-4zm-31 44-4-4-34 42zm-4-4-34 42-4-3zm-34 42-4-3-37 39zm-4-3-37 39-4-4zm-37 39-4-4-40 36zm-4-4-40 36-3-4zm-40 36-3-4-43 33zm-3-4-43 33-3-5zm-43 33-3-5-45 30zm-3-5-45 30-2-5zm-45 30-2-5-47 27zm-2-5-47 27-2-5zm-47 27-2-5-49 23zm-2-5-49 23-2-5zm-49 23-2-5-51 19zm-2-5-51 19-1-6zm-51 19-1-6-52 16zm-1-6-52 16-1-6zm-52 16-1-6-53 12zm-1-6-53 12v-6zm-53 12v-6l-54 8zm0-6-54 8v-6zm-54 8v-6l-54 4zm0-6-54 4v-6zm-54 4v-6h-54zm0-6h-54l1-6zm-54 0 1-6-54-4zm1-6-54-4 1-6zm-54-4 1-6-54-8zm1-6-54-8 2-5zm-54-8 2-5-53-13zm2-5-53-13 2-5zm-53-13 2-5-51-17zm2-5-51-17 2-5zm-51-17 2-5-50-20zm2-5-50-20 3-5zm-50-20 3-5-49-24zm3-5-49-24 3-4zm-49-24 3-4-47-28zm3-4-47-28 4-4zm-47-28 4-4-45-32zm4-4-45-32 4-3zm-45-32 4-3-42-35zm4-3-42-35 4-4zm-42-35 4-4-39-37zm4-4-39-37 4-3zm-39-37 4-3-36-41zm4-3-36-41 4-3zm-36-41 4-3-33-42zm4-3-33-42 4-3zm-33-42 4-3-30-45zm4-3-30-45 5-3zm-30-45 5-3-26-47zm5-3-26-47 5-2zm-26-47 5-2-23-49zm5-2-23-49 5-2zm-23-49 5-2-19-50zm5-2-19-50 5-2zm-19-50 5-2-15-52zm5-2-15-52h5zm-15-52h5l-11-53zm5 0-11-53 5-1zm-11-53 5-1-7-54zm5-1-7-54h5z" clip-path="url(#clipPath43)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path44" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2756 4273h-5l5-131zm-5 0 5-131h-5z" clip-path="url(#clipPath45)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path46" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4199 4273h-5l5-131zm-5 0 5-131h-5z" clip-path="url(#clipPath47)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path48" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 4962-28-2h56z" clip-path="url(#clipPath49)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path50" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3420 4954h110l-83 6zm110 0-83 6h56z" clip-path="url(#clipPath51)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path52" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3393 4945h164l-137 9zm164 0-137 9h110z" clip-path="url(#clipPath53)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path54" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3369 4931h212l-188 14zm212 0-188 14h164z" clip-path="url(#clipPath55)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path56" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3346 4914h258l-235 17zm258 0-235 17h212z" clip-path="url(#clipPath57)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path58" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3326 4894h298l-278 20zm298 0-278 20h258z" clip-path="url(#clipPath59)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path60" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3309 4872h332l-315 22zm332 0-315 22h298z" clip-path="url(#clipPath61)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path62" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3296 4847h358l-345 25zm358 0-345 25h332z" clip-path="url(#clipPath63)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path64" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3286 4821h378l-368 26zm378 0-368 26h358z" clip-path="url(#clipPath65)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path66" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3280 4794h390l-384 27zm390 0-384 27h378z" clip-path="url(#clipPath67)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path68" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3278 4766h394l-392 28zm394 0-392 28h390z" clip-path="url(#clipPath69)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path70" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3243 4142h5l-5 626zm5 0-5 626 5-5zm-5 626 5-5 459 5zm5-5 459 5-5-5zm459 5-5-5 5-621zm-5-5 5-621h-5z" clip-path="url(#clipPath71)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path72" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3281 4766h-5l5-624zm-5 0 5-624h-5z" clip-path="url(#clipPath73)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path74" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3675 4766h-6l6-624zm-6 0 6-624h-6z" clip-path="url(#clipPath75)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path76" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3278 4794 5-1-7-27zm5-1-7-27h5zm-7-27h5l-3-29zm5 0-3-29 5 1zm-3-29 5 1 1-29zm5 1 1-29 5 2zm1-29 5 2 5-28zm5 2 5-28 4 2zm5-28 4 2 9-27zm4 2 9-27 5 3zm9-27 5 3 12-26zm5 3 12-26 4 3zm12-26 4 3 16-23zm4 3 16-23 4 4zm16-23 4 4 19-21zm4 4 19-21 3 4zm19-21 3 4 22-18zm3 4 22-18 2 5zm22-18 2 5 25-15zm2 5 25-15 1 5zm25-15 1 5 27-11zm1 5 27-11v5zm27-11v5l28-7zm0 5 28-7v5zm28-7v5l28-3zm0 5 28-3v5zm28-3v5l28 1zm0 5 28 1-1 5zm28 1-1 5 28 5zm-1 5 28 5-2 5zm28 5-2 5 27 9zm-2 5 27 9-3 4zm27 9-3 4 26 13zm-3 4 26 13-4 4zm26 13-4 4 24 16zm-4 4 24 16-4 3zm24 16-4 3 21 20zm-4 3 21 20-5 3zm21 20-5 3 18 22zm-5 3 18 22-4 2zm18 22-4 2 14 24zm-4 2 14 24-5 2zm14 24-5 2 11 26zm-5 2 11 26-5 1zm11 26-5 1 8 28zm-5 1 8 28h-6zm8 28h-6l3 28zm-6 0 3 28-5-1zm3 28-5-1-1 29zm-5-1-1 29-5-2zm-1 29-5-2-5 28zm-5-2-5 28-4-2zm-5 28-4-2-9 27zm-4-2-9 27-5-3zm-9 27-5-3-12 26zm-5-3-12 26-4-3zm-12 26-4-3-16 23zm-4-3-16 23-4-4zm-16 23-4-4-19 21zm-4-4-19 21-3-4zm-19 21-3-4-22 18zm-3-4-22 18-2-5zm-22 18-2-5-25 15zm-2-5-25 15-1-5zm-25 15-1-5-27 11zm-1-5-27 11v-5zm-27 11v-5l-28 7zm0-5-28 7v-5zm-28 7v-5l-28 3zm0-5-28 3v-5zm-28 3v-5l-28-1zm0-5-28-1 1-5zm-28-1 1-5-28-5zm1-5-28-5 2-5zm-28-5 2-5-27-9zm2-5-27-9 3-4zm-27-9 3-4-26-13zm3-4-26-13 4-4zm-26-13 4-4-24-16zm4-4-24-16 4-3zm-24-16 4-3-21-20zm4-3-21-20 5-3zm-21-20 5-3-18-22zm5-3-18-22 4-2zm-18-22 4-2-14-24zm4-2-14-24 5-2zm-14-24 5-2-11-26zm5-2-11-26 5-1z" clip-path="url(#clipPath77)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path78" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3675 5684h-6l3 29zm-6 0 3 29-5-1zm3 29-5-1-1 28zm-5-1-1 28-5-1zm-1 28-5-1-5 28zm-5-1-5 28-4-2zm-5 28-4-2-9 27zm-4-2-9 27-5-3zm-9 27-5-3-12 26zm-5-3-12 26-4-4zm-12 26-4-4-16 24zm-4-4-16 24-4-4zm-16 24-4-4-19 21zm-4-4-19 21-3-5zm-19 21-3-5-22 19zm-3-5-22 19-2-5zm-22 19-2-5-25 15zm-2-5-25 15-1-6zm-25 15-1-6-27 12zm-1-6-27 12v-6zm-27 12v-6l-28 8zm0-6-28 8v-6zm-28 8v-6l-28 4zm0-6-28 4v-6zm-28 4v-6h-28zm0-6h-28l1-6zm-28 0 1-6-28-4zm1-6-28-4 2-5zm-28-4 2-5-27-9zm2-5-27-9 3-5zm-27-9 3-5-26-12zm3-5-26-12 4-4zm-26-12 4-4-24-16zm4-4-24-16 4-4zm-24-16 4-4-21-19zm4-4-21-19 5-3zm-21-19 5-3-18-22zm5-3-18-22 4-2zm-18-22 4-2-14-25zm4-2-14-25 5-1zm-14-25 5-1-11-26zm5-1-11-26 5-1zm-11-26 5-1-7-28zm5-1-7-28h5z" clip-path="url(#clipPath79)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path80" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3408 5699 6-1-7-14zm6-1-7-14h5zm-7-14h5l-4-15zm5 0-4-15 6 1zm-4-15 6 1-1-16zm6 1-1-16 5 3zm-1-16 5 3 4-15zm5 3 4-15 4 3zm4-15 4 3 6-14zm4 3 6-14 4 4zm6-14 4 4 9-12zm4 4 9-12 3 4zm9-12 3 4 12-9zm3 4 12-9 1 5zm12-9 1 5 14-7zm1 5 14-7v5zm14-7v5l15-3zm0 5 15-3-1 5zm15-3-1 5h16zm-1 5h16l-3 4zm16 0-3 4 16 4zm-3 4 16 4-4 4zm16 4-4 4 14 7zm-4 4 14 7-4 3zm14 7-4 3 13 9zm-4 3 13 9-5 3zm13 9-5 3 10 12zm-5 3 10 12-6 1zm10 12-6 1 7 14zm-6 1 7 14h-5zm7 14h-5l4 15zm-5 0 4 15-6-1zm4 15-6-1 1 16zm-6-1 1 16-5-3zm1 16-5-3-4 16zm-5-3-4 16-4-4zm-4 16-4-4-6 15zm-4-4-6 15-4-5zm-6 15-4-5-9 13zm-4-5-9 13-3-5zm-9 13-3-5-12 10zm-3-5-12 10-1-6zm-12 10-1-6-14 7zm-1-6-14 7v-5zm-14 7v-5l-15 4zm0-5-15 4 1-6zm-15 4 1-6-16 1zm1-6-16 1 3-5zm-16 1 3-5-16-3zm3-5-16-3 4-5zm-16-3 4-5-14-6zm4-5-14-6 4-4zm-14-6 4-4-13-9zm4-4-13-9 5-3zm-13-9 5-3-10-12zm5-3-10-12 6-1z" clip-path="url(#clipPath81)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path82" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3276 5684h5l-3-28zm5 0-3-28h5zm-3-28h5l1-28zm5 0 1-28 5 1zm1-28 5 1 5-28zm5 1 5-28 4 2zm5-28 4 2 9-27zm4 2 9-27 5 3zm9-27 5 3 12-26zm5 3 12-26 4 4zm12-26 4 4 16-24zm4 4 16-24 4 4zm16-24 4 4 19-21zm4 4 19-21 3 5zm19-21 3 5 22-18zm3 5 22-18 2 5zm22-18 2 5 25-15zm2 5 25-15 1 5zm25-15 1 5 27-11zm1 5 27-11v5zm27-11v5l28-7zm0 5 28-7v5zm28-7v5l28-3zm0 5 28-3v5zm28-3v5l28 1zm0 5 28 1-1 5zm28 1-1 5 28 5zm-1 5 28 5-2 5zm28 5-2 5 27 8zm-2 5 27 8-3 5zm27 8-3 5 26 12zm-3 5 26 12-4 4zm26 12-4 4 24 16zm-4 4 24 16-4 4zm24 16-4 4 21 19zm-4 4 21 19-5 3zm21 19-5 3 18 22zm-5 3 18 22-4 2zm18 22-4 2 14 25zm-4 2 14 25-5 1zm14 25-5 1 11 27zm-5 1 11 27h-5zm11 27h-5l8 28zm-5 0 8 28h-6z" clip-path="url(#clipPath83)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path84" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3672 6603h33l-33 623zm33 0-33 623h33z" clip-path="url(#clipPath85)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path86" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3245 6603h33l-33 623zm33 0-33 623h33z" clip-path="url(#clipPath87)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path88" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3377 7095h196" clip-path="url(#clipPath89)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path90" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3377 7103h196" clip-path="url(#clipPath91)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path92" transform="matrix(0 -.16 -.16 0 558.75 456.45)" d="m24.5 0c0 13.531-10.969 24.5-24.5 24.5s-24.5-10.969-24.5-24.5 10.969-24.5 24.5-24.5 24.5 10.969 24.5 24.5" clip-path="url(#clipPath93)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path94" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2751 7095h5l-3-54zm5 0-3-54h5zm-3-54h5l1-54zm5 0 1-54 5 1zm1-54 5 1 5-54zm5 1 5-54 5 1zm5-54 5 1 9-54zm5 1 9-54 5 2zm9-54 5 2 13-53zm5 2 13-53 5 2zm13-53 5 2 16-52zm5 2 16-52 5 3zm16-52 5 3 21-50zm5 3 21-50 4 2zm21-50 4 2 25-48zm4 2 25-48 4 3zm25-48 4 3 28-47zm4 3 28-47 4 4zm28-47 4 4 31-45zm4 4 31-45 4 4zm31-45 4 4 34-42zm4 4 34-42 4 4zm34-42 4 4 37-40zm4 4 37-40 4 5zm37-40 4 5 40-37zm4 5 40-37 3 5zm40-37 3 5 43-34zm3 5 43-34 3 5zm43-34 3 5 45-30zm3 5 45-30 2 5zm45-30 2 5 47-27zm2 5 47-27 2 5zm47-27 2 5 49-22zm2 5 49-22 2 5zm49-22 2 5 51-19zm2 5 51-19 1 5zm51-19 1 5 52-16zm1 5 52-16 1 6zm52-16 1 6 53-12zm1 6 53-12v6zm53-12v6l54-8zm0 6 54-8v6zm54-8v6l54-4zm0 6 54-4v6zm54-4v6h54zm0 6h54l-1 6zm54 0-1 6 54 5zm-1 6 54 5-1 5zm54 5-1 5 54 9zm-1 5 54 9-2 5zm54 9-2 5 53 12zm-2 5 53 12-2 5zm53 12-2 5 51 17zm-2 5 51 17-2 5zm51 17-2 5 50 20zm-2 5 50 20-3 5zm50 20-3 5 49 24zm-3 5 49 24-3 5zm49 24-3 5 47 27zm-3 5 47 27-4 5zm47 27-4 5 45 31zm-4 5 45 31-4 4zm45 31-4 4 42 34zm-4 4 42 34-4 4zm42 34-4 4 39 37zm-4 4 39 37-4 4zm39 37-4 4 37 40zm-4 4 37 40-5 3zm37 40-5 3 33 43zm-5 3 33 43-4 2zm33 43-4 2 30 45zm-4 2 30 45-5 3zm30 45-5 3 26 47zm-5 3 26 47-5 2zm26 47-5 2 23 49zm-5 2 23 49-5 2zm23 49-5 2 19 51zm-5 2 19 51-5 1zm19 51-5 1 15 52zm-5 1 15 52-5 1zm15 52-5 1 11 53zm-5 1 11 53h-5zm11 53h-5l7 54zm-5 0 7 54h-5z" clip-path="url(#clipPath95)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path96" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2751 7095h5l-5 131zm5 0-5 131h5z" clip-path="url(#clipPath97)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path98" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4194 7095h5l-5 131zm5 0-5 131h5z" clip-path="url(#clipPath99)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path100" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3280 6575h390l-392 28zm390 0-392 28h394z" clip-path="url(#clipPath101)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path102" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3286 6547h378l-384 28zm378 0-384 28h390z" clip-path="url(#clipPath103)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path104" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3296 6521h358l-368 26zm358 0-368 26h378z" clip-path="url(#clipPath105)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path106" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3309 6496h332l-345 25zm332 0-345 25h358z" clip-path="url(#clipPath107)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path108" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3326 6474h298l-315 22zm298 0-315 22h332z" clip-path="url(#clipPath109)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path110" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3346 6454h258l-278 20zm258 0-278 20h298z" clip-path="url(#clipPath111)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path112" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3369 6437h212l-235 17zm212 0-235 17h258z" clip-path="url(#clipPath113)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path114" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3393 6424h164l-188 13zm164 0-188 13h212z" clip-path="url(#clipPath115)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path116" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3420 6414h110l-137 10zm110 0-137 10h164z" clip-path="url(#clipPath117)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path118" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3420 6414 27-6h56zm27-6h56l-28-2z" clip-path="url(#clipPath119)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path120" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3420 6414h110l-27-6z" clip-path="url(#clipPath121)" style="fill:#ff7f00;stroke-linecap:round;stroke-miterlimit:10;stroke:#ff7f00"/>
     <path id="path122" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3248 7226h-5l5-621zm-5 0 5-621-5-5zm5-621-5-5 459 5zm-5-5 459 5 5-5zm459 5 5-5-5 626zm5-5-5 626h5z" clip-path="url(#clipPath123)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path124" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3276 6603h5l-5 623zm5 0-5 623h5z" clip-path="url(#clipPath125)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path126" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3669 6603h6l-6 623zm6 0-6 623h6z" clip-path="url(#clipPath127)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path128" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3276 6603h5l-3-29zm5 0-3-29 5 1zm-3-29 5 1 1-29zm5 1 1-29 5 2zm1-29 5 2 5-28zm5 2 5-28 4 2zm5-28 4 2 9-27zm4 2 9-27 5 3zm9-27 5 3 12-26zm5 3 12-26 4 4zm12-26 4 4 16-24zm4 4 16-24 4 4zm16-24 4 4 19-21zm4 4 19-21 3 4zm19-21 3 4 22-18zm3 4 22-18 2 5zm22-18 2 5 25-15zm2 5 25-15 1 5zm25-15 1 5 27-11zm1 5 27-11v6zm27-11v6l28-8zm0 6 28-8v6zm28-8v6l28-4zm0 6 28-4v6zm28-4v6h28zm0 6h28l-1 5zm28 0-1 5 28 5zm-1 5 28 5-2 5zm28 5-2 5 27 9zm-2 5 27 9-3 4zm27 9-3 4 26 13zm-3 4 26 13-4 4zm26 13-4 4 24 16zm-4 4 24 16-4 4zm24 16-4 4 21 19zm-4 4 21 19-5 3zm21 19-5 3 18 22zm-5 3 18 22-4 2zm18 22-4 2 14 24zm-4 2 14 24-5 2zm14 24-5 2 11 26zm-5 2 11 26-5 1zm11 26-5 1 8 28zm-5 1 8 28h-6z" clip-path="url(#clipPath129)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path130" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2652 4142h6l-6 3087zm6 0-6 3087 6-6zm-6 3087 6-6 1640 6zm6-6 1640 6-6-6zm1640 6-6-6 6-3083zm-6-6 6-3083-6 5zm6-3083-6 5-1637-5zm-6 5-1637-5v5z" clip-path="url(#clipPath131)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path132" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3642 4269h-6l4 27zm-6 0 4 27-5-1zm4 27-5-1v27zm-5-1v27l-6-2zm0 27-6-2-4 27zm-6-2-4 27-5-3zm-4 27-5-3-9 25zm-5-3-9 25-4-3zm-9 25-4-3-13 24zm-4-3-13 24-3-4zm-13 24-3-4-17 21zm-3-4-17 21-3-4zm-17 21-3-4-19 18zm-3-4-19 18-3-4zm-19 18-3-4-22 15zm-3-4-22 15-1-5zm-22 15-1-5-24 11zm-1-5-24 11-1-5zm-24 11-1-5-26 7zm-1-5-26 7v-5zm-26 7v-5l-26 3zm0-5-26 3v-5zm-26 3v-5l-26-1zm0-5-26-1 1-5zm-26-1 1-5-26-6zm1-5-26-6 3-4zm-26-6 3-4-25-10zm3-4-25-10 3-4zm-25-10 3-4-23-13zm3-4-23-13 3-4zm-23-13 3-4-20-17zm3-4-20-17 4-3zm-20-17 4-3-18-19zm4-3-18-19 5-3zm-18-19 5-3-15-22zm5-3-15-22 6-2zm-15-22 6-2-11-24zm6-2-11-24 5-1zm-11-24 5-1-7-26zm5-1-7-26h6z" clip-path="url(#clipPath133)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path134" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3675 6603h-6l3 28zm-6 0 3 28-5-1zm3 28-5-1-1 29zm-5-1-1 29-5-2zm-1 29-5-2-5 29zm-5-2-5 29-4-3zm-5 29-4-3-9 28zm-4-3-9 28-5-3zm-9 28-5-3-12 25zm-5-3-12 25-4-3zm-12 25-4-3-16 23zm-4-3-16 23-4-4zm-16 23-4-4-19 22zm-4-4-19 22-3-5zm-19 22-3-5-22 18zm-3-5-22 18-2-5zm-22 18-2-5-25 15zm-2-5-25 15-1-5zm-25 15-1-5-27 11zm-1-5-27 11v-5zm-27 11v-5l-28 7zm0-5-28 7v-5zm-28 7v-5l-28 3zm0-5-28 3v-5zm-28 3v-5l-28-1zm0-5-28-1 1-5zm-28-1 1-5-28-5zm1-5-28-5 2-5zm-28-5 2-5-27-8zm2-5-27-8 3-5zm-27-8 3-5-26-13zm3-5-26-13 4-4zm-26-13 4-4-24-16zm4-4-24-16 4-3zm-24-16 4-3-21-19zm4-3-21-19 5-3zm-21-19 5-3-18-22zm5-3-18-22 4-3zm-18-22 4-3-14-24zm4-3-14-24 5-2zm-14-24 5-2-11-26zm5-2-11-26 5-1zm-11-26 5-1-7-27zm5-1-7-27h5z" clip-path="url(#clipPath135)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path136" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3308 7099h6l-4-27zm6 0-4-27 5 1zm-4-27 5 1v-27zm5 1v-27l6 2zm0-27 6 2 4-26zm6 2 4-26 5 2zm4-26 5 2 9-25zm5 2 9-25 4 3zm9-25 4 3 13-24zm4 3 13-24 3 4zm13-24 3 4 17-21zm3 4 17-21 3 4zm17-21 3 4 19-18zm3 4 19-18 3 5zm19-18 3 5 22-16zm3 5 22-16 1 6zm22-16 1 6 25-12zm1 6 25-12v5zm25-12v5l26-7zm0 5 26-7v5zm26-7v5l27-3zm0 5 27-3-1 5zm27-3-1 5 26 1zm-1 5 26 1-1 6zm26 1-1 6 26 5zm-1 6 26 5-3 5zm26 5-3 5 25 9zm-3 5 25 9-3 4zm25 9-3 4 23 13zm-3 4 23 13-3 4zm23 13-3 4 20 17zm-3 4 20 17-4 3zm20 17-4 3 18 20zm-4 3 18 20-5 2zm18 20-5 2 15 22zm-5 2 15 22-6 2zm15 22-6 2 11 24zm-6 2 11 24-5 1zm11 24-5 1 7 26zm-5 1 7 26h-6z" clip-path="url(#clipPath137)" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path138" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3377 4400v-8" clip-path="url(#clipPath139)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path140" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3573 4273v-8" clip-path="url(#clipPath141)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path142" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3377 7221v8" clip-path="url(#clipPath143)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path144" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3573 7221v8" clip-path="url(#clipPath145)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path9" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 2154h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path10" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path11" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path146" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 2799h86v-53h-86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path147" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 4096h86v-53h-86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path148" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 4742h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path149" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 5388h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path150" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 6034h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path151" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 6680h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path152" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 7326h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path153" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 7971h86v-53h-86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path154" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6209 2154h-86v-54h86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path155" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6209 2799h-86v-53h86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path156" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6209 4096h-86v-53h86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path157" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6209 4742h-86v-54h86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path158" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6209 5388h-86v-54h86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path159" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6209 6034h-86v-54h86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path160" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6209 6680h-86v-54h86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path161" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6209 7326h-86v-54h86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path162" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6209 7971h-86v-53h86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path163" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 1596h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path164" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5312 1596h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path165" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 7966h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path166" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 7966h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path167" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 7320h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path168" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 7320h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path169" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 6674h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path170" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 6674h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path171" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 6029h43v-44h-43v44" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path172" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 6029h43v-44h-43v44" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path173" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 5383h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path174" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 5383h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path175" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 4737h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path176" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 4737h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path177" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 4091h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path178" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 4091h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path179" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 2794h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path180" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 2794h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path181" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 2148h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path182" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path183" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 2148h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path184" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2935 2148h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path185" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4015 2148h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path186" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4661 1596h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path187" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4661 2148h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path188" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5312 1596h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path189" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5312 2148h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path190" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 8612h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path191" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path192" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path193" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 8612h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path194" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 8612h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path195" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path196" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 8612h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path197" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path198" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path199" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path200" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 8612h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path201" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 8612h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path202" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 7966h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path203" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 7966h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path204" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 7320h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path205" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 7320h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path206" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 6674h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path207" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 6674h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path208" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 6029h43v-44h-43v44" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path209" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 6029h43v-44h-43v44" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path210" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 5383h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path211" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 5383h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path212" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 4737h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path213" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 4737h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path214" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 4091h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path215" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 4091h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path216" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 2794h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path217" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 2794h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path218" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4035 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path219" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3453 9258h44v-43h-44v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path220" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2871 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path286" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 3451h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path287" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 3445h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path288" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 3445h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path290" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m763 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path292" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m763 8612h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path294" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6144 8612h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path295" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6144 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path296" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 8031h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path297" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 8031h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path298" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 8031h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path299" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m763 8031h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path300" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4661 8031h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path301" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5312 8031h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path302" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 8031h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path303" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6187 8031h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path304" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 2525h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path305" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 2148h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path306" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2935 2525h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path309" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4661 2525h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path310" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4015 2525v-43h-43v43h43-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path311" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 3445h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path312" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5312 3445h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path345" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 2148h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path357" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3453 2525h44v-43h-44v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path358" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3453 2148h44v-43h-44v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path361" transform="matrix(0 -.16 -.16 0 510.11 1402.2)" d="m26.5 0c0 14.636-11.864 26.5-26.5 26.5s-26.5-11.864-26.5-26.5 11.864-26.5 26.5-26.5 26.5 11.864 26.5 26.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path362" transform="matrix(0 -.16 -.16 0 607.39 1402.2)" d="m26.5 0c0 14.636-11.864 26.5-26.5 26.5s-26.5-11.864-26.5-26.5 11.864-26.5 26.5-26.5 26.5 11.864 26.5 26.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path365" transform="matrix(0 -.16 -.16 0 136.67 1369.9)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path366" transform="matrix(0 -.16 -.16 0 1025.8 1324.9)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path367" transform="matrix(0 -.16 -.16 0 980.83 1369.9)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path368" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 2525h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path369" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5312 2525h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path370" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1044 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path372" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m763 1877h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13729" transform="matrix(0 -.16 -.16 0 91.707 1324.9)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path221" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 3176v167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path222" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2655 3176v167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path223" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4295 3343v-167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path224" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4263 3343v-167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path225" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4231 3343v-167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path226" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4198 3343v-167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path227" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4166 3343v-167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path228" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4134 3343v-167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path229" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4101 3343v-167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12543" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4317 3343v11h-1684v-11h1684" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12544" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 3343v-167h-820v167h820" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path230" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 7971h86v-53h-86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path231" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 7326h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path232" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 6680h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path233" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 6034h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path234" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 5388h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path235" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 4742h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path236" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 4096h86v-53h-86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path237" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 2799h86v-53h-86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path238" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 2154h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path239" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 2154h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path240" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 2799h86v-53h-86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path241" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 4096h86v-53h-86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path242" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 5388h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path243" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 6034h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path244" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 6680h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path245" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 7326h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path246" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 7971h86v-53h-86v53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path247" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path248" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path249" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path250" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2871 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path275" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3453 9258h44v-43h-44v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path276" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4035 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path277" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path278" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path279" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path280" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path281" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path282" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path283" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path284" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path285" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path289" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 3451h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path291" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m763 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path293" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m763 8612h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path307" transform="matrix(0 -.16 -.16 0 475.71 1333.3)" d="m26.5 0c0 14.636-11.864 26.5-26.5 26.5s-26.5-11.864-26.5-26.5 11.864-26.5 26.5-26.5 26.5 11.864 26.5 26.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path308" transform="matrix(0 -.16 -.16 0 510.11 1333.3)" d="m26.5 0c0 14.636-11.864 26.5-26.5 26.5s-26.5-11.864-26.5-26.5 11.864-26.5 26.5-26.5 26.5 11.864 26.5 26.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path313" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6209 3451h-86v-54h86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path359" transform="matrix(0 -.16 -.16 0 641.79 1333.3)" d="m26.5 0c0 14.636-11.864 26.5-26.5 26.5s-26.5-11.864-26.5-26.5 11.864-26.5 26.5-26.5 26.5 11.864 26.5 26.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path360" transform="matrix(0 -.16 -.16 0 607.39 1333.3)" d="m26.5 0c0 14.636-11.864 26.5-26.5 26.5s-26.5-11.864-26.5-26.5 11.864-26.5 26.5-26.5 26.5 11.864 26.5 26.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path371" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1044 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path373" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m763 1877h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path374" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5863 1596h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path375" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6144 1877h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12650" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m763 8031h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12651" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 8031h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12652" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 8031h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12653" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 8031h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12654" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 8612h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12655" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6187 9258h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12656" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6187 8612h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12657" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6187 8031h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12658" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 8031h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12659" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5312 8031h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12660" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4661 8031h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12661" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4661 8612h-43v-43h43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12737" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 4742h86v-54h-86v54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path15201" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1966 9258h43v-43h-43v43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path251" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2919 9074v157" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path252" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2953 9074v157" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path253" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2987 9074v157" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path254" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3021 9074v157" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path255" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3056 9074v157" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path256" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3090 9074v157" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path257" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3124 9079v152" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path258" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3158 9113v118" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path259" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3192 9074v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path260" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3192 9154v77" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path261" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3226 9074v48" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path262" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3226 9182v49" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path263" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 9074v87" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path264" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 9216v15" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path265" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3295 9074v121" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path266" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3329 9074v155" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path267" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3363 9074v55" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path268" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3363 9171v60" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path269" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3397 9074v65" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path270" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3397 9166v65" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path271" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3432 9074v65" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path272" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3432 9166v65" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path273" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3466 9074v65" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path274" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3466 9166v49" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path392" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 7950h11v99h-11v-99" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path436" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 7950h-11v99h11v-99" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path548" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 6812h11v540h-11v-540" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path549" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 6166h11v541h-11v-541" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path5120" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 5202h11v-540h-11v540" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path5135" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 4556h11v-540h-11v540" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path5150" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 3910h11v-540h-11v540" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path5165" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 3264h11v-540h-11v540" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12365" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 2272h514v-124" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12366" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 2261h503v-113" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12407" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4502 2272h-514v-124" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12408" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4502 2261h-503v-113" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12423" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 7950h-11v99h11v-99" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12467" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 6812h-11v540h11v-540" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12468" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 6166h-11v541h11v-541" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12498" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 4556h-11v-540h11v540" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12513" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 3910h-11v-540h11v540" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12528" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 3264h-11v-540h11v540" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12833" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2173 2261h-439l-69-69" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12834" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2173 2272h-443l-76-76" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12835" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 2261h27v-113" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12836" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 2272h38v-124" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12839" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m827 2132h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12840" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m827 2121h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12841" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1654 1553v552" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12842" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1665 1553v552" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12895" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1307 1569v265" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12896" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1354 1881h147v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12898" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1501 2016v12l153 153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12899" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1296 1569v269l54 54h140v8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12900" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1490 2016v16l164 164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path12901" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1595 1580v264h59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12902" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1354 1881-47-47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12914" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1119 2121v-5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12915" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1119 2e3v-19l-131-131h-182" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12916" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1109 2121v-5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12917" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1109 2e3v-14l-125-125h-178" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12974" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m919 2121v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12975" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m919 2095v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12976" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m919 2029v-5h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12977" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m930 2121v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12978" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m930 2029v-15h-140" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13151" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m986 1947 44 44h79" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13152" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m975 1861v86h11v-84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13181" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1307 1708v7h153v41h6v-62h-6v14h-153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13182" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1466 1621h-6v-41h6v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13338" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1665 2192v-44" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13339" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1654 2181v-33" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13340" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4777 2261h439l69-69" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13341" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4777 2272h443l76-76" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13342" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 2132h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13343" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6123 2121h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13385" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5355 1580v206h-59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13397" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5831 2121v-5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13398" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5831 2e3v-19l131-131h182" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13399" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5841 2121v-5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13400" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5841 2e3v-14l125-125h178" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13401" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6031 1856v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13402" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6021 1856v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13459" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6031 2121v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13460" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6031 2095v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13461" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6031 2029v-5h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13462" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6021 2121v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13463" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6021 2029v-15h139" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13633" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5964 1947-44 44h-79" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13634" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5975 1861v86h-11v-84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13635" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 1901-40-40" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13677" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5285 2192v-44" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path13678" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5296 2181v-33" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path13679" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5296 1596v509" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13680" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5285 1596v509" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path13681" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1665 8031h-11v411h11v-411" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13682" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1665 8569h-11v-22h11v22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13695" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5285 8031h11v411h-11v-411" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13696" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5285 8569h11v-22h-11v22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13709" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 8154h11v431h-11v-431" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13713" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 7458h11v481h-11v-481" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13716" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 5307h11v60h-11v-60" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13717" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 6061h11v-59h-11v59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13721" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 6061h-11v-59h11v59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13724" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5503 8154h11v431h-11v-431" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13727" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 7939h-11v-481h11v481" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path13730" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m806 1834-43 43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path13731" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m806 1877-43-43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path13732" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2892 9214v-140h583v140" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path14322" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 8943h-59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14323" transform="matrix(0 -.16 -.16 0 362.11 155.33)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14324" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2240 8937v-212" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14383" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2103 8741v84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14384" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2103 8614v84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14385" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2082 8846h-84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14401" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 8596h-11v99h11v-99" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14414" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 8596h-11v99h11v-99" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14415" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5503 8800h11v49h-11v-49" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14428" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 8596h11v99h-11v-99" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14430" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2898 9074h577v-8h-577v8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path14441" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2076 8972v-50" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path14442" transform="matrix(0 -.16 -.16 0 335.87 157.73)" d="m0 5.5c-1.4616 0-2.8631-0.58178-3.895-1.6169" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path14443" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2078 8918 9-9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path14444" transform="matrix(0 -.16 -.16 0 335.55 161.09)" d="m0.00101-10.5c2.7904 2.7e-4 5.4658 1.1112 7.4357 3.0875" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path14445" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2090 8901v-47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path14447" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5503 2619v-275l204-225" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14448" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 2619v-271l193-213" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14449" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1428 2619v-275l-185-204" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path14450" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 2619v-271l-180-200" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path15023" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4645 8943h59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path15024" transform="matrix(0 -.16 -.16 0 755.39 155.33)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path15025" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4710 8937v-212" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path15084" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4847 8741v84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path15085" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4847 8614v84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path15086" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 8846h84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path15113" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2440 1569v11h-108v-11h108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15114" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2820 1580v-11h107v11h-107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15115" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2181 1580v-11h108v11h-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15116" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1681 1580v-11h107v11h-107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15117" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4015 1580v-11h108v11h-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15118" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 1580v-11h108v11h-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15119" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5162 1580v-11h107v11h-107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15120" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5474 1580v-11h233v11h-233" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15121" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5474 1580v-11h-108v11h108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15122" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4769 1580v-11h-108v11h108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15127" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m790 6142h-11v-108h11v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15128" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 6518h11v108h-11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15130" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m790 6787h-11v-107h11v107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15131" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 7164h11v108h-11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15133" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m790 7433h-11v-107h11v107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15134" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 7810h11v108h-11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15136" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m790 8079h-11v-108h11v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15137" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 8461h11v108h-11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15141" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m810 1838-8-8 164-163 7 8-163 163" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15142" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m763 1834-207-207" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15143" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m806 1834 259-259" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15144" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m556 1627 281-281 250 250" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15145" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m651 1715-4 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15146" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6148 1830-8 8-162-164 8-8 162 164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15147" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1476 1580v-11h-233v11h233" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15149" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 2261h11v-107h-11v107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15150" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 2638h-11v108h11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15152" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 2907h11v-108h-11v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15153" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 3289h-11v108h11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15155" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 3558h11v-107h-11v107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15156" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 3935h-11v108h11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15158" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 4204h11v-108h-11v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15159" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 4581h-11v107h11v-107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15161" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 4850h11v-108h-11v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15162" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 5227h-11v107h11v-107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15164" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 6142h11v-108h-11v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15165" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 6518h-11v108h11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15167" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 6787h11v-107h-11v107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15168" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 7164h-11v108h11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15170" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 7433h11v-107h-11v107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15171" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 7810h-11v108h11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15173" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 8079h11v-108h-11v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15174" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 8461h-11v108h11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15176" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 8719h11v-107h-11v107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15177" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 9107h-11v108h11v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15179" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m790 5980h-11v-592h11v592" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15180" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 5980h-11v-592h11v592" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15183" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m806 9241h86v-10h-86v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15184" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1114 9241h86v-10h-86v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15185" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 9128v87h11v-87h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15186" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 8612v86h11v-86h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15187" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 2154v86h11v-86h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15188" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 2660v86h11v-86h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15190" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 2799v87h11v-87h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15191" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 3305v92h11v-92h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15193" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 3451v86h11v-86h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15194" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 3957v86h11v-86h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15196" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 4096v87h11v-87h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15197" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 4602v86h11v-86h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15199" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 4742v86h11v-86h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15200" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 5248v86h11v-86h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15202" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 1580v-11h-54v11h54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15208" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1243 9241h185v-10h-185v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path15211" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5366 1580v-11h-54v11h54" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15240" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6144 9241h-86v-10h86v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15241" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5836 9241h-86v-10h86v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15247" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 9241h-185v-10h185v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path15338" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4399 3020h11v156h-11v-156" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15339" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2540 3020h11v156h-11v-156" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15342" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1347 1824h10v-11h-10v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15343" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1346 1824h12v-12h-12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15344" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1349 1821h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15345" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1348 1819h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15346" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1348 1818h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15347" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1348 1816h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15348" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1350 1814h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15349" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1348 1818 2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15350" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1348 1815 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15351" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1350 1814 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15352" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1351 1814 5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15353" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1353 1814 4 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15354" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1350 1814-2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15355" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1352 1814-4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15356" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1354 1814-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15357" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1355 1815-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15358" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1356 1816-3 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15359" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1356 1820-1 1" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15360" transform="matrix(0 -.16 -.16 0 219.07 1294.4)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15361" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1347 1678h10v-11h-10v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15362" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1346 1679h12v-12h-12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15363" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1349 1676h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15364" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1348 1674h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15365" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1348 1672h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15366" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1348 1671h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15367" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1350 1669h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15368" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1348 1672 2 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15369" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1348 1670 5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15370" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1350 1669 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15371" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1351 1668 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15372" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1353 1668 4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15373" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1350 1669-2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15374" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1352 1668-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15375" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1354 1669-5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15376" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1355 1669-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15377" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1356 1671-3 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15378" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1356 1674-1 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15379" transform="matrix(0 -.16 -.16 0 219.07 1317.6)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15380" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1633 1858h11v-11h-11v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15381" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1633 1859h12v-12h-12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15382" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1635 1856h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15383" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1634 1854h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15384" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1634 1852h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15385" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1635 1851h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15386" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1636 1849h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15387" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1634 1852 3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15388" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1635 1850 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15389" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1636 1849 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15390" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1638 1848 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15391" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1640 1848 3 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15392" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1636 1849-2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15393" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1639 1848-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15394" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1640 1849-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15395" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1642 1849-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15396" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1643 1851-4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15397" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1643 1854-1 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15398" transform="matrix(0 -.16 -.16 0 264.99 1288.8)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15399" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1279 1595h11v-10h-11v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15400" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1279 1596h12v-12h-12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15401" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1281 1593h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15402" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1281 1591h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15403" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1280 1590h10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15404" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1281 1588h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15405" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1283 1586h4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15406" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1280 1589 3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15407" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1281 1587 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15408" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1283 1586 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15409" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1284 1585 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15410" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1286 1586 3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15411" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1283 1586-3 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15412" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1285 1585-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15413" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1287 1586-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15414" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1288 1587-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15415" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1289 1588-3 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15416" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1289 1591-1 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15417" transform="matrix(0 -.16 -.16 0 208.35 1330.9)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15418" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m814 1880h10v-11h-10v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15419" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m813 1881h12v-12h-12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15420" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m816 1878h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15421" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m815 1876h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15422" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m815 1874h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15423" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m815 1873h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15424" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m817 1871h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15425" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m815 1874 2 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15426" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m815 1872 5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15427" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m817 1871 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15428" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m818 1870 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15429" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m820 1870 4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15430" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m817 1871-2 3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15431" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m819 1870-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15432" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m821 1870-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15433" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m822 1871-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15434" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m823 1873-3 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15435" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m823 1876v2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15436" transform="matrix(0 -.16 -.16 0 133.79 1285.3)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15437" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m831 2117h10v-10h-10v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15438" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m830 2118h12v-12h-12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15439" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m833 2115h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15440" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m832 2113h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15441" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m832 2112h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15442" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m832 2110h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15443" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m834 2108h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15444" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m832 2111 2 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15445" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m832 2109 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15446" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m834 2108 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15447" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m835 2107 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15448" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m837 2108 4 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15449" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m834 2108-2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15450" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m836 2107-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15451" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m838 2108-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15452" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m839 2109-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15453" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m840 2110-3 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15454" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m840 2113v2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15455" transform="matrix(0 -.16 -.16 0 136.51 1247.3)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15456" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2231 9192h10v-11h-10v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15457" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2230 9193h12v-12h-12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15458" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2233 9189h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15459" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2232 9188h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15460" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2232 9186h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15461" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2232 9184h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15462" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2234 9183h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15463" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2232 9186 2 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15464" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2232 9184 5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15465" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2234 9183 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15466" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2235 9182 5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15467" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2237 9182 4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15468" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2234 9183-2 3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15469" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2236 9182-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15470" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2238 9182-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15471" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2239 9183-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15472" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2240 9185-3 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15473" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2240 9188v2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15474" transform="matrix(0 -.16 -.16 0 360.51 115.33)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15475" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2206 9192h11v-11h-11v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15476" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2205 9192h12v-11h-12v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15477" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2208 9189h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15478" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2207 9188h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15479" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2207 9186h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15480" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2207 9184h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15481" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2209 9183h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15482" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2207 9186 3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15483" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2208 9184 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15484" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2209 9183 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15485" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2210 9182 5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15486" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2212 9182 4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15487" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2209 9183-2 3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15488" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2211 9182-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15489" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2213 9182-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15490" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2214 9183-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15491" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2216 9185-4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15492" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2216 9188-1 1" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15493" transform="matrix(0 -.16 -.16 0 356.51 115.49)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15494" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2098 9159h11v-11h-11v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15495" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2098 9159h12v-11h-12v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15496" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9156h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15497" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2099 9155h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15498" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2099 9153h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15499" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9151h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15500" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2101 9150h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15501" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2099 9153 3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15502" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9151 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15503" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2101 9150 5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15504" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2103 9149 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15505" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2105 9149 3 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15506" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2101 9150-2 3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15507" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2104 9149-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15508" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2105 9149-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15509" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 9150-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15510" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2108 9152-4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15511" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2108 9155-1 1" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15512" transform="matrix(0 -.16 -.16 0 339.39 120.77)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15513" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2099 9133h11v-11h-11v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15514" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2098 9134h12v-12h-12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15515" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2101 9131h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15516" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9129h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15517" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9127h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15518" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9125h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15519" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2102 9124h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15520" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9127 3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15521" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2101 9125 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15522" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2102 9124 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15523" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2103 9123 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15524" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2105 9123 4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15525" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2102 9124-2 3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15526" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2104 9123-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15527" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 9123-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15528" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 9124-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15529" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2108 9126-3 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15530" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2109 9129-1 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15531" transform="matrix(0 -.16 -.16 0 339.39 124.77)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15532" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2099 9053h11v-11h-11v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15533" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2098 9053h12v-12h-12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15534" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2101 9050h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15535" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9049h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15536" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9047h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15537" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9045h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15538" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2102 9043h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15539" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2100 9047 3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15540" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2101 9045 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15541" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2102 9043 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15542" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2104 9043 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15543" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 9043 3 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15544" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2102 9043-2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15545" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2104 9043-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15546" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 9043-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15547" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2108 9044-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15548" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2109 9046-4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15549" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2109 9049-1 1" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15550" transform="matrix(0 -.16 -.16 0 339.39 137.73)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15551" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2061 8973h11v-11h-11v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15552" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2061 8973h11v-12h-11v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15553" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2063 8970h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15554" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2062 8968h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15555" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2062 8967h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15556" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2063 8965h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15557" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2064 8963h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15558" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2062 8967 3 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15559" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2063 8965 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15560" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2064 8963 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15561" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2066 8963 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15562" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2068 8963 3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15563" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2064 8963-2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15564" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2067 8963-4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15565" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2068 8963-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15566" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2070 8964-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15567" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2071 8965-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15568" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2071 8969-1 1" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15569" transform="matrix(0 -.16 -.16 0 333.47 150.53)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15570" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2269 8611h11v-10h-11v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15571" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2269 8612h11v-12h-11v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15572" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271 8609h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15573" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2270 8607h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15574" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2270 8605h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15575" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271 8604h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15576" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 8602h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15577" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2270 8605 3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15578" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271 8603 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15579" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 8602 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15580" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 8601 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15581" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2276 8601 3 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15582" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 8602-2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15583" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 8601-3 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15584" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2276 8602-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15585" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 8603-5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15586" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2279 8604-4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15587" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2279 8607-1 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15588" transform="matrix(0 -.16 -.16 0 366.75 208.29)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15589" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2292 8959h11v-10h-11v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15590" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2291 8960h12v-12h-12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15591" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2294 8957h7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15592" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2293 8955h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15593" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2293 8954h9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15594" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2293 8952h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15595" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2295 8950h5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15596" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2293 8953 3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15597" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2294 8951 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15598" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2295 8950 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15599" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2296 8950 5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15600" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2298 8950 4 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15601" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2295 8950-2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15602" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2297 8949-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15603" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2299 8950-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15604" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2300 8951-4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15605" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2301 8952-3 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15606" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2302 8955-1 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15607" transform="matrix(0 -.16 -.16 0 370.27 152.61)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15608" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1466 1881h-6v-51h6v51" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15620" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5643 1569v265" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15621" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5596 1881h-147v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15622" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5654 1569v269l-54 54h-140v8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15623" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5596 1881 47-47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15652" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5643 1708v7h-153v41h-6v-62h6v14h153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15653" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5484 1621h6v-41h-6v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15768" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5603 1824h-10v-11h10v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15769" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5604 1824h-12v-12h12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15770" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5600 1814h-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15771" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 1816h-8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15772" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 1818h-9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15773" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 1819h-8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15774" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5601 1821h-7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15775" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5597 1814-3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15776" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5599 1814-5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15777" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5600 1814-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15778" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 1815-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15779" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 1818-2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15780" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5594 1820 1 1" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15781" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5594 1816 3 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15782" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5595 1815 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15783" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5596 1814 5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15784" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5598 1814 4 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15785" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5600 1814 2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15786" transform="matrix(0 -.16 -.16 0 898.43 1294.4)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15787" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5603 1678h-10v-11h10v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15788" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5604 1679h-12v-12h12v12" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15789" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5600 1669h-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15790" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 1671h-8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15791" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 1672h-9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15792" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 1674h-8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15793" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5601 1676h-7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15794" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5597 1668-3 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15795" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5599 1668-5 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15796" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5600 1669-4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15797" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 1670-5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15798" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 1672-2 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15799" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5594 1674 1 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15800" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5594 1671 3 6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15801" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5595 1669 4 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15802" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5596 1669 5 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15803" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5598 1668 4 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15804" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5600 1669 2 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15805" transform="matrix(0 -.16 -.16 0 898.43 1317.6)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15806" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5484 1881h6v-51h-6v51" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15807" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5449 2016v12l-153 153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15808" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5460 2016v16l-164 164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path15865" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 9075h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15866" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 9075v-6h118v-10h-129v16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15881" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 9231h-11v-83h11v83" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15896" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4376 9064h11v167h-11v-167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15897" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4387 9231h118v-59h-118v59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15939" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4400 9230h92v-2h-92v2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15940" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4343 8585v11h-1736v-11h1736" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15941" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4062 8921h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15942" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4062 8921v-175h572v-10h-583v185" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15943" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4575 9059v-253h-513" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15944" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4083 8833-3-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15945" transform="matrix(0 -.16 -.16 0 656.51 177.89)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15946" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4086 8790h35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15947" transform="matrix(0 -.16 -.16 0 662.11 177.89)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15948" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4126 8796-2 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15949" transform="matrix(0 -.16 -.16 0 659.23 184.29)" d="m77.916-20.233c3.4462 13.271 3.4455 27.203-0.0019 40.473" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15950" transform="matrix(0 -.16 -.16 0 659.23 184.29)" d="m82.755-21.49c3.6603 14.095 3.6596 28.892-0.0021 42.987" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15951" transform="matrix(0 -.16 -.16 0 662.43 171.49)" d="m-2.4981-0.09753c0.04301-1.1016 0.80251-2.045 1.8695-2.3222 1.067-0.27718 2.1896 0.17727 2.7634 1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15952" transform="matrix(0 -.16 -.16 0 656.03 171.49)" d="m2.1348 1.301c-0.57373 0.94137-1.6964 1.3958-2.7634 1.1186-1.067-0.27719-1.8265-1.2206-1.8695-2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15953" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4541 9022 38 3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15954" transform="matrix(0 -.16 -.16 0 735.39 142.21)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15955" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 9019v-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15956" transform="matrix(0 -.16 -.16 0 735.39 147.81)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15957" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4579 8979-38 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15958" transform="matrix(0 -.16 -.16 0 741.79 144.93)" d="m20.24 77.914c-13.273 3.4482-27.208 3.4482-40.481 0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15959" transform="matrix(0 -.16 -.16 0 741.79 144.93)" d="m21.498 82.753c-14.098 3.6623-28.897 3.6623-42.995 0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15960" transform="matrix(0 -.16 -.16 0 728.99 148.13)" d="m-1.301 2.1348c-0.94137-0.57373-1.3958-1.6964-1.1186-2.7634 0.27719-1.067 1.2206-1.8265 2.3222-1.8695" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15961" transform="matrix(0 -.16 -.16 0 728.99 141.73)" d="m0.09777-2.4981c1.1015 0.04311 2.0448 0.80264 2.322 1.8696 0.27712 1.067-0.17733 2.1895-1.1187 2.7632" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15962" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4541 8931 38 3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15963" transform="matrix(0 -.16 -.16 0 735.39 156.77)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15964" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 8928v-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15965" transform="matrix(0 -.16 -.16 0 735.39 162.37)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15966" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4579 8888-38 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15967" transform="matrix(0 -.16 -.16 0 741.79 159.49)" d="m20.24 77.914c-13.273 3.4482-27.208 3.4482-40.481 0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15968" transform="matrix(0 -.16 -.16 0 741.79 159.49)" d="m21.498 82.753c-14.098 3.6623-28.897 3.6623-42.995 0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15969" transform="matrix(0 -.16 -.16 0 728.99 162.69)" d="m-1.301 2.1348c-0.94137-0.57373-1.3958-1.6964-1.1186-2.7634 0.27719-1.067 1.2206-1.8265 2.3222-1.8695" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path15970" transform="matrix(0 -.16 -.16 0 728.99 156.29)" d="m0.09777-2.4981c1.1015 0.04311 2.0448 0.80264 2.322 1.8696 0.27712 1.067-0.17733 2.1895-1.1187 2.7632" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16038" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2434 9075h11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16039" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2434 9075v-6h-118v-10h129v16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16054" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2434 9231h11v-83h-11v83" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16055" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2574 9064h-11v167h11v-167" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16056" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2563 9231h-118v-59h118v59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16098" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2550 9230h-92v-2h92v2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16099" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2375 9059v-253h513" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16101" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2888 8921h11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16102" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2888 8921v-175h-572v-10h583v185" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16114" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4174 8833-2-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16115" transform="matrix(0 -.16 -.16 0 671.07 177.89)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16116" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4177 8790h35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16117" transform="matrix(0 -.16 -.16 0 676.67 177.89)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16118" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4217 8796-2 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16119" transform="matrix(0 -.16 -.16 0 673.79 184.29)" d="m77.916-20.233c3.4462 13.271 3.4455 27.203-0.0019 40.473" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16120" transform="matrix(0 -.16 -.16 0 673.79 184.29)" d="m82.755-21.49c3.6603 14.095 3.6596 28.892-0.0021 42.987" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16121" transform="matrix(0 -.16 -.16 0 677.15 171.49)" d="m-2.4981-0.09753c0.04301-1.1016 0.80251-2.045 1.8695-2.3222 1.067-0.27718 2.1896 0.17727 2.7634 1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16122" transform="matrix(0 -.16 -.16 0 670.59 171.49)" d="m2.1348 1.301c-0.57373 0.94137-1.6964 1.3958-2.7634 1.1186-1.067-0.27719-1.8265-1.2206-1.8695-2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16123" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4275 8833-2-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16124" transform="matrix(0 -.16 -.16 0 687.23 177.89)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16125" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4278 8790h35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16126" transform="matrix(0 -.16 -.16 0 692.83 177.89)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16127" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4319 8796-3 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16128" transform="matrix(0 -.16 -.16 0 690.11 184.29)" d="m77.916-20.233c3.4462 13.271 3.4455 27.203-0.0019 40.473" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16129" transform="matrix(0 -.16 -.16 0 690.11 184.29)" d="m82.755-21.49c3.6603 14.095 3.6596 28.892-0.0021 42.987" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16130" transform="matrix(0 -.16 -.16 0 693.31 171.49)" d="m-2.4981-0.09753c0.04301-1.1016 0.80251-2.045 1.8695-2.3222 1.067-0.27718 2.1896 0.17727 2.7634 1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16131" transform="matrix(0 -.16 -.16 0 686.91 171.49)" d="m2.1348 1.301c-0.57373 0.94137-1.6964 1.3958-2.7634 1.1186-1.067-0.27719-1.8265-1.2206-1.8695-2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16132" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4372 8833-2-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16133" transform="matrix(0 -.16 -.16 0 702.75 177.89)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16134" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4375 8790h35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16135" transform="matrix(0 -.16 -.16 0 708.35 177.89)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16136" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4415 8796-2 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16137" transform="matrix(0 -.16 -.16 0 705.47 184.29)" d="m77.916-20.233c3.4462 13.271 3.4455 27.203-0.0019 40.473" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16138" transform="matrix(0 -.16 -.16 0 705.47 184.29)" d="m82.755-21.49c3.6603 14.095 3.6596 28.892-0.0021 42.987" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16139" transform="matrix(0 -.16 -.16 0 708.83 171.49)" d="m-2.4981-0.09753c0.04301-1.1016 0.80251-2.045 1.8695-2.3222 1.067-0.27718 2.1896 0.17727 2.7634 1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16140" transform="matrix(0 -.16 -.16 0 702.27 171.49)" d="m2.1348 1.301c-0.57373 0.94137-1.6964 1.3958-2.7634 1.1186-1.067-0.27719-1.8265-1.2206-1.8695-2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16141" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4473 8833-3-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16142" transform="matrix(0 -.16 -.16 0 718.91 177.89)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16143" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4476 8790h35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16144" transform="matrix(0 -.16 -.16 0 724.51 177.89)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16145" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 8796-2 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16146" transform="matrix(0 -.16 -.16 0 721.63 184.29)" d="m77.916-20.233c3.4462 13.271 3.4455 27.203-0.0019 40.473" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16147" transform="matrix(0 -.16 -.16 0 721.63 184.29)" d="m82.755-21.49c3.6603 14.095 3.6596 28.892-0.0021 42.987" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16148" transform="matrix(0 -.16 -.16 0 724.83 171.49)" d="m-2.4981-0.09753c0.04301-1.1016 0.80251-2.045 1.8695-2.3222 1.067-0.27718 2.1896 0.17727 2.7634 1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16149" transform="matrix(0 -.16 -.16 0 718.43 171.49)" d="m2.1348 1.301c-0.57373 0.94137-1.6964 1.3958-2.7634 1.1186-1.067-0.27719-1.8265-1.2206-1.8695-2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16150" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4063 9172h313" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16151" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4107 9142-3 38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16152" transform="matrix(0 -.16 -.16 0 660.35 116.45)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16153" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4110 9185h35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16154" transform="matrix(0 -.16 -.16 0 665.95 116.45)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16155" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4150 9180-2-38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16156" transform="matrix(0 -.16 -.16 0 663.07 110.05)" d="m-77.914 20.24c-3.4482-13.273-3.4482-27.208 0-40.481" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16157" transform="matrix(0 -.16 -.16 0 663.07 110.05)" d="m-82.753 21.498c-3.6623-14.098-3.6623-28.897 0-42.995" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16158" transform="matrix(0 -.16 -.16 0 666.27 123.01)" d="m-2.1348-1.301c0.57373-0.94137 1.6964-1.3958 2.7634-1.1186 1.067 0.27719 1.8265 1.2206 1.8695 2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16159" transform="matrix(0 -.16 -.16 0 659.87 123.01)" d="m2.4981 0.09753c-0.04301 1.1016-0.80251 2.045-1.8695 2.3222-1.067 0.27718-2.1896-0.17727-2.7634-1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16160" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4195 9142-2 38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16161" transform="matrix(0 -.16 -.16 0 674.43 116.45)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16162" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4198 9185h35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16163" transform="matrix(0 -.16 -.16 0 680.03 116.45)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16164" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4238 9180-2-38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16165" transform="matrix(0 -.16 -.16 0 677.15 110.05)" d="m-77.914 20.24c-3.4482-13.273-3.4482-27.208 0-40.481" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16166" transform="matrix(0 -.16 -.16 0 677.15 110.05)" d="m-82.753 21.498c-3.6623-14.098-3.6623-28.897 0-42.995" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16167" transform="matrix(0 -.16 -.16 0 680.51 123.01)" d="m-2.1348-1.301c0.57373-0.94137 1.6964-1.3958 2.7634-1.1186 1.067 0.27719 1.8265 1.2206 1.8695 2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16168" transform="matrix(0 -.16 -.16 0 673.95 123.01)" d="m2.4981 0.09753c-0.04301 1.1016-0.80251 2.045-1.8695 2.3222-1.067 0.27718-2.1896-0.17727-2.7634-1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16169" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4287 9142-3 38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16170" transform="matrix(0 -.16 -.16 0 689.15 116.45)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16171" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4290 9185h35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16172" transform="matrix(0 -.16 -.16 0 694.75 116.45)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16173" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4330 9180-2-38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16174" transform="matrix(0 -.16 -.16 0 691.87 110.05)" d="m-77.914 20.24c-3.4482-13.273-3.4482-27.208 0-40.481" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16175" transform="matrix(0 -.16 -.16 0 691.87 110.05)" d="m-82.753 21.498c-3.6623-14.098-3.6623-28.897 0-42.995" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16176" transform="matrix(0 -.16 -.16 0 695.07 123.01)" d="m-2.1348-1.301c0.57373-0.94137 1.6964-1.3958 2.7634-1.1186 1.067 0.27719 1.8265 1.2206 1.8695 2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16177" transform="matrix(0 -.16 -.16 0 688.67 123.01)" d="m2.4981 0.09753c-0.04301 1.1016-0.80251 2.045-1.8695 2.3222-1.067 0.27718-2.1896-0.17727-2.7634-1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16178" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2887 9172h-313" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16179" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2841 9143 3 38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16180" transform="matrix(0 -.16 -.16 0 456.83 116.29)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16181" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 9186h-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16182" transform="matrix(0 -.16 -.16 0 451.23 116.29)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16183" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2798 9181 2-38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16184" transform="matrix(0 -.16 -.16 0 454.11 109.89)" d="m-77.914 20.24c-3.4482-13.273-3.4482-27.208 0-40.481" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16185" transform="matrix(0 -.16 -.16 0 454.11 109.89)" d="m-82.753 21.498c-3.6623-14.098-3.6623-28.897 0-42.995" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16186" transform="matrix(0 -.16 -.16 0 450.91 122.85)" d="m2.4981 0.09753c-0.04301 1.1016-0.80251 2.045-1.8695 2.3222-1.067 0.27718-2.1896-0.17727-2.7634-1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16187" transform="matrix(0 -.16 -.16 0 457.31 122.85)" d="m-2.1348-1.301c0.57373-0.94137 1.6964-1.3958 2.7634-1.1186 1.067 0.27719 1.8265 1.2206 1.8695 2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16188" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2753 9143 2 38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16189" transform="matrix(0 -.16 -.16 0 442.75 116.29)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16190" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2750 9186h-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16191" transform="matrix(0 -.16 -.16 0 437.15 116.29)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16192" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2710 9181 2-38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16193" transform="matrix(0 -.16 -.16 0 440.03 109.89)" d="m-77.914 20.24c-3.4482-13.273-3.4482-27.208 0-40.481" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16194" transform="matrix(0 -.16 -.16 0 440.03 109.89)" d="m-82.753 21.498c-3.6623-14.098-3.6623-28.897 0-42.995" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16195" transform="matrix(0 -.16 -.16 0 436.83 122.85)" d="m2.4981 0.09753c-0.04301 1.1016-0.80251 2.045-1.8695 2.3222-1.067 0.27718-2.1896-0.17727-2.7634-1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16196" transform="matrix(0 -.16 -.16 0 443.23 122.85)" d="m-2.1348-1.301c0.57373-0.94137 1.6964-1.3958 2.7634-1.1186 1.067 0.27719 1.8265 1.2206 1.8695 2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16197" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2661 9143 3 38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16198" transform="matrix(0 -.16 -.16 0 428.03 116.29)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16199" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2658 9186h-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16200" transform="matrix(0 -.16 -.16 0 422.43 116.29)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16201" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2618 9181 2-38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16202" transform="matrix(0 -.16 -.16 0 425.31 109.89)" d="m-77.914 20.24c-3.4482-13.273-3.4482-27.208 0-40.481" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16203" transform="matrix(0 -.16 -.16 0 425.31 109.89)" d="m-82.753 21.498c-3.6623-14.098-3.6623-28.897 0-42.995" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16204" transform="matrix(0 -.16 -.16 0 422.11 122.85)" d="m2.4981 0.09753c-0.04301 1.1016-0.80251 2.045-1.8695 2.3222-1.067 0.27718-2.1896-0.17727-2.7634-1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16205" transform="matrix(0 -.16 -.16 0 428.51 122.85)" d="m-2.1348-1.301c0.57373-0.94137 1.6964-1.3958 2.7634-1.1186 1.067 0.27719 1.8265 1.2206 1.8695 2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16206" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3529 9108v27h89v32h-89v26l-45-42 45-43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16207" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2867 8833 3-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16208" transform="matrix(0 -.16 -.16 0 460.99 177.89)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16209" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2864 8790h-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16210" transform="matrix(0 -.16 -.16 0 455.39 177.89)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16211" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2824 8796 2 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16212" transform="matrix(0 -.16 -.16 0 458.27 184.29)" d="m77.916-20.233c3.4462 13.271 3.4455 27.203-0.0019 40.473" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16213" transform="matrix(0 -.16 -.16 0 458.27 184.29)" d="m82.755-21.49c3.6603 14.095 3.6596 28.892-0.0021 42.987" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16214" transform="matrix(0 -.16 -.16 0 455.07 171.49)" d="m2.1348 1.301c-0.57373 0.94137-1.6964 1.3958-2.7634 1.1186-1.067-0.27719-1.8265-1.2206-1.8695-2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16215" transform="matrix(0 -.16 -.16 0 461.47 171.49)" d="m-2.4981-0.09753c0.04301-1.1016 0.80251-2.045 1.8695-2.3222 1.067-0.27718 2.1896 0.17727 2.7634 1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16216" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2409 9022-38 3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16217" transform="matrix(0 -.16 -.16 0 382.11 142.21)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16218" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2366 9019v-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16219" transform="matrix(0 -.16 -.16 0 382.11 147.81)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16220" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2371 8979 38 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16221" transform="matrix(0 -.16 -.16 0 375.71 144.93)" d="m-20.24-77.914c13.273-3.4482 27.208-3.4482 40.481 0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16222" transform="matrix(0 -.16 -.16 0 375.71 144.93)" d="m-21.498-82.753c14.098-3.6623 28.897-3.6623 42.995 0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16223" transform="matrix(0 -.16 -.16 0 388.51 148.13)" d="m-0.09753 2.4981c-1.1016-0.04301-2.045-0.80251-2.3222-1.8695-0.27718-1.067 0.17727-2.1896 1.1186-2.7634" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16224" transform="matrix(0 -.16 -.16 0 388.51 141.73)" d="m1.3013-2.1346c0.94128 0.57379 1.3956 1.6964 1.1184 2.7634-0.27723 1.067-1.2206 1.8264-2.3221 1.8694" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16225" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2409 8931-38 3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16226" transform="matrix(0 -.16 -.16 0 382.11 156.77)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16227" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2366 8928v-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16228" transform="matrix(0 -.16 -.16 0 382.11 162.37)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16229" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2371 8888 38 2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16230" transform="matrix(0 -.16 -.16 0 375.71 159.49)" d="m-20.24-77.914c13.273-3.4482 27.208-3.4482 40.481 0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16231" transform="matrix(0 -.16 -.16 0 375.71 159.49)" d="m-21.498-82.753c14.098-3.6623 28.897-3.6623 42.995 0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16232" transform="matrix(0 -.16 -.16 0 388.51 162.69)" d="m-0.09753 2.4981c-1.1016-0.04301-2.045-0.80251-2.3222-1.8695-0.27718-1.067 0.17727-2.1896 1.1186-2.7634" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16233" transform="matrix(0 -.16 -.16 0 388.51 156.29)" d="m1.3013-2.1346c0.94128 0.57379 1.3956 1.6964 1.1184 2.7634-0.27723 1.067-1.2206 1.8264-2.3221 1.8694" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16234" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2776 8833 2-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16235" transform="matrix(0 -.16 -.16 0 446.43 177.89)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16236" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2773 8790h-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16237" transform="matrix(0 -.16 -.16 0 440.83 177.89)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16238" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2733 8796 2 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16239" transform="matrix(0 -.16 -.16 0 443.71 184.29)" d="m77.916-20.233c3.4462 13.271 3.4455 27.203-0.0019 40.473" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16240" transform="matrix(0 -.16 -.16 0 443.71 184.29)" d="m82.755-21.49c3.6603 14.095 3.6596 28.892-0.0021 42.987" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16241" transform="matrix(0 -.16 -.16 0 440.35 171.49)" d="m2.1348 1.301c-0.57373 0.94137-1.6964 1.3958-2.7634 1.1186-1.067-0.27719-1.8265-1.2206-1.8695-2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16242" transform="matrix(0 -.16 -.16 0 446.91 171.49)" d="m-2.4981-0.09753c0.04301-1.1016 0.80251-2.045 1.8695-2.3222 1.067-0.27718 2.1896 0.17727 2.7634 1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16243" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2675 8833 2-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16244" transform="matrix(0 -.16 -.16 0 430.27 177.89)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16245" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2672 8790h-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16246" transform="matrix(0 -.16 -.16 0 424.67 177.89)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16247" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2631 8796 3 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16248" transform="matrix(0 -.16 -.16 0 427.39 184.29)" d="m77.916-20.233c3.4462 13.271 3.4455 27.203-0.0019 40.473" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16249" transform="matrix(0 -.16 -.16 0 427.39 184.29)" d="m82.755-21.49c3.6603 14.095 3.6596 28.892-0.0021 42.987" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16250" transform="matrix(0 -.16 -.16 0 424.19 171.49)" d="m2.1348 1.301c-0.57373 0.94137-1.6964 1.3958-2.7634 1.1186-1.067-0.27719-1.8265-1.2206-1.8695-2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16251" transform="matrix(0 -.16 -.16 0 430.59 171.49)" d="m-2.4981-0.09753c0.04301-1.1016 0.80251-2.045 1.8695-2.3222 1.067-0.27718 2.1896 0.17727 2.7634 1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16252" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2578 8833 2-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16253" transform="matrix(0 -.16 -.16 0 414.75 177.89)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16254" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2575 8790h-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16255" transform="matrix(0 -.16 -.16 0 409.15 177.89)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16256" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2535 8796 2 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16257" transform="matrix(0 -.16 -.16 0 412.03 184.29)" d="m77.916-20.233c3.4462 13.271 3.4455 27.203-0.0019 40.473" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16258" transform="matrix(0 -.16 -.16 0 412.03 184.29)" d="m82.755-21.49c3.6603 14.095 3.6596 28.892-0.0021 42.987" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16259" transform="matrix(0 -.16 -.16 0 408.83 171.49)" d="m2.1348 1.301c-0.57373 0.94137-1.6964 1.3958-2.7634 1.1186-1.067-0.27719-1.8265-1.2206-1.8695-2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16260" transform="matrix(0 -.16 -.16 0 415.23 171.49)" d="m-2.4981-0.09753c0.04301-1.1016 0.80251-2.045 1.8695-2.3222 1.067-0.27718 2.1896 0.17727 2.7634 1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16261" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2477 8833 3-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16262" transform="matrix(0 -.16 -.16 0 398.59 177.89)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16263" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2474 8790h-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16264" transform="matrix(0 -.16 -.16 0 392.99 177.89)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16265" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2434 8796 2 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16266" transform="matrix(0 -.16 -.16 0 395.87 184.29)" d="m77.916-20.233c3.4462 13.271 3.4455 27.203-0.0019 40.473" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16267" transform="matrix(0 -.16 -.16 0 395.87 184.29)" d="m82.755-21.49c3.6603 14.095 3.6596 28.892-0.0021 42.987" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16268" transform="matrix(0 -.16 -.16 0 392.67 171.49)" d="m2.1348 1.301c-0.57373 0.94137-1.6964 1.3958-2.7634 1.1186-1.067-0.27719-1.8265-1.2206-1.8695-2.3222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16269" transform="matrix(0 -.16 -.16 0 399.07 171.49)" d="m-2.4981-0.09753c0.04301-1.1016 0.80251-2.045 1.8695-2.3222 1.067-0.27718 2.1896 0.17727 2.7634 1.1186" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16270" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4522 7631h13v-44h32v44h13l-29 45-29-45" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16271" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4374 7549h13v-45h32v45h13l-29 44-29-44" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16272" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2428 7631h-13v-44h-32v44h-13l29 45 29-45" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16273" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2576 7549h-13v-45h-32v45h-13l29 44 29-44" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16274" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3060 9108v27h-89v32h89v26l44-42-44-43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16275" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5296 8838h218" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path16276" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5296 8849h218" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path16277" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1654 8838h-240" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path16278" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1654 8852h-240" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path16279" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1428 8695v5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16280" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1428 8795v57" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path16281" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1414 8695v9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16282" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1414 8796v56" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
     <path id="path16283" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1988 9235v23" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16284" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2311 9235v45" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16285" transform="matrix(0 -.16 -.16 0 554.91 1357.1)" d="m44.5 0c0 24.577-19.923 44.5-44.5 44.5s-44.5-19.923-44.5-44.5 19.923-44.5 44.5-44.5 44.5 19.923 44.5 44.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
     <path id="path16291" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 7944h-87" clip-path="url(#clipPath16292)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16293" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 7299h-87" clip-path="url(#clipPath16294)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16304" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 7299h-87" clip-path="url(#clipPath16305)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16306" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 6653h-87" clip-path="url(#clipPath16307)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16317" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 6653h-88" clip-path="url(#clipPath16318)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16319" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 6007h-88" clip-path="url(#clipPath16320)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16330" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 5361h-85" clip-path="url(#clipPath16331)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16332" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 4716h-85" clip-path="url(#clipPath16333)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16343" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 4716h-85" clip-path="url(#clipPath16344)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16345" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 4070h-85" clip-path="url(#clipPath16346)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16356" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 4070h-85" clip-path="url(#clipPath16357)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16358" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m740 3424h-85" clip-path="url(#clipPath16359)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <text id="text16368" transform="matrix(.16 0 0 .16 306.67 1291.6)" clip-path="url(#clipPath16369)" xml:space="preserve"><tspan id="tspan16368" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">69</tspan></text>
     <text id="text16369" transform="matrix(.16 0 0 .16 408.59 1289.2)" clip-path="url(#clipPath16370)" xml:space="preserve"><tspan id="tspan16369" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">70</tspan></text>
     <text id="text16370" transform="matrix(.16 0 0 .16 680.75 1288.9)" clip-path="url(#clipPath16371)" xml:space="preserve"><tspan id="tspan16370" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">71</tspan></text>
     <text id="text16371" transform="matrix(.16 0 0 .16 789.39 1290.9)" clip-path="url(#clipPath16372)" xml:space="preserve"><tspan id="tspan16371" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">72</tspan></text>
     <text id="text16372" transform="matrix(.16 0 0 .16 924.75 1196.9)" clip-path="url(#clipPath16373)" xml:space="preserve"><tspan id="tspan16372" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">73</tspan></text>
     <text id="text16373" transform="matrix(.16 0 0 .16 926.19 1091.9)" clip-path="url(#clipPath16374)" xml:space="preserve"><tspan id="tspan16373" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">74</tspan></text>
     <text id="text16374" transform="matrix(.16 0 0 .16 925.55 989.33)" clip-path="url(#clipPath16375)" xml:space="preserve"><tspan id="tspan16374" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">75</tspan></text>
     <text id="text16375" transform="matrix(.16 0 0 .16 914.67 791.57)" clip-path="url(#clipPath16376)" xml:space="preserve"><tspan id="tspan16375" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">77</tspan></text>
     <text id="text16376" transform="matrix(.16 0 0 .16 921.39 888.21)" clip-path="url(#clipPath16377)" xml:space="preserve"><tspan id="tspan16376" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">76</tspan></text>
     <text id="text16377" transform="matrix(.16 0 0 .16 918.67 582.13)" clip-path="url(#clipPath16378)" xml:space="preserve"><tspan id="tspan16377" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">78</tspan></text>
     <text id="text16378" transform="matrix(.16 0 0 .16 921.87 477.01)" clip-path="url(#clipPath16379)" xml:space="preserve"><tspan id="tspan16378" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">79</tspan></text>
     <text id="text16379" transform="matrix(.16 0 0 .16 922.99 374.29)" clip-path="url(#clipPath16380)" xml:space="preserve"><tspan id="tspan16379" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">80</tspan></text>
     <text id="text16380" transform="matrix(.16 0 0 .16 920.43 261.81)" clip-path="url(#clipPath16381)" xml:space="preserve"><tspan id="tspan16380" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">81</tspan></text>
     <text id="text16381" transform="matrix(.16 0 0 .16 916.11 162.29)" clip-path="url(#clipPath16382)" xml:space="preserve"><tspan id="tspan16381" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">82</tspan></text>
     <text id="text16382" transform="matrix(.16 0 0 .16 161.39 267.57)" clip-path="url(#clipPath16383)" xml:space="preserve"><tspan id="tspan16382" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">92</tspan></text>
     <text id="text16383" transform="matrix(.16 0 0 .16 172.43 163.41)" clip-path="url(#clipPath16384)" xml:space="preserve"><tspan id="tspan16383" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">93</tspan></text>
     <text id="text16384" transform="matrix(.16 0 0 .16 164.59 370.29)" clip-path="url(#clipPath16385)" xml:space="preserve"><tspan id="tspan16384" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">91</tspan></text>
     <text id="text16385" transform="matrix(.16 0 0 .16 168.11 477.81)" clip-path="url(#clipPath16386)" xml:space="preserve"><tspan id="tspan16385" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">90</tspan></text>
     <text id="text16386" transform="matrix(.16 0 0 .16 165.39 583.57)" clip-path="url(#clipPath16387)" xml:space="preserve"><tspan id="tspan16386" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">89</tspan></text>
     <text id="text16387" transform="matrix(.16 0 0 .16 167.15 786.77)" clip-path="url(#clipPath16388)" xml:space="preserve"><tspan id="tspan16387" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">88</tspan></text>
     <text id="text16388" transform="matrix(.16 0 0 .16 166.19 892.85)" clip-path="url(#clipPath16389)" xml:space="preserve"><tspan id="tspan16388" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">87</tspan></text>
     <text id="text16389" transform="matrix(.16 0 0 .16 168.91 996.37)" clip-path="url(#clipPath16390)" xml:space="preserve"><tspan id="tspan16389" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">86</tspan></text>
     <text id="text16390" transform="matrix(.16 0 0 .16 164.59 1095.1)" clip-path="url(#clipPath16391)" xml:space="preserve"><tspan id="tspan16390" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">85</tspan></text>
     <text id="text16391" transform="matrix(.16 0 0 .16 164.27 1193.2)" clip-path="url(#clipPath16392)" xml:space="preserve"><tspan id="tspan16391" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">84</tspan></text>
     <text id="text16392" transform="matrix(.16 0 0 .16 784.43 269.17)" clip-path="url(#clipPath16393)" xml:space="preserve"><tspan id="tspan16392" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">83</tspan></text>
     <text id="text16393" transform="matrix(.16 0 0 .16 307.63 268.37)" clip-path="url(#clipPath16394)" xml:space="preserve"><tspan id="tspan16393" x="0 89.676003" y="0" style="fill:#000000;font-family:Verdana;font-size:141px">94</tspan></text>
     <path id="path16478" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 3424h-84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16479" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 2779h-84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16484" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 2773h-84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path16485" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m741 2127h-84" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
     <path id="path314" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 3120v304" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path315" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2020 3029v395" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path316" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 2841v73" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path317" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 2937v487" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path318" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1837 2750v674" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path319" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1745 2658v766" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path321" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 3047h-929" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path322" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2956h-1203" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path323" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2864h-1292" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path324" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2773h-1387" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path325" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2070 2773h-73" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path326" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2681h-1570" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path327" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2590h-1661" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path332" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332 3402h-156" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path333" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 3370h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path334" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 3338h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path335" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 3305h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path336" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 3273h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path337" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 3241h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path338" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 3208h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path339" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332 3402v-194" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path340" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 3402v-194h16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path341" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 2841 69-68" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path342" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1837 2750 68-69" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path343" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1745 2658 69-68" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path355" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2773h1387" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path356" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 2773h73" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path863" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2203 3424v4526" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path864" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 3424v2088" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path865" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 5856v2094" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path866" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2020 3424v2088" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path867" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2020 5856v2094" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path868" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 3424v2088" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path869" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 5856v2094" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path870" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1837 3424v2088" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path871" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1837 5856v2094" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path872" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1745 3424v2088" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path873" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1745 5856v2094" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path874" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1665 5846h446" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path875" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1665 5856h446" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path876" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2203 4562h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path877" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 4562h33v-108h-33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path878" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2020 4562h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path879" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 4562h33v-108h-33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path880" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1837 4562h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path881" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2203 6806h32v108h-32v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path882" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 6806h33v108h-33v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path883" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2020 6806h32v108h-32v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path884" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 6806h33v108h-33v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path885" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1837 6806h32v108h-32v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path886" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 5512v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path887" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 5846v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path888" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2203 5512h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path889" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 5512h33v-108h-33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path890" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2020 5512h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path891" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 5512h33v-108h-33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path892" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1837 5512h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path893" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2203 5964h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path894" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 5964h33v-108h-33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path895" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2020 5964h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path896" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 5964h33v-108h-33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path897" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1837 5964h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path898" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2203 7858h32v92h-32v-92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path899" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 7858h33v92h-33v-92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path900" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2020 7858h32v92h-32v-92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path901" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 7858h33v92h-33v-92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path902" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1837 7858h32v92h-32v-92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4125" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 7955h-6l6-4553zm-6 0 6-4553h-6z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path4139" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1665 5523h446" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4140" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1665 5512h446" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5193" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2203 3627h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5194" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 3627h33v-108h-33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5195" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2020 3627h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5196" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1928 3627h33v-108h-33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5197" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1837 3627h32v-108h-32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5198" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2902 3047v32h108v-32h-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5199" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2902 2956v32h108v-32h-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5200" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2902 2864v32h108v-32h-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5201" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2902 2773v32h108v-32h-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5202" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2902 2681v32h108v-32h-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6634" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 2841v73" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6635" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 2937v487" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6636" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 2750v674" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6637" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5205 2658v766" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6638" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 3047h929" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6639" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2956h1203" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6640" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2864h1292" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6641" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2773h1387" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6642" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2681h1570" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6643" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2590h1661" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6644" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3402h140" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6645" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3370h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6646" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3338h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6647" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3305h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6648" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3273h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6649" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3241h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6650" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 3208h145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6651" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 2841-69-68" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6652" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 2750-68-69" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6653" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5205 2658-69-68" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6846" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4048 3047v32h-108v-32h108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6847" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4048 2956v32h-108v-32h108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6848" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4048 2864v32h-108v-32h108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6849" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4048 2773v32h-108v-32h108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6850" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4048 2681v32h-108v-32h108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8272" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 3120v304" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8273" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 3029v395" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8274" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 2937v487" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8275" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 2750v674" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8276" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5205 2658v766" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8283" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 3424v4526" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8284" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 3424v2088" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8285" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 5856v2094" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8286" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 3424v2088" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8287" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 5856v2094" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8288" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 3424v2088" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8289" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 5856v2094" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8290" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 3424v2088" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8291" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5856v2094" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8292" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5205 3424v2088" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8293" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5205 5856v2094" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8294" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 4562h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8295" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 4562h-33v-108h33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8296" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 4562h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8297" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 4562h-33v-108h33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8298" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 4562h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8299" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 6806h-32v108h32v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8300" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 6806h-33v108h33v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8301" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6806h-32v108h32v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8302" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 6806h-33v108h33v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8303" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6806h-32v108h32v-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8304" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 5512h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8305" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 5512h-33v-108h33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8306" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 5512h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8307" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 5512h-33v-108h33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8308" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5512h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8309" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 5964h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8310" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 5964h-33v-108h33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8311" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 5964h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8312" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 5964h-33v-108h33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8313" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5964h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path11532" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4621 7955h-6l6-4553zm-6 0 6-4553h-6z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
     <path id="path12306" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 3627h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12307" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 3627h-33v-108h33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12308" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 3627h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12309" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 3627h-33v-108h33v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12310" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 3627h-32v-108h32v108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12311" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 5523v2427" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12317" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1936 2945h-8v108h33v-83" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12318" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2020 3029v107h32v-75" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12319" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 3120v92h33v-59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12320" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1844 2742 23 23 61-61-23-23-61 61" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12330" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2101 2780v-7h107v32h-83" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12331" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2185 2864h107v32h-75" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12332" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2276 2956h92v32h-60" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12333" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5014 2945h8v108h-33v-83" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12334" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 3029v107h-32v-75" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12335" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 3120v92h-33v-59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12336" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 2742-23 23-61-61 23-23 61 61" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12337" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4849 2780v-7h-107v32h83" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12338" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 2864h-107v32h75" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12339" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4674 2956h-92v32h60" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12662" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 7858h-32v92h32v-92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12663" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 7858h-33v92h33v-92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12664" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 7858h-32v92h32v-92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12665" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5022 7858h-33v92h33v-92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12666" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 7858h-32v92h32v-92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12667" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 4074h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12669" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4639 3402h135" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12670" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3370h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12671" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3338h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12672" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3305h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12673" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3273h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12674" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 4074h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12675" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3208h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12731" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5285 5846h-446" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12732" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5285 5856h-446" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12733" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 5512v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12734" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4839 5846v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12735" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5285 5523h-446" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12736" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5285 5512h-446" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12738" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 3402v-194" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12739" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3402v-194" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12740" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 3208h145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12741" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 3402h140" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path320" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1681 3402h-11v-608h11v608" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path328" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1670 2514h619v11h-608" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path329" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2935 2514v11h-603v-11h603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path330" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1681 2525v226h-11v-237" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path331" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2514v11h-497v-11h497" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path344" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1681 4048h-11v-603h11v603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path346" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2546 3176h929" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path347" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2546 3160h929" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path348" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2187 3175h129v227" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path349" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2187 3208h145v194h-145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path350" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2187 3370h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path351" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2187 3338h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path352" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2187 3305h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path353" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2187 3273h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path354" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2187 3241h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path376" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 8585v11h-394v-11h394" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path389" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1428 8596h-185v-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path390" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 8596v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path391" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1243 8585h185v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path394" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2871 9231v10h-539v-10h539" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path395" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3453 9231v10h-539v-10h539" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path396" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1654 8838h11v377h-11v-377" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path397" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2289 8585v11h-608v-11h608" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path398" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 8031v538" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path399" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 8031v538" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path400" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m790 7988v-17" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path401" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 7988v-17" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path402" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1977 9064h-151" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path403" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1815 9064h-150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path404" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1826 9075h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path405" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1815 9032h-150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path406" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1815 8999h-150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path407" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1815 8967h-150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path408" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1815 8935h-150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path409" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1815 8902h-150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path410" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1815 8870h-150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path411" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1810 8838h-145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path412" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1815 9075v-234" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path413" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1826 9075v-183" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path414" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1826 8892 60 60-13 29 57-27-13 29 60 60" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path415" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1966 9032h-140" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path416" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1933 8999h-107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path417" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1924 8967h-22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path418" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1879 8967h-53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path419" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1869 8935h-43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path420" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1836 8902h-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path421" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2892 9230v-156h226" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path422" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3118 9074 63 62-13 29 57-27-13 29 63 63" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path423" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 8585v11h394v-11h-394" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path437" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4078 9231v10h540v-10h-540" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path438" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5296 8838h-11v377h11v-377" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path439" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4661 8585v11h608v-11h-608" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path440" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4645 8031v538" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path441" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 8031v538" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path442" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4973 9064h151" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path443" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5135 9064h150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path444" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 9075h11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path445" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5135 9032h150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path446" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5135 8999h150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path447" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5135 8967h150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path448" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5135 8935h150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path449" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5135 8902h150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path450" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5135 8870h150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path451" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5135 9075v-237h150" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path452" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 9075v-183" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path453" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 8892-60 60 13 29-57-27 13 29-60 60" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path454" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4984 9032h140" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path455" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5017 8999h107" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path456" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5026 8967h22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path457" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5071 8967h53" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path458" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5081 8935h43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path459" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5114 8902h10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path460" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3497 9231v10h538v-10h-538" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path461" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332 7681h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path462" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332 7713h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path463" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332 7745h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path464" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332 7778h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path465" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332 7648h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path466" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332 7616h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path467" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2633 7724h-161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path468" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2633 7756h-161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path469" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 7692h161-161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path470" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2633 7659h-161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path471" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2633 7627h-161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path472" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2633 7595h-161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path473" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2633 7562h-161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path474" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 7724v11h-842v-11h842" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path475" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 7778v-178" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path476" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 7778v-178h11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path477" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2633 7562v194" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path478" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 7600v-38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path479" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 7778v161h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path480" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 7778v172h-140" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path481" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 7681h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path482" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 7713h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path483" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 7745h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path484" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 7778h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path485" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 7648h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path486" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 7616h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path487" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4317 7724h161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path488" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4317 7756h161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path489" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4478 7692h-161 161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path490" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4317 7659h161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path491" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4317 7627h161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path492" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4317 7595h161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path493" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4317 7562h161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path494" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 7724v11h842v-11h-842" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path495" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4478 7778v-178" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path496" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7778v-178h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path497" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4317 7562v194" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path498" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4478 7600v-38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path499" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7778v161h129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path500" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4478 7778v172h140" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path501" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 7988v-22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path502" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 7988v-22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path503" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4645 7988v-22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path504" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 7988v-22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path517" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 7939v11h-373v-11h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path518" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 7293v11h-373v-11h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path519" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 7293v11h-174v-11h174" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path544" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 6647v11h-373v-11h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path545" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 6647v11h-174v-11h174" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path546" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 6002v10h-373v-10h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path547" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 5356v11h-373v-11h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4126" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1670 7320h11v603h-11v-603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4127" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1670 6674h11v603h-11v-603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4128" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1670 6029h11v602h-11v-602" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4129" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1681 5985h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4130" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1681 5985v-129h430v-10h-441v139" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4131" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1681 4694h-11v-603h11v603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4132" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1681 5340h-11v-603h11v603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4133" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1670 5383h11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4134" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1670 5383v140h441v-11h-430v-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4135" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1800 5785h11v61h-11v-61" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4136" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1800 5523h11v60h-11v-60" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4137" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 7955v11h-654v-11h654" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4141" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 4710v11h-373v-11h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path4142" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 4710v11h-174v-11h174" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5121" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 4064v11h-373v-11h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5122" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 4064v11h-174v-11h174" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5136" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 3418v11h-373v-11h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5137" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 3418v11h-174v-11h174" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5151" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1200 2773v10h-373v-10h373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5152" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 2773v10h-174v-10h174" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5178" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m790 2100v-223" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5179" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m779 2100v-223" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5180" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m770 1834-210-210" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5181" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m763 1842-211-211" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5182" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m572 1618 256-255" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5183" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m565 1611 255-256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5184" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m846 1363 90 90" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5185" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m854 1355 90 90" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5186" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m833 1350 211 211" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5187" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m841 1342 210 211" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5188" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1087 1580h113" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5189" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1087 1569h113" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5190" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2187 3402v-222l-255-254 150-150 249 255h215" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5191" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2176 3402v-217l-259-259 165-165 254 259h210v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path5192" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2203 3424-16-22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6654" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4404 3176h-929" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6655" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4404 3160h-929" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6656" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3175h-129v227" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6657" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3208h-145v194h145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6658" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3370h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6659" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3338h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6660" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3305h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6661" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3273h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6662" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3241h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6843" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3402v-222l255-254-150-150-249 255h-215" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6844" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4774 3402v-217l259-259-165-165-254 259h-210" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path6845" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 3424 16-22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8277" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 3402h11v-608h-11v608" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8278" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5280 2514h-619v11h608" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8279" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4015 2514v11h603v-11h-603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8280" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 2525v226h11v-237" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8281" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3475 2514v11h497v-11h-497" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path8282" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 4048h11v-603h-11v603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path11533" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5280 6029h-11v602h11v-602" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path11534" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 5985h11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path11535" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 5985v-129h-430v-10h441v139" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path11536" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 4694h11v-603h-11v603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path11537" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5269 5340h11v-603h-11v603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path11538" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5280 5383h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path11539" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5280 5383v140h-441v-11h430v-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path11540" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4615 7955v11h654v-11h-654" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12312" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5150 5523h-11v60h11v-60" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12314" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5150 5785h-11v61h11v-61" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12315" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5280 7320h-11v603h11v-603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12316" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5280 6674h-11v603h11v-603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12349" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 2105v-509" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12350" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 2105v-509" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12363" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 2272h27" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12364" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 2261h27" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12367" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2962 2105v-504" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12368" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2951 2105v-504" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12369" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6180 1834 210-210" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12370" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6187 1842 211-211" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12371" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6378 1618-256-255" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12372" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6385 1611-255-256" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12373" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6117 1350-211 211" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12374" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6109 1342-210 211" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12375" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5863 1580h-113" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12376" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5863 1569h-113" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12389" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4672 2272h-38v-124" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12390" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4672 2261h-27v-113" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12391" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 2105v-509" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12392" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4645 2105v-509" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12405" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 2272h-27" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12406" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 2261h-27" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12409" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3988 2105v-504" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12410" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3999 2105v-504" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12436" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 7939v11h373v-11h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12437" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 7293v11h373v-11h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12438" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 7293v11h193v-11h-193" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12463" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 6647v11h373v-11h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12464" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 6647v11h193v-11h-193" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12465" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 6002v10h373v-10h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12466" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 5356v11h373v-11h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12469" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 4710v11h373v-11h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12470" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 4710v11h193v-11h-193" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12484" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 4064v11h373v-11h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12485" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 4064v11h193v-11h-193" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12499" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 3418v11h373v-11h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12500" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 3418v11h193v-11h-193" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12514" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5750 2773v10h373v-10h-373" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12515" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 2773v10h193v-10h-193" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12541" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6160 2100v-223" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12542" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6171 2100v-223" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12570" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3967 1569v11h-28v-11h28" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12571" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3805 1580v-11h28v11h-28" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12668" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332 4041v194" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12676" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3175h-129v227" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12677" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3208h-145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12678" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4618 4041v194" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12679" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3402h-145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12680" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3370h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12681" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3338h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12682" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3305h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12683" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3273h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12684" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 3241h-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12837" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1654 7966v22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path12838" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1665 7966v22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13710" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1428 7950h-185v-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13711" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 7950v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13712" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1243 7939h185v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13714" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 6002v10h-174v-10h174" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13715" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1417 5356v11h-174v-11h174" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13722" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 6002v10h193v-10h-193" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13723" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5514 5356v11h193v-11h-193" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13725" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 8585v11h-204v-11h204" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13726" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5707 7939v11h-204v-11h204" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13733" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 8612h11v603h-11v-603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13734" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4634 8612h11v603h-11v-603" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13735" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4063 9215h-11v-178h11v178" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13736" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 8843v11h-45v-11h45" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path13737" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 8843h11v388h-11v-388" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path14318" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 8714v11h-194v-11h194" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path14429" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3174 9074 34 34-13 29 57-27-13 29 92 92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path14451" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4817 8843v11h45v-11h-45" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path14453" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4817 9134v11h67v-11h-67" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path14704" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4817 9053v11h78v-11h-78" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path14856" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4817 8972v11h78v-11h-78" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path15019" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4645 8714v11h194v-11h-194" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path15022" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4804 9045v11h2v-11h-2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path15100" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4645 9045v11h2v-11h-2" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path15181" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6398 1624-8 7-281-281 8-8 281 282" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path16100" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2887 9215h11v-178h-11v178" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#000"/>
     <path id="path363" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2949 1549 4-46 8-45 12-44 16-43 20-42 23-39 26-38 30-35 32-32 35-29 38-26 40-23 41-19 43-16 44-12 45-8 46-4h46l46 4 45 8 44 12 43 16 41 19 40 23 38 26 35 29 32 32 30 35 26 38 23 39 20 42 16 43 12 44 8 45 4 46" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#808080"/>
     <path id="path364" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3159 1551 4-35 9-34 12-33 16-31 19-30 22-27 25-25 28-21 29-19 32-15 33-11 35-8 34-4h36l34 4 35 8 33 11 32 15 29 19 28 21 25 25 22 27 19 30 16 31 12 33 9 34 4 35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:4;stroke:#808080"/>
     <path id="path14325" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 8945h-59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14326" transform="matrix(0 -.16 -.16 0 362.11 155.33)" d="m8.5 0c0 4.6944-3.8056 8.5-8.5 8.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14327" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2238 8937v-212" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14328" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 8945h-59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14329" transform="matrix(0 -.16 -.16 0 362.11 155.33)" d="m7.5 0c0 4.1421-3.3579 7.5-7.5 7.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14330" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2238 8937v-212" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14431" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2074 8972v-50" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14432" transform="matrix(0 -.16 -.16 0 335.87 157.73)" d="m0 8.5c-2.2589 0-4.4248-0.89912-6.0196-2.4988" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14433" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2076 8916 9-9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14434" transform="matrix(0 -.16 -.16 0 335.55 161.09)" d="m8.1e-4 -8.5c2.2589 2.2e-4 4.4247 0.89954 6.0194 2.4994" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14435" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 8901v-47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14436" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2074 8972v-50" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14437" transform="matrix(0 -.16 -.16 0 335.87 157.73)" d="m0 7.5c-1.9931 0-3.9042-0.79334-5.3114-2.2048" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14438" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2076 8917 10-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14439" transform="matrix(0 -.16 -.16 0 335.55 161.09)" d="m8.1e-4 -8.5c2.2589 2.2e-4 4.4247 0.89954 6.0194 2.4994" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path14440" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 8901v-47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15026" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4645 8945h59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15027" transform="matrix(0 -.16 -.16 0 755.39 155.33)" d="M 8.1e-4,-8.5 C 4.69492,-8.49955 8.5,-4.6941 8.5,0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15028" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4712 8937v-212" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15029" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4645 8945h59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15030" transform="matrix(0 -.16 -.16 0 755.39 155.33)" d="m7.2e-4 -7.5c4.1418 4e-4 7.4993 3.3582 7.4993 7.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15031" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4712 8937v-212" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15090" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4876 8972v-50" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15091" transform="matrix(0 -.16 -.16 0 781.63 157.73)" d="m-6.0196-6.0012c1.5948-1.5997 3.7608-2.4988 6.0196-2.4988" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15092" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 8916-9-9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15093" transform="matrix(0 -.16 -.16 0 781.95 161.09)" d="M 6.01962,6.00118 C 4.42482,7.60088 2.25886,8.5 0,8.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15094" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4862 8901v-47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15095" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4876 8972v-50" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15096" transform="matrix(0 -.16 -.16 0 781.63 157.73)" d="m-5.3114-5.2952c1.4072-1.4115 3.3183-2.2048 5.3114-2.2048" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15097" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 8917-10-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15098" transform="matrix(0 -.16 -.16 0 781.95 161.09)" d="M 6.01962,6.00118 C 4.42482,7.60088 2.25886,8.5 0,8.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
     <path id="path15099" transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4862 8901v-47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#808080"/>
    </g>
   </g>
  </g>
 </g>
 <g id="layer27">
  <path id="path16516" d="m222.55 144.52 1.4452 102.61s115.61 10.116 121.39 2.8903c5.7806-7.2258 2.8903-104.05 2.8903-104.05z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer26">
  <path id="path16515" d="m56.361 21.677 2.8903 119.95s169.08 8.6709 169.08 2.8903-2.8903-128.62-2.8903-128.62z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer25">
  <path id="path16514" d="m62.142 145.96c-8.6709 41.91-2.8903 111.28-2.8903 111.28l115.61 1.4452 1.4452-117.06z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer24">
  <path id="path16513" d="m63.587 260.13-2.8903 106.94s118.5 5.7806 118.5-1.4452c0-7.2258-1.4452-106.94-1.4452-106.94z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer23">
  <path id="path16512" d="m59.251 375.74 4.3355 111.28 105.5 1.4452 5.7806-111.28z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer22">
  <path id="path16511" d="m62.142 491.35-1.4452 115.61 119.95-2.8903-1.4452-118.5z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer21">
  <path id="path16510" d="m59.251 724.02v114.17l124.28-1.4452 2.8903-118.5z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer20">
  <path id="path16509" d="m62.142 838.19v117.06l118.5-2.8903v-115.61z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer19">
  <path id="path16508" d="m59.251 956.69-4.3355 108.39 125.73 5.7806v-117.06z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer18">
  <path id="path16507" d="m53.471 1062.2 4.3355 124.28 117.06-1.4452 2.8903-124.28z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer17">
  <path id="path16506" d="m60.697 1190.8-1.4452 111.28 115.61 1.4452 5.7806-119.95z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer16">
  <path id="path16505" d="m776.05 137.29-1.4452 114.17s127.17 10.116 127.17 2.8903-1.4452-115.61-1.4452-115.61z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer15">
  <path id="path16504" d="m900.33 26.013-1.4452 115.61s157.52 5.7806 160.41 0c2.8904-5.7806 1.4452-119.95 1.4452-119.95z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer14">
  <path id="path16503" d="m939.35 135.84-2.8903 118.5 132.95 4.3355-1.4451-119.95z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer13">
  <path id="path16502" d="m940.8 260.13c-2.8903 78.038-1.4452 115.61-1.4452 115.61l125.73-2.8903-1.4452-119.95z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer12">
  <path id="path16501" d="m936.46 372.85v109.83l135.84 8.6709-8.6709-125.73z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer11">
  <path id="path16500" d="m939.35 488.46s-11.561 118.5-2.8903 118.5 130.06-2.8903 130.06-2.8903l-4.3354-118.5z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer10">
  <path id="path16499" d="m939.35 722.58-1.4452 112.72 127.17 1.4452-1.4452-115.61z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer9">
  <path id="path16498" d="m939.35 833.85 2.8903 119.95h119.95l-4.3355-119.95z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer8">
  <path id="path16497" d="m939.35 949.47v119.95h119.95v-121.39z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer7">
  <path id="path16496" d="m942.24 1066.5v119.95l127.17-4.3355-1.4451-118.5z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer6">
  <path id="path16495" d="m940.8 1187.9v106.94l122.84 2.8903v-112.72z" style="opacity:0;stroke-width:2.7693"/>
 </g>
 <g id="layer5">
  <path id="path16494" d="m776.05 1274.6-4.3355 124.28 130.06-7.2258-7.2258-115.61z" style="opacity:0;stroke-width:2.7693"/>
 </g>

 <a id="A-71" data-stall-no="A-71" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="layer4">
  <path id="path16493" d="m653.21 1270.3v125.73l124.28-1.4452-7.2258-130.06h-112.72z" style="opacity:0;stroke-width:2.7693"/>
 </g>
</a>


 <a id="A-70" data-stall-no="A-70" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="layer3">
  <path id="path16492" d="m343.95 1276.1 7.2258 121.39s119.95 1.4451 119.95-4.3355v-114.17z" style="opacity:0;stroke-width:2.7693"/>
 </g>
</a>

 

 <a id="A-69" data-stall-no="A-69" data-bs-toggle="tooltip" type="button" class="btn btn-secondary"
   data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="">
   <g id="layer2">
  <path id="path16491" d="m222.55 1276.1-1.4452 130.06 127.17-10.116-1.4452-122.84z" style="opacity:0;stroke-width:2.7693"/>
 </g>
</a>
</svg>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      var stallNo = tooltipTriggerEl.getAttribute('data-stall-no'); // Get stall_no from data attribute

      // Fetch the stall status and occupant via AJAX
      fetch('fetch_stall_status.php?stall_no=' + stallNo)
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