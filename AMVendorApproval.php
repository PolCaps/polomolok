<?php
session_name('admin_session');
session_start();

if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'ADMIN') {
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
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <style>
     .table-responsive{
      max-height: 700px;
      overflow-y: auto;
     }
      
    </style>
</head>

<div class="g-sidenav-show  bg-gray-100">
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
          <a class="nav-link active " href="#">
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
          <h6 class="font-weight-bolder mb-0">Vendor Approval/Applicants</h6>
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
      <!-- Add Vendor Applicant button -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVendorApplicant">Add Vendor Applicant</button>
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Rejected Applicants</button>

<!-- Modal HTML -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete all rejected applicants?</p>
        <div id="deleteAlert" class="alert d-none" role="alert"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="confirmDelete" class="btn btn-danger">Delete All Rejected Applicants</button>
      </div>
    </div>
  </div>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('confirmDelete').addEventListener('click', function() {
        // Send an AJAX request to delete rejected applicants
        fetch('delete_rejected_applicants.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            const alertDiv = document.getElementById('deleteAlert');
            if (data.success) {
                alertDiv.className = 'alert alert-success';
                alertDiv.textContent = data.message;
                alertDiv.classList.remove('d-none');
                setTimeout(() => {
                    // Hide the modal and optionally refresh the page
                    new bootstrap.Modal(document.getElementById('deleteModal')).hide();
                    location.reload(); // Uncomment to refresh the page
                }, 1000); // Wait for 1 second before hiding the modal
            } else {
                alertDiv.className = 'alert alert-danger';
                alertDiv.textContent = data.message;
                alertDiv.classList.remove('d-none');
            }
        })
        .catch(error => {
            const alertDiv = document.getElementById('deleteAlert');
            alertDiv.className = 'alert alert-danger';
            alertDiv.textContent = 'An error occurred. Please try again.';
            alertDiv.classList.remove('d-none');
            console.error('Error:', error);
        });
    });
});
</script>

      <div class="row my-4">
        <div class="col-lg-11 col-md-6 mb-md-0 mb-8">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Vendors Approval</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-user-circle text-warning" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">Stall Applicants</span> 
                  </p>
                </div>
                
               <div class="col-lg-6 col-5 my-auto text-end d-flex">
               
               <div class="input-group mx-3">
                  <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                  <input type="text" id="searchInput" class="form-control" placeholder="Search for...">
              </div>

                  <div class="dropdown float-lg-end pe-4 mx-2 my-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar2-week" viewBox="0 0 16 16" id="filterDate" data-bs-toggle="dropdown" aria-expanded="false">
                      <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
                      <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="filterDate">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Today</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">This Week</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">This Month</a></li>
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
                                 <input type="text" id="customEndDate" name="end_date" class="form-control" placeholder="End Date">
                            </form>
                        </div>
                        <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             <button type="button" class="btn btn-primary" onclick="submitCustomDateForm()">Apply</button>
                        </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel">Applicant Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="updateForm" action="rent_updateStatus.php" method="POST">
        <div class="mb-3 text-start">
          <label for="applicantId" class="form-label">Applicant ID:</label>
          <input type="text" id="applicantId" name="applicant_id" class="form-control" readonly>
        </div>
        <div class="mb-3 text-start">
          <label for="fullName" class="form-label">Full Name:</label>
          <input type="text" id="fullName" class="form-control" readonly>
        </div>
        <div class="mb-3 text-start">
          <label for="status" class="form-label">Status:</label>
          <select id="status" name="status" class="form-control">
          <option value="PROCESSING">Processing</option>
            <option value="PENDING">Pending</option>
            <option value="APPROVED">Approved</option>
            <option value="DECLINED">Declined</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
      </div>
    </div>
  </div>
</div>
                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script></script>
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

                            filterTableByDateRange(startDate, endDate);
                        }

                        function submitCustomDateForm() {
                            const startDate = document.getElementById('customStartDate').value;
                            const endDate = document.getElementById('customEndDate').value;
                            filterTableByDateRange(startDate, endDate);
                        }

                        function filterTableByDateRange(startDate, endDate) {
                            const table = document.querySelector('.table');
                            const rows = table.getElementsByTagName('tr');
                            const start = new Date(startDate);
                            const end = new Date(endDate);

                            for (let i = 1; i < rows.length; i++) {
                                const cells = rows[i].getElementsByTagName('td');
                                const dateOfSubmission = new Date(cells[1].innerText);
                                
                                if (dateOfSubmission >= start && dateOfSubmission <= end) {
                                    rows[i].style.display = '';
                                } else {
                                    rows[i].style.display = 'none';
                                }
                            }
                        }
                        document.getElementById('searchInput').addEventListener('input', function() {
                            var input = this.value.toLowerCase();
                            var table = document.querySelector('.table');
                            var rows = table.getElementsByTagName('tr');
                            
                            for (var i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
                                var cells = rows[i].getElementsByTagName('td');
                                var fullName = cells[0].innerText.toLowerCase();
                                var status = cells[1].innerText.toLowerCase();
                                var dateOfSubmission = cells[2].innerText.toLowerCase();
                                var contactNo = cells[3].innerText.toLowerCase();
                                var email = cells[4].innerText.toLowerCase();
                                var stallno = cells[5].innerText.toLowerCase();
                                var address = cells[6].innerText.toLowerCase();
                                var rentAppFile = cells[7].innerText.toLowerCase();

                                if (fullName.includes(input) || status.includes(input) || dateOfSubmission.includes(input) || contactNo.includes(input) || email.includes(input) || stallno.includes(input) || address.includes(input) || rentAppFile.includes(input)) {
                                    rows[i].style.display = '';
                                } else {
                                    rows[i].style.display = 'none';
                                }
                            }
                        });
                        </script>

                
                            
                  </div>
                </div>
              </div>
            </div>

            


            <div class="card-body px-0 pb-2" >
              <div class="table-responsive" >
                <table class="table align-items-center mb-0" >
                  <thead>
                    <tr>
                      
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Applicant ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Applicant Name</th>
                      <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th> -->
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Date of Submitted</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Rent Application File</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Stall No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Building Type</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Contact No.</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Email Address</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Address</th>

                    </tr>
                  </thead>
                  <tbody id="table-body">
                    
                  </tbody>
                </table>
              </div>
            </div>
            <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Fetch and populate table data
        fetch('populate_rent_app.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('table-body');
                tableBody.innerHTML = ''; // Clear existing content

                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(item => {
                        const row = document.createElement('tr');
                        row.setAttribute('data-id', item.applicant_id); // Add data-id for reference
                        row.setAttribute('class', 'clickable-row'); // Add a class for styling

                        // Create table cells

                        const processCell = document.createElement('td');
                    processCell.innerHTML = `
                        <select class="form-select form-select-sm approval-status" data-id="${item.applicant_id}">
                            <option value="PROCESSING" ${item.Approval === 'PROCESSING' ? 'selected' : ''}>PROCESSING</option>
                            <option value="APPROVED" ${item.Approval === 'APPROVED' ? 'selected' : ''}>APPROVED</option>
                            <option value="DECLINED" ${item.Approval === 'DECLINED' ? 'selected' : ''}>DECLINED</option>
                            <option value="PENDING" ${item.Approval === 'PENDING' ? 'selected' : ''}>PENDING</option>
                        </select>
                    `;
                    row.appendChild(processCell);

                        const applicantidCell = document.createElement('td');
                        applicantidCell.innerHTML = `<div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.applicant_id}</h6></div>`;
                        
                        const nameCell = document.createElement('td');
                        nameCell.innerHTML = `<div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.first_name} ${item.middle_name} ${item.last_name}</h6></div>`;
                        
                        // const statusCell = document.createElement('td');
                        // statusCell.innerHTML = `<div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.Approval}</h6></div>`;

                        const dateCell = document.createElement('td');
                        dateCell.innerHTML = `<div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.applied_date}</h6></div>`;
                        
                        const fileCell = document.createElement('td');
                        fileCell.innerHTML = `<div class="avatar-group mt-1"><h6 class="text-xs text-center"><a href="${item.rentapp_file}" target="_blank">View File</a></h6></div>`;

                        const stallnoCell = document.createElement('td');
                        stallnoCell.innerHTML = `<div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.stall_no}</h6></div>`;
                        
                        const buildingTypeCell = document.createElement('td');
                        buildingTypeCell.innerHTML = `<div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.building_type}</h6></div>`;

                        const contactCell = document.createElement('td');
                        contactCell.innerHTML = `<div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.contact_no}</h6></div>`;
                        
                        const emailCell = document.createElement('td');
                        emailCell.innerHTML = `<div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.email}</h6></div>`;

                        const addressCell = document.createElement('td');
                        addressCell.innerHTML = `<div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.address}</h6></div>`;
                        
                        // Append cells to row
                        row.appendChild(applicantidCell);
                        row.appendChild(nameCell);
                       // row.appendChild(statusCell);
                        row.appendChild(dateCell);
                        row.appendChild(fileCell);
                        row.appendChild(stallnoCell);
                        row.appendChild(buildingTypeCell);
                        row.appendChild(contactCell);
                        row.appendChild(emailCell);
                        row.appendChild(addressCell);
                        
                        // Append row to table body
                        tableBody.appendChild(row);
                    });

                    // Add click event listener to each row
                    document.querySelectorAll('.clickable-row').forEach(row => {
                        row.addEventListener('click', function() {
                            const id = this.getAttribute('data-id');
                            const item = data.find(d => d.applicant_id === id);
                            showModal(item);
                        });
                    });
                } else {
                    const row = document.createElement('tr');
                    const cell = document.createElement('td');
                    cell.colSpan = 10;
                    cell.textContent = 'No records found';
                    row.appendChild(cell);
                    tableBody.appendChild(row);
                }
            })
            .catch(error => console.error('Error fetching data:', error));

            function showModal(item) {
            // Populate the modal with data
            document.getElementById('applicantId').value = item.applicant_id;
            document.getElementById('fullName').value = `${item.first_name} ${item.middle_name} ${item.last_name}`;
            document.getElementById('status').value = item.status;

            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('detailsModal'));
            modal.show();
        }
    });
</script>
    
        </div>
      </div>
      
        </div>
        
        <div class="card mt-6 col-lg-11">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Rent Applicants</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">List of Rental Applicants That are ready for Drawlots   </span> 
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
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Applicant ID</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Official Reciept No.</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Proof Of Payment</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Verify Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Date</th>
                    </tr>
                  </thead>
                  <tbody id="dataTableBodyReceipt">
                  
                </tbody>
                </table>
              </div>
            </div>
          </div>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('populate_rentapp_paymentFiltered.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const tableBody = document.getElementById('dataTableBodyReceipt');
                            tableBody.innerHTML = ''; // Clear existing rows
                            data.data.forEach(item => {
                                const row = document.createElement('tr');
                                
                                row.innerHTML = `
                                    <td class="text-center"><div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.applicant_id}</h6></div></td>
                                    <td class="text-center"><div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.OR_no}</h6></div></td>
                                    <td class="text-center"><div class="avatar-group mt-1"><h6 class="text-xs text-center"><a href="${item.proof_of_payment}" target="_blank">View Proof</a></h6></div></td>
                                    <td class="text-center"><div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.payment_status || 'N/A'}</h6></div></td>
                                    <td class="text-center"><div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.verify_status}</h6></div></td>
                                    <td class="text-center"><div class="avatar-group mt-1"><h6 class="text-xs text-center">${item.payment_date || 'N/A'}</h6></div></td>
                                `;
                                
                                tableBody.appendChild(row);
                            });
                        } else {
                            console.error('Failed to fetch data:', data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>