<?php
session_start();
include("database_config.php");

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
  <style>
    .custom-tooltip{

    --bs-tooltip-bg: #333;
    --bs-tooltip-color: fff;
    cursor: pointer;
              
  } 
  </style>
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
              <clipPath id="clipPath12">
              <path transform="translate(-2.0833e-7 -.00020833)" d="m585 714h5866v8292h-5866v-8292"/>
              </clipPath>
              <clipPath id="clipPath14">
              <path transform="translate(-2.0833e-7 -.00020833)" d="m585 714h5866v8292h-5866v-8292"/>
              </clipPath>
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
            </defs>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="4">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938h83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542h83v-51h-83v51" clip-path="url(#clipPath12)"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938h-83v-51h83v51" clip-path="url(#clipPath14)"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432h-83v-52h83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054h-83v-52h83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676h-83v-52h83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298h-83v-52h83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401h-41v-41h41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401h-42v-41h42v41"/>
              </g>
              <g stroke-width="4">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 6915h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 6915h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 6293h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 5671h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 5671h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 5049h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 5049h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 4427h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 3805h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 5049h42v-42h-42v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 3805h42v-42h-42v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 3183h42v-42h-42v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401h42v-41h-42v41"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 6293h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 6293h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 5671h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 5671h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 5049h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 5049h42v-42h-42v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 4427h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 3805h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 2555h41v-41h-41v41"/>
              </g>
              <g stroke-width="4">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542h83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920h83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 3183h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41v-41h-41v41"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4130 2296h-41v-41h41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 3183h-41v-42h41v42"/>
              <path transform="matrix(0 -.16 -.16 0 533.63 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(0 -.16 -.16 0 627.07 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              </g>
              <g stroke-width="4">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 6915h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1013 7558v-16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 7558v-16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 5049h-42v-42h42v42"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810h-83v-52h83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 4427h42v-42h-42v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 3805h42v-42h-42v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 3183h42v-42h-42v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 2555h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4130 1933h-41v-41h41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1933h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 2296h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1933h41v-41h-41v41"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1933h-42v-41h42v41" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 2296h-42v-41h42v41" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3136 1933h-41v-41h41v41" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3136 2296h-41v-41h41v41" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1933h-41v-41h41v41" stroke-width="4"/>
              <path transform="matrix(0 -.16 -.16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 2555h41v-41h-41v41" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1933h41v-41h-41v41" stroke-width="4"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 2296h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 1933h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401h-41v-41h41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672h-42v-41h42v41"/>
              <path transform="matrix(0 -.16 -.16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(0 -.16 -.16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 2923h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1933h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4180 1173 1959 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 5624h-42v52h42"/>
              <path transform="matrix(0 -.16 -.16 0 580.19 1365.7)" d="m-198.51 570.98c-243.07-84.508-405.99-313.64-405.99-570.98s162.92-486.47 405.99-570.98"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 2923h-42v-41h42v41"/>
              <path transform="matrix(0 -.16 -.16 0 660.35 1364.3)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#72001c" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920h83v-51h-83v51" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2409 6027v1" stroke-width="3"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3373 8756v-32"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7273h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7273h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4450 7242h4"/>
              </g>
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6393v356"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 3048v10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2965 7150h10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4811 6027v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4929 5355v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6150h-185"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 4149"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4916 6043v92"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5702h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5639h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5577h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5764h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5515h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5888h11"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7273h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7273h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2770 7242h-5"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561h-83v-52h83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542h-83v-51h83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41v-41h-41v41"/>
              </g>
              <g stroke-width="4">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810h83v-52h-83v52"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938h83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298h83v-52h-83v52"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188h83v-52h-83v52" stroke-width="4"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 7599h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 7599h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 7599h-41v-41h41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188h-83v-52h83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810h83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5956 7511h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5540 7511h-11"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920h-83v-51h83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 7537h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 7537h41v-41h-41v41"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 7537h42v-41h-42v41" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 6293h42v-41h-42v41" stroke-width="3"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8159h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8159h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8159h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8159h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8159h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8159h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 7537h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 7537h42v-41h-42v41"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7537h42v-41h-42v41" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 6915h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 6915h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6915h42v-41h-42v41" stroke-width="3"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8159h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8159h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4150 8159h42v-41h-42v41"/>
              </g>
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 6538h10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 3763v-580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3763v-580"/>
              </g>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920h83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542h83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 8740v-581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1856 8740v-581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41v-41h-41v41"/>
              </g>
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3187 8756v-146"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3218 8756v-146"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3249 8756v-146"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3280 8756v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3311 8756v-94"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3342 8756v-78"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8605h128"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8574h128"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8543h128"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8512h128"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8481h128"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 7563h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3033 7594h32v-31h-32v31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 7599h42v-41h-42v41"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 7599h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 7599h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3594 7594h31v-31h-31v31" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4155 7594h31v-31h-31v31" stroke-width="3"/>
            </g>
            <path d="m769.34 1031.7h64.746l-64.746-1.7902zm64.746 0-64.746-1.7902h64.746z" stroke="#000" stroke-linecap="round" stroke-miterlimit="10" style="stroke-width:.17488"/>
            <path d="m773.78 1119h60.304l-60.304-1.9693zm60.304 0-60.304-1.9693h60.304z" stroke="#000" stroke-linecap="round" stroke-miterlimit="10" style="stroke-width:.17488"/>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7304h156"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7335h156"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4434 7273h103"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4434 7273h103"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7242h51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4464 7242h8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4481 7242h56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7211h98"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7180h146"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7335v-187h156v37"/>
              </g>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 7558v-21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1856 7558v-21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 7599h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 7599h41v-41h-41v41"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 7599h42v-41h-42v41" stroke-width="3"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8159h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 7599h-41v-41h41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 7599h-42v-41h42v41"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 7599h-42v-41h42v41" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8159h-42v-41h42v41"/>
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1445 5630v-221"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1477 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1508 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1539 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1570 5597v-188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1601 5642v-233"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1632 5404v238"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5409h609"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1264 5404h368"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1631 5642-71-105-18 4 22-30-18 4-71-106"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1570 5645v-48"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1162 5364v160h124v-34l43 34-36 34" stroke-width="5"/>
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 6915h-42v-41h42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3033 7579v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 7558v-21h-11v21h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7558v-21h10v21h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3091 8528v150h170v27l38-27-31-22"/>
              </g>
            </g>
            <text transform="matrix(.17083 0 0 .17903 497.03 141.74)" clip-path="url(#clipPath670)" xml:space="preserve"><tspan x="0 22.959999" y="0" fill="#000000" font-family="Tahoma" font-size="35px">UP</tspan></text>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3259 8610 58 58-13 28 55-26-12 28 58 58" clip-path="url(#clipPath672)"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7275 64-42 10 16-2-45 12 16 72-47"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 7307 74-48 10 15-2-44 12 16 62-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4421 7148h-1649"/>
              </g>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2214 5964h279v-11h-279v11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 7827v-449"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2096 7827v-449"/>
              </g>
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7352h104v-104h-104v104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7248h104v-103h-104v103"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7145h104v-104h-104v104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 7041h104v-104h-104v104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 6937h104v-103h-104v103"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 6834h104v-104h-104v104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7352h103v-104h-103v104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7248h103v-103h-103v103"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7145h103v-104h-103v104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7041h103v-104h-103v104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 6803h103v-103h-103v103"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2106 6730h104v-104h-104v104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 6700h103v-104h-103v104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 6368h-10v114h155v-10h-145v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 6482h-10v114h155v-10h-145v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 6368h155v-10h-155v10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2231 6368h-124v-10h124v10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2221 6275h137v-11h-137v11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2292 6264v-114h10v114h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2221 6352v-72h10v72h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2364 6352v-72h10v72h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2374 6275v-11h-16v11h16"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2301 6038v-74h11v74h-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2304 6043v92" stroke-width="3"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 5971h26v-26h-26v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 4157h26v-26h-26v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 6604h26v-26h-26v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 7378h26v-26h-26v26"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2114 7846 60 59" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 7853 63 63" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4192 8144v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 6937h103v-134h-103v134" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 7853h26v-26h-26v26" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 7923h26v-25h-26v25" stroke-width="2"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" stroke="#000" stroke-linecap="round" stroke-miterlimit="10">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5048 4139h-321zm0 0h-321v10z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4149h321v-10z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5048 5440h58l-58 10zm58 0-58 10h58z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5440h321l-321 10zm321 0-321 10h321z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 4139h-58zm0 0h-58v10z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5048 4149h58v-10z"/>
            </g>
            <path d="m834.09 709.76h-64.746v1.7903h64.746" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.8643"/>
            <path d="m769.34 817.35h67.821l-67.821-1.7903zm67.821 0-67.821-1.7903h67.821z" stroke="#000" stroke-linecap="round" stroke-miterlimit="10" style="stroke-width:.17488"/>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 4859h-397v-10h397v10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 4149h-379v-10h379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 7853h-25v-26h25v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 7923h-26v-25h26v25"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5624v-357"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1013 5267v357h10"/>
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1013 5261h10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5624h-10v-5h10v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5261h-10v6h10v-6"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 6578h-11" stroke-width="2"/>
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 5619v-31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m940 8968h5340-921"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3259 8605h-72v-129"/>
              <path transform="matrix(0 -.16 -.16 0 512.19 229.09)" d="m0 2.5c-1.3807 0-2.5-1.1193-2.5-2.5s1.1193-2.5 2.5-2.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3182 8476v134h77"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 3652v10h-379v-10h379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 3164v11h-353v-11h353"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8612v154"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8610v156"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8756h144"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3318 7923h26v-25h-26v25"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4529 7923h26v-25h-26v25"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m810 1445v7393"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6409 1445v7393"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5407 5409h181v-5h-181v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 1913h-219"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1881h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3146 1881h-31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1850h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3246 1850h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3190 1850h-75"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1819h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3243 1819h-128"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1788h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3278 1788h-27"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3240 1788h-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1757h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3321 1757h-206"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1726h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3350 1726h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1695h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3350 1695h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3605 1664h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3350 1736v-72h-235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3370 1913v-249"/>
              <path transform="matrix(0 -.16 -.16 0 540.35 1319)" d="m0 10.5c-5.799 0-10.5-4.701-10.5-10.5s4.701-10.5 10.5-10.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3131 1892 92-65 24 35-9-92 23 31 89-65"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6280 8968 129-130"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m940 8968-130-130"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4968 2501 166 166"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1082 1173h1956" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3906 1405h-8"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 6158h26v-26h-26v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7511v11h-111v-11h111"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7898v-148"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2754 7923h26v-25h-26v25" stroke-width="3"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2498 7599h11v299h-11v-299"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7511h10v387h-10v-387"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 7352h-16v-437h16v437"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7373h-16v-458h16v458"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4537 7148h10v363h-10v-363"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390 7363v-11h119v11h-119"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 7485h10v11h-10v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 7363h10v10h-10v-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4724 7496h-10v-11h10v11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4721 7898h-10v-299h10v299"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4537 7511v11h-1765v-11h1765"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 8377h10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 8377v389h10v-389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 8766h-10v-394h10v394"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 8387h153v218h10v-218"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8419h-153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8450h-153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8481h-153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8512h-153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8543h-153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8574h-153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2019 8605h-153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8387 56 51-19 21 71-23-23 29 53 47"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8605h138"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8574h138"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8543h138"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8512h138"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8481h102"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8450h46"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2095 8450h31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2029 8419h35"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1939 8402v261h159v-107h-19l19-35 21 35"/>
              </g>
            </g>
            <text transform="scale(.97685 1.0237)" x="311.3732" y="127.96504" style="font-size:2.0986px;stroke-width:.17488" xml:space="preserve"><tspan x="311.3732 315.38849" y="127.96504" fill="#000000" font-family="Tahoma" font-size="6.1209px" style="stroke-width:.17488">UP</tspan></text>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5354 8387h-153v218h-10v-218"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8419h153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8450h153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8481h153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8512h153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8543h153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8574h153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5201 8605h153"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8387-56 51 19 21-71-23 23 29-53 47"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8605h-138"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8574h-138"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8543h-138"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8512h-138"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8481h-103"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8450h-46"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 8450h-31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5191 8419h-35"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5280 8402v261h-158v-107h19l-19-35-21 35"/>
            </g>
            <text transform="scale(.97685 1.0237)" x="866.62433" y="127.96504" style="font-size:2.0986px;stroke-width:.17488" xml:space="preserve"><tspan x="866.62433 870.63959" y="127.96504" fill="#000000" font-family="Tahoma" font-size="6.1209px" style="stroke-width:.17488">UP</tspan></text>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3105 1892h10v-491h-10v491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 2923h-941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253 2530 7-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253 2530 393 393h943v-10h-939l-390-390"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3219 2913h-10v-402h10v402"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2804 2913h-10v-161h10v161"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2794 2511h10v210h-10v-210"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4961 2523 8 7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4961 2523-390 390h-441v10h446l393-393"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4416 2516h10v205h-10v-205"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4416 2752h10v161h-10v-161"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42v-41h-42v41"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5364 8740h-10v-581h10v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5645v10h-360v-10h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 5655v-10h380v10h-380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 3183h26v-26h-26v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 3164v11h-353v-11h353"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2108 2676 8-8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2108 2676 219 218v270h11l-1-274-221-222"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 2955h-155"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 3670h26v-26h-26v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3652v10h-379v-10h379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4139v10h-379v-10h379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 4655h-11v-498h11v498"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 4680h26v-25h-26v25"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4849v10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4849h-397v218h397v-11h-386v-197h386"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 5453h26v-26h-26v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5435v10h-379v-10h379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 5945h-11v-492h11v492"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 6140v10h-379v-10h379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 6578h-11v-420h11v420"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 7352h-11v-748h11v748"/>
              <path transform="matrix(0 -.16 -.16 0 399.07 321.25)" d="m2.3511 90.469c-25.173 0.65419-49.48-9.2094-67.079-27.22-17.599-18.01-26.898-42.539-25.663-67.69"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2382 7905v11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2382 7905h-208l-60-59-7 7 63 63h212"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 7905v11h-6v-11h6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2754 7905v11h-237v-11h237"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2658 7536 77 44"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2732 7585-76-44 2-5 77 44-3 5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2664 7522 4 4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2669 7522 10 10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7522h1l15 16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2678 7522 22 22"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2683 7522 27 28"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2687 7522 34 34"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2692 7522 40 40"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2697 7522 45 45"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2701 7522 52 51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2706 7522 56 56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2711 7522 51 51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2715 7522 47 46"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2720 7522 42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2725 7522 37 37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2729 7522 33 32"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2734 7522 28 28"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2739 7522 23 23"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2743 7522 19 18"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2748 7522 14 14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2752 7522 10 9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2757 7522 5 4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2547 7750v10h-38v-10h38"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2640 7905h-10v-145h10v145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 7567 88 50 3-6 9 6-8 14-92-52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2654 7518 9 5-5 8-9-5 5-8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2592 7625-55 96"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2537 7750v-29"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4614 7765 5 9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4614 7765-7 3v137h11v-131h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7578-99-55 1-1h98v56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2646 7750v10h-21v-10h21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7750v10h-39v-10h39"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2651 7533-44 76"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2762 7578 5 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4555 7905v11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4463 7522h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4529 7905h-98"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4529 7916h-108"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 7843 7 8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 7843-62 62h-205v11h209l65-65"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 7827h-11v-449h11v449"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4555 7916v-11h148v11h-148"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4045 7923h26v-25h-26v25" stroke-width="3"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7541-77 45"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4473 7590 76-44-2-5-77 45 3 4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4605 7617 5 9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4613 7631"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4596 7622 8 14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4609 7645"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4552 7525-9 6 4 6 9-6-4-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4633 7636 51 88"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7709-30 17 5 9 25-15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4554 7538 44 77"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4604 7636h107v-10h-101"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7148h164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7180h164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7211h164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7242h164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7273h164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4621 7767 58-34"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4715 7706 5 9-34 20-5-9 34-20"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4599 7157v61h-12l13 19 14-19"/>
              </g>
            </g>
            <text transform="scale(.97685 1.0237)" x="767.11633" y="395.01025" style="font-size:2.0986px;stroke-width:.17488" xml:space="preserve"><tspan x="767.11633 770.43628 773.90314 778.32001" y="395.01025" fill="#000000" font-family="Tahoma" font-size="4.8967px" style="stroke-width:.17488">DOWN</tspan></text>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5676h-10v104h10v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6298h-10v104h10v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6920h-10v104h10v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 7542h-10v104h10v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 8159h-10v104h10v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 8636h-10v104h10v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 8014h-10v104h10v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 7387h-10v104h10v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6765h-10v104h10v-104"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 6143h-10v103h10v-103"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3219 2913h-10v-402h10v402"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3400 2825v83h-10v-83h10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3986 2770v-20h-5v13h1v7h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4105 2516h10v366h-10v-366"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360h-20"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5781 1174 150-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5931 1360h-20"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672h10-10v109h10v-109 109h-10v-109"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672h10-10v109h10v-109 109h-10v-109"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777h10-10v110h10v-110 110h-10v-110"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777h10-10v110h10v-110 110h-10v-110"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777v5h-10v-5h10-10v5h10v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1782"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1782"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1881v6h-10v-6h10-10v6h10v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1881"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1881"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1881"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672v6h-10v-6h10-10v6h10v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1678"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1678"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6202 2509v-571"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 2509v-571"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6212 2509v-571"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6202 1938h-41v-51h36v-215"/>
              </g>
              <g stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7304h-155"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7335h-155"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2786 7273h-103"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2786 7273h-103"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7242h-50"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2756 7242h-8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2739 7242h-56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7211h-97"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7180h-145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7335v-187h-155v37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7275-63-42-10 16 2-45-12 16-72-47"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2838 7307-73-48-10 15 2-44-12 16-62-41"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7148h-164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7180h-164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7211h-164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7242h-164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7273h-164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2621 7157v61h11l-12 19-14-19"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)">
              <path transform="matrix(.16 0 0 -.16 417.23 438.77)" d="m0 0v-3h1v-2l1-1v-1h1v-1h1v-1h2v-1h10v21h-6v-1h-4l-1-1h-1v-1h-1v-1h-1v-1h-1v-2l-1-1zm3 0v4h1v1l2 2h1v1h7v-16h-6v1h-2v1h-1v1h-1v2h-1z"/>
              <path transform="matrix(.16 0 0 -.16 414.35 437.49)" d="m0 0v-1h-1v-3h-1v-8h1v-2l1-1v-1h1v-1h1v-1h3v-1h4v1h3v1h1v1h1v1h1v2h1v10h-1v2h-1v1l-1 1h-1v1h-2v1h-6v-1h-2v-1h-1v-1zm1-8v4l1 1v1l1 1h1v1h2l1 1h1v-1h2l2-2v-1h1v-10h-1v-1l-1-1h-1v-1h-6v1h-1v1h-1v2h-1z"/>
              <path transform="matrix(.16 0 0 -.16 409.87 437.17)" d="m0 0 5-20h3l4 17 4-17h3l6 20h-3l-4-17-5 17h-2l-4-17-5 17z"/>
              <path transform="matrix(.16 0 0 -.16 406.99 440.37)" d="m0 0h3l10 18v-18h2v20h-4l-8-16v16h-3z"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2673 7148h10v363h-10v-363"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4673v-11h239v11h-239"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5056 4673v-11h50v11h-50"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5056 4149v401h57"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4900 4673h11v74h-11v-74"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4900 4849h11v-11h-11v11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4446 7097v61h-12l13 19 14-19"/>
            </g>
            <text transform="scale(.97685 1.0237)" x="740.00958" y="400.60648" style="font-size:2.0986px;stroke-width:.17488" xml:space="preserve"><tspan x="740.00958 743.2218" y="400.60648" fill="#000000" font-family="Tahoma" font-size="4.8967px" style="stroke-width:.17488">UP</tspan></text>
            <path d="m432.29 414.72v-10.921h-2.05l2.2208-3.4015 2.3917 3.4015" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.9096"/>
            <text transform="scale(.97685 1.0237)" x="444.10883" y="400.43161" style="font-size:2.0986px;stroke-width:.17488" xml:space="preserve"><tspan x="444.10883 447.32108" y="400.43161" fill="#000000" font-family="Tahoma" font-size="4.8967px" style="stroke-width:.17488">UP</tspan></text>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4673v-11h-239v11h239"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2164 4673v-11h-50v11h50"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2164 4149v401h-57"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2320 4673h-11v74h11v-74"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2320 4849h-11v-11h11v11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4856 6358h-10v-6h10v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4989 6358h10v-6h-10v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6596v-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6596h155v-25h-10v15h-145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 6471v11h-145v-11h145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 6457h10v37h-10v-37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6368v-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6368h145v12h10v-22h-155"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6185 1627-7 7-230-229 8-7 229 229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1375v11h-110v-11h110"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1264 1398 8 7-230 229-7-7 229-229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 1887h-10v-215h10v215"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6151 1161 271 271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3473 1959v-423h-233v102"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3483 1959v-434h-253v113h-17l22 43"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3240 1638h17l-22 43"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3473 1959h10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4716 7923v57"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4426 7923v57"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4167 7923v57"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4426 7522v394"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4421 7522v394"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4431 7522v383"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4542 7923v-82"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4613 7905v-20"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m890 921h1511" clip-path="url(#clipPath7519)" stroke-width="3"/>
            </g>
            <text transform="matrix(.17083 0 0 .17903 149.8 1515.6)" clip-path="url(#clipPath7520)" xml:space="preserve"><tspan x="0 99.830002 197.114 300.29401 399.32001 502.634 604.07202 643.33398 721.18799 797.836 901.01599 1004.196" y="0" fill="#000000" font-family="Tahoma" font-size="134px" font-weight="700">GROUND FLOOR</tspan></text>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)">
              <path transform="matrix(.16 0 0 -.16 483.47 1488.5)" d="m0 0h-6l-1 1h-5l-1 1h-2l-1 1h-2l-1 1h-2l-1 1h-2v1h-1v12h2l1-1v-1h1l1-1h1l1-1v-1h1l1-1h2l1-1h1l1-1h3l1-1h12l1 1h2l1 1h1v1h1l1 1h1v1l1 1v2l1 1v7l-1 1v1l-4 4h-1l-2 1h-1l-1 1h-3l-1 1h-3l-1 1h-3l-1 1h-2l-1 1h-2l-1 1h-1l-1 1h-1l-5 5v1h-1v1l-1 1v3l-1 1v9l1 1v2l1 1v1l2 2v1l1 1h1l2 2v1h1l1 1h1l1 1h1l1 1h2l1 1h6l1 1h2l1-1h8l1-1h3l1-1h2l1-1h1l1-1h2v-12h-1l-1 1h-1v1h-1l-1 1h-1l-1 1h-1l-1 1h-1v1h-2l-1 1h-3l-1 1h-9l-1-1h-3l-2-2h-1l-2-2v-1l-1-1v-1l-1-1v-6l1-1v-1l1-1v-1h1v-1h1l2-2h1l1-1h3l1-1h3l1-1h4l1-1h2l1-1h2l1-1h2l1-1h1l3-3h1v-1l1-1v-1h1v-1l1-1v-2l1-1v-11l-1-1v-2l-1-1v-1l-1-1v-1h-1v-1l-3-3h-1l-1-1v-1h-1l-1-1h-2l-1-1h-1l-1-1h-5l-1-1z" clip-path="url(#clipPath7523)"/>
              <path transform="matrix(.16 0 0 -.16 494.99 1488.2)" d="m0 0 25 73h12l25-73h-10l-7 20h-28l-7-20zm42 29-11 34-11-34z" clip-path="url(#clipPath7525)"/>
              <path transform="matrix(.16 0 0 -.16 523.31 1488.2)" d="m0 0h-10v63l-19-43h-6l-19 43v-63h-9v73h13l19-41 18 41h13z" clip-path="url(#clipPath7527)"/>
              <path transform="matrix(.16 0 0 -.16 540.27 1480.1)" d="m0 0v-6l-1-1v-2l-1-1v-1l-1-1v-1l-2-2v-1h-1l-1-1v-1h-1l-1-1h-1l-2-2h-1l-1-1h-2l-1-1h-3l-1-1h-15v-27h-10v73h27l1-1h4l1-1h1v-1h2l1-1h1l1-1v-1h1l1-1v-1h1l1-1v-1l1-1v-1h1v-2l1-1zm-10 0v5l-1 1v1l-2 2v1h-1l-1 1h-1l-1 1h-1l-1 1h-3l-1 1h-13v-30h10l1 1h5l1 1h2l1 1h1v1l4 4v2h1z" clip-path="url(#clipPath7529)"/>
              <path transform="matrix(.16 0 0 -.16 547.79 1488.2)" d="m0 0 25 73h12l24-73h-10l-7 20h-28l-6-20zm42 29-12 34-11-34z" clip-path="url(#clipPath7531)"/>
              <path transform="matrix(.16 0 0 -.16 570.83 1488.5)" d="m0 0h-5l-1 1h-4l-1 1h-3v1h-2l-1 1h-1l-1 1h-1v1h-1l-1 1h-1v1l-2 2h-1v1l-2 2v1h-1v1l-1 1v1l-1 1v1l-1 1v2l-1 1v2l-1 1v6l-1 1v11l1 1v5l1 1v2l1 1v1l1 1v2l1 1v1l1 1v1l3 3v1h1l1 1v1h1l3 3h1l1 1h1l1 1h1l1 1h1l1 1h3l1 1h7l1 1h1l1-1h7l1-1h3l1-1h3l1-1h1l1-1h2l2-2v-12l-2 2h-1l-2 2h-1v1h-1l-1 1h-1l-1 1h-1l-1 1h-2l-1 1h-3l-1 1h-11l-1-1h-2l-1-1h-1l-1-1h-1l-3-3h-1v-1l-3-3v-1l-1-1v-1l-1-1v-2l-1-1v-2l-1-1v-6l-1-1v-4l1-2v-7h1v-3l1-1v-1l1-1v-1l1-1v-1l2-2v-1h1l1-1v-1h1l3-3h2l1-1h1l1-1h16l1 1h3l1 1h1v19h-17v9h27v-33h-2l-1-1h-2v-1h-2l-1-1h-2l-1-1h-2l-1-1h-5v-1z" clip-path="url(#clipPath7533)"/>
              <path transform="matrix(.16 0 0 -.16 588.11 1488.5)" d="m0 0h-6l-1 1h-3l-1 1h-2l-1 1h-1l-2 2h-1l-4 4v1l-1 1v1h-1v1l-1 1v2l-1 1v4l-1 1v53h10v-54h1v-3l1-1v-1l1-1v-1h1v-1l1-1h1l1-1v-1h2l1-1h4l1-1h3l1 1h4l1 1h2l3 3h1v1l1 1v1l1 1v2l1 1v6l1 2v47h9v-55l-1-1v-3l-1-1v-2l-1-1v-1h-1v-1l-1-1v-1l-1-1h-1v-1l-1-1h-1l-1-1h-1l-2-2h-2l-1-1h-3l-1-1z" clip-path="url(#clipPath7535)"/>
              <path transform="matrix(.16 0 0 -.16 605.87 1488.2)" d="m0 0h-29v7h10v59h-10v7h29v-7h-9v-59h9z" clip-path="url(#clipPath7537)"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3844 607v64h-24v9h59v-9h-25v-64z" clip-path="url(#clipPath7539)"/>
              <path transform="matrix(.16 0 0 -.16 630.35 1488.2)" d="m0 0 25 73h12l25-73h-10l-7 20h-28l-7-20zm42 29-11 34-12-34z" clip-path="url(#clipPath7541)"/>
              <path transform="matrix(.16 0 0 -.16 664.11 1488.5)" d="m0 0h-6l-1 1h-4l-1 1h-3l-1 1h-2l-1 1h-1l-1 1h-2l-1 1v12h1l2-2h1v-1h1l2-2h1l1-1h1l1-1h1l1-1h3l1-1h13l1 1h2v1h1l2 2h1l1 1v1l1 1v3l1 1v2l-1 1v3l-1 1v1h-1v1h-1v1l-1 1h-2l-1 1h-1l-2 1h-3v1h-3l-1 1h-3l-2 1h-2l-1 1h-2l-1 1h-1v1h-1l-1 1h-1l-1 1v1h-1l-1 1v1l-2 2v2l-1 1v3l-1 1v5l1 1v3l1 1v1l1 1v1h1v1l1 1v1h1l3 3h1v1h1l1 1h2l1 1h1l1 1h7l1 1h1l1-1h8l1-1h4l1-1h2l1-1h1v-1h2v-12h-1v1h-1l-1 1h-1l-2 2h-1l-1 1h-1l-1 1h-2l-1 1h-3l-1 1h-9l-1-1h-2l-1-1h-1l-2-2h-1v-1l-1-1v-1l-1-1v-2l-1-1 1-2v-4h1v-1l3-3h1l1-1h1l1-1h3l1-1h3l1-1h3l1-1h3l1-1h1l1-1h2l1-1h1l1-1h1l1-1v-1h1v-1l3-3v-1l1-1v-3l1-1v-6l-1-1v-3l-1-1v-2l-1-1v-1l-3-3v-1h-1l-3-3h-1l-1-1h-2v-1h-2l-1-1h-4l-1-1z" clip-path="url(#clipPath7543)"/>
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
              <path transform="matrix(.16 0 0 -.16 1064.1 804.21)" d="m0 0v5l1 1v6l1 1v2l1 1v2l1 1v2l2 2v1h12v-1l-3-3v-1l-1-1v-1l-2-2v-1l-1-1v-2l-1-1v-2l-1-1v-12l1-1v-2l1-1v-1l4-4h1l1-1h8l1 1h2v1h1l1 1v1h1v1l1 1v3l1 1v3l1 1v3l1 1v3l1 1v2l1 1v2l1 1v1l1 1v1h1v1l3 3h1l2 2h1l1 1h3l1 1h7l1-1h2l1-1h2l3-3h1l1-1v-1h1v-1l2-2v-1l1-1v-1h1v-3l1-1v-5l1-1v-5l-1-1v-6l-1-1v-4l-1-1v-1l-1-1v-2l-1-1v-1h-12v1l2 2v1l2 2v1h1v2l1 1v1l1 1v3l1 1v11l-1 1v2h-1v1l-1 1v1h-1v1l-1 1h-1l-1 1h-1l-1 1h-5l-1-1h-1l-1-1h-1l-1-1h-1v-1l-1-1v-1h-1v-2l-1-1v-3l-1-1v-3l-1-1v-3l-1-1v-3h-1v-2l-1-1v-2l-1-1v-1l-1-1v-1h-1l-1-1v-1h-1l-3-3h-2l-1-1h-4l-1-1h-2l-1 1h-4l-1 1h-2l-1 1h-1l-2 2h-1l-3 3v1h-1v1l-1 1v1l-1 1v1l-1 1v2l-1 1v3l-1 2z" clip-path="url(#clipPath7565)"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6636 4784h65v25h8v-59h-8v24h-65z" clip-path="url(#clipPath7567)"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6636 4684v11h14v-11z" clip-path="url(#clipPath7569)"/>
              <path transform="matrix(.16 0 0 -.16 500.11 92.053)" d="m0 0h-34v-20h33v-9h-33v-36h-10v74h44z" clip-path="url(#clipPath7571)"/>
              <path transform="matrix(.16 0 0 -.16 517.87 102.45)" d="m0 0h-13l-23 30h-11v-30h-10v74h28l1-1h4l1-1h1l1-1h1l1-1h1l1-1v-1h1l1-1v-1l1-1h1v-2l1-1v-2l1-1v-11l-1-1v-2l-1-1v-1l-2-2v-1l-4-4h-1l-2-2h-1l-1-1h-1l-1-1zm-21 53v3l-1 1v2l-1 1v1l-2 2h-1v1h-2l-1 1h-4l-1 1h-13v-28h16v1h2l1 1h1l2 2h1v1l1 1v1l1 1v1l1 1z" clip-path="url(#clipPath7573)"/>
              <path transform="matrix(.16 0 0 -.16 526.03 102.45)" d="m0 0v74h46v-9h-36v-20h34v-9h-34v-27h36v-9z" clip-path="url(#clipPath7575)"/>
              <path transform="matrix(.16 0 0 -.16 550.67 102.45)" d="m0 0h-11l-32 64v-64h-9v74h14l29-58v58h9z" clip-path="url(#clipPath7577)"/>
              <path transform="matrix(.16 0 0 -.16 564.91 102.61)" d="m0 0h-5l-1 1h-4l-1 1h-2v1h-2l-1 1h-1l-1 1h-1v1h-1l-6 6v1l-2 2v1l-1 1v2l-1 1v1l-1 1v2l-1 1v5l-1 1v14l1 1v5h1v3l1 1v1l1 1v2l1 1v1l3 3v1l5 5h1v1h1l1 1h1l1 1h1l1 1h1l1 1h2l1 1h16l1-1h3l1-1h2l1-1h2l1-1h1l1-1h1l1-1v-12h-1l-1 1v1h-1l-2 2h-1v1h-1l-2 2h-2l-1 1h-1l-1 1h-3l-1 1h-9l-1-1h-3l-1-1h-1l-2-2h-1l-2-2v-1h-1v-1h-1v-1l-1-1v-1l-2-2v-2l-1-1v-2l-1-1v-5l-1-1v-9l1-1v-5l1-1v-3l1-1v-1l1-1v-1l2-2v-1l2-2v-1h1l2-2h1v-1h1l1-1h2l1-1h13l1 1h2l1 1h2l2 2h1l1 1h1l3 3h1v1h1v-12h-2l-1-1h-1l-1-1h-1l-1-1h-1l-1-1h-3l-1-1h-4v-1z" clip-path="url(#clipPath7579)"/>
              <path transform="matrix(.16 0 0 -.16 585.71 102.45)" d="m0 0h-9v36h-34v-36h-10v74h10v-29h34v29h9z" clip-path="url(#clipPath7581)"/>
              <path transform="matrix(.16 0 0 -.16 610.83 102.61)" d="m0 0h-6l-1 1h-5l-1 1h-2l-1 1h-2l-1 1h-1l-1 1h-2l-1 1v12h1l1-1h1v-1h1l2-2h1v-1h1l1-1h1l1-1h2l1-1h2l1-1h13l1 1h2l1 1h1l4 4v2h1v8l-1 1v1l-3 3h-1l-1 1h-1l-1 1h-2l-1 1h-3l-1 1h-3l-1 1h-3l-1 1h-2l-1 1h-1l-1 1h-2l-7 7v1l-1 1v3h-1v10l1 1v2l1 1v1h1v1l1 1v1l1 1h1v1h1l1 1v1h1l1 1h1l1 1h1l1 1h3l1 1h16l1-1h3l1-1h2l1-1h2l1-1h1v-12l-1 1h-1v1h-1l-1 1h-1l-1 1h-1l-1 1h-1v1h-2l-1 1h-3l-1 1h-9l-1-1h-2l-1-1h-1l-1-1h-1l-1-1v-1h-1v-1l-1-1v-1l-1-1v-6l1-1v-2h1v-1l1-1h1l2-2h1l1-1h2l1-1h3l1-1h3l2-1h3v-1h3l1-1h1l1-1h1l1-1h1v-1h1l3-3v-1l2-2v-2l1-1v-11l-1-1v-2l-1-1v-1l-1-1v-1l-5-5h-1v-1h-1l-1-1h-1l-1-1h-2l-1-1h-3l-1-1z" clip-path="url(#clipPath7583)"/>
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
            </g>
            <text transform="matrix(.17083 0 0 .17903 233.95 1395.9)" clip-path="url(#clipPath7606)" xml:space="preserve"><tspan x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">1</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 316.12 1412.9)" clip-path="url(#clipPath7607)" xml:space="preserve"><tspan x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">2</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 427.33 1408.9)" clip-path="url(#clipPath7608)" xml:space="preserve"><tspan x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">3</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 704.08 1405.8)" clip-path="url(#clipPath7609)" xml:space="preserve"><tspan x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">4</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 810.17 1408.5)" clip-path="url(#clipPath7610)" xml:space="preserve"><tspan x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">5</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 701.18 1315.3)" clip-path="url(#clipPath7611)" xml:space="preserve"><tspan x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">8</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 682.73 1356.3)" clip-path="url(#clipPath7612)" xml:space="preserve"><tspan x="0 46.765999 99.495003 155.976 196.377 245.42101 286.69299 329.03699" y="0" fill="#000000" font-family="Verdana" font-size="67px">COMPUTER</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 682.22 1370.9)" clip-path="url(#clipPath7613)" xml:space="preserve"><tspan x="0 37.319 65.526001 111.488 158.05299 203.881 250.446" y="0" fill="#000000" font-family="Verdana" font-size="67px">LIBRARY</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 803.85 1333.2)" clip-path="url(#clipPath7614)" xml:space="preserve"><tspan x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">7</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 431.78 1330.5)" clip-path="url(#clipPath7615)" xml:space="preserve"><tspan x="0" y="0" fill="#000000" font-family="Verdana" font-size="101px">9</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 326.88 1330.9)" clip-path="url(#clipPath7616)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">10</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 394.88 1217.7)" clip-path="url(#clipPath7617)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">11</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 157.25 597.01)" clip-path="url(#clipPath7618)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">45</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 168.18 487.98)" clip-path="url(#clipPath7619)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">44</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 162.71 288.72)" clip-path="url(#clipPath7620)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">42</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 156.39 386.11)" clip-path="url(#clipPath7621)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">43</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 157.76 172.53)" clip-path="url(#clipPath7622)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">41</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 232.24 172.89)" clip-path="url(#clipPath7623)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">40</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 230.19 287.65)" clip-path="url(#clipPath7624)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">51</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 233.61 386.65)" clip-path="url(#clipPath7625)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">52</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 240.61 490.31)" clip-path="url(#clipPath7626)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">53</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 236.34 600.59)" clip-path="url(#clipPath7627)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">54</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 230.19 937.34)" clip-path="url(#clipPath7628)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">56</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 229.51 1049.8)" clip-path="url(#clipPath7629)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">57</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 231.39 1167.6)" clip-path="url(#clipPath7630)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">58</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 227.8 1268.8)" clip-path="url(#clipPath7631)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">59</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 973.66 1290.6)" clip-path="url(#clipPath7632)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">15</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 763.19 168.06)" clip-path="url(#clipPath7633)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">35</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 975.37 1175.5)" clip-path="url(#clipPath7634)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">16</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 980.15 957.75)" clip-path="url(#clipPath7635)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">18</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 974.86 826.88)" clip-path="url(#clipPath7636)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">19</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 988.35 601.48)" clip-path="url(#clipPath7637)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">20</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 986.3 491.02)" clip-path="url(#clipPath7638)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">21</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 980.49 382.17)" clip-path="url(#clipPath7639)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">22</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 979.3 277.26)" clip-path="url(#clipPath7640)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">23</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 978.61 168.41)" clip-path="url(#clipPath7641)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">33</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 898.66 170.03)" clip-path="url(#clipPath7642)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">34</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 893.54 274.76)" clip-path="url(#clipPath7643)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">32</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 899.86 383.78)" clip-path="url(#clipPath7644)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">31</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 893.03 496.39)" clip-path="url(#clipPath7645)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">30</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 895.59 600.59)" clip-path="url(#clipPath7646)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">29</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 896.61 826.88)" clip-path="url(#clipPath7647)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">28</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 903.79 958.82)" clip-path="url(#clipPath7648)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">27</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 895.59 1065.9)" clip-path="url(#clipPath7649)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">26</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 895.25 1178.7)" clip-path="url(#clipPath7650)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">25</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 909.77 1295.4)" clip-path="url(#clipPath7651)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">24</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 682.73 162.51)" clip-path="url(#clipPath7652)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">36</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 539.4 173.07)" clip-path="url(#clipPath7653)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">37</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 430.92 170.74)" clip-path="url(#clipPath7654)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">38</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 354.39 170.56)" clip-path="url(#clipPath7655)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">39</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 342.09 1065.6)" clip-path="url(#clipPath7656)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">61</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 450.4 1176.9)" clip-path="url(#clipPath7657)" xml:space="preserve"><tspan x="0 25.872 55.062 81.606003 110.334 139.062" y="0" fill="#000000" font-family="Verdana" font-size="42px">TREAS.</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 449.88 1186.2)" clip-path="url(#clipPath7658)" xml:space="preserve"><tspan x="0 28.728001 54.599998 87.653999 116.844" y="0" fill="#000000" font-family="Verdana" font-size="42px">STORE</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 449.71 1195.4)" clip-path="url(#clipPath7659)" xml:space="preserve"><tspan x="0 29.190001 64.596001" y="0" fill="#000000" font-family="Verdana" font-size="42px">RM.</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 818.54 1168.1)" clip-path="url(#clipPath7660)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">68</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 794.97 1061.1)" clip-path="url(#clipPath7661)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">67</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 789.84 972.25)" clip-path="url(#clipPath7662)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">66</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 320.39 1155.8)" clip-path="url(#clipPath7663)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">60</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 340.21 978.15)" clip-path="url(#clipPath7664)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">62</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 468.85 287.47)" clip-path="url(#clipPath7665)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">63</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 568.27 284.42)" clip-path="url(#clipPath7666)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">64</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 657.11 291.94)" clip-path="url(#clipPath7667)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">65</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 975.37 1064.8)" clip-path="url(#clipPath7668)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">17</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 459.62 1215.5)" clip-path="url(#clipPath7669)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">12</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 674.02 1216.1)" clip-path="url(#clipPath7670)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">13</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 734.49 1218.2)" clip-path="url(#clipPath7671)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">14</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 154 935.9)" clip-path="url(#clipPath7672)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">47</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 154.68 1050.1)" clip-path="url(#clipPath7673)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">48</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 157.08 1165.6)" clip-path="url(#clipPath7674)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">49</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 155.54 1289.7)" clip-path="url(#clipPath7675)" xml:space="preserve"><tspan x="0 64.236" y="0" fill="#000000" font-family="Verdana" font-size="101px">50</tspan></text>
            <text transform="matrix(.17083 0 0 .17903 521.46 1191)" clip-path="url(#clipPath7676)" xml:space="preserve"><tspan x="0 17.681999 49.098 73.248001 106.302 121.59 136.37399 165.10201 194.29201 220.836" y="0" fill="#000000" font-family="Verdana" font-size="42px">INFO. AREA</tspan></text>
            <text transform="scale(.97685 1.0237)" x="151.35594" y="806.15839" style="font-size:2.0986px;stroke-width:.17488" xml:space="preserve"><tspan x="151.35594 162.58966" y="806.15839" fill="#000000" font-family="Verdana" font-size="17.663px" style="stroke-width:.17488">46</tspan></text>
            <text transform="scale(.97685 1.0237)" x="239.14682" y="804.23468" style="font-size:2.0986px;stroke-width:.17488" xml:space="preserve"><tspan x="239.14682 250.38057" y="804.23468" fill="#000000" font-family="Verdana" font-size="17.663px" style="stroke-width:.17488">55</tspan></text>
            <text transform="scale(.97685 1.0237)" x="925.03497" y="1362.7976" style="font-size:2.0986px;stroke-width:.17488" xml:space="preserve"><tspan x="925.03497" y="1362.7976" fill="#000000" font-family="Verdana" font-size="17.663px" style="stroke-width:.17488">6</tspan></text>
            <path d="m139.82 43.957v1.4322l-4.1-0.7161z" fill="#0f0" stroke="#0f0" stroke-linecap="round" stroke-miterlimit="10" style="stroke-width:.17488"/>
            <path d="m1017 43.957v1.4322l4.1-0.7161z" fill="#0f0" stroke="#0f0" stroke-linecap="round" stroke-miterlimit="10" style="stroke-width:.17488"/>
            <path d="m57.99 121.48h1.3667l-0.68333-4.2967z" fill="#0f0" stroke="#0f0" stroke-linecap="round" stroke-miterlimit="10" style="stroke-width:.17488"/>
            <path d="m57.99 1433.7h1.3667l-0.68333 4.4757z" fill="#0f0" stroke="#0f0" stroke-linecap="round" stroke-miterlimit="10" style="stroke-width:.17488"/>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 6293h41v-41h-41v41" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 4427h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 3805h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 5671h42v-41h-42v41" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4130 2923h-41v-41h41v41" stroke-width="2"/>
              <g stroke-width="4">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3805v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 3805v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4427v73"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 4427v73"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4385v622"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 4385v622"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5049v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 5049v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5671v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 5671v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 6293v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 6293v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5655h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5645h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 5655h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 5645h380"/>
              </g>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4411h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4401h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 5007v-580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 5007v-580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3789h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3779h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 3805v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 3805v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2540h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2529h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 3183v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 3183v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 4411h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 4401h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 3789h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 3779h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 2540h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 2529h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6278h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6267h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 6278h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 6267h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 6252v-581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 6252v-581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6900h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6889h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 6900h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 6889h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 6874v-581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 6874v-581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7522h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7511h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 7496v-581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 7496v-581"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3183v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3183v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3805v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3805v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3805v1202"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3805v1202"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 5049v1203"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5049v1203"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6293v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6293v581"/>
              </g>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8144h381"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8133h381"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8144h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8133h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 7522h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 7511h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1178 7511h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 3183h41v-42h-41v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 8740v-581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 8740v-581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 8118v-519"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 8118v-519"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 3141v-78"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3141v-94"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4130 2923h-41v-41h41v41"/>
              </g>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 2555v586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 2555v586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3167h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3157h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 3167h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 3157h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1434 1933v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1444 1933v581"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3805v1202" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3805v1202" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3141v-78" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3141v-94" stroke-width="2"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 3141h-21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 3141v-186"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 3141h26v-186h16v186"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 3032-56 50 15 18-53-17 16 20-77 61"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2870 2923v135"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 3048h-1511"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 3058h-1511v-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2870 3058h415"/>
              </g>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4835 3141h26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4802 3110h49"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4773 3079h78"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4742 3048h109"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3017h124"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 2986h124"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 2955h124"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3141v-186"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 2923h-124v218-186"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3141h-16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3110h-49"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3079h-78"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3048h-109"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3017h-124"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 2986h-124"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 2955h-140v186"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 2923v241"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 2927v237"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 3032 54 55-13 13 38-13-10 17 55 53" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4929 5349v-293" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5349v-293" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5432v-78" stroke-width="3"/>
              <g stroke-width="4">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4994 5964h-267v-11h267v11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6150v-10h397v10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6150h-185"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4917 6150h-190"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4918 6038v-74h-10v74h10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5020 5067h-293v-11h293"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 4859h11v208h-11v-208"/>
              </g>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3044 8740v-581h10v581h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2605 8133v623h-96v10h106v-633h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8289h21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3187 8289h64v-156"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8299h21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3187 8299h64"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8346v-213"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8299v47"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 2671-216 216"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 2891-31 32"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 2686-202 201"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 2906-21 21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 2923v241"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 2927v237"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8610v-152h10v-112h-10v112"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8458v154"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 2555h41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 6273h843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 7517h843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3326 7522h10v376h-10v-376"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4552 8133h10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4552 8133v633h159v-10h-149v-623"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5364 1892h-10v-491h10v491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 1892h-10v-491h10v491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 2255h-10v-322h10v322"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5354 1790v11h-617v-11h617"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1856 1892h10v-491h-10v491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 1892h10v-491h-10v491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 2255h10v-322h-10v322"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 1790v11h612v-11h-612"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1866 1790v11h617v-11h-617"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8133v11h-380v-11h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8133v11h380v-11h-380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 8740h-11v-581h11v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 3141h-11v-586h11v586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3157v10h-360v-10h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 3167v-10h380v10h-380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 3763h-11v-580h11v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 4385h-11v-580h11v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 5007h-11v-580h11v580"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 6252h-11v-581h11v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 6874h-11v-581h11v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 7496h-11v-581h11v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 8118h-11v-519h11v519"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2529v11h-360v-11h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 2540v-11h380v11h-380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3779v10h-360v-10h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 3789v-10h380v10h-380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4401v10h-360v-10h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 4411v-10h380v10h-380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5023v10h-360v-10h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 5033v-10h380v10h-380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6267v11h-360v-11h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 6278v-11h380v11h-380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6889v11h-360v-11h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 6900v-11h380v11h-380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7511v11h-360v-11h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 7522v-11h380v11h-380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5033h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5023h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 5033h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 5023h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1612 7511h-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5786 2514h-11v-581h11v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3814 7522h11v376h-11v-376"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3183h42v-42h-42v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6293h42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 5049h42v-42h-42v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 3805h42v-42h-42v42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2252 2532h31v-31h-31v31"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 2667h-31v31h31v-31" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2337 2887h-31v31h31v-31" stroke-width="4"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2504 2721h-32v31h32v-31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2815 2721h-31v31h31v-31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4968 2532h-31v-31h31v31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 2667h31v31h-31v-31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 2887h31v31h-31v-31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4716 2721h31v31h-31v-31"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4405 2721h31v31h-31v-31"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 6293h-42v-41h42v41" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2088 3670h26v-26h-26v26" stroke-width="4"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke="#000" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 5049v1203"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5049v1203"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5049v1203"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 5049v1203"/>
              </g>
              <g stroke="#545454" stroke-width="2">
              <path transform="matrix(-.16 0 0 .16 344.83 537.89)" d="m4.3655-6.0986c1.304 0.93339 2.2744 2.2602 2.769 3.7856"/>
              <path transform="matrix(-.16 0 0 .16 360.35 540.13)" d="m104.19-16.56c0.74647 4.6968 1.1745 9.4386 1.2812 14.193"/>
              <path transform="matrix(-.16 0 0 .16 353.63 540.45)" d="m60.894-24.129c2.5818 6.5156 4.1011 13.403 4.5 20.401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 6510h4l1-1v1h4l1 1h2l2 2 2 1 1 2 1 1 4 8v13l-3 6-1 1-1 2-1 1-2 1-1 1-2 1-1 1h-2l-1 1h-4l-2-1h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2139 6504 2 1h2l3 1 4 2 2 2 2 1 2 2 1 2 1 3 1 2 2 6v11l-1 2-2 6-2 4-4 4-2 1-2 2-2 1h-3l-2 1h-5l-2-1h-2l-3-1-2-2-2-1-2-2-1-2-2-2-1-2-2-6-1-2v-11l2-6 1-2 1-3 2-2 1-2 2-1 2-2 2-1 3-1 2-1h2l3-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2139 6507h5l6 3 2 2 1 2 2 2 4 8v14l-1 2-1 3-2 4-5 5-6 3h-2l-2 1h-3l-2-1h-2l-6-3-1-2-2-1-1-2-2-2-1-2-1-3v-2l-1-2v-9l1-3v-2l2-4 2-2 1-2 2-2 1-2 6-3h6"/>
              <path transform="matrix(-.16 0 0 .16 344.19 540.29)" d="m-3.2813-1.2179c0.43625-1.1754 1.4678-2.0276 2.7044-2.2342 1.2366-0.20664 2.4892 0.26391 3.2839 1.2336"/>
              <path transform="matrix(-.16 0 0 .16 344.19 540.29)" d="m-1.6675-1.8626c0.75051-0.67189 1.8309-0.82771 2.7407-0.39528"/>
              <path transform="matrix(-.16 0 0 .16 344.83 542.53)" d="m7.1342 2.3137c-0.49469 1.5254-1.4653 2.8521-2.7693 3.7853"/>
              <path transform="matrix(-.16 0 0 .16 360.35 540.29)" d="m105.48 2.0329c-0.0939 4.8696-0.5248 9.7268-1.2898 14.537"/>
              <path transform="matrix(-.16 0 0 .16 343.23 540.29)" d="m2.4993-0.058c0.03203 1.3802-1.0608 2.5252-2.4411 2.5573"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6529 7 1"/>
              <path transform="matrix(-.16 0 0 .16 344.35 540.29)" d="m-0.19831 1.4868c-0.77291-0.10308-1.3379-0.78117-1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 344.19 540.29)" d="m2.707 2.2186c-0.7947 0.96966-2.0473 1.4402-3.2839 1.2336-1.2366-0.20663-2.2682-1.0589-2.7044-2.2342"/>
              <path transform="matrix(-.16 0 0 .16 344.19 540.29)" d="m1.0732 2.2579c-0.90978 0.43243-1.9902 0.27661-2.7407-0.39528"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 6533v-1"/>
              <path transform="matrix(-.16 0 0 .16 344.83 540.29)" d="m-1.4988 0.05967c-0.03259-0.8187 0.59778-1.5121 1.4159-1.5574"/>
              <path transform="matrix(-.16 0 0 .16 344.83 540.29)" d="m-0.08294 1.4977c-0.81809-0.04531-1.4485-0.73868-1.4159-1.5574"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 6530h2"/>
              <path transform="matrix(-.16 0 0 .16 344.51 540.13)" d="m-0.18233 1.4889c-0.18054-0.02211-0.35556-0.07688-0.51651-0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 6530-5-1h-3l-3-1"/>
              <path transform="matrix(-.16 0 0 .16 342.75 540.29)" d="m3.4998-0.0396c0.02184 1.9309-1.5243 3.5147-3.4552 3.5393"/>
              <path transform="matrix(-.16 0 0 .16 342.75 540.29)" d="m0.04496-3.4997c1.9309 0.02481 3.4768 1.6087 3.4548 3.5396"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 6534h6l5-1"/>
              <path transform="matrix(-.16 0 0 .16 344.51 540.29)" d="m-0.69884-1.3273c0.16095-0.08474 0.33597-0.13951 0.51651-0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 6533h2"/>
              <path transform="matrix(-.16 0 0 .16 343.23 540.29)" d="m-0.37441-2.4718c0.72566-0.10992 1.463 0.10458 2.0164 0.58663 0.55344 0.48204 0.8671 1.1829 0.85781 1.9168"/>
              <path transform="matrix(-.16 0 0 .16 343.23 540.29)" d="m2.4998-0.0314c0.00922 0.73384-0.30447 1.4347-0.8579 1.9166s-1.2907 0.69647-2.0163 0.58655"/>
              <path transform="matrix(-.16 0 0 .16 343.23 540.29)" d="m0.05848-2.4993c1.3802 0.0323 2.473 1.1773 2.4408 2.5576"/>
              <path transform="matrix(-.16 0 0 .16 344.83 540.29)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 344.83 540.29)" d="m-0.98107 1.1347c-0.34892-0.30169-0.53964-0.74714-0.51714-1.2079"/>
              <path transform="matrix(-.16 0 0 .16 344.83 540.29)" d="m-0.19831 1.4868c-0.28965-0.03863-0.56171-0.16102-0.78276-0.35214"/>
              <path transform="matrix(-.16 0 0 .16 344.51 540.13)" d="m-0.69884 1.3273c-0.43508-0.22908-0.73027-0.65686-0.79004-1.1449"/>
              <path transform="matrix(-.16 0 0 .16 344.51 540.29)" d="m-1.4889-0.18233c0.05977-0.48807 0.35496-0.91585 0.79004-1.1449"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6534 7-1"/>
              <path transform="matrix(-.16 0 0 .16 344.35 540.29)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 342.43 540.29)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(-.16 0 0 .16 342.43 540.29)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 343.39 540.29)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 343.39 540.29)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 353.63 540.13)" d="m65.412 3.3895c-0.36868 7.1149-1.8957 14.122-4.5208 20.745"/>
              <path transform="matrix(-.16 0 0 .16 345.31 553.09)" d="m4.3655-6.0986c1.304 0.93339 2.2744 2.2602 2.769 3.7856"/>
              <path transform="matrix(-.16 0 0 .16 360.67 555.33)" d="m104.19-16.56c0.74647 4.6968 1.1745 9.4386 1.2812 14.193"/>
              <path transform="matrix(-.16 0 0 .16 354.11 555.65)" d="m60.894-24.129c2.5818 6.5156 4.1011 13.403 4.5 20.401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 6415h9l1 1h2l1 1 2 1 1 1 1 2 1 1 4 8v3l1 2v2l-1 2v4l-3 6-1 1-1 2-1 1-2 1-2 2-2 1h-1l-2 1h-4l-2-1h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2141 6409 2 1h3l6 3 2 2 2 1 2 2 1 2 2 3 1 2v3l1 3v2l1 3-1 3v3l-1 2v3l-1 3-2 2-1 2-4 4-2 1-2 2-2 1h-2l-3 1h-5l-2-1h-2l-3-1-2-2-2-1-1-2-4-4-1-2-2-6-1-2v-11l2-6 1-2 1-3 7-7 2-1 3-1 2-1h2l3-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2141 6412h5l6 3 2 2 1 2 2 2 4 8v5l1 2-1 2v5l-1 2-1 3-2 4-5 5-6 3h-2l-1 1h-4l-2-1h-2l-4-2-3-3-2-1-1-2-2-2-1-2v-3l-2-4v-9l1-3 1-2v-2l1-2 2-2 1-2 5-5 4-2h6"/>
              <path transform="matrix(-.16 0 0 .16 344.51 555.49)" d="m-3.2813-1.2179c0.43625-1.1754 1.4678-2.0276 2.7044-2.2342 1.2366-0.20664 2.4892 0.26391 3.2839 1.2336"/>
              <path transform="matrix(-.16 0 0 .16 344.51 555.49)" d="m-1.6675-1.8626c0.75051-0.67189 1.8309-0.82771 2.7407-0.39528"/>
              <path transform="matrix(-.16 0 0 .16 345.31 557.73)" d="m7.1342 2.3137c-0.49469 1.5254-1.4653 2.8521-2.7693 3.7853"/>
              <path transform="matrix(-.16 0 0 .16 360.67 555.49)" d="m105.48 2.0329c-0.0939 4.8696-0.5248 9.7268-1.2898 14.537"/>
              <path transform="matrix(-.16 0 0 .16 343.55 555.49)" d="m2.4993-0.058c0.03203 1.3802-1.0608 2.5252-2.4411 2.5573"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130 6434 8 1"/>
              <path transform="matrix(-.16 0 0 .16 344.67 555.49)" d="m-0.19831 1.4868c-0.77291-0.10308-1.3379-0.78117-1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 344.51 555.49)" d="m2.707 2.2186c-0.7947 0.96966-2.0473 1.4402-3.2839 1.2336-1.2366-0.20663-2.2682-1.0589-2.7044-2.2342"/>
              <path transform="matrix(-.16 0 0 .16 344.51 555.49)" d="m1.0732 2.2579c-0.90978 0.43243-1.9902 0.27661-2.7407-0.39528"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2140 6438 1-1"/>
              <path transform="matrix(-.16 0 0 .16 345.31 555.49)" d="m-1.4988 0.05967c-0.03259-0.8187 0.59778-1.5121 1.4159-1.5574"/>
              <path transform="matrix(-.16 0 0 .16 345.31 555.49)" d="m-0.08294 1.4977c-0.81809-0.04531-1.4485-0.73868-1.4159-1.5574"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2141 6435h-2"/>
              <path transform="matrix(-.16 0 0 .16 344.83 555.33)" d="m-0.18233 1.4889c-0.18054-0.02211-0.35556-0.07688-0.51651-0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 6435-4-1h-4l-3-1"/>
              <path transform="matrix(-.16 0 0 .16 343.07 555.49)" d="m3.4998-0.0396c0.02184 1.9309-1.5243 3.5147-3.4552 3.5393"/>
              <path transform="matrix(-.16 0 0 .16 343.07 555.49)" d="m0.04496-3.4997c1.9309 0.02481 3.4768 1.6087 3.4548 3.5396"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 6439h7l4-1"/>
              <path transform="matrix(-.16 0 0 .16 344.83 555.49)" d="m-0.69884-1.3273c0.16095-0.08474 0.33597-0.13951 0.51651-0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2139 6438h1"/>
              <path transform="matrix(-.16 0 0 .16 343.55 555.49)" d="m-0.37441-2.4718c0.72566-0.10992 1.463 0.10458 2.0164 0.58663 0.55344 0.48204 0.8671 1.1829 0.85781 1.9168"/>
              <path transform="matrix(-.16 0 0 .16 343.55 555.49)" d="m2.4998-0.0314c0.00922 0.73384-0.30447 1.4347-0.8579 1.9166s-1.2907 0.69647-2.0163 0.58655"/>
              <path transform="matrix(-.16 0 0 .16 343.55 555.49)" d="m0.05848-2.4993c1.3802 0.0323 2.473 1.1773 2.4408 2.5576"/>
              <path transform="matrix(-.16 0 0 .16 345.15 555.49)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 345.15 555.49)" d="m-0.98107 1.1347c-0.34892-0.30169-0.53964-0.74714-0.51714-1.2079"/>
              <path transform="matrix(-.16 0 0 .16 345.15 555.49)" d="m-0.19831 1.4868c-0.28965-0.03863-0.56171-0.16102-0.78276-0.35214"/>
              <path transform="matrix(-.16 0 0 .16 344.83 555.33)" d="m-0.69884 1.3273c-0.43508-0.22908-0.73027-0.65686-0.79004-1.1449"/>
              <path transform="matrix(-.16 0 0 .16 344.83 555.49)" d="m-1.4889-0.18233c0.05977-0.48807 0.35496-0.91585 0.79004-1.1449"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130 6439 8-1"/>
              <path transform="matrix(-.16 0 0 .16 344.67 555.49)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 342.75 555.49)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(-.16 0 0 .16 342.75 555.49)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 343.71 555.49)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 343.71 555.49)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 354.11 555.33)" d="m65.412 3.3895c-0.36868 7.1149-1.8957 14.122-4.5208 20.745"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2317.8 6208.7c-0.4363 1.1753-1.4678 2.0278-2.7044 2.2343-1.2366 0.2066-2.4892-0.2641-3.2839-1.2334" stroke="#808080"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2319.7 6209.4c-0.6856 1.8466-2.3067 3.186-4.2498 3.5107s-3.9116-0.4146-5.1604-1.9385" stroke="#808080"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2314 6206-6-2h-3" stroke="#000" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6210h3l6-1" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6210h3l6-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6209h3l6-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6208h3l5-1"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2309.6 6205c1.1648-2.2495 3.7158-3.4126 6.178-2.8169 2.4624 0.5962 4.1992 2.7969 4.2063 5.3301 0.01 2.5337-1.717 4.7441-4.176 5.354-2.459 0.6098-5.0164-0.5391-6.1939-2.7823" stroke="#000" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2309.6 6205c1.1648-2.2495 3.7158-3.4126 6.178-2.8169 2.4624 0.5962 4.1992 2.7969 4.2063 5.3301 0.01 2.5337-1.717 4.7441-4.176 5.354-2.459 0.6098-5.0164-0.5391-6.1939-2.7823" stroke="#000" stroke-width="2"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2311.8 6205.3c0.7947-0.9692 2.0473-1.4399 3.2839-1.2334 1.2366 0.2066 2.2681 1.0591 2.7044 2.2344"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2310.2 6204c1.2488-1.524 3.2173-2.2632 5.1604-1.9385s3.5642 1.6641 4.2498 3.5107"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2320 6207h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2314 6213v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2314 6205v-3"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2312.7 6205.7c0.9666-0.9663 2.5303-0.977 3.5103-0.024 0.98 0.9527 1.0132 2.5161 0.074 3.5098-0.9389 0.9931-2.5014 1.0483-3.5083 0.124" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2318 6211-2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2316 6205 2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2310 6211 2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2312 6205-1-2"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2315.1 6206.1c0.553 0.2335 0.9131 0.7745 0.9158 1.375 0 0.6001-0.353 1.1441-0.9038 1.3829" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2315.2 6206.2c0.5066 0.2568 0.8247 0.7778 0.8215 1.3462 0 0.5679-0.3267 1.0854-0.8362 1.3369"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2314.7 6207.1c0.1526 0.086 0.2493 0.2456 0.2547 0.4204 0.01 0.1748-0.081 0.3403-0.2281 0.4355"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2314 6207"/>
              </g>
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6204 3 1 6 1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6205h3l6 2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6206h3l5 1"/>
              </g>
              </g>
              <g stroke="#000">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2302 6210v-6" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6210h-3" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6204h-3" stroke-width="3"/>
              </g>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6210h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6209h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6208h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6206h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6205h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 6204h-3"/>
              </g>
              <g stroke="#000" stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 6175 4-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6174 4-3 2-2v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2469 6173 3-4 2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 6169 3-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2469 6173h1l5 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 6170 4 1 5 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2469 6168 3 1h3l2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6166 3 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6167 1 5 1 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6166 1 4v1l1 4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2474 6167 2 4v2"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 597.89)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 597.89)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2478 6176v-11h-11v11h11"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2283.2 6209.7c-0.7946 0.9693-2.0473 1.44-3.2839 1.2334-1.2366-0.2065-2.2681-1.059-2.7043-2.2343" stroke="#808080"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2284.8 6211c-1.2488 1.5239-3.2173 2.2632-5.1604 1.9385s-3.5642-1.6641-4.2497-3.5107" stroke="#808080"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280 6206 7-2h3" stroke="#000" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6210h-3l-7-1" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6210h-3l-7-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6209h-3l-7-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6208h-3l-5-1"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2285.4 6210.1c-1.1777 2.2432-3.7353 3.3916-6.1941 2.7818-2.4589-0.6104-4.1828-2.8213-4.1755-5.3545 0.01-2.5332 1.7444-4.7339 4.2068-5.3296s5.0132 0.5674 6.1777 2.8174" stroke="#000" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2285.4 6210.1c-1.1777 2.2432-3.7353 3.3916-6.1941 2.7818-2.4589-0.6104-4.1828-2.8213-4.1755-5.3545 0.01-2.5332 1.7444-4.7339 4.2068-5.3296s5.0132 0.5674 6.1777 2.8174" stroke="#000" stroke-width="2"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2277.2 6206.3c0.4365-1.1753 1.468-2.0273 2.7048-2.2339 1.2366-0.2065 2.489 0.2642 3.2837 1.2339"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.3 6205.6c0.6855-1.8466 2.3069-3.186 4.25-3.5102 1.9431-0.3247 3.9116 0.415 5.1602 1.939"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 6207h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280 6213v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280 6205v-3"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2282.2 6209.3c-1.0068 0.9248-2.5693 0.8691-3.508-0.1245-0.9388-0.9937-0.9056-2.5566 0.075-3.5093 0.98-0.9531 2.5437-0.9419 3.5102 0.025" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2276 6211 2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2279 6205-2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2285 6211-2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2282 6205 2-2"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280.9 6208.9c-0.551-0.2388-0.9065-0.7828-0.9038-1.3833 0-0.6001 0.363-1.1411 0.9158-1.375" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280.8 6208.8c-0.5095-0.2515-0.833-0.769-0.8362-1.3374 0-0.5679 0.3152-1.0889 0.8218-1.3457"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2281.2 6207.9c-0.147-0.095-0.2334-0.2607-0.2281-0.4355 0.01-0.1748 0.1021-0.3345 0.2547-0.4204"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2281 6207"/>
              </g>
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6204-3 1-7 1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6205h-3l-7 2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6206h-3l-5 1"/>
              </g>
              </g>
              <g stroke="#000">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2292 6210v-6" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6210h2" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6204h2" stroke-width="3"/>
              </g>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6210h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6209h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6208h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6206h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6205h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2290 6204h2"/>
              </g>
              <g stroke="#000">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6169-2-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6172-6-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 6174-6-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 6174-4-3v-1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 6166h-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6167-6 2h-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 6170-4 1-5 1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128 6172h-1l-5 2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2123 6166-1 3-1 2v2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 6166-2 8"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 6170"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 6167-1 5-1 2"/>
                <path transform="matrix(0 -.16 -.16 0 342.59 598.05)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
                <path transform="matrix(0 -.16 -.16 0 342.59 598.05)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 6176v-12h12v12h-12"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2219 5953v-83h10v83h-10"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 5767h72v-186h-72v186"/>
              </g>
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5574h-141v3h141v-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5628v-51h3v51"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5630 2-2h-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5695v7h3v-7"/>
              </g>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2305 5891v62h3v-62h-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2388 5891v62h3v-62h-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2452 5869h41v3h-41v-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2431 5789h62v-3h-62v3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 5570h145v11h-145v-11"/>
              </g>
              </g>
              <g stroke="#545454" stroke-width="2">
              <path transform="matrix(-.16 0 0 .16 345.63 681.57)" d="m4.3655-6.0986c1.304 0.93339 2.2744 2.2602 2.769 3.7856"/>
              <path transform="matrix(-.16 0 0 .16 360.99 683.81)" d="m104.19-16.56c0.74647 4.6968 1.1745 9.4386 1.2812 14.193"/>
              <path transform="matrix(-.16 0 0 .16 354.43 684.13)" d="m60.894-24.129c2.5818 6.5156 4.1011 13.403 4.5 20.401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 5612h9l2 1h1l2 1 5 5 2 4v2l1 2v1l1 2v6l-1 2v2l-1 2v2l-1 2-5 5-2 1-1 1-2 1h-1l-2 1h-4l-1-1h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5607h5l4 2 3 1 5 5 2 3 2 4 1 3v3l1 2v6l-1 3v2l-2 6-1 2-4 4-1 2-2 1-3 2-2 1h-2l-3 1h-4l-3-1h-2l-2-1-2-2-2-1-4-4-1-2-2-2-2-6v-2l-1-3v-6l1-2v-3l1-3 1-2 2-2 1-3 2-2 2-1 2-2 6-3h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5609h4l2 1h2l2 1 1 2 2 1 2 2 5 10v3l1 2v5l-1 2v2l-1 2-1 3-3 6-2 1-3 3-4 2h-2l-2 1h-4l-2-1h-2l-1-1-4-2-5-5-2-4-1-3-1-2v-2l-1-2v-5l1-2v-3l4-8 2-2 1-2 2-1 2-2 2-1h1l2-1h4"/>
              <path transform="matrix(-.16 0 0 .16 344.99 683.97)" d="m-3.2813-1.2179c0.43625-1.1754 1.4678-2.0276 2.7044-2.2342 1.2366-0.20664 2.4892 0.26391 3.2839 1.2336"/>
              <path transform="matrix(-.16 0 0 .16 344.99 683.97)" d="m-1.6675-1.8626c0.75051-0.67189 1.8309-0.82771 2.7407-0.39528"/>
              <path transform="matrix(-.16 0 0 .16 345.63 686.21)" d="m7.1342 2.3137c-0.49469 1.5254-1.4653 2.8521-2.7693 3.7853"/>
              <path transform="matrix(-.16 0 0 .16 360.99 683.97)" d="m105.48 2.0329c-0.0939 4.8696-0.5248 9.7268-1.2898 14.537"/>
              <path transform="matrix(-.16 0 0 .16 343.87 683.97)" d="m2.4993-0.058c0.03203 1.3802-1.0608 2.5252-2.4411 2.5573"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 5631 8 1"/>
              <path transform="matrix(-.16 0 0 .16 345.15 683.97)" d="m-0.19831 1.4868c-0.77291-0.10308-1.3379-0.78117-1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 344.99 683.97)" d="m2.707 2.2186c-0.7947 0.96966-2.0473 1.4402-3.2839 1.2336-1.2366-0.20663-2.2682-1.0589-2.7044-2.2342"/>
              <path transform="matrix(-.16 0 0 .16 344.99 683.97)" d="m1.0732 2.2579c-0.90978 0.43243-1.9902 0.27661-2.7407-0.39528"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2142 5635h1"/>
              <path transform="matrix(-.16 0 0 .16 345.63 683.97)" d="m-1.4988 0.05967c-0.03259-0.8187 0.59778-1.5121 1.4159-1.5574"/>
              <path transform="matrix(-.16 0 0 .16 345.63 683.97)" d="m-0.08294 1.4977c-0.81809-0.04531-1.4485-0.73868-1.4159-1.5574"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5632h-2"/>
              <path transform="matrix(-.16 0 0 .16 345.15 683.81)" d="m-0.18233 1.4889c-0.18054-0.02211-0.35556-0.07688-0.51651-0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2140 5632-4-1h-3l-4-1"/>
              <path transform="matrix(-.16 0 0 .16 343.39 683.97)" d="m3.4998-0.0396c0.02184 1.9309-1.5243 3.5147-3.4552 3.5393"/>
              <path transform="matrix(-.16 0 0 .16 343.39 683.97)" d="m0.04496-3.4997c1.9309 0.02481 3.4768 1.6087 3.4548 3.5396"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 5636h7l4-1"/>
              <path transform="matrix(-.16 0 0 .16 345.15 683.97)" d="m-0.69884-1.3273c0.16095-0.08474 0.33597-0.13951 0.51651-0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2141 5635h1"/>
              <path transform="matrix(-.16 0 0 .16 343.87 683.97)" d="m-0.37441-2.4718c0.72566-0.10992 1.463 0.10458 2.0164 0.58663 0.55344 0.48204 0.8671 1.1829 0.85781 1.9168"/>
              <path transform="matrix(-.16 0 0 .16 343.87 683.97)" d="m2.4998-0.0314c0.00922 0.73384-0.30447 1.4347-0.8579 1.9166s-1.2907 0.69647-2.0163 0.58655"/>
              <path transform="matrix(-.16 0 0 .16 343.87 683.97)" d="m0.05848-2.4993c1.3802 0.0323 2.473 1.1773 2.4408 2.5576"/>
              <path transform="matrix(-.16 0 0 .16 345.47 683.97)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 345.47 683.97)" d="m-0.98107 1.1347c-0.34892-0.30169-0.53964-0.74714-0.51714-1.2079"/>
              <path transform="matrix(-.16 0 0 .16 345.47 683.97)" d="m-0.19831 1.4868c-0.28965-0.03863-0.56171-0.16102-0.78276-0.35214"/>
              <path transform="matrix(-.16 0 0 .16 345.15 683.81)" d="m-0.69884 1.3273c-0.43508-0.22908-0.73027-0.65686-0.79004-1.1449"/>
              <path transform="matrix(-.16 0 0 .16 345.15 683.97)" d="m-1.4889-0.18233c0.05977-0.48807 0.35496-0.91585 0.79004-1.1449"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 5636 8-1"/>
              <path transform="matrix(-.16 0 0 .16 345.15 683.97)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 343.23 683.97)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(-.16 0 0 .16 343.23 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 344.19 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 344.19 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 354.43 683.81)" d="m65.412 3.3895c-0.36868 7.1149-1.8957 14.122-4.5208 20.745"/>
              <path transform="matrix(-.16 0 0 .16 345.63 668.93)" d="m4.3655-6.0986c1.304 0.93339 2.2744 2.2602 2.769 3.7856"/>
              <path transform="matrix(-.16 0 0 .16 360.99 671.17)" d="m104.19-16.56c0.74647 4.6968 1.1745 9.4386 1.2812 14.193"/>
              <path transform="matrix(-.16 0 0 .16 354.43 671.33)" d="m60.894-24.129c2.5818 6.5156 4.1011 13.403 4.5 20.401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 5692h2l1-1h5l1 1h2l1 1 2 1 5 5 2 4v1l1 2v2l1 2v6l-1 2v2l-1 2v2l-1 1-1 2-4 4-2 1-1 1-2 1h-3l-1 1h-1l-2-1h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5686h2l3 1 4 2 3 1 2 1 1 2 4 4 1 3 1 2 1 3v2l1 3v6l-1 2v3l-1 3-1 2-1 3-4 4-1 2-2 1-3 1-4 2h-3l-2 1-2-1h-3l-8-4-4-4-1-2-2-3-1-2-1-3v-3l-1-2v-6l1-3v-2l1-3 1-2 2-3 1-2 4-4 8-4 3-1h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5688h2l2 1h2l4 2 3 3 2 1 2 4 1 3 2 4v2l1 3v4l-1 3v2l-2 4-1 3-1 2-6 6-4 2h-4l-2 1-2-1h-4l-1-1-4-2-2-2-1-2-2-1-1-2-1-3-2-4v-2l-1-3v-4l1-3v-2l2-4 1-3 1-2 5-5 4-2 1-1h2l2-1h2"/>
              <path transform="matrix(-.16 0 0 .16 344.99 671.17)" d="m-3.2813-1.2179c0.43625-1.1754 1.4678-2.0276 2.7044-2.2342 1.2366-0.20664 2.4892 0.26391 3.2839 1.2336"/>
              <path transform="matrix(-.16 0 0 .16 344.99 671.17)" d="m-1.6675-1.8626c0.75051-0.67189 1.8309-0.82771 2.7407-0.39528"/>
              <path transform="matrix(-.16 0 0 .16 345.63 673.57)" d="m7.1342 2.3137c-0.49469 1.5254-1.4653 2.8521-2.7693 3.7853"/>
              <path transform="matrix(-.16 0 0 .16 360.99 671.17)" d="m105.48 2.0329c-0.0939 4.8696-0.5248 9.7268-1.2898 14.537"/>
              <path transform="matrix(-.16 0 0 .16 343.87 671.17)" d="m2.4993-0.058c0.03203 1.3802-1.0608 2.5252-2.4411 2.5573"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 5711 8 1"/>
              <path transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-0.19831 1.4868c-0.77291-0.10308-1.3379-0.78117-1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 344.99 671.17)" d="m2.707 2.2186c-0.7947 0.96966-2.0473 1.4402-3.2839 1.2336-1.2366-0.20663-2.2682-1.0589-2.7044-2.2342"/>
              <path transform="matrix(-.16 0 0 .16 344.99 671.17)" d="m1.0732 2.2579c-0.90978 0.43243-1.9902 0.27661-2.7407-0.39528"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2142 5714h1"/>
              <path transform="matrix(-.16 0 0 .16 345.63 671.17)" d="m-1.4988 0.05967c-0.03259-0.8187 0.59778-1.5121 1.4159-1.5574"/>
              <path transform="matrix(-.16 0 0 .16 345.63 671.17)" d="m-0.08294 1.4977c-0.81809-0.04531-1.4485-0.73868-1.4159-1.5574"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2143 5712h-2"/>
              <path transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-0.18233 1.4889c-0.18054-0.02211-0.35556-0.07688-0.51651-0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2140 5711h-4l-3-1h-4"/>
              <path transform="matrix(-.16 0 0 .16 343.39 671.17)" d="m3.4998-0.0396c0.02184 1.9309-1.5243 3.5147-3.4552 3.5393"/>
              <path transform="matrix(-.16 0 0 .16 343.39 671.17)" d="m0.04496-3.4997c1.9309 0.02481 3.4768 1.6087 3.4548 3.5396"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 5716h4l3-1h4"/>
              <path transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-0.69884-1.3273c0.16095-0.08474 0.33597-0.13951 0.51651-0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2141 5715 1-1"/>
              <path transform="matrix(-.16 0 0 .16 343.87 671.17)" d="m-0.37441-2.4718c0.72566-0.10992 1.463 0.10458 2.0164 0.58663 0.55344 0.48204 0.8671 1.1829 0.85781 1.9168"/>
              <path transform="matrix(-.16 0 0 .16 343.87 671.17)" d="m2.4998-0.0314c0.00922 0.73384-0.30447 1.4347-0.8579 1.9166s-1.2907 0.69647-2.0163 0.58655"/>
              <path transform="matrix(-.16 0 0 .16 343.87 671.17)" d="m0.05848-2.4993c1.3802 0.0323 2.473 1.1773 2.4408 2.5576"/>
              <path transform="matrix(-.16 0 0 .16 345.47 671.17)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 345.47 671.17)" d="m-0.98107 1.1347c-0.34892-0.30169-0.53964-0.74714-0.51714-1.2079"/>
              <path transform="matrix(-.16 0 0 .16 345.47 671.17)" d="m-0.19831 1.4868c-0.28965-0.03863-0.56171-0.16102-0.78276-0.35214"/>
              <path transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-0.69884 1.3273c-0.43508-0.22908-0.73027-0.65686-0.79004-1.1449"/>
              <path transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-1.4889-0.18233c0.05977-0.48807 0.35496-0.91585 0.79004-1.1449"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 5715 8-1"/>
              <path transform="matrix(-.16 0 0 .16 345.15 671.17)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
              <path transform="matrix(-.16 0 0 .16 343.23 671.17)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(-.16 0 0 .16 343.23 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 344.19 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 344.19 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 354.43 671.01)" d="m65.412 3.3895c-0.36868 7.1149-1.8957 14.122-4.5208 20.745"/>
              </g>
              <g stroke="#000">
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2389 5964v5"/>
                <path transform="matrix(0 -.16 -.16 0 385.79 630.21)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2394 5974h83"/>
                <path transform="matrix(0 -.16 -.16 0 399.07 628.61)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5979v83"/>
                <path transform="matrix(0 -.16 -.16 0 400.67 615.33)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 6067h6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2393 5964v5"/>
                <path transform="matrix(0 -.16 -.16 0 385.79 630.21)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2394 5970h83"/>
                <path transform="matrix(0 -.16 -.16 0 399.07 628.61)" d="m-9.5 0c0-5.2467 4.2533-9.5 9.5-9.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5979v83"/>
                <path transform="matrix(0 -.16 -.16 0 400.67 615.33)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 6063h6"/>
              </g>
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 5704h-141v-2h141v2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2248 5565v5h-3v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2247 5563-2 2h3"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2248 5493h-3" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5565v9h3v-9" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5563 2 2h-3" stroke-width="2"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2241 5445v48h11v-48"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2358 5450v43h-10v-42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5450v32h-96v11h96v-11"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2248 5493v5h-3v-5h3" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5493v5h3v-5h-3" stroke-width="2"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 7352h-103v-104h103v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 7248h-103v-103h103v103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 7145h-103v-104h103v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 7041h-103v-104h103v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6937h-103v-103h103v103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6834h-103v-104h103v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7352h-103v-104h103v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7248h-103v-103h103v103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7145h-103v-104h103v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7041h-103v-104h103v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 6803h-103v-103h103v103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6730h-103v-104h103v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 6700h-103v-104h103v104"/>
              </g>
              </g>
              <g stroke="#545454" stroke-width="2">
              <path transform="matrix(-.16 0 0 .16 815.87 537.89)" d="m-7.1342-2.3137c0.49469-1.5254 1.4653-2.8521 2.7693-3.7853"/>
              <path transform="matrix(-.16 0 0 .16 800.51 540.13)" d="m-105.47-2.3768c0.10713-4.7545 0.53564-9.4963 1.2826-14.193"/>
              <path transform="matrix(-.16 0 0 .16 807.07 540.29)" d="m-65.393-3.7344c0.39959-6.9971 1.9196-13.885 4.502-20.4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 6511h-2l-1-1h-5l-1 1h-1l-2 1-1 1-2 1-1 1-2 1-3 6v1l-1 2v2l-1 2v6l1 2v2l1 2v1l2 4 2 1 1 2 1 1 2 1 1 1 2 1h3l1 1h2l1-1h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 6505h-2l-3 1h-2l-2 1-2 2-2 1-6 6-1 3-1 2-1 3v2l-1 3v6l1 2v3l1 3 1 2 1 3 4 4 2 1 2 2 6 3h3l2 1 2-1h3l6-3 2-2 2-1 2-2 1-2 2-3 1-2 1-3v-3l1-2v-6l-1-3v-2l-1-3-1-2-2-3-1-2-4-4-2-1-2-2-2-1h-2l-3-1h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 6507h-2l-2 1h-2l-2 1-1 1-2 1-2 2-2 1-3 6-1 3-1 2v2l-1 3v4l1 3v2l3 6 1 3 5 5 2 1 1 1 2 1h12l1-1 4-2 2-2 1-2 2-1 1-3 3-6v-2l1-3v-4l-1-3v-2l-1-2-1-3-2-4-5-5-4-2-1-1h-2l-2-1h-2"/>
              <path transform="matrix(-.16 0 0 .16 816.51 540.13)" d="m-2.7068-2.2188c0.79478-0.96959 2.0475-1.44 3.284-1.2333 1.2365 0.20675 2.268 1.0591 2.7042 2.2345"/>
              <path transform="matrix(-.16 0 0 .16 816.51 540.13)" d="m-1.073-2.258c0.90982-0.43234 1.9902-0.27642 2.7407 0.39554"/>
              <path transform="matrix(-.16 0 0 .16 815.87 542.53)" d="m-4.3649 6.099c-1.304-0.93327-2.2746-2.26-2.7693-3.7853"/>
              <path transform="matrix(-.16 0 0 .16 800.51 540.13)" d="m-104.19 16.57c-0.76495-4.81-1.1959-9.6673-1.2898-14.537"/>
              <path transform="matrix(-.16 0 0 .16 817.63 540.13)" d="m-0.05824 2.4993c-1.3803-0.03216-2.4732-1.1772-2.4411-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 6530-8 1"/>
              <path transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m1.4982-0.07303c0.03796 0.77878-0.52705 1.4568-1.2999 1.5599"/>
              <path transform="matrix(-.16 0 0 .16 816.51 540.13)" d="m3.2813 1.2179c-0.43625 1.1754-1.4678 2.0276-2.7044 2.2342-1.2366 0.20664-2.4892-0.26391-3.2839-1.2336"/>
              <path transform="matrix(-.16 0 0 .16 816.51 540.13)" d="m1.6675 1.8626c-0.75051 0.67189-1.8309 0.82771-2.7407 0.39528"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5083 6533h-1"/>
              <path transform="matrix(-.16 0 0 .16 815.87 540.13)" d="m0.08308-1.4977c0.81803 0.04538 1.4483 0.73873 1.4157 1.5574"/>
              <path transform="matrix(-.16 0 0 .16 815.87 540.13)" d="m1.4988-0.05952c0.03251 0.81864-0.59785 1.5119-1.4159 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 6531h2"/>
              <path transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m0.69884 1.3273c-0.16095 0.08474-0.33597 0.13951-0.51651 0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 6530h4l4-1h3"/>
              <path transform="matrix(-.16 0 0 .16 818.11 540.13)" d="m-0.04463 3.4997c-1.931-0.02463-3.4772-1.6086-3.4551-3.5396"/>
              <path transform="matrix(-.16 0 0 .16 818.11 540.13)" d="m-3.4998 0.03993c-0.02203-1.931 1.5241-3.515 3.4551-3.5396"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 6535h-3l-4-1h-4"/>
              <path transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m0.18247-1.4889c0.18055 0.02213 0.35556 0.07691 0.51649 0.16166"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5084 6534-1-1"/>
              <path transform="matrix(-.16 0 0 .16 817.63 540.13)" d="m-2.4998 0.0314c-0.00922-0.73388 0.30451-1.4347 0.85799-1.9167 0.55349-0.48199 1.2908-0.69643 2.0165-0.58644"/>
              <path transform="matrix(-.16 0 0 .16 817.63 540.13)" d="m0.37441 2.4718c-0.72566 0.10992-1.463-0.10458-2.0164-0.58663-0.55344-0.48204-0.8671-1.1829-0.85781-1.9168"/>
              <path transform="matrix(-.16 0 0 .16 817.63 540.13)" d="m-2.4993 0.05824c-0.03217-1.3803 1.0607-2.5254 2.4411-2.5576"/>
              <path transform="matrix(-.16 0 0 .16 816.03 540.13)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
              <path transform="matrix(-.16 0 0 .16 816.03 540.13)" d="m1.4982-0.07303c0.02246 0.46067-0.16826 0.90606-0.51715 1.2077"/>
              <path transform="matrix(-.16 0 0 .16 816.03 540.13)" d="m0.98107 1.1347c-0.22105 0.19112-0.49311 0.31351-0.78276 0.35214"/>
              <path transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m1.4889 0.18233c-0.05977 0.48807-0.35496 0.91585-0.79004 1.1449"/>
              <path transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m0.69896-1.3272c0.43507 0.22913 0.73021 0.65694 0.78993 1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 6534-8-1"/>
              <path transform="matrix(-.16 0 0 .16 816.35 540.13)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
              <path transform="matrix(-.16 0 0 .16 818.27 540.13)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(-.16 0 0 .16 818.27 540.13)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 817.31 540.13)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 817.31 540.13)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 807.07 539.97)" d="m-60.891 24.135c-2.6243-6.6212-4.1512-13.626-4.5204-20.739"/>
              <path transform="matrix(-.16 0 0 .16 815.71 552.77)" d="m-7.1342-2.3137c0.49469-1.5254 1.4653-2.8521 2.7693-3.7853"/>
              <path transform="matrix(-.16 0 0 .16 800.35 555.01)" d="m-105.47-2.3768c0.10713-4.7545 0.53564-9.4963 1.2826-14.193"/>
              <path transform="matrix(-.16 0 0 .16 806.91 555.17)" d="m-65.393-3.7344c0.39959-6.9971 1.9196-13.885 4.502-20.4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 6418h-2l-1-1h-5l-1 1h-2l-1 1-2 1-1 1-2 1-1 1-2 4-1 1-1 2v2l-1 2v10l1 2v2l1 1 2 4 5 5 2 1h1l2 1h9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5081 6412h-3l-2 1h-2l-3 1-2 2-2 1-2 2-1 2-2 2-1 2-2 6-1 2v11l2 6 2 4 2 3 1 2 2 1 2 2 2 1 3 1 2 1h9l3-1 4-2 2-2 2-1 2-2 1-3 2-4 2-6v-11l-1-2-2-6-2-4-4-4-2-1-2-2-2-1h-3l-2-1h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5081 6414h-2l-2 1h-2l-6 3-1 2-2 1-1 2-2 2-1 2-1 3v2l-1 2v9l1 3v2l2 4 2 2 1 2 5 5 2 1h2l2 1h7l2-1h2l2-1 2-2 2-1 1-2 2-2 3-6v-2l1-3v-9l-1-2v-2l-1-3-2-4-5-5-6-3h-2l-2-1h-1"/>
              <path transform="matrix(-.16 0 0 .16 816.35 555.01)" d="m-2.7068-2.2188c0.79478-0.96959 2.0475-1.44 3.284-1.2333 1.2365 0.20675 2.268 1.0591 2.7042 2.2345"/>
              <path transform="matrix(-.16 0 0 .16 816.35 555.01)" d="m-1.073-2.258c0.90982-0.43234 1.9902-0.27642 2.7407 0.39554"/>
              <path transform="matrix(-.16 0 0 .16 815.71 557.41)" d="m-4.3649 6.099c-1.304-0.93327-2.2746-2.26-2.7693-3.7853"/>
              <path transform="matrix(-.16 0 0 .16 800.35 555.17)" d="m-104.19 16.57c-0.76495-4.81-1.1959-9.6673-1.2898-14.537"/>
              <path transform="matrix(-.16 0 0 .16 817.31 555.01)" d="m-0.05824 2.4993c-1.3803-0.03216-2.4732-1.1772-2.4411-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 6437-7 1"/>
              <path transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m1.4982-0.07303c0.03796 0.77878-0.52705 1.4568-1.2999 1.5599"/>
              <path transform="matrix(-.16 0 0 .16 816.35 555.01)" d="m3.2813 1.2179c-0.43625 1.1754-1.4678 2.0276-2.7044 2.2342-1.2366 0.20664-2.4892-0.26391-3.2839-1.2336"/>
              <path transform="matrix(-.16 0 0 .16 816.35 555.01)" d="m1.6675 1.8626c-0.75051 0.67189-1.8309 0.82771-2.7407 0.39528"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 6440h-1"/>
              <path transform="matrix(-.16 0 0 .16 815.71 555.01)" d="m0.08308-1.4977c0.81803 0.04538 1.4483 0.73873 1.4157 1.5574"/>
              <path transform="matrix(-.16 0 0 .16 815.71 555.01)" d="m1.4988-0.05952c0.03251 0.81864-0.59785 1.5119-1.4159 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5081 6438h1l1-1"/>
              <path transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m0.69884 1.3273c-0.16095 0.08474-0.33597 0.13951-0.51651 0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5083 6437h5l3-1h3"/>
              <path transform="matrix(-.16 0 0 .16 817.79 555.01)" d="m-0.04463 3.4997c-1.931-0.02463-3.4772-1.6086-3.4551-3.5396"/>
              <path transform="matrix(-.16 0 0 .16 817.79 555.01)" d="m-3.4998 0.03993c-0.02203-1.931 1.5241-3.515 3.4551-3.5396"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5094 6442h-3l-3-1h-5"/>
              <path transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m0.18247-1.4889c0.18055 0.02213 0.35556 0.07691 0.51649 0.16166"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5083 6440h-1"/>
              <path transform="matrix(-.16 0 0 .16 817.47 555.01)" d="m-2.4998 0.0314c-0.00922-0.73388 0.30451-1.4347 0.85799-1.9167 0.55349-0.48199 1.2908-0.69643 2.0165-0.58644"/>
              <path transform="matrix(-.16 0 0 .16 817.47 555.01)" d="m0.37441 2.4718c-0.72566 0.10992-1.463-0.10458-2.0164-0.58663-0.55344-0.48204-0.8671-1.1829-0.85781-1.9168"/>
              <path transform="matrix(-.16 0 0 .16 817.31 555.01)" d="m-2.4993 0.05824c-0.03217-1.3803 1.0607-2.5254 2.4411-2.5576"/>
              <path transform="matrix(-.16 0 0 .16 815.87 555.01)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
              <path transform="matrix(-.16 0 0 .16 815.87 555.01)" d="m1.4982-0.07303c0.02246 0.46067-0.16826 0.90606-0.51715 1.2077"/>
              <path transform="matrix(-.16 0 0 .16 815.87 555.01)" d="m0.98107 1.1347c-0.22105 0.19112-0.49311 0.31351-0.78276 0.35214"/>
              <path transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m1.4889 0.18233c-0.05977 0.48807-0.35496 0.91585-0.79004 1.1449"/>
              <path transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m0.69896-1.3272c0.43507 0.22913 0.73021 0.65694 0.78993 1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 6441-7-1"/>
              <path transform="matrix(-.16 0 0 .16 816.19 555.01)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
              <path transform="matrix(-.16 0 0 .16 818.11 555.01)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(-.16 0 0 .16 818.11 555.01)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 817.15 555.01)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 817.15 555.01)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 806.91 554.85)" d="m-60.891 24.135c-2.6243-6.6212-4.1512-13.626-4.5204-20.739"/>
              </g>
              <g stroke="#000" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6578v-210h-62v228h55"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6358h-124v10h124"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4928 6264h71v11h-138"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 6264h56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4928 6264v-114"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4917 6150v114"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4909.2 6209.7c-0.7949 0.9693-2.0473 1.44-3.2837 1.2334-1.2368-0.2065-2.2685-1.059-2.7046-2.2343" stroke="#808080"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4910.8 6211c-1.249 1.5239-3.2173 2.2632-5.1606 1.9385-1.9429-0.3247-3.564-1.6641-4.2496-3.5107" stroke="#808080"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4905 6206 7-2h3" stroke="#000" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6210h-3l-7-1" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6210h-3l-7-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6209h-3l-6-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6208h-3l-5-1"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4911.4 6210.1c-1.1777 2.2432-3.7353 3.3916-6.1943 2.7818-2.4585-0.6104-4.1826-2.8213-4.1753-5.3545 0.01-2.5332 1.7441-4.7339 4.2065-5.3296s5.0132 0.5674 6.1778 2.8174" stroke="#000" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4911.4 6210.1c-1.1777 2.2432-3.7353 3.3916-6.1943 2.7818-2.4585-0.6104-4.1826-2.8213-4.1753-5.3545 0.01-2.5332 1.7441-4.7339 4.2065-5.3296s5.0132 0.5674 6.1778 2.8174" stroke="#000" stroke-width="2"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4903.2 6206.3c0.4366-1.1753 1.4683-2.0273 2.7046-2.2339 1.2369-0.2065 2.4893 0.2642 3.2837 1.2339"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4901.3 6205.6c0.6861-1.8466 2.3072-3.186 4.2505-3.5102 1.9429-0.3247 3.9112 0.415 5.1602 1.939"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4900 6207h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4906 6213v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4906 6205v-3"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4908.2 6209.3c-1.0068 0.9248-2.5693 0.8691-3.5083-0.1245-0.9385-0.9937-0.9053-2.5566 0.075-3.5093 0.9805-0.9531 2.544-0.9419 3.5103 0.025" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4902 6211 2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4904 6205-2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4910 6211-2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4907 6205 2-2"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4905.9 6208.9c-0.5508-0.2388-0.9062-0.7828-0.9038-1.3833 0-0.6001 0.3628-1.1411 0.916-1.375" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4905.8 6208.8c-0.5092-0.2515-0.833-0.769-0.8359-1.3374 0-0.5679 0.3149-1.0889 0.8218-1.3457"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4906.2 6207.9c-0.147-0.095-0.2334-0.2607-0.228-0.4355 0.01-0.1748 0.1025-0.3345 0.2549-0.4204"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4906 6207"/>
              </g>
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6204-3 1-7 1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6205h-3l-6 2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6206h-3l-5 1"/>
              </g>
              </g>
              <g stroke="#000">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4917 6210v-6" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6210h2" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6204h2" stroke-width="3"/>
              </g>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6210h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6209h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6208h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6206h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6205h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 6204h2"/>
              </g>
              <g stroke="#000">
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 6169-3-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 6173-3-4-3-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4750 6174-4-3-2-2v-1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 6175-4-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4747 6166-2 1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 6168-3 1h-3l-2 1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 6170-4 1-5 1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 6173h-1l-5 1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 6167-2 4v2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 6166-1 4v1l-1 4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4750 6167-1 5-1 3"/>
              </g>
              <g stroke-width="2">
                <path transform="matrix(0 -.16 -.16 0 762.27 597.89)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
                <path transform="matrix(0 -.16 -.16 0 762.27 597.89)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 6176v-11h12v11h-12"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942.8 6208.7c-0.436 1.1753-1.4677 2.0278-2.7045 2.2343-1.2364 0.2066-2.4888-0.2641-3.2837-1.2334" stroke="#808080"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4944.7 6209.4c-0.6856 1.8466-2.3067 3.186-4.2496 3.5107-1.9433 0.3247-3.9116-0.4146-5.1606-1.9385" stroke="#808080"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940 6206-7-2h-3" stroke="#000" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6210h3l7-1" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6210h3l7-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6209h3l6-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6208h3l5-1"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934.6 6205c1.1651-2.2495 3.7158-3.4126 6.1782-2.8169 2.462 0.5962 4.1988 2.7969 4.2061 5.3301 0.01 2.5337-1.7173 4.7441-4.1758 5.354-2.459 0.6098-5.0166-0.5391-6.1938-2.7823" stroke="#000" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934.6 6205c1.1651-2.2495 3.7158-3.4126 6.1782-2.8169 2.462 0.5962 4.1988 2.7969 4.2061 5.3301 0.01 2.5337-1.7173 4.7441-4.1758 5.354-2.459 0.6098-5.0166-0.5391-6.1938-2.7823" stroke="#000" stroke-width="2"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4936.8 6205.3c0.7949-0.9692 2.0473-1.4399 3.2837-1.2334 1.2368 0.2066 2.2685 1.0591 2.7045 2.2344"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.2 6204c1.249-1.524 3.2173-2.2632 5.1606-1.9385 1.9429 0.3247 3.564 1.6641 4.2496 3.5107"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4945 6207h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 6213v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 6205v-3"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937.7 6205.7c0.9668-0.9663 2.5303-0.977 3.5103-0.024 0.98 0.9527 1.0132 2.5161 0.074 3.5098-0.9385 0.9931-2.5015 1.0483-3.5078 0.124" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4944 6211-3-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 6205 2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 6211 2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 6205-2-2"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940.1 6206.1c0.5527 0.2335 0.9131 0.7745 0.9155 1.375 0 0.6001-0.353 1.1441-0.9038 1.3829" stroke="#000" stroke-width="3"/>
              <g stroke="#808080">
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940.2 6206.2c0.5069 0.2568 0.8247 0.7778 0.8218 1.3462 0 0.5679-0.3267 1.0854-0.8359 1.3369"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939.7 6207.1c0.1528 0.086 0.249 0.2456 0.2549 0.4204 0.01 0.1748-0.081 0.3403-0.228 0.4355"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 6207"/>
              </g>
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6204 3 1 7 1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6205h3l6 2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6206h3l5 1"/>
              </g>
              </g>
              <g stroke="#000">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4928 6210v-6" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6210h-2" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6204h-2" stroke-width="3"/>
              </g>
              <g stroke="#808080">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6210h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6209h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6208h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6206h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6205h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4930 6204h-2"/>
              </g>
              <g stroke="#000">
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 6174 4-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 6174 6-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092 6172 3-3 2-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 6169 3-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092 6172h1l5 2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 6170 4 1 5 1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092 6167 6 2h2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 6166h3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 6167 1 5 1 2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 6166 2 8"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 6170"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 6166 1 3 1 2v2"/>
              </g>
              <g stroke-width="2">
                <path transform="matrix(0 -.16 -.16 0 818.11 598.05)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
                <path transform="matrix(0 -.16 -.16 0 818.11 598.05)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5s-4.5-2.0147-4.5-4.5 2.0147-4.5 4.5-4.5 4.5 2.0147 4.5 4.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5101 6176v-12h-11v12h11"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4846 6275v-11h15"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 6275h-15" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4994 5953v-83h-11v83h11" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5767h-72v-186h72v186" stroke-width="3"/>
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5574h141v3h-141v-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5603v-26h-3v26"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5605-2-2h3"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5670h-3" stroke-width="3"/>
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5670v32h-3v-32"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4915 5891v62h-3v-62h3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4832 5891v62h-3v-62h3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4768 5869h-41v3h41v-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4789 5789h-62v-3h62v3"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5570h-145v11h145v-11" stroke-width="3"/>
              </g>
              <g stroke="#545454" stroke-width="2">
              <path transform="matrix(-.16 0 0 .16 815.07 681.57)" d="m-7.1342-2.3137c0.49469-1.5254 1.4653-2.8521 2.7693-3.7853"/>
              <path transform="matrix(-.16 0 0 .16 799.71 683.81)" d="m-105.47-2.3768c0.10713-4.7545 0.53564-9.4963 1.2826-14.193"/>
              <path transform="matrix(-.16 0 0 .16 806.27 684.13)" d="m-65.393-3.7344c0.39959-6.9971 1.9196-13.885 4.502-20.4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 5612h-9l-2 1h-1l-2 1-5 5-3 6v2l-1 1v10l1 2v2l2 4 1 1 1 2 2 1 1 1 2 1 1 1 2 1h1l1 1h5l1-1h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5607h-5l-2 1-3 1-2 1-2 2-2 1-1 2-2 3-2 4-2 6v11l1 2 2 6 1 2 2 2 1 2 2 2 2 1 2 2 3 1h2l2 1h5l2-1h3l2-1 2-2 2-1 4-4 1-2 2-2 1-3v-3l1-2v-3l1-3-1-3v-2l-1-3v-3l-1-2-2-2-1-3-2-2-2-1-2-2-4-2-3-1h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5609h-4l-2 1h-2l-2 1-1 2-2 1-2 2-1 2-2 2-1 2v2l-1 2-1 3v9l2 4v3l1 2 2 2 1 2 2 1 3 3 4 2h2l2 1h4l1-1h2l6-3 5-5 2-4 1-3 1-2v-14l-4-8-2-2-1-2-2-1-2-2-2-1h-2l-2-1h-3"/>
              <path transform="matrix(-.16 0 0 .16 815.71 683.97)" d="m-2.7068-2.2188c0.79478-0.96959 2.0475-1.44 3.284-1.2333 1.2365 0.20675 2.268 1.0591 2.7042 2.2345"/>
              <path transform="matrix(-.16 0 0 .16 815.71 683.97)" d="m-1.073-2.258c0.90982-0.43234 1.9902-0.27642 2.7407 0.39554"/>
              <path transform="matrix(-.16 0 0 .16 815.07 686.21)" d="m-4.3649 6.099c-1.304-0.93327-2.2746-2.26-2.7693-3.7853"/>
              <path transform="matrix(-.16 0 0 .16 799.71 683.97)" d="m-104.19 16.57c-0.76495-4.81-1.1959-9.6673-1.2898-14.537"/>
              <path transform="matrix(-.16 0 0 .16 816.67 683.97)" d="m-0.05824 2.4993c-1.3803-0.03216-2.4732-1.1772-2.4411-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 5631-8 1"/>
              <path transform="matrix(-.16 0 0 .16 815.55 683.97)" d="m1.4982-0.07303c0.03796 0.77878-0.52705 1.4568-1.2999 1.5599"/>
              <path transform="matrix(-.16 0 0 .16 815.71 683.97)" d="m3.2813 1.2179c-0.43625 1.1754-1.4678 2.0276-2.7044 2.2342-1.2366 0.20664-2.4892-0.26391-3.2839-1.2336"/>
              <path transform="matrix(-.16 0 0 .16 815.71 683.97)" d="m1.6675 1.8626c-0.75051 0.67189-1.8309 0.82771-2.7407 0.39528"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5078 5635h-1"/>
              <path transform="matrix(-.16 0 0 .16 815.07 683.97)" d="m0.08308-1.4977c0.81803 0.04538 1.4483 0.73873 1.4157 1.5574"/>
              <path transform="matrix(-.16 0 0 .16 815.07 683.97)" d="m1.4988-0.05952c0.03251 0.81864-0.59785 1.5119-1.4159 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5632h2"/>
              <path transform="matrix(-.16 0 0 .16 815.55 683.81)" d="m0.69884 1.3273c-0.16095 0.08474-0.33597 0.13951-0.51651 0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5080 5632 4-1h3l4-1"/>
              <path transform="matrix(-.16 0 0 .16 817.31 683.97)" d="m-0.04463 3.4997c-1.931-0.02463-3.4772-1.6086-3.4551-3.5396"/>
              <path transform="matrix(-.16 0 0 .16 817.31 683.97)" d="m-3.4998 0.03993c-0.02203-1.931 1.5241-3.515 3.4551-3.5396"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 5636h-7l-4-1"/>
              <path transform="matrix(-.16 0 0 .16 815.55 683.97)" d="m0.18247-1.4889c0.18055 0.02213 0.35556 0.07691 0.51649 0.16166"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5079 5635h-1"/>
              <path transform="matrix(-.16 0 0 .16 816.83 683.97)" d="m-2.4998 0.0314c-0.00922-0.73388 0.30451-1.4347 0.85799-1.9167 0.55349-0.48199 1.2908-0.69643 2.0165-0.58644"/>
              <path transform="matrix(-.16 0 0 .16 816.83 683.97)" d="m0.37441 2.4718c-0.72566 0.10992-1.463-0.10458-2.0164-0.58663-0.55344-0.48204-0.8671-1.1829-0.85781-1.9168"/>
              <path transform="matrix(-.16 0 0 .16 816.67 683.97)" d="m-2.4993 0.05824c-0.03217-1.3803 1.0607-2.5254 2.4411-2.5576"/>
              <path transform="matrix(-.16 0 0 .16 815.23 683.97)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
              <path transform="matrix(-.16 0 0 .16 815.23 683.97)" d="m1.4982-0.07303c0.02246 0.46067-0.16826 0.90606-0.51715 1.2077"/>
              <path transform="matrix(-.16 0 0 .16 815.23 683.97)" d="m0.98107 1.1347c-0.22105 0.19112-0.49311 0.31351-0.78276 0.35214"/>
              <path transform="matrix(-.16 0 0 .16 815.55 683.81)" d="m1.4889 0.18233c-0.05977 0.48807-0.35496 0.91585-0.79004 1.1449"/>
              <path transform="matrix(-.16 0 0 .16 815.55 683.97)" d="m0.69896-1.3272c0.43507 0.22913 0.73021 0.65694 0.78993 1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 5636-8-1"/>
              <path transform="matrix(-.16 0 0 .16 815.55 683.97)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
              <path transform="matrix(-.16 0 0 .16 817.47 683.97)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(-.16 0 0 .16 817.47 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 816.51 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 816.51 683.97)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 806.27 683.81)" d="m-60.891 24.135c-2.6243-6.6212-4.1512-13.626-4.5204-20.739"/>
              <path transform="matrix(-.16 0 0 .16 815.07 668.93)" d="m-7.1342-2.3137c0.49469-1.5254 1.4653-2.8521 2.7693-3.7853"/>
              <path transform="matrix(-.16 0 0 .16 799.71 671.17)" d="m-105.47-2.3768c0.10713-4.7545 0.53564-9.4963 1.2826-14.193"/>
              <path transform="matrix(-.16 0 0 .16 806.27 671.33)" d="m-65.393-3.7344c0.39959-6.9971 1.9196-13.885 4.502-20.4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 5692h-2l-1-1h-5l-1 1h-2l-1 1-2 1-5 5-2 4-1 1v2l-1 2v10l1 2v2l1 2 1 1 2 4 2 1 1 1 2 1 1 1 2 1h2l2 1h1l2-1h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5686h-3l-4 2-3 1-4 2-2 2-1 2-2 2-1 3-1 2-1 3-1 2v11l2 6 1 2 1 3 2 2 1 2 2 2 4 2 3 1 2 1h2l3 1 2-1h2l3-1 6-3 4-4 1-2 2-3 1-2v-3l1-3v-2l1-3-1-3v-3l-1-2v-3l-1-2-2-3-1-2-4-4-6-3-3-1-2-1h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5688h-2l-2 1h-2l-4 2-3 3-2 1-1 2-2 2-1 3v2l-2 4v10l2 4v2l1 3 8 8 4 2h4l2 1 2-1h3l6-3 2-2 1-2 2-1 1-2 1-3 2-4v-14l-2-4-1-3-1-2-5-5-6-3h-2l-1-1h-2"/>
              <path transform="matrix(-.16 0 0 .16 815.71 671.17)" d="m-2.7068-2.2188c0.79478-0.96959 2.0475-1.44 3.284-1.2333 1.2365 0.20675 2.268 1.0591 2.7042 2.2345"/>
              <path transform="matrix(-.16 0 0 .16 815.71 671.17)" d="m-1.073-2.258c0.90982-0.43234 1.9902-0.27642 2.7407 0.39554"/>
              <path transform="matrix(-.16 0 0 .16 815.07 673.57)" d="m-4.3649 6.099c-1.304-0.93327-2.2746-2.26-2.7693-3.7853"/>
              <path transform="matrix(-.16 0 0 .16 799.71 671.17)" d="m-104.19 16.57c-0.76495-4.81-1.1959-9.6673-1.2898-14.537"/>
              <path transform="matrix(-.16 0 0 .16 816.67 671.17)" d="m-0.05824 2.4993c-1.3803-0.03216-2.4732-1.1772-2.4411-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 5711-8 1"/>
              <path transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m1.4982-0.07303c0.03796 0.77878-0.52705 1.4568-1.2999 1.5599"/>
              <path transform="matrix(-.16 0 0 .16 815.71 671.17)" d="m3.2813 1.2179c-0.43625 1.1754-1.4678 2.0276-2.7044 2.2342-1.2366 0.20664-2.4892-0.26391-3.2839-1.2336"/>
              <path transform="matrix(-.16 0 0 .16 815.71 671.17)" d="m1.6675 1.8626c-0.75051 0.67189-1.8309 0.82771-2.7407 0.39528"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5078 5714h-1"/>
              <path transform="matrix(-.16 0 0 .16 815.07 671.17)" d="m0.08308-1.4977c0.81803 0.04538 1.4483 0.73873 1.4157 1.5574"/>
              <path transform="matrix(-.16 0 0 .16 815.07 671.17)" d="m1.4988-0.05952c0.03251 0.81864-0.59785 1.5119-1.4159 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5077 5712h2"/>
              <path transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m0.69884 1.3273c-0.16095 0.08474-0.33597 0.13951-0.51651 0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5080 5711h4l3-1h4"/>
              <path transform="matrix(-.16 0 0 .16 817.31 671.17)" d="m-0.04463 3.4997c-1.931-0.02463-3.4772-1.6086-3.4551-3.5396"/>
              <path transform="matrix(-.16 0 0 .16 817.31 671.17)" d="m-3.4998 0.03993c-0.02203-1.931 1.5241-3.515 3.4551-3.5396"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091 5716h-4l-3-1h-4"/>
              <path transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m0.18247-1.4889c0.18055 0.02213 0.35556 0.07691 0.51649 0.16166"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5079 5715-1-1"/>
              <path transform="matrix(-.16 0 0 .16 816.83 671.17)" d="m-2.4998 0.0314c-0.00922-0.73388 0.30451-1.4347 0.85799-1.9167 0.55349-0.48199 1.2908-0.69643 2.0165-0.58644"/>
              <path transform="matrix(-.16 0 0 .16 816.83 671.17)" d="m0.37441 2.4718c-0.72566 0.10992-1.463-0.10458-2.0164-0.58663-0.55344-0.48204-0.8671-1.1829-0.85781-1.9168"/>
              <path transform="matrix(-.16 0 0 .16 816.67 671.17)" d="m-2.4993 0.05824c-0.03217-1.3803 1.0607-2.5254 2.4411-2.5576"/>
              <path transform="matrix(-.16 0 0 .16 815.23 671.17)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
              <path transform="matrix(-.16 0 0 .16 815.23 671.17)" d="m1.4982-0.07303c0.02246 0.46067-0.16826 0.90606-0.51715 1.2077"/>
              <path transform="matrix(-.16 0 0 .16 815.23 671.17)" d="m0.98107 1.1347c-0.22105 0.19112-0.49311 0.31351-0.78276 0.35214"/>
              <path transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m1.4889 0.18233c-0.05977 0.48807-0.35496 0.91585-0.79004 1.1449"/>
              <path transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m0.69896-1.3272c0.43507 0.22913 0.73021 0.65694 0.78993 1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 5715-8-1"/>
              <path transform="matrix(-.16 0 0 .16 815.55 671.17)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
              <path transform="matrix(-.16 0 0 .16 817.47 671.17)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(-.16 0 0 .16 817.47 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 816.51 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 816.51 671.17)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.16 0 0 .16 806.27 671.01)" d="m-60.891 24.135c-2.6243-6.6212-4.1512-13.626-4.5204-20.739"/>
              </g>
              <g stroke="#000">
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4831 5964v5"/>
                <path transform="matrix(0 -.16 -.16 0 774.91 630.21)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4826 5974h-83"/>
                <path transform="matrix(0 -.16 -.16 0 761.63 628.61)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5979v83"/>
                <path transform="matrix(0 -.16 -.16 0 760.03 615.33)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 6067h-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4827 5964v5"/>
                <path transform="matrix(0 -.16 -.16 0 774.91 630.21)" d="m1.4e-4 -1.5c0.82837 8e-5 1.4999 0.67163 1.4999 1.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4826 5970h-83"/>
                <path transform="matrix(0 -.16 -.16 0 761.63 628.61)" d="m0 9.5c-5.2467 0-9.5-4.2533-9.5-9.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5979v83"/>
                <path transform="matrix(0 -.16 -.16 0 760.03 615.33)" d="m1.4e-4 -1.5c0.82837 8e-5 1.4999 0.67163 1.4999 1.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 6063h-6"/>
              </g>
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5704h141v-2h-141v2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4972 5565v5h3v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4973 5563 2 2h-3"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4972 5493h3" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5565v9h-3v-9" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5563-2 2h3" stroke-width="2"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4979 5445v48h-11v-48"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 5450v43h11v-42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5450v32h96v11h-96v-11"/>
              </g>
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4972 5493v5h3v-5h-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5493v5h-3v-5h3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4831 4673v5"/>
                <path transform="matrix(0 -.16 -.16 0 774.91 836.77)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4826 4683h-83"/>
                <path transform="matrix(0 -.16 -.16 0 761.63 835.17)" d="m0 5.5c-3.0376 0-5.5-2.4624-5.5-5.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 4688v83"/>
                <path transform="matrix(0 -.16 -.16 0 760.03 821.89)" d="m5.3e-4 -5.5c3.0374 2.9e-4 5.4995 2.4626 5.4995 5.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 4776h-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4827 4673v5"/>
                <path transform="matrix(0 -.16 -.16 0 774.91 836.77)" d="m1.4e-4 -1.5c0.82837 8e-5 1.4999 0.67163 1.4999 1.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4826 4679h-83"/>
                <path transform="matrix(0 -.16 -.16 0 761.63 835.17)" d="m0 9.5c-5.2467 0-9.5-4.2533-9.5-9.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 4688v83"/>
                <path transform="matrix(0 -.16 -.16 0 760.03 821.89)" d="m1.4e-4 -1.5c0.82837 8e-5 1.4999 0.67163 1.4999 1.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 4772h-6"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6874v-71h103v134h-103v-22" stroke-width="3"/>
              </g>
              <g stroke="#545454" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090.9 4333.4c1.3042 0.9336 2.2744 2.2602 2.7691 3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.7 4336.9c0.7466 4.6968 1.1743 9.4385 1.2812 14.193"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092.4 4330.4c2.5821 6.5156 4.1016 13.404 4.5005 20.401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 4374h-1l-2 1h-3l-1-1h-3l-2-1-2-2-2-1-1-2-1-1-2-4-1-1-1-2v-12l1-2v-2l1-2 1-1 2-4 1-1 2-1 1-1 2-1 1-1h2l1-1h4l2 1h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4380h-2l-2-1-3-1-6-3-4-4-1-2-1-3-1-2-1-3-1-2v-12l1-2 1-3 1-2 1-3 1-2 4-4 6-3 3-1 2-1h5l4 2 3 1 4 2 2 2 1 2 2 2 1 3 1 2 1 3 1 2v12l-1 2-1 3-1 2-1 3-2 2-1 2-2 2-4 2-3 1-4 2h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4378-1-1h-4l-6-3-5-5-1-2-1-3-2-4v-14l2-4 1-3 1-2 5-5 6-3h2l2-1h3l2 1h2l6 3 1 2 2 1 1 2 2 2 1 3 1 2v2l1 2v10l-1 2v2l-1 2-1 3-2 2-1 2-2 1-1 2-6 3h-4l-2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.2 4352.3c0.4361-1.1753 1.4678-2.0278 2.7046-2.2344 1.2364-0.2065 2.4888 0.2642 3.2837 1.2334"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.8 4351.6c0.7505-0.6719 1.8311-0.8276 2.7407-0.395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.6 4369.8c-0.4947 1.5254-1.4654 2.852-2.7696 3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 4355.5c-0.094 4.8696-0.5249 9.7271-1.2901 14.537"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4353.4c0.032 1.3804-1.061 2.5254-2.4414 2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4355-7-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5089.3 4355c-0.773-0.103-1.3379-0.7812-1.2999-1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.2 4355.7c-0.7949 0.9693-2.0473 1.44-3.2837 1.2334-1.2368-0.2065-2.2685-1.059-2.7046-2.2343"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091.6 4355.8c-0.9096 0.4326-1.9902 0.2769-2.7407-0.395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 4352"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4353.6c-0.032-0.8184 0.5981-1.5122 1.416-1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.4 4355c-0.8179-0.045-1.4483-0.7388-1.416-1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4354h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.3 4355c-0.1807-0.022-0.356-0.077-0.5166-0.1617"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4354 5 1 3 1h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4353.5c0.021 1.9307-1.5244 3.5147-3.4556 3.5391"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099.5 4350c1.9312 0.024 3.4771 1.6084 3.4551 3.5395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4350h-3l-3 1h-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4352.2c0.1606-0.085 0.3359-0.1396 0.5166-0.1616"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4351-2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.1 4351c0.7256-0.1098 1.4629 0.1045 2.0166 0.5864 0.5532 0.482 0.8672 1.1831 0.8579 1.917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4353.5c0.01 0.7339-0.3047 1.4346-0.8579 1.9165-0.5537 0.482-1.291 0.6963-2.0166 0.5865"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.6 4351c1.3799 0.033 2.4726 1.1777 2.4409 2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4353.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085.5 4354.6c-0.3491-0.3018-0.5395-0.7471-0.5171-1.208"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.3 4355c-0.2896-0.039-0.5621-0.1611-0.7828-0.352"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4354.8c-0.4351-0.229-0.7305-0.6567-0.7901-1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 4353.3c0.06-0.4883 0.355-0.916 0.7901-1.1451"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4351-7 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4353.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5102 4353.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4353.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4353.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4353.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.9 4355.9c-0.3686 7.1148-1.8955 14.122-4.5205 20.745"/>
              </g>
              <g stroke="#000" stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4252h147v2h-147v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4357h147v2h-147v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 4346v11h-2v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4279v-25h2v25"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 4279h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4344-1 2h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5695h-3"/>
              </g>
              <g stroke="#545454" stroke-width="2">
              <path transform="matrix(-.13857 .079995 .079995 .13857 408.67 360.13)" d="m4.3655-6.0986c1.304 0.93339 2.2744 2.2602 2.769 3.7856"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 423.23 354.37)" d="m104.19-16.56c0.74647 4.6968 1.1745 9.4386 1.2812 14.193"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 417.63 357.73)" d="m60.894-24.129c2.5818 6.5156 4.1011 13.403 4.5 20.401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2551 7624 1 1h2l1 1h1v1h2l1 1 1 2 2 2v2l1 2v4l1 2-1 2v4l-1 1-1 2v2l-1 2-2 1-1 2-4 4-4 2h-1l-2 1h-2l-2 1h-2l-1-1h-3l-1-1-2-1-3-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2558 7622 2 1 5 5 1 2 1 3 1 2v3l1 2-1 3v5l-2 6-2 2-1 3-6 6-2 1-2 2-3 1-2 1h-5l-2 1-3-1h-2l-3-1-4-2-1-2-4-4-2-4v-3l-1-2v-8l2-6 1-2 1-3 1-2 8-8 3-1 4-2 3-1h7l3 1 4 2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2557 7623 2 1 1 2 4 4 1 2v3l1 2v9l-1 3v2l-2 4-2 2-1 2-5 5-6 3-3 1h-10l-4-2-1-1-2-1-1-2-1-1-4-8v-10l2-4 1-3 2-4 6-6 3-2 4-2h2l2-1h7l2 1 1 1h2"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.31 362.37)" d="m-3.2813-1.2179c0.43625-1.1754 1.4678-2.0276 2.7044-2.2342 1.2366-0.20664 2.4892 0.26391 3.2839 1.2336"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.31 362.37)" d="m-1.6675-1.8626c0.75051-0.67189 1.8309-0.82771 2.7407-0.39528"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 411.07 364.13)" d="m7.1342 2.3137c-0.49469 1.5254-1.4653 2.8521-2.7693 3.7853"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 423.23 354.53)" d="m105.48 2.0329c-0.0939 4.8696-0.5248 9.7268-1.2898 14.537"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 408.35 362.85)" d="m2.4993-0.058c0.03203 1.3802-1.0608 2.5252-2.4411 2.5573"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2536 7638 6 4"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.37)" d="m-0.19831 1.4868c-0.77291-0.10308-1.3379-0.78117-1.2999-1.56"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.31 362.37)" d="m2.707 2.2186c-0.7947 0.96966-2.0473 1.4402-3.2839 1.2336-1.2366-0.20663-2.2682-1.0589-2.7044-2.2342"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.31 362.37)" d="m1.0732 2.2579c-0.90978 0.43243-1.9902 0.27661-2.7407-0.39528"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2543 7646h1"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.79 362.05)" d="m-1.4988 0.05967c-0.03259-0.8187 0.59778-1.5121 1.4159-1.5574"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.79 362.05)" d="m-0.08294 1.4977c-0.81809-0.04531-1.4485-0.73868-1.4159-1.5574"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2545 7644-1-1h-1"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.21)" d="m-0.18233 1.4889c-0.18054-0.02211-0.35556-0.07688-0.51651-0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2543 7642-3-3-6-4"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 408.03 363.17)" d="m3.4998-0.0396c0.02184 1.9309-1.5243 3.5147-3.4552 3.5393"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 408.03 363.17)" d="m0.04496-3.4997c1.9309 0.02481 3.4768 1.6087 3.4548 3.5396"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2531 7641 6 2 4 2"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.37)" d="m-0.69884-1.3273c0.16095-0.08474 0.33597-0.13951 0.51651-0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2542 7645 1 1"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 408.35 363.01)" d="m-0.37441-2.4718c0.72566-0.10992 1.463 0.10458 2.0164 0.58663 0.55344 0.48204 0.8671 1.1829 0.85781 1.9168"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 408.35 363.01)" d="m2.4998-0.0314c0.00922 0.73384-0.30447 1.4347-0.8579 1.9166s-1.2907 0.69647-2.0163 0.58655"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 408.35 362.85)" d="m0.05848-2.4993c1.3802 0.0323 2.473 1.1773 2.4408 2.5576"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.79 362.21)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.79 362.21)" d="m-0.98107 1.1347c-0.34892-0.30169-0.53964-0.74714-0.51714-1.2079"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.79 362.21)" d="m-0.19831 1.4868c-0.28965-0.03863-0.56171-0.16102-0.78276-0.35214"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.21)" d="m-0.69884 1.3273c-0.43508-0.22908-0.73027-0.65686-0.79004-1.1449"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.37)" d="m-1.4889-0.18233c0.05977-0.48807 0.35496-0.91585 0.79004-1.1449"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2534 7642 7 2"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 409.47 362.37)" d="m-1.4982 0.07317c-0.03804-0.77883 0.52699-1.4569 1.2999-1.56"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 407.71 363.33)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 407.71 363.33)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 408.51 362.85)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 408.51 362.85)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.13857 .079995 .079995 .13857 417.47 357.57)" d="m65.412 3.3895c-0.36868 7.1149-1.8957 14.122-4.5208 20.745"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 753.15 356.29)" d="m-7.1342-2.3137c0.49469-1.5254 1.4653-2.8521 2.7693-3.7853"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 738.75 350.53)" d="m-105.47-2.3768c0.10713-4.7545 0.53564-9.4963 1.2826-14.193"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 744.35 353.89)" d="m-65.393-3.7344c0.39959-6.9971 1.9196-13.885 4.502-20.4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4677 7649h-4l-6 6-1 2-1 1-1 2v10l1 2v2l1 1 3 6 5 5 6 3h2l1 1h5l2-1h1l2-1h1l3-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4669 7646-2 1-2 2-1 2-2 2-2 4-1 3v10l1 3v2l2 3 1 2 1 3 8 8 2 1 3 1 2 1h3l2 1h5l3-1 6-3 5-5 1-3 2-4v-14l-1-2-1-3-2-2-1-3-6-6-2-1-2-2-3-1-2-1h-3l-2-1h-3l-2 1h-2l-3 1-2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4670 7648-1 1-2 1-1 1-1 2-2 2v2l-2 4v10l6 12 5 5 2 1 3 2 2 1h2l2 1h5l2-1h1l4-2 1-1 2-1 3-3 2-4v-2l1-2v-10l-1-2v-2l-2-4-2-2-1-2-2-2-1-2-6-3-3-1-2-1h-2l-2-1h-2l-2 1h-2l-4 2"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.53)" d="m-2.7068-2.2188c0.79478-0.96959 2.0475-1.44 3.284-1.2333 1.2365 0.20675 2.268 1.0591 2.7042 2.2345"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.53)" d="m-1.073-2.258c0.90982-0.43234 1.9902-0.27642 2.7407 0.39554"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 750.91 360.29)" d="m-4.3649 6.099c-1.304-0.93327-2.2746-2.26-2.7693-3.7853"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 738.59 350.53)" d="m-104.19 16.57c-0.76495-4.81-1.1959-9.6673-1.2898-14.537"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 753.47 359.01)" d="m-0.05824 2.4993c-1.3803-0.03216-2.4732-1.1772-2.4411-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4691 7662-6 5"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.53)" d="m1.4982-0.07303c0.03796 0.77878-0.52705 1.4568-1.2999 1.5599"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.53)" d="m3.2813 1.2179c-0.43625 1.1754-1.4678 2.0276-2.7044 2.2342-1.2366 0.20664-2.4892-0.26391-3.2839-1.2336"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.53)" d="m1.6675 1.8626c-0.75051 0.67189-1.8309 0.82771-2.7407 0.39528"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4684 7670h-1"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.03 358.21)" d="m0.08308-1.4977c0.81803 0.04538 1.4483 0.73873 1.4157 1.5574"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.03 358.21)" d="m1.4988-0.05952c0.03251 0.81864-0.59785 1.5119-1.4159 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4682 7668h1l1-1"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.35 358.37)" d="m0.69884 1.3273c-0.16095 0.08474-0.33597 0.13951-0.51651 0.16162"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4684 7666 4-2 2-3 3-1"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 753.95 359.33)" d="m-0.04463 3.4997c-1.931-0.02463-3.4772-1.6086-3.4551-3.5396"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 753.95 359.33)" d="m-3.4998 0.03993c-0.02203-1.931 1.5241-3.515 3.4551-3.5396"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4696 7665-3 1-3 2-4 1"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.35 358.53)" d="m0.18247-1.4889c0.18055 0.02213 0.35556 0.07691 0.51649 0.16166"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4685 7669-1 1"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 753.47 359.01)" d="m-2.4998 0.0314c-0.00922-0.73388 0.30451-1.4347 0.85799-1.9167 0.55349-0.48199 1.2908-0.69643 2.0165-0.58644"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 753.47 359.01)" d="m0.37441 2.4718c-0.72566 0.10992-1.463-0.10458-2.0164-0.58663-0.55344-0.48204-0.8671-1.1829-0.85781-1.9168"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 753.47 359.01)" d="m-2.4993 0.05824c-0.03217-1.3803 1.0607-2.5254 2.4411-2.5576"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.19 358.21)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.19 358.21)" d="m1.4982-0.07303c0.02246 0.46067-0.16826 0.90606-0.51715 1.2077"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.19 358.21)" d="m0.98107 1.1347c-0.22105 0.19112-0.49311 0.31351-0.78276 0.35214"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.35 358.37)" d="m1.4889 0.18233c-0.05977 0.48807-0.35496 0.91585-0.79004 1.1449"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.35 358.53)" d="m0.69896-1.3272c0.43507 0.22913 0.73021 0.65694 0.78993 1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4693 7666-7 3"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 752.51 358.37)" d="m0.19845-1.4868c0.77285 0.10315 1.3378 0.78121 1.2998 1.56"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 754.11 359.33)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 754.11 359.33)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 753.31 359.01)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 753.31 359.01)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(-.13857 -.079995 -.079995 .13857 744.35 353.73)" d="m-60.891 24.135c-2.6243-6.6212-4.1512-13.626-4.5204-20.739"/>
              </g>
              <g stroke="#000">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4680 7725-4 2 6 12 5-3-7-11" stroke-width="2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4613 7764 4-3 7 11-5 3-6-11" stroke-width="2"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4252h147v2h-147v-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 4241v11h-2v-11"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4174v-25h2v25"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 4174h3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4239-1 2h2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4462h147v2h-147v-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 4451v11h-2v-11"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4384v-25h2v25"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 4384h3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4449-1 2h2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 4567h147v2h-147v-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 4556v11h-2v-11"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4489v-25h2v25"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 4489h3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4554-1 2h2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4582-1-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 4580v-11h-2v11"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4647v15h2v-15"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4580h2"/>
              </g>
              </g>
              <g stroke="#545454" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090.9 4441.4c1.3042 0.9336 2.2744 2.2602 2.7691 3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.7 4444.9c0.7466 4.6968 1.1743 9.4385 1.2812 14.193"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092.4 4438.4c2.5821 6.5156 4.1016 13.404 4.5005 20.401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 4482-1 1h-8l-1-1-2-1h-1l-4-4-1-2-1-1-3-6v-11l1-2v-2l3-6 5-5 2-1h1l2-1h7l1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4488h-4l-3-1-4-2-6-6-2-4-1-3-1-2-1-3v-11l1-3 1-2 1-3 2-4 6-6 4-2 3-1h9l2 1 3 1 2 1 4 4 1 2 2 2 1 2 1 3 1 2 1 3v11l-1 3-1 2-1 3-1 2-2 2-1 2-4 4-2 1-3 1-2 1h-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4486h-3l-10-5-1-2-2-2-3-6-1-3v-13l1-3 3-6 2-2 1-2 10-5h7l8 4 3 3 1 2 2 2 2 4v3l1 2v9l-1 2v3l-2 4-2 2-1 2-3 3-8 4h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.2 4460.3c0.4361-1.1753 1.4678-2.0278 2.7046-2.2344 1.2364-0.2065 2.4888 0.2642 3.2837 1.2334"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.8 4459.6c0.7505-0.6719 1.8311-0.8276 2.7407-0.395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.6 4478.8c-0.4947 1.5254-1.4654 2.852-2.7696 3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 4464.5c-0.094 4.8696-0.5249 9.7271-1.2901 14.537"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4461.4c0.032 1.3804-1.061 2.5254-2.4414 2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4464-7-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5089.3 4463c-0.773-0.103-1.3379-0.7812-1.2999-1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.2 4463.7c-0.7949 0.9693-2.0473 1.44-3.2837 1.2334-1.2368-0.2065-2.2685-1.059-2.7046-2.2343"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091.6 4463.8c-0.9096 0.4326-1.9902 0.2769-2.7407-0.395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 4460"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4461.6c-0.032-0.8184 0.5981-1.5122 1.416-1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.4 4463c-0.8179-0.045-1.4483-0.7388-1.416-1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4463h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.3 4463c-0.1807-0.022-0.356-0.077-0.5166-0.1617"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4463 5 1h6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4461.5c0.021 1.9307-1.5244 3.5147-3.4556 3.5391"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099.5 4458c1.9312 0.024 3.4771 1.6084 3.4551 3.5395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4458-3 1h-3l-5 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4461.2c0.1606-0.085 0.3359-0.1396 0.5166-0.1616"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4460h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.1 4459c0.7256-0.1098 1.4629 0.1045 2.0166 0.5864 0.5532 0.482 0.8672 1.1831 0.8579 1.917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4461.5c0.01 0.7339-0.3047 1.4346-0.8579 1.9165-0.5537 0.482-1.291 0.6963-2.0166 0.5865"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.6 4459c1.3799 0.033 2.4726 1.1777 2.4409 2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4461.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085.5 4462.6c-0.3491-0.3018-0.5395-0.7471-0.5171-1.208"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.3 4463c-0.2896-0.039-0.5621-0.1611-0.7828-0.352"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4462.8c-0.4351-0.229-0.7305-0.6567-0.7901-1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 4462.3c0.06-0.4883 0.355-0.916 0.7901-1.1451"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4459-7 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4461.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5102 4461.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4461.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4461.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4461.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.9 4464.9c-0.3686 7.1148-1.8955 14.122-4.5205 20.745"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090.9 4223.4c1.3042 0.9336 2.2744 2.2602 2.7691 3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.7 4227.9c0.7466 4.6968 1.1743 9.4385 1.2812 14.193"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5092.4 4221.4c2.5821 6.5156 4.1016 13.404 4.5005 20.401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 4265h-3l-1 1h-2l-1-1h-3l-2-1-2-2-2-1-1-2-1-1-3-6-1-1v-12l1-2v-2l1-2 1-1 2-4 1-1 2-1 1-1 2-1 1-1h2l1-1h4l2 1h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4271-2-1h-2l-3-1-6-3-4-4-1-2-1-3-1-2-2-6v-11l1-2 1-3 1-2 1-3 1-2 4-4 6-3 3-1 2-1h5l4 2 3 1 4 2 2 2 1 2 2 2 1 3 1 2 1 3 1 2v11l-2 6-1 2-1 3-2 2-1 2-2 2-4 2-3 1-2 1h-2l-3 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4269-1-1h-4l-6-3-2-2-1-2-2-1-1-2-1-3-2-4v-14l2-4 1-3 1-2 5-5 6-3h2l2-1h3l2 1h2l6 3 1 2 2 1 1 2 2 2 1 3 1 2v2l1 2v10l-1 2v2l-1 2-1 3-5 5-1 2-6 3h-4l-2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.2 4243.3c0.4361-1.1753 1.4678-2.0278 2.7046-2.2344 1.2364-0.2065 2.4888 0.2642 3.2837 1.2334"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.8 4242.6c0.7505-0.6719 1.8311-0.8276 2.7407-0.395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.6 4260.8c-0.4947 1.5254-1.4654 2.852-2.7696 3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 4246.5c-0.094 4.8696-0.5249 9.7271-1.2901 14.537"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4244.4c0.032 1.3804-1.061 2.5254-2.4414 2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4246-7-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5089.3 4246c-0.773-0.103-1.3379-0.7812-1.2999-1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093.2 4246.7c-0.7949 0.9693-2.0473 1.44-3.2837 1.2334-1.2368-0.2065-2.2685-1.059-2.7046-2.2343"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5091.6 4246.8c-0.9096 0.4326-1.9902 0.2769-2.7407-0.395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 4243"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4244.6c-0.032-0.8184 0.5981-1.5122 1.416-1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.4 4246c-0.8179-0.045-1.4483-0.7388-1.416-1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4245h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088.3 4246c-0.1807-0.022-0.356-0.077-0.5166-0.1617"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4245 5 1 3 1h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4244.5c0.021 1.9307-1.5244 3.5147-3.4556 3.5391"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099.5 4241c1.9312 0.024 3.4771 1.6084 3.4551 3.5395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4241h-6l-5 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4243.2c0.1606-0.085 0.3359-0.1396 0.5166-0.1616"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4242-2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.1 4242c0.7256-0.1098 1.4629 0.1045 2.0166 0.5864 0.5532 0.482 0.8672 1.1831 0.8579 1.917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 4244.5c0.01 0.7339-0.3047 1.4346-0.8579 1.9165-0.5537 0.482-1.291 0.6963-2.0166 0.5865"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.6 4242c1.3799 0.033 2.4726 1.1777 2.4409 2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085 4244.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5085.5 4245.6c-0.3491-0.3018-0.5395-0.7471-0.5171-1.208"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086.3 4246c-0.2896-0.039-0.5621-0.1611-0.7828-0.352"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087.8 4245.8c-0.4351-0.229-0.7305-0.6567-0.7901-1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 4244.3c0.06-0.4883 0.355-0.916 0.7901-1.1451"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 4241-7 2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 4244.6c-0.038-0.7788 0.5269-1.457 1.2999-1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5102 4244.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4244.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4244.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 4244.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096.9 4246.9c-0.3686 7.1148-1.8955 14.122-4.5205 20.745"/>
              </g>
              <g stroke="#000" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2389 4673v5"/>
              <path transform="matrix(0 -.16 -.16 0 385.79 836.77)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2394 4683h83"/>
              <path transform="matrix(0 -.16 -.16 0 399.07 835.17)" d="m-5.5 0c0-3.0376 2.4624-5.5 5.5-5.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 4688v83"/>
              <path transform="matrix(0 -.16 -.16 0 400.67 821.89)" d="m5.5 0c0 3.0376-2.4624 5.5-5.5 5.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 4776h6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2393 4673v5"/>
              <path transform="matrix(0 -.16 -.16 0 385.79 836.77)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2394 4679h83"/>
              <path transform="matrix(0 -.16 -.16 0 399.07 835.17)" d="m-9.5 0c0-5.2467 4.2533-9.5 9.5-9.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 4688v83"/>
              <path transform="matrix(0 -.16 -.16 0 400.67 821.89)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 4772h6"/>
              </g>
              <g stroke="#545454" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.4 4337.2c0.4949-1.5254 1.4654-2.852 2.7693-3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 4351.1c0.1071-4.7544 0.5356-9.496 1.2824-14.193"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.1 4350.8c0.3997-6.9971 1.9197-13.885 4.5022-20.4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 4374h2l2 1h2l2-1h3l1-1 2-1 1-1 2-1 1-2 1-1 2-4 1-1v-2l1-2v-10l-1-2v-2l-1-2-1-1-2-4-1-1-2-1-1-1-2-1-1-1h-2l-1-1h-5l-1 1h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4380h3l2-1 3-1 6-3 2-2 1-2 2-2 1-3 1-2 1-3 1-2v-12l-1-2-1-3-1-2-1-3-2-2-1-2-2-2-6-3-3-1-2-1h-5l-2 1-3 1-6 3-2 2-1 2-2 2-1 3-1 2-1 3-1 2v12l1 2 1 3 1 2 1 3 2 2 1 2 2 2 6 3 3 1 2 1h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4378 2-1h4l6-3 1-2 2-1 1-2 2-2 1-3 1-2v-2l1-2v-10l-1-2v-2l-1-2-1-3-2-2-1-2-2-1-1-2-6-3h-2l-2-1h-3l-2 1h-2l-6 3-1 2-2 1-2 2-1 2-1 3-1 2v2l-1 2v10l1 2v2l1 2 1 3 1 2 2 2 2 1 1 2 6 3h4l1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.8 4351.3c0.7947-0.9697 2.0474-1.4399 3.284-1.2334 1.2365 0.2071 2.268 1.0591 2.7043 2.2344"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129.4 4351.2c0.9099-0.4326 1.9902-0.2769 2.7407 0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130.1 4373.6c-1.3039-0.9336-2.2744-2.2602-2.7693-3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2126.3 4370.1c-0.7649-4.81-1.1958-9.6675-1.2898-14.537"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.4 4356c-1.3802-0.032-2.4732-1.1772-2.441-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4355 7-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4353.4c0.038 0.7788-0.5271 1.457-1.3001 1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.8 4354.7c-0.4363 1.1753-1.4678 2.0278-2.7044 2.2343-1.2366 0.2066-2.4892-0.2641-3.2839-1.2334"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4355.4c-0.7505 0.6719-1.8308 0.8276-2.7407 0.395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4352"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.6 4352c0.8181 0.045 1.4485 0.7388 1.4158 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 4353.4c0.033 0.8189-0.5979 1.5122-1.4158 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4354h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4354.8c-0.1609 0.085-0.3359 0.1397-0.5163 0.1617"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4354-5 1-3 1h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121.5 4357c-1.9309-0.024-3.477-1.6084-3.4551-3.5395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 4353.5c-0.022-1.9311 1.5242-3.5151 3.4551-3.5395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4350h3l3 1h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4352c0.1806 0.022 0.3557 0.077 0.5166 0.1616"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4351 2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4353.5c-0.01-0.7338 0.3045-1.4345 0.858-1.9165 0.5534-0.4819 1.2907-0.6962 2.0166-0.5864"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2123.9 4356c-0.7258 0.1098-1.4631-0.1045-2.0166-0.5865-0.5532-0.4819-0.8669-1.1831-0.8577-1.9169"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2122 4353.6c-0.032-1.3804 1.0608-2.5254 2.441-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.7 4352c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2135 4353.4c0.022 0.4609-0.1685 0.9062-0.5173 1.208"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.5 4354.6c-0.221 0.1909-0.493 0.3134-0.7828 0.352"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4353.7c-0.06 0.4883-0.3548 0.916-0.7901 1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4352.2c0.435 0.2291 0.7302 0.6568 0.79 1.1451"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4351 7 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4352c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2120 4353.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4353.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4353.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4353.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128.6 4376.6c-2.6245-6.6216-4.1513-13.626-4.5205-20.739"/>
              </g>
              <g stroke="#000" stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4252h-148v2h148v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4357h-148v2h148v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 4346v11h3v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4279v-25h-3v25"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 4279h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4344 1 2h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4252h-148v2h148v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 4241v11h3v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4174v-25h-3v25"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 4174h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4239 1 2h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4462h-148v2h148v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 4451v11h3v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4384v-25h-3v25"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 4384h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4449 1 2h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 4567h-148v2h148v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 4556v11h3v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4489v-25h-3v25"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 4489h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4554 1 2h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4582 1-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 4580v-11h3v11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4647v15h-3v-15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4580h-3"/>
              </g>
              <g stroke="#545454" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.4 4445.2c0.4949-1.5254 1.4654-2.852 2.7693-3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 4459.1c0.1071-4.7544 0.5356-9.496 1.2824-14.193"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.1 4458.8c0.3997-6.9971 1.9197-13.885 4.5022-20.4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 4482 2 1h7l2-1 1-1h2l4-4 1-2 1-1 2-4v-2l1-2v-9l-1-2v-2l-3-6-5-5-2-1h-1l-2-1h-7l-2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4488h5l3-1 4-2 4-4 1-2 2-2 1-2 1-3 1-2 1-3v-11l-1-3-1-2-1-3-1-2-2-2-1-2-4-4-4-2-3-1h-9l-3 1-4 2-4 4-1 2-2 2-1 2-1 3-1 2-1 3v11l1 3 1 2 1 3 1 2 2 2 1 2 4 4 4 2 3 1h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4486h4l8-4 3-3 1-2 2-2 2-4v-3l1-2v-9l-1-2v-3l-2-4-2-2-1-2-3-3-8-4h-7l-8 4-5 5-3 6v3l-1 2v9l1 2v3l3 6 5 5 8 4h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.8 4459.3c0.7947-0.9697 2.0474-1.4399 3.284-1.2334 1.2365 0.2071 2.268 1.0591 2.7043 2.2344"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129.4 4459.2c0.9099-0.4326 1.9902-0.2769 2.7407 0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130.1 4482.6c-1.3039-0.9336-2.2744-2.2602-2.7693-3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2126.3 4479.1c-0.7649-4.81-1.1958-9.6675-1.2898-14.537"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.4 4464c-1.3802-0.032-2.4732-1.1772-2.441-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4464 7-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4461.4c0.038 0.7788-0.5271 1.457-1.3001 1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.8 4462.7c-0.4363 1.1753-1.4678 2.0278-2.7044 2.2343-1.2366 0.2066-2.4892-0.2641-3.2839-1.2334"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4463.4c-0.7505 0.6719-1.8308 0.8276-2.7407 0.395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4460"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.6 4460c0.8181 0.045 1.4485 0.7388 1.4158 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 4461.4c0.033 0.8189-0.5979 1.5122-1.4158 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4463h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4462.8c-0.1609 0.085-0.3359 0.1397-0.5163 0.1617"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4463-5 1h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121.5 4465c-1.9309-0.024-3.477-1.6084-3.4551-3.5395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 4461.5c-0.022-1.9311 1.5242-3.5151 3.4551-3.5395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4458 3 1h3l5 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4461c0.1806 0.022 0.3557 0.077 0.5166 0.1616"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4460h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4461.5c-0.01-0.7338 0.3045-1.4345 0.858-1.9165 0.5534-0.4819 1.2907-0.6962 2.0166-0.5864"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2123.9 4464c-0.7258 0.1098-1.4631-0.1045-2.0166-0.5865-0.5532-0.4819-0.8669-1.1831-0.8577-1.9169"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2122 4461.6c-0.032-1.3804 1.0608-2.5254 2.441-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.7 4460c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2135 4461.4c0.022 0.4609-0.1685 0.9062-0.5173 1.208"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.5 4462.6c-0.221 0.1909-0.493 0.3134-0.7828 0.352"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4461.7c-0.06 0.4883-0.3548 0.916-0.7901 1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4461.2c0.435 0.2291 0.7302 0.6568 0.79 1.1451"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4459 7 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4460c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2120 4461.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4461.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4461.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4461.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128.6 4485.6c-2.6245-6.6216-4.1513-13.626-4.5205-20.739"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.4 4227.2c0.4949-1.5254 1.4654-2.852 2.7693-3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 4242.1c0.1071-4.7544 0.5356-9.496 1.2824-14.193"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.1 4241.8c0.3997-6.9971 1.9197-13.885 4.5022-20.4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129 4265h4l1 1h1l2-1h3l1-1 2-1 1-1 2-1 1-2 1-1 3-6v-1l1-2v-10l-1-2v-2l-1-2-1-1-2-4-1-1-2-1-1-1-2-1-1-1h-2l-1-1h-5l-1 1h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4271 3-1h2l3-1 6-3 2-2 1-2 2-2 1-3 1-2 2-6v-11l-1-2-1-3-1-2-1-3-2-2-1-2-2-2-6-3-3-1-2-1h-5l-2 1-3 1-6 3-2 2-1 2-2 2-1 3-1 2-1 3-1 2v11l2 6 1 2 1 3 2 2 1 2 2 2 6 3 3 1h2l2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4269 2-1h4l6-3 1-2 5-5 1-3 1-2v-2l1-2v-10l-1-2v-2l-1-2-1-3-2-2-1-2-2-1-1-2-6-3h-2l-2-1h-3l-2 1h-2l-6 3-1 2-2 1-2 2-1 2-1 3-1 2v2l-1 2v10l1 2v2l1 2 1 3 1 2 2 1 2 2 1 2 6 3h4l1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127.8 4242.3c0.7947-0.9697 2.0474-1.4399 3.284-1.2334 1.2365 0.2071 2.268 1.0591 2.7043 2.2344"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2129.4 4242.2c0.9099-0.4326 1.9902-0.2769 2.7407 0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130.1 4264.6c-1.3039-0.9336-2.2744-2.2602-2.7693-3.7856"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2126.3 4261.1c-0.7649-4.81-1.1958-9.6675-1.2898-14.537"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124.4 4247c-1.3802-0.032-2.4732-1.1772-2.441-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4246 7-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4244.4c0.038 0.7788-0.5271 1.457-1.3001 1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.8 4245.7c-0.4363 1.1753-1.4678 2.0278-2.7044 2.2343-1.2366 0.2066-2.4892-0.2641-3.2839-1.2334"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4246.4c-0.7505 0.6719-1.8308 0.8276-2.7407 0.395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 4243"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.6 4243c0.8181 0.045 1.4485 0.7388 1.4158 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2136 4244.4c0.033 0.8189-0.5979 1.5122-1.4158 1.5572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4245h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4245.8c-0.1609 0.085-0.3359 0.1397-0.5163 0.1617"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4245-5 1-3 1h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121.5 4248c-1.9309-0.024-3.477-1.6084-3.4551-3.5395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 4244.5c-0.022-1.9311 1.5242-3.5151 3.4551-3.5395"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4241h6l5 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4243c0.1806 0.022 0.3557 0.077 0.5166 0.1616"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 4242 2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4244.5c-0.01-0.7338 0.3045-1.4345 0.858-1.9165 0.5534-0.4819 1.2907-0.6962 2.0166-0.5864"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2123.9 4247c-0.7258 0.1098-1.4631-0.1045-2.0166-0.5865-0.5532-0.4819-0.8669-1.1831-0.8577-1.9169"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2122 4244.6c-0.032-1.3804 1.0608-2.5254 2.441-2.5576"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133.7 4243c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2135 4244.4c0.022 0.4609-0.1685 0.9062-0.5173 1.208"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134.5 4245.6c-0.221 0.1909-0.493 0.3134-0.7828 0.352"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 4244.7c-0.06 0.4883-0.3548 0.916-0.7901 1.145"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132.2 4243.2c0.435 0.2291 0.7302 0.6568 0.79 1.1451"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2124 4241 7 2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131.7 4243c0.7727 0.103 1.3376 0.7812 1.2998 1.56"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2120 4244.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 4244.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4244.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 4244.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2128.6 4267.6c-2.6245-6.6216-4.1513-13.626-4.5205-20.739"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" stroke="#000" stroke-linecap="round" stroke-miterlimit="10">
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6803h16l-16 71zm16 0-16 71h16z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6700h16l-16 103zm16 0-16 103h16z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 6293h16l-16 407zm16 0-16 407h16z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 3141h10l-10 23zm10 0-10 23h10z"/>
              </g>
              <g fill="none" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 4157v498h-11v-498"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 6578v-428"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5945v-487"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5458v487"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 5055h5v12h-5v-12"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5055h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5119 5945v-487 24"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5826h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 6358v-208"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" stroke="#000" stroke-linecap="round" stroke-miterlimit="10">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2835 6552h-5l5-2901zm-5 0 5-2901-5-5zm5-2901-5-5 1555 5zm-5-5 1555 5 5-5zm1555 5 5-5-5 2903zm5-5-5 2903 5 5zm-5 2903 5 5-1558-5zm5 5-1558-5v5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2832 5103v-5l1556 5zm0-5 1556 5v-5z"/>
              <path transform="matrix(0 -.16 -.16 0 580.35 769.25)" d="m186.5 0c0 103-83.499 186.5-186.5 186.5s-186.5-83.499-186.5-186.5 83.499-186.5 186.5-186.5 186.5 83.499 186.5 186.5" fill="none" stroke-linejoin="round" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3423 5127 5-1-7-26zm5-1-7-26h5zm-7-26h5l-3-27zm5 0-3-27 5 1zm-3-27 5 1v-27zm5 1v-27l5 1zm0-27 5 1 5-26zm5 1 5-26 5 2zm5-26 5 2 8-26zm5 2 8-26 4 3zm8-26 4 3 12-25zm4 3 12-25 4 4zm12-25 4 4 15-23zm4 4 15-23 3 4zm15-23 3 4 19-20zm3 4 19-20 2 4zm19-20 2 4 21-17zm2 4 21-17 2 5zm21-17 2 5 24-14zm2 5 24-14 1 5zm24-14 1 5 25-11zm1 5 25-11 1 5zm25-11 1 5 26-7zm1 5 26-7v5zm26-7v5l27-3zm0 5 27-3-1 5zm27-3-1 5 27 1zm-1 5 27 1-1 5zm27 1-1 5 27 4zm-1 5 27 4-3 5zm27 4-3 5 26 8zm-3 5 26 8-3 4zm26 8-3 4 25 12zm-3 4 25 12-4 4zm25 12-4 4 23 15zm-4 4 23 15-4 4zm23 15-4 4 20 18zm-4 4 20 18-4 3zm20 18-4 3 17 21zm-4 3 17 21-5 2zm17 21-5 2 14 23zm-5 2 14 23-4 1zm14 23-4 1 10 25zm-4 1 10 25-5 1zm10 25-5 1 7 26zm-5 1 7 26h-5zm7 26h-5l3 27zm-5 0 3 27-5-1zm3 27-5-1-1 28zm-5-1-1 28-4-2zm-1 28-4-2-5 27zm-4-2-5 27-5-2zm-5 27-5-2-8 26zm-5-2-8 26-4-3zm-8 26-4-3-12 24zm-4-3-12 24-4-3zm-12 24-4-3-15 22zm-4-3-15 22-4-4zm-15 22-4-4-18 20zm-4-4-18 20-3-4zm-18 20-3-4-20 17zm-3-4-20 17-3-4zm-20 17-3-4-23 14zm-3-4-23 14-1-5zm-23 14-1-5-25 11zm-1-5-25 11-1-6zm-25 11-1-6-26 7zm-1-6-26 7v-5zm-26 7v-5l-27 4zm0-5-27 4 1-6zm-27 4 1-6h-27zm1-6h-27l1-5zm-27 0 1-5-27-5zm1-5-27-5 2-4zm-27-5 2-4-25-9zm2-4-25-9 2-4zm-25-9 2-4-24-12zm2-4-24-12 3-4zm-24-12 3-4-22-15zm3-4-22-15 4-3zm-22-15 4-3-20-18zm4-3-20-18 4-3zm-20-18 4-3-17-21zm4-3-17-21 5-2zm-17-21 5-2-15-23zm5-2-15-23 5-2zm-15-23 5-2-10-25zm5-2-10-25 5-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3618 3790v-17" fill="none" stroke-linejoin="round" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3602 3790v-17" fill="none" stroke-linejoin="round" stroke-width="4"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3296 3649 5-1 120 605zm5-1 120 605 4-6zm120 605 4-6 374 6zm4-6 374 6-5-6zm374 6-5-6 130-598zm-5-6 130-598-6-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3865 3957-5-1 13-39zm-5-1 13-39-5-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3421 4250h5l-4-21zm5 0-4-21h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3425 4213 5 1-2-17zm5 1-2-17 5 1zm-2-17 5 1 1-16zm5 1 1-16 5 1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3440 4167 5 2 6-21zm5 2 6-21 4 3zm6-21 4 3 2-12zm4 3 2-12 4 3z"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3467 4126 4 4" fill="none" stroke-linejoin="round"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3467 4126 4 4 15-23zm4 4 15-23 3 4zm15-23 3 4 1-7zm3 4 1-7 4 4z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3503 4094 3 4 2-7zm3 4 2-7 2 4zm2-7 2 4 21-17zm2 4 21-17 2 5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3546 4072 2 5 9-9zm2 5 9-9 1 5zm9-9 1 5 20-9zm1 5 20-9 1 5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3594 4062v5l16-6zm0 5 16-6v5zm16-6v5l16-4zm0 5 16-4v5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3642 4064-1 5 22-1zm-1 5 22-1-1 5zm22-1-1 5 11-1zm-1 5 11-1-1 5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3689 4078-3 5 26 8zm-3 5 26 8-3 4zm26 8-3 4 8-1zm-3 4 8-1-3 4z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3730 4104-4 4 8-1zm-4 4 8-1-4 4zm8-1-4 4 23 15zm-4 4 23 15-4 4z"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3749 4130 4-4" fill="none" stroke-linejoin="round"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3763 4139-5 3 11 6zm-5 3 11 6-4 3zm11 6-4 3 14 16zm-4 3 14 16-4 2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3786 4182-5 1 10 14zm-5 1 10 14-4 1zm10 14-4 1 8 15zm-4 1 8 15-5 1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3798 4229h-6l7 21zm-6 0 7 21h-5z"/>
              </g>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3799 4250h-5" fill="none" stroke-linejoin="round"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3799 4250h-5l3 27zm-5 0 3 27-5-1zm3 27-5-1-1 27zm-5-1-1 27-4-1zm-1 27-4-1-5 27zm-4-1-5 27-5-3zm-5 27-5-3-8 26zm-5-3-8 26-4-2zm-8 26-4-2-12 24zm-4-2-12 24-4-3zm-12 24-4-3-15 22zm-4-3-15 22-4-4zm-15 22-4-4-18 20zm-4-4-18 20-3-4zm-18 20-3-4-20 17zm-3-4-20 17-3-5zm-20 17-3-5-23 15zm-3-5-23 15-1-5zm-23 15-1-5-25 10zm-1-5-25 10-1-5zm-25 10-1-5-26 7zm-1-5-26 7v-5zm-26 7v-5l-27 3zm0-5-27 3 1-5zm-27 3 1-5h-27zm1-5h-27l1-5zm-27 0 1-5-27-5zm1-5-27-5 2-5zm-27-5 2-5-25-8zm2-5-25-8 2-4zm-25-8 2-4-24-12zm2-4-24-12 3-4zm-24-12 3-4-22-15zm3-4-22-15 4-3zm-22-15 4-3-20-19zm4-3-20-19 4-2zm-20-19 4-2-17-21zm4-2-17-21 5-3zm-17-21 5-3-15-23zm5-3-15-23 5-1zm-15-23 5-1-10-25zm5-1-10-25 5-1zm-10-25 5-1-7-26zm5-1-7-26h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3517 3776v-5l186 5zm0-5 186 5v-5z"/>
              </g>
              <path transform="matrix(0 -.16 -.16 0 580.35 975.33)" d="m23.5 0c0 12.979-10.521 23.5-23.5 23.5s-23.5-10.521-23.5-23.5 10.521-23.5 23.5-23.5 23.5 10.521 23.5 23.5" fill="none" stroke-linejoin="round" stroke-width="4"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3884 3829 1-5 11 8zm1-5 11 8 1-6z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3839 4045 1-5 12 7zm1-5 12 7 1-5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3820 4136 1-5 12 8zm1-5 12 8 1-5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3360 3956-5 1-4-41zm-5 1-4-41-5 1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3335 3824 1 5-14-3zm1 5-14-3 1 6z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3380 4040 1 5-14-3zm1 5-14-3 1 5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3399 4131 1 5-14-2zm1 5-14-2 1 5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4261 3812h-6l4 51zm-6 0 4 51h-6zm4 51h-6v51zm-6 0v51l-6-1zm0 51-6-1-4 51zm-6-1-4 51-5-1zm-4 51-5-1-9 50zm-5-1-9 50-5-2zm-9 50-5-2-13 50zm-5-2-13 50-5-2zm-13 50-5-2-16 48zm-5-2-16 48-5-2zm-16 48-5-2-20 47zm-5-2-20 47-5-3zm-20 47-5-3-24 45zm-5-3-24 45-4-3zm-24 45-4-3-27 44zm-4-3-27 44-4-4zm-27 44-4-4-31 41zm-4-4-31 41-4-4zm-31 41-4-4-34 39zm-4-4-34 39-3-4zm-34 39-3-4-37 35zm-3-4-37 35-3-4zm-37 35-3-4-39 33zm-3-4-39 33-3-5zm-39 33-3-5-42 30zm-3-5-42 30-2-5zm-42 30-2-5-44 26zm-2-5-44 26-2-5zm-44 26-2-5-46 23zm-2-5-46 23-2-5zm-46 23-2-5-47 19zm-2-5-47 19-1-5zm-47 19-1-5-49 15zm-1-5-49 15-1-6zm-49 15-1-6-50 12zm-1-6-50 12v-6zm-50 12v-6l-51 8zm0-6-51 8v-6zm-51 8v-6l-51 4zm0-6-51 4v-6zm-51 4v-6h-51zm0-6h-51l1-6zm-51 0 1-6-51-4zm1-6-51-4 1-5zm-51-4 1-5-50-9zm1-5-50-9 1-5zm-50-9 1-5-49-13zm1-5-49-13 2-5zm-49-13 2-5-48-16zm2-5-48-16 2-5zm-48-16 2-5-47-20zm2-5-47-20 3-5zm-47-20 3-5-46-24zm3-5-46-24 4-4zm-46-24 4-4-44-27zm4-4-44-27 4-4zm-44-27 4-4-41-31zm4-4-41-31 4-4zm-41-31 4-4-39-33zm4-4-39-33 4-4zm-39-33 4-4-35-37zm4-4-35-37 4-3zm-35-37 4-3-33-39zm4-3-33-39 5-3zm-33-39 5-3-30-42zm5-3-30-42 5-2zm-30-42 5-2-26-44zm5-2-26-44 5-2zm-26-44 5-2-23-46zm5-2-23-46 5-2zm-23-46 5-2-19-47zm5-2-19-47 5-1zm-19-47 5-1-15-49zm5-1-15-49 5-1zm-15-49 5-1-11-50zm5-1-11-50h5zm-11-50h5l-7-51zm5 0-7-51h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2964 3812h-5l5-163zm-5 0 5-163h-5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4261 3812h-6l6-163zm-6 0 6-163h-6z"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3618 6410v17" fill="none" stroke-linejoin="round" stroke-width="4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3602 6410v17" fill="none" stroke-linejoin="round" stroke-width="4"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3301 6552-5-1 129-598zm-5-1 129-598-4-5zm129-598-4-5 373 5zm-4-5 373 5 5-5zm373 5 5-5 119 604zm5-5 119 604 6-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3860 6244 5-1 3 42zm5-1 3 42 5-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3799 5950h-5l4 22zm-5 0 4 22-6-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3795 5988-5-1 1 17zm-5-1 1 17-4-2zm1 17-4-2-1 17zm-4-2-1 17-5-2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3779 6034-4-3-6 22zm-4-3-6 22-4-3zm-6 22-4-3-2 11zm-4-3-2 11-5-3z"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3753 6074-4-3" fill="none" stroke-linejoin="round"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3753 6074-4-3-15 22zm-4-3-15 22-4-3zm-15 22-4-3v7zm-4-3v7l-4-4z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3717 6106-3-4-2 8zm-3-4-2 8-3-5zm-2 8-3-5-20 18zm-3-5-20 18-3-5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3673 6128-1-5-9 9zm-1-5-9 9-1-5zm-9 9-1-5-20 10zm-1-5-20 10-1-6z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3626 6138v-5l-16 7zm0-5-16 7v-6zm-16 7v-6l-16 4zm0-6-16 4v-5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3578 6137 1-6-22 1zm1-6-22 1 1-5zm-22 1 1-5-12 1zm1-5-12 1 2-5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3531 6123 2-5-25-8zm2-5-25-8 2-5zm-25-8 2-5-7 1zm2-5-7 1 3-4z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3490 6097 4-4h-8zm4-4h-8l3-3zm-8 0 3-3-22-16zm3-3-22-16 4-3z"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3471 6071-4 3" fill="none" stroke-linejoin="round"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3457 6061 4-3-10-5zm4-3-10-5 4-3zm-10-5 4-3-15-16zm4-3-15-16 5-3z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3434 6019 5-2-11-13zm5-2-11-13 5-2zm-11-13 5-2-8-14zm5-2-8-14 5-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3422 5972 5-1-6-21zm5-1-6-21h5zm-6-21h5l-3-27zm5 0-3-27 5 1zm-3-27 5 1v-27zm5 1v-27l5 2zm0-27 5 2 5-27zm5 2 5-27 5 2zm5-27 5 2 8-26zm5 2 8-26 4 3zm8-26 4 3 12-24zm4 3 12-24 4 3zm12-24 4 3 15-23zm4 3 15-23 3 4zm15-23 3 4 19-20zm3 4 19-20 2 5zm19-20 2 5 21-18zm2 5 21-18 2 5zm21-18 2 5 24-14zm2 5 24-14 1 5zm24-14 1 5 25-11zm1 5 25-11 1 5zm25-11 1 5 26-7zm1 5 26-7v5zm26-7v5l27-3zm0 5 27-3-1 5zm27-3-1 5 27 1zm-1 5 27 1-1 5zm27 1-1 5 27 4zm-1 5 27 4-3 5zm27 4-3 5 26 8zm-3 5 26 8-3 5zm26 8-3 5 25 11zm-3 5 25 11-4 4zm25 11-4 4 23 16zm-4 4 23 16-4 3zm23 16-4 3 20 18zm-4 3 20 18-4 3zm20 18-4 3 17 21zm-4 3 17 21-5 2zm17 21-5 2 14 23zm-5 2 14 23-4 2zm14 23-4 2 10 24zm-4 2 10 24-5 1zm10 24-5 1 7 26zm-5 1 7 26h-5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3517 6430v-5l186 5zm0-5 186 5v-5z"/>
              </g>
              <path transform="matrix(0 -.16 -.16 0 580.35 563.17)" d="m23.5 0c0 12.979-10.521 23.5-23.5 23.5s-23.5-10.521-23.5-23.5 10.521-23.5 23.5-23.5 23.5 10.521 23.5 23.5" fill="none" stroke-linejoin="round" stroke-width="4"/>
              <g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3885 6377-1-5 13 2zm-1-5 13 2-1-5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3840 6161-1-5 14 2zm-1-5 14 2-1-5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3821 6070-1-6 14 3zm-1-6 14 3-1-5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3355 6243 5 1-14 40zm5 1-14 40 5 1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3336 6372-1 5-12-8zm-1 5-12-8-1 5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3381 6156-1 5-12-8zm-1 5-12-8-1 5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3400 6064-1 6-12-8zm-1 6-12-8-1 5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2959 6388h5l-3-51zm5 0-3-51 5 1zm-3-51 5 1 1-51zm5 1 1-51 5 1zm1-51 5 1 5-51zm5 1 5-51 5 1zm5-51 5 1 9-51zm5 1 9-51 5 2zm9-51 5 2 13-49zm5 2 13-49 5 1zm13-49 5 1 16-48zm5 1 16-48 5 2zm16-48 5 2 20-46zm5 2 20-46 5 2zm20-46 5 2 24-45zm5 2 24-45 4 3zm24-45 4 3 27-43zm4 3 27-43 4 3zm27-43 4 3 31-41zm4 3 31-41 4 4zm31-41 4 4 33-38zm4 4 33-38 4 4zm33-38 4 4 36-36zm4 4 36-36 4 4zm36-36 4 4 39-32zm4 4 39-32 3 4zm39-32 3 4 42-29zm3 4 42-29 2 4zm42-29 2 4 44-26zm2 4 44-26 2 5zm44-26 2 5 46-22zm2 5 46-22 1 5zm46-22 1 5 48-19zm1 5 48-19 1 5zm48-19 1 5 49-15zm1 5 49-15 1 5zm49-15 1 5 50-11zm1 5 50-11v5zm50-11v5l51-7zm0 5 51-7v5zm51-7v5l51-3zm0 5 51-3v5zm51-3v5l51 1zm0 5 51 1-1 5zm51 1-1 5 51 5zm-1 5 51 5-1 5zm51 5-1 5 50 9zm-1 5 50 9-2 5zm50 9-2 5 50 12zm-2 5 50 12-2 5zm50 12-2 5 48 17zm-2 5 48 17-2 4zm48 17-2 4 47 21zm-2 4 47 21-3 4zm47 21-3 4 45 24zm-3 4 45 24-3 4zm45 24-3 4 43 28zm-3 4 43 28-3 4zm43 28-3 4 41 30zm-3 4 41 30-4 4zm41 30-4 4 39 34zm-4 4 39 34-4 3zm39 34-4 3 35 37zm-4 3 35 37-4 3zm35 37-4 3 33 40zm-4 3 33 40-5 2zm33 40-5 2 30 42zm-5 2 30 42-5 2zm30 42-5 2 26 45zm-5 2 26 45-5 1zm26 45-5 1 23 46zm-5 1 23 46-5 2zm23 46-5 2 19 48zm-5 2 19 48-5 1zm19 48-5 1 15 49zm-5 1 15 49-6 1zm15 49-6 1 12 49zm-6 1 12 49-6 1zm12 49-6 1 8 50zm-6 1 8 50h-6z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2959 6388h5l-5 164zm5 0-5 164h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4255 6388h6l-6 164zm6 0-6 164h6z"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="4">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1259 5645v-329"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1264 5399v-83"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1352 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1383 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1414 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5378h236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5347h236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1023 5316h236"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5961 5645v-298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5956 5404v-57"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5930 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5899 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5868 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5837 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5805 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5774 5630v-221"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5645v-188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5453v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5444v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5434v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5424v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5415v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5645v-141"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5500v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5491v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5481v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5471v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5461v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5452v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5442v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5432v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5423v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5413v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5645v-99"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5542v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5533v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5523v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5513v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5503v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5494v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5484v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5474v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5465v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5455v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5445v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5435v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5426v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5416v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5597v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5589v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5579v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5570v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5560v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5550v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5541v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5531v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5521v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5511v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5502v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5492v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5482v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5473v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5463v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5453v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5443v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5434v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5424v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5414v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5642v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5636v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5626v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5617v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5607v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5597v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5587v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5578v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5568v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5558v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5549v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5539v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5529v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5519v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5510v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5500v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5490v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5480v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5471v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5461v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5451v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5442v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5432v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5422v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5412v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5404v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5413v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5423v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5433v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5442v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5452v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5462v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5471v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5481v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5491v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5501v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5510v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5520v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5530v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5539v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5549v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5559v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5569v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5578v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5588v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5598v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5607v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5617v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5627v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5637v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5409h-433"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 5409h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5751 5409h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5741 5409h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5731 5409h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5721 5409h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5409h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5702 5409h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5692 5409h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5682 5409h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5673 5409h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5663 5409h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5653 5409h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5644 5409h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5634 5409h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5624 5409h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5614 5409h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5605 5409h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5595 5409h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5956 5404h-186"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5767 5404h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5757 5404h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5747 5404h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5738 5404h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5728 5404h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5718 5404h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5709 5404h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5699 5404h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5689 5404h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5679 5404h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5670 5404h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5660 5404h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5404h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5641 5404h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5631 5404h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5621 5404h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5611 5404h-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5602 5404h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5592 5404h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5378h-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5347h-233"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5642 70-105 19 4-23-30 19 4 70-106"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5645v-48"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5961 5645v-329"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5956 5404v-88"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5930 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5899 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5868 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5837 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5805 5645v-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5774 5630v-221"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5743 5645v-183"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5645v-141"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5500v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5491v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5481v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5471v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5461v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5452v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5442v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5432v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5423v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5712 5413v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5645v-99"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5542v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5533v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5523v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5513v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5503v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5494v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5484v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5474v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5465v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5455v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5445v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5435v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5426v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5681 5416v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5597v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5589v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5579v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5570v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5560v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5550v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5541v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5531v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5521v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5511v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5502v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5492v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5482v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5473v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5463v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5453v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5443v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5434v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5424v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5414v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5642v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5636v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5626v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5617v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5607v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5597v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5587v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5578v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5568v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5558v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5549v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5539v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5529v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5519v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5510v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5500v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5490v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5480v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5471v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5461v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5451v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5442v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5432v-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5422v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5412v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5404v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5413v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5423v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5433v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5442v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5452v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5462v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5471v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5481v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5491v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5501v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5510v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5520v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5530v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5539v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5549v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5559v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5569v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5578v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5588v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5598v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5607v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5617v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5627v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5588 5637v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5409h-426"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5956 5404h-182"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5378h-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5347h-236"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5316h-241"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5619 5642 70-105 19 4-23-30"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5704 5515 70-106"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5650 5645v-48"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4350 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4319 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4288 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2962 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2931 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2900 3048v-125"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="4">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4381 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4350 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4319 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4288 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2962 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2931 3048v-125"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2900 3048v-125"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#00f" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1905 406 350"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1933-404 348"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5364 1933-391 337"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5349v-282" stroke-width="7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 5619v-352" stroke-width="7"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3261 8766h-192v-10h192"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8761h182"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5347v277"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5619v-352"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 5267v357"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6202 5624v-357"/>
              </g>
              <g stroke-width="7">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 5062h202"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5062h81"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5119 4859v196"/>
              </g>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 5267h10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3768 2752v16h-137v-16h137"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4105 2752v16h-119v-16h119"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8133v11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8133h-69l-231 232v12h10v-8l225-225h65"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2605 8133v11h-96v-11h96"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2615 8144v-11h413v11h-413"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8133v11h-328v-11h328"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8144v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8144h97v612h-97v10h108v-633h-108"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3739 8455v-10l43-1v11h-43"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3998 8455v-11h44v11h-44"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4150 8144v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4150 8144h-97v612h97v10h-108v-633h108"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4552 8133v11h-360v-11h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8144v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8144h65l225 225v3h10v-7l-231-232h-69"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4562 8144v-11h149v11h-149"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 8766v-10h285v10h-285"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 8756v10h-286v-10h286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5770 1401h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5770 1401v182l-797 687h-4v11h7l805-693v-187"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887h-10v-215h10v215"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1902v-10h360v10h-360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1891 7 8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1891-419 361v8h11v-3l415-358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4115 1892h-10v-485h10v485"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4115 2255h-10v-322h10v322"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1902v-10h360v10h-360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1457 1903 6-8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1457 1903 416 358v3h10v-8l-420-361"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1375v11h110v-11h-110"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1450 1401h-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1450 1401v182l797 687h4v11h-8l-804-693v-187"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3105 2255h10v-322h-10v322"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1386v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1386h264v506h10v-517h-274"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1385v-11h156v11h-156"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4084 1375v11h-21v-11h21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3639 1375v11h-24v-11h24"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4105 2516h10v366h-10v-366"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3390 2739h10v-62h-10v62"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3219 2521h171v-10h-171v10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3390 2562h10v-51h-10v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3400 2635h148l83 83v164"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3400 2636h147l83 83v163"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3620 2882h11v-5h-11v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3406 2646v-11h-6v11h6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3623 2726 8-8-4-3-7 7 3 4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3544 2646 7-7-3-4-8 8 4 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1375v11h-575v-11h575"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 2270v11h-581v-11h581"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" stroke-linecap="round" stroke-miterlimit="10">
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2403 6271v5h-13v-5h13"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2396 6276-58 34 3 4 58-34-3-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2390.7 6344c-20.721 0.4649-39.912-10.863-49.517-29.23"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2403 6348v-5h-13v5h13"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2377 6494v5h-13v-5h13"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2370 6499-58 34 3 4 58-34-3-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2364.7 6567c-20.721 0.4649-39.912-10.863-49.517-29.23"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2377 6571v-5h-13v5h13"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2192 6271v5h13v-5h-13"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2198 6276 59 34-3 4-58-34 2-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2254.8 6314.8c-9.605 18.366-28.796 29.694-49.517 29.23"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2192 6348v-5h13v5h-13"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2411 5668-2-1h2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5666h5l-3 1zm5 0-3 1h2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5666-52-35h4zm-52-35h4l-4-3z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5666h5l-53-35z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 380.19 683.81)" d="m31.536-52.799c20.097 12.004 31.637 34.376 29.767 57.711"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5628 57 38"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5630 58 38"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2245 5565-5-3h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2188 5527h4l48 35zm4 0 48 35h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2188 5527v-1h3zm0-1h3l-2-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2188 5527h4l-1-1z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2245 5565-57-38"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2247 5563-58-38"/>
              <path transform="matrix(0 -.16 -.16 0 361.15 695.81)" d="m-31.516 52.811c-20.116-12.005-31.666-34.396-29.786-57.747"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5565v-3h4z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5527h5l-57 35zm5 0-57 35h4z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5527 2-1h2zm2-1h2v-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2407 5527h5l-1-1z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5565 57-38"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5563 58-38"/>
                <path transform="matrix(0 -.16 -.16 0 380.19 695.81)" d="m-61.304 4.9122c-1.87-23.337 9.672-45.711 29.772-57.714"/>
              </g>
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4986 2-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4988 4-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4991 5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4993 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4995 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4998 5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5e3 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5002 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5005 5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5007 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5009 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5012 5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5014 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5016 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5019 5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5021 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5023 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5026 5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5028 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5030 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5033 5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5035 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5037 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5040 5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5042 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5044 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5047 5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5049 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5051 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5054 5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5056 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5058 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 5060 5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2118 5062 4-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2121 5062 1-2"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2117 4984v78h5v-78h-5" stroke-width="3"/>
              <path transform="matrix(0 -.16 -.16 0 341.47 775.49)" d="m-77.346-4.8858c2.6121-41.351 37.286-73.333 78.713-72.602"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2112 5055h5v13h-5v-13" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2195 5055h5v13h-5v-13" stroke-width="3"/>
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4858 5432-2-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 5432-5-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4863 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4875 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4879 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4889 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4891 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4893 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4896 5432-6-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4898 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4900 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4903 5432-6-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4905 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4907 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4910 5432-6-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4912 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4914 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4917 5432-6-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4919 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4921 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4924 5432-6-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4926 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4928 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4931 5432-6-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933 5432-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5431-4-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5429-2-2"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4856 5432h78v-5h-78v5" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4856.2 5427.6c2.6118-41.351 37.286-73.333 78.713-72.602"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4927 5437v-5h13v5h-13" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4927 5354v-5h13v5h-13" stroke-width="3"/>
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870 6379v6h13v-6h-13"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 6385 58 33-2 5-59-34 3-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.8 6423.8c-9.605 18.366-28.796 29.694-49.517 29.23"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870 6457v-5h13v5h-13"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870 6494v5h13v-5h-13"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 6499 58 34-2 4-59-34 3-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.8 6537.8c-9.605 18.366-28.796 29.694-49.517 29.23"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870 6571v-5h13v5h-13"/>
              </g>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4809 5643-1-1h3z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5641h5l-5 1zm5 0-5 1h3z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5641 53-35h4zm53-35h4v-3z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5641h5l52-35z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 780.35 687.81)" d="m61.304-4.9064c1.8675 23.335-9.6743 45.706-29.773 57.708"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5603-57 38"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5605-58 38"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4975 5565v-3h4z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5027 5527h5l-57 35zm5 0-57 35h4z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5027 5527 2-1h2zm2-1h2v-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5027 5527h5l-1-1z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4975 5565 57-38"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4973 5563 58-38"/>
              <path transform="matrix(0 -.16 -.16 0 799.55 695.81)" d="m-61.302 4.9357c-1.8801-23.351 9.6691-45.742 29.786-57.747"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5565-4-3h4z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5527h5l48 35zm5 0 48 35h4z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5527v-1h3zm0-1h3l-2-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4808 5527h5l-2-1z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5565-57-38"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5563-58-38"/>
                <path transform="matrix(0 -.16 -.16 0 780.35 695.81)" d="m-31.531 52.802c-20.1-12.003-31.642-34.377-29.772-57.714"/>
              </g>
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4986-2-2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4988-5-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4991-5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4993-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4995-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4998-5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5e3 -5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5002-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5005-5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5007-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5009-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5012-5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5014-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5016-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5019-5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5021-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5023-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5026-5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5028-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5030-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5033-5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5035-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5037-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5040-5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5042-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5044-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5047-5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5049-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5051-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5054-5-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5056-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5058-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 5060-5-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5102 5062-4-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5099 5062-1-2"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5103 4984v78h-5v-78h5" stroke-width="3"/>
              <path transform="matrix(0 .16 .16 0 819.23 775.49)" d="m-1.3597-77.488c41.427-0.72689 76.098 31.259 78.706 72.61"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5108 5055h-5v13h5v-13" stroke-width="3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5025 5055h-5v13h5v-13" stroke-width="3"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4346-5-3h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4309h5l48 34zm5 0 48 34h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4309 1-1h2zm1-1h2l-1-2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4309h5l-2-1z"/>
              </g>
              <g fill="none" stroke-linejoin="round">
              <g stroke="#f0f" stroke-width="3">
                <path transform="matrix(0 -.16 -.16 0 781.47 890.85)" d="m-31.531 52.802c-20.1-12.003-31.642-34.377-29.772-57.714"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4346-58-37"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4344-57-38"/>
              </g>
              <g stroke="#0037dd">
                <path transform="matrix(0 -.16 -.16 0 163.71 741.09)" d="m-115.95-11.263c5.1022-52.526 44.875-95.061 96.94-103.67"/>
                <g stroke-width="4">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1026 5262h95"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1121 5257h-95"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1026 5262v5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1026 5267h-16v-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1010 5261h10v1h6v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1121 5262v-5"/>
                </g>
                <path transform="matrix(0 -.16 -.16 0 163.71 778.21)" d="m19.025-114.94c52.064 8.6181 91.833 51.158 96.93 103.68"/>
                <g stroke-width="4">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1026 5058h95"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1121 5063h-95"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1010 5059h10v-1h6v-4h-16"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1026 5063v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1121 5058v5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1010 5054v5"/>
                </g>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3786 8457h4l-4 104zm4 0-4 104h4z" fill="#f0f" stroke="#f0f"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3990 8457h4l-4 104zm4 0-4 104h4z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3786 8561v-104h4v104h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3786 8457h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3782 8457v-15h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3787 8442v10h-1v5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3994 8561v-104h-4v104h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3994 8457h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3998 8457v-15h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3993 8442v10h1v5"/>
              </g>
              <path transform="matrix(0 -.16 -.16 0 642.11 232.45)" d="m106.3 6.4695c-3.3545 55.12-48.283 98.532-103.49 99.993"/>
              <path transform="matrix(0 -.16 -.16 0 608.03 232.45)" d="m2.828-106.46c55.202 1.4664 100.13 44.883 103.48 100"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3182 8286h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3187 8286v16h-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3181 8302v-11h1v-5"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3084 8286h-5l5-103zm-5 0 5-103h-5z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke-linejoin="round">
              <g stroke="#f0f">
                <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3079 8286v-103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3084 8183v103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3079 8286h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3075 8286v16h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3080 8302v-11h-1v-5h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3079 8183h5"/>
                </g>
                <path transform="matrix(0 .16 .16 0 495.39 259.49)" d="m103.37 5.1776c-2.7588 55.08-48.221 98.322-103.37 98.322"/>
              </g>
              <g stroke="#0037dd">
                <path transform="matrix(0 .16 .16 0 996.83 741.09)" d="m19.025-114.94c52.064 8.6181 91.833 51.158 96.93 103.68"/>
                <g stroke-width="4">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5262h-96"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6098 5257h96"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5262v5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5267h16v-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6210 5261h-10v1h-6v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6098 5262v-5"/>
                </g>
                <path transform="matrix(0 .16 .16 0 996.83 778.21)" d="m-115.95-11.263c5.1022-52.526 44.875-95.061 96.94-103.67"/>
                <g stroke-width="4">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5058h-96"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6098 5063h96"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6210 5059h-10v-1h-6v-4h16"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6194 5063v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6098 5058v5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6210 5054v5"/>
                </g>
              </g>
              <g stroke="#f0f" stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4998 5950h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4994 5950v16h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4999 5966v-10h-1v-6"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 5950h5l-5-103zm5 0-5-103h5z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5101 5950v-103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5096 5847v103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5101 5950h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 5950v16h-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5100 5966v-10h1v-6h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5101 5847h-5"/>
              </g>
              <g>
                <path transform="matrix(0 -.16 -.16 0 818.91 633.25)" d="m0 103.5c-55.149 0-100.61-43.242-103.37-98.322"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2625 7749h-5v12h5v-12"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2620 7755-34 58-5-2 34-59 5 3"/>
                <path transform="matrix(0 -.16 -.16 0 419.71 343.17)" d="m48.294 25.257c-9.605 18.366-28.796 29.694-49.517 29.229"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2547 7749h5v12h-5v-12"/>
              </g>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7481v4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7485h16v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2496 7480h-11v1h-5"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7382v-5l-103 5zm0-5-103 5v-5z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7377h-103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2377 7382h103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7377v-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7373h16v5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2496 7378h-11v-1h-5v5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2377 7377v5"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480.5 7481c-55.149 0-100.61-43.243-103.37-98.322"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7481v4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7485h-16v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7480h10v1h6"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7382v-5l103 5zm0-5 103 5v-5z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7377h103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7382h-103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7377v-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 7373h-16v5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 7378h10v-1h6v5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830 7377v5"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4830.9 7382.7c-2.7588 55.08-48.222 98.322-103.37 98.322"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 7903v-94"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 7809v94"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 7903h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 7903v15h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 7918v-10h1v-5h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2386 7908v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2382 7903v15"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2387 7908h-1"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2382 7918h5v-10"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2386 7903h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 7809h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2613 7614-2 4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2611 7618-13-8 2-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2600 7606 9 5v1l4 2"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2658 7536 2-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2660 7533-13-8-3 4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2644 7529 9 5h1l4 2-2 5"/>
              </g>
              <g>
                <path transform="matrix(.079995 .13857 .13857 -.079995 427.87 379.65)" d="m-5.1944 90.351c-47.138-2.71-84.271-41.203-85.285-88.407"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2646 7749h5v12h-5v-12"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2651 7755 34 58 4-2-34-59-4 3"/>
                <path transform="matrix(0 .16 .16 0 428.99 343.17)" d="m1.2226 54.486c-20.721 0.46493-39.912-10.863-49.517-29.229"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2723 7749h-5v12h5v-12"/>
              </g>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4837 7903h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4841 7903v15h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4836 7918v-10h1v-5"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 7903h-6l6-104zm-6 0 6-104h-6z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 7903v-104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 7799v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 7903h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 7903v15h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 7918v-10h-1v-5h6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 7799h6"/>
              </g>
              <path transform="matrix(0 .16 .16 0 760.03 320.77)" d="m103.37 5.1776c-2.7588 55.08-48.221 98.322-103.37 98.322"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592 7620 2 3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4594 7623 13-8-2-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4605 7611-9 5v1l-4 3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4547 7541-2-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4545 7538 13-8 3 5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4561 7535-9 5-1-1-4 2 2 5"/>
              </g>
              <path transform="matrix(.079995 -.13857 -.13857 -.079995 730.43 378.85)" d="m90.479 1.9434c-1.0139 47.204-38.147 85.697-85.285 88.407"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4679 7733 25 63-5 2-25-63 5-2" stroke-width="2"/>
              <path transform="matrix(0 -.16 -.16 0 750.91 346.53)" d="m55.987-22.927c11.399 27.836 0.61686 59.818-25.308 75.071" stroke-width="2"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3327 2524h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3331 2524v-16h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3326 2508v11h1v5"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3228 2524h-5l5 104zm-5 0 5 104h-5z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3223 2524v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3228 2628v-104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3223 2524h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3219 2524v-16h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3224 2508v11h-1v5h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3223 2628h5"/>
              </g>
              <path transform="matrix(0 .16 .16 0 518.43 1181.4)" d="m0 103.5c-55.149 0-100.61-43.242-103.37-98.322"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3875 2768h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3880 2768v-16h-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3874 2752v11h1v5"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3777 2768h-5l5 104zm-5 0 5 104h-5z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3772 2768v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3777 2872v-104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3772 2768h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3768 2768v-16h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3773 2752v11h-1v5h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3772 2872h5"/>
              </g>
              <path transform="matrix(0 .16 .16 0 606.27 1142.4)" d="m0 103.5c-55.149 0-100.61-43.242-103.37-98.322"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3879 2768h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3874 2768v-16h6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3880 2752v11h-1v5"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3977 2768h5l-5 104zm5 0-5 104h5z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3982 2768v104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3977 2872v-104"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3982 2768h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3986 2768v-16h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3981 2752v11h1v5h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3982 2872h-5"/>
              </g>
              <path transform="matrix(0 -.16 -.16 0 639.87 1142.4)" d="m103.37 5.1776c-2.7588 55.08-48.221 98.322-103.37 98.322"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3982 2872h-5v-104h5v104" stroke-width="2"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4241-5-3h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4204h5l48 34zm5 0 48 34h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4204 1-1h2zm1-1h2l-1-2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4204h5l-2-1z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 781.47 907.65)" d="m-31.531 52.802c-20.1-12.003-31.642-34.377-29.772-57.714"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4241-58-37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4239-57-38"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4451-5-3h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4414h5l48 34zm5 0 48 34h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4414 1-2h2zm1-2h2l-1-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4414h5l-2-2z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 781.47 874.05)" d="m-31.531 52.802c-20.1-12.003-31.642-34.377-29.772-57.714"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4451-58-37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4449-57-38"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4556-5-3h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4519h5l48 34zm5 0 48 34h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4519 1-2h2zm1-2h2l-1-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4519h5l-2-2z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 781.47 857.25)" d="m-31.531 52.802c-20.1-12.003-31.642-34.377-29.772-57.714"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4556-58-37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4554-57-38"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4816 4620-1-2h2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4617h5l-4 1zm5 0-4 1h2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4617 53-34h5zm53-34h5v-3z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4814 4617h5l53-34z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 781.47 851.49)" d="m61.304-4.9064c1.8675 23.335-9.6743 45.706-29.773 57.708"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 4580-58 37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 4582-57 38"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4751v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4747h13v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4912 4751h-13"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4830v5l-84-5zm0 5-84-5v5z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4835h-84"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4815 4830h84"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4835v3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4899 4838h13v-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4912 4834h-9v1h-4v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4815 4835v-5"/>
              </g>
              <path transform="matrix(-.16 0 0 .16 786.59 811.65)" d="m83.395 4.1771c-2.2257 44.436-38.903 79.323-83.395 79.323"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4969 4661h-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4966 4661v13h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4970 4674v-9h-1v-4"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5049 4661h4l-4-84zm4 0-4-84h4z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 4661v-84"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5049 4577v84"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 4661h3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5056 4661v13h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5052 4674v-9h1v-4h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5053 4577h-4"/>
              </g>
              <path transform="matrix(0 -.16 -.16 0 811.23 839.49)" d="m0 83.5c-44.492 0-81.17-34.886-83.395-79.323"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4346v-3h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4309h5l-58 34zm5 0-58 34h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4309 2-1h2zm2-1h2l-1-2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4309h5l-1-1z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 379.23 890.85)" d="m-61.304 4.9122c-1.87-23.337 9.672-45.711 29.772-57.714"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4346 58-37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4344 57-38"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4241v-3h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4204h5l-58 34zm5 0-58 34h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4204 2-1h2zm2-1h2l-1-2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4204h5l-1-1z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 379.23 907.65)" d="m-61.304 4.9122c-1.87-23.337 9.672-45.711 29.772-57.714"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4241 58-37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4239 57-38"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4451v-3h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4414h5l-58 34zm5 0-58 34h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4414 2-2h2zm2-2h2l-1-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4414h5l-1-2z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 379.23 874.05)" d="m-61.304 4.9122c-1.87-23.337 9.672-45.711 29.772-57.714"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4451 58-37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4449 57-38"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4556v-3h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4519h5l-58 34zm5 0-58 34h5z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4519 2-2h2zm2-2h2l-1-1z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4519h5l-1-2z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 379.23 857.25)" d="m-61.304 4.9122c-1.87-23.337 9.672-45.711 29.772-57.714"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4556 58-37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4554 57-38"/>
              </g>
              <g fill="#f0f" stroke="#f0f">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2404 4620-1-2h2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4617h5l-3 1zm5 0-3 1h2z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4617-53-34h5zm-53-34h5l-5-3z"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2401 4617h5l-53-34z"/>
              </g>
              <g fill="none" stroke="#f0f" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(0 -.16 -.16 0 379.23 851.49)" d="m31.536-52.799c20.097 12.004 31.637 34.376 29.767 57.711"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 4580 58 37"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 4582 57 38"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4751v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4747h-13v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2308 4751h13"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4830v5l84-5zm0 5 84-5v5z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4835h84"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2405 4830h-84"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4835v3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2321 4838h-13v-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2308 4834h8v1h5v-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2405 4835v-5"/>
              </g>
              <path transform="matrix(-.16 0 0 .16 374.11 811.65)" d="m0 83.5c-44.492 0-81.17-34.886-83.395-79.323"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2251 4661h3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2254 4661v13h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2250 4674v-9h1v-4"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2171 4661h-4l4-84zm-4 0 4-84h-4z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 4661v-84"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2171 4577v84"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 4661h-3"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2164 4661v13h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2168 4674v-9h-1v-4h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2167 4577h4"/>
              </g>
              <g>
                <path transform="matrix(0 .16 .16 0 349.47 839.49)" d="m83.395 4.1771c-2.2257 44.436-38.903 79.323-83.395 79.323"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4988 6275v5h13v-5h-13"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4994 6280 58 34-2 4-59-34 3-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5050.8 6318.8c-9.605 18.366-28.796 29.694-49.517 29.23"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4988 6352v-5h13v5h-13"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4858 6275v5h-13v-5h13"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4851 6280-58 34 2 4 59-34-3-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4844.7 6348c-20.721 0.4649-39.912-10.863-49.517-29.23"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4858 6352v-5h-13v5h13"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3644 1388h4l-4 114zm4 0-4 114h4z" fill="#f0f" stroke="#f0f"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3868 1388h4l-4 114zm4 0-4 114h4z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3644 1502v-114h4v114h-4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3644 1388h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3639 1388v-17h6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3645 1371v11h-1v6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3872 1502v-114h-4v114h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3872 1388h4"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 1388v-17h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3871 1371v11h1v6"/>
              </g>
              <path transform="matrix(0 -.16 -.16 0 622.75 1363.7)" d="m117.28 7.1377c-3.701 60.813-53.27 108.71-114.17 110.32"/>
              <path transform="matrix(0 -.16 -.16 0 585.31 1363.7)" d="m3.1201-117.46c60.904 1.6178 110.47 49.519 114.16 110.33"/>
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3933 1390h-5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1390v-19h6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3934 1371v12h-1v7"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4052 1390h6l-6 125zm6 0-6 125h6z" fill="#f0f" stroke="#f0f"/>
              <g fill="none" stroke="#f0f" stroke-linejoin="round">
              <g stroke-width="3">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4058 1390v125"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4052 1515v-125"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4058 1390h5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4063 1390v-19h-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4057 1371v12h1v7h-6"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4058 1515h-6"/>
              </g>
              <path transform="matrix(0 -.16 -.16 0 652.03 1362.9)" d="m125.34 6.2782c-3.3453 66.788-58.471 119.22-125.34 119.22"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
              <path transform="matrix(0 -.16 -.16 0 392.35 542.85)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
              <path transform="matrix(0 -.16 -.16 0 392.51 549.89)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
              <path transform="matrix(0 -.16 -.16 0 396.19 538.69)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6541v-13"/>
              <path transform="matrix(0 -.16 -.16 0 393.79 537.73)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
              <path transform="matrix(0 -.16 -.16 0 392.99 535.81)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
              <path transform="matrix(0 -.16 -.16 0 391.55 540.13)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
              <path transform="matrix(0 -.16 -.16 0 390.11 540.77)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
              <path transform="matrix(0 -.16 -.16 0 390.11 540.77)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
              <path transform="matrix(0 -.16 -.16 0 391.55 541.25)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
              <path transform="matrix(0 -.16 -.16 0 392.99 545.57)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
              <path transform="matrix(0 -.16 -.16 0 393.79 543.81)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
              <path transform="matrix(0 -.16 -.16 0 392.35 538.53)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
              <path transform="matrix(0 -.16 -.16 0 392.51 531.49)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
              <path transform="matrix(0 -.16 -.16 0 396.19 542.69)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6516v12"/>
              <path transform="matrix(0 -.16 -.16 0 398.27 537.41)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6551h16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 6528v-26h-19"/>
              <path transform="matrix(0 -.16 -.16 0 398.59 544.29)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6506v7l-7-1"/>
              <path transform="matrix(0 -.16 -.16 0 398.27 543.97)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6506h16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6545 7-1v7"/>
              <path transform="matrix(0 -.16 -.16 0 398.59 537.09)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2474 6555h19v-27"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 538.69)" d="m-0.07507-4.4994c1.4954-0.02495 2.9054 0.69467 3.7626 1.9202"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6541v-3"/>
              <path transform="matrix(0 -.16 -.16 0 411.07 481.73)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
              <path transform="matrix(0 -.16 -.16 0 397.31 539.33)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6535h-1v-7"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 541.41)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 397.15 542.69)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6519"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6528v-6h1"/>
              <path transform="matrix(0 -.16 -.16 0 397.31 542.05)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(0 -.16 -.16 0 411.07 599.65)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6519v-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 542.69)" d="m-3.6876-2.5791c0.85718-1.2256 2.2672-1.9452 3.7626-1.9202"/>
              <path transform="matrix(0 -.16 -.16 0 397.15 538.69)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6538"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 539.97)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 542.69)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6536 2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6538h2"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 538.69)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 6540h-4"/>
              <path transform="matrix(0 -.16 -.16 0 396.03 539.01)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2457 6539 1-11v9"/>
              <path transform="matrix(0 -.16 -.16 0 396.51 539.33)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2458 6528v-8"/>
              <path transform="matrix(0 -.16 -.16 0 396.51 542.05)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 6517h-4"/>
              <path transform="matrix(0 -.16 -.16 0 396.03 542.37)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2457 6518 1 10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6544v-31"/>
              <path transform="matrix(0 -.16 -.16 0 392.35 560.77)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
              <path transform="matrix(0 -.16 -.16 0 392.51 567.81)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
              <path transform="matrix(0 -.16 -.16 0 396.19 556.61)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6429v-13"/>
              <path transform="matrix(0 -.16 -.16 0 393.79 555.65)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
              <path transform="matrix(0 -.16 -.16 0 392.99 553.73)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
              <path transform="matrix(0 -.16 -.16 0 391.55 558.21)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
              <path transform="matrix(0 -.16 -.16 0 390.11 558.69)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
              <path transform="matrix(0 -.16 -.16 0 390.11 558.69)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
              <path transform="matrix(0 -.16 -.16 0 391.55 559.17)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
              <path transform="matrix(0 -.16 -.16 0 392.99 563.65)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
              <path transform="matrix(0 -.16 -.16 0 393.79 561.73)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
              <path transform="matrix(0 -.16 -.16 0 392.35 556.45)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
              <path transform="matrix(0 -.16 -.16 0 392.51 549.41)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
              <path transform="matrix(0 -.16 -.16 0 396.19 560.61)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6404v12"/>
              <path transform="matrix(0 -.16 -.16 0 398.27 555.49)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6438h16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2493 6416v-27h-19"/>
              <path transform="matrix(0 -.16 -.16 0 398.59 562.21)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6394v7l-7-2"/>
              <path transform="matrix(0 -.16 -.16 0 398.27 561.89)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 6394h16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6433 7-2v8"/>
              <path transform="matrix(0 -.16 -.16 0 398.59 555.01)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2474 6443h19v-27"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 556.61)" d="m-0.07507-4.4994c1.4954-0.02495 2.9054 0.69467 3.7626 1.9202"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6429v-3"/>
              <path transform="matrix(0 -.16 -.16 0 411.07 499.65)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
              <path transform="matrix(0 -.16 -.16 0 397.31 557.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6423h-1v-7"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 559.33)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 397.15 560.61)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6407"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6416v-7h1"/>
              <path transform="matrix(0 -.16 -.16 0 397.31 559.97)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(0 -.16 -.16 0 411.07 617.73)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 6406v-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 560.77)" d="m-3.6876-2.5791c0.85718-1.2256 2.2672-1.9452 3.7626-1.9202"/>
              <path transform="matrix(0 -.16 -.16 0 397.15 556.77)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 6425"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 558.05)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 560.77)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6423h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 6425 2 1"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 556.61)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 6427h-4"/>
              <path transform="matrix(0 -.16 -.16 0 396.03 557.09)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2457 6427 1-11v9"/>
              <path transform="matrix(0 -.16 -.16 0 396.51 557.25)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2458 6416v-8"/>
              <path transform="matrix(0 -.16 -.16 0 396.51 559.97)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 6405h-4"/>
              <path transform="matrix(0 -.16 -.16 0 396.03 560.29)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2457 6406 1 10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2470 6431v-30"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 703.65)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 697.41)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 707.17)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 5488v11"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 708.13)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 709.73)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 705.89)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 705.41)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 705.41)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 705.09)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 701.25)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 702.85)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 707.33)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 713.57)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 703.81)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 5509v-10"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 708.29)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 5479h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5499v23h-16"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 702.37)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 5518v-6l-6 1"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 702.69)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 5518h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 5484 6 1v-6"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 708.61)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 5475h16v24"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 707.33)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 5487v3"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 756.77)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 706.69)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 5492v7"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 704.93)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 703.81)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 5506"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 5499v6"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 704.29)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 654.21)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 5507v3"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 703.65)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 707.17)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 5491"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 706.05)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 703.65)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 5492 1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 5490h2"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 707.33)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 5489h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 706.85)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 5489v10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 5499v-8"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 706.69)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 5499v7"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 704.29)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 5508h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 703.97)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 5508v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 5485v27"/>
              <path transform="matrix(0 -.16 -.16 0 389.47 683.01)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 -.16 -.16 0 389.47 676.93)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 686.69)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2441 5616v11"/>
              <path transform="matrix(0 -.16 -.16 0 390.59 687.49)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 -.16 -.16 0 389.95 689.25)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 -.16 -.16 0 388.67 685.41)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 -.16 -.16 0 387.39 684.93)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 387.39 684.93)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 388.67 684.45)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 -.16 -.16 0 389.95 680.61)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 -.16 -.16 0 390.59 682.21)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 -.16 -.16 0 389.47 686.85)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 -.16 -.16 0 389.47 692.93)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 683.17)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2441 5638v-11"/>
              <path transform="matrix(0 -.16 -.16 0 394.43 687.81)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 5608h14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 5627v23h-17"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 681.73)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2447 5647v-7l-7 2"/>
              <path transform="matrix(0 -.16 -.16 0 394.43 682.05)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 5646h14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2440 5613 7 1v-6"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 687.97)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2450 5604h17v23"/>
              <path transform="matrix(0 -.16 -.16 0 392.83 686.69)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2442 5616v3"/>
              <path transform="matrix(0 -.16 -.16 0 405.63 736.29)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(0 -.16 -.16 0 393.63 686.05)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2443 5621h-1v6"/>
              <path transform="matrix(0 -.16 -.16 0 393.31 684.29)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 683.17)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2443 5635"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2442 5627v6h1"/>
              <path transform="matrix(0 -.16 -.16 0 393.63 683.81)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 -.16 -.16 0 405.63 633.57)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2442 5636v2"/>
              <path transform="matrix(0 -.16 -.16 0 392.83 683.17)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 686.53)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2443 5619"/>
              <path transform="matrix(0 -.16 -.16 0 393.31 685.41)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 392.83 683.17)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2441 5621h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2441 5619h1"/>
              <path transform="matrix(0 -.16 -.16 0 392.83 686.69)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2440 5617h-3"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 686.37)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2436 5618v9-7"/>
              <path transform="matrix(0 -.16 -.16 0 392.99 686.05)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2436 5627v8"/>
              <path transform="matrix(0 -.16 -.16 0 392.99 683.65)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2440 5637h-3"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 683.49)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2436 5636v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2447 5614v26"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 620.61)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 614.53)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 624.29)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 6006v11"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 625.25)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 -.16 -.16 0 391.87 626.85)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 -.16 -.16 0 390.59 623.01)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 -.16 -.16 0 389.31 622.53)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 389.31 622.53)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 390.59 622.05)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 -.16 -.16 0 391.87 618.21)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 619.97)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 624.45)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 630.53)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 620.77)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 6028v-11"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 625.41)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 5998h14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2479 6017v23h-16"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 619.49)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2459 6036v-6l-6 1"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 619.65)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 6036h14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 6002 6 2v-7"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 625.73)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 5994h16v23"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 624.29)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2454 6006v2"/>
              <path transform="matrix(0 -.16 -.16 0 407.55 673.89)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(0 -.16 -.16 0 395.55 623.65)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 6011h-1v6"/>
              <path transform="matrix(0 -.16 -.16 0 395.39 622.05)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 395.55 620.93)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 6025"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2455 6017v6h1"/>
              <path transform="matrix(0 -.16 -.16 0 395.55 621.41)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 -.16 -.16 0 407.55 571.17)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2454 6025v3"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 620.77)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
              <path transform="matrix(0 -.16 -.16 0 395.55 624.29)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 6009"/>
              <path transform="matrix(0 -.16 -.16 0 395.39 623.17)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 620.77)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 6011h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 6009 2-1"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 624.29)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2452 6007h-3"/>
              <path transform="matrix(0 -.16 -.16 0 394.59 623.97)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 6008v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2449 6017v-8"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 623.81)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2449 6017v7"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 621.41)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2452 6027h-3"/>
              <path transform="matrix(0 -.16 -.16 0 394.59 621.09)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 6026v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2459 6004v26"/>
              <path transform="matrix(0 .16 .16 0 347.87 701.09)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 .16 .16 0 347.71 695.01)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 .16 .16 0 344.51 704.77)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 5503v11"/>
              <path transform="matrix(0 .16 .16 0 346.59 705.57)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 .16 .16 0 347.23 707.33)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 .16 .16 0 348.51 703.49)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 .16 .16 0 349.79 703.01)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 .16 .16 0 349.79 703.01)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 .16 .16 0 348.51 702.53)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 .16 .16 0 347.23 698.69)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 .16 .16 0 346.59 700.29)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 .16 .16 0 347.87 704.93)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 .16 .16 0 347.71 711.01)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 .16 .16 0 344.51 701.25)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 5525v-11"/>
              <path transform="matrix(0 .16 .16 0 342.75 705.89)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 5495h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2107 5514v23h16"/>
              <path transform="matrix(0 .16 .16 0 342.43 699.81)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 5534v-7l6 2"/>
              <path transform="matrix(0 .16 .16 0 342.75 700.13)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2125 5533h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 5500-6 1v-6"/>
              <path transform="matrix(0 .16 .16 0 342.43 706.05)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2123 5491h-16v23"/>
              <path transform="matrix(0 .16 .16 0 344.35 704.77)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131 5503v3"/>
              <path transform="matrix(0 .16 .16 0 331.71 754.37)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(0 .16 .16 0 343.71 704.13)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130 5508h1v6"/>
              <path transform="matrix(0 .16 .16 0 343.87 702.37)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 .16 .16 0 343.71 701.25)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130 5522"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131 5514v6h-1"/>
              <path transform="matrix(0 .16 .16 0 343.71 701.89)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(0 .16 .16 0 331.71 651.65)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2131 5523v2"/>
              <path transform="matrix(0 .16 .16 0 344.35 701.25)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
              <path transform="matrix(0 .16 .16 0 343.71 704.61)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2130 5506"/>
              <path transform="matrix(0 .16 .16 0 343.87 703.49)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 .16 .16 0 344.35 701.25)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2132 5508h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2133 5506h-2"/>
              <path transform="matrix(0 .16 .16 0 344.35 704.77)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 5504h3"/>
              <path transform="matrix(0 .16 .16 0 344.67 704.45)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 5505v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2137 5514v-7"/>
              <path transform="matrix(0 .16 .16 0 344.35 704.13)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2137 5514v8"/>
              <path transform="matrix(0 .16 .16 0 344.35 701.73)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2134 5524h3"/>
              <path transform="matrix(0 .16 .16 0 344.67 701.57)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2138 5523v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2127 5501v26"/>
              <path transform="matrix(0 .16 .16 0 768.19 542.21)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
              <path transform="matrix(0 .16 .16 0 768.19 549.25)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
              <path transform="matrix(0 .16 .16 0 764.35 538.05)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6545v-13"/>
              <path transform="matrix(0 .16 .16 0 766.75 537.09)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
              <path transform="matrix(0 .16 .16 0 767.71 535.17)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
              <path transform="matrix(0 .16 .16 0 769.15 539.65)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
              <path transform="matrix(0 .16 .16 0 770.59 540.13)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
              <path transform="matrix(0 .16 .16 0 770.59 540.13)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
              <path transform="matrix(0 .16 .16 0 769.15 540.61)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
              <path transform="matrix(0 .16 .16 0 767.71 544.93)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
              <path transform="matrix(0 .16 .16 0 766.75 543.17)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
              <path transform="matrix(0 .16 .16 0 768.19 537.89)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
              <path transform="matrix(0 .16 .16 0 768.19 530.85)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
              <path transform="matrix(0 .16 .16 0 764.35 542.05)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6520v12"/>
              <path transform="matrix(0 .16 .16 0 762.43 536.93)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 6554h-16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6532v-27h19"/>
              <path transform="matrix(0 .16 .16 0 762.11 543.65)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4750 6510v7l7-1"/>
              <path transform="matrix(0 .16 .16 0 762.43 543.33)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 6510h-16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6549-7-2v8"/>
              <path transform="matrix(0 .16 .16 0 762.11 536.45)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 6559h-19v-27"/>
              <path transform="matrix(0 .16 .16 0 764.35 538.05)" d="m-3.6873-2.5795c0.8573-1.2255 2.2674-1.945 3.7628-1.9199"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6545v-3"/>
              <path transform="matrix(0 .16 .16 0 749.63 481.09)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
              <path transform="matrix(0 .16 .16 0 763.39 538.85)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 6539h1v-7"/>
              <path transform="matrix(0 .16 .16 0 763.71 540.77)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 .16 .16 0 763.55 542.05)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 6523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6532v-6l-1-1"/>
              <path transform="matrix(0 .16 .16 0 763.39 541.41)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 .16 .16 0 749.63 599.17)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6522v-3"/>
              <path transform="matrix(0 .16 .16 0 764.35 542.21)" d="m-0.07463-4.4994c1.4954-0.02481 2.9054 0.69495 3.7624 1.9206"/>
              <path transform="matrix(0 .16 .16 0 763.55 538.21)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 6541"/>
              <path transform="matrix(0 .16 .16 0 763.71 539.49)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 .16 .16 0 764.35 542.21)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4756 6539h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6542h-2"/>
              <path transform="matrix(0 .16 .16 0 764.35 538.05)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 6544h3"/>
              <path transform="matrix(0 .16 .16 0 764.51 538.37)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4762 6543v-11 9"/>
              <path transform="matrix(0 .16 .16 0 764.19 538.69)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4762 6532v-8"/>
              <path transform="matrix(0 .16 .16 0 764.19 541.41)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 6521h3"/>
              <path transform="matrix(0 .16 .16 0 764.51 541.73)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4762 6522v10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4750 6547v-30"/>
              <path transform="matrix(0 .16 .16 0 768.35 560.45)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
              <path transform="matrix(0 .16 .16 0 768.35 567.49)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
              <path transform="matrix(0 .16 .16 0 764.51 556.29)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6431v-13"/>
              <path transform="matrix(0 .16 .16 0 766.91 555.33)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
              <path transform="matrix(0 .16 .16 0 767.71 553.41)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
              <path transform="matrix(0 .16 .16 0 769.31 557.89)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
              <path transform="matrix(0 .16 .16 0 770.75 558.37)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
              <path transform="matrix(0 .16 .16 0 770.75 558.37)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
              <path transform="matrix(0 .16 .16 0 769.31 558.85)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
              <path transform="matrix(0 .16 .16 0 767.71 563.17)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
              <path transform="matrix(0 .16 .16 0 766.91 561.41)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
              <path transform="matrix(0 .16 .16 0 768.35 556.13)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
              <path transform="matrix(0 .16 .16 0 768.35 549.09)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
              <path transform="matrix(0 .16 .16 0 764.51 560.29)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6406v12"/>
              <path transform="matrix(0 .16 .16 0 762.59 555.01)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4749 6440h-17"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4727 6418v-26h19"/>
              <path transform="matrix(0 .16 .16 0 762.11 561.89)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 6396v7l7-1"/>
              <path transform="matrix(0 .16 .16 0 762.59 561.57)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4749 6396h-17"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 6435-7-1v7"/>
              <path transform="matrix(0 .16 .16 0 762.11 554.69)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 6445h-19v-27"/>
              <path transform="matrix(0 .16 .16 0 764.35 556.29)" d="m-3.6873-2.5795c0.8573-1.2255 2.2674-1.945 3.7628-1.9199"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4756 6431v-3"/>
              <path transform="matrix(0 .16 .16 0 749.79 499.33)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
              <path transform="matrix(0 .16 .16 0 763.55 556.93)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6425h1v-7"/>
              <path transform="matrix(0 .16 .16 0 763.87 559.01)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 .16 .16 0 763.71 560.29)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6409"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4756 6418v-6l-1-1"/>
              <path transform="matrix(0 .16 .16 0 763.55 559.65)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 .16 .16 0 749.79 617.41)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4756 6409v-4"/>
              <path transform="matrix(0 .16 .16 0 764.35 560.45)" d="m-0.07463-4.4994c1.4954-0.02481 2.9054 0.69495 3.7624 1.9206"/>
              <path transform="matrix(0 .16 .16 0 763.71 556.45)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 6427"/>
              <path transform="matrix(0 .16 .16 0 763.87 557.73)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 .16 .16 0 764.35 560.45)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6426-1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 6428h-1"/>
              <path transform="matrix(0 .16 .16 0 764.35 556.29)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 6430h4"/>
              <path transform="matrix(0 .16 .16 0 764.67 556.61)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 6429v-11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4762 6418v9"/>
              <path transform="matrix(0 .16 .16 0 764.35 556.93)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4762 6418v-8"/>
              <path transform="matrix(0 .16 .16 0 764.35 559.65)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 6407h4"/>
              <path transform="matrix(0 .16 .16 0 764.67 559.97)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4763 6408v10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 6434v-31"/>
              <path transform="matrix(0 .16 .16 0 769.31 620.61)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 .16 .16 0 769.15 614.53)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 .16 .16 0 765.95 624.29)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 6006v11"/>
              <path transform="matrix(0 .16 .16 0 768.03 625.25)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 .16 .16 0 768.83 626.85)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 .16 .16 0 770.11 623.01)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 .16 .16 0 771.23 622.53)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 .16 .16 0 771.23 622.53)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 .16 .16 0 770.11 622.05)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 .16 .16 0 768.83 618.21)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 .16 .16 0 768.03 619.97)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 .16 .16 0 769.31 624.45)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 .16 .16 0 769.15 630.53)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 .16 .16 0 765.95 620.77)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 6028v-11"/>
              <path transform="matrix(0 .16 .16 0 764.19 625.41)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 5998h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 6017v23h16"/>
              <path transform="matrix(0 .16 .16 0 763.87 619.49)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4761 6036v-6l6 1"/>
              <path transform="matrix(0 .16 .16 0 764.19 619.65)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 6036h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 6002-6 2v-7"/>
              <path transform="matrix(0 .16 .16 0 763.87 625.73)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 5994h-16v23"/>
              <path transform="matrix(0 .16 .16 0 765.79 624.29)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 6006v2"/>
              <path transform="matrix(0 .16 .16 0 753.15 673.89)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(0 .16 .16 0 765.15 623.65)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 6011h1v6"/>
              <path transform="matrix(0 .16 .16 0 765.31 622.05)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 .16 .16 0 765.15 620.93)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 6025"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 6017v6h-1"/>
              <path transform="matrix(0 .16 .16 0 765.15 621.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(0 .16 .16 0 753.15 571.17)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 6025v3"/>
              <path transform="matrix(0 .16 .16 0 765.79 620.77)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
              <path transform="matrix(0 .16 .16 0 765.15 624.29)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 6009"/>
              <path transform="matrix(0 .16 .16 0 765.31 623.17)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 .16 .16 0 765.79 620.77)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 6011h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 6009-2-1"/>
              <path transform="matrix(0 .16 .16 0 765.79 624.29)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4768 6007h3"/>
              <path transform="matrix(0 .16 .16 0 766.11 623.97)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4772 6008v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4771 6017v-8"/>
              <path transform="matrix(0 .16 .16 0 765.79 623.81)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4771 6017v7"/>
              <path transform="matrix(0 .16 .16 0 765.79 621.41)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4768 6027h3"/>
              <path transform="matrix(0 .16 .16 0 766.11 621.09)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4772 6026v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4761 6004v26"/>
              <path transform="matrix(0 -.16 -.16 0 812.83 701.09)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 -.16 -.16 0 812.83 695.01)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 -.16 -.16 0 816.19 704.77)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 5503v11"/>
              <path transform="matrix(0 -.16 -.16 0 814.11 705.57)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 -.16 -.16 0 813.31 707.33)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 -.16 -.16 0 812.03 703.49)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 -.16 -.16 0 810.75 703.01)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 810.75 703.01)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 812.03 702.53)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 -.16 -.16 0 813.31 698.69)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 -.16 -.16 0 814.11 700.29)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 -.16 -.16 0 812.83 704.93)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 -.16 -.16 0 812.83 711.01)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 -.16 -.16 0 816.19 701.25)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 5525v-11"/>
              <path transform="matrix(0 -.16 -.16 0 817.79 705.89)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 5495h14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5113 5514v23h-16"/>
              <path transform="matrix(0 -.16 -.16 0 818.27 699.81)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 5534v-7l-6 2"/>
              <path transform="matrix(0 -.16 -.16 0 817.79 700.13)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5095 5533h14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 5500 6 1v-6"/>
              <path transform="matrix(0 -.16 -.16 0 818.27 706.05)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5097 5491h16v23"/>
              <path transform="matrix(0 -.16 -.16 0 816.35 704.77)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5089 5503-1 3"/>
              <path transform="matrix(0 -.16 -.16 0 828.99 754.37)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(0 -.16 -.16 0 816.99 704.13)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 5508h-1v6"/>
              <path transform="matrix(0 -.16 -.16 0 816.83 702.37)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 816.99 701.25)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 5522"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5089 5514v6h1"/>
              <path transform="matrix(0 -.16 -.16 0 816.99 701.89)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 -.16 -.16 0 828.99 651.65)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5088 5523 1 2"/>
              <path transform="matrix(0 -.16 -.16 0 816.35 701.25)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
              <path transform="matrix(0 -.16 -.16 0 816.99 704.61)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5090 5506"/>
              <path transform="matrix(0 -.16 -.16 0 816.83 703.49)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 816.35 701.25)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 5508h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5087 5506h2"/>
              <path transform="matrix(0 -.16 -.16 0 816.35 704.77)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 5504h-3"/>
              <path transform="matrix(0 -.16 -.16 0 816.03 704.45)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 5505v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5083 5514v-7"/>
              <path transform="matrix(0 -.16 -.16 0 816.35 704.13)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5083 5514v8"/>
              <path transform="matrix(0 -.16 -.16 0 816.35 701.73)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5086 5524h-3"/>
              <path transform="matrix(0 -.16 -.16 0 816.03 701.57)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5082 5523v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5093 5501v26"/>
              <path transform="matrix(0 .16 .16 0 769.31 827.17)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 .16 .16 0 769.15 821.09)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 .16 .16 0 765.95 830.85)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 4715v11"/>
              <path transform="matrix(0 .16 .16 0 768.03 831.65)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 .16 .16 0 768.83 833.41)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 .16 .16 0 770.11 829.57)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 .16 .16 0 771.23 829.09)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 .16 .16 0 771.23 829.09)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 .16 .16 0 770.11 828.61)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 .16 .16 0 768.83 824.77)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 .16 .16 0 768.03 826.37)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 .16 .16 0 769.31 831.01)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 .16 .16 0 769.15 837.09)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 .16 .16 0 765.95 827.33)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 4737v-11"/>
              <path transform="matrix(0 .16 .16 0 764.19 831.97)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4707h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 4726v23h16"/>
              <path transform="matrix(0 .16 .16 0 763.87 825.89)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4761 4746v-7l6 2"/>
              <path transform="matrix(0 .16 .16 0 764.19 826.21)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4745h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 4712-6 1v-6"/>
              <path transform="matrix(0 .16 .16 0 763.87 832.13)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4757 4703h-16v23"/>
              <path transform="matrix(0 .16 .16 0 765.79 830.85)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 4715v3"/>
              <path transform="matrix(0 .16 .16 0 753.15 880.45)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(0 .16 .16 0 765.15 830.21)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 4720h1v6"/>
              <path transform="matrix(0 .16 .16 0 765.31 828.45)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 .16 .16 0 765.15 827.33)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 4734"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 4726v6h-1"/>
              <path transform="matrix(0 .16 .16 0 765.15 827.97)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(0 .16 .16 0 753.15 777.73)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4765 4735v2"/>
              <path transform="matrix(0 .16 .16 0 765.79 827.33)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
              <path transform="matrix(0 .16 .16 0 765.15 830.69)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4764 4718"/>
              <path transform="matrix(0 .16 .16 0 765.31 829.57)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 .16 .16 0 765.79 827.33)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 4720h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4767 4718h-2"/>
              <path transform="matrix(0 .16 .16 0 765.79 830.85)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4768 4716h3"/>
              <path transform="matrix(0 .16 .16 0 766.11 830.53)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4772 4717v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4771 4726v-7"/>
              <path transform="matrix(0 .16 .16 0 765.79 830.21)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4771 4726v8"/>
              <path transform="matrix(0 .16 .16 0 765.79 827.81)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4768 4736h3"/>
              <path transform="matrix(0 .16 .16 0 766.11 827.65)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4772 4735v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4761 4713v26"/>
              <path transform="matrix(0 .16 .16 0 767.23 897.57)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 .16 .16 0 767.23 903.65)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 .16 .16 0 763.87 893.89)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4321v-11"/>
              <path transform="matrix(0 .16 .16 0 765.95 892.93)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 .16 .16 0 766.75 891.33)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 .16 .16 0 768.03 895.17)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 .16 .16 0 769.15 895.65)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 .16 .16 0 769.15 895.65)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 .16 .16 0 768.03 896.13)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 .16 .16 0 766.75 899.97)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 .16 .16 0 765.95 898.21)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 .16 .16 0 767.23 893.73)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 .16 .16 0 767.23 887.65)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 .16 .16 0 763.87 897.41)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4299v11"/>
              <path transform="matrix(0 .16 .16 0 762.11 892.77)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4329h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 4310v-23h16"/>
              <path transform="matrix(0 .16 .16 0 761.79 898.69)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4291v6l6-1"/>
              <path transform="matrix(0 .16 .16 0 762.11 898.53)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4291h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4325-6-2v7"/>
              <path transform="matrix(0 .16 .16 0 761.79 892.45)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4744 4333h-16v-23"/>
              <path transform="matrix(0 .16 .16 0 763.71 893.89)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4321v-2"/>
              <path transform="matrix(0 .16 .16 0 751.07 844.29)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(0 .16 .16 0 763.07 894.53)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4316h1v-6"/>
              <path transform="matrix(0 .16 .16 0 763.23 896.13)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 .16 .16 0 763.07 897.25)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4302"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4310v-6h-1"/>
              <path transform="matrix(0 .16 .16 0 763.07 896.77)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 .16 .16 0 751.07 947.01)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4302v-3"/>
              <path transform="matrix(0 .16 .16 0 763.71 897.41)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
              <path transform="matrix(0 .16 .16 0 763.07 893.89)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4318"/>
              <path transform="matrix(0 .16 .16 0 763.23 895.01)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 .16 .16 0 763.71 897.41)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4316h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4318-2 1"/>
              <path transform="matrix(0 .16 .16 0 763.71 893.89)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4320h3"/>
              <path transform="matrix(0 .16 .16 0 764.03 894.21)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4319v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4310v8"/>
              <path transform="matrix(0 .16 .16 0 763.71 894.37)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4310v-7"/>
              <path transform="matrix(0 .16 .16 0 763.71 896.77)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4300h3"/>
              <path transform="matrix(0 .16 .16 0 764.03 897.09)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4301v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4323v-26"/>
              <path transform="matrix(-.16 0 0 .16 439.55 330.21)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
              <path transform="matrix(-.16 0 0 .16 446.59 330.21)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
              <path transform="matrix(-.16 0 0 .16 435.39 326.37)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2704 7872h13"/>
              <path transform="matrix(-.16 0 0 .16 434.43 328.77)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
              <path transform="matrix(-.16 0 0 .16 432.51 329.57)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
              <path transform="matrix(-.16 0 0 .16 436.99 331.01)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
              <path transform="matrix(-.16 0 0 .16 437.47 332.45)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
              <path transform="matrix(-.16 0 0 .16 437.47 332.45)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
              <path transform="matrix(-.16 0 0 .16 437.95 331.01)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
              <path transform="matrix(-.16 0 0 .16 442.27 329.57)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
              <path transform="matrix(-.16 0 0 .16 440.51 328.77)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
              <path transform="matrix(-.16 0 0 .16 435.23 330.21)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
              <path transform="matrix(-.16 0 0 .16 428.19 330.21)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
              <path transform="matrix(-.16 0 0 .16 439.39 326.37)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2729 7872h-12"/>
              <path transform="matrix(-.16 0 0 .16 434.27 324.45)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2695 7880v17"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2717 7902h27v-19"/>
              <path transform="matrix(-.16 0 0 .16 440.99 323.97)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2739 7879h-7l1-8"/>
              <path transform="matrix(-.16 0 0 .16 440.67 324.45)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2739 7880v17"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2700 7871 2 8h-8"/>
              <path transform="matrix(-.16 0 0 .16 433.79 323.97)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2690 7883v19h27"/>
              <path transform="matrix(-.16 0 0 .16 435.39 326.21)" d="m-0.07507-4.4994c1.4954-0.02495 2.9054 0.69467 3.7626 1.9202"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2704 7873h3"/>
              <path transform="matrix(-.16 0 0 .16 378.43 311.65)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
              <path transform="matrix(-.16 0 0 .16 436.19 325.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2710 7875v-2h7"/>
              <path transform="matrix(-.16 0 0 .16 438.11 325.57)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(-.16 0 0 .16 439.39 325.41)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2726 7875"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2717 7873h6l1 2"/>
              <path transform="matrix(-.16 0 0 .16 438.75 325.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(-.16 0 0 .16 496.51 311.65)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2727 7873h3"/>
              <path transform="matrix(-.16 0 0 .16 439.55 326.21)" d="m-3.6876-2.5791c0.85718-1.2256 2.2672-1.9452 3.7626-1.9202"/>
              <path transform="matrix(-.16 0 0 .16 435.55 325.41)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2708 7875"/>
              <path transform="matrix(-.16 0 0 .16 436.83 325.57)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(-.16 0 0 .16 439.55 326.21)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2710 7872v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2707 7872v1"/>
              <path transform="matrix(-.16 0 0 .16 435.39 326.21)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2705 7871v-4"/>
              <path transform="matrix(-.16 0 0 .16 435.71 326.53)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2706 7866h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2717 7867h-9"/>
              <path transform="matrix(-.16 0 0 .16 436.03 326.05)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2717 7867h8"/>
              <path transform="matrix(-.16 0 0 .16 438.75 326.05)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2728 7871v-4"/>
              <path transform="matrix(-.16 0 0 .16 439.07 326.53)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2727 7866h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2702 7879h30"/>
              <path transform="matrix(-.16 0 0 .16 414.43 330.21)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
              <path transform="matrix(-.16 0 0 .16 421.47 330.21)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
              <path transform="matrix(-.16 0 0 .16 410.27 326.37)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2547 7872h13"/>
              <path transform="matrix(-.16 0 0 .16 409.31 328.77)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
              <path transform="matrix(-.16 0 0 .16 407.39 329.57)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
              <path transform="matrix(-.16 0 0 .16 411.87 331.01)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
              <path transform="matrix(-.16 0 0 .16 412.35 332.45)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
              <path transform="matrix(-.16 0 0 .16 412.35 332.45)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
              <path transform="matrix(-.16 0 0 .16 412.83 331.01)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
              <path transform="matrix(-.16 0 0 .16 417.15 329.57)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
              <path transform="matrix(-.16 0 0 .16 415.39 328.77)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
              <path transform="matrix(-.16 0 0 .16 410.11 330.21)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
              <path transform="matrix(-.16 0 0 .16 403.07 330.21)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
              <path transform="matrix(-.16 0 0 .16 414.27 326.37)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2572 7872h-12"/>
              <path transform="matrix(-.16 0 0 .16 408.99 324.45)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2538 7880v17"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2560 7902h26v-19"/>
              <path transform="matrix(-.16 0 0 .16 415.87 323.97)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2582 7879h-7l1-8"/>
              <path transform="matrix(-.16 0 0 .16 415.55 324.45)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2582 7880v17"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2543 7871 1 8h-7"/>
              <path transform="matrix(-.16 0 0 .16 408.67 323.97)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2533 7883v19h27"/>
              <path transform="matrix(-.16 0 0 .16 410.27 326.21)" d="m-0.07507-4.4994c1.4954-0.02495 2.9054 0.69467 3.7626 1.9202"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2547 7873h3"/>
              <path transform="matrix(-.16 0 0 .16 353.31 311.65)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
              <path transform="matrix(-.16 0 0 .16 410.91 325.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2553 7875v-2h7"/>
              <path transform="matrix(-.16 0 0 .16 412.99 325.57)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(-.16 0 0 .16 414.27 325.41)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2569 7875"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2560 7873h6l1 2"/>
              <path transform="matrix(-.16 0 0 .16 413.63 325.41)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(-.16 0 0 .16 471.39 311.65)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2569 7873h4"/>
              <path transform="matrix(-.16 0 0 .16 414.43 326.21)" d="m-3.6876-2.5791c0.85718-1.2256 2.2672-1.9452 3.7626-1.9202"/>
              <path transform="matrix(-.16 0 0 .16 410.43 325.41)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2551 7875"/>
              <path transform="matrix(-.16 0 0 .16 411.71 325.57)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(-.16 0 0 .16 414.43 326.21)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2552 7872 1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2550 7872v1"/>
              <path transform="matrix(-.16 0 0 .16 410.27 326.21)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2548 7871v-4"/>
              <path transform="matrix(-.16 0 0 .16 410.59 326.53)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2549 7866h11"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2560 7867h-9"/>
              <path transform="matrix(-.16 0 0 .16 410.91 326.05)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2560 7867h8"/>
              <path transform="matrix(-.16 0 0 .16 413.63 326.05)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2571 7871v-4"/>
              <path transform="matrix(-.16 0 0 .16 413.95 326.53)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2570 7866h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2544 7879h31"/>
              <path transform="matrix(-.16 0 0 .16 751.07 329.89)" d="m33.498 0.34687c-0.10484 10.125-4.7839 19.66-12.729 25.938"/>
              <path transform="matrix(-.16 0 0 .16 758.11 329.73)" d="m73.457-24.705c2.7635 8.2168 4.1288 16.839 4.039 25.508"/>
              <path transform="matrix(-.16 0 0 .16 746.91 326.05)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4651 7874h13"/>
              <path transform="matrix(-.16 0 0 .16 745.95 328.45)" d="m-40.344-3.5483c0.43656-4.9637 1.7854-9.8042 3.9787-14.278"/>
              <path transform="matrix(-.16 0 0 .16 744.03 329.25)" d="m-49.801 16.616c-2.7277-8.1753-3.4009-16.896-1.9601-25.393"/>
              <path transform="matrix(-.16 0 0 .16 748.51 330.69)" d="m-7.6384 22.224c-6.9202-2.3785-12.337-7.8448-14.654-14.786"/>
              <path transform="matrix(-.16 0 0 .16 748.99 332.13)" d="m0.01812 13.5c-1.4992 2e-3 -2.9883-0.24572-4.4061-0.73303"/>
              <path transform="matrix(-.16 0 0 .16 748.99 332.13)" d="m4.388 12.767c-1.4178 0.48731-2.9069 0.73504-4.4061 0.73303"/>
              <path transform="matrix(-.16 0 0 .16 749.47 330.69)" d="m22.292 7.4378c-2.316 6.9413-7.7333 12.408-14.654 14.786"/>
              <path transform="matrix(-.16 0 0 .16 753.95 329.25)" d="m51.762-8.7721c1.4397 8.4955 0.76629 17.215-1.9609 25.388"/>
              <path transform="matrix(-.16 0 0 .16 752.03 328.45)" d="m36.367-17.823c2.1929 4.4744 3.5412 9.3151 3.9773 14.279"/>
              <path transform="matrix(-.16 0 0 .16 746.75 329.89)" d="m-20.769 26.285c-7.9449-6.2779-12.624-15.812-12.729-25.938"/>
              <path transform="matrix(-.16 0 0 .16 739.71 329.73)" d="m-77.496 0.80245c-0.08979-8.6711 1.2763-17.296 4.0414-25.515"/>
              <path transform="matrix(-.16 0 0 .16 750.91 326.05)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4676 7874h-12"/>
              <path transform="matrix(-.16 0 0 .16 745.79 323.97)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4642 7883v16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4664 7904h27v-19"/>
              <path transform="matrix(-.16 0 0 .16 752.51 323.65)" d="m0 4.5c-2.4853 0-4.5-2.0147-4.5-4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4686 7881h-7l1-7"/>
              <path transform="matrix(-.16 0 0 .16 752.19 323.97)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4686 7883v16"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4647 7874 2 7h-8"/>
              <path transform="matrix(-.16 0 0 .16 745.31 323.65)" d="m4.5 0c0 2.4853-2.0147 4.5-4.5 4.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4637 7885v19h27"/>
              <path transform="matrix(-.16 0 0 .16 746.91 325.89)" d="m-0.07507-4.4994c1.4954-0.02495 2.9054 0.69467 3.7626 1.9202"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4651 7876h3"/>
              <path transform="matrix(-.16 0 0 .16 689.95 311.17)" d="m-359.12 86.961c-0.10559-0.43612-0.21039-0.87243-0.31442-1.3089"/>
              <path transform="matrix(-.16 0 0 .16 747.71 324.93)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4657 7877v-1h7"/>
              <path transform="matrix(-.16 0 0 .16 749.63 325.25)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(-.16 0 0 .16 750.91 325.09)" d="m3.3532-1.0031c0.26812 0.89622 0.16631 1.8625-0.28272 2.6831"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4673 7877"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4664 7876h7v1"/>
              <path transform="matrix(-.16 0 0 .16 750.27 324.93)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(-.16 0 0 .16 808.03 311.17)" d="m359.44 85.652c-0.10403 0.4365-0.20883 0.87281-0.31442 1.3089"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4674 7876h3"/>
              <path transform="matrix(-.16 0 0 .16 751.07 325.89)" d="m-3.6876-2.5791c0.85718-1.2256 2.2672-1.9452 3.7626-1.9202"/>
              <path transform="matrix(-.16 0 0 .16 747.07 325.09)" d="m-3.0704 1.68c-0.44908-0.82076-0.55086-1.7872-0.28263-2.6835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4655 7877"/>
              <path transform="matrix(-.16 0 0 .16 748.35 325.25)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(-.16 0 0 .16 751.07 325.89)" d="m-4.0406-1.9808c0.10209-0.20826 0.22013-0.40832 0.35306-0.59838"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4657 7874v2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4655 7874-1 2"/>
              <path transform="matrix(-.16 0 0 .16 746.91 325.89)" d="m3.6878-2.5788c0.13291 0.19008 0.25093 0.39015 0.353 0.59842"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4653 7873v-4"/>
              <path transform="matrix(-.16 0 0 .16 747.39 326.21)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4653 7868 11 1h-9"/>
              <path transform="matrix(-.16 0 0 .16 747.55 325.73)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4664 7869h8"/>
              <path transform="matrix(-.16 0 0 .16 750.27 325.73)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4675 7873v-4"/>
              <path transform="matrix(-.16 0 0 .16 750.59 326.21)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4674 7868-10 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4649 7881h30"/>
              <path transform="matrix(0 .16 .16 0 767.23 914.37)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 .16 .16 0 767.23 920.45)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 .16 .16 0 763.87 910.69)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4216v-11"/>
              <path transform="matrix(0 .16 .16 0 765.95 909.73)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 .16 .16 0 766.75 908.13)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 .16 .16 0 768.03 911.97)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 .16 .16 0 769.15 912.45)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 .16 .16 0 769.15 912.45)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 .16 .16 0 768.03 912.93)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 .16 .16 0 766.75 916.77)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 .16 .16 0 765.95 915.01)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 .16 .16 0 767.23 910.53)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 .16 .16 0 767.23 904.45)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 .16 .16 0 763.87 914.21)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4194v11"/>
              <path transform="matrix(0 .16 .16 0 762.11 909.57)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4224h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 4205v-23h16"/>
              <path transform="matrix(0 .16 .16 0 761.79 915.49)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4186v6l6-1"/>
              <path transform="matrix(0 .16 .16 0 762.11 915.17)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4186h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4220-6-2v7"/>
              <path transform="matrix(0 .16 .16 0 761.79 909.25)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4744 4228h-16v-23"/>
              <path transform="matrix(0 .16 .16 0 763.71 910.69)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4216v-2"/>
              <path transform="matrix(0 .16 .16 0 751.07 861.09)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(0 .16 .16 0 763.07 911.33)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4211h1v-6"/>
              <path transform="matrix(0 .16 .16 0 763.23 912.93)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 .16 .16 0 763.07 914.05)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4197"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4205v-6h-1"/>
              <path transform="matrix(0 .16 .16 0 763.07 913.57)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 .16 .16 0 751.07 963.81)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4197v-3"/>
              <path transform="matrix(0 .16 .16 0 763.71 914.21)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
              <path transform="matrix(0 .16 .16 0 763.07 910.69)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4213"/>
              <path transform="matrix(0 .16 .16 0 763.23 911.81)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 .16 .16 0 763.71 914.21)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4211h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4213-2 1"/>
              <path transform="matrix(0 .16 .16 0 763.71 910.69)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4215h3"/>
              <path transform="matrix(0 .16 .16 0 764.03 911.01)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4214v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4205v8"/>
              <path transform="matrix(0 .16 .16 0 763.71 911.17)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4205v-7"/>
              <path transform="matrix(0 .16 .16 0 763.71 913.57)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4195h3"/>
              <path transform="matrix(0 .16 .16 0 764.03 913.89)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4196v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4218v-26"/>
              <path transform="matrix(0 .16 .16 0 767.23 880.77)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 .16 .16 0 767.23 886.85)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 .16 .16 0 763.87 877.09)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4426v-11"/>
              <path transform="matrix(0 .16 .16 0 765.95 876.13)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 .16 .16 0 766.75 874.53)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 .16 .16 0 768.03 878.37)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 .16 .16 0 769.15 878.85)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 .16 .16 0 769.15 878.85)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 .16 .16 0 768.03 879.33)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 .16 .16 0 766.75 883.17)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 .16 .16 0 765.95 881.41)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 .16 .16 0 767.23 876.93)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 .16 .16 0 767.23 870.85)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 .16 .16 0 763.87 880.61)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4404v11"/>
              <path transform="matrix(0 .16 .16 0 762.11 875.97)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4434h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 4415v-23h16"/>
              <path transform="matrix(0 .16 .16 0 761.79 881.89)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4396v6l6-1"/>
              <path transform="matrix(0 .16 .16 0 762.11 881.73)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4396h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4430-6-2v7"/>
              <path transform="matrix(0 .16 .16 0 761.79 875.65)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4744 4438h-16v-23"/>
              <path transform="matrix(0 .16 .16 0 763.71 877.09)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4426v-2"/>
              <path transform="matrix(0 .16 .16 0 751.07 827.49)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(0 .16 .16 0 763.07 877.73)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4421h1v-6"/>
              <path transform="matrix(0 .16 .16 0 763.23 879.33)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 .16 .16 0 763.07 880.45)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4407"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4415v-6h-1"/>
              <path transform="matrix(0 .16 .16 0 763.07 879.97)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 .16 .16 0 751.07 930.21)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4407v-3"/>
              <path transform="matrix(0 .16 .16 0 763.71 880.61)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
              <path transform="matrix(0 .16 .16 0 763.07 877.09)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4423"/>
              <path transform="matrix(0 .16 .16 0 763.23 878.21)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 .16 .16 0 763.71 880.61)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4421h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4423-2 1"/>
              <path transform="matrix(0 .16 .16 0 763.71 877.09)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4425h3"/>
              <path transform="matrix(0 .16 .16 0 764.03 877.41)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4424v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4415v8"/>
              <path transform="matrix(0 .16 .16 0 763.71 877.57)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4415v-7"/>
              <path transform="matrix(0 .16 .16 0 763.71 879.97)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4405h3"/>
              <path transform="matrix(0 .16 .16 0 764.03 880.29)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4406v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4428v-26"/>
              <path transform="matrix(0 .16 .16 0 767.23 863.97)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 .16 .16 0 767.23 870.05)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 .16 .16 0 763.87 860.29)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4531v-11"/>
              <path transform="matrix(0 .16 .16 0 765.95 859.33)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 .16 .16 0 766.75 857.73)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 .16 .16 0 768.03 861.57)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 .16 .16 0 769.15 862.05)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 .16 .16 0 769.15 862.05)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 .16 .16 0 768.03 862.53)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 .16 .16 0 766.75 866.37)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 .16 .16 0 765.95 864.77)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 .16 .16 0 767.23 860.13)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 .16 .16 0 767.23 854.05)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 .16 .16 0 763.87 863.81)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4509v11"/>
              <path transform="matrix(0 .16 .16 0 762.11 859.17)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4539h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 4520v-23h16"/>
              <path transform="matrix(0 .16 .16 0 761.79 865.09)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4501v6l6-1"/>
              <path transform="matrix(0 .16 .16 0 762.11 864.93)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4501h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4535-6-2v7"/>
              <path transform="matrix(0 .16 .16 0 761.79 858.85)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4744 4543h-16v-23"/>
              <path transform="matrix(0 .16 .16 0 763.71 860.29)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4531v-2"/>
              <path transform="matrix(0 .16 .16 0 751.07 810.69)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(0 .16 .16 0 763.07 860.93)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4526h1v-6"/>
              <path transform="matrix(0 .16 .16 0 763.23 862.53)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 .16 .16 0 763.07 863.65)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4512"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4520v-6h-1"/>
              <path transform="matrix(0 .16 .16 0 763.07 863.17)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 .16 .16 0 751.07 913.41)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4512v-3"/>
              <path transform="matrix(0 .16 .16 0 763.71 863.81)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
              <path transform="matrix(0 .16 .16 0 763.07 860.29)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4528"/>
              <path transform="matrix(0 .16 .16 0 763.23 861.41)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 .16 .16 0 763.71 863.81)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4526h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4528-2 1"/>
              <path transform="matrix(0 .16 .16 0 763.71 860.29)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4530h3"/>
              <path transform="matrix(0 .16 .16 0 764.03 860.61)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4529v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4520v7"/>
              <path transform="matrix(0 .16 .16 0 763.71 860.93)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4520v-7"/>
              <path transform="matrix(0 .16 .16 0 763.71 863.17)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4510h3"/>
              <path transform="matrix(0 .16 .16 0 764.03 863.49)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4511v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4533v-26"/>
              <path transform="matrix(0 .16 .16 0 767.23 844.93)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 .16 .16 0 767.23 838.69)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 .16 .16 0 763.87 848.45)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4605v11"/>
              <path transform="matrix(0 .16 .16 0 765.95 849.41)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 .16 .16 0 766.75 851.01)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 .16 .16 0 768.03 847.17)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 .16 .16 0 769.15 846.69)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 .16 .16 0 769.15 846.69)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 .16 .16 0 768.03 846.21)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 .16 .16 0 766.75 842.37)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 .16 .16 0 765.95 844.13)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 .16 .16 0 767.23 848.61)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 .16 .16 0 767.23 854.69)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 .16 .16 0 763.87 844.93)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4627v-11"/>
              <path transform="matrix(0 .16 .16 0 762.11 849.57)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4597h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 4616v23h16"/>
              <path transform="matrix(0 .16 .16 0 761.79 843.65)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4635v-6l6 1"/>
              <path transform="matrix(0 .16 .16 0 762.11 843.97)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4746 4635h-14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4601-6 2v-7"/>
              <path transform="matrix(0 .16 .16 0 761.79 849.89)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4744 4593h-16v23"/>
              <path transform="matrix(0 .16 .16 0 763.71 848.45)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4605v2"/>
              <path transform="matrix(0 .16 .16 0 751.07 898.05)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(0 .16 .16 0 763.07 847.81)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4610h1v6"/>
              <path transform="matrix(0 .16 .16 0 763.23 846.21)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 .16 .16 0 763.07 845.09)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4616v6h-1"/>
              <path transform="matrix(0 .16 .16 0 763.07 845.57)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(0 .16 .16 0 751.07 795.33)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4752 4624v3"/>
              <path transform="matrix(0 .16 .16 0 763.71 844.93)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
              <path transform="matrix(0 .16 .16 0 763.07 848.45)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4751 4608"/>
              <path transform="matrix(0 .16 .16 0 763.23 847.33)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 .16 .16 0 763.71 844.93)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4610h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4754 4608-2-1"/>
              <path transform="matrix(0 .16 .16 0 763.71 848.45)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4606h3"/>
              <path transform="matrix(0 .16 .16 0 764.03 848.13)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4607v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4616v-8"/>
              <path transform="matrix(0 .16 .16 0 763.71 847.97)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4758 4616v7"/>
              <path transform="matrix(0 .16 .16 0 763.71 845.57)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4755 4626h3"/>
              <path transform="matrix(0 .16 .16 0 764.03 845.25)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4759 4625v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4748 4603v26"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 827.17)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 821.09)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 830.85)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 4715v11"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 831.65)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 -.16 -.16 0 391.87 833.41)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 -.16 -.16 0 390.59 829.57)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 -.16 -.16 0 389.31 829.09)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 389.31 829.09)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 390.59 828.61)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 -.16 -.16 0 391.87 824.77)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 826.37)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 831.01)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 837.09)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 827.33)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 4737v-11"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 831.97)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4707h14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2479 4726v23h-16"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 825.89)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2459 4746v-7l-6 2"/>
              <path transform="matrix(0 -.16 -.16 0 396.35 826.21)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4745h14"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 4712 6 1v-6"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 832.13)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2463 4703h16v23"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 830.85)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2454 4715v3"/>
              <path transform="matrix(0 -.16 -.16 0 407.55 880.45)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(0 -.16 -.16 0 395.55 830.21)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 4720h-1v6"/>
              <path transform="matrix(0 -.16 -.16 0 395.39 828.45)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 395.55 827.33)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 4734"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2455 4726v6h1"/>
              <path transform="matrix(0 -.16 -.16 0 395.55 827.97)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 -.16 -.16 0 407.55 777.73)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2454 4735v2"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 827.33)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
              <path transform="matrix(0 -.16 -.16 0 395.55 830.69)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2456 4718"/>
              <path transform="matrix(0 -.16 -.16 0 395.39 829.57)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 827.33)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 4720h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2453 4718h2"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 830.85)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2452 4716h-3"/>
              <path transform="matrix(0 -.16 -.16 0 394.59 830.53)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 4717v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2449 4726v-7"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 830.21)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2449 4726v8"/>
              <path transform="matrix(0 -.16 -.16 0 394.91 827.81)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2452 4736h-3"/>
              <path transform="matrix(0 -.16 -.16 0 394.59 827.65)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2448 4735v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2459 4713v26"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 897.57)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 903.65)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 893.89)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4321v-11"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 892.93)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 891.33)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 895.17)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 895.65)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 895.65)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 896.13)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 899.97)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 898.21)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 893.73)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 887.65)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 897.41)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4299v11"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 892.77)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4329h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 4310v-23h-16"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 898.69)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4291v6l-6-1"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 898.53)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4291h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4325 6-2v7"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 892.45)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 4333h16v-23"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 893.89)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4321v-2"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 844.29)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 894.53)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4316v-6"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 896.13)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 897.25)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4302"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4310v-6"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 896.77)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 947.01)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4302v-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 897.41)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 893.89)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4318"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 895.01)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 897.41)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4316h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4318 2 1"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 893.89)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4320h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 894.21)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4319v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4310v8"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 894.37)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4310v-7"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 896.77)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4300h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 897.09)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4301v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4323v-26"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 914.37)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 920.45)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 910.69)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4216v-11"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 909.73)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 908.13)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 911.97)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 912.45)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 912.45)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 912.93)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 916.77)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 915.01)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 910.53)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 904.45)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 914.21)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4194v11"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 909.57)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4224h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 4205v-23h-16"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 915.49)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4186v6l-6-1"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 915.17)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4186h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4220 6-2v7"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 909.25)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 4228h16v-23"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 910.69)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4216v-2"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 861.09)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 911.33)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4211v-6"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 912.93)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 914.05)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4197"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4205v-6"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 913.57)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 963.81)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4197v-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 914.21)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 910.69)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4213"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 911.81)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 914.21)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4211h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4213 2 1"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 910.69)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4215h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 911.01)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4214v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4205v8"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 911.17)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4205v-7"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 913.57)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4195h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 913.89)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4196v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4218v-26"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 880.77)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 886.85)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 877.09)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4426v-11"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 876.13)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 874.53)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 878.37)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 878.85)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 878.85)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 879.33)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 883.17)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 881.41)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 876.93)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 870.85)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 880.61)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4404v11"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 875.97)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4434h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 4415v-23h-16"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 881.89)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4396v6l-6-1"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 881.73)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4396h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4430 6-2v7"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 875.65)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 4438h16v-23"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 877.09)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4426v-2"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 827.49)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 877.73)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4421v-6"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 879.33)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 880.45)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4407"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4415v-6"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 879.97)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 930.21)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4407v-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 880.61)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 877.09)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4423"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 878.21)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 880.61)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4421h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4423 2 1"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 877.09)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4425h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 877.41)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4424v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4415v8"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 877.57)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4415v-7"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 879.97)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4405h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 880.29)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4406v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4428v-26"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 863.97)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 870.05)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 860.29)" d="m-0.01074-3.5c1.5069-0.00463 2.8476 0.95573 3.328 2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4531v-11"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 859.33)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 857.73)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 861.57)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 862.05)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 862.05)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 862.53)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 866.37)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 864.77)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 860.13)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 854.05)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 863.81)" d="m-3.3173-1.116c0.48049-1.4282 1.8212-2.3886 3.328-2.384"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4509v11"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 859.17)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4539h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 4520v-23h-16"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 865.09)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4501v6l-6-1"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 864.93)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4501h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4535 6-2v7"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 858.85)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 4543h16v-23"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 860.29)" d="m-0.05838-3.4995c1.1631-0.01941 2.2598 0.5403 2.9265 1.4935"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4531v-2"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 810.69)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 860.93)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4526v-6"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 862.53)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 863.65)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4512"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4520v-6"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 863.17)" d="m-1.4591-0.34771c0.16098-0.67557 0.76466-1.1523 1.4591-1.1523s1.2982 0.47672 1.4591 1.1523"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 913.41)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4512v-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 863.81)" d="m-2.8681-2.006c0.6667-0.95322 1.7634-1.5129 2.9265-1.4935"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 860.29)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4528"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 861.41)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 863.81)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4526h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4528 2 1"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 860.29)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4530h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 860.61)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4529v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4520v7"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 860.93)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4520v-7"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 863.17)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4510h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 863.49)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4511v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4533v-26"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 844.93)" d="m-18.289 23.146c-6.9963-5.5283-11.117-13.924-11.209-22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 838.69)" d="m-67.496 0.69891c-0.0782-7.5522 1.1116-15.064 3.5199-22.222"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 848.45)" d="m-3.3172-1.1164c0.48063-1.4282 1.8214-2.3884 3.3283-2.3836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4605v11"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 849.41)" d="m30.98-15.183c1.868 3.8115 3.0166 7.9351 3.3881 12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 851.01)" d="m44.86-7.6025c1.2478 7.3628 0.66413 14.92-1.6994 22.003"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 847.17)" d="m19.446 6.4883c-2.0204 6.0552-6.7461 10.824-12.783 12.899"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 846.69)" d="m3.7379 10.876c-1.2078 0.41511-2.4763 0.62614-3.7534 0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 391.39 846.69)" d="m0.01544 11.5c-1.2771 0.0017-2.5456-0.20932-3.7534-0.62443"/>
              <path transform="matrix(0 -.16 -.16 0 392.67 846.21)" d="m-6.6633 19.387c-6.0368-2.0748-10.762-6.8434-12.783-12.899"/>
              <path transform="matrix(0 -.16 -.16 0 393.95 842.37)" d="m-43.161 14.401c-2.364-7.0852-2.9474-14.644-1.6987-22.008"/>
              <path transform="matrix(0 -.16 -.16 0 394.75 844.13)" d="m-34.367-3.0226c0.37189-4.2283 1.5209-8.3518 3.3892-12.163"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 848.61)" d="m29.498 0.30545c-0.09233 8.9163-4.2127 17.312-11.209 22.841"/>
              <path transform="matrix(0 -.16 -.16 0 393.47 854.69)" d="m63.979-21.517c2.4069 7.1565 3.596 14.666 3.5178 22.216"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 844.93)" d="m-0.0104-3.5c1.5069-0.00448 2.8474 0.95601 3.3278 2.3843"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4627v-11"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 849.57)" d="m-0.42785 1.4377c-0.66183-0.19696-1.1037-0.82029-1.0704-1.51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4597h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 4616v23h-16"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 843.65)" d="m3.5 0c0 1.933-1.567 3.5-3.5 3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4635v-6l-6 1"/>
              <path transform="matrix(0 -.16 -.16 0 398.43 843.97)" d="m1.4983-0.07217c0.03322 0.68966-0.40863 1.3129-1.0704 1.5099"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2473 4635h15"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4601 6 2v-7"/>
              <path transform="matrix(0 -.16 -.16 0 398.91 849.89)" d="m0 3.5c-1.933 0-3.5-1.567-3.5-3.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2476 4593h16v23"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 848.45)" d="m-2.8679-2.0063c0.66679-0.95315 1.7636-1.5128 2.9266-1.4932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4605v2"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 898.05)" d="m312.74 74.525c-0.0905 0.37979-0.1817 0.75942-0.27359 1.1389"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 847.81)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4610v6"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 846.21)" d="m2.931-1.9128c0.49145 0.75304 0.67421 1.6664 0.51038 2.5505"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 845.09)" d="m-2.1932 1.2c-0.32077-0.58626-0.39348-1.2765-0.20188-1.9168"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4616v6"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 845.57)" d="m-1.4591-0.34785c0.16105-0.67555 0.76477-1.1522 1.4592-1.1522 0.69449 7e-5 1.2981 0.47685 1.459 1.1524"/>
              <path transform="matrix(0 -.16 -.16 0 409.63 795.33)" d="m-312.47 75.664c-0.0919-0.37946-0.18308-0.75909-0.27359-1.1389"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 4624v3"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 844.93)" d="m-0.05805-3.4995c1.1631-0.01929 2.2597 0.54052 2.9263 1.4938"/>
              <path transform="matrix(0 -.16 -.16 0 397.63 848.45)" d="m2.3951-0.71653c0.19151 0.64016 0.11878 1.3303-0.20195 1.9165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2468 4608"/>
              <path transform="matrix(0 -.16 -.16 0 397.47 847.33)" d="m-3.4414 0.63767c-0.16385-0.88429 0.01898-1.7977 0.51056-2.5508"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 844.93)" d="m2.8683-2.0057c0.10338 0.14784 0.19518 0.30345 0.27456 0.46544"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4610h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2466 4608 2-1"/>
              <path transform="matrix(0 -.16 -.16 0 396.83 848.45)" d="m-3.1427-1.5406c0.07941-0.16198 0.17122-0.31758 0.27461-0.46541"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4606h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 848.13)" d="M -0.07607,0.49418 C -0.31997,0.45664 -0.5,0.24677 -0.5,0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4607v9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4616v-8"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 847.97)" d="m0 2.5c-0.81656 0-1.5816-0.39878-2.0493-1.0681-0.46768-0.66936-0.579-1.5249-0.29817-2.2917"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2462 4616v7"/>
              <path transform="matrix(0 -.16 -.16 0 396.99 845.57)" d="m2.3476-0.85958c0.28074 0.76673 0.16937 1.6222-0.29832 2.2916s-1.2328 1.068-2.0493 1.068"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2465 4626h-3"/>
              <path transform="matrix(0 -.16 -.16 0 396.67 845.25)" d="m0.5 0c0 0.24677-0.18003 0.45664-0.42393 0.49418"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2461 4625v-9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2472 4603v26"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#545454" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
              <path transform="matrix(0 .16 .16 0 398.27 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 397.47 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 397.95 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5735h2v20"/>
              <path transform="matrix(0 .16 .16 0 400.03 664.13)" d="m0.1402 6.4985c-0.06791 0.00146-0.13584 0.00186-0.20376 0.0012"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5757v-22"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5740v-8"/>
              <path transform="matrix(0 .16 .16 0 399.87 668.13)" d="M 3.4962,-0.16302 C 3.54076,0.79249 3.1923,1.7246 2.53185,2.41655 1.87141,3.1085 0.95655,3.5 0,3.5"/>
              <path transform="matrix(0 .16 .16 0 397.63 666.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 398.11 666.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 397.63 665.41)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 398.11 665.41)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 399.87 663.65)" d="m-1.6318 3.0963c-1.2011-0.63299-1.9277-1.9035-1.8644-3.2597"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5757"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m3.181 1.4599c-0.50451 1.0992-1.5408 1.8601-2.7407 2.0123s-2.3933-0.32601-3.1562-1.2646"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-2.7157-2.2079c0.75129-0.92409 1.9209-1.4027 3.1045-1.2704 1.1836 0.13229 2.2187 0.85736 2.7474 1.9245"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5740v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5740v-5"/>
              <path transform="matrix(0 .16 .16 0 400.35 667.33)" d="m2.4049-0.68294c0.12681 0.44655 0.12679 0.91958-6e-5 1.3661"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5735"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5735"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5742v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5743v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5743v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5743v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5743v-1"/>
              <path transform="matrix(0 .16 .16 0 400.35 666.21)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5740h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5740h3-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5742h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5740"/>
              <path transform="matrix(0 .16 .16 0 400.19 666.85)" d="m0.03367-0.49886c0.19712 0.0133 0.36792 0.14143 0.43585 0.32694"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5742h-1v-2"/>
              <path transform="matrix(0 .16 .16 0 400.03 666.53)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5740"/>
              <path transform="matrix(0 .16 .16 0 400.35 666.85)" d="m0.4695 0.17196c-0.06795 0.18551-0.23876 0.31362-0.43587 0.32691"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5742v-2"/>
              <path transform="matrix(0 .16 .16 0 400.51 666.53)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5742h-1"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
              <path transform="matrix(0 .16 .16 0 400.35 666.85)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.73)" d="m4.1238-1.8011c0.50159 1.1485 0.50153 2.4541-1.7e-4 3.6026"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5743h-3 3"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-0.95427-2.3107c0.6113-0.25245 1.2977-0.25239 1.909 1.9e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5747v-2"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5744 2-1h-1v1"/>
              <path transform="matrix(0 .16 .16 0 400.03 666.53)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5743"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5745v2"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5743 2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5744v-1"/>
              <path transform="matrix(0 .16 .16 0 400.51 666.53)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5743h1"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5756v1"/>
              <path transform="matrix(0 .16 .16 0 400.83 664.13)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 .16 .16 0 400.83 664.13)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5757v3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5756v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5761v-5 5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5761v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5755v7"/>
              <path transform="matrix(0 .16 .16 0 405.63 663.81)" d="m-3.1542-27.319c2.0976-0.24219 4.2162-0.24199 6.3137 6.1e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5755v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5753v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5753v-2"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
              <path transform="matrix(0 .16 .16 0 400.35 666.53)" d="m-7.1856 2.1489c-0.41927-1.4019-0.41927-2.8959 0-4.2978"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5748v3h5-5"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5749-2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5751v-3"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.89)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5748-2 1"/>
              <path transform="matrix(0 .16 .16 0 400.35 665.25)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
              <path transform="matrix(0 .16 .16 0 400.35 664.13)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5753h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5754h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5756h5"/>
              <path transform="matrix(0 .16 .16 0 400.35 663.65)" d="m2.8518-2.029c0.86427 1.2148 0.86419 2.8436-1.9e-4 4.0583"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5756v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5753v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5754v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5753"/>
              <path transform="matrix(0 .16 .16 0 400.03 664.61)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5754"/>
              <path transform="matrix(0 .16 .16 0 400.03 664.77)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5756h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5757"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5757h1v-1"/>
              <path transform="matrix(0 .16 .16 0 399.87 664.29)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5756v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5753v1-1"/>
              <path transform="matrix(0 .16 .16 0 400.67 664.61)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5753"/>
              <path transform="matrix(0 .16 .16 0 400.67 664.77)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5754"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5756"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5756"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5757h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5756h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5755h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5762"/>
              <path transform="matrix(0 .16 .16 0 400.35 664.29)" d="m-5.115 2.0217c-0.51338-1.2989-0.51338-2.7444 0-4.0433"/>
              <path transform="matrix(0 .16 .16 0 401.47 663.81)" d="m-1.3742-12.424c0.91414-0.10111 1.8367-0.10103 2.7508 2.6e-4"/>
              <path transform="matrix(0 .16 .16 0 399.55 663.81)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5758h1v1h-1"/>
              <path transform="matrix(0 .16 .16 0 399.87 663.49)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5760v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5761"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5761"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5760h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5761h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5758v2"/>
              <path transform="matrix(0 .16 .16 0 400.67 663.81)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
              <path transform="matrix(0 .16 .16 0 401.15 663.81)" d="m-0.96136-2.3078c0.61544-0.25637 1.3078-0.2563 1.9232 1.9e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5757h1v1h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5762"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5761"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5760h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5761h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5760v1"/>
              <path transform="matrix(0 .16 .16 0 400.83 663.65)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 .16 .16 0 400.83 663.65)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5760h1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5762h-1"/>
              <path transform="matrix(0 .16 .16 0 400.03 667.65)" d="m5.0615 4.0781c-1.2648 1.5698-3.1863 2.4639-5.2017 2.4204"/>
              <path transform="matrix(0 .16 .16 0 400.19 667.81)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
              <path transform="matrix(0 .16 .16 0 399.71 661.89)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
              <path transform="matrix(0 .16 .16 0 398.59 665.73)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
              <path transform="matrix(0 .16 .16 0 398.59 666.05)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
              <path transform="matrix(0 .16 .16 0 399.71 669.89)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
              <path transform="matrix(0 .16 .16 0 400.19 663.97)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
              <path transform="matrix(0 .16 .16 0 400.03 664.13)" d="m-3.2022 5.6565c-0.71381-0.4041-1.3447-0.93965-1.8593-1.5784"/>
              <path transform="matrix(0 .16 .16 0 398.91 668.77)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
              <path transform="matrix(0 .16 .16 0 399.23 663.97)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2479 5758v-23"/>
              <path transform="matrix(0 .16 .16 0 399.23 667.65)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
              <path transform="matrix(0 .16 .16 0 398.91 663.01)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
              <path transform="matrix(0 .16 .16 0 398.11 665.89)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
              <path transform="matrix(0 .16 .16 0 398.11 665.89)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265 5932.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265 5927.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265 5929.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253 5950v1h20"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.6 5950c-0.068 0-0.1358 5e-4 -0.2036 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5950h-21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258 5945h-8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2250.5 5945c-0.9565 0-1.8716-0.3916-2.532-1.0835s-1.0088-1.6245-0.9641-2.5801"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2262 5928.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2262 5931.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267 5928.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267 5931.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2281 5941.3c0.063 1.356-0.6633 2.6265-1.8643 3.2593"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267.2 5946.7c-0.7627 0.9385-1.9563 1.417-3.156 1.2647-1.1999-0.1524-2.2363-0.9131-2.7407-2.0122"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2266 5946.5c-0.1746 0.1343-0.3657 0.2447-0.5691 0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261.4 5942.9c0.5288-1.0669 1.564-1.792 2.7476-1.9243 1.1836-0.1319 2.3532 0.3467 3.1042 1.271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265.5 5942.2c0.2032 0.084 0.3946 0.1944 0.5691 0.3287"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2257 5945h-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2257 5944-5-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2252.1 5945.2c-0.1269-0.4468-0.1269-0.9194 0-1.3662"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2252 5944"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2252 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5945h1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5943h1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260 5942h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.2 5945.4c-0.2014-0.5528-0.2014-1.1592 0-1.712"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2257 5945v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258 5943v3-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5946v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258 5944.3c0.068-0.1855 0.2388-0.3135 0.4358-0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5943h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.1 5943.8c-0.1643-0.188-0.1643-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2258.5 5946c-0.197-0.014-0.3679-0.1416-0.4358-0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.1 5946.8c-0.1643-0.188-0.1643-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2259 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2262 5944.8c-0.029-0.2183-0.029-0.439 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.8 5943.6c0.2012 0.5528 0.2012 1.1587-2e-4 1.7115"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2266 5944.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261.4 5946.3c-0.5017-1.1485-0.5017-2.4541 0-3.6026"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5946v-3 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263.5 5942.2c0.6113-0.2524 1.2979-0.2524 1.9092 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265 5942h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2262 5944.2c0.087-0.6558 0.4302-1.2505 0.9546-1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2262 5942-1 2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.9 5943.2c0.1643 0.1885 0.1643 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263 5942.5c0.1746-0.1343 0.3657-0.2447 0.5691-0.3287"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265.5 5946.8c-0.6113 0.2525-1.2979 0.2525-1.9092 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263 5947h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263 5946.5c-0.5244-0.4028-0.8677-0.9975-0.9546-1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5945 1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260.9 5946.2c0.1643 0.1885 0.1643 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2261 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2260 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263.5 5946.8c-0.2034-0.084-0.3945-0.1943-0.5691-0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5947h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.9 5948.8c-0.091 0.1464-0.2517 0.2358-0.4246 0.2358-0.1728 0-0.3333-0.089-0.4246-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.1 5948.2c0.095-0.1049 0.2297-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5949h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5946h6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5942h6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5942h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5940"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5940h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5951h7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273.3 5950.2c2.0977-0.2422 4.2163-0.2422 6.314 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5951h7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2270 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2270 5942h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267 5944.2c0.029 0.2182 0.029 0.4389 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2266.7 5942.4c0.4189 1.4018 0.4189 2.8955-2e-4 4.2973"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2266 5942h3v4-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2266 5942.5c0.5244 0.4033 0.8675 0.998 0.9544 1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267 5944-2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2269 5946h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2267 5944.8c-0.087 0.6558-0.4302 1.2505-0.9546 1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2265 5946 2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272.8 5943.3c0.2188 0.7886 0.2188 1.6211-2e-4 2.4092"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271.2 5945.7c-0.219-0.7881-0.219-1.6211 0-2.4092"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2270 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5942v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274.6 5946.5c-0.8645-1.2149-0.8645-2.8438 0-4.0586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5942h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271 5943h1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5942h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271.2 5943.3c-0.2771-0.4702-0.2771-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272.8 5941.7c0.2768 0.4697 0.2766 1.0527-3e-4 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5942"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5942v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5940"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5940v1h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5942.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5947h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5945h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271.2 5947.3c-0.2771-0.4702-0.2771-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2271 5946v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272.8 5945.7c0.2768 0.4697 0.2766 1.0527-3e-4 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2272 5946v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5950v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274 5948v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2273 5951v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280 5951v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278.6 5942.5c0.5132 1.2988 0.513 2.7441-2e-4 4.0425"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.1 5940.1c0.9143-0.1011 1.8367-0.1011 2.751 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2276.9 5940.8c-0.094 0.1265-0.2427 0.2007-0.4004 0.2007s-0.3061-0.074-0.4004-0.2007"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2276 5940v1h1v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2279.2 5942.9c-0.1425-0.083-0.2351-0.2309-0.247-0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5940"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5942v-2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5947h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2277.7 5948.7c-0.7351 0.3921-1.6175 0.3921-2.3526 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275.5 5948.2c0.6155-0.2564 1.3079-0.2564 1.9234 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5947v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2279 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2279 5947"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5950v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278 5948v-1h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278.9 5948.8c-0.091 0.1464-0.2517 0.2358-0.4246 0.2358-0.1728 0-0.3333-0.089-0.4246-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2278.1 5948.2c0.095-0.1049 0.2297-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2277 5947v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280 5951"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253.6 5950c-2.0153 0.044-3.9367-0.8506-5.2016-2.4204"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2248.2 5948c-0.6926-0.8594-1.1106-1.9077-1.1995-3.0078"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2247.1 5944.8c-0.3731-4.8574 0.092-9.7426 1.3747-14.442"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2248.3 5930.1c1.5342-7.8628 8.2114-13.68 16.21-14.122"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2264.5 5916c7.9988 0.4428 14.675 6.2602 16.209 14.123"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280.5 5930.3c1.282 4.6987 1.7465 9.5825 1.3737 14.438"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2282 5944.9c-0.089 1.1001-0.5069 2.1484-1.1995 3.0078"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2280.6 5947.6c-0.5146 0.6387-1.1455 1.1743-1.8593 1.5782"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2274.8 5924.9c1.6699 4.2026 2.4153 8.7153 2.1855 13.232"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2277 5937.6c-0.043 0.7964-0.7004 1.4199-1.4978 1.4199"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2275 5939h-23"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2252.5 5939c-0.7974 0-1.4553-0.6235-1.4978-1.4199"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2251 5938.1c-0.2298-4.5176 0.5158-9.0313 2.1867-13.235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2253.5 5924.5c2.1326-3.9155 6.1895-6.3984 10.646-6.5166"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2263.8 5918c4.4571 0.1186 8.5137 2.602 10.646 6.5176"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351 5932.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351 5927.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351 5929.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2360 5950v1h-19"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339.6 5950h-0.2036"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5950h21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5945h7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2367 5941.3c0.045 0.9556-0.3037 1.8877-0.9644 2.5796-0.6604 0.6919-1.5752 1.0835-2.5317 1.0835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5928.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5931.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5928.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5931.5c0 0.2764-0.2239 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2239-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2334.9 5944.6c-1.2012-0.6328-1.9278-1.9033-1.8643-3.2598"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353.7 5946c-0.5044 1.0991-1.5408 1.8598-2.7407 2.0122-1.1997 0.1523-2.3933-0.3262-3.156-1.2647"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349.5 5946.8c-0.2034-0.084-0.3945-0.1943-0.5691-0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347.8 5942.3c0.7514-0.9238 1.9209-1.4028 3.1045-1.2705s2.2187 0.8574 2.7475 1.9248"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349 5942.5c0.1746-0.1343 0.3657-0.2447 0.5691-0.3287"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5945h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5944 5-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2361.9 5943.8c0.1267 0.4468 0.1267 0.9199-2e-4 1.3662"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2361 5944"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2361 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5946h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5945h-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5943h-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5942h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354.8 5943.6c0.2012 0.5528 0.2012 1.1587-2e-4 1.7115"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5945v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5946v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5946v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5946v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2355 5943h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356.5 5944c0.197 0.014 0.3679 0.1416 0.4358 0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5943h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354.9 5943.2c0.1643 0.1885 0.1643 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2356 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2357 5945.7c-0.068 0.1855-0.2388 0.3134-0.4358 0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5946h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354.9 5946.2c0.1643 0.1885 0.1643 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2354 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5944.2c0.029 0.2182 0.029 0.4389 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353.2 5945.4c-0.2014-0.5528-0.2014-1.1592 0-1.712"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5944.5c0 0.8286-0.6716 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6716-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352.6 5942.7c0.5017 1.1485 0.5017 2.4541 0 3.6026"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5946v-3 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349.5 5942.2c0.6113-0.2524 1.2978-0.2524 1.9091 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349 5942h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5942.5c0.5244 0.4033 0.8675 0.998 0.9544 1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351 5942 1 2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353.1 5943.8c-0.1643-0.188-0.1643-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5943h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351.5 5942.2c0.2032 0.084 0.3946 0.1944 0.5691 0.3287"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351.5 5946.8c-0.6113 0.2525-1.2979 0.2525-1.9092 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2351 5947h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5944.8c-0.087 0.6558-0.4302 1.2505-0.9546 1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5945-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353.1 5946.8c-0.1643-0.188-0.1643-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2353 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2352 5946.5c-0.1746 0.1343-0.3657 0.2447-0.5691 0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5947h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339.9 5948.8c-0.091 0.1464-0.2517 0.2358-0.4246 0.2358-0.1728 0-0.3333-0.089-0.4246-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339.1 5948.2c0.095-0.1049 0.2297-0.165 0.3711-0.165 0.1416 0 0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5949h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5946h-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5942h-5 4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 5940"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5940h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341 5951h-8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2334.3 5950.2c2.0977-0.2422 4.2163-0.2422 6.3137 5e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341 5951h-8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5946h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5942h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5944.8c-0.029-0.2183-0.029-0.439 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347.3 5946.6c-0.4192-1.4018-0.4192-2.896 0-4.2978"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2345 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2344 5946v-4h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5944.2c0.087-0.6558 0.4302-1.2505 0.9546-1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2347 5944 1-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2344 5946h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349 5946.5c-0.5244-0.4028-0.8677-0.9975-0.9546-1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2348 5946-1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342.2 5945.7c-0.219-0.7881-0.219-1.6211 0-2.4092"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343.8 5943.3c0.2188 0.7886 0.2188 1.6211-2e-4 2.4092"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5942v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339.4 5942.5c0.8643 1.2143 0.8643 2.8432-2e-4 4.0581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5942h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5943h-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5942h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343.8 5941.7c0.2768 0.4697 0.2766 1.0527-3e-4 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341.2 5943.3c-0.2771-0.4702-0.2771-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5942"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5942v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5940v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340.2 5942.9c-0.1425-0.083-0.2351-0.2309-0.247-0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5946h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5947h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5945h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5946h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343.8 5945.7c0.2768 0.4697 0.2766 1.0527-3e-4 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2343 5946v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341.2 5947.3c-0.2771-0.4702-0.2771-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2342 5946v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2340 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5950v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339 5948v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2341 5951-1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2333 5951 1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335.4 5946.5c-0.5134-1.2988-0.5134-2.7442 0-4.043"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2336.1 5940.1c0.9143-0.1011 1.8367-0.1011 2.7508 5e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2337.9 5940.8c-0.094 0.1265-0.2427 0.2007-0.4004 0.2007s-0.3061-0.074-0.4004-0.2007"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 5940v1h-2v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5942.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5940"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5940v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2336 5940"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5942v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 5947h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338.7 5948.7c-0.7351 0.3921-1.6175 0.3921-2.3526 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2336.5 5948.2c0.6155-0.2564 1.3078-0.2564 1.9233 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 5947v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2334 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5947"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5950v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335 5948v-1h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335.9 5948.8c-0.091 0.1464-0.2517 0.2358-0.4246 0.2358-0.1728 0-0.3333-0.089-0.4246-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2335.1 5948.2c0.095-0.1049 0.2297-0.165 0.3711-0.165 0.1416 0 0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2336 5947v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2333 5951"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2365.6 5947.6c-1.2649 1.5698-3.1863 2.4639-5.2016 2.4204"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2368 5944.9c-0.089 1.1001-0.5069 2.1484-1.1995 3.0078"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2366.5 5930.3c1.282 4.6987 1.7465 9.5825 1.3737 14.438"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2350.5 5916c7.9988 0.4428 14.675 6.2602 16.209 14.123"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2334.3 5930.1c1.5342-7.8628 8.2114-13.68 16.21-14.122"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2332.1 5944.8c-0.3731-4.8574 0.092-9.7426 1.3747-14.442"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2334.2 5948c-0.6926-0.8594-1.1106-1.9077-1.1995-3.0078"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2336.3 5949.2c-0.7139-0.4039-1.3448-0.9395-1.8594-1.5782"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2337 5938.1c-0.2298-4.5176 0.5158-9.0313 2.1867-13.235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338.5 5939c-0.7974 0-1.4553-0.6235-1.4978-1.4199"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2338 5939h23"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2363 5937.6c-0.043 0.7964-0.7004 1.4199-1.4978 1.4199"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2360.8 5924.9c1.6699 4.2026 2.4153 8.7153 2.1855 13.232"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2349.8 5918c4.4571 0.1186 8.5137 2.602 10.646 6.5176"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2339.5 5924.5c2.1326-3.9155 6.1895-6.3984 10.646-6.5166"/>
              <path transform="matrix(0 .16 .16 0 398.27 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 397.47 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 397.95 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5906h2v19"/>
              <path transform="matrix(0 .16 .16 0 400.03 636.93)" d="m0.1402 6.4985c-0.06791 0.00146-0.13584 0.00186-0.20376 0.0012"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5927v-21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5910v-7"/>
              <path transform="matrix(0 .16 .16 0 399.87 640.77)" d="M 3.4962,-0.16302 C 3.54076,0.79249 3.1923,1.7246 2.53185,2.41655 1.87141,3.1085 0.95655,3.5 0,3.5"/>
              <path transform="matrix(0 .16 .16 0 397.63 639.01)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 398.11 639.01)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 397.63 638.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 398.11 638.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 399.87 636.45)" d="m-1.6318 3.0963c-1.2011-0.63299-1.9277-1.9035-1.8644-3.2597"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5927"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m3.181 1.4599c-0.50451 1.0992-1.5408 1.8601-2.7407 2.0123s-2.3933-0.32601-3.1562-1.2646"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-2.7157-2.2079c0.75129-0.92409 1.9209-1.4027 3.1045-1.2704 1.1836 0.13229 2.2187 0.85736 2.7474 1.9245"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5910v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5910v-5"/>
              <path transform="matrix(0 .16 .16 0 400.35 640.13)" d="m2.4049-0.68294c0.12681 0.44655 0.12679 0.91958-6e-5 1.3661"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5905"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5905"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5912v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5913v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5913v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5913v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5913v-1"/>
              <path transform="matrix(0 .16 .16 0 400.35 639.01)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5910h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5910h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5911h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5912h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5911v-1"/>
              <path transform="matrix(0 .16 .16 0 400.19 639.65)" d="m0.03367-0.49886c0.19712 0.0133 0.36792 0.14143 0.43585 0.32694"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5912h-1v-1"/>
              <path transform="matrix(0 .16 .16 0 400.03 639.17)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5910v1"/>
              <path transform="matrix(0 .16 .16 0 400.35 639.65)" d="m0.4695 0.17196c-0.06795 0.18551-0.23876 0.31362-0.43587 0.32691"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5912v-1"/>
              <path transform="matrix(0 .16 .16 0 400.51 639.17)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5912h-1"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
              <path transform="matrix(0 .16 .16 0 400.35 639.49)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.37)" d="m4.1238-1.8011c0.50159 1.1485 0.50153 2.4541-1.7e-4 3.6026"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5913h-3l3 1"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-0.95427-2.3107c0.6113-0.25245 1.2977-0.25239 1.909 1.9e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5918v-3"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5915 2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5913h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5914"/>
              <path transform="matrix(0 .16 .16 0 400.03 639.17)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5913v1"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5915v3"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5914 2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5914"/>
              <path transform="matrix(0 .16 .16 0 400.51 639.17)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5913"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5913h1v1"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5927v1"/>
              <path transform="matrix(0 .16 .16 0 400.83 636.93)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 .16 .16 0 400.83 636.93)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5927v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5926v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5926v5-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5928"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5927v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5925v8"/>
              <path transform="matrix(0 .16 .16 0 405.63 636.61)" d="m-3.1542-27.319c2.0976-0.24219 4.2162-0.24199 6.3137 6.1e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5925v8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5923v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5923v-1"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
              <path transform="matrix(0 .16 .16 0 400.35 639.33)" d="m-7.1856 2.1489c-0.41927-1.4019-0.41927-2.8959 0-4.2978"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5921h-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5922h-5v-4"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5919-2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5922v-4"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.69)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5918-2 1"/>
              <path transform="matrix(0 .16 .16 0 400.35 638.05)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
              <path transform="matrix(0 .16 .16 0 400.35 636.93)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5923h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5925h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5926h5"/>
              <path transform="matrix(0 .16 .16 0 400.35 636.45)" d="m2.8518-2.029c0.86427 1.2148 0.86419 2.8436-1.9e-4 4.0583"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5926v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5923v2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5925v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5923"/>
              <path transform="matrix(0 .16 .16 0 400.03 637.41)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5925"/>
              <path transform="matrix(0 .16 .16 0 400.03 637.41)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5926"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5927h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5927"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5927h1"/>
              <path transform="matrix(0 .16 .16 0 399.87 637.09)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5926v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5923v2-2"/>
              <path transform="matrix(0 .16 .16 0 400.67 637.41)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5923"/>
              <path transform="matrix(0 .16 .16 0 400.67 637.41)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5925"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5926"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5926"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5927h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5925h-1v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5933v-1"/>
              <path transform="matrix(0 .16 .16 0 400.35 637.09)" d="m-5.115 2.0217c-0.51338-1.2989-0.51338-2.7444 0-4.0433"/>
              <path transform="matrix(0 .16 .16 0 401.47 636.61)" d="m-1.3742-12.424c0.91414-0.10111 1.8367-0.10103 2.7508 2.6e-4"/>
              <path transform="matrix(0 .16 .16 0 399.55 636.61)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5928h1v2h-1"/>
              <path transform="matrix(0 .16 .16 0 399.87 636.13)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5931"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5931"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5931"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5931h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5930"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5931h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5928v2"/>
              <path transform="matrix(0 .16 .16 0 400.67 636.61)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
              <path transform="matrix(0 .16 .16 0 401.15 636.61)" d="m-0.96136-2.3078c0.61544-0.25637 1.3078-0.2563 1.9232 1.9e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5928h1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5931"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5931h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5930v1"/>
              <path transform="matrix(0 .16 .16 0 400.83 636.29)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 .16 .16 0 400.83 636.29)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5930h1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5933h-1"/>
              <path transform="matrix(0 .16 .16 0 400.03 640.29)" d="m5.0615 4.0781c-1.2648 1.5698-3.1863 2.4639-5.2017 2.4204"/>
              <path transform="matrix(0 .16 .16 0 400.19 640.61)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
              <path transform="matrix(0 .16 .16 0 399.71 634.69)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
              <path transform="matrix(0 .16 .16 0 398.59 638.53)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
              <path transform="matrix(0 .16 .16 0 398.59 638.69)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
              <path transform="matrix(0 .16 .16 0 399.71 642.53)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
              <path transform="matrix(0 .16 .16 0 400.19 636.61)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
              <path transform="matrix(0 .16 .16 0 400.03 636.93)" d="m-3.2022 5.6565c-0.71381-0.4041-1.3447-0.93965-1.8593-1.5784"/>
              <path transform="matrix(0 .16 .16 0 398.91 641.57)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
              <path transform="matrix(0 .16 .16 0 399.23 636.77)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2479 5928v-23"/>
              <path transform="matrix(0 .16 .16 0 399.23 640.45)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
              <path transform="matrix(0 .16 .16 0 398.91 635.65)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
              <path transform="matrix(0 .16 .16 0 398.11 638.53)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
              <path transform="matrix(0 .16 .16 0 398.11 638.69)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
              <path transform="matrix(0 .16 .16 0 398.27 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 397.47 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 397.95 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5814h2v20"/>
              <path transform="matrix(0 .16 .16 0 400.03 651.49)" d="m0.1402 6.4985c-0.06791 0.00146-0.13584 0.00186-0.20376 0.0012"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5836v-22"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5819v-8"/>
              <path transform="matrix(0 .16 .16 0 399.87 655.49)" d="M 3.4962,-0.16302 C 3.54076,0.79249 3.1923,1.7246 2.53185,2.41655 1.87141,3.1085 0.95655,3.5 0,3.5"/>
              <path transform="matrix(0 .16 .16 0 397.63 653.73)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 398.11 653.73)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 397.63 652.93)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 398.11 652.93)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 .16 .16 0 399.87 651.17)" d="m-1.6318 3.0963c-1.2011-0.63299-1.9277-1.9035-1.8644-3.2597"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5836"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m3.181 1.4599c-0.50451 1.0992-1.5408 1.8601-2.7407 2.0123s-2.3933-0.32601-3.1562-1.2646"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-2.7157-2.2079c0.75129-0.92409 1.9209-1.4027 3.1045-1.2704 1.1836 0.13229 2.2187 0.85736 2.7474 1.9245"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5818v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5818v-5"/>
              <path transform="matrix(0 .16 .16 0 400.35 654.85)" d="m2.4049-0.68294c0.12681 0.44655 0.12679 0.91958-6e-5 1.3661"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5813"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5813"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5820v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5821v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5821v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5821v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5821v-1"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.57)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5818h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5819h3-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5820h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5819"/>
              <path transform="matrix(0 .16 .16 0 400.19 654.21)" d="m0.03367-0.49886c0.19712 0.0133 0.36792 0.14143 0.43585 0.32694"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5820h-1v-1"/>
              <path transform="matrix(0 .16 .16 0 400.03 653.89)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5819"/>
              <path transform="matrix(0 .16 .16 0 400.35 654.21)" d="m0.4695 0.17196c-0.06795 0.18551-0.23876 0.31362-0.43587 0.32691"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5820v-1"/>
              <path transform="matrix(0 .16 .16 0 400.51 653.89)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5820h-1"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
              <path transform="matrix(0 .16 .16 0 400.35 654.21)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.09)" d="m4.1238-1.8011c0.50159 1.1485 0.50153 2.4541-1.7e-4 3.6026"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5822h-3 3"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-0.95427-2.3107c0.6113-0.25245 1.2977-0.25239 1.909 1.9e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5826v-2"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5823 2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5821h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5822"/>
              <path transform="matrix(0 .16 .16 0 400.03 653.89)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5822"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5824v2"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2485 5822 2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5822"/>
              <path transform="matrix(0 .16 .16 0 400.51 653.89)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5822"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5821h-1"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5835v1"/>
              <path transform="matrix(0 .16 .16 0 400.83 651.49)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 .16 .16 0 400.83 651.49)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5836v3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5835v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5840v-5 5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5835v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5834v7"/>
              <path transform="matrix(0 .16 .16 0 405.63 651.33)" d="m-3.1542-27.319c2.0976-0.24219 4.2162-0.24199 6.3137 6.1e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5834v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5831v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5831v-1"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
              <path transform="matrix(0 .16 .16 0 400.35 654.05)" d="m-7.1856 2.1489c-0.41927-1.4019-0.41927-2.8959 0-4.2978"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5827v3h5-5"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2484 5828-2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5830v-3"/>
              <path transform="matrix(0 .16 .16 0 400.35 653.25)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5827-2 1"/>
              <path transform="matrix(0 .16 .16 0 400.35 652.61)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
              <path transform="matrix(0 .16 .16 0 400.35 651.49)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5831h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5833h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5834h5"/>
              <path transform="matrix(0 .16 .16 0 400.35 651.17)" d="m2.8518-2.029c0.86427 1.2148 0.86419 2.8436-1.9e-4 4.0583"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5834v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5832v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5833v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5832"/>
              <path transform="matrix(0 .16 .16 0 400.03 651.97)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2483 5833"/>
              <path transform="matrix(0 .16 .16 0 400.03 652.13)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5834v1h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5836h1v-1"/>
              <path transform="matrix(0 .16 .16 0 399.87 651.65)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5834v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5832v1-1"/>
              <path transform="matrix(0 .16 .16 0 400.67 651.97)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5832"/>
              <path transform="matrix(0 .16 .16 0 400.67 652.13)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2486 5833"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5834"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5834v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5836h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5835h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5834h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5841"/>
              <path transform="matrix(0 .16 .16 0 400.35 651.81)" d="m-5.115 2.0217c-0.51338-1.2989-0.51338-2.7444 0-4.0433"/>
              <path transform="matrix(0 .16 .16 0 401.47 651.33)" d="m-1.3742-12.424c0.91414-0.10111 1.8367-0.10103 2.7508 2.6e-4"/>
              <path transform="matrix(0 .16 .16 0 399.55 651.33)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5837h1v1h-1"/>
              <path transform="matrix(0 .16 .16 0 399.87 650.85)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5839v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5839"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2481 5839"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2480 5839h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2482 5840h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5836v2"/>
              <path transform="matrix(0 .16 .16 0 400.67 651.33)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
              <path transform="matrix(0 .16 .16 0 401.15 651.33)" d="m-0.96136-2.3078c0.61544-0.25637 1.3078-0.2563 1.9232 1.9e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5836h1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2491 5840"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2487 5840"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2490 5839h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2489 5840h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5839v1"/>
              <path transform="matrix(0 .16 .16 0 400.83 651.01)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 .16 .16 0 400.83 651.01)" d="m-0.37109-0.3351c0.09482-0.105 0.22967-0.16491 0.37114-0.1649s0.27631 0.05995 0.3711 0.16497"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 5838h1v1h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2492 5841h-1"/>
              <path transform="matrix(0 .16 .16 0 400.03 655.01)" d="m5.0615 4.0781c-1.2648 1.5698-3.1863 2.4639-5.2017 2.4204"/>
              <path transform="matrix(0 .16 .16 0 400.19 655.17)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
              <path transform="matrix(0 .16 .16 0 399.71 649.25)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
              <path transform="matrix(0 .16 .16 0 398.59 653.09)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
              <path transform="matrix(0 .16 .16 0 398.59 653.41)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
              <path transform="matrix(0 .16 .16 0 399.71 657.25)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
              <path transform="matrix(0 .16 .16 0 400.19 651.33)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
              <path transform="matrix(0 .16 .16 0 400.03 651.49)" d="m-3.2022 5.6565c-0.71381-0.4041-1.3447-0.93965-1.8593-1.5784"/>
              <path transform="matrix(0 .16 .16 0 398.91 656.29)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
              <path transform="matrix(0 .16 .16 0 399.23 651.49)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2479 5836v-23"/>
              <path transform="matrix(0 .16 .16 0 399.23 655.17)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
              <path transform="matrix(0 .16 .16 0 398.91 650.37)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
              <path transform="matrix(0 .16 .16 0 398.11 653.25)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
              <path transform="matrix(0 .16 .16 0 398.11 653.41)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
              <path transform="matrix(0 -.16 -.16 0 762.43 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 763.23 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 762.75 665.89)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5735h-2v20"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 664.13)" d="m0.06356 6.4997c-0.06792 6.6e-4 -0.13585 2.6e-4 -0.20376-0.0012"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5757v-22"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5740v-8"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 668.13)" d="m0 3.5c-0.9566 0-1.8715-0.39154-2.532-1.0836s-1.0089-1.6242-0.96422-2.5798"/>
              <path transform="matrix(0 -.16 -.16 0 763.07 666.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 666.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 763.07 665.41)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 665.41)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 663.65)" d="m3.4962-0.16302c0.06323 1.3561-0.66341 2.6264-1.8644 3.2593"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5757"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m2.7159 2.2076c-0.7629 0.93855-1.9563 1.4167-3.1562 1.2646s-2.2362-0.91301-2.7407-2.0123"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-3.136-1.5541c0.52883-1.0671 1.564-1.7921 2.7476-1.9242 1.1836-0.13217 2.3532 0.34658 3.1044 1.2707"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5740v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5740v-5"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 667.33)" d="m-2.4048 0.68317c-0.12687-0.44661-0.12687-0.91973 0-1.3663"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5735"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5735"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5743v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5742v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5742v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5743v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 666.21)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5740h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5740h-3 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5742h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5740"/>
              <path transform="matrix(0 -.16 -.16 0 760.51 666.85)" d="m-0.4695-0.17196c0.06795-0.18551 0.23876-0.31362 0.43587-0.32691"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5742v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5742"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 666.53)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5740"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 666.85)" d="m-0.03363 0.49887c-0.19711-0.01329-0.36792-0.1414-0.43587-0.32691"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5742v-2"/>
              <path transform="matrix(0 -.16 -.16 0 760.19 666.53)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5742"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 666.85)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.73)" d="m-4.1237 1.8015c-0.50176-1.1486-0.50176-2.4544 0-3.6029"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5743h3-3"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-0.95449-2.3106c0.61127-0.25251 1.2977-0.25251 1.909 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5747v-2"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5744-2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5744v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 666.53)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5743"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5745v2"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5743-2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5744v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.19 666.53)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5743"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5756v1"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 664.13)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 664.13)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5757v3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5756v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5761v-5 5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5761v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5755v7"/>
              <path transform="matrix(0 -.16 -.16 0 755.07 663.81)" d="m-3.1569-27.318c2.0976-0.2424 4.2161-0.2424 6.3137 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5755v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5753v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5753v-2"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 666.53)" d="m7.1858-2.1482c0.41906 1.4017 0.41898 2.8954-2.1e-4 4.2971"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5748v3h-4 4"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5749 2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5751v-3"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.89)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5748 2 1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 665.25)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 664.13)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5753h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5754h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5756h-4"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 663.65)" d="m-2.8517 2.0293c-0.86445-1.2148-0.86445-2.8438 0-4.0586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5756v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5754v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5754v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5753h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 664.61)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5754h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 664.77)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5756h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 5757"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5757h-1v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 664.29)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5756v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5753v1-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.03 664.61)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5753"/>
              <path transform="matrix(0 -.16 -.16 0 760.03 664.77)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5754"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5756"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5756"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5757h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5756h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5755h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5762h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 664.29)" d="m5.1152-2.0212c0.51319 1.2988 0.51312 2.7441-1.9e-4 4.0428"/>
              <path transform="matrix(0 -.16 -.16 0 759.23 663.81)" d="m-1.3754-12.424c0.91414-0.1012 1.8367-0.1012 2.7508 0"/>
              <path transform="matrix(0 -.16 -.16 0 760.99 663.81)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5758h-1v1h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 663.49)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 5760v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5760h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5761h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5758v2"/>
              <path transform="matrix(0 -.16 -.16 0 760.03 663.81)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
              <path transform="matrix(0 -.16 -.16 0 759.55 663.81)" d="m-0.96158-2.3077c0.61541-0.25643 1.3078-0.25643 1.9232 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5757h-1v1h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5762"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5761"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5760h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5761h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5760v1"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 663.65)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 663.65)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5760h-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5762"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 667.65)" d="m0.1402 6.4985c-2.0154 0.04348-3.937-0.85061-5.2017-2.4204"/>
              <path transform="matrix(0 -.16 -.16 0 760.51 667.81)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 661.89)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
              <path transform="matrix(0 -.16 -.16 0 762.11 665.73)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
              <path transform="matrix(0 -.16 -.16 0 762.11 666.05)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 669.89)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
              <path transform="matrix(0 -.16 -.16 0 760.51 663.97)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 664.13)" d="m5.0615 4.0781c-0.51463 0.63873-1.1455 1.1743-1.8593 1.5784"/>
              <path transform="matrix(0 -.16 -.16 0 761.79 668.77)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
              <path transform="matrix(0 -.16 -.16 0 761.47 663.97)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 5758v-23"/>
              <path transform="matrix(0 -.16 -.16 0 761.47 667.65)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
              <path transform="matrix(0 -.16 -.16 0 761.79 663.01)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 665.89)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 665.89)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950 5932.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950 5927.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950 5929.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4959 5950v1h-19"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938.6 5950h-0.2036"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5950h21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5945h7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4966 5941.3c0.044 0.9556-0.3037 1.8877-0.9644 2.5796-0.6601 0.6919-1.5752 1.0835-2.5317 1.0835"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5928.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5931.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4947 5928.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4947 5931.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.9 5944.6c-1.2012-0.6328-1.9278-1.9033-1.8643-3.2598"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952.7 5946c-0.5048 1.0991-1.541 1.8598-2.7407 2.0122-1.2002 0.1523-2.3935-0.3262-3.1562-1.2647"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948.5 5946.8c-0.2031-0.084-0.3945-0.1943-0.5688-0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4946.8 5942.3c0.7514-0.9238 1.9209-1.4028 3.1045-1.2705s2.2187 0.8574 2.7475 1.9248"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948 5942.5c0.1743-0.1343 0.3657-0.2447 0.5688-0.3287"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5945h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5944 5-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4960.9 5943.8c0.1269 0.4468 0.1269 0.9199 0 1.3662"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4960 5944"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4960 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5946h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5945h-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5943h-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5942h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953.8 5943.6c0.2012 0.5528 0.2012 1.1587 0 1.7115"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5945v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5946v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4954 5946v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5946v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4954 5943h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955.5 5944c0.1973 0.014 0.3677 0.1416 0.436 0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5943h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953.9 5943.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4955 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4956 5945.7c-0.068 0.1855-0.2387 0.3134-0.436 0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5946h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953.9 5946.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5944.2c0.029 0.2182 0.029 0.4389 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952.2 5945.4c-0.2012-0.5528-0.2012-1.1592 0-1.712"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951 5944.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951.6 5942.7c0.5015 1.1485 0.5015 2.4541-5e-4 3.6026"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5946v-3 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948.5 5942.2c0.6113-0.2524 1.2974-0.2524 1.9087 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948 5942h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951 5942.5c0.5244 0.4033 0.8677 0.998 0.9546 1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951 5942 1 2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5943h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953.1 5943.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950.5 5942.2c0.2036 0.084 0.395 0.1944 0.5693 0.3287"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950.5 5946.8c-0.6113 0.2525-1.2979 0.2525-1.9092 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4950 5947h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5944.8c-0.087 0.6558-0.4307 1.2505-0.9551 1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5945-1 1h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4953.1 5946.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4952 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4951 5946.5c-0.1743 0.1343-0.3657 0.2447-0.5688 0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5947h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938.9 5948.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938.1 5948.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5949h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5946h-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5942h-5 4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5940h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940 5951h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.3 5950.2c2.0977-0.2422 4.2163-0.2422 6.314 5e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940 5951h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5946h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5942h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4947 5944.8c-0.029-0.2183-0.029-0.439 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4946.3 5946.6c-0.4194-1.4018-0.4194-2.896 0-4.2978"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4944 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4943 5946v-4h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4947 5944.2c0.087-0.6558 0.4306-1.2505 0.9551-1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4946 5944 1-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4943 5946h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948 5946.5c-0.5245-0.4028-0.8682-0.9975-0.9551-1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4947 5946-1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941.2 5945.7c-0.2188-0.7881-0.2188-1.6211 0-2.4092"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942.8 5943.3c0.2188 0.7886 0.2188 1.6211 0 2.4092"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5942v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938.4 5942.5c0.8642 1.2143 0.8637 2.8432-5e-4 4.0581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5942h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5943h-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5942h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942.8 5941.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941.2 5943.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5942"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5942v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5940v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939.2 5942.9c-0.1425-0.083-0.2348-0.2309-0.247-0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5946h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5947h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5945h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5946h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942.8 5945.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4942 5946v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941.2 5947.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4941 5946v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5950v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938 5948v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4939 5947"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4940 5951v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933 5951v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934.4 5946.5c-0.5136-1.2988-0.5136-2.7442 0-4.043"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.1 5940.1c0.914-0.1011 1.8364-0.1011 2.7505 5e-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4936.9 5940.8c-0.094 0.1265-0.2427 0.2007-0.4004 0.2007s-0.3062-0.074-0.4004-0.2007"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937 5940v1h-1v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 5942.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 5941h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5940"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 5940v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5942v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937 5947h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937.7 5948.7c-0.7354 0.3921-1.6172 0.3921-2.3526 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.5 5948.2c0.6157-0.2564 1.3076-0.2564 1.9233 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937 5947v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5947"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 5950v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4934 5948v-1h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.9 5948.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.1 5948.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935 5947v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933 5951"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4965.6 5947.6c-1.2646 1.5698-3.1865 2.4639-5.2016 2.4204"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4967 5944.9c-0.089 1.1001-0.5063 2.1484-1.1992 3.0078"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4965.5 5930.3c1.2817 4.6987 1.7465 9.5825 1.374 14.438"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4949.5 5916c7.9985 0.4428 14.675 6.2602 16.208 14.123"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.3 5930.1c1.5347-7.8628 8.2115-13.68 16.21-14.122"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4932.1 5944.8c-0.3726-4.8574 0.092-9.7426 1.375-14.442"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4933.2 5948c-0.6929-0.8594-1.1104-1.9077-1.1992-3.0078"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4935.3 5949.2c-0.7138-0.4039-1.3447-0.9395-1.8593-1.5782"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4936 5938.1c-0.2295-4.5176 0.5161-9.0313 2.187-13.235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937.5 5939c-0.7974 0-1.4551-0.6235-1.4981-1.4199"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4937 5939h23"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4962 5937.6c-0.043 0.7964-0.7006 1.4199-1.498 1.4199"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4959.8 5924.9c1.67 4.2026 2.4156 8.7153 2.1861 13.232"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4948.8 5918c4.4571 0.1186 8.5137 2.602 10.646 6.5176"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4938.5 5924.5c2.1328-3.9155 6.1894-6.3984 10.647-6.5166"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871 5932.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871 5927.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871 5929.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4860 5950v1h19"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881.6 5950c-0.068 0-0.1358 5e-4 -0.2036 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5950h-21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5945h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4857.5 5945c-0.9565 0-1.8716-0.3916-2.5317-1.0835-0.6607-0.6919-1.0093-1.6245-0.9644-2.5801"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5928.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5931.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 5928.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4874 5931.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4888 5941.3c0.063 1.356-0.6631 2.6265-1.8643 3.2593"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873.2 5946.7c-0.7627 0.9385-1.956 1.417-3.1562 1.2647-1.1997-0.1524-2.2359-0.9131-2.7408-2.0122"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5946.5c-0.1743 0.1343-0.3657 0.2447-0.5688 0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867.4 5942.9c0.5288-1.0669 1.5639-1.792 2.7475-1.9243 1.1836-0.1319 2.3535 0.3467 3.1045 1.271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871.5 5942.2c0.2036 0.084 0.395 0.1944 0.5693 0.3287"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5945h-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5944-5-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859.1 5945.2c-0.1269-0.4468-0.1269-0.9194 0-1.3662"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859 5944"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5945h1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5943h1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5942h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866.2 5945.4c-0.2012-0.5528-0.2012-1.1592 0-1.712"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5945v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5946v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5946v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5946v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4865 5943h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5944.3c0.068-0.1855 0.2387-0.3135 0.436-0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5943h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866.1 5943.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864 5946h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4864.5 5946c-0.1973-0.014-0.3677-0.1416-0.436-0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866.1 5946.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5944.8c-0.029-0.2183-0.029-0.439 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867.8 5943.6c0.2012 0.5528 0.2012 1.1587 0 1.7115"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5944.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868.4 5946.3c-0.502-1.1485-0.502-2.4541 0-3.6026"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5946v-3 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869.5 5942.2c0.6113-0.2524 1.2979-0.2524 1.9092 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871 5942h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5944.2c0.087-0.6558 0.4306-1.2505 0.9551-1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5942-2 2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5943h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866.9 5943.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5942.5c0.1743-0.1343 0.3657-0.2447 0.5688-0.3287"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4871.5 5946.8c-0.6113 0.2525-1.2979 0.2525-1.9092 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5947h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869 5946.5c-0.5245-0.4028-0.8682-0.9975-0.9551-1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5945 2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4868 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4866.9 5946.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4867 5945"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4869.5 5946.8c-0.2031-0.084-0.3945-0.1943-0.5688-0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5947h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881.9 5948.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881.1 5948.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5949h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5946h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5942h5-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5940h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4879 5951h7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880.3 5950.2c2.0976-0.2422 4.2158-0.2422 6.3134 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4879 5951h7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5942h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 5944.2c0.029 0.2182 0.029 0.4389 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873.7 5942.4c0.4195 1.4018 0.4195 2.8955 0 4.2973"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4875 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4876 5946v-4h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5942.5c0.5244 0.4033 0.8677 0.998 0.9546 1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 5944-1-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4876 5946h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4873 5944.8c-0.087 0.6558-0.4307 1.2505-0.9551 1.6533"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4872 5946 1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878.8 5943.3c0.2188 0.7886 0.2188 1.6211 0 2.4092"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877.2 5945.7c-0.2188-0.7881-0.2188-1.6211 0-2.4092"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4879 5946v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5942v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881.6 5946.5c-0.8647-1.2149-0.8647-2.8438 0-4.0586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5942h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5943h1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5942h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877.2 5943.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5943"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878.8 5941.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5942"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5942v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5940v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5942.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5946h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5947h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5945h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5946h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877.2 5947.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4877 5946v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878.8 5945.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4878 5946v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5946"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5950v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881 5948v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4880 5947"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4879 5951v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886 5951v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885.6 5942.5c0.5132 1.2988 0.5132 2.7441-5e-4 4.0425"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882.1 5940.1c0.9141-0.1011 1.8369-0.1011 2.751 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4883.9 5940.8c-0.094 0.1265-0.2427 0.2007-0.4004 0.2007s-0.3062-0.074-0.4004-0.2007"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 5940v1h1v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886.2 5942.9c-0.1425-0.083-0.2348-0.2309-0.247-0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5941h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5940"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5941"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5940v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5942v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 5947h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884.7 5948.7c-0.7354 0.3921-1.6172 0.3921-2.3526 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882.5 5948.2c0.6152-0.2564 1.3076-0.2564 1.9228 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 5947v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886 5950"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5947"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5950v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885 5948v-1h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885.9 5948.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4885.1 5948.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5947v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886 5951"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859.6 5950c-2.0151 0.044-3.937-0.8506-5.2016-2.4204"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4854.2 5948c-0.6929-0.8594-1.1104-1.9077-1.1992-3.0078"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4853.1 5944.8c-0.3726-4.8574 0.092-9.7426 1.375-14.442"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4854.3 5930.1c1.5347-7.8628 8.2115-13.68 16.21-14.122"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870.5 5916c7.9985 0.4428 14.675 6.2602 16.208 14.123"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886.5 5930.3c1.2817 4.6987 1.7465 9.5825 1.374 14.438"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4888 5944.9c-0.089 1.1001-0.5063 2.1484-1.1992 3.0078"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4886.6 5947.6c-0.5146 0.6387-1.1455 1.1743-1.8594 1.5782"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4881.8 5924.9c1.67 4.2026 2.4156 8.7153 2.1861 13.232"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4884 5937.6c-0.043 0.7964-0.7006 1.4199-1.498 1.4199"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4882 5939h-23"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4859.5 5939c-0.7974 0-1.4551-0.6235-1.4981-1.4199"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4858 5938.1c-0.2295-4.5176 0.5161-9.0313 2.187-13.235"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4860.5 5924.5c2.1328-3.9155 6.1894-6.3984 10.647-6.5166"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4870.8 5918c4.4571 0.1186 8.5137 2.602 10.646 6.5176"/>
              <path transform="matrix(0 -.16 -.16 0 762.43 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 763.23 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 762.75 638.69)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5906h-2v19"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 636.93)" d="m0.06356 6.4997c-0.06792 6.6e-4 -0.13585 2.6e-4 -0.20376-0.0012"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5927v-21"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5910v-7"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 640.77)" d="m0 3.5c-0.9566 0-1.8715-0.39154-2.532-1.0836s-1.0089-1.6242-0.96422-2.5798"/>
              <path transform="matrix(0 -.16 -.16 0 763.07 639.01)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 639.01)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 763.07 638.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 638.21)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 636.45)" d="m3.4962-0.16302c0.06323 1.3561-0.66341 2.6264-1.8644 3.2593"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5927"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m2.7159 2.2076c-0.7629 0.93855-1.9563 1.4167-3.1562 1.2646s-2.2362-0.91301-2.7407-2.0123"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-3.136-1.5541c0.52883-1.0671 1.564-1.7921 2.7476-1.9242 1.1836-0.13217 2.3532 0.34658 3.1044 1.2707"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5910v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5910v-5"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 640.13)" d="m-2.4048 0.68317c-0.12687-0.44661-0.12687-0.91973 0-1.3663"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5905"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5905"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5913v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5912v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5912v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5913v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 639.01)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5910h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5910h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5911h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5912h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5911v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.51 639.65)" d="m-0.4695-0.17196c0.06795-0.18551 0.23876-0.31362 0.43587-0.32691"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5912v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5912"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 639.17)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5910v1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 639.65)" d="m-0.03363 0.49887c-0.19711-0.01329-0.36792-0.1414-0.43587-0.32691"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5912v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.19 639.17)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5912"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 639.49)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.37)" d="m-4.1237 1.8015c-0.50176-1.1486-0.50176-2.4544 0-3.6029"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5913h3l-3 1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-0.95449-2.3106c0.61127-0.25251 1.2977-0.25251 1.909 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5918v-3"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5915-2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5913"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5914"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 639.17)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5913v1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5915v3"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5914-2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5914"/>
              <path transform="matrix(0 -.16 -.16 0 760.19 639.17)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5913"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5913v1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5927v1"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 636.93)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 636.93)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5927v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5926v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5926v5-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5928"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5927v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5925v8"/>
              <path transform="matrix(0 -.16 -.16 0 755.07 636.61)" d="m-3.1569-27.318c2.0976-0.2424 4.2161-0.2424 6.3137 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5925v8"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5923v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5923v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 639.33)" d="m7.1858-2.1482c0.41906 1.4017 0.41898 2.8954-2.1e-4 4.2971"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5921h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5922h4v-4"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5919 2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5922v-4"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.69)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5918 2 1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 638.05)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 636.93)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5923h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5925h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5926h-4"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 636.45)" d="m-2.8517 2.0293c-0.86445-1.2148-0.86445-2.8438 0-4.0586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5926v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5925v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5925v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5923h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 637.41)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5925h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 637.41)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5926h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5927h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5927h-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 637.09)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5926v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5923v2-2"/>
              <path transform="matrix(0 -.16 -.16 0 760.03 637.41)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5923"/>
              <path transform="matrix(0 -.16 -.16 0 760.03 637.41)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5925"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5926"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5926"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5927h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5925 1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5933 1-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 637.09)" d="m5.1152-2.0212c0.51319 1.2988 0.51312 2.7441-1.9e-4 4.0428"/>
              <path transform="matrix(0 -.16 -.16 0 759.23 636.61)" d="m-1.3754-12.424c0.91414-0.1012 1.8367-0.1012 2.7508 0"/>
              <path transform="matrix(0 -.16 -.16 0 760.99 636.61)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5928h-1v2h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 636.13)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 5931"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5931h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5930"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5931h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5928v2"/>
              <path transform="matrix(0 -.16 -.16 0 760.03 636.61)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
              <path transform="matrix(0 -.16 -.16 0 759.55 636.61)" d="m-0.96158-2.3077c0.61541-0.25643 1.3078-0.25643 1.9232 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5928h-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5932"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5931"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5931h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5930v1"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 636.29)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 636.29)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5930h-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5933"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 640.29)" d="m0.1402 6.4985c-2.0154 0.04348-3.937-0.85061-5.2017-2.4204"/>
              <path transform="matrix(0 -.16 -.16 0 760.51 640.61)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 634.69)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
              <path transform="matrix(0 -.16 -.16 0 762.11 638.53)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
              <path transform="matrix(0 -.16 -.16 0 762.11 638.69)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 642.53)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
              <path transform="matrix(0 -.16 -.16 0 760.51 636.61)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 636.93)" d="m5.0615 4.0781c-0.51463 0.63873-1.1455 1.1743-1.8593 1.5784"/>
              <path transform="matrix(0 -.16 -.16 0 761.79 641.57)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
              <path transform="matrix(0 -.16 -.16 0 761.47 636.77)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 5928v-23"/>
              <path transform="matrix(0 -.16 -.16 0 761.47 640.45)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
              <path transform="matrix(0 -.16 -.16 0 761.79 635.65)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 638.53)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 638.69)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
              <path transform="matrix(0 -.16 -.16 0 762.43 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 763.23 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 762.75 653.25)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5814h-2v20"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 651.49)" d="m0.06356 6.4997c-0.06792 6.6e-4 -0.13585 2.6e-4 -0.20376-0.0012"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5836v-22"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5819v-8"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 655.49)" d="m0 3.5c-0.9566 0-1.8715-0.39154-2.532-1.0836s-1.0089-1.6242-0.96422-2.5798"/>
              <path transform="matrix(0 -.16 -.16 0 763.07 653.73)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 653.73)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 763.07 652.93)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 652.93)" d="m0.5 0c0 0.27614-0.22386 0.5-0.5 0.5s-0.5-0.22386-0.5-0.5 0.22386-0.5 0.5-0.5 0.5 0.22386 0.5 0.5"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 651.17)" d="m3.4962-0.16302c0.06323 1.3561-0.66341 2.6264-1.8644 3.2593"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5836"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m2.7159 2.2076c-0.7629 0.93855-1.9563 1.4167-3.1562 1.2646s-2.2362-0.91301-2.7407-2.0123"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m1.5237 1.982c-0.17444 0.1341-0.36582 0.24459-0.56919 0.3286"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-3.136-1.5541c0.52883-1.0671 1.564-1.7921 2.7476-1.9242 1.1836-0.13217 2.3532 0.34658 3.1044 1.2707"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m0.95472-2.3105c0.20335 0.08402 0.39472 0.19453 0.56915 0.32865"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5818v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5818v-5"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 654.85)" d="m-2.4048 0.68317c-0.12687-0.44661-0.12687-0.91973 0-1.3663"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5813"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5813"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5821v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5820v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5820v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5821v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.57)" d="m-2.349 0.85575c-0.20136-0.55273-0.20136-1.1588 0-1.7115"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5818h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5819h-3 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5820h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5819"/>
              <path transform="matrix(0 -.16 -.16 0 760.51 654.21)" d="m-0.4695-0.17196c0.06795-0.18551 0.23876-0.31362 0.43587-0.32691"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5820v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5820"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 653.89)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5819"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 654.21)" d="m-0.03363 0.49887c-0.19711-0.01329-0.36792-0.1414-0.43587-0.32691"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5820v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.19 653.89)" d="m-0.37672 0.32876c-0.16437-0.18835-0.16437-0.46917 0-0.65752"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5820"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-2.4783 0.32861c-0.02892-0.21812-0.02892-0.4391 0-0.65722"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 654.21)" d="m2.3491-0.85553c0.20128 0.55268 0.20125 1.1586-8e-5 1.7113"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m1.5 0c0 0.82843-0.67157 1.5-1.5 1.5s-1.5-0.67157-1.5-1.5 0.67157-1.5 1.5-1.5 1.5 0.67157 1.5 1.5"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.09)" d="m-4.1237 1.8015c-0.50176-1.1486-0.50176-2.4544 0-3.6029"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5822h3-3"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-0.95449-2.3106c0.61127-0.25251 1.2977-0.25251 1.909 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5826v-2"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-2.4783-0.32861c0.08695-0.65573 0.43022-1.2503 0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5823-2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5821"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5822"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 653.89)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5822"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-1.5237-1.982c0.17444-0.1341 0.36582-0.24459 0.56919-0.3286"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m0.95449 2.3106c-0.61127 0.25251-1.2977 0.25251-1.909 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5824v2"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-1.5237 1.982c-0.52441-0.40314-0.86768-0.99768-0.95463-1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4735 5822-2 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5822"/>
              <path transform="matrix(0 -.16 -.16 0 760.19 653.89)" d="m0.37675-0.32872c0.16434 0.18835 0.16433 0.46914-3e-5 0.65748"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5822"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5821"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m-0.95449 2.3106c-0.20337-0.08401-0.39475-0.1945-0.56919-0.3286"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5835v1"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 651.49)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 651.49)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5836v3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5835v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5840v-5 5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5836"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5835v4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5834v7"/>
              <path transform="matrix(0 -.16 -.16 0 755.07 651.33)" d="m-3.1569-27.318c2.0976-0.2424 4.2161-0.2424 6.3137 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5834v7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5831v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5831v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m2.4783-0.32837c0.02889 0.21804 0.02888 0.43894-3e-5 0.65698"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 654.05)" d="m7.1858-2.1482c0.41906 1.4017 0.41898 2.8954-2.1e-4 4.2971"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5827v3h-4 4"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m1.5239-1.9819c0.52437 0.40319 0.86759 0.99776 0.95447 1.6535"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5828 2-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5830v-3"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 653.25)" d="m2.4783 0.32861c-0.08695 0.65573-0.43022 1.2503-0.95463 1.6534"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5827 2 1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 652.61)" d="m4.3358-1.2044c0.21892 0.78813 0.21888 1.621-1.2e-4 2.4091"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 651.49)" d="m-4.3357 1.2048c-0.21904-0.78825-0.21904-1.6213 0-2.4096"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5831h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5833h4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5834h-4"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 651.17)" d="m-2.8517 2.0293c-0.86445-1.2148-0.86445-2.8438 0-4.0586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5834v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5833v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5833v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5832h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 651.97)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4736 5833h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 652.13)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4737 5834 1 1h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5836h-1v-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 651.65)" d="m0.49865 0.03669c-0.0121 0.16452-0.10458 0.31249-0.24717 0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5834v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5832v1-1"/>
              <path transform="matrix(0 -.16 -.16 0 760.03 651.97)" d="m-1.2923 0.76151c-0.27691-0.46992-0.27691-1.0531 0-1.523"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5832"/>
              <path transform="matrix(0 -.16 -.16 0 760.03 652.13)" d="m1.2924-0.76139c0.27683 0.4699 0.2768 1.053-8e-5 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4734 5833"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5834"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5834v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5836h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5835h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5834h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5841h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.35 651.81)" d="m5.1152-2.0212c0.51319 1.2988 0.51312 2.7441-1.9e-4 4.0428"/>
              <path transform="matrix(0 -.16 -.16 0 759.23 651.33)" d="m-1.3754-12.424c0.91414-0.1012 1.8367-0.1012 2.7508 0"/>
              <path transform="matrix(0 -.16 -.16 0 760.99 651.33)" d="m0.40049 0.29935c-0.0944 0.12628-0.24283 0.20065-0.40049 0.20065s-0.30609-0.07437-0.40049-0.20065"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5837h-1v1h1"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 650.85)" d="m-0.25148 0.43216c-0.14259-0.08298-0.23507-0.23095-0.24717-0.39547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4739 5839v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4740 5839h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4738 5840h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5836v2"/>
              <path transform="matrix(0 -.16 -.16 0 760.03 651.33)" d="m1.1764 2.2059c-0.73525 0.39209-1.6175 0.39209-2.3528 0"/>
              <path transform="matrix(0 -.16 -.16 0 759.55 651.33)" d="m-0.96158-2.3077c0.61541-0.25643 1.3078-0.25643 1.9232 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5836h-1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4729 5840"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4733 5840"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4730 5839h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4731 5840h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5839v1"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 651.01)" d="m0.42452 0.26417c-0.09127 0.14666-0.25178 0.23583-0.42452 0.23583s-0.33325-0.08917-0.42452-0.23583"/>
              <path transform="matrix(0 -.16 -.16 0 759.87 651.01)" d="m-0.37112-0.33507c0.0948-0.105 0.22965-0.16493 0.37112-0.16493s0.27632 0.05993 0.37112 0.16493"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4732 5838h-1v1h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4728 5841"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 655.01)" d="m0.1402 6.4985c-2.0154 0.04348-3.937-0.85061-5.2017-2.4204"/>
              <path transform="matrix(0 -.16 -.16 0 760.51 655.17)" d="m-4.2828 3.4507c-0.69252-0.85952-1.1104-1.9075-1.1993-3.0077"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 649.25)" d="m-42.375 3.2524c-0.37281-4.8573 0.09227-9.7426 1.3749-14.442"/>
              <path transform="matrix(0 -.16 -.16 0 762.11 653.09)" d="m-17.176-3.3515c1.5342-7.8626 8.2114-13.68 16.21-14.122"/>
              <path transform="matrix(0 -.16 -.16 0 762.11 653.41)" d="m0.96759-17.473c7.9987 0.44293 14.675 6.2606 16.209 14.123"/>
              <path transform="matrix(0 -.16 -.16 0 760.83 657.25)" d="m41.002-11.186c1.2818 4.6985 1.7466 9.5825 1.3739 14.438"/>
              <path transform="matrix(0 -.16 -.16 0 760.51 651.33)" d="m5.4821 0.44298c-0.0889 1.1002-0.50678 2.1482-1.1993 3.0077"/>
              <path transform="matrix(0 -.16 -.16 0 760.67 651.49)" d="m5.0615 4.0781c-0.51463 0.63873-1.1455 1.1743-1.8593 1.5784"/>
              <path transform="matrix(0 -.16 -.16 0 761.79 656.29)" d="m29.274-11.632c1.6699 4.2026 2.4154 8.7155 2.1857 13.232"/>
              <path transform="matrix(0 -.16 -.16 0 761.47 651.49)" d="M 1.49785,0.08021 C 1.45522,0.87633 0.79726,1.5 0,1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4741 5836v-23"/>
              <path transform="matrix(0 -.16 -.16 0 761.47 655.17)" d="m0 1.5c-0.79726 0-1.4552-0.62367-1.4978-1.4198"/>
              <path transform="matrix(0 -.16 -.16 0 761.79 650.37)" d="m-31.459 1.5999c-0.22974-4.5174 0.5161-9.0313 2.1868-13.235"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 653.25)" d="m-10.977-5.9789c2.1327-3.9156 6.1895-6.3987 10.647-6.5167"/>
              <path transform="matrix(0 -.16 -.16 0 762.59 653.41)" d="m0.33192-12.496c4.4571 0.11839 8.5137 2.6019 10.646 6.5177"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498 7869.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498 7863.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498 7866.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4483 7893v2h26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.6 7893c-0.089 0-0.1777 5e-4 -0.2661 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7893h-28"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7887h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4479.5 7887c-1.23 0-2.4063-0.5034-3.2554-1.3931-0.8491-0.8896-1.2973-2.0884-1.2397-3.3169"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4495 7864.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4495 7868.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7864.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7868.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4520 7882.3c0.081 1.7432-0.853 3.3765-2.397 4.1905"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7893"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7889.3c-0.9805 1.2065-2.5151 1.8213-4.0576 1.626-1.543-0.1959-2.875-1.1739-3.5239-2.5875"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4499.6 7889.3c-0.2441 0.1875-0.5122 0.3423-0.7969 0.46"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493.5 7884.5c0.6801-1.372 2.0112-2.3042 3.5327-2.4741 1.522-0.1699 3.0254 0.4458 3.9912 1.6338"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498.8 7883.3c0.2847 0.1177 0.5528 0.2725 0.7969 0.4605"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7886-7 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7885h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4482.1 7887.5c-0.1777-0.6255-0.1777-1.2876 0-1.913"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4482 7885"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4482 7886"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7888h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7887h2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7884h2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7883h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491.2 7887.7c-0.2817-0.7739-0.2817-1.6225 0-2.3964"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7886v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7887v-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4490 7888v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7888v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4490 7884h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7885.3c0.068-0.1855 0.2387-0.3135 0.436-0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7884h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4492.1 7884.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489 7887 1 1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4489.5 7887c-0.1973-0.014-0.3677-0.1416-0.436-0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7888h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4492.1 7888.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4491 7887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494 7887c-0.041-0.3052-0.041-0.6148 0-0.92"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493.8 7885.3c0.2817 0.7739 0.2817 1.622 0 2.3959"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4499 7886.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494.5 7888.7c-0.6133-1.4039-0.6133-2.9996 0-4.4034"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7888v-4 4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4496.2 7883.3c0.8559-0.3535 1.8169-0.3535 2.6728 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498 7882h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494 7886c0.1216-0.9179 0.6025-1.7505 1.3364-2.3149"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4495 7883-2 2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7884h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494 7883"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4492.9 7884.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7884"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4495.4 7883.7c0.2441-0.1875 0.5122-0.3423 0.7969-0.46"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4498.8 7889.7c-0.8559 0.3535-1.8169 0.3535-2.6728 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4496 7889h2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4495.4 7889.3c-0.7339-0.5645-1.2148-1.397-1.3364-2.3149"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7886 2 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4494 7888h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4492.9 7888.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4493 7887v1-1 1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4496.2 7889.7c-0.2847-0.1177-0.5528-0.2725-0.7969-0.46"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7890h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.9 7891.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.1 7890.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7891h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7888h7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7883h7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7882h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4512 7880"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7880h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4509 7894h9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4509.4 7894.2c2.708-0.313 5.4424-0.313 8.1504 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4509 7895h9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7888h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7883h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7886c0.041 0.3057 0.041 0.6148 0 0.92"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4500.6 7883.8c0.5307 1.7759 0.5307 3.6675-5e-4 5.4434"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4500 7883h4v5-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4499.6 7883.7c0.7344 0.5644 1.2148 1.3965 1.3364 2.3144"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7885-2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4504 7888h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4501 7887c-0.1216 0.9179-0.6025 1.7504-1.3364 2.3149"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4499 7889 2-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4507.8 7885c0.2676 0.9634 0.2676 1.9815 0 2.9449"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506.2 7888c-0.2676-0.9634-0.2676-1.982 0-2.9454"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7888v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4508 7888v-5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7883v5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.8 7889.1c-1.1113-1.5615-1.1113-3.6563 0-5.2178"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7883h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7884h2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4508 7882h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7884"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506.2 7884.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4508 7884"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4507.8 7882.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7883"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7882v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7881"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7880v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7882.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7888h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4508 7889h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7887h2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506.2 7889.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4506 7887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4507.8 7887.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4508 7887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4509 7893"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7888"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511 7893v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4510 7889"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4509 7895v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4518 7894v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516.5 7883.7c0.6997 1.7715 0.6997 3.7422 0 5.5132"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.7 7879.1c1.2065-0.1333 2.4243-0.1333 3.6308 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4514.7 7881.4c-0.2832 0.379-0.7286 0.6021-1.2017 0.6021s-0.9185-0.2231-1.2017-0.6021"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4513 7880v1h1v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4517.2 7882.9c-0.1425-0.083-0.2348-0.2309-0.247-0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7881h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 7880"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 7881"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7880v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 7882v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4512 7890h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4514.7 7890.7c-0.7354 0.3921-1.6172 0.3921-2.3526 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4512.2 7890.3c0.8613-0.3588 1.8311-0.3588 2.6924 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4512 7890v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4517 7893"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 7889"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7893v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516 7891v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7890h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516.9 7891.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4516.1 7890.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7890v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4518 7895v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4483.7 7893c-2.6353 0.057-5.1479-1.1123-6.8022-3.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4476.4 7889.6c-0.8184-1.0156-1.3125-2.2544-1.4175-3.5547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4475.2 7886.7c-0.4781-6.229 0.1186-12.494 1.7631-18.52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4476.4 7867.2c1.9727-10.109 10.558-17.588 20.842-18.157"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4497.7 7849c10.284 0.5698 18.868 8.0493 20.84 18.159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4518.1 7868.2c1.6436 6.0249 2.2398 12.288 1.7617 18.515"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4520 7886c-0.105 1.3003-0.5991 2.5391-1.4175 3.5547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4518.1 7889.8c-0.6733 0.835-1.498 1.5356-2.4316 2.064"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4511.1 7860.5c2.147 5.4033 3.1055 11.206 2.81 17.013"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4515 7877.6c-0.071 1.3266-1.168 2.3662-2.4966 2.3662"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4512 7879h-30"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4482.5 7880c-1.3286 0-2.4253-1.0396-2.4966-2.3662"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4481.1 7877.6c-0.2955-5.8081 0.6635-11.612 2.8115-17.016"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4484 7860.6c2.8154-5.1685 8.1704-8.4463 14.054-8.602"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4497.9 7852c5.8833 0.1562 11.238 3.4345 14.053 8.6035"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4572 7870.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4572 7863.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4572 7867.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4557 7893v3h26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.6 7894c-0.089 0-0.1777 5e-4 -0.2661 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7893h-28"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7887h-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4553.5 7888c-1.23 0-2.4063-0.5034-3.2554-1.3931-0.8491-0.8896-1.2973-2.0884-1.2397-3.3169"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4569 7865.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4569 7868.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4576 7865.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4576 7868.5c0 0.2764-0.2236 0.5-0.5 0.5s-0.5-0.2236-0.5-0.5 0.2236-0.5 0.5-0.5 0.5 0.2236 0.5 0.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4594 7883.3c0.081 1.7432-0.853 3.3765-2.397 4.1905"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7893"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4575 7889.3c-0.9805 1.2065-2.5151 1.8213-4.0576 1.626-1.543-0.1959-2.875-1.1739-3.5239-2.5875"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4573.6 7889.3c-0.2441 0.1875-0.5122 0.3423-0.7969 0.46"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567.5 7884.5c0.6801-1.372 2.0112-2.3042 3.5327-2.4741 1.522-0.1699 3.0254 0.4458 3.9912 1.6338"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4572.8 7883.3c0.2847 0.1177 0.5528 0.2725 0.7969 0.4605"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7887h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7885h-7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4556.1 7887.5c-0.1777-0.6255-0.1777-1.2876 0-1.913"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4556 7885"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4556 7887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7889h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7888h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7887h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7885h2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7884h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4566.2 7887.7c-0.2817-0.7739-0.2817-1.6225 0-2.3964"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7887v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7888v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4564 7888v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7888v-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4564 7884h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7886.3c0.068-0.1855 0.2387-0.3135 0.436-0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7884h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7885"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4566.1 7884.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563 7888h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4563.5 7888c-0.1973-0.014-0.3677-0.1416-0.436-0.3271"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7888h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4566.1 7888.8c-0.164-0.188-0.164-0.4692 0-0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4565 7888v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4568 7887c-0.041-0.3052-0.041-0.6148 0-0.92"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567.8 7885.3c0.2817 0.7739 0.2817 1.622 0 2.3959"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4573 7886.5c0 0.8286-0.6714 1.5-1.5 1.5s-1.5-0.6714-1.5-1.5 0.6714-1.5 1.5-1.5 1.5 0.6714 1.5 1.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4568.5 7888.7c-0.6133-1.4039-0.6133-2.9996 0-4.4034"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7888v-4 4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4570.2 7883.3c0.8559-0.3535 1.8169-0.3535 2.6728 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4573 7883h-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4568 7886c0.1216-0.9179 0.6025-1.7505 1.3364-2.3149"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4569 7883-2 3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7885"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4568 7884h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4566.9 7884.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7884"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4569.4 7883.7c0.2441-0.1875 0.5122-0.3423 0.7969-0.46"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4572.8 7889.7c-0.8559 0.3535-1.8169 0.3535-2.6728 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4570 7890h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4569.4 7889.3c-0.7339-0.5645-1.2148-1.397-1.3364-2.3149"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7887 2 2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4568 7888h-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4566.9 7888.2c0.1641 0.1885 0.1641 0.4692 0 0.6572"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4567 7887v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4570.2 7889.7c-0.2847-0.1177-0.5528-0.2725-0.7969-0.46"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7890h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.9 7891.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.1 7891.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7892h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7889h7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7883h7"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7883h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4586 7880"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7880h5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583 7895h9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583.4 7894.2c2.708-0.313 5.4424-0.313 8.1504 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583 7896h9"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7888h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7884h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4575 7886c0.041 0.3057 0.041 0.6148 0 0.92"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4574.6 7883.8c0.5307 1.7759 0.5307 3.6675-5e-4 5.4434"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4574 7883h4v6-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4573.6 7883.7c0.7344 0.5644 1.2148 1.3965 1.3364 2.3144"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4575 7886-2-3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4578 7889h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4575 7887c-0.1216 0.9179-0.6025 1.7504-1.3364 2.3149"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4573 7889 2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4581.8 7885c0.2676 0.9634 0.2676 1.9815 0 2.9449"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580.2 7888c-0.2676-0.9634-0.2676-1.982 0-2.9454"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7889v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7889v-6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7883v6"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.8 7889.1c-1.1113-1.5615-1.1113-3.6563 0-5.2178"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7883h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7884h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7885h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7883h-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7885v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580.2 7884.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7885v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4581.8 7882.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7883"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7883v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7880v1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7883.5c-0.012 0.1646-0.1045 0.3125-0.247 0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7889h-4"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7888h2-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580.2 7890.3c-0.2768-0.4702-0.2768-1.0532 0-1.5234"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4580 7888"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4581.8 7888.7c0.2768 0.4697 0.2768 1.0527 0 1.5229"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4582 7888"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583 7894"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7889"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7893v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585 7891v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4584 7889"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4583 7896v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592 7895v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590.5 7883.7c0.6997 1.7715 0.6997 3.7422 0 5.5132"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.7 7880.1c1.2065-0.1333 2.4243-0.1333 3.6308 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4588.7 7882.4c-0.2832 0.379-0.7286 0.6021-1.2017 0.6021s-0.9185-0.2231-1.2017-0.6021"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4587 7880v1h1v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4591.2 7883.9c-0.1425-0.083-0.2348-0.2309-0.247-0.3955"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4589 7881h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590 7880"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4589 7881v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590 7883v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4586 7890h3"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4588.7 7891.7c-0.7354 0.3921-1.6172 0.3921-2.3526 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4586.2 7890.3c0.8613-0.3588 1.8311-0.3588 2.6924 0"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4586 7890v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592 7894"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4591 7889"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590 7893v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590 7891v-2"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4589 7890h1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590.9 7891.8c-0.091 0.1464-0.2515 0.2358-0.4243 0.2358-0.1729 0-0.333-0.089-0.4243-0.2358"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4590.1 7891.2c0.095-0.1049 0.2295-0.165 0.3711-0.165s0.2764 0.06 0.3711 0.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4589 7890v1-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592 7896v-1"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4557.7 7894c-2.6353 0.057-5.1479-1.1123-6.8022-3.165"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4551.4 7890.6c-0.8184-1.0156-1.3125-2.2544-1.4175-3.5547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4549.2 7886.7c-0.4781-6.229 0.1186-12.494 1.7631-18.52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4550.4 7868.2c1.9727-10.109 10.558-17.588 20.842-18.157"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4571.7 7850c10.284 0.5698 18.868 8.0493 20.84 18.159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592.1 7868.2c1.6436 6.0249 2.2398 12.288 1.7617 18.515"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4594 7887c-0.105 1.3003-0.5991 2.5391-1.4175 3.5547"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4592.1 7890.8c-0.6733 0.835-1.498 1.5356-2.4316 2.064"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4585.1 7860.5c2.147 5.4033 3.1055 11.206 2.81 17.013"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4589 7877.6c-0.071 1.3266-1.168 2.3662-2.4966 2.3662"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4586 7879h-30"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4556.5 7880c-1.3286 0-2.4253-1.0396-2.4966-2.3662"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4555.1 7877.6c-0.2955-5.8081 0.6635-11.612 2.8115-17.016"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4558 7860.6c2.8154-5.1685 8.1704-8.4463 14.054-8.602"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4571.9 7852c5.8833 0.1562 11.238 3.4345 14.053 8.6035"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" stroke="#989898" stroke-linecap="round" stroke-miterlimit="10">
              <g fill="none" stroke-linejoin="round" stroke-width="3">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5458h-25v-26h25v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5971h-25v-26h25v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 3183h-25v-26h25v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 3670h-25v-26h25v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 4157h-25v-26h25v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 4680h-25v-25h25v25"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 6604h-25v-26h25v26"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 7378h-25v-26h25v26"/>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5106 7352h25l-25 26zm25 0-25 26h25z" fill="#989898"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" stroke="#dbdbdb" stroke-linecap="round" stroke-miterlimit="10">
              <g fill="none" stroke-linejoin="round">
              <g>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781v187"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 7599v-103 103"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8159v130-130"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8289h197-197"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8289v-130 130"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8159h-197 197"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8159"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8289"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3054 8159"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8289"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3251 8159"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 6335h-214"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 6210h-214"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5945h7v-315h-7 7v315h-7"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5630v315-315"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5945"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5630"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5630"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5945"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5630"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5124 5945"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5945"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5131 5630"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1379v22h-21"/>
              </g>
              <g stroke-width="2">
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4861 3164v-237l267-266"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4719 5007v-1202"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4719 5049v1203"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4719 6293v581"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 2255-42 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 2296-42-41"/>
                <path transform="matrix(0 -.16 -.16 0 580.35 1221.3)" d="m20.5 0c0 11.322-9.1782 20.5-20.5 20.5s-20.5-9.1782-20.5-20.5 9.1782-20.5 20.5-20.5 20.5 9.1782 20.5 20.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938v-51h83v51h-83 83v-51h-83v51"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1887"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1887"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1631"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1631"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401v-41h42v41h-42 42v-41h-42v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401v-41h42v41h-42 42v-41h-42v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672v-41h42v41h-42 42v-41h-42v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1631"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1631"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401v-41h42v41h-42 42v-41h-42v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401"/>
                <path transform="matrix(0 .16 .16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(0 -.16 -.16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1354"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1405"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3082 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
                <path transform="matrix(0 .16 .16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(0 -.16 -.16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1354"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1405"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3290 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
                <path transform="matrix(0 .16 .16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(0 -.16 -.16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1354"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1405"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938v-51h83v51h-83 83v-51h-83v51"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1887"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1887"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 1938v571"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2509"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2509"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3136"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3136"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3758"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3758"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4380"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4380"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5002"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5002"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5624"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5624"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6246"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6246"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920v-51h83v51h-83 83v-51h-83v51"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6869"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6869"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542v-51h83v51h-83 83v-51h-83v51"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7491"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7491"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558h-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740h-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118h-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159h41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2509"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2509"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3136"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3136"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3758"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3758"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4380"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4380"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5002"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5002"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5624"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5624"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298v-52h83v52h-83 83v-52h-83v52"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6246"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6246"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920v-51h83v51h-83 83v-51h-83v51"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6869"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6869"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542v-51h83v51h-83 83v-51h-83v51"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7491"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7491"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740h-42 42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42-42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118h-42 42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42-42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558h-42 42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599h42-42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740h-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740h-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740h-42 42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42-42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740h-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740h-42 42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42-42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740h-42 42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42-42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740h-42 42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42-42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740h-42 42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42-42"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781v-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740h-41 41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740v41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41-41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938v-51h83v51h-83 83v-51h-83v51"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1887"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1887"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1631"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1631"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401v-41h42v41h-42 42v-41h-42v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401v-41h42v41h-42 42v-41h-42v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401v-41h41v41h-41 41v-41h-41v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672v-41h42v41h-42 42v-41h-42v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1631"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1631"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401v-41h42v41h-42 42v-41h-42v41"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1360"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401"/>
                <path transform="matrix(0 .16 .16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(0 -.16 -.16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1354"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1405"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3082 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
                <path transform="matrix(0 .16 .16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(0 -.16 -.16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1354"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1405"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3290 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
                <path transform="matrix(0 .16 .16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(0 -.16 -.16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1354"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1405"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938v-51h83v51h-83 83v-51h-83v51"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1887"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1887"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938"/>
                <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379h-52"/>
              </g>
              </g>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3084 1379h37l-37 47zm37 0-37 47h37z" fill="#dbdbdb"/>
              <g fill="none" stroke-linejoin="round" stroke-width="2">
              <path transform="matrix(0 .16 .16 0 627.07 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(0 -.16 -.16 0 627.07 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 940"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 966"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 992"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 966"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 966"/>
              <path transform="matrix(0 .16 .16 0 533.63 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(0 -.16 -.16 0 533.63 1430.7)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3318 940"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3343 966"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3318 992"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3292 966"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3343 966"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1418 1375h-109v11h109v-11 11h-109v-11h109"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1418 1386"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1418 1375"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1418 1386"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1386"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1375"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672h-10 10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672v109-109"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781h10-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1781v-109 109"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777h-10 10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777v110-110"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887h10-10"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887v-110 110"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1777"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6197 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6207 1887"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#989898" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1439 1933v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1439 2555v586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2535h360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 2535h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8139h381"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 7599v519"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 8159v581"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1861 1401v491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1381h586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2488 2255v-322"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1381h380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8139h586"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8139h519"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8139h585"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#dbdbdb" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 6272v628"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1018 5651h843"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
              <path transform="matrix(0 -.16 -.16 0 173.79 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5" stroke-width="2"/>
              <path transform="matrix(0 -.16 -.16 0 130.43 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5" stroke-width="2"/>
              <g stroke-width="4">
              <path transform="matrix(0 -.16 -.16 0 986.91 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
              <path transform="matrix(0 -.16 -.16 0 986.91 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
              <path transform="matrix(0 -.16 -.16 0 1030.3 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
              </g>
              <path transform="matrix(0 .16 .16 0 130.43 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5" stroke-width="2"/>
              <path d="m204 1124.3c-1.6348 0-2.96 1.3252-2.96 2.96s1.3252 2.96 2.96 2.96 2.96-1.3252 2.96-2.96-1.3252-2.96-2.96-2.96" stroke-width=".32"/>
              <g stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m798 1413"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m816 1432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m798 1450"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m780 1432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m816 1432"/>
              <path transform="matrix(0 .16 .16 0 173.79 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
              <path transform="matrix(0 -.16 -.16 0 173.79 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1069 1143"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1087 1161"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1069 1179"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1051 1161"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1087 1161"/>
              <path transform="matrix(0 .16 .16 0 986.91 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
              <path transform="matrix(0 -.16 -.16 0 986.91 1399.5)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6151 1143"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6169 1161"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6151 1179"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6133 1161"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6169 1161"/>
              <path transform="matrix(0 .16 .16 0 1030.3 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
              <path transform="matrix(0 -.16 -.16 0 1030.3 1356.1)" d="m18.5 0c0 10.217-8.2827 18.5-18.5 18.5s-18.5-8.2827-18.5-18.5 8.2827-18.5 18.5-18.5 18.5 8.2827 18.5 18.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6422 1413"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6440 1432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6422 1450"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6404 1432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6440 1432"/>
              </g>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#dbdbdb" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781"/>
            </g>
            <g transform="matrix(1.0677 0 0 1.1189 -41.037 -88.366)" fill="none" stroke="#dbdbdb" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1631"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1631"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401v-41h42v41h-42 42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401v-41h42v41h-42 42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672v-41h42v41h-42 42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1631"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1631"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401v-41h42v41h-42 42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401"/>
              <path transform="matrix(0 .16 .16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(0 -.16 -.16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1354"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1405"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3082 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
              <path transform="matrix(0 .16 .16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(0 -.16 -.16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1354"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1405"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3290 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
              <path transform="matrix(0 .16 .16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(0 -.16 -.16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1354"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1405"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1631"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1631"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1309 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1268 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401v-41h42v41h-42 42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401v-41h42v41h-42 42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401v-41h41v41h-41 41v-41h-41v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5952 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5911 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672v-41h42v41h-42 42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1631"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1631"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 1672"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401v-41h42v41h-42 42v-41h-42v41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 1401"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1360"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 1401"/>
              <path transform="matrix(0 .16 .16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(0 -.16 -.16 0 500.03 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1354"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3108 1405"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3082 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3134 1379"/>
              <path transform="matrix(0 .16 .16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(0 -.16 -.16 0 533.15 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1354"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3315 1405"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3290 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3341 1379"/>
              <path transform="matrix(0 .16 .16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(0 -.16 -.16 0 627.07 1364.6)" d="m25.5 0c0 14.083-11.417 25.5-25.5 25.5s-25.5-11.417-25.5-25.5 11.417-25.5 25.5-25.5 25.5 11.417 25.5 25.5"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1354"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3902 1405"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3876 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3928 1379"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1887"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 1938"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6244 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6161 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6223 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m6181 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2509"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 2561"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3136"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3188"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3758"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 3810"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4380"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 4432"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5002"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5054"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5624"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 5676"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298v-52h83v52h-83 83v-52h-83v52"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6246"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6298"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6869"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 6920"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542v-51h83v51h-83 83v-51h-83v51"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1059 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7491"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m976 7542"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8118"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 8159"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1038 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7558"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m997 7599"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1460 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1419 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1881 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m1840 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2509 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m2467 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3069 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3028 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3631 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m3589 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4191 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4149 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4753 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m4711 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740h-42 42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781h42-42"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5380 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5338 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781v-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740h-41 41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740v41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781h41-41"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5801 8781"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8740"/>
              <path transform="matrix(.16 0 0 -.16 2.6667 1585.3)" d="m5760 8781"/>
            </g>
            
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                    // Determine tooltip text based on stall status
                    $tooltipText = $row['stall_status'] == 'Occupied' ? 'Occupied by ' . htmlspecialchars($row['first_name']) : 'Vacant';
                ?>
                <a
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip"
                    data-bs-title="<?php echo htmlspecialchars($tooltipText); ?>"
                    data-stall-id="<?php echo htmlspecialchars($row['stall_no']); ?>"
                >
                <g>
              <path d="m792.02 1121.7 2.9701 41.581 43.561 45.541-2.9701-91.082z" style="opacity:0"/>
              <path d="m873.2 1118.7 4.9501 113.85 68.312-0.99 2.9701-111.87z" style="opacity:0"/>
              <path d="m878.15 1229.6v53.461l70.292 61.382 1.98-112.86z" style="opacity:0"/>
              <path d="m951.41 230.68v105.93l70.292-0.99003 1.9801-105.93z" style="opacity:0"/>
              <path d="m946.46 337.6 4.9501 106.92 66.332 1.98 1.9801-108.9z" style="opacity:0"/>
              <path d="m952.4 451.45 1.98 109.89h72.272l-0.9901-109.89z" style="opacity:0"/>
              <path d="m951.41 565.3 1.98 105.93h68.312l-1.98-111.87z" style="opacity:0"/>
              <path d="m952.4 787.07-1.98 106.92 69.302 1.98-0.99-114.84z" style="opacity:0"/>
              <path d="m951.41 896.96-1.98 110.88 73.262 1.98-0.9901-113.85z" style="opacity:0"/>
              <path d="m951.41 1007.8-0.99003 110.88 70.292 0.99v-112.86z" style="opacity:0"/>
              <path d="m950.42 1117.7v119.79s70.292 0.99 71.282-3.9601c0.9901-4.9502 0.9901-115.83 0.9901-115.83z" style="opacity:0"/>
              <path d="m950.42 1231.6-0.99002 108.9 74.252 0.99-2.9701-107.91z" style="opacity:0"/>
              <path d="m717.27 1163.8 0.49501 69.302 93.062 2.97-67.817-71.777z" style="opacity:0"/>
              <path d="m664.31 1164.3 1.485 71.282 49.996-0.495 0.49501-73.262-49.996 2.475z" style="opacity:0"/>
              <path d="m439.57 1165.8 1.485 68.312 69.302 1.98v-73.757z" style="opacity:0"/>
              <path d="m347 1236.5 67.817-72.272 24.751-1.485 1.485 71.282z" style="opacity:0"/>
              <path d="m279.68 1340v23.761l106.92 0.495 0.49501-87.617-41.581 0.495z" style="opacity:0"/>
              <path d="m386.6 1275.6 0.49501 66.827 106.43 0.495 0.99003-67.322z" style="opacity:0"/>
              <path d="m664.31 1277.6v64.352l104.45 0.99 0.49502-64.847z" style="opacity:0"/>
              <path d="m769.74 1279.6 3.4651 80.192 101.97 3.465 0.99002-23.761-66.827-61.876z" style="opacity:0"/>
              <path d="m877.16 1340.5 0.99002 99.002 67.817-0.9901s3.9601-33.166 1.98-35.146c-1.98-1.9801-68.312-62.372-68.312-62.372z" style="opacity:0"/><path d="m773.7 1365.7-0.49501 73.757 102.96-0.9901 1.98-74.747z" style="opacity:0"/>
                <path d="m665.79 1348.9v87.617l101.97 2.9701 1.485-91.577z" style="opacity:0"/>
                <path d="m385.61 1342 0.49502 98.508 106.43-4.9501v-95.042z" style="opacity:0"/>
                <path d="m280.18 1364.3v75.242h108.9l-2.4751-74.747z" style="opacity:0"/>
                <path d="m208.4 1400.9-0.49501 37.621h71.282v-96.527z" style="opacity:0"/>
            
            </g>


                </a>
              <?php endwhile; ?>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="68">
              
            <g>
              <path d="m792.02 1121.7 2.9701 41.581 43.561 45.541-2.9701-91.082z" style="opacity:0"/>
            </g>
            </a>

            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="67">
            <g>
              <path d="m770.24 1034.6v86.132l64.352-1.98-0.99002-89.102z" style="opacity:0"/>
            </g>
  </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="66">
            <g>
              <path d="m771.23 946.46 2.9701 82.172s60.392 8.9102 62.372 0 0-87.122 0-87.122z" style="opacity:0"/>
            </g>
  </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="65">
            <g>
              <path d="m612.83 269.29 5.9402 68.312s98.012 1.98 99.002-1.98c0.99003-3.9601-0.99002-66.332-0.99002-66.332z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="64">
            <g>
              
              <path d="m533.62 268.3v67.322l84.152 1.98-1.98-65.342z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="63">
            <g>
              <path d="m433.63 269.29 2.9701 67.322 95.042 4.9501-2.9701-73.262z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="62">
            <g>
              <path d="m324.73 949.43-2.9701 75.242 66.332 1.9801-5.9402-82.172z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="61">
            <g>
              <path d="m316.81 1033.6 2.9701 83.162 65.342 1.9801 3.9601-88.112z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="60">
            <g>
              <path d="m314.83 1117.7 5.9402 87.122 34.651-35.641 1.98-52.471z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="59">
            <g>
              <path d="m209.89 1232.6-0.99003 108.9 72.272-63.362 1.98-44.551-68.312 0.99z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="58">
            <g>
              <path d="m210.88 1123.7v105.93l68.312-0.9901-3.9601-105.93z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="57">
            <g>
              <path d="m213.85 1015.8c-1.98-3.9601-1.98 101.97-1.98 101.97h75.242l-1.98-107.91z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="56">
            <g>
              <path d="m213.85 895.97-1.98 109.89s63.362 5.9402 64.352 1.9801c0.99002-3.9601 8.9102-110.88 2.9701-110.88s-65.342-0.99002-65.342-0.99002z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="55">
            <g>
              <path d="m202.96 785.09 2.9701 114.84 76.232-2.9701-2.9701-113.85z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="54">
            <g>
              <path d="m206.92 565.3 2.9701 104.94 69.302 1.98 0.99003-105.93z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="53">
            <g>
              <path d="m209.89 455.41-1.98 104.94h70.292l0.99002-106.92z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="52">
            <g>
              <path d="m207.91 345.52 0.99002 99.993s72.272 12.87 72.272 3.9601c0-8.9102-2.9701-108.9-2.9701-108.9z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="51">
            <g>
              <path d="m207.91 228.7 0.99002 107.91s72.272 24.751 69.302 0c-2.9701-24.751-2.9701-106.92-2.9701-106.92z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="50">
            <g>
              <path d="m129.69 1231.6 2.9701 109.89s77.222 7.9202 77.222 3.9601-1.98-111.87-1.98-111.87z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="49">
            <g>
              
              <path d="m133.65 1120.7 0.99002 111.87 72.272 0.9901 4.9501-112.86z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="48">
            <g>
              <path d="m133.65 1006.9 1.98 112.86 73.262 1.9801-1.98-110.88z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="47">
            <g>
              <path d="m134.64 896.96v111.87l71.282-0.99 3.9601-110.88z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="46">
            <g>
              <path d="m130.68 785.09 2.9701 116.82s71.282 0.99002 72.272-3.9601c0.99002-4.9501 2.9701-109.89 2.9701-109.89z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="45">
            <g>
              <path d="m135.63 565.3-0.99003 104.94 75.242 3.9601-0.99003-112.86z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="44">
            <g>
              <path d="m133.65 454.42v109.89l75.242-1.98 0.99003-107.91z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="43">
            <g>
              <path d="m134.64 342.55 0.99003 106.92 75.242 1.98v-108.9z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="42">
            <g>
              <path d="m131.67 228.7 4.9501 108.9 66.332 0.99003 4.9501-112.86z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="41">
            <g>
              <path d="m134.64 119.79v108.9l71.282-0.99002-0.99003-105.93z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="40">
            <g>
              
              <path d="m205.93 113.85 2.9701 113.85s74.252 3.9601 74.252 0-2.9701-108.9-2.9701-108.9z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="39">
            <g>
              <path d="m333.64 113.85-2.9701 69.302 43.561 39.601 27.721 4.9501 4.9501-102.96z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="38">
            <g>
              <path d="m407.89 123.75 3.9601 100.98 69.302 2.9701 3.9601-111.87z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="37">
            <g>
              <path d="m519.76 117.81 0.99003 106.92s71.282 8.9102 74.252 3.9601c2.9701-4.9501 0.99002-108.9 0.99002-108.9z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="36">
            <g>
              <path d="m649.46 115.83 7.9202 107.91 83.162 0.99002 0.99003-109.89z" style="opacity:0"/>
            </g>
            </a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="35">
            <g>
              <path d="m740.54 120.78-1.98 104.94 47.521 1.98s36.631-17.82 37.621-39.601c0.99002-21.781-0.99003-73.262-0.99003-73.262z" style="opacity:0"/>
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="34">
            <g>
              <path d="m881.12 116.82v110.88h66.332v-109.89z" style="opacity:0"/>
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="33">
            <g>
              <path d="m951.41 112.86 0.99002 117.81 71.282-2.9701-1.9801-108.9z" style="opacity:0"/>
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="32">
            <g>
              <path d="m876.17 228.7 0.99003 101.97 69.302 0.99002 5.9402-101.97h-70.292z" style="opacity:0"/>
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="31">
            <g>
              <path d="m878.15 337.6-3.9601 113.85 78.212-1.98-0.99002-109.89z" style="opacity:0"/>
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="30">
            <g>
              <path d="m873.2 453.43 0.99002 105.93 76.232 2.9701-1.98-111.87z" style="opacity:0"/>
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="29">
            <g>
              <path d="m878.15 564.31 0.99003 104.94 65.342 4.9501 3.9601-109.89z" style="opacity:0"/>
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="28">
            <g>
              <path d="m878.15 785.09-0.99002 112.86 72.272-0.99003-1.98-112.86z" style="opacity:0"/>
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="27">
            <g>
              <path d="m876.17 893.99 2.9701 110.88 70.292 1.9801v-111.87z" style="opacity:0"/>
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="26">
            <g>
              <path d="m876.17 1003.9v113.85l72.272-0.9901-1.98-108.9z" style="opacity:0"/>
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="25">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="24">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="23">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="22">
            <g>
              
            </g></a>

            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="21"><g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="20">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="19">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="18">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="17">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="16">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="15">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="14">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="13">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="12">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="11">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="10">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="9">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="8">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="7">
            <g>
              
            </g></a>
            <a data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-custom-class="custom-tooltip"
              data-bs-title=" Vendor Name Here "
              data-stall-id="6">
            <g>
              
            </g></a>
              <a data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-custom-class="custom-tooltip"
                data-bs-title=" Vendor Name Here "
                data-stall-id="5">
              <g>
                
              </g></a>
              <a data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-custom-class="custom-tooltip"
                data-bs-title=" Vendor Name Here "
                data-stall-id="4">
              <g>
                
              </g></a>
              
              <a data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-custom-class="custom-tooltip"
                data-bs-title=" Vendor Name Here "
                data-stall-id="3">
              <g>
                
              </g></a>
              <a data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-custom-class="custom-tooltip"
                data-bs-title=" Vendor Name Here "
                data-stall-id="2">
              <g>
                
              </g>
              </a>
              <a data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-custom-class="custom-tooltip"
                data-bs-title=" Vendor Name Here "
                data-stall-id="1">
              <g>
                
              </g>
              </a>
            </svg>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script>
        // Initialize Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
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