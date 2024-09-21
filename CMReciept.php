<?php
session_name('staff_session');
session_start();

if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'STAFF') {
    header("Location: index.php");
    exit();
}
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
    Vendor Payment Reminder
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

<body class="g-sidenav-show  bg-gray-100" onload="fetchData()">
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
          <a class="nav-link active " href="CMReciept.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Reciept</span>
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
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Staff</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Module</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Vendor's Document</h6>
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
                <span class="d-sm-inline d-none">Staff</span>
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
    <!-- Issue Reciept Modal ni sya-->
      <div class="modal fade" id="issueRecieptModal" tabindex="-1" aria-labelledby="issueRecieptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="issueRecieptModalLabel">Issue Receipt to Vendor</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-3">
                  <label for="vendorSelect" class="form-label">Select Vendor</label>
                  <select id="vendorSelect" class="form-select">
                    <!-- populate this select with a list of vendors -->
                    <option value="">Select a vendor</option>
                  
                    <!-- ... -->
                  </select>
                </div>
                <div class="mb-3">
                  <label for="receiptFile" class="form-label">Attach Receipt File or Photo</label>
                  <input type="file" id="receiptFile" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="receiptNotes" class="form-label">Notes (optional)</label>
                  <textarea id="receiptNotes" class="form-control"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="issueReceiptBtn">Generate Receipt</button>
            </div>
          </div>
        </div>
      </div>

    <!-- End Navbar -->
    <div class="container-fluid py-4">

      <div class="d-grid gap-2 d-md-block py-3 px-3">
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

$sqlV = "SELECT v.vendor_id, v.first_name, v.middle_name, v.last_name, r.receipt_id, r.receipt
        FROM vendors v
        LEFT JOIN receipts r ON v.vendor_id = r.vendor_id";

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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vendor Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Issued Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stall #</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Receipt History</th>
                    </tr>
                  </thead>
                  <tbody id="dataTableBody">
        <?php foreach ($dataV as $row) { ?>
            <tr>
                <td>
                    <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']; ?></h6>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="avatar-group mt-1">
                        <h6 class="mb-1 text-sm"><?php echo $row['receipt_id']; ?></h6>
                    </div>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"><?php echo $row['vendor_id']; ?></span>
                </td>
                <td class="align-middle text-center text-sm">
                    <button type="button" class="btn btn-sm btn-primary my-1" data-bs-toggle="modal" data-bs-target="#openHistoryModal" data-receipts="<?php echo $row['receipt']; ?>">Show Receipts</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
                </table>
              </div>
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
            option.value = data.vendor_id;
            option.text = data.first_name + ' ' + data.middle_name + ' ' + data.last_name + ' (Stall: ' + data.receipt_id + ')';
            vendorSelect.appendChild(option);
        });
    }

    // Call the function to populate the vendor select dropdown
    const vendors = <?php echo json_encode($dataV); ?>;
    populateVendorSelect(vendors);

    // // Wait for the DOM to be fully loaded before running the script
    // document.addEventListener('DOMContentLoaded', function () {
    //     fetchData();
    // });
</script>




            </div>
          </div>
          
          <!-- Modal for viewing and updating payment details -->
          <div class="modal fade" id="paymentDetailsModal" tabindex="-1" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="paymentDetailsModalLabel">Payment Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div id="modalAlert" class="alert d-none" role="alert"></div>
                  <form id="paymentDetailsForm">
                    <div class="mb-3">
                      <label for="modalApplicantId" class="form-label">Applicant ID</label>
                      <input type="text" class="form-control" id="modalApplicantId" readonly>
                    </div>
                    <div class="mb-3">
                      <label for="modalVerifyStatus" class="form-label">Verify Status</label>
                      <select id="modalVerifyStatus" class="form-select">
                        <option value="Unconfirmed">Unconfirmed</option>
                        <option value="Verified">Verified</option>
                      </select>
                    </div>
                    <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="card mt-6">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Rent Applicants</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-user-circle text-warning" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">List of Rental Applicants Payment and Status</span> 
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
                fetch('populate_rentapp_payment.php')
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
           <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
           <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
           <script>
            document.addEventListener('DOMContentLoaded', function() {
            // Handle table row click
            document.getElementById('dataTableBodyReceipt').addEventListener('click', function(event) {
                if (event.target.closest('tr')) {
                    const row = event.target.closest('tr');
                    const cells = row.getElementsByTagName('td');
                    
                    // Extract data from the row
                    const applicantId = cells[0].textContent.trim();
                    const verifyStatus = cells[4].textContent.trim();

                    // Populate the modal with row data
                    document.getElementById('modalApplicantId').value = applicantId;
                    document.getElementById('modalVerifyStatus').value = verifyStatus;

                    // Show the modal
                    new bootstrap.Modal(document.getElementById('paymentDetailsModal')).show();
                }
            });

            // Handle save changes button click
            document.getElementById('saveChangesBtn').addEventListener('click', function() {
                const applicantId = document.getElementById('modalApplicantId').value.trim();
                const verifyStatus = document.getElementById('modalVerifyStatus').value.trim();

                if (!applicantId || !verifyStatus) {
                    showAlert('alert-danger', 'Applicant ID and Verify Status are required.');
                    return;
                }

                // Send an AJAX request to update verify_status
                fetch('verify_payment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ applicant_id: applicantId, verify_status: verifyStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('alert-success', 'Status Verified!');
                        setTimeout(() => {
                            // Optionally refresh the page or hide the modal
                            window.location.reload(); // Refresh page
                            // Alternatively, hide the modal
                            // new bootstrap.Modal(document.getElementById('paymentDetailsModal')).hide();
                        }, 1000);
                    } else {
                        showAlert('alert-danger', 'Failed to Verify Status: ' + data.message);
                    }
                })
                .catch(error => {
                    showAlert('alert-danger', 'An error occurred. Please try again.');
                    console.error('Error:', error);
                });
            });

            // Function to show alert message
            function showAlert(type, message) {
                const alertDiv = document.getElementById('modalAlert');
                alertDiv.className = `alert ${type}`;
                alertDiv.textContent = message;
                alertDiv.classList.remove('d-none');
            }
        });
           </script>

        </div>
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
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Receipt ID</th>
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
  function fetchReceiptHistory(receiptId) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_receipt_history.php?receipt_id=' + receiptId, true);
    xhr.onload = function() {
      if (xhr.status >= 200 && xhr.status < 300) {
        var data = JSON.parse(xhr.responseText);
        displayReceiptHistory(data);
      } else {
        console.error('Request failed with status ' + xhr.status);
      }
    };
    xhr.onerror = function() {
      console.error('Network error occurred');
    };
    xhr.send();
  }

  // Function to display receipt history data in the modal
  function displayReceiptHistory(data) {
    var tbody = document.getElementById('receiptHistoryBody');
    var html = '';
    
    data.forEach(function(row) {
      html += '<tr>';
      html += '  <td>' + row.date + '</td>';
      html += '  <td>' + row.receipt_id + '</td>';
      html += '  <td>';
      if (row.file_url) {
        html += '    <a href="' + row.file_url + '" target="_blank">View File</a>';
      } else {
        html += '    No File Available';
      }
      html += '  </td>';
      html += '</tr>';
    });
    
    tbody.innerHTML = html;
  }

  // Add event listener to the button to open the modal
  document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.querySelectorAll('[data-bs-target="#openHistoryModal"]');
    buttons.forEach(function(button) {
      button.addEventListener('click', function() {
        var receiptId = button.getAttribute('data-receipt-id');
        fetchReceiptHistory(receiptId);
      });
    });
  });
</script>


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
</body>

</html>