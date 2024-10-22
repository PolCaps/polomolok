<?php
include('Sessions/Cashier.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets2/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/imgbg/BGImage.png">
  <title>
    Cashier
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
          <a class="nav-link" href="Cashier.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        
        <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReceipt"
    aria-expanded="false" aria-controls="collapseReceipt">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
      </svg>
    </div>
    <span class="nav-link-text ms-1">Receipts</span>
  </a>
  <div class="collapse" id="collapseReceipt">
    <div class="right-aligned-links" style="text-align: right;">
      <a class="nav-link" href="CMReceiptVendor.php">Vendors</a>
      
      <!-- Dropdown for Rent Stall Applicants -->
      <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStallApp"
         aria-expanded="false" aria-controls="collapseStallApp">
        Rent Stall Applicants
      </a>
      <div class="collapse" id="collapseStallApp">
        <ul class="nav flex-column ms-3"> <!-- Added 'ms-3' for margin on the left -->
          <li class="nav-item">
            <a class="nav-link" href="CMReceiptApplicantsPaid.php">Paid</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="CMReceiptApplicantsUnpaid.php">Unpaid</a>
          </li>
        </ul>
      </div>
      
    </div>
  </div>
</li>
        <li class="nav-item">
          <a class="nav-link" href="CMReports.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-richtext" viewBox="0 0 16 16">
              <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
              <path d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m1.639-3.708 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V8.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8s1.54-1.274 1.639-1.208M6.25 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5"/>
            </svg>
          </div>
          <span class="nav-link-text ms-1">Monthly Reports</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link collapsed active" href="#"  data-bs-toggle="collapse" data-bs-target="#collapsePayRem">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Payment Reminder</span>
          </a>
  <div class="collapse" id="collapsePayRem">
    <div class="right-aligned-links" style="text-align: center;">
      <a class="nav-link" href="CMPaymentRem.php">Show All</a>
      <a class="nav-link" href="CMPaymentRemOverdue.php">Overdued</a>
      <a class="nav-link" href="CMPaymentRemUpcoming.php">Within 7 Days</a>
    </div>
  </div>
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Cashier</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Module</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Payment Reminder</h6>
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
                <span class="d-sm-inline d-none">Cashier</span>
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
      
      <div class="row my-4">
        <div class="col-lg-11 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <div class="d-flex">
                  <i class="fa fa-calendar text-info mt-1 mx-2" aria-hidden="true"></i>
                  <h6 class="text-info">Vendor Payment Reminders</h6>
                  </div>
                
                 
                </div>
                
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="d-flex flex-column">
                    <div class="d-flex">
                    <i class="fa fa-exclamation-circle text-danger text-xs mx-1" aria-hidden="true"></i>
                    <p class="text-xs text-danger">Overdued: </p>
                    <p class="text-xs mx-1"> Vendors who are past their expected Due Date</p>

                    </div>
                  
                  </div>
                  <div class="d-flex flex-column">
                    <div class="d-flex">
                    <i class="fa fa-exclamation-circle text-warning text-xs mx-1" aria-hidden="true"></i>
                    <p class="text-xs text-warning">Upcoming: </p>
                    <p class="text-xs mx-1"> Vendors who have Due Date within 7 days</p>

                    </div>
                  
                  </div>
                </div>
              </div>
            </div>

            <?php
include 'database_config.php'; // Include the database connection

// Create a new MySQLi connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sqlvendor = "
    SELECT 
        CONCAT(v.first_name, ' ', v.middle_name, ' ', v.last_name) AS name, 
        v.username AS username, 
        v.payment_due AS payment_dues, 
        COALESCE(a.monthly_rentals, b.monthly_rentals, c.monthly_rentals, d.monthly_rentals, e.monthly_rentals, f.monthly_rentals, g.monthly_rentals, h.monthly_rentals, i.monthly_rentals, j.monthly_rentals) AS rent_due, 
        v.vendor_id AS vendor_id, 
        DATE_FORMAT(COALESCE(a.due_date, b.due_date, c.due_date, d.due_date, e.due_date, f.due_date, g.due_date, h.due_date, i.due_date, j.due_date), '%M %d, %Y') AS due_date, 
        CASE 
            WHEN COALESCE(a.due_date, b.due_date, c.due_date, d.due_date, e.due_date, f.due_date, g.due_date, h.due_date, i.due_date, j.due_date) < NOW() THEN 'Overdue'
            WHEN COALESCE(a.due_date, b.due_date, c.due_date, d.due_date, e.due_date, f.due_date, g.due_date, h.due_date, i.due_date, j.due_date) >= NOW() AND COALESCE(a.due_date, b.due_date, c.due_date, d.due_date, e.due_date, f.due_date, g.due_date, h.due_date, i.due_date, j.due_date) <= DATE_ADD(NOW(), INTERVAL 7 DAY) THEN 'Upcoming'
            ELSE 'No Due'
        END AS due_status
    FROM vendors v 
    LEFT JOIN building_a a ON v.vendor_id = a.vendor_id 
    LEFT JOIN building_b b ON v.vendor_id = b.vendor_id 
    LEFT JOIN building_c c ON v.vendor_id = c.vendor_id 
    LEFT JOIN building_d d ON v.vendor_id = d.vendor_id 
    LEFT JOIN building_e e ON v.vendor_id = e.vendor_id 
    LEFT JOIN building_f f ON v.vendor_id = f.vendor_id 
    LEFT JOIN building_g g ON v.vendor_id = g.vendor_id 
    LEFT JOIN building_h h ON v.vendor_id = h.vendor_id 
    LEFT JOIN building_i i ON v.vendor_id = i.vendor_id 
    LEFT JOIN building_j j ON v.vendor_id = j.vendor_id 
    WHERE 
        COALESCE(a.due_date, b.due_date, c.due_date, d.due_date, e.due_date, f.due_date, g.due_date, h.due_date, i.due_date, j.due_date) IS NOT NULL  -- Ensure due dates are not null
    ORDER BY 
        COALESCE(a.due_date, b.due_date, c.due_date, d.due_date, e.due_date, f.due_date, g.due_date, h.due_date, i.due_date, j.due_date) ASC;  -- Sort by due date
";

$resultA = $conn->query($sqlvendor);
$tableRows = '';
if ($resultA === false) {
    die("Error executing query: " . $conn->error);
}

if ($resultA->num_rows > 0) {
    while ($rowA = $resultA->fetch_assoc()) {
        // Determine the class and icon based on the due_status
        $dueStatusClass = 'text-xs font-weight-bold';
        $dueStatusIcon = ''; // Default icon
        
        if ($rowA['due_status'] == 'Overdue') {
            $dueStatusClass .= ' text-danger'; // Add danger class for overdue
            $dueStatusIcon = '<i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i>'; // Overdue icon
        } elseif ($rowA['due_status'] == 'Upcoming') {
            $dueStatusClass .= ' text-warning'; // Add warning class for upcoming
            $dueStatusIcon = '<i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>'; // Upcoming icon
        }

        $tableRows .= '
            <tr>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . htmlspecialchars($rowA['name']) . '</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="avatar-group mt-1">
                        <h6 class="mb-1 text-sm">' . htmlspecialchars($rowA['username']) . '</h6>
                    </div>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold">' . htmlspecialchars($rowA['rent_due']) . '</span>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="' . $dueStatusClass . '">' . $dueStatusIcon . ' ' . htmlspecialchars($rowA['due_status']) . '</span>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold">' . htmlspecialchars($rowA['due_date']) . '</span>
                </td>
                <td class="align-middle text-center text-sm">
                    <button type="button" class="btn btn-sm btn-primary my-1" onclick="openSendMessageModal(\'' . htmlspecialchars($rowA['name']) . '\', ' . htmlspecialchars($rowA['vendor_id']) . ')"> Send Reminders </button>
                </td>
            </tr>';
    }
} else {
    $tableRows = '<tr><td colspan="6" class="text-center">No upcoming dues available</td></tr>';
}
?>


<div class="card-body px-0 pb-2">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Username</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Due</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th> <!-- New column -->
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
        </thead>
            <tbody id="tbody">
                <?= $tableRows ?>
            </tbody>
        </table>
    </div>
</div>



<!-- send message Modal -->
<div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendMessageModalLabel">Send Reminders to Vendor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="sendMessageForm" method="POST" action="generateSOA.php">
          <div class="mb-3">
            <label for="vendor-name" class="col-form-label">Vendor Name:</label>
            <input type="text" class="form-control" id="vendor-name" name="name" readonly>
          </div>
          <div class="mb-3">
            <label for="remaining-balance" class="col-form-label">Remaining Balance:</label>
            <input type="number" class="form-control" id="remaining-balance" name="remaining_balance" step="0.01" min="0">
          </div>
          <div class="mb-3">
            <label for="monthly-rentals" class="col-form-label">Monthly Rentals:</label>
            <input type="text" class="form-control" id="monthly-rentals" name="totalPay" readonly>
          </div>
          <div class="mb-3">
            <label for="remaining-balance" class="col-form-label">Remaining Balance:</label>
            <input type="number" class="form-control" id="remaining-balance" name="remaining-balance" step="0.01" min="0" required>
          </div>
         
          <div class="mb-3">
            <label for="miscellaneous-fees" class="col-form-label">Miscellaneous Fees (optional):</label>
            <input type="number" class="form-control" id="miscellaneous-fees" name="miscellaneous_fees" step="0.01" min="0">
          </div>
          <div class="mb-3">
            <label for="other-fees" class="col-form-label">Other Fees (optional):</label>
            <input type="number" class="form-control" id="other-fees" name="other_fees" step="0.01" min="0">
          </div>
          <div class="mb-3">
            <label for="monthBill" class="col-form-label">Bill for the Month:</label>
            <input type="text" class="form-control" id="monthBill" name="monthBill">
          </div>
          <div class="mb-3">
            <label for="building" class="col-form-label">Building Name/Number:</label>
            <input type="text" class="form-control" id="building" name="building">
          </div>
          <div class="mb-3">
            <label for="stallNumber" class="col-form-label">Stall Number:</label>
            <input type="text" class="form-control" id="stallNumber" name="stallNumber">
          </div>
          <div class="mb-3">
            <label for="dueDate" class="col-form-label">Due Date:</label>
            <input type="date" class="form-control" id="dueDate" name="dueDate">
          </div>
          <div class="mb-3">
            <label for="padlockingDate" class="col-form-label">Padlocking Date (optional):</label>
            <input type="date" class="form-control" id="padlockingDate" name="padlockingDate">
          </div>
          <div class="mb-3">
            <label for="numMonths" class="col-form-label">Number of Months:</label>
            <input type="number" class="form-control" id="numMonths" name="numMonths" min="1">
          </div>
          <div class="mb-3">
            <label for="penaltyFee" class="col-form-label">Penalty Fee (if any):</label>
            <input type="number" class="form-control" id="penaltyFee" name="penaltyFee" step="0.01" min="0">
          </div>
          
          <input type="hidden" id="vendor-id" name="vendor-id">
          <button type="submit" id="submit" class="btn btn-primary">SEND SOA</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', () => {
  // Format the input as currency
  function formatCurrencyInput(input) {
    let value = parseFloat(input.value.replace(/,/g, ''));
    if (!isNaN(value)) {
      input.value = value.toLocaleString('en-US', { style: 'decimal', minimumFractionDigits: 2 });
    }
  }

  // Attach input event to format currency
  document.querySelectorAll('.currency-input').forEach(input => {
    input.addEventListener('input', function() {
      formatCurrencyInput(this);
    });

    // Optional: Format when the input loses focus
    input.addEventListener('blur', function() {
      formatCurrencyInput(this);
    });
  });

  // Function to open the modal and set vendor details
  function openSendMessageModal(vendorName, vendorId) {
    document.getElementById('vendor-name').value = vendorName;
    document.getElementById('vendor-id').value = vendorId;

    // Fetch monthly rentals based on vendorId
    fetchMonthlyRentals(vendorId);

    const sendMessageModal = new bootstrap.Modal(document.getElementById('sendMessageModal'));
    sendMessageModal.show();
  }

  // Fetch monthly rentals from the server
  function fetchMonthlyRentals(vendorId) {
    fetch(`getMonthlyRentals.php?vendor_id=${vendorId}`)
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          document.getElementById('monthly-rentals').value = data.monthly_rentals;
        } else {
          alert('Error fetching monthly rentals: ' + data.message);
        }
      })
      .catch(error => console.error('Error:', error));
  }

  // Handle form submission
  document.querySelector('#sendMessageForm').addEventListener('submit', function(event) {
    // Prevent default form submission
    event.preventDefault();

    // Create a FormData object from the form
    const formData = new FormData(this);

    // Use Fetch API to submit the form
    fetch('generateSOA.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Invoice generated successfully!');
        window.open(data.file, '_blank');
      } else {
        alert('Error: ' + data.message);
      }
    })
    .catch(error => console.error('Error:', error));
  });

  window.openSendMessageModal = openSendMessageModal;
});
</script>
<style>

.alert-popup {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: white;
  border: 1px solid #ccc;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  z-index: 1000;
}

.alert-popup-content {
  text-align: center;
}

.alert-popup .btn {
  margin: 10px;
}

</style>


    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-wechat py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
        <h5 class="card-text">Username: <span class="card-text text-info"><?php echo htmlspecialchars($user['username']); ?></span></h5>
        <p class="card-text">Role: <span class="card-text text-info"><?php echo htmlspecialchars($user['user_type']); ?></span></p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <a class="btn bg-gradient-info w-85 text-white mx-4" href="#">Edit Profile</a>
        <a class="btn btn-outline-info w-85 mx-4" href="index.php">Logout</a>
        <hr class="horizontal dark my-1">
        <div class="text-small">Fixed Navbar</div>
      <div class="form-check form-switch ps-0">
        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
      </div>
      <br>
      <hr class="horizontal dark my-1">
      <br>
      <div class="text-small text-center text-info">Messages</div>
      <br><br>
      <div class="text-small text-center">No Message Yet!</div>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>