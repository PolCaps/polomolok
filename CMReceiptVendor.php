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

  
  <style>
    .alert {
      position: fixed;
      top: 1rem;
      left: 50%;
      transform: translateX(-50%);
      width: auto;
      /* Auto width for better fit */
      max-width: 500px;
      /* Maximum width to keep it from being too wide */
      z-index: 1050;
    }

    .alert-icon {
      font-size: 1.2em;
      /* Adjust the size of the icon */
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
          <a class="nav-link " href="CMPaymentRem.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Payment Reminder</span>
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Cashier</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Modules</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Vendors</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control px-1" placeholder="Search for...">

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
       
       <div class="container-fluid py-4">
 <div class="row mt-4">
          
  <!-- Issue Receipt Modal -->
<div class="modal fade" id="issueRecieptModal" tabindex="-1" aria-labelledby="issueRecieptModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="issueRecieptModalLabel">Issue Receipt to Vendor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form submission directly to issueRe.php -->
        <form action="Receipts/issueRe.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="vendorSelect" class="form-label">Select Vendor</label>
            <select id="vendorSelect" name="vendorSelect" class="form-select" required>
              <option value="">Select a vendor</option>
              <!-- Options populated via JavaScript -->
            </select>
          </div>
          <!-- Label to display selected vendor ID -->
          <div class="mb-3">
            <label for="vendorIdLabel" class="form-label">Vendor ID:</label>
            <span id="vendor_id" class="form-text"></span> <!-- This will display the vendor ID -->
          </div>

          <div class="mb-3">
            <label for="usernameDisplay" class="form-label">Username:</label>
            <span id="usernameDisplay" class="form-text"></span>
            <input type="hidden" id="usernameDisplay" name="username" value="">
          </div>


          <input type="hidden" id="vendor_id_input" name="vendor_id" value=""> <!-- Hidden input to store vendor ID -->
          <!-- <div class="mb-3">
            <label for="receiptFile" class="form-label">Attach Receipt File or Photo</label>
            <input type="file" id="receiptFile" name="receiptFile" class="form-control" required>
          </div> -->
          <div class="mb-3">
            <label for="totalPayment" class="form-label">Total Payments</label>
            <textarea id="totalPayment" name="totalPayment" class="form-control" required></textarea>
          </div>
          <div class="mb-3">
            <label for="receiptNo" class="form-label">Receipts Number (OR)</label>
            <input type="text" id="receiptNo" name="receiptNo" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="receiptNotes" class="form-label">Notes (optional)</label>
            <textarea id="receiptNotes" name="receiptNotes" class="form-control"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Generate Receipt</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

        
<div class="d-grid gap-2 d-md-block px-3">
          <p class="text-title">Actions</p>
          <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#issueRecieptModal">
            Issue Receipt
          </button>
        </div>

        <?php

include("database_config.php");

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit;
}

$sqlV = "
   SELECT 
    v.vendor_id, 
    v.username, 
    v.first_name, 
    v.middle_name, 
    v.last_name, 
    GROUP_CONCAT(DISTINCT r.receipt SEPARATOR ', ') AS receipts, 
    v.payment_due AS due_dates, 
    GROUP_CONCAT(DISTINCT stalls.buildings SEPARATOR ', ') AS buildings
FROM 
    vendors v
JOIN (
    SELECT vendor_id, stall_no AS buildings FROM building_a
    UNION ALL
    SELECT vendor_id, stall_no FROM building_b
    UNION ALL
    SELECT vendor_id, stall_no FROM building_c
    UNION ALL
    SELECT vendor_id, stall_no FROM building_d
    UNION ALL
    SELECT vendor_id, stall_no FROM building_e
    UNION ALL
    SELECT vendor_id, stall_no FROM building_f
    UNION ALL
    SELECT vendor_id, stall_no FROM building_g
    UNION ALL
    SELECT vendor_id, stall_no FROM building_h
    UNION ALL
    SELECT vendor_id, stall_no FROM building_i
    UNION ALL
    SELECT vendor_id, stall_no FROM building_j
) AS stalls ON v.vendor_id = stalls.vendor_id
LEFT JOIN receipts r ON v.vendor_id = r.vendor_id
GROUP BY 
    v.vendor_id, 
    v.username, 
    v.first_name, 
    v.middle_name, 
    v.last_name, 
    v.payment_due
ORDER BY 
    v.username
";


$resultV = $conn->query($sqlV);

if ($resultV === false) {
    echo "Error executing query: " . $conn->error;
    exit;
}

$dataV = [];
if ($resultV->num_rows > 0) {
    while ($row = $resultV->fetch_assoc()) {
        $dataV[] = $row;
    }
} else {
    $dataV = [];
}

$conn->close();

?>
          

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
                      <input type="text" class="form-control px-1" id="searchInput" placeholder="Search for...">

                      <script>
                        document.getElementById('searchInput').addEventListener('keyup', function() {
                            var filter = this.value.toLowerCase();
                            var rows = document.querySelectorAll('#dataTableBody tr');

                            rows.forEach(function(row) {
                                var text = row.textContent.toLowerCase();
                                row.style.display = text.includes(filter) ? '' : 'none';
                            });
                        });
                        </script>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vendor Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stall Number</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dues</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Receipt History</th>
                    </tr>
                  </thead>
                  <tbody id="dataTableBody">
    <?php foreach ($dataV as $row) { ?>
        <tr>
            <td>
                <div class="d-flex px-3 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-xs font-weight-bold text-center"><?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']; ?></h6>
                    </div>
                </div>
            </td>
            <td>
                <div class="avatar-group mt-1">
                    <h6 class="text-xs font-weight-bold text-start mx-4"><?php echo $row['buildings']; ?></h6>
                </div>
            </td>
            <td class="align-middle text-center text-sm">
                <span class="text-xxs font-weight-bold text-center"><?php echo $row['due_dates']; ?></span>
            </td>
            <td class="avatar-group mt-1 align-middle text-center text-sm">
                <button 
                    type="button" 
                    class="btn btn-xxs btn-primary my-1" 
                    data-bs-toggle="modal" 
                    data-bs-target="#openHistoryModal" 
                    data-receipts="<?php echo $row['receipts']; ?>" 
                    data-vendor-id="<?php echo $row['vendor_id']; ?>"
                >
                  Show Receipts
                </button>
            </td>
        </tr>
    <?php } ?>
</tbody>
                </table>
              </div>
<!-- Modal for receipt history -->
<div class="modal fade" id="openHistoryModal" tabindex="-1" aria-labelledby="openHistoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="openHistoryModalLabel">Receipt History</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Table to display receipt history -->
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vendor ID</th> -->
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Receipt ID</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File</th>
            </tr>
          </thead>
          <tbody id="receiptHistoryBody">
            <!-- Data will be populated here using JavaScript -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
// Function to fetch receipt history data
function fetchReceiptHistory(vendorId) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'Receipts/get_receipts.php?vendor_id=' + vendorId, true); // Add vendor_id to the query
  xhr.onload = function() {
    if (xhr.status >= 200 && xhr.status < 300) {
      var response = JSON.parse(xhr.responseText);

      if (response.data && response.data.receipts.length > 0) {
        displayReceiptHistory(response.data.receipts);
      } else {
        alert('No receipt data found for this vendor.');
      }
    } else {
      console.error('Request failed with status ' + xhr.status);
      alert('Failed to load receipt data. Please try again later.');
    }
  };
  xhr.onerror = function() {
    console.error('Network error occurred');
    alert('A network error occurred. Please check your connection.');
  };
  xhr.send();
}

 // Display receipt history in the modal
 function displayReceiptHistory(data) {
        var tbody = document.getElementById('receiptHistoryBody');
        var html = '';

        data.forEach(function (row) {
          html += '<tr>';
          html += '<td>' + row.receiptsNum + '</td>';
          html += '<td>' + row.Dates + '</td>';
          html += '<td>';
          if (row.receipts_history) {
            // Create a link that calls the viewFile function when clicked
            html += '<a href="#" onclick="viewFile(\'' + row.receipts_history + '\')" style="text-decoration: none; color: blue;">View File</a>';
          } else {
            html += 'No File Available';
          }
          html += '</td>';
          html += '</tr>';
        });
        tbody.innerHTML = html;
      }

      // Function to open the file in a modal using an iframe
      function viewFile(fileUrl) {
        const iframe = document.getElementById('fileIframe');
        iframe.src = fileUrl;

        const modal = new bootstrap.Modal(document.getElementById('fileModal'));
        modal.show();
      }

// Add event listener to the button to open the modal
document.addEventListener('DOMContentLoaded', function() {
  var buttons = document.querySelectorAll('[data-bs-target="#openHistoryModal"]');
  buttons.forEach(function(button) {
    button.addEventListener('click', function() {
      var vendorId = button.getAttribute('data-vendor-id'); // Fetch vendor_id from button
      // var receiptId = button.getAttribute('data-receipts'); // Fetch receipt_id from button
      fetchReceiptHistory(vendorId); // Pass both vendor_id and receipt_id
    });
  });
});
</script>

              
              <script>
document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
    button.addEventListener('click', function() {
        const receiptsContent = document.getElementById('receiptsContent');
        receiptsContent.innerHTML = this.getAttribute('data-receipts');
    });
});

// Function to populate vendor select dropdown
function populateVendorSelect(vendors) {
    const vendorSelect = document.getElementById('vendorSelect');
    vendorSelect.innerHTML = '<option value="">Select a vendor</option>'; // Clear existing options
    vendors.forEach(data => {
        const option = document.createElement('option');
        option.value = data.vendor_id; // This is the vendor_id
        option.text = `${data.first_name} ${data.middle_name} ${data.last_name} (Stall: ${data.buildings})`;
        option.dataset.username = data.username; // Add username as a data attribute
        vendorSelect.appendChild(option);
    });
}

// Event listener for vendor selection change
document.getElementById('vendorSelect').addEventListener('change', function() {
    const vendorId = this.value; // Get the selected vendor ID
    const selectedOption = this.options[this.selectedIndex]; // Get the selected option
    const username = selectedOption.dataset.username; // Retrieve the username from data attribute

    // Update the vendor ID display
    document.getElementById('vendor_id').textContent = vendorId; // Update the label to show the vendor ID
    document.getElementById('vendor_id_input').value = vendorId; // Set the hidden input value
    
    // Update the username display (assuming you have an element to display the username)
    document.getElementById('usernameDisplay').textContent = username; // Update the username display
});

// Call the function to populate the vendor select dropdown
const vendors = <?php echo json_encode($dataV); ?>;
populateVendorSelect(vendors);
</script>

<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="fileModalLabel">File Viewer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 500px; overflow: hidden;">
              <iframe id="fileIframe" style="width: 100%; height: 100%; border: none;"></iframe>
            </div>
          </div>
        </div>
      </div>









            </div>
          </div>
          
        </div>
        <div>

</div>
</div>

 
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" href="#">
      <i class="fas fa-cog"></i> </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">

          <h5 class="text-center">Username: <span
              class="text-info"><?php echo htmlspecialchars($user['first_name']) ?></span> </h5>
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

<!--     
  <link rel="stylesheet" href="loading.css">
  <script src="loading.js" defer></script>
  <div class="loader"></div> -->

</body>

</html>