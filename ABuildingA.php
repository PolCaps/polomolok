<?php
session_start();
include("database_config.php");

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get stall information and vendor usernames
$sql = "SELECT s.stall_no AS stall_no, s.stall_id, s.stall_status AS status, v.username AS username
        FROM stalls s
        JOIN vendors v ON s.vendor_id = v.vendor_id";

$result = $conn->query($sql);

if ($result === false) {
  die("Error executing query: " . $conn->error);
}

$vendors = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //$vendors[$row['stall_no']] = $row['status'] == 'Occupied' ? $row['username'] : 'Vacant';
      $vendors[$row['stall_no']] = 
      ['status' => $row['status'] == 'Occupied' ? 'Occupied' : 'Vacant',
      'username' => $row['stall_status'] == 
       'Occupied' ? $row['username'] : 'N/A'];
  
    }
} else {
  echo "No results found.";
}

// Debugging output
  // echo "<pre>";
  // print_r($vendors);
  // echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pathId'])) {
  $pathId = $_POST['pathId'];


  // Prepare and execute the SQL query
  $sql = "SELECT * FROM stalls WHERE stall_no = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $pathId);
  $stmt->execute();
  $result = $stmt->get_result();

  if (array_key_exists($pathId, $vendors)) {
    $stallInfo = $vendors[$pathId];
    echo json_encode($stallInfo);
} else {
    echo json_encode(['status' => 'Not found', 'username' => 'N/A']);
}

  $stmt->close();
  $conn->close();
  exit;
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

<script>
    function checkStall(element) {
        // Retrieve the id of the <path> element
        var pathId = element.querySelector('path').id;

        // Create an AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Define a callback function to handle the response
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = xhr.responseText;
                alert(response); // Handle the response as needed
            }
        };

        // Send the request with the pathId
        xhr.send("pathId=" + pathId);
    }
    </script>

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
          <a class="nav-link " href="Admin.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMaps" aria-expanded="false" aria-controls="collapseMaps">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                <title>office</title>
                    <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z"/>
                    <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Maps</span>
          </a>
          <div class="collapse" id="collapseMaps">
            <div class="right-aligned-links" style="text-align: right;">
              <a class="nav-link active" href="ABuildingA.php">Building A</a>
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
          <a class="nav-link " href="AMvendor.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Vendors/Users</span>
          </a> 
        </li>
        <li class="nav-item">
          <a class="nav-link " href="AMmessages.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
              <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
            </svg>
            </div>
            <span class="nav-link-text ms-1">Messages</span>
          </a> 
        </li>
        <li class="nav-item">
          <a class="nav-link " href="AMinquiries.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
              <path d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
            </svg>
            </div>
            <span class="nav-link-text ms-1">Inquiries</span>
          </a> 
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Vendor and Stall Approval</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="AMVendorApproval.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <img src="image/icons/icons8-approve-48.png" alt="approveicon" width="18px" height="18px">
            </div>
            <span class="nav-link-text ms-1">Vendor Approval</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="AMRelocationRequest">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <img src="image/icons/icons8-kiosk-on-wheels-48.png" alt="relocationimg" width="18px" height="18px">
            </div>
            <span class="nav-link-text ms-1">Relocation Request</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Page Customization</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="HomepageEditor.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
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
          <img src="image/profile.jpg" alt="profile" style="min-width: 20px; min-height: 20px; height: 100px; width: 100px; border-radius: 10px; margin-left: 40px;">
          <h5 class="text-center"><?php echo $row['admin_name'];?></h5>
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
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Building A</h6>
              <p class="text-sm">
                <i class="fa fa-building-o fa-lg text-warning"></i>
                <span class="font-weight-bold">Building A</span>
              </p>  
            </div>
            <svg version="1.1" viewBox="0 0 1122.7 1588" xmlns="http://www.w3.org/2000/svg">

              <defs>
                <clipPath id="clipPath670">
                <path transform="matrix(1,0,0,-1,-3133,8623)" d="m585 714h5866v8292h-5866v-8292"/>
                </clipPath>
                <clipPath id="clipPath672">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m585 714h5866v8292h-5866v-8292"/>
                </clipPath>
                <clipPath id="clipPath7519">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7520">
                <path transform="matrix(1 0 0 -1 -890 949)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7521">
                <path transform="matrix(1 0 0 -1 -890 797)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7523">
                <path transform="translate(-3005 -605)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7525">
                <path transform="translate(-3077 -607)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7527">
                <path transform="translate(-3254 -607)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7529">
                <path transform="translate(-3360 -658)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7531">
                <path transform="translate(-3407 -607)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7533">
                <path transform="translate(-3551 -605)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7535">
                <path transform="translate(-3659 -605)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7537">
                <path transform="translate(-3770 -607)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7539">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7541">
                <path transform="translate(-3923 -607)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7543">
                <path transform="translate(-4134 -605)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7545">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7547">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7549">
                <path transform="translate(-6636 -5764)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7551">
                <path transform="translate(-6636 -5721)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7553">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7555">
                <path transform="translate(-6636 -5520)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7557">
                <path transform="translate(-6709 -5355)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7559">
                <path transform="translate(-6636 -5311)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7561">
                <path transform="translate(-6636 -5206)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7563">
                <path transform="translate(-6636 -5039)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7565">
                <path transform="translate(-6634 -4882)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7567">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7569">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7571">
                <path transform="translate(-3109,-9333)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7573">
                <path transform="translate(-3220,-9268)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7575">
                <path transform="translate(-3271,-9268)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7577">
                <path transform="translate(-3425,-9268)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7579">
                <path transform="translate(-3514,-9267)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7581">
                <path transform="translate(-3644,-9268)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7583">
                <path transform="translate(-3801,-9267)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7585">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7587">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7589">
                <path transform="translate(-379,-5061)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7591">
                <path transform="translate(-379,-5116)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7593">
                <path transform="translate(-379,-5270)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7595">
                <path transform="translate(-379,-5383)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7597">
                <path transform="translate(-379,-5468)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7599">
                <path transform="translate(-379,-5517)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7601">
                <path transform="translate(-381,-5728)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7603">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7605">
                <path transform="translate(-2.0833e-7 -.00020833)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7606">
                <path transform="matrix(1 0 0 -1 -1593 1618)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7607">
                <path transform="matrix(1 0 0 -1 -2074 1523)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7608">
                <path transform="matrix(1 0 0 -1 -2725 1545)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7609">
                <path transform="matrix(1 0 0 -1 -4345 1562)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7610">
                <path transform="matrix(1 0 0 -1 -4966 1547)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7611">
                <path transform="matrix(1 0 0 -1 -4328 2068)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7612">
                <path transform="matrix(1 0 0 -1 -4220 1839)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7613">
                <path transform="matrix(1 0 0 -1 -4217 1757)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7614">
                <path transform="matrix(1 0 0 -1 -4929 1968)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7615">
                <path transform="matrix(1 0 0 -1 -2751 1983)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7616">
                <path transform="matrix(1 0 0 -1 -2137 1981)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7617">
                <path transform="matrix(1 0 0 -1 -2535 2613)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7618">
                <path transform="matrix(1,0,0,-1,-1144,6080)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7619">
                <path transform="matrix(1,0,0,-1,-1208,6689)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7620">
                <path transform="matrix(1,0,0,-1,-1176,7802)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7621">
                <path transform="matrix(1,0,0,-1,-1139,7258)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7622">
                <path transform="matrix(1,0,0,-1,-1147,8451)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7623">
                <path transform="matrix(1,0,0,-1,-1583,8449)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7624">
                <path transform="matrix(1,0,0,-1,-1571,7808)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7625">
                <path transform="matrix(1,0,0,-1,-1591,7255)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7626">
                <path transform="matrix(1,0,0,-1,-1632,6676)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7627">
                <path transform="matrix(1,0,0,-1,-1607,6060)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7628">
                <path transform="matrix(1,0,0,-1,-1571,4179)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7629">
                <path transform="matrix(1 0 0 -1 -1567 3551)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7630">
                <path transform="matrix(1 0 0 -1 -1578 2893)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7631">
                <path transform="matrix(1 0 0 -1 -1557 2328)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7632">
                <path transform="matrix(1 0 0 -1 -5923 2206)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7633">
                <path transform="matrix(1,0,0,-1,-4691,8476)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7634">
                <path transform="matrix(1 0 0 -1 -5933 2849)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7635">
                <path transform="matrix(1,0,0,-1,-5961,4065)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7636">
                <path transform="matrix(1,0,0,-1,-5930,4796)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7637">
                <path transform="matrix(1,0,0,-1,-6009,6055)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7638">
                <path transform="matrix(1,0,0,-1,-5997,6672)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7639">
                <path transform="matrix(1,0,0,-1,-5963,7280)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7640">
                <path transform="matrix(1,0,0,-1,-5956,7866)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7641">
                <path transform="matrix(1,0,0,-1,-5952,8474)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7642">
                <path transform="matrix(1,0,0,-1,-5484,8465)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7643">
                <path transform="matrix(1,0,0,-1,-5454,7880)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7644">
                <path transform="matrix(1,0,0,-1,-5491,7271)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7645">
                <path transform="matrix(1,0,0,-1,-5451,6642)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7646">
                <path transform="matrix(1,0,0,-1,-5466,6060)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7647">
                <path transform="matrix(1,0,0,-1,-5472,4796)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7648">
                <path transform="matrix(1,0,0,-1,-5514,4059)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7649">
                <path transform="matrix(1 0 0 -1 -5466 3461)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7650">
                <path transform="matrix(1 0 0 -1 -5464 2831)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7651">
                <path transform="matrix(1 0 0 -1 -5549 2179)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7652">
                <path transform="matrix(1,0,0,-1,-4220,8507)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7653">
                <path transform="matrix(1,0,0,-1,-3381,8448)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7654">
                <path transform="matrix(1,0,0,-1,-2746,8461)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7655">
                <path transform="matrix(1,0,0,-1,-2298,8462)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7656">
                <path transform="matrix(1 0 0 -1 -2226 3463)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7657">
                <path transform="matrix(1 0 0 -1 -2860 2841)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7658">
                <path transform="matrix(1 0 0 -1 -2857 2789)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7659">
                <path transform="matrix(1 0 0 -1 -2856 2738)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7660">
                <path transform="matrix(1 0 0 -1 -5015 2890)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7661">
                <path transform="matrix(1 0 0 -1 -4877 3488)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7662">
                <path transform="matrix(1,0,0,-1,-4847,3984)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7663">
                <path transform="matrix(1 0 0 -1 -2099 2959)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7664">
                <path transform="matrix(1,0,0,-1,-2215,3951)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7665">
                <path transform="matrix(1,0,0,-1,-2968,7809)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7666">
                <path transform="matrix(1,0,0,-1,-3550,7826)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7667">
                <path transform="matrix(1,0,0,-1,-4070,7784)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7668">
                <path transform="matrix(1 0 0 -1 -5933 3467)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7669">
                <path transform="matrix(1 0 0 -1 -2914 2625)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7670">
                <path transform="matrix(1 0 0 -1 -4169 2622)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7671">
                <path transform="matrix(1 0 0 -1 -4523 2610)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7672">
                <path transform="matrix(1,0,0,-1,-1125,4187)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7673">
                <path transform="matrix(1 0 0 -1 -1129 3549)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7674">
                <path transform="matrix(1 0 0 -1 -1143 2904)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7675">
                <path transform="matrix(1 0 0 -1 -1134 2211)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7676">
                <path transform="matrix(1 0 0 -1 -3276 2762)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
                <clipPath id="clipPath7682">
                <path transform="matrix(1 0 0 -1 -5890 481)" d="m0 315h6978v9254h-6978v-9254"/>
                </clipPath>
              </defs>
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920h-83v-51h83v51" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 7537h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 7537h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 7537h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 6293h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8159h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8159h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8159h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8159h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8159h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8159h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 7537h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 7537h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7537h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 6915h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 6915h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6915h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8159h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8159h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4150 8159h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 6538h10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 3763v-580" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3763v-580" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920h83v-51h-83v51" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542h83v-51h-83v51" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 8740v-581" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1856 8740v-581" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3187 8756v-146" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3218 8756v-146" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3249 8756v-146" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3280 8756v-125" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3311 8756v-94" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3342 8756v-78" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8605h128" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8574h128" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8543h128" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8512h128" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8481h128" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 7563h-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3033 7594h32v-31h-32v31" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 7599h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 7599h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 7599h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3594 7594h31v-31h-31v31" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4155 7594h31v-31h-31v31" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3652h379l-379 10zm379 0-379 10h379z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 3164h353l-353 11zm353 0-353 11h353z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7304h156" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7335h156" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4434 7273h103" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4434 7273h103" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7242h51" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4464 7242h8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4481 7242h56" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7211h98" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7180h146" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7335v-187h156v37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 7558v-21" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1856 7558v-21" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 7599h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 7599h41v-41h-41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 7599h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8159h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599h-42v-41h42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 7599h-41v-41h41v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 7599h-42v-41h42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 7599h-42v-41h42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8159h-42v-41h42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1445 5630v-221" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1477 5645v-236" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1508 5645v-236" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1539 5645v-236" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1570 5597v-188" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1601 5642v-233" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1632 5404v238" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5409h609" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1264 5404h368" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1631 5642-71-105-18 4 22-30-18 4-71-106" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1570 5645v-48" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1162 5364v160h124v-34l43 34-36 34" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:5;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 6915h-42v-41h42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3033 7579v-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 7558v-21h-11v21h11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7558v-21h10v21h-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3091 8528v150h170v27l38-27-31-22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <text transform="matrix(.16 0 0 .16 503.95 205.65)" clip-path="url(#clipPath670)" xml:space="preserve"><tspan x="0 22.959999" y="0" style="fill:#000000;font-family:Tahoma;font-size:35px">UP</tspan></text>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3259 8610 58 58-13 28 55-26-12 28 58 58" clip-path="url(#clipPath672)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7275 64-42 10 16-2-45 12 16 72-47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7307 74-48 10 15-2-44 12 16 62-41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4421 7148h-1649" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2214 5964h279v-11h-279v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 7827v-449" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2096 7827v-449" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7352h104v-104h-104v104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7248h104v-103h-104v103" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7145h104v-104h-104v104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7041h104v-104h-104v104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 6937h104v-103h-104v103" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 6834h104v-104h-104v104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7352h103v-104h-103v104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7248h103v-103h-103v103" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7145h103v-104h-103v104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7041h103v-104h-103v104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 6803h103v-103h-103v103" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 6730h104v-104h-104v104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 6700h103v-104h-103v104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 6368h-10v114h155v-10h-145v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 6482h-10v114h155v-10h-145v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 6368h155v-10h-155v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2231 6368h-124v-10h124v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2221 6275h137v-11h-137v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2292 6264v-114h10v114h-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2221 6352v-72h10v72h-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2364 6352v-72h10v72h-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2374 6275v-11h-16v11h16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2301 6038v-74h11v74h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2304 6043v92" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 5971h26v-26h-26v26" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 4157h26v-26h-26v26" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 6604h26v-26h-26v26" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 7378h26v-26h-26v26" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2114 7846 60 59" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 7853 63 63" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4192 8144v-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 6937h103v-134h-103v134" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 7853h26v-26h-26v26" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 7923h26v-25h-26v25" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5048 4139v0h-321zm0 0h-321v10z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4149h321v-10z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5048 5440h58l-58 10zm58 0-58 10h58z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5440h321l-321 10zm321 0-321 10h321z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 4139v0h-58zm0 0h-58v10z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5048 4149h58v-10z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 5450h-379v-10h379" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4849h397l-397 10zm397 0-397 10h397z" style="stroke-linecap:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 4859h-397v-10h397v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 4149h-379v-10h379" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 7853h-25v-26h25v26" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 7923h-26v-25h26v25" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5624v-357" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1013 5267v357h10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1013 5261h10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5624h-10v-5h10v5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5261h-10v6h10v-6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 6578h-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 5619v-31" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m940 8968h5340-921" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3259 8605h-72v-129" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(0 -.16 -.16 0 512.19 229.09)" d="m0 2.5c-1.3807 0-2.5-1.1193-2.5-2.5s1.1193-2.5 2.5-2.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3182 8476v134h77" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 3652v10h-379v-10h379" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 3164v11h-353v-11h353" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8612v154" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8610v156" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8756h144" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3318 7923h26v-25h-26v25" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4529 7923h26v-25h-26v25" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m810 1445v7393" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6409 1445v7393" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5407 5409h181v-5h-181v5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 1913h-219" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1881h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3146 1881h-31" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1850h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3246 1850h-7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3190 1850h-75" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1819h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3243 1819h-128" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1788h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3278 1788h-27" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3240 1788h-125" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1757h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3321 1757h-206" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1726h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3350 1726h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1695h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3350 1695h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1664h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3350 1736v-72h-235" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3370 1913v-249" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(0 -.16 -.16 0 540.35 1319)" d="m0 10.5c-5.799 0-10.5-4.701-10.5-10.5s4.701-10.5 10.5-10.5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3131 1892 92-65 24 35-9-92 23 31 89-65" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6280 8968 129-130" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m940 8968-130-130" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4968 2501 166 166" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1082 1173h1956" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3906 1405h-8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 6158h26v-26h-26v26" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7511v11h-111v-11h111" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7898v-148" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2754 7923h26v-25h-26v25" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2498 7599h11v299h-11v-299" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7511h10v387h-10v-387" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 7352h-16v-437h16v437" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7373h-16v-458h16v458" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4537 7148h10v363h-10v-363" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7363v-11h119v11h-119" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 7485h10v11h-10v-11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 7363h10v10h-10v-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4724 7496h-10v-11h10v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4721 7898h-10v-299h10v299" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4537 7511v11h-1765v-11h1765" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 8377h10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 8377v389h10v-389" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 8766h-10v-394h10v394" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 8387h153v218h10v-218" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8419h-153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8450h-153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8481h-153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8512h-153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8543h-153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8574h-153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8605h-153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8387 56 51-19 21 71-23-23 29 53 47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8605h138" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8574h138" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8543h138" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8512h138" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8481h102" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8450h46" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2095 8450h31" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8419h35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1939 8402v261h159v-107h-19l19-35 21 35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <text transform="matrix(.16 0 0 .16 323.31 196.05)" xml:space="preserve"><tspan x="0 22.959999" y="0" style="fill:#000000;font-family:Tahoma;font-size:35px">UP</tspan></text>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5354 8387h-153v218h-10v-218" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8419h153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8450h153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8481h153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8512h153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8543h153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8574h153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8605h153" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8387-56 51 19 21-71-23 23 29-53 47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8605h-138" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8574h-138" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8543h-138" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8512h-138" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8481h-103" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8450h-46" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 8450h-31" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8419h-35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5280 8402v261h-158v-107h19l-19-35-21 35" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <text transform="matrix(.16 0 0 .16 831.31 196.05)" xml:space="preserve"><tspan x="0 22.959999" y="0" style="fill:#000000;font-family:Tahoma;font-size:35px">UP</tspan></text>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3105 1892h10v-491h-10v491" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 2923h-941" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253 2530 7-7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253 2530 393 393h943v-10h-939l-390-390" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3219 2913h-10v-402h10v402" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2804 2913h-10v-161h10v161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2794 2511h10v210h-10v-210" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4961 2523 8 7" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4961 2523-390 390h-441v10h446l393-393" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4416 2516h10v205h-10v-205" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4416 2752h10v161h-10v-161" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42v-41h-42v41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5364 8740h-10v-581h10v581" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5645v10h-360v-10h360" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 5655v-10h380v10h-380" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 3183h26v-26h-26v26" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 3164v11h-353v-11h353" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2108 2676 8-8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2108 2676 219 218v270h11l-1-274-221-222" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 2955h-155" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 3670h26v-26h-26v26" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3652v10h-379v-10h379" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4139v10h-379v-10h379" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 4655h-11v-498h11v498" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 4680h26v-25h-26v25" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4849v10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4849h-397v218h397v-11h-386v-197h386" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 5453h26v-26h-26v26" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5435v10h-379v-10h379" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 5945h-11v-492h11v492" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 6140v10h-379v-10h379" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 6578h-11v-420h11v420" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 7352h-11v-748h11v748" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(0 -.16 -.16 0 399.07 321.25)" d="m2.3511 90.469c-25.173 0.65419-49.48-9.2094-67.079-27.22-17.599-18.01-26.898-42.539-25.663-67.69" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2382 7905v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2382 7905h-208l-60-59-7 7 63 63h212" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 7905v11h-6v-11h6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2754 7905v11h-237v-11h237" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2658 7536 77 44" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2732 7585-76-44 2-5 77 44-3 5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2664 7522 4 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2669 7522 10 10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7522h1l15 16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2678 7522 22 22" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2683 7522 27 28" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2687 7522 34 34" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2692 7522 40 40" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2697 7522 45 45" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2701 7522 52 51" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2706 7522 56 56" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2711 7522 51 51" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2715 7522 47 46" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2720 7522 42 42" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2725 7522 37 37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2729 7522 33 32" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2734 7522 28 28" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2739 7522 23 23" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2743 7522 19 18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2748 7522 14 14" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2752 7522 10 9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2757 7522 5 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2547 7750v10h-38v-10h38" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2640 7905h-10v-145h10v145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 7567 88 50 3-6 9 6-8 14-92-52" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2654 7518 9 5-5 8-9-5 5-8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2592 7625-55 96" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2537 7750v-29" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4614 7765 5 9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4614 7765-7 3v137h11v-131h1" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7578-99-55 1-1h98v56" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2646 7750v10h-21v-10h21" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7750v10h-39v-10h39" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2651 7533-44 76" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7578 5 3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4555 7905v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4463 7522h-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4529 7905h-98" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4529 7916h-108" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 7843 7 8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 7843-62 62h-205v11h209l65-65" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 7827h-11v-449h11v449" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4555 7916v-11h148v11h-148" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4045 7923h26v-25h-26v25" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7541-77 45" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4473 7590 76-44-2-5-77 45 3 4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4605 7617 5 9" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4613 7631v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4596 7622 8 14" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4609 7645v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4552 7525-9 6 4 6 9-6-4-6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4633 7636 51 88" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7709-30 17 5 9 25-15" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4554 7538 44 77" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4604 7636h107v-10h-101" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7148h164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7180h164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7211h164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7242h164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7273h164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4621 7767 58-34" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4715 7706 5 9-34 20-5-9 34-20" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4599 7157v61h-12l13 19 14-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <text transform="matrix(.16 0 0 .16 740.27 440.37)" xml:space="preserve"><tspan x="0 18.983999 38.807999 64.064003" y="0" style="fill:#000000;font-family:Tahoma;font-size:28px">DOWN</tspan></text>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5676h-10v104h10v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6298h-10v104h10v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6920h-10v104h10v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 7542h-10v104h10v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 8159h-10v104h10v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 8636h-10v104h10v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 8014h-10v104h10v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 7387h-10v104h10v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6765h-10v104h10v-104" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6143h-10v103h10v-103" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3219 2913h-10v-402h10v402" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3400 2825v83h-10v-83h10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3986 2770v-20h-5v13h1v7h4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4105 2516h10v366h-10v-366" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360h-20" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5781 1174 150-1" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5931 1360h-20" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672h10-10v109h10v-109 109h-10v-109" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1781v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672h10-10v109h10v-109 109h-10v-109" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1781v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777h10-10v110h10v-110 110h-10v-110" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777h10-10v110h10v-110 110h-10v-110" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777v5h-10v-5h10-10v5h10v-5" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1782v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1782v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1881v6h-10v-6h10-10v6h10v-6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1881v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1881v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1881v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672v6h-10v-6h10-10v6h10v-6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1678v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1678v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672v0" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6202 2509v-571" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 2509v-571" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6212 2509v-571" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6202 1938h-41v-51h36v-215" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7304h-155" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7335h-155" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2786 7273h-103" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2786 7273h-103" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7242h-50" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2756 7242h-8" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2739 7242h-56" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7211h-97" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7180h-145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7335v-187h-155v37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7275-63-42-10 16 2-45-12 16-72-47" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7307-73-48-10 15 2-44-12 16-62-41" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7148h-164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7180h-164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7211h-164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7242h-164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7273h-164" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2621 7157v61h11l-12 19-14-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 417.23 438.77)" d="m0 0v-3h1v-2l1-1v-1h1v-1h1v-1h2v-1h10v21h-6v-1h-4l-1-1h-1v-1h-1v-1h-1v-1h-1v-2l-1-1v-2zm3 0v4h1v1l2 2h1v1h7v-16h-6v1h-2v1h-1v1h-1v2h-1v3z"/>
                <path transform="matrix(.16 0 0 -.16 414.35 437.49)" d="m0 0v-1h-1v-3h-1v-8h1v-2l1-1v-1h1v-1h1v-1h3v-1h4v1h3v1h1v1h1v1h1v2h1v10h-1v2h-1v1l-1 1h-1v1h-2v1h-6v-1h-2v-1h-1v-1zm1-8v4l1 1v1l1 1h1v1h2l1 1h1v-1h2l2-2v-1h1v-10h-1v-1l-1-1h-1v-1h-6v1h-1v1h-1v2h-1v4z"/>
                <path transform="matrix(.16 0 0 -.16 409.87 437.17)" d="m0 0 5-20h3l4 17 4-17h3l6 20h-3l-4-17-5 17h-2l-4-17-5 17z"/>
                <path transform="matrix(.16 0 0 -.16 406.99 440.37)" d="m0 0h3l10 18v-18h2v20h-4l-8-16v16h-3z"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7148h10v363h-10v-363" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4673v-11h239v11h-239" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5056 4673v-11h50v11h-50" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5056 4149v401h57" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4900 4673h11v74h-11v-74" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4900 4849h11v-11h-11v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4446 7097v61h-12l13 19 14-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <text transform="matrix(.16 0 0 .16 715.47 445.49)" xml:space="preserve"><tspan x="0 18.368" y="0" style="fill:#000000;font-family:Tahoma;font-size:28px">UP</tspan></text>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2754 7098v61h-12l13 19 14-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <text transform="matrix(.16 0 0 .16 444.75 445.33)" xml:space="preserve"><tspan x="0 18.368" y="0" style="fill:#000000;font-family:Tahoma;font-size:28px">UP</tspan></text>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4673v-11h-239v11h239" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2164 4673v-11h-50v11h50" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2164 4149v401h-57" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2320 4673h-11v74h11v-74" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2320 4849h-11v-11h11v11" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4856 6358h-10v-6h10v6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4989 6358h10v-6h-10v6" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6596v-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6596h155v-25h-10v15h-145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 6471v11h-145v-11h145" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 6457h10v37h-10v-37" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6368v-10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6368h145v12h10v-22h-155" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6185 1627-7 7-230-229 8-7 229 229" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1375v11h-110v-11h110" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1264 1398 8 7-230 229-7-7 229-229" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 1887h-10v-215h10v215" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6151 1161 271 271" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3473 1959v-423h-233v102" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3483 1959v-434h-253v113h-17l22 43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3240 1638h17l-22 43" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3473 1959h10" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4716 7923v57" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4426 7923v57" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4167 7923v57" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4426 7522v394" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4421 7522v394" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4431 7522v383" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4542 7923v-82" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4613 7905v-20" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m890 921h1511" clip-path="url(#clipPath7519)" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <text transform="matrix(.16 0 0 .16 145.07 1433.5)" clip-path="url(#clipPath7520)" xml:space="preserve"><tspan x="0 99.830002 197.114 300.29401 399.32001 502.634 604.07202 643.33398 721.18799 797.836 901.01599 1004.196 1101.48 1140.7419 1228.78 1305.428 1397.218" y="0" style="fill:#000000;font-family:Tahoma;font-size:134px;font-weight:700">GROUND FLOOR PLAN</tspan></text>
                <text transform="matrix(.16 0 0 .16 145.07 1457.8)" clip-path="url(#clipPath7521)" xml:space="preserve"><tspan x="0 64.612 134.328 203.92799 261.69601 326.772 363.07999 426.41599 467.48001 530.81598 594.15198 657.48798 693.79602 783.23199 850.97601" y="0" style="fill:#000000;font-family:Tahoma;font-size:116px">SCALE 1:300 MTS</tspan></text>
                <path transform="matrix(.16 0 0 -.16 483.47 1488.5)" d="m0 0h-6l-1 1h-5l-1 1h-2l-1 1h-2l-1 1h-2l-1 1h-2v1h-1v12h2l1-1v-1h1l1-1h1l1-1v-1h1l1-1h2l1-1h1l1-1h3l1-1h12l1 1h2l1 1h1v1h1l1 1h1v1l1 1v2l1 1v7l-1 1v1l-4 4h-1l-2 1h-1l-1 1h-3l-1 1h-3l-1 1h-3l-1 1h-2l-1 1h-2l-1 1h-1l-1 1h-1l-5 5v1h-1v1l-1 1v3l-1 1v9l1 1v2l1 1v1l2 2v1l1 1h1l2 2v1h1l1 1h1l1 1h1l1 1h2l1 1h6l1 1h2l1-1h8l1-1h3l1-1h2l1-1h1l1-1h2v-12h-1l-1 1h-1v1h-1l-1 1h-1l-1 1h-1l-1 1h-1v1h-2l-1 1h-3l-1 1h-9l-1-1h-3l-2-2h-1l-2-2v-1l-1-1v-1l-1-1v-6l1-1v-1l1-1v-1h1v-1h1l2-2h1l1-1h3l1-1h3l1-1h4l1-1h2l1-1h2l1-1h2l1-1h1l3-3h1v-1l1-1v-1h1v-1l1-1v-2l1-1v-11l-1-1v-2l-1-1v-1l-1-1v-1h-1v-1l-3-3h-1l-1-1v-1h-1l-1-1h-2l-1-1h-1l-1-1h-5l-1-1h-2z" clip-path="url(#clipPath7523)"/>
                <path transform="matrix(.16 0 0 -.16 494.99 1488.2)" d="m0 0 25 73h12l25-73h-10l-7 20h-28l-7-20zm42 29-11 34-11-34z" clip-path="url(#clipPath7525)"/>
                <path transform="matrix(.16 0 0 -.16 523.31 1488.2)" d="m0 0h-10v63l-19-43h-6l-19 43v-63h-9v73h13l19-41 18 41h13z" clip-path="url(#clipPath7527)"/>
                <path transform="matrix(.16 0 0 -.16 540.27 1480.1)" d="m0 0v-6l-1-1v-2l-1-1v-1l-1-1v-1l-2-2v-1h-1l-1-1v-1h-1l-1-1h-1l-2-2h-1l-1-1h-2l-1-1h-3l-1-1h-15v-27h-10v73h27l1-1h4l1-1h1v-1h2l1-1h1l1-1v-1h1l1-1v-1h1l1-1v-1l1-1v-1h1v-2l1-1v-6zm-10 0v5l-1 1v1l-2 2v1h-1l-1 1h-1l-1 1h-1l-1 1h-3l-1 1h-13v-30h10l1 1h5l1 1h2l1 1h1v1l4 4v2h1v4z" clip-path="url(#clipPath7529)"/>
                <path transform="matrix(.16 0 0 -.16 547.79 1488.2)" d="m0 0 25 73h12l24-73h-10l-7 20h-28l-6-20zm42 29-12 34-11-34z" clip-path="url(#clipPath7531)"/>
                <path transform="matrix(.16 0 0 -.16 570.83 1488.5)" d="m0 0h-5l-1 1h-4l-1 1h-3v1h-2l-1 1h-1l-1 1h-1v1h-1l-1 1h-1v1l-2 2h-1v1l-2 2v1h-1v1l-1 1v1l-1 1v1l-1 1v2l-1 1v2l-1 1v6l-1 1v11l1 1v5l1 1v2l1 1v1l1 1v2l1 1v1l1 1v1l3 3v1h1l1 1v1h1l3 3h1l1 1h1l1 1h1l1 1h1l1 1h3l1 1h7l1 1h1l1-1h7l1-1h3l1-1h3l1-1h1l1-1h2l2-2v-12l-2 2h-1l-2 2h-1v1h-1l-1 1h-1l-1 1h-1l-1 1h-2l-1 1h-3l-1 1h-11l-1-1h-2l-1-1h-1l-1-1h-1l-3-3h-1v-1l-3-3v-1l-1-1v-1l-1-1v-2l-1-1v-2l-1-1v-6l-1-1v-4l1-2v-7h1v-3l1-1v-1l1-1v-1l1-1v-1l2-2v-1h1l1-1v-1h1l3-3h2l1-1h1l1-1h16l1 1h3l1 1h1v19h-17v9h27v-33h-2l-1-1h-2v-1h-2l-1-1h-2l-1-1h-2l-1-1h-5v-1h-5z" clip-path="url(#clipPath7533)"/>
                <path transform="matrix(.16 0 0 -.16 588.11 1488.5)" d="m0 0h-6l-1 1h-3l-1 1h-2l-1 1h-1l-2 2h-1l-4 4v1l-1 1v1h-1v1l-1 1v2l-1 1v4l-1 1v53h10v-54h1v-3l1-1v-1l1-1v-1h1v-1l1-1h1l1-1v-1h2l1-1h4l1-1h3l1 1h4l1 1h2l3 3h1v1l1 1v1l1 1v2l1 1v6l1 2v47h9v-55l-1-1v-3l-1-1v-2l-1-1v-1h-1v-1l-1-1v-1l-1-1h-1v-1l-1-1h-1l-1-1h-1l-2-2h-2l-1-1h-3l-1-1h-5z" clip-path="url(#clipPath7535)"/>
                <path transform="matrix(.16 0 0 -.16 605.87 1488.2)" d="m0 0h-29v7h10v59h-10v7h29v-7h-9v-59h9z" clip-path="url(#clipPath7537)"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3844 607v64h-24v9h59v-9h-25v-64z" clip-path="url(#clipPath7539)"/>
                <path transform="matrix(.16 0 0 -.16 630.35 1488.2)" d="m0 0 25 73h12l25-73h-10l-7 20h-28l-7-20zm42 29-11 34-12-34z" clip-path="url(#clipPath7541)"/>
                <path transform="matrix(.16 0 0 -.16 664.11 1488.5)" d="m0 0h-6l-1 1h-4l-1 1h-3l-1 1h-2l-1 1h-1l-1 1h-2l-1 1v12h1l2-2h1v-1h1l2-2h1l1-1h1l1-1h1l1-1h3l1-1h13l1 1h2v1h1l2 2h1l1 1v1l1 1v3l1 1v2l-1 1v3l-1 1v1h-1v1h-1v1l-1 1h-2l-1 1h-1l-2 1h-3v1h-3l-1 1h-3l-2 1h-2l-1 1h-2l-1 1h-1v1h-1l-1 1h-1l-1 1v1h-1l-1 1v1l-2 2v2l-1 1v3l-1 1v5l1 1v3l1 1v1l1 1v1h1v1l1 1v1h1l3 3h1v1h1l1 1h2l1 1h1l1 1h7l1 1h1l1-1h8l1-1h4l1-1h2l1-1h1v-1h2v-12h-1v1h-1l-1 1h-1l-2 2h-1l-1 1h-1l-1 1h-2l-1 1h-3l-1 1h-9l-1-1h-2l-1-1h-1l-2-2h-1v-1l-1-1v-1l-1-1v-2l-1-1 1-2v-4h1v-1l3-3h1l1-1h1l1-1h3l1-1h3l1-1h3l1-1h3l1-1h1l1-1h2l1-1h1l1-1h1l1-1v-1h1v-1l3-3v-1l1-1v-3l1-1v-6l-1-1v-3l-1-1v-2l-1-1v-1l-3-3v-1h-1l-3-3h-1l-1-1h-2v-1h-2l-1-1h-4l-1-1h-3z" clip-path="url(#clipPath7543)"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4232 607v64h-25v9h59v-9h-24v-64z" clip-path="url(#clipPath7545)"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4333 607h-12v14h12z" clip-path="url(#clipPath7547)"/>
                <path transform="matrix(.16 0 0 -.16 1064.4 663.09)" d="m0 0v13l34 27-5 4h-29v10h73v-10h-34l34-30v-12l-33 30z" clip-path="url(#clipPath7549)"/>
                <path transform="matrix(.16 0 0 -.16 1064.4 669.97)" d="m0 0 73-25v-12l-73-25v11l20 6v29l-20 6zm29-42 34 12-34 11z" clip-path="url(#clipPath7551)"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6636 5565v43h73v-10h-65v-33z" clip-path="url(#clipPath7553)"/>
                <path transform="matrix(.16 0 0 -.16 1064.4 702.13)" d="m0 0 73-25v-12l-73-24v10l20 7v28l-20 6zm29-42 34 12-34 11z" clip-path="url(#clipPath7555)"/>
                <path transform="matrix(.16 0 0 -.16 1076.1 728.53)" d="m0 0-41 25h-32v10h31l42 25v-11l-32-19 32-20z" clip-path="url(#clipPath7557)"/>
                <path transform="matrix(.16 0 0 -.16 1064.4 735.57)" d="m0 0 73-25v-12l-73-24v10l20 7v28l-20 6zm29-42 34 12-34 11z" clip-path="url(#clipPath7559)"/>
                <path transform="matrix(.16 0 0 -.16 1064.4 752.37)" d="m0 0 73-25v-12l-73-25v10l20 7v28l-20 7zm29-42 34 11-34 11z" clip-path="url(#clipPath7561)"/>
                <path transform="matrix(.16 0 0 -.16 1064.4 779.09)" d="m0 0v11l63 33h-63v9h73v-14l-58-30h58v-9z" clip-path="url(#clipPath7563)"/>
                <path transform="matrix(.16 0 0 -.16 1064.1 804.21)" d="m0 0v5l1 1v6l1 1v2l1 1v2l1 1v2l2 2v1h12v-1l-3-3v-1l-1-1v-1l-2-2v-1l-1-1v-2l-1-1v-2l-1-1v-12l1-1v-2l1-1v-1l4-4h1l1-1h8l1 1h2v1h1l1 1v1h1v1l1 1v3l1 1v3l1 1v3l1 1v3l1 1v2l1 1v2l1 1v1l1 1v1h1v1l3 3h1l2 2h1l1 1h3l1 1h7l1-1h2l1-1h2l3-3h1l1-1v-1h1v-1l2-2v-1l1-1v-1h1v-3l1-1v-5l1-1v-5l-1-1v-6l-1-1v-4l-1-1v-1l-1-1v-2l-1-1v-1h-12v1l2 2v1l2 2v1h1v2l1 1v1l1 1v3l1 1v11l-1 1v2h-1v1l-1 1v1h-1v1l-1 1h-1l-1 1h-1l-1 1h-5l-1-1h-1l-1-1h-1l-1-1h-1v-1l-1-1v-1h-1v-2l-1-1v-3l-1-1v-3l-1-1v-3l-1-1v-3h-1v-2l-1-1v-2l-1-1v-1l-1-1v-1h-1l-1-1v-1h-1l-3-3h-2l-1-1h-4l-1-1h-2l-1 1h-4l-1 1h-2l-1 1h-1l-2 2h-1l-3 3v1h-1v1l-1 1v1l-1 1v1l-1 1v2l-1 1v3l-1 2v2z" clip-path="url(#clipPath7565)"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6636 4784h65v25h8v-59h-8v24h-65z" clip-path="url(#clipPath7567)"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6636 4684v11h14v-11z" clip-path="url(#clipPath7569)"/>
                <path transform="matrix(.16 0 0 -.16 500.11 92.053)" d="m0 0h-34v-20h33v-9h-33v-36h-10v74h44z" clip-path="url(#clipPath7571)"/>
                <path transform="matrix(.16 0 0 -.16 517.87 102.45)" d="m0 0h-13l-23 30h-11v-30h-10v74h28l1-1h4l1-1h1l1-1h1l1-1h1l1-1v-1h1l1-1v-1l1-1h1v-2l1-1v-2l1-1v-11l-1-1v-2l-1-1v-1l-2-2v-1l-4-4h-1l-2-2h-1l-1-1h-1l-1-1zm-21 53v3l-1 1v2l-1 1v1l-2 2h-1v1h-2l-1 1h-4l-1 1h-13v-28h16v1h2l1 1h1l2 2h1v1l1 1v1l1 1v1l1 1v4z" clip-path="url(#clipPath7573)"/>
                <path transform="matrix(.16 0 0 -.16 526.03 102.45)" d="m0 0v74h46v-9h-36v-20h34v-9h-34v-27h36v-9z" clip-path="url(#clipPath7575)"/>
                <path transform="matrix(.16 0 0 -.16 550.67 102.45)" d="m0 0h-11l-32 64v-64h-9v74h14l29-58v58h9z" clip-path="url(#clipPath7577)"/>
                <path transform="matrix(.16 0 0 -.16 564.91 102.61)" d="m0 0h-5l-1 1h-4l-1 1h-2v1h-2l-1 1h-1l-1 1h-1v1h-1l-6 6v1l-2 2v1l-1 1v2l-1 1v1l-1 1v2l-1 1v5l-1 1v14l1 1v5h1v3l1 1v1l1 1v2l1 1v1l3 3v1l5 5h1v1h1l1 1h1l1 1h1l1 1h1l1 1h2l1 1h16l1-1h3l1-1h2l1-1h2l1-1h1l1-1h1l1-1v-12h-1l-1 1v1h-1l-2 2h-1v1h-1l-2 2h-2l-1 1h-1l-1 1h-3l-1 1h-9l-1-1h-3l-1-1h-1l-2-2h-1l-2-2v-1h-1v-1h-1v-1l-1-1v-1l-2-2v-2l-1-1v-2l-1-1v-5l-1-1v-9l1-1v-5l1-1v-3l1-1v-1l1-1v-1l2-2v-1l2-2v-1h1l2-2h1v-1h1l1-1h2l1-1h13l1 1h2l1 1h2l2 2h1l1 1h1l3 3h1v1h1v-12h-2l-1-1h-1l-1-1h-1l-1-1h-1l-1-1h-3l-1-1h-4v-1h-5z" clip-path="url(#clipPath7579)"/>
                <path transform="matrix(.16 0 0 -.16 585.71 102.45)" d="m0 0h-9v36h-34v-36h-10v74h10v-29h34v29h9z" clip-path="url(#clipPath7581)"/>
                <path transform="matrix(.16 0 0 -.16 610.83 102.61)" d="m0 0h-6l-1 1h-5l-1 1h-2l-1 1h-2l-1 1h-1l-1 1h-2l-1 1v12h1l1-1h1v-1h1l2-2h1v-1h1l1-1h1l1-1h2l1-1h2l1-1h13l1 1h2l1 1h1l4 4v2h1v8l-1 1v1l-3 3h-1l-1 1h-1l-1 1h-2l-1 1h-3l-1 1h-3l-1 1h-3l-1 1h-2l-1 1h-1l-1 1h-2l-7 7v1l-1 1v3h-1v10l1 1v2l1 1v1h1v1l1 1v1l1 1h1v1h1l1 1v1h1l1 1h1l1 1h1l1 1h3l1 1h16l1-1h3l1-1h2l1-1h2l1-1h1v-12l-1 1h-1v1h-1l-1 1h-1l-1 1h-1l-1 1h-1v1h-2l-1 1h-3l-1 1h-9l-1-1h-2l-1-1h-1l-1-1h-1l-1-1v-1h-1v-1l-1-1v-1l-1-1v-6l1-1v-2h1v-1l1-1h1l2-2h1l1-1h2l1-1h3l1-1h3l2-1h3v-1h3l1-1h1l1-1h1l1-1h1v-1h1l3-3v-1l2-2v-2l1-1v-11l-1-1v-2l-1-1v-1l-1-1v-1l-5-5h-1v-1h-1l-1-1h-1l-1-1h-2l-1-1h-3l-1-1h-5z" clip-path="url(#clipPath7583)"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3900 9268v65h-25v9h59v-9h-25v-65z" clip-path="url(#clipPath7585)"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4e3 9268h-12v15h12z" clip-path="url(#clipPath7587)"/>
                <path transform="matrix(.16 0 0 -.16 63.307 775.57)" d="m0 0v-51h-9l-56 39v-38h-8v49h8l56-40v41z" clip-path="url(#clipPath7589)"/>
                <path transform="matrix(.16 0 0 -.16 63.307 766.77)" d="m0 0h-73v46h8v-36h20v33h9v-33h27v36h9z" clip-path="url(#clipPath7591)"/>
                <path transform="matrix(.16 0 0 -.16 63.307 742.13)" d="m0 0v-11l-63-32h63v-10h-73v14l58 30h-58v9z" clip-path="url(#clipPath7593)"/>
                <path transform="matrix(.16 0 0 -.16 63.307 724.05)" d="m0 0v-11l-63-33h63v-9h-73v14l58 29h-58v10z" clip-path="url(#clipPath7595)"/>
                <path transform="matrix(.16 0 0 -.16 63.307 710.45)" d="m0 0v-28h-7v9h-59v-9h-7v28h7v-9h59v9z" clip-path="url(#clipPath7597)"/>
                <path transform="matrix(.16 0 0 -.16 63.307 702.61)" d="m0 0-73 25v12l73 25v-10l-20-7v-28l20-7zm-29 42-34-11 34-11z" clip-path="url(#clipPath7599)"/>
                <path transform="matrix(.16 0 0 -.16 63.627 668.85)" d="m0 0v-1l-1-1v-8l-1-1v-4l-1-1v-1l-1-1v-2l-1-1v-1l-1-1v-1h-12v1l2 2v1h1v1l1 1v1l1 1v1l1 1v1l1 1v2l1 1v3h1v11l-1 1v2l-1 1v1l-1 1v1h-1l-1 1v1h-1l-1 1h-2l-1 1h-4l-1-1h-2l-1-1h-1l-3-3v-1l-1-1v-2l-1-1v-2l-1-1v-3l-1-1v-3l-1-1v-4l-1-1v-2h-1v-1l-1-1v-1l-2-2v-1h-1v-1h-1l-2-2h-1v-1h-2l-1-1h-4l-1-1h-3l-1 1h-3l-1 1h-2l-1 1h-1l-3 3h-1v1h-1v1l-1 1v1h-1v1l-1 1v1l-1 1v2l-1 1v3l-1 2v8l1 1v5l1 1v3l1 1v2l1 1v2h1v1h12v-1h-1v-1l-3-3v-1l-1-1v-1l-1-1v-2l-1-1v-2l-1-1v-12h1v-2l1-1v-2h1l1-1v-1h1l1-1h1v-1h8l1 1h2l1 1v1h1l1 1v1l1 1v2l1 1v3l1 1v3l1 1v2l1 1v3l1 1v2l1 2 1 1v1l1 1v1l3 3h1v1h1l1 1h1l1 1h3l1 1h7l1-1h2l1-1h2l2-2h1l5-5v-1l1-1v-1l2-2v-2l1-1v-6l1-1z" clip-path="url(#clipPath7601)"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m379 5826h-65v-25h-8v60h8v-25h65z" clip-path="url(#clipPath7603)"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m379 5927v-12h-14v12z" clip-path="url(#clipPath7605)"/>
                <text transform="matrix(.16 0 0 .16 257.55 1326.5)" clip-path="url(#clipPath7606)" xml:space="preserve"><tspan x="0" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">1</tspan></text>
                <text transform="matrix(.16 0 0 .16 334.51 1341.7)" clip-path="url(#clipPath7607)" xml:space="preserve"><tspan x="0" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">2</tspan></text>
                <text transform="matrix(.16 0 0 .16 438.67 1338.1)" clip-path="url(#clipPath7608)" xml:space="preserve"><tspan x="0" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">3</tspan></text>
                <text transform="matrix(.16 0 0 .16 697.87 1335.4)" clip-path="url(#clipPath7609)" xml:space="preserve"><tspan x="0" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">4</tspan></text>
                <text transform="matrix(.16 0 0 .16 797.23 1337.8)" clip-path="url(#clipPath7610)" xml:space="preserve"><tspan x="0" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">5</tspan></text>
                <text transform="matrix(.16 0 0 .16 695.15 1254.5)" clip-path="url(#clipPath7611)" xml:space="preserve"><tspan x="0" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">8</tspan></text>
                <text transform="matrix(.16 0 0 .16 677.87 1291.1)" clip-path="url(#clipPath7612)" xml:space="preserve"><tspan x="0 46.765999 99.495003 155.976 196.377 245.42101 286.69299 329.03699" y="0" style="fill:#000000;font-family:Verdana;font-size:67px">COMPUTER</tspan></text>
                <text transform="matrix(.16 0 0 .16 677.39 1304.2)" clip-path="url(#clipPath7613)" xml:space="preserve"><tspan x="0 37.319 65.526001 111.488 158.05299 203.881 250.446" y="0" style="fill:#000000;font-family:Verdana;font-size:67px">LIBRARY</tspan></text>
                <text transform="matrix(.16 0 0 .16 791.31 1270.5)" clip-path="url(#clipPath7614)" xml:space="preserve"><tspan x="0" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">7</tspan></text>
                <text transform="matrix(.16 0 0 .16 442.83 1268.1)" clip-path="url(#clipPath7615)" xml:space="preserve"><tspan x="0" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">9</tspan></text>
                <text transform="matrix(.16 0 0 .16 344.59 1268.4)" clip-path="url(#clipPath7616)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">10</tspan></text>
                <text transform="matrix(.16 0 0 .16 408.27 1167.3)" clip-path="url(#clipPath7617)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">11</tspan></text>
                <text transform="matrix(.16 0 0 .16 185.71 612.53)" clip-path="url(#clipPath7618)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">45</tspan></text>
                <text transform="matrix(.16 0 0 .16 195.95 515.09)" clip-path="url(#clipPath7619)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">44</tspan></text>
                <text transform="matrix(.16 0 0 .16 190.83 337.01)" clip-path="url(#clipPath7620)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">42</tspan></text>
                <text transform="matrix(.16 0 0 .16 184.91 424.05)" clip-path="url(#clipPath7621)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">43</tspan></text>
                <text transform="matrix(.16 0 0 .16 186.19 233.17)" clip-path="url(#clipPath7622)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">41</tspan></text>
                <text transform="matrix(.16 0 0 .16 255.95 233.49)" clip-path="url(#clipPath7623)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">40</tspan></text>
                <text transform="matrix(.16 0 0 .16 254.03 336.05)" clip-path="url(#clipPath7624)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">51</tspan></text>
                <text transform="matrix(.16 0 0 .16 257.23 424.53)" clip-path="url(#clipPath7625)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">52</tspan></text>
                <text transform="matrix(.16 0 0 .16 263.79 517.17)" clip-path="url(#clipPath7626)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">53</tspan></text>
                <text transform="matrix(.16 0 0 .16 259.79 615.73)" clip-path="url(#clipPath7627)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">54</tspan></text>
                <text transform="matrix(.16 0 0 .16 254.03 916.69)" clip-path="url(#clipPath7628)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">56</tspan></text>
                <text transform="matrix(.16 0 0 .16 253.39 1017.2)" clip-path="url(#clipPath7629)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">57</tspan></text>
                <text transform="matrix(.16 0 0 .16 255.15 1122.5)" clip-path="url(#clipPath7630)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">58</tspan></text>
                <text transform="matrix(.16 0 0 .16 251.79 1212.9)" clip-path="url(#clipPath7631)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">59</tspan></text>
                <text transform="matrix(.16 0 0 .16 950.35 1232.4)" clip-path="url(#clipPath7632)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">15</tspan></text>
                <text transform="matrix(.16 0 0 .16 753.23 229.17)" clip-path="url(#clipPath7633)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">35</tspan></text>
                <text transform="matrix(.16 0 0 .16 951.95 1129.5)" clip-path="url(#clipPath7634)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">16</tspan></text>
                <text transform="matrix(.16 0 0 .16 956.43 934.93)" clip-path="url(#clipPath7635)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">18</tspan></text>
                <text transform="matrix(.16 0 0 .16 951.47 817.97)" clip-path="url(#clipPath7636)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">19</tspan></text>
                <text transform="matrix(.16 0 0 .16 964.11 616.53)" clip-path="url(#clipPath7637)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">20</tspan></text>
                <text transform="matrix(.16 0 0 .16 962.19 517.81)" clip-path="url(#clipPath7638)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">21</tspan></text>
                <text transform="matrix(.16 0 0 .16 956.75 420.53)" clip-path="url(#clipPath7639)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">22</tspan></text>
                <text transform="matrix(.16 0 0 .16 955.63 326.77)" clip-path="url(#clipPath7640)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">23</tspan></text>
                <text transform="matrix(.16 0 0 .16 954.99 229.49)" clip-path="url(#clipPath7641)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">33</tspan></text>
                <text transform="matrix(.16 0 0 .16 880.11 230.93)" clip-path="url(#clipPath7642)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">34</tspan></text>
                <text transform="matrix(.16 0 0 .16 875.31 324.53)" clip-path="url(#clipPath7643)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">32</tspan></text>
                <text transform="matrix(.16 0 0 .16 881.23 421.97)" clip-path="url(#clipPath7644)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">31</tspan></text>
                <text transform="matrix(.16 0 0 .16 874.83 522.61)" clip-path="url(#clipPath7645)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">30</tspan></text>
                <text transform="matrix(.16 0 0 .16 877.23 615.73)" clip-path="url(#clipPath7646)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">29</tspan></text>
                <text transform="matrix(.16 0 0 .16 878.19 817.97)" clip-path="url(#clipPath7647)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">28</tspan></text>
                <text transform="matrix(.16 0 0 .16 884.91 935.89)" clip-path="url(#clipPath7648)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">27</tspan></text>
                <text transform="matrix(.16 0 0 .16 877.23 1031.6)" clip-path="url(#clipPath7649)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">26</tspan></text>
                <text transform="matrix(.16 0 0 .16 876.91 1132.4)" clip-path="url(#clipPath7650)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">25</tspan></text>
                <text transform="matrix(.16 0 0 .16 890.51 1236.7)" clip-path="url(#clipPath7651)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">24</tspan></text>
                <text transform="matrix(.16 0 0 .16 677.87 224.21)" clip-path="url(#clipPath7652)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">36</tspan></text>
                <text transform="matrix(.16 0 0 .16 543.63 233.65)" clip-path="url(#clipPath7653)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">37</tspan></text>
                <text transform="matrix(.16 0 0 .16 432.83 315.37)" clip-path="url(#clipPath7654)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">38</tspan></text>
                <text transform="matrix(.16 0 0 .16 370.35 231.41)" clip-path="url(#clipPath7655)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">39</tspan></text>
                <text transform="matrix(.16 0 0 .16 358.83 1031.3)" clip-path="url(#clipPath7656)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">61</tspan></text>
                <text transform="matrix(.16 0 0 .16 460.27 1130.8)" clip-path="url(#clipPath7657)" xml:space="preserve"><tspan x="0 25.872 55.062 81.606003 110.334 139.062" y="0" style="fill:#000000;font-family:Verdana;font-size:42px">TREAS.</tspan></text>
                <text transform="matrix(.16 0 0 .16 459.79 1139.1)" clip-path="url(#clipPath7658)" xml:space="preserve"><tspan x="0 28.728001 54.599998 87.653999 116.844" y="0" style="fill:#000000;font-family:Verdana;font-size:42px">STORE</tspan></text>
                <text transform="matrix(.16 0 0 .16 459.63 1147.3)" clip-path="url(#clipPath7659)" xml:space="preserve"><tspan x="0 29.190001 64.596001" y="0" style="fill:#000000;font-family:Verdana;font-size:42px">RM.</tspan></text>
                <text transform="matrix(.16 0 0 .16 805.07 1122.9)" clip-path="url(#clipPath7660)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">68</tspan></text>
                <text transform="matrix(.16 0 0 .16 782.99 1027.3)" clip-path="url(#clipPath7661)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">67</tspan></text>
                <text transform="matrix(.16 0 0 .16 778.19 947.89)" clip-path="url(#clipPath7662)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">66</tspan></text>
                <text transform="matrix(.16 0 0 .16 338.51 1111.9)" clip-path="url(#clipPath7663)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">60</tspan></text>
                <text transform="matrix(.16 0 0 .16 357.07 953.17)" clip-path="url(#clipPath7664)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">62</tspan></text>
                <text transform="matrix(.16 0 0 .16 477.55 335.89)" clip-path="url(#clipPath7665)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">63</tspan></text>
                <text transform="matrix(.16 0 0 .16 570.67 333.17)" clip-path="url(#clipPath7666)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">64</tspan></text>
                <text transform="matrix(.16 0 0 .16 653.87 339.89)" clip-path="url(#clipPath7667)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">65</tspan></text>
                <text transform="matrix(.16 0 0 .16 951.95 1030.6)" clip-path="url(#clipPath7668)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">17</tspan></text>
                <text transform="matrix(.16 0 0 .16 468.91 1165.3)" clip-path="url(#clipPath7669)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">12</tspan></text>
                <text transform="matrix(.16 0 0 .16 669.71 1165.8)" clip-path="url(#clipPath7670)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">13</tspan></text>
                <text transform="matrix(.16 0 0 .16 726.35 1167.7)" clip-path="url(#clipPath7671)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">14</tspan></text>
                <text transform="matrix(.16 0 0 .16 182.67 915.41)" clip-path="url(#clipPath7672)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">47</tspan></text>
                <text transform="matrix(.16 0 0 .16 183.31 1017.5)" clip-path="url(#clipPath7673)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">48</tspan></text>
                <text transform="matrix(.16 0 0 .16 185.55 1120.7)" clip-path="url(#clipPath7674)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">49</tspan></text>
                <text transform="matrix(.16 0 0 .16 184.11 1231.6)" clip-path="url(#clipPath7675)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">50</tspan></text>
                <text transform="matrix(.16 0 0 .16 526.83 1143.4)" clip-path="url(#clipPath7676)" xml:space="preserve"><tspan x="0 17.681999 49.098 73.248001 106.302 121.59 136.37399 165.10201 194.29201 220.836" y="0" style="fill:#000000;font-family:Verdana;font-size:42px">INFO. AREA</tspan></text>
                <text transform="matrix(.16 0 0 .16 176.91 816.53)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">46</tspan></text>
                <text transform="matrix(.16 0 0 .16 257.23 814.77)" xml:space="preserve"><tspan x="0 64.236" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">55</tspan></text>
                <text transform="matrix(.16 0 0 .16 884.75 1325.8)" xml:space="preserve"><tspan x="0" y="0" style="fill:#000000;font-family:Verdana;font-size:101px">6</tspan></text>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5785 522h420" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:3;stroke:#000"/>
                <path transform="matrix(.16 0 0 .16 945.07 1508.4)" d="m5.8577-1.5521c2.7344-0.048828 5.0293-0.29297 6.9336-0.68359 1.9531-0.43945 3.6377-1.0254 5.0781-1.7578 1.9531-1.0986 3.5645-2.8809 4.8828-5.3711 1.3672-2.4658 2.0508-5.0049 2.0508-7.6172 0-3.3691-0.83008-5.8594-2.4414-7.4219-1.6357-1.6113-4.1748-2.4414-7.6172-2.4414-0.78125 0-1.9287 0.07324-3.418 0.19531-1.5137 0.14648-3.418 0.36621-5.7617 0.68359 0.12207 1.9531 0.19531 4.1992 0.19531 6.7383 0.048828 2.5391 0.097656 5.4199 0.097656 8.5938v5.0781c0 1.3672 0 2.71 3e-7 4.0039zm-0.19531-26.465c2.1484-0.24414 3.9551-0.43945 5.4688-0.58594 1.5625-0.19531 2.8809-0.29297 4.0039-0.29297 3.9551 0 6.9336 1.0254 8.8867 3.0273 2.002 1.9531 3.0273 4.8828 3.0273 8.7891 0 3.0029-0.75684 5.8594-2.2461 8.5937-1.4404 2.6855-3.2959 4.6875-5.5664 6.0547-1.6357 0.97656-3.5889 1.7334-5.8594 2.2461-2.2949 0.43945-4.9316 0.68359-7.9102 0.68359-0.65918 0-1.1475-0.1709-1.4648-0.48828-0.26855-0.24414-0.39062-0.78125-0.39062-1.5625 0-0.12207 0.024414-1.3672 0.097656-3.7109 0.12207-2.3438 0.19531-4.5898 0.19531-6.7383 0-5.0049-0.14648-9.79-0.39062-14.355-0.073242-0.63476-0.097656-1.0254-0.097656-1.1719 0-0.43945 0.097656-0.78125 0.29297-0.97656 0.19531-0.19531 0.43945-0.29297 0.78125-0.29297 0.31738 0 0.58594 0.07324 0.78125 0.19531 0.19531 0.14648 0.31738 0.3418 0.39062 0.58594zm29.541 10.254c5.3955 0 9.2285-0.41504 11.523-1.2695 2.2705-0.83008 3.418-2.1973 3.418-4.1016 0-1.2939-0.46387-2.2461-1.3672-2.832-0.92773-0.63476-2.3193-0.97656-4.1992-0.97656-1.0498 0-2.3438 0.07324-3.9062 0.19531-1.5137 0.14648-3.3203 0.36621-5.4688 0.68359zm-2.1484-9.9609c0-0.43945 0.09766-0.78125 0.29297-0.97656 0.19531-0.24414 0.48828-0.39062 0.87891-0.39062 0.24414 0 0.43945 0.09766 0.58594 0.29297 0.19531 0.14648 0.29297 0.36621 0.29297 0.68359 2.1484-0.24414 4.0039-0.43945 5.5664-0.58594 1.5625-0.12207 2.9297-0.19531 4.1016-0.19531 2.4658 0 4.3457 0.48828 5.6641 1.4648 1.2939 0.97656 1.9531 2.3926 1.9531 4.1992 0 2.4902-1.1719 4.2969-3.5156 5.4688s-5.957 1.8066-10.84 1.8555c3.5645 3.125 6.665 5.7617 9.2773 7.9102 2.5879 2.1484 4.9072 3.9795 6.9336 5.4688 0.39062 0.26855 0.87891 0.58594 1.4648 0.97656 1.1719 0.85449 1.7578 1.4648 1.7578 1.8555 0 0.24414-0.09766 0.48828-0.29297 0.68359-0.14648 0.19531-0.3418 0.29297-0.58594 0.29297-0.58594 0-2.9053-1.5869-6.9336-4.7852-3.9795-3.2471-8.8379-7.4463-14.551-12.598l0.48828 15.039v0.097656c0 0.39062-0.09766 0.68359-0.29297 0.87891-0.19531 0.19531-0.46387 0.29297-0.78125 0.29297-0.39062 0-0.68359-0.097656-0.87891-0.29297-0.14648-0.24414-0.19531-0.58594-0.19531-0.97656zm36.353 1.2695c-1.6357 3.7842-2.9053 6.8115-3.8086 9.082-0.92773 2.2949-1.709 4.3457-2.3438 6.1523l11.816-0.87891c-1.123-2.3438-2.1484-4.6875-3.125-7.0312-0.92774-2.3926-1.7578-4.834-2.5391-7.3242zm6.4453 16.406-13.281 0.87891c-0.53711 1.4404-1.123 3.2227-1.7578 5.3711-0.78125 2.5391-1.4648 3.8086-2.0508 3.8086-0.3418 0-0.58594-0.097656-0.78125-0.29297-0.19531-0.19531-0.29297-0.41504-0.29297-0.68359 0-0.39062 0.5127-2.1484 1.5625-5.2734 1.0986-3.1738 2.4414-6.7383 4.0039-10.645 0.19531-0.58594 0.5127-1.416 0.97656-2.5391 2.5879-6.6406 4.2969-9.9609 5.0781-9.9609 0.70801 0 1.4893 1.2207 2.3438 3.6133 0.43945 1.3184 0.83008 2.3438 1.1719 3.125 2.0752 5.2734 4.248 10.254 6.543 14.941 2.3438 4.6875 3.5156 7.0313 3.5156 7.0313 0 0.3418-0.14648 0.58594-0.39062 0.78125-0.19531 0.19531-0.43945 0.29297-0.68359 0.29297-0.58594 0-1.8555-2.002-3.8086-6.0547-0.85449-1.8066-1.5625-3.2715-2.1484-4.3945zm13.232-9.9609c4.3457-0.12207 8.5938-0.41504 12.695-0.87891 0.70801-0.12207 1.123-0.19531 1.2695-0.19531 0.39063 0 0.68359 0.09766 0.87891 0.29297 0.24414 0.19531 0.39062 0.46387 0.39062 0.78125 0 0.78125-2.7832 1.3184-8.3008 1.5625-2.8076 0.19531-5.0781 0.3418-6.8359 0.39062v0.87891c0.04883 2.2949 0.09766 3.9062 0.09766 4.8828v1.3672c0 5.1514-0.14648 8.374-0.39062 9.668-0.19531 1.2451-0.58594 1.8555-1.1719 1.8555-0.26856 0-0.48828-0.14648-0.68359-0.39062-0.14648-0.24414-0.19531-0.61035-0.19531-1.0742v-0.78125c0.24414-3.2471 0.39062-6.665 0.39062-10.254 0-5.0049-0.19531-9.6924-0.58594-14.062v-0.87891c0-0.58594 0.12207-0.97656 0.39062-1.1719 0.31738-0.19531 0.92774-0.29297 1.8555-0.29297 4.541-0.19531 9.082-0.48828 13.574-0.87891 0.90332-0.04883 1.416-0.09766 1.5625-0.09766 0.43946 0 0.78125 0.09766 0.97657 0.29297 0.24414 0.14648 0.39062 0.36621 0.39062 0.68359 0 0.85449-2.7344 1.3672-8.2031 1.5625-3.4668 0.14648-6.2988 0.26856-8.4961 0.39062 0.04883 0.73242 0.12207 1.5381 0.19531 2.4414 0.04883 0.92774 0.12207 2.2217 0.19531 3.9062zm36.987-9.375h0.19531c0.31739 0 0.58594 0.09766 0.78125 0.29297 0.19532 0.14648 0.29297 0.36621 0.29297 0.68359 0 0.3418-0.0976 0.58594-0.29297 0.78125-0.19531 0.14648-0.53711 0.19531-0.97656 0.19531l-8.9844 0.78125 0.29296 25.781c0 0.46387-0.0977 0.83008-0.29296 1.0742-0.14649 0.24414-0.39063 0.39062-0.78125 0.39062-0.26856 0-0.48829-0.14648-0.6836-0.39062-0.19531-0.24414-0.29297-0.61035-0.29297-1.0742l-0.29297-25.586h-0.8789c-3.9062 0.26856-6.2256 0.39062-6.9336 0.39062-0.5371 0-0.92773-0.09766-1.1719-0.29297-0.24414-0.19531-0.39063-0.43945-0.39063-0.78125 0-0.31738 0.0977-0.53711 0.29297-0.68359 0.24414-0.19531 0.63477-0.29297 1.1719-0.29297 0.70801 0 1.8555-0.02441 3.418-0.09766 1.5625-0.04883 3.2715-0.19531 5.1758-0.39062zm23.315 4.1992c-0.26855 0-0.56152-0.14648-0.87891-0.48828-0.14648-0.12207-0.24414-0.21973-0.29296-0.29297-0.65918-0.58594-1.416-1.001-2.2461-1.2695-0.85449-0.31738-1.831-0.48828-2.9297-0.48828-3.125 0-5.7373 0.65918-7.8125 1.9531-2.0996 1.2451-3.125 2.7832-3.125 4.5898 0 1.0498 0.31739 1.8311 0.97657 2.3438 0.63476 0.53711 1.5869 0.78125 2.832 0.78125 1.2207 0 3.0518-0.21973 5.4688-0.68359 2.4658-0.5127 4.2969-0.78125 5.4688-0.78125 2.2705 0 4.0527 0.68359 5.3711 2.0508 1.3672 1.3672 2.0508 3.2227 2.0508 5.5664 0 3.7109-1.5625 6.7871-4.6875 9.1797-3.125 2.417-7.1289 3.6133-12.012 3.6133-2.2949 0-4.248-0.56152-5.8594-1.6602-1.5625-1.0986-2.3438-2.2949-2.3438-3.6133 0-0.24414 0.0488-0.48828 0.19531-0.68359 0.19531-0.19531 0.41504-0.29297 0.6836-0.29297 0.39062 0 0.708 0.29297 0.97656 0.87891 0.19531 0.19531 0.31738 0.36621 0.39062 0.48828 0.70801 1.123 1.5137 1.9043 2.4414 2.3438 0.90332 0.39062 2.1484 0.58594 3.7109 0.58594 4.1504 0 7.5684-1.001 10.254-3.0273 2.7344-2.0752 4.1016-4.6387 4.1016-7.7148 0-1.8066-0.48829-3.2227-1.4648-4.1992-0.97656-0.97656-2.3438-1.4648-4.1016-1.4648-1.0498 0-2.7832 0.26856-5.1758 0.78125-2.3438 0.46387-4.1504 0.68359-5.3711 0.68359-1.9043 0-3.3691-0.41504-4.3945-1.2695-1.0498-0.90332-1.5625-2.1729-1.5625-3.8086 0-2.3926 1.2207-4.4189 3.7109-6.0547 2.4658-1.6846 5.5664-2.5391 9.2773-2.5391 1.9531 0 3.6377 0.36621 5.0781 1.0742 1.416 0.73242 2.1484 1.5381 2.1484 2.4414 0 0.26855-0.0977 0.48828-0.29297 0.68359-0.14649 0.19531-0.3418 0.29297-0.58594 0.29297zm12.769 0.39062c0.0488 3.2715 0.0977 6.1523 0.0977 8.6914 0.0488 2.5391 0.0977 4.2725 0.0977 5.1758 0 1.3672-0.0488 3.0273-0.0977 4.9805v3.7109 1.5625c0 0.46387-0.0977 0.78125-0.29297 0.97656-0.19531 0.24414-0.48828 0.39062-0.8789 0.39062-0.3418 0-0.58594-0.14648-0.78125-0.39062-0.14649-0.26855-0.19532-0.63477-0.19532-1.1719v-0.68359c0.12207-2.1973 0.19532-4.4922 0.19532-6.8359 0-6.4941-0.14649-12.5-0.39063-17.969-0.0732-0.58594-0.0977-0.90332-0.0977-0.97656 0-0.39062 0.12207-0.70801 0.39062-0.97656 0.24414-0.24414 0.58594-0.39062 0.97656-0.39062 0.90332 0 2.0508 1.416 3.418 4.1992 0.43945 0.85449 0.78125 1.5137 0.97656 1.9531 1.1719 2.2949 2.4902 5.1758 4.0039 8.6914 1.5625 3.5156 3.1494 7.3975 4.7852 11.621 2.3926-4.2236 5.4932-10.742 9.2773-19.531 0.78125-1.8799 1.3672-3.2715 1.7578-4.1992 0.63477-1.416 1.0986-2.2949 1.3672-2.6367 0.31738-0.39062 0.68359-0.58594 1.0742-0.58594 0.39062 0 0.68359 0.14648 0.87891 0.39062 0.24414 0.19531 0.39062 0.53711 0.39062 0.97656l0.29297 26.66c0 0.39062-0.0977 0.73242-0.29297 0.97656-0.19531 0.24414-0.43945 0.39062-0.68359 0.39062-0.3418 0-0.58594-0.14648-0.78125-0.39062-0.14649-0.24414-0.19532-0.58594-0.19532-0.97656l-0.29296-23.828c-4.8828 11.133-8.1055 18.237-9.668 21.289-1.5625 3.0029-2.6367 4.4922-3.2227 4.4922-0.3418 0-0.63477-0.19531-0.87891-0.58594-0.26855-0.31738-0.63476-1.0254-1.0742-2.1484-0.0733-0.19531-0.1709-0.48828-0.29297-0.87891-3.6621-9.3018-6.9336-16.626-9.8633-21.973zm44.409-1.6602c-1.6358 3.7842-2.9053 6.8115-3.8086 9.082-0.92773 2.2949-1.709 4.3457-2.3438 6.1523l11.816-0.87891c-1.123-2.3438-2.1484-4.6875-3.125-7.0312-0.92774-2.3926-1.7578-4.834-2.5391-7.3242zm6.4453 16.406-13.281 0.87891c-0.53711 1.4404-1.123 3.2227-1.7578 5.3711-0.78125 2.5391-1.4648 3.8086-2.0508 3.8086-0.34179 0-0.58593-0.097656-0.78125-0.29297-0.19531-0.19531-0.29296-0.41504-0.29296-0.68359 0-0.39062 0.51269-2.1484 1.5625-5.2734 1.0986-3.1738 2.4414-6.7383 4.0039-10.645 0.19531-0.58594 0.5127-1.416 0.97656-2.5391 2.5879-6.6406 4.2969-9.9609 5.0781-9.9609 0.70801 0 1.4893 1.2207 2.3438 3.6133 0.43945 1.3184 0.83008 2.3438 1.1719 3.125 2.0752 5.2734 4.248 10.254 6.543 14.941 2.3438 4.6875 3.5156 7.0313 3.5156 7.0313 0 0.3418-0.14649 0.58594-0.39063 0.78125-0.19531 0.19531-0.43945 0.29297-0.68359 0.29297-0.58594 0-1.8555-2.002-3.8086-6.0547-0.8545-1.8066-1.5625-3.2715-2.1484-4.3945zm12.915-14.551 0.39062 23.535c0 0.46387-0.0977 0.78125-0.29297 0.97656-0.19531 0.19531-0.46386 0.29297-0.78125 0.29297-0.34179 0-0.58593-0.097656-0.78125-0.29297-0.14648-0.24414-0.19531-0.58594-0.19531-0.97656l-0.29297-25.879c0-0.83008 0.0488-1.3916 0.19531-1.6602 0.19532-0.31738 0.48829-0.48828 0.87891-0.48828 0.43945 0 0.92773 0.46387 1.4648 1.3672 0.12207 0.26855 0.21973 0.46387 0.29297 0.58594 2.9297 5.3467 5.6152 9.9609 8.1055 13.867 2.4658 3.9062 4.7852 7.2754 6.9336 10.059v-3.2227-4.7852c0-3.7109 0.0244-7.1289 0.0977-10.254 0.0488-3.125 0.12207-5.1758 0.19531-6.1523 0-0.39062 0.0488-0.68359 0.19532-0.87891 0.19531-0.19531 0.43945-0.29297 0.78125-0.29297 0.39062 0 0.68359 0.09766 0.8789 0.29297 0.19532 0.19531 0.29297 0.53711 0.29297 0.97656 0 0.14648-0.0488 0.53711-0.0977 1.1719-0.26856 4.4434-0.39063 9.0332-0.39063 13.77 0 3.2715 0.0488 6.6895 0.19531 10.254v1.7578c0 0.46387-0.0977 0.80566-0.29297 1.0742-0.14648 0.24414-0.36621 0.39062-0.68359 0.39062-0.73242 0-2.71-2.3682-5.957-7.1289-3.1982-4.8096-6.9092-10.937-11.133-18.359zm25.806 14.258c3.0518 0 5.9814-0.12207 8.7891-0.39062 0.43946-0.04883 0.70801-0.09766 0.78125-0.09766 0.31739 0 0.58594 0.09766 0.78125 0.29297 0.19532 0.14648 0.29297 0.3418 0.29297 0.58594 0 0.53711-0.68359 0.92773-2.0508 1.1719-1.3184 0.19531-3.9551 0.29297-7.9102 0.29297h-0.78125c-0.5371 0-0.92773-0.048828-1.1719-0.19531-0.19531-0.19531-0.29297-0.43945-0.29297-0.78125 0-0.31738 0.0977-0.53711 0.29297-0.68359 0.19531-0.12207 0.61035-0.19531 1.2695-0.19531zm18.628-1.3672c0 1.8311 0.0244 3.9062 0.0977 6.25 0.12207 2.3438 0.19531 3.7842 0.19531 4.2969 0 0.53711-0.0977 0.92773-0.29297 1.1719-0.19531 0.19531-0.46387 0.29297-0.78125 0.29297-0.3418 0-0.58594-0.097656-0.78125-0.29297-0.14648-0.12207-0.24414-0.39062-0.29297-0.78125v-0.097656c-0.14648-3.125-0.19531-7.0312-0.19531-11.719 0-5.5908 0.0977-10.498 0.29297-14.746 0.0488-0.12207 0.0976-0.21973 0.0976-0.29297 0-0.39062 0.0488-0.68359 0.19532-0.87891 0.19531-0.19531 0.43945-0.29297 0.78125-0.29297 0.39062 0 0.68359 0.09766 0.8789 0.29297 0.19532 0.19531 0.29297 0.53711 0.29297 0.97656 0 0.14648-0.0488 0.53711-0.0976 1.1719-0.26856 4.6875-0.39063 9.5703-0.39063 14.648zm11.182 0c0 1.8311 0.0244 3.9062 0.0977 6.25 0.12207 2.3438 0.19531 3.7842 0.19531 4.2969 0 0.53711-0.0977 0.92773-0.29297 1.1719-0.19531 0.19531-0.46387 0.29297-0.78125 0.29297-0.3418 0-0.58594-0.097656-0.78125-0.29297-0.14648-0.12207-0.24414-0.39062-0.29297-0.78125v-0.097656c-0.14648-3.125-0.19531-7.0312-0.19531-11.719 0-5.5908 0.0977-10.498 0.29297-14.746 0.0488-0.12207 0.0976-0.21973 0.0976-0.29297 0-0.39062 0.0488-0.68359 0.19532-0.87891 0.19531-0.19531 0.43945-0.29297 0.78125-0.29297 0.39062 0 0.68359 0.09766 0.8789 0.29297 0.19532 0.19531 0.29297 0.53711 0.29297 0.97656 0 0.14648-0.0488 0.53711-0.0977 1.1719-0.26856 4.6875-0.39063 9.5703-0.39063 14.648z" clip-path="url(#clipPath7682)" aria-label="DRAFTSMAN-II"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m798 1432 271-271" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#000"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 8783v386" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6201 8783v386" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1042 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1063 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1069 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1090 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1096 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1118 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1124 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1146 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1152 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1173 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1179 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1201 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1207 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1228 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1234 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1256 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1262 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1284 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1290 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1311 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1317 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1339 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1345 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1366 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1372 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1394 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1400 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1422 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1428 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1449 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1455 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1477 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1483 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1504 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1510 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1532 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1538 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1559 9165h4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1566 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1587 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1593 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1615 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1621 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1642 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1648 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1670 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1676 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1697 9165h4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1704 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1725 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1731 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1753 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1759 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1780 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1786 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1808 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1814 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1835 9165h4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1842 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1863 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1869 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1891 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1897 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1918 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1924 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1946 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1952 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1973 9165h4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1980 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2001 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2007 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2035 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2056 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2062 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2084 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2090 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2111 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2139 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2145 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2173 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2194 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2200 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2222 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2228 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2249 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2256 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2277 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2283 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2311 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2360 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2366 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2387 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2394 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2415 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2421 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2443 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2449 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2498 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2504 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2525 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2531 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2553 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2559 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2581 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2587 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2608 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2614 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2636 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2642 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2663 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2669 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2691 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2697 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2719 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2725 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2746 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2752 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2774 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2780 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2801 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2807 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2829 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2835 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2857 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2863 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2884 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2890 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2912 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2918 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2939 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2945 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2967 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2973 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2994 9165h4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3001 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3022 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3050 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3056 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3077 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3083 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3105 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3111 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3132 9165h4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3139 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3160 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3166 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3188 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3194 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3215 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3221 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3243 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3249 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3270 9165h4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3277 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3298 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3304 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3326 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3332 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3353 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3359 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3381 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3387 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3408 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3415 9165h18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3436 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3442 9165h19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3464 9165h3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3470 9165h17" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6177 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6156 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6150 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6129 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6122 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6101 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6095 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6073 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6067 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6046 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6040 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6018 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6012 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5991 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5984 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5963 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5957 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5935 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5929 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5908 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5902 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5880 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5874 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5853 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5847 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5825 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5819 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5797 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5791 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5770 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5764 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5742 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5736 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5715 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5709 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5687 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5659 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5653 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5632 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5626 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5604 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5598 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5577 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5571 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5549 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5543 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5521 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5515 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5494 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5488 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5466 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5460 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5439 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5433 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5411 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5405 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5384 9165h-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5377 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5356 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5350 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5328 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5322 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5301 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5295 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5273 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5267 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5246 9165h-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5239 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5218 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5212 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5190 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5184 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5163 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5157 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5135 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5129 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 9165h-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5101 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5080 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5074 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5052 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5046 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5025 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5019 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4997 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4991 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4970 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4963 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4936 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4914 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4908 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4887 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4853 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4832 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4825 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4804 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4798 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4776 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4770 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4749 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4743 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4721 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4715 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4694 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4687 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4666 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4660 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4638 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4632 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4611 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4605 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4577 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4556 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4550 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4528 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4522 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4500 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4473 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4467 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4445 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4439 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4418 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4412 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4390 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4384 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4362 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4356 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4335 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4329 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4307 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4301 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4280 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4274 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4252 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4246 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4224 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4218 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4197 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4169 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4163 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4142 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4136 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4114 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4108 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4087 9165h-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4080 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4059 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4053 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4031 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4025 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4004 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3998 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3976 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3970 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3949 9165h-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3942 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3921 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3915 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3893 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3887 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3866 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3860 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3838 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3832 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3811 9165h-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3804 9165h-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3783 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3777 9165h-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3755 9165h-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3749 9165h-17" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1042 9169v-8l-24 4z" style="fill:#0f0;stroke-linecap:round;stroke-miterlimit:10;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6177 9169v-8l24 4z" style="fill:#0f0;stroke-linecap:round;stroke-miterlimit:10;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1457 8760h-895" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1457 1381h-895" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8736v-14" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8719v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8712v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8691v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8685v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8663v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8657v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8636v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8630v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8608v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8602v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8581v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8574v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8553v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8547v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8525v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8519v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8498v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8492v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8470v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8464v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8443v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8437v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8415v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8409v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8387v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8381v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8360v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8354v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8332v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8326v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8305v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8299v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8277v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8271v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8249v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8243v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8222v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8216v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8194v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8188v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8167v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8161v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8139v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8133v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8112v-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8105v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8084v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8078v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8056v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8050v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8029v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8023v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 8001v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7995v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7974v-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7967v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7946v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7940v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7918v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7912v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7891v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7885v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7863v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7857v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7836v-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7829v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7808v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7802v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7780v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7774v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7753v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7747v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7725v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7719v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7698v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7691v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7670v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7664v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7642v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7636v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7615v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7609v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7587v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7581v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7560v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7553v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7532v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7526v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7504v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7498v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7477v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7471v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7449v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7443v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7422v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7415v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7394v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7388v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7366v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7360v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7339v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7333v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7311v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7305v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7284v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7278v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7256v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7250v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7228v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7222v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7201v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7195v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7173v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7167v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7146v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7140v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7118v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7112v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7090v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7084v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7063v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7057v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7035v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7029v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7008v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 7002v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6980v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6974v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6953v-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6946v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6925v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6919v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6897v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6891v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6870v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6864v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6842v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6836v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6815v-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6808v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6787v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6781v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6759v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6753v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6732v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6726v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6704v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6698v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6677v-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6670v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6649v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6643v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6621v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6615v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6594v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6588v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6566v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6560v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6539v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6532v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6511v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6505v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6483v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6477v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6456v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6450v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6428v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6422v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6401v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6394v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6373v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6367v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6345v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6339v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6318v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6312v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6290v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6284v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6263v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6256v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6235v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6229v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6207v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6201v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6180v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6174v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6152v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6146v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6125v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6119v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6097v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6091v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6069v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6063v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6042v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6036v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6014v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 6008v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5987v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5981v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5959v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5953v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5931v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5925v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5904v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5898v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5876v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5870v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5849v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5843v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5821v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5815v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5793v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5787v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5766v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5760v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5738v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5732v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5711v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5705v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5683v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5677v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5656v-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5649v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5628v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5622v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5600v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5594v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5573v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5567v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5545v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5539v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5518v-4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5511v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5490v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5484v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5462v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5456v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5435v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5429v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5407v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5401v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5380v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5373v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5352v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5346v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5324v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5318v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5297v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5291v-19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5269v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5263v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5242v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5235v-18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5214v-3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 5208v-14" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1406v14" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1423v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1429v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1451v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1457v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1478v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1484v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1506v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1512v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1533v4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1540v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1561v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1567v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1589v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1595v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1616v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1622v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1644v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1650v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1671v4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1678v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1699v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1705v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1727v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1733v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1754v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1760v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1782v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1788v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1809v4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1816v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1837v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1843v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1865v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1871v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1892v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1898v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1920v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1926v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1947v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1954v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1975v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 1981v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2003v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2009v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2030v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2036v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2058v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2064v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2085v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2092v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2113v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2119v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2141v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2147v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2168v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2174v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2196v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2202v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2223v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2230v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2251v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2257v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2279v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2285v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2306v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2312v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2334v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2340v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2361v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2367v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2389v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2395v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2417v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2423v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2444v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2450v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2472v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2478v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2499v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2505v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2527v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2533v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2555v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2561v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2582v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2588v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2610v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2616v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2637v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2643v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2665v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2671v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2692v4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2699v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2720v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2726v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2748v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2754v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2775v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2781v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2803v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2809v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2830v4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2837v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2858v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2864v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2886v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2892v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2913v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2919v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2941v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2947v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2968v4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2975v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 2996v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3002v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3024v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3030v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3051v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3057v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3079v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3085v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3106v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3113v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3134v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3140v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3162v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3168v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3189v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3195v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3217v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3223v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3244v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3251v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3272v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3278v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3300v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3306v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3327v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3333v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3355v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3361v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3382v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3389v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3410v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3416v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3438v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3444v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3465v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3471v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3493v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3499v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3520v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3526v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3548v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3554v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3576v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3582v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3603v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3609v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3631v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3637v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3658v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3664v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3686v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3692v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3714v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3720v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3741v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3747v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3769v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3775v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3796v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3802v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3824v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3830v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3851v4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3858v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3879v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3885v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3907v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3913v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3934v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3940v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3962v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3968v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3989v4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 3996v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4017v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4023v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4045v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4051v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4072v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4078v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4100v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4106v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4127v4" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4134v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4155v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4161v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4183v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4189v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4210v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4216v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4238v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4244v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4265v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4272v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4293v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4299v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4321v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4327v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4348v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4354v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4376v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4382v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4403v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4410v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4431v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4437v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4459v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4465v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4486v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4492v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4514v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4520v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4541v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4548v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4569v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4575v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4597v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4603v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4624v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4630v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4652v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4658v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4679v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4685v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4707v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4713v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4735v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4741v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4762v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4768v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4790v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4796v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4817v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4823v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4845v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4851v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4873v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4879v18" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4900v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4906v19" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4928v3" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m567 4934v14" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-width:2;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m563 8736h8l-4 24z" style="fill:#0f0;stroke-linecap:round;stroke-miterlimit:10;stroke:#0f0"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m563 1406h8l-4-25z" style="fill:#0f0;stroke-linecap:round;stroke-miterlimit:10;stroke:#0f0"/>
              </g>

              <?php foreach ($vendors as $stall_no => $status): ?>
                <?php $path = isset($svg_paths[$stall_no]) ? $svg_paths[$stall_no] : ''; ?>
            
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>" onclick="checkStall(this)">
                <g>
                  <path id="1" d="m234.12 1330.3-1.4452 35.406 66.477-2.1677 0.72258-83.096z<?php echo $path; ?>" style="opacity:0"/>
                </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
                <g>
                  <path id="2" d="m299.87 1297.7-1.4452 67.922 101.16-0.7225-0.72258-65.032z" style="opacity:0"/>
                </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="4" d="m661.88 1279.7-0.72258 84.542 101.16 2.1677-2.1677-86.709z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="5" d="m760.87 1300.6 2.1677 64.309 97.548 0.7225-2.8903-67.2z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="6" d="m859.87 1279v86.709l68.645 0.7226-2.1677-35.406z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="7" d="m760.87 1221.2v76.593l99.716 1.4452v-18.787l-62.142-60.696z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="8" d="m661.16 1277.5 96.825 0.7226 0.72258-58.529-97.548-0.7226z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="9" d="m402.48 1219-2.1677 78.038 97.548 0.7225 1.4452-75.871z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="10" d="m301.31 1279.7v18.787l97.548-0.7226v-79.484l-35.406 2.8903z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="11" d="m365.62 1183.6 62.864-65.032h22.4l0.72258 62.142z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="12" d="m450.89 1183.6v-65.755l64.309 0.7226 2.1677 65.755z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="13" d="m661.88 1119.3v64.309l49.858-1.4452-2.1677-63.587z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="14" d="m712.46 1119.3-0.72258 63.587 85.264 1.4452-61.419-65.755z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="15" d="m927.07 1179.2 0.72258 101.88 64.309 1.4451 1.4452-101.16z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path id="16" d="m927.07 1081 0.72258 99.716 66.477 0.7226v-103.33z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m927.79 981.26s-4.3355 98.993-1.4452 98.271 68.645 0 68.645 0l-1.4452-100.44z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m929.96 884.43-2.8903 95.38 70.813-1.4452-0.72258-96.103z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m928.51 781.83 0.72258 95.38 64.309 2.1677 0.72258-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m928.51 583.12c5.7806 80.206 0 98.993 0 98.993h65.032l-1.4452-101.16z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m928.51 481.24v100.44l63.587-0.72258 0.72257-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m926.34 382.24 2.1677 98.271s65.032 10.839 65.032 0.72257c0-10.116-2.8903-98.993-2.8903-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m928.51 283.97-1.4452 96.103s71.535 5.058 71.535 0.72258c0-4.3355-1.4452-97.548-1.4452-97.548z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m859.14 1177.8v47.69l67.922 54.916-1.4452-101.16z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m859.87 1079.5v98.993l67.2 1.4452-0.72257-99.716z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m859.87 980.54 2.1677 98.993 65.032-1.4451 1.4452-99.716z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m859.87 880.82 0.72258 98.993 68.645-0.72258-1.4452-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m859.87 783.27 0.72258 96.825h68.645l-2.1677-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m860.59 580.23-0.72258 101.16 66.477-2.1677 3.6129-96.825z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m859.14 480.51 0.72258 101.16 66.477-0.72258-0.72258-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m859.87 381.52 1.4452 99.716 67.2 1.4452-1.4452-101.88z" style="opacity:0"/>
              </g>
              <g>
                <path d="m859.87 284.7v94.658l67.2 4.3355v-100.44z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m927.79 184.26v99.716l67.922-2.1677-1.4452-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m862.04 181.37-2.8903 101.88s64.309 2.1677 65.755-2.1677c1.4452-4.3355 6.5032-98.271 1.4452-98.271-5.058 0-64.309-1.4452-64.309-1.4452z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m730.53 184.26 1.4452 98.993s36.851 2.8903 38.297 0c1.4452-2.8903 40.464-31.793 40.464-35.406s0.72258-65.755 0.72258-65.755z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m651.76 182.81 0.72258 101.16s75.871 2.8903 75.871-1.4452c0-4.3355 2.1677-100.44 2.1677-100.44z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m524.59 184.26v98.993h72.258l2.1677-101.88z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m421.99 185.7v99.716l68.645-2.8903-0.72258-99.716z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m349.73 183.53 1.4452 63.587 32.516 36.851s37.574 3.6129 37.574 0.72258-2.8903-102.61-2.8903-102.61z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m231.22 180.64 1.4452 101.88 67.922 1.4452-0.72258-102.61z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m166.92 182.81v102.61l62.864-2.1677 1.4452-101.16z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m164.75 283.25c-5.058 70.09 0.72258 96.103 0.72258 96.103l65.755 2.8903-1.4452-97.548z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m166.19 384.41v99.716l67.2-2.1677-0.72258-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m166.19 485.57-0.72257 96.825 66.477-1.4452v-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m166.19 583.12 0.72258 97.548s65.032 3.6129 66.477 0.72257c1.4452-2.8903-1.4452-96.103-1.4452-96.103z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m166.19 782.55c5.058 46.245-1.4452 96.103-1.4452 96.103s67.2 5.7806 68.645 2.1677c1.4452-3.6129-2.8903-99.716-2.8903-99.716z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m166.92 882.99 1.4452 95.38s64.309 2.1677 64.309-0.72258 0.72258-96.103 0.72258-96.103z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m165.47 981.26v98.271l67.922-1.4451-0.72258-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m167.64 1078.8-0.72258 100.44 67.922-1.4451-2.8903-95.38z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m166.92 1182.1-2.1677 97.548s70.09 3.6129 70.09-1.4451v-99.716z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m234.84 282.53-2.1677 98.993s69.367 10.839 69.367 0v-98.271z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m234.84 383.69v98.993l64.309-2.8903 0.72258-98.271z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m232.67 484.13 2.1677 96.825 63.587 0.72258v-100.44z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m234.12 583.84-0.72258 97.548 67.2-0.72257 1.4452-98.993z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m232.67 783.27 2.8903 98.993 64.309-2.8903-0.72258-97.548z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m232.67 880.82 0.72258 101.16s69.367 2.1677 68.645-2.1677c-0.72258-4.3355-2.1677-99.716-2.1677-99.716z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m232.67 981.98 0.72258 99.716s65.032 2.8904 66.477-2.8903c1.4452-5.7806 3.6129-99.716 3.6129-99.716z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m234.84 1080.3-0.72258 101.16s68.645 2.1677 68.645-0.7226v-101.16z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m231.95 1179.2s-2.1677 104.05 0.72257 101.16 65.755-54.193 68.645-56.361c2.8903-2.1677-1.4452-44.8-1.4452-44.8z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m333.83 1078.8 3.6129 77.316 37.574-37.574 0.72257-40.464z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m335.28 1000.8-0.72258 78.761 64.309-2.1677 1.4452-75.871z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m338.17 922.73-2.1677 75.871 66.477 1.4452-1.4452-75.871z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m445.11 314.32 2.8903 67.922s88.877 5.058 88.877 0v-62.864z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m538.32 314.32s-5.058 70.09-1.4452 68.645c3.6129-1.4452 77.316-0.72258 77.316-0.72258l-0.72258-65.032z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m615.64 315.04-2.8903 66.477h97.548l-1.4452-67.922z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m759.43 923.45v78.038l62.142-2.1677-1.4452-76.593z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m755.82 1001.5s-5.058 79.484 0 77.316c5.058-2.1677 64.309-0.7225 64.309-0.7225l-0.72258-78.038z" style="opacity:0"/>
              </g>
              </a>
              <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo htmlspecialchars($status); ?>"onclick="checkStall(this)">
              <g>
                <path d="m781.11 1080.3 2.8903 38.297 36.851 36.852 2.1677-79.484z" style="opacity:0"/>
              </g>
              </a>
              <?php endforeach; ?>
              </svg>

              <script>
                  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                      return new bootstrap.Tooltip(tooltipTriggerEl)
                  })
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
          <h5 class="mt-3 mb-0"><?php echo $row['admin_name'];?></h5>
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