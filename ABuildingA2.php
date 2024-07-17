<?php
session_start();
include("database_config.php");

try {
    // Create connection
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // SQL query to get stall information and vendor usernames
    $sql = "SELECT s.stall_no AS stall_no, s.stall_status AS status, v.username AS username
            FROM stalls s
            LEFT JOIN vendors v ON s.vendor_id = v.vendor_id";

    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception("Error executing query: " . $conn->error);
    }

    $vendors = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stall_no = $row['stall_no'];
            $status = $row['status'];
            $username = $row['username'];

            if (!empty($row['status']) && $row['status'] == 'Occupied') {
                $status = 'Occupied';
                $username = $row['username'];
            } elseif(!empty($row['status']) && $row['status'] == 'Vacant') {
                $status = 'Vacant';
                $username = 'NON';
            }elseif(empty($row['stall_no'])){
              $status = 'No Stalls Available';
            }

            $vendors[$stall_no] = [
                'status' => $status,
                'username' => $username
            ];
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

        if (array_key_exists($pathId, $vendors)) {
            $status_info = $vendors[$pathId];
            echo json_encode($status_info);  
        } elseif(array_key_exists($pathId,empty($vendors))){
          echo json_encode(['error']);
        }else {
            echo json_encode(['status' => 'Vacant', 'username' => 'NON']);
        }

        exit;
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection
    if (isset($conn)) {
     //   $conn->close();
    }
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
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
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
          <h5 class="text-center"><?php echo $vendors['username'];?></h5>
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
                    <h5 class="font-weight-bolder mb-0">
                      -----
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-info shadow text-center border-radius-md">
                    <i class="bi bi-shop text-lg opacity-10" aria-hidden="true"></i>

                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-shop mt-2" viewBox="0 0 16 16" aria-hidden="true">
                      <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
                    </svg>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Vacant</p>
                    <h5 class="font-weight-bolder mb-0">
                      -----
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-info shadow text-center border-radius-md">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-shop-window mt-2" viewBox="0 0 16 16">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5m2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5"/>
                  </svg>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Stalls</p>
                    <h5 class="font-weight-bolder mb-0">
                    ------
                    </h5>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">To be edit</p>
                    <h5 class="font-weight-bolder mb-0">
                      ------
                    </h5>
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
                <button type="button" class="btn btn-danger me-3" data-bs-toggle="modal" data-bs-target="#removeVendorModal">
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
  

          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Building A</h6>
              <p class="text-sm">
                <i class="fa fa-building-o fa-lg text-warning"></i>
                <span class="font-weight-bold">Building A</span>
              </p>  
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