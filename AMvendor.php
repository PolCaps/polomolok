<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['user_type'] != 'ADMIN') {
    header("Location: index.php");
    exit();
}
// Get the vendor ID from the session
$user_id = $_SESSION['id'];

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
   <!-- Bootstrap 5.3 CSS -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <link id="pagestyle" href="assets2/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <style>
        .alert {
            position: fixed;
            top: 1rem;
            left: 50%;
            transform: translateX(-50%);
            width: auto; /* Auto width for better fit */
            max-width: 500px; /* Maximum width to keep it from being too wide */
            z-index: 1050;
        }
        .alert-icon {
            font-size: 1.2em; /* Adjust the size of the icon */
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
          <a class="nav-link collapsed" href="Admin.php" data-bs-toggle="collapse" data-bs-target="#collapseMaps" aria-expanded="false" aria-controls="collapseMaps">
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
              <a class="nav-link" href="ABuildingA.html">Building A</a>
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
          <a class="nav-link active" href="#">
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
          <a class="nav-link  " href="AMRelocationRequest.php">
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
          <h5 class="text-center"><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['middle_name']) . ' ' . htmlspecialchars($user['last_name']); ?></h5>
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
          <h6 class="font-weight-bolder mb-0">Vendors</h6>
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
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Vendors</p>
                    <h5 class="font-weight-bolder mb-0">
                      8,231
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="d-grid gap-2 d-md-block py-3 px-3">
          <p class="text-title">Actions</p>
          <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showexampleModal">
            Add New Vendor/User
          </button>
        </div>
        
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
      <div class="modal fade" id="showexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header d-flex" id="headingAdminStaff">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdminStaff" aria-expanded="true" aria-controls="collapseAdminStaff">
                                            Admin/Staff
                                        </button>
                                    </h2>
                                    
                                    <div id="collapseAdminStaff" class="accordion-collapse collapse show" aria-labelledby="headingAdminStaff" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <form id="createAdminStaffForm" action="process_formAdSta.php" method="POST" enctype="multipart/form-data">
                                                <div class="form-group mb-3">
                                                    <label for="account_type">Account Type:</label>
                                                    <select id="account_type" class="form-control" name="account_type" required>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Staff">Staff</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select an account type.</div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="username">Username:</label>
                                                    <input type="text" id="username" class="form-control" name="username" required>
                                                    <div class="invalid-feedback">Please enter a username.</div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="password">Password:</label>
                                                    <div class="input-group">
                                                        <input type="password" id="password" class="form-control" name="password" required>
                                                        <i class="fas fa-eye px-2 py-3" type="button" aria-hidden="true" id="togglePasswordformAdminStaff"></i>
                                                    </div>
                                                    <script>
                                                        const togglePasswordAdminStaff = document.querySelector('#togglePasswordformAdminStaff');
                                                        const passwordAdminStaff = document.querySelector('#password');
                                                        togglePasswordAdminStaff.addEventListener('click', () => {
                                                            const type = passwordAdminStaff.getAttribute('type') === 'password' ? 'text' : 'password';
                                                            passwordAdminStaff.setAttribute('type', type);
                                                            togglePasswordAdminStaff.classList.toggle('bi-eye-fill');
                                                        });
                                                    </script>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="first_name">First Name:</label>
                                                    <input type="text" id="first_name" class="form-control" name="first_name" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="middle_name">Middle Name:</label>
                                                    <input type="text" id="middle_name" class="form-control" name="middle_name">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="last_name">Last Name:</label>
                                                    <input type="text" id="last_name" class="form-control" name="last_name" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="age">Age:</label>
                                                    <input type="number" id="age" class="form-control" name="age">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="contact_no">Contact Number:</label>
                                                    <input type="tel" id="contact_no" name="contact_number" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="address">Address:</label>
                                                    <textarea id="address" name="address" class="form-control" style="height: 128px;"></textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="email_add">Email Address:</label>
                                                    <textarea id="email_add" name="email_add" class="form-control"></textarea>
                                                </div>
                                                <div class="modal-footer my-2" style="align-items: center; justify-content: center;">
                                                    <button type="submit" name="submit" id="submit" class="btn btn-info lg">Create User</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header d-flex" id="headingVendor">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVendor" aria-expanded="false" aria-controls="collapseVendor">
                                            Vendor
                                        </button>
                                    </h2>
                                    <div id="collapseVendor" class="accordion-collapse collapse" aria-labelledby="headingVendor" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <form id="createVendorForm" action="process_formVendor.php" method="POST" enctype="multipart/form-data">
                                                <div class="form-group mb-3">
                                                    <label for="account_type">Account Type:</label>
                                                    <select id="account_type" class="form-control" name="account_type" required>
                                                        <option value="Vendor">Vendor</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select an account type.</div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="username">Username:</label>
                                                    <input type="text" id="username" class="form-control" name="username" required>
                                                    <div class="invalid-feedback">Please enter a username.</div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="password">Password:</label>
                                                    <div class="input-group">
                                                        <input type="password" id="password" class="form-control" name="password" required>
                                                        <i class="fas fa-eye px-2 py-3" type="button" aria-hidden="true" id="togglePasswordformVendor"></i>
                                                    </div>
                                                    <script>
                                                        const togglePasswordVendor = document.querySelector('#togglePasswordformVendor');
                                                        const passwordVendor = document.querySelector('#password');
                                                        togglePasswordVendor.addEventListener('click', () => {
                                                            const type = passwordVendor.getAttribute('type') === 'password' ? 'text' : 'password';
                                                            passwordVendor.setAttribute('type', type);
                                                            togglePasswordVendor.classList.toggle('bi-eye-fill');
                                                        });
                                                    </script>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="first_name">First Name:</label>
                                                    <input type="text" id="first_name" class="form-control" name="first_name" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="middle_name">Middle Name:</label>
                                                    <input type="text" id="middle_name" class="form-control" name="middle_name">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="last_name">Last Name:</label>
                                                    <input type="text" id="last_name" class="form-control" name="last_name" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="age">Age:</label>
                                                    <input type="number" id="age" class="form-control" name="age">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="contact_no">Contact Number:</label>
                                                    <input type="tel" id="contact_no" name="contact_number" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="address">Address:</label>
                                                    <textarea id="address" name="address" class="form-control" style="height: 128px;" required></textarea>
                                                </div>
                                                
                                                <div class="form-group mb-3">
                                                    <label for="stall_no">Stall Number:</label>
                                                    <input type="text" id="stall_no" name="stall_no" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="email_add">Email Address:</label>
                                                    <textarea id="email_add" name="email_add" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="building_type">Buildings:</label>
                                                    <select id="building_type" name="building_type" class="form-control">
                                                        <option value="">Select Buildings</option>
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
                                                <div class="form-group mb-3">
                                                    <label for="lease_agreements">Lease Agreements:</label>
                                                    <input type="file" id="lease_agreements" name="lease_agreements" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="business_permits">Business Permits:</label>
                                                    <input type="file" id="business_permits" name="business_permits" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="business_licenses">Business Licenses:</label>
                                                    <input type="file" id="business_licenses" name="business_licenses" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="receipts">Payment Receipts:</label>
                                                    <input type="file" id="receipts" name="receipts" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="monthly_rentals">Monthly Rentals:</label>
                                                    <input type="number" id="monthly_rentals" name="monthly_rentals" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="building_floor">Building Floor:</label>
                                                    <select id="building_floor" name="building_floor" class="form-control">
                                                        <option value="">Select Building Floor:</option>
                                                        <option value="Ground Floor">Ground Floor</option>
                                                        <option value="Second Floor">Second Floor</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a building floor.</div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="started_date">Started Date:</label>
                                                    <input type="date" id="started_date" name="started_date" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="end_date">End Date:</label>
                                                    <input type="date" id="end_date" name="end_date" class="form-control">
                                                </div>
                                                <div class="modal-footer my-2" style="align-items: center; justify-content: center;">
                                                    <button type="submit" name="submit" id="submit" class="btn btn-info lg">Create Vendor</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                            <script> // Event listeners for each file input 
       document.getElementById('lease_agreements').addEventListener('change', function(event) 
       { handleFileInputChange(event, 'lease_agreements'); }); 
       document.getElementById('business_permits').addEventListener('change', function(event) 
       { handleFileInputChange(event, 'business_permits'); }); 
       document.getElementById('business_licenses').addEventListener('change', function(event) 
       { handleFileInputChange(event, 'business_licenses'); }); 
       document.getElementById('receipts').addEventListener('change', function(event) 
       { handleFileInputChange(event, 'receipts'); }); 
       // Function to handle file input change 
       function handleFileInputChange(event, key) { 
       const file = event.target.files[0]; 
       if (file) { const reader = new FileReader(); 
        reader.readAsArrayBuffer(file);
       reader.onload = function(e) 
       { 
       const binaryData = e.target.result; 
       sendBinaryDataToServer(binaryData, key); }; 
       }
    } 
       function handleFileInputChange(event, inputId) { 
       const input = event.target; 
       const files = input.files; 
       const allowedTypes = [ 
       'image/jpeg', 
       'image/png', 
       'image/gif', // Add more image types 
       '*/*', 
       'application/pdf'
       ]; 
       const fileErrors = []; 
       for (let i = 0; i < files.length; i++) { 
       const file = files[i]; 
       if (!allowedTypes.includes(file.type)) { 
       fileErrors.push(`File ${file.name} is not allowed. Only JPEG, PNG, and PDF files are allowed.`); 
       } 
      } 
         if (fileErrors.length > 0) 
         { 
          alert(fileErrors.join('\n')); 
          input.value = ''; // Clear the input 
          } else { 
           const reader = new FileReader(); 
          reader.readAsArrayBuffer(file); 
          reader.onload = function(e) { 
          const binaryData = e.target.result; 
          sendBinaryDataToServer(binaryData, inputId); }; 
          } 
        } 
          // Function to send binary data to server for each file 
           function sendBinaryDataToServer(binaryData, key) { 
            const formData = new FormData(); 
            formData.append(key, new Blob([binaryData])); 
           }
           
          const createVendorForm = document.getElementById('createVendorForm'); 
          createVendorForm.addEventListener('submit', function(e) )  { 
            e.preventDefault(); // Prevent default form submission 
            // Prepare form data 
            const formData = new FormData(this); 
            // Send AJAX request to create\_user.php 
            fetch('process_formVendor.php', { method: 'POST', body: formData }).then(response => { 
              // Check if the response is in the correct 
              format (JSON) if (!response.ok) { 
                throw new Error('Network response was not ok'); 
              } 
                return response.json(); // Parse JSON response 
                }
              ) 
              .then(data => { 
                  // Log the received data for debugging 
                  console.log('Response data:', data); 
                  // Handle successful response from create\_user.php 
                  if (data.success) { 
                    // Display success message (e.g., using alert or updating modal content) 
                    alert('User created successfully!'); 
                    // Optionally, clear the form or redirect to a different page 
                    document.getElementById('createVendorForm').reset(); 
                    // Clear the form 
                    } else { 
                      // Display error message (e.g., using alert or updating modal content) 
                      alert('Error creating user: ' + data.error); }
                     }) 
                     .catch(error => { 
                      // Handle any network or parsing errors 
                      console.error('Error:', error); 
                      alert('Error creating user. Please try again later.'); 
                    }
                  );
          }
          </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

      <script>
        document.getElementById('account_type').addEventListener('change', function() {
          var accountType = this.value;
          var adminStaffAccordion = document.getElementById('collapseAdminStaff');
          var vendorAccordion = document.getElementById('collapseVendor');

          if (accountType === 'Admin' || accountType === 'Staff') {
            adminStaffAccordion.classList.add('show');
            vendorAccordion.classList.remove('show');
          } else if (accountType === 'Vendor') {
            adminStaffAccordion.classList.remove('show');
            vendorAccordion.classList.add('show');
          }
        });

    // document.addEventListener('DOMContentLoaded', () => {
    //   const togglePassword = document.querySelector('#togglePasswordform');
    //   const password = document.querySelector('#password');
    //   if (togglePassword) {
    //     togglePassword.addEventListener('click', () => {
    //       const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    //       password.setAttribute('type', type);
    //       togglePassword.classList.toggle('fa-eye');
    //       togglePassword.classList.toggle('fa-eye-slash');
    //     });
    //   }
    // });
  </script>
          </div>

      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Vendors</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-user-circle text-warning" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">List of Vendors</span> 
                  </p>
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
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usertype</th> 
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th> 
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bulding</th> 
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stall #</th> 
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Due</th> 
                  </tr> 
                </thead> 
                <tbody id="dataTableBody">
                
              <td>
                
              

              </td>

            </tbody>
            </table>
            </div>
          </div>
          
        </div>
        
      </div>
      <div class="col-lg-4 col-md-6">
          <div class="card h-50">
            <div class="card-header pb-0">
              <h6>Card Sample</h6>
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
        
        <h5 class="text-center">Username: <span class="text-info"><?php echo htmlspecialchars($user['first_name']) ?></span> </h5>
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
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e9T9hXmJ58bldgTk+" crossorigin="anonymous">
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets2/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e9T9hXmJ58bldgTk+" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-Dbc4rNzEfaO0/1A/f8Gk+9mE6k5vZlF8d4G9ktBf3mHk5sZj98m1F2FPH+E/XKlS" crossorigin="anonymous"></script>

 </body>
 </html>
