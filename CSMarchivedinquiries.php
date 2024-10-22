<?php
include('Sessions/CustomerService.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets2/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/imgbg/BGImage.png">
  <title>
    Customer Service
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
          <a class="nav-link" href="CustomerService.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="CSMinquiries.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
              <path d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
            </svg>
            </div>
            <span class="nav-link-text ms-1">Inquiries</span>
          </a> 
        </li>
        <br>
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Archives</h6>
        <li class="nav-item">
          <a class="nav-link active" href="CSMarchivedinquiries.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
              <path d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
            </svg>
            </div>
            <span class="nav-link-text ms-1">Archived Inquiries</span>
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Customer Service</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Module</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Inquiries</h6>
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
                <span class="d-sm-inline d-none">Customer Service</span>
              </a>
            </li>
            <?php 
            include('Notification/CustomerServiceNotif.php');
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

    <button class="btn btn-danger" id="deleteBtn">Delete Selected</button>

    <?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

$sql = "SELECT name, email_add, subject, message, sent_date FROM archived_inquiries";

if ($start_date && $end_date) {
    $sql .= " WHERE sent_date BETWEEN '$start_date' AND '$end_date'";
}

$result = $conn->query($sql);
?>
<?php
// Include your database configuration file
include('database_config.php');

// Create a connection using mysqli
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize a variable to hold alert messages
$alertMessage = '';

// Check if the 'ids' parameter is present in the URL
if (isset($_GET['ids'])) {
    // Get the comma-separated list of inquiry IDs
    $ids = $_GET['ids'];

    // Convert the string of IDs into an array
    $inquiryIds = explode(',', $ids);

    // Convert each ID to an integer (sanitize the input to prevent SQL injection)
    $inquiryIds = array_map('intval', $inquiryIds);

    // Convert the array back to a comma-separated string for the SQL query
    $idString = implode(',', $inquiryIds);

    // Step 1: Use INSERT IGNORE to avoid duplicates in the archived_inquiries table
    $copyQuery = "INSERT IGNORE INTO archived_inquiries (inquiry_id, name, email_add, subject, message, sent_date)
                  SELECT inq_id, name, email_add, subject, message, sent_date 
                  FROM inquiry 
                  WHERE inq_id IN ($idString)";

    // Execute the copy query
    if ($conn->query($copyQuery) === TRUE) {
        // Step 2 (Optional): Delete the inquiries from the original table after copying
        $deleteQuery = "DELETE FROM inquiry WHERE inq_id IN ($idString)";
        
        // Execute the delete query
        if ($conn->query($deleteQuery) === TRUE) {
            $toastMessage = "Inquiries archived successfully!";
        } else {
          $toastMessage = "Error deleting inquiries: " . $conn->error;
        }
    } else {
      $toastMessage = "Error copying inquiries: " . $conn->error;
    }
} else {
  $toastMessage = "";
}

// Close the connection
$conn->close();
?>


<div id="alertMessage" class="alert alert-dismissible fade show" role="alert" style="display: none;">
    <strong id="alertTitle"></strong> <span id="alertBody"></span>
    <button type="button" class="btn-close" onclick="document.getElementById('alertMessage').style.display='none'"></button>
</div>
<div class="toast-container position-fixed top-0 end-0 p-3" id="toastNotif">
        <?php if (!empty($toastMessage)): ?>
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="2000" id="toastNotif">
                <div class="toast-header">
                    <strong class="me-auto info">Notification</strong>
                    <button type="button" class="btn-close bg-info" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php echo $toastMessage; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script>
    // Function to auto-dismiss the toast after 2 seconds
    $(document).ready(function() {
        const toastElement = $('#toastNotif');
        if (toastElement.length) {
            toastElement.toast('show'); // Show the toast immediately
            setTimeout(function() {
                toastElement.toast('hide');
            }, 2000); // Auto-dismiss after 2 seconds
        }
    });
</script>

<div class="row my-4">
    <div class="col-lg-11 col-md-6 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6 class="text-info">Inquiries</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4 mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar2-week" viewBox="0 0 16 16" id="filterDate" data-bs-toggle="dropdown" aria-expanded="false">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="filterDate">
                                <li><a class="dropdown-item border-radius-md" href="javascript:;" onclick="filterByDate('today')">Today</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;" onclick="filterByDate('week')">This Week</a></li>
                                <li><a class="dropdown-item border-radius-md" href="javascript:;" onclick="filterByDate('month')">This Month</a></li>
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

                                    document.getElementById('customStartDate').value = startDate;
                                    document.getElementById('customEndDate').value = endDate;
                                    document.getElementById('customDateForm').submit();
                                }

                                function submitCustomDateForm() {
                                    document.getElementById('customDateForm').submit();
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <style>
            .message {
                max-width: 200px; /* Set the maximum width for the message */
                overflow: hidden; /* Hide the overflowed content */
                text-overflow: ellipsis; /* Add the ellipsis for overflowed content */
                white-space: nowrap; /* Prevent text from wrapping to the next line */
            }
            </style>

<div class="card-body px-0 pb-2">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        <input type="checkbox" id="select-all" onclick="toggleSelectAll(this)"><span class="px-1 py-2">Select All</span>
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Inquiry ID</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email Address</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Message</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sent Date</th>
                </tr>
            </thead>
            <tbody id="data-table"></tbody>
        </table>
    </div>

    <script>
        // Fetch and populate the inquiries table
      document.addEventListener('DOMContentLoaded', function () {
          fetch('get_archivedinquiries.php')
              .then(response => {
                  if (!response.ok) {
                      throw new Error('Network response was not ok');
                  }
                  return response.json();
              })
              .then(data => {
                  const tableBody = document.getElementById("data-table");
                  tableBody.innerHTML = ''; // Clear existing content

                  if (data.error) {
                      const row = document.createElement("tr");
                      const cell = document.createElement("td");
                      cell.colSpan = 7; // Adjust based on the number of columns
                      cell.className = 'text-center text-xs font-weight-bold mb-0';
                      cell.innerHTML = data.error; // Display error if present
                      row.appendChild(cell);
                      tableBody.appendChild(row);
                      return; // Stop further execution
                  }

                  if (Array.isArray(data) && data.length > 0) {
                      data.forEach(inquiry => {
                          const row = document.createElement("tr");

                          // Checkbox for each row
                          const checkboxCell = document.createElement("td");
                          checkboxCell.className = "text-center";
                          checkboxCell.innerHTML = `<input type="checkbox" class="inquiry-checkbox" value="${inquiry.inquiry_id}">`;
                          row.appendChild(checkboxCell);

                          const idCell = document.createElement("td");
                          idCell.innerHTML = `<div class="text-center text-xs font-weight-bold mb-0">${inquiry.inquiry_id}</div>`;
                          row.appendChild(idCell);

                          const nameCell = document.createElement("td");
                          nameCell.innerHTML = `<div class="text-center text-xs font-weight-bold mb-0">${inquiry.name}</div>`;
                          row.appendChild(nameCell);

                          const emailCell = document.createElement("td");
                          emailCell.innerHTML = `<div class="text-center text-xs font-weight-bold mb-0">${inquiry.email_add}</div>`;
                          row.appendChild(emailCell);

                          const subjectCell = document.createElement("td");
                          subjectCell.innerHTML = `<div class="text-center text-xs font-weight-bold mb-0">${inquiry.subject}</div>`;
                          row.appendChild(subjectCell);

                          const messageCell = document.createElement("td");
                          messageCell.className = 'text-center text-xs font-weight-bold mb-0';
                          messageCell.innerHTML = `${inquiry.message.substring(0, 50)}...`;
                          row.appendChild(messageCell);

                          const dateCell = document.createElement("td");
                          dateCell.className = 'text-center text-xs font-weight-bold mb-0';
                          dateCell.innerHTML = inquiry.sent_date;
                          row.appendChild(dateCell);

                          tableBody.appendChild(row);
                      });
                  } else {
                      const row = document.createElement("tr");
                      const cell = document.createElement("td");
                      cell.colSpan = 7; // Adjust based on the number of columns
                      cell.className = 'text-center text-xs font-weight-bold mb-0';
                      cell.innerHTML = 'No inquiries found';
                      row.appendChild(cell);
                      tableBody.appendChild(row);
                  }
              })
              .catch(error => {
                  console.error('Error fetching data:', error);
              });
      });

      function toggleSelectAll(source) {
          const checkboxes = document.querySelectorAll('.inquiry-checkbox');
          checkboxes.forEach(checkbox => {
              checkbox.checked = source.checked;
          });
      }

      document.getElementById("deleteBtn").addEventListener("click", function () {
          const selectedIds = [];
          document.querySelectorAll('input.inquiry-checkbox:checked').forEach(checkbox => {
              selectedIds.push(checkbox.value);
          });

          if (selectedIds.length > 0) {
              if (confirm("Are you sure you want to delete the selected inquiries? This action cannot be undone.")) {
                  // Send delete request using fetch
                  fetch('delete_inquiriesarchive.php', {
                      method: 'POST',
                      headers: {
                          'Content-Type': 'application/json',
                      },
                      body: JSON.stringify({ ids: selectedIds })
                  })
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('Network response was not ok');
                      }
                      return response.json();
                  })
                  .then(data => {
                      if (data.success) {
                          alert("Inquiries deleted successfully!");
                          // Reload the table to reflect changes
                          location.reload();
                      } else {
                          alert("Error deleting inquiries: " + data.message);
                      }
                  })
                  .catch(error => {
                      console.error('Error:', error);
                      alert("An error occurred while deleting inquiries.");
                  });
              }
          } else {
            alert("Please select at least one inquiry to delete.");
          }
      });
    </script>
</div>
        </div>
    </div>
  </div>
    </div>
      

    </div>
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="messageModalLabel">Message Details</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <p id="messageContent"></p>
                      </div>
                  </div>
              </div>
          </div>
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const messageModal = document.getElementById('messageModal');
            messageModal.addEventListener('show.bs.modal', (event) => {
                const button = event.relatedTarget; // Button that triggered the modal
                const message = button.getAttribute('data-message'); // Extract info from data-* attributes
                const modalBody = messageModal.querySelector('.modal-body #messageContent');
                modalBody.textContent = message; // Update the modal's content.
            });
        });
    </script>
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