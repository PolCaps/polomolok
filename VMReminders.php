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
$vendor_id = isset($_SESSION['vendor_id']) ? $_SESSION['vendor_id'] : 0;

// Include database configuration
include('database_config.php');

// Create a connection


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

// Check if vendor data is retrieved
if (!$vendor) {
    die("No vendor found with ID " . htmlspecialchars($vendor_id));
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
        REMINDERS
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.expandable-image').on('click', function () {
                var imgSrc = $(this).attr('src');
                $('#expandedImage').attr('src', imgSrc);
                $('#imageModal').modal('show');
            });
        });
    </script>

    <script>
        "use strict";

        !function () {
            var t = window.driftt = window.drift = window.driftt || [];
            if (!t.init) {
                if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
                t.invoked = !0, t.methods = ["identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on"],
                    t.factory = function (e) {
                        return function () {
                            var n = Array.prototype.slice.call(arguments);
                            return n.unshift(e), t.push(n), t;
                        };
                    }, t.methods.forEach(function (e) {
                        t[e] = t.factory(e);
                    }), t.load = function (t) {
                        var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
                        o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
                        var i = document.getElementsByTagName("script")[0];
                        i.parentNode.insertBefore(o, i);
                    };
            }
        }();
        drift.SNIPPET_VERSION = '0.3.1';
        drift.load('93ian234iumi');
    </script>
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
          <a class="nav-link active " href="VMReminders.php">
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
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="javascript:;">Vendor</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Module</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Reminders</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
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
    <div class="row my-4">
        <div class="col-lg-11 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h6 class="text-center">
                            <span class="text-info text-center">Message Reminders</span>
                        </h6>
                    </div>
                </div>



                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Stall</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                            Message</th>
                            
                        </tr>
                        </thead>
                        <tbody id="dataTableBody">
                        <?php
                        
                        include('database_config.php');

                        // Create a connection
                        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                        // Check the connection
                        if ($conn->connect_error) {
                            echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
                            exit;
                        }

                        // Get the vendor_id from session
                        if (isset($_SESSION['vendor_id'])) {
                            $vendor_id = intval($_SESSION['vendor_id']); // Ensure vendor_id is an integer
                        } else {
                            echo "<tr><td colspan='3' class='text-center'>Vendor ID not found in session</td></tr>";
                            exit;
                        }

                        // Query to join vendorsoa and building tables to get stall_no and message
                        $query = "
                        SELECT b.stall_no, v.message 
                        FROM vendorsoa v
                        INNER JOIN (
                            SELECT stall_no, vendor_id FROM building_a
                            UNION ALL 
                            SELECT stall_no, vendor_id FROM building_b
                            UNION ALL 
                            SELECT stall_no, vendor_id FROM building_c
                            UNION ALL 
                            SELECT stall_no, vendor_id FROM building_d
                            UNION ALL 
                            SELECT stall_no, vendor_id FROM building_e
                            UNION ALL 
                            SELECT stall_no, vendor_id FROM building_f
                            UNION ALL 
                            SELECT stall_no, vendor_id FROM building_g
                            UNION ALL 
                            SELECT stall_no, vendor_id FROM building_h
                            UNION ALL 
                            SELECT stall_no, vendor_id FROM building_i
                            UNION ALL 
                            SELECT stall_no, vendor_id FROM building_j
                        ) b ON v.vendor_id = b.vendor_id
                        WHERE v.vendor_id = ? AND v.message IS NOT NULL;
                    ";

                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $vendor_id); // Bind vendor_id as an integer
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Check if any records are found
                        if ($result->num_rows > 0) {
                            // Loop through the results and generate table rows
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='text-center text-sm'>" . htmlspecialchars($row['stall_no']) . "</td>";
                                echo "<td class='text-center text-sm'>" . htmlspecialchars($row['message']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center text-sm'>There are no Current Messages</td></tr>";
                        }

                        // Close the connection
                        $stmt->close();
                        $conn->close();
                    ?>


                        </tbody>
                    </table>
                    </div>
      </div>

            </div>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-lg-11 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <span class="text-info text-center">Statement of Account</span>
                    </div>
                </div>



                <div class="card-body px-0 pb-2">
                    <div class="container">
                        <!-- Messages Reminders Label -->
                        <div class="row">
                            
                            <!-- PDF Display Section -->
                            <div id="pdfContainer" style="display: none;">
                                <iframe id="pdfIframe" width="100%" height="500px"></iframe>
                            </div>
                            <div id="pdfError" style="display: none; color: red;"></div>
                            <div id="jsonError" style="display: none; color: green;"></div> <!-- JSON error display -->

                            <script>
                                // Embed the PHP variable in JavaScript
                                const vendorId = <?php echo json_encode($vendor_id); ?>;

                                async function fetchPdfData() {
                                    try {
                                        // Send a request to fetch the file path from the server
                                        const response = await fetch('soa.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify({ 'vendor_id': vendorId }) // Use the JavaScript variable
                                        });

                                        const pdfIframe = document.getElementById('pdfIframe');
                                        const pdfContainer = document.getElementById('pdfContainer');
                                        const pdfError = document.getElementById('pdfError');
                                        const jsonError = document.getElementById('jsonError'); // Locator for JSON errors

                                        if (response.ok) {
                                            const data = await response.json();

                                            if (data.success && data.filePath) {
                                                // Display the iframe with the PDF
                                                pdfIframe.src = data.filePath;
                                                pdfContainer.style.display = 'block'; // Show the PDF container
                                                pdfError.style.display = 'none'; // Hide the error message
                                                jsonError.style.display = 'none'; // Hide JSON error message
                                            } else {
                                                // Hide the iframe and show an error message
                                                pdfContainer.style.display = 'none'; // Hide the PDF container
                                                pdfError.textContent = data.message || 'No PDF file found.';
                                                pdfError.style.display = 'block'; // Show the error message
                                                jsonError.style.display = 'none'; // Hide JSON error message
                                            }
                                        } else {
                                            // Handle network error
                                            pdfContainer.style.display = 'none'; // Hide the PDF container
                                            pdfError.textContent = 'Error: Network response was not ok';
                                            pdfError.style.display = 'block'; // Show the error message
                                            jsonError.style.display = 'none'; // Hide JSON error message
                                        }
                                    } catch (error) {
                                        // Display error message for fetch or JSON errors
                                        document.getElementById('pdfContainer').style.display = 'none'; // Hide the PDF container
                                        document.getElementById('pdfError').style.display = 'none'; // Hide regular error message
                                        jsonError.textContent = 'Error: ' + error.message;
                                        jsonError.style.display = 'block'; // Show JSON error message
                                    }
                                }

                                // Call the function to fetch PDF data
                                fetchPdfData();
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