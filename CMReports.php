<?php
include('Sessions/Cashier.php');
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
          <a class="nav-link active" href="CMReports.php">
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
        <a class="nav-link collapsed" href="#"  data-bs-toggle="collapse" data-bs-target="#collapsePayRem">
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
          <h6 class="font-weight-bolder mb-0">Reports</h6>
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


        <?php
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    echo "<script>alert('Connection failed: " . addslashes($conn->connect_error) . "');</script>";
    exit;
}

// Initialize variables with default values
$totalPayments = 0;
$inquiryCount = 0;
$rentAppCount = 0;
$activeVendorsCount = 0;

// Get total payments
$queryPayments = "SELECT SUM(totalPay) AS totalPayments FROM receipts WHERE MONTH(issued_date) = MONTH(CURRENT_DATE) AND YEAR(issued_date) = YEAR(CURRENT_DATE)";
$resultPayments = $conn->query($queryPayments);
if ($resultPayments) {
    $totalPayments = $resultPayments->fetch_assoc()['totalPayments'] ?? 0;
} else {
    echo "<script>alert('Error fetching total payments: " . addslashes($conn->error) . "');</script>";
}

// Get inquiries count
$queryInquiries = "SELECT COUNT(*) AS inquiry_count FROM inquiry WHERE MONTH(sent_date) = MONTH(CURRENT_DATE) AND YEAR(sent_date) = YEAR(CURRENT_DATE)";
$resultInquiries = $conn->query($queryInquiries);
if ($resultInquiries) {
    $inquiryCount = $resultInquiries->fetch_assoc()['inquiry_count'] ?? 0;
} else {
    echo "<script>alert('Error fetching inquiries: " . addslashes($conn->error) . "');</script>";
}

// Get rent applications count
$queryRentApps = "SELECT COUNT(*) AS rent_app_count FROM rent_application WHERE MONTH(applied_date) = MONTH(CURRENT_DATE) AND YEAR(applied_date) = YEAR(CURRENT_DATE)";
$resultRentApps = $conn->query($queryRentApps);
if ($resultRentApps) {
    $rentAppCount = $resultRentApps->fetch_assoc()['rent_app_count'] ?? 0;
} else {
    echo "<script>alert('Error fetching rent applications: " . addslashes($conn->error) . "');</script>";
}

// Get active vendors count
$queryActiveVendors = "SELECT COUNT(*) AS active_vendors_count FROM vendors WHERE Vendor_Status = 'ACTIVE'";
$resultActiveVendors = $conn->query($queryActiveVendors);
if ($resultActiveVendors) {
    $activeVendorsCount = $resultActiveVendors->fetch_assoc()['active_vendors_count'] ?? 0;
} else {
    echo "<script>alert('Error fetching active vendors: " . addslashes($conn->error) . "');</script>";
}

// Get relocation request details (no vendor_id filtering)
$queryRelocationReq = "
    SELECT reason, relocation_date, approval_date, maintenance_description 
    FROM relocation_req";
$resultRelocation = $conn->query($queryRelocationReq);

$relocationRequests = [];
if ($resultRelocation) {
    while ($row = $resultRelocation->fetch_assoc()) {
        $relocationRequests[] = $row;
    }
} else {
    echo "<script>alert('Error fetching relocation requests: " . addslashes($conn->error) . "');</script>";
}

// Get rent application details (no vendor_id filtering)
$queryRentAppDetails = "
    SELECT first_name, middle_name, last_name, commodities, applied_date 
    FROM rent_application";
$resultRentApp = $conn->query($queryRentAppDetails);

$rentApplications = [];
if ($resultRentApp) {
    while ($row = $resultRentApp->fetch_assoc()) {
        $rentApplications[] = $row;
    }
} else {
    echo "<script>alert('Error fetching rent applications: " . addslashes($conn->error) . "');</script>";
}

// Close the database connection
$conn->close();
?>



<div class="card-body px-0 pb-2">
    <div class="table-responsive">
        <h2 class="text-center">Monthly Report Summary</h2>
        <form id="pdfForm" method="POST" enctype="multipart/form-data" action="MonthlyReports.php">
            <input type="hidden" name="pdf" id="pdfBase64Input">
            <button type="button" class="btn btn-primary" id="generateReportBtn">Generate Report</button>
        </form>
        <table id="reportTable" class="table align-items-center mb-0">
            <thead class="thead-light">
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-sm">Total Payments</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?php echo number_format($totalPayments, 2); ?></h6>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-sm">Total Inquiries</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?php echo $inquiryCount; ?></h6>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-sm">Total Rent Applications</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?php echo $rentAppCount; ?></h6>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-sm">Active Vendors</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?php echo $activeVendorsCount; ?></h6>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <h2 class="text-center mt-4">Relocation Requests</h2>
        <table id="relocationTable" class="table align-items-center mb-0">
            <thead class="thead-light">
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reason</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Relocation Date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Approval Date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Maintenance Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($relocationRequests as $request): ?>
                <tr>
                    <td><?php echo htmlspecialchars($request['reason']); ?></td>
                    <td><?php echo htmlspecialchars($request['relocation_date']); ?></td>
                    <td><?php echo htmlspecialchars($request['approval_date']); ?></td>
                    <td><?php echo htmlspecialchars($request['maintenance_description']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="text-center mt-4">Rent Applications</h2>
        <table id="rentAppTable" class="table align-items-center mb-0">
            <thead class="thead-light">
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Middle Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commodities</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Applied Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rentApplications as $application): ?>
                <tr>
                    <td><?php echo htmlspecialchars($application['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($application['middle_name']); ?></td>
                    <td><?php echo htmlspecialchars($application['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($application['commodities']); ?></td>
                    <td><?php echo htmlspecialchars($application['applied_date']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTables
    $('#reportTable').DataTable();
    $('#relocationTable').DataTable();
    $('#rentAppTable').DataTable();
});
</script>



<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
$(document).ready(function() {
    document.getElementById("generateReportBtn").addEventListener("click", async function() {
        console.log("Generate Report Button Clicked");

        // Create a new instance of jsPDF
        const { jsPDF } = window.jspdf;
        let pdf = new jsPDF("p", "pt", "a4");

        // Get the current date and extract the month
        const date = new Date();
        const options = { month: 'long' }; // Options for month formatting
        const currentMonth = date.toLocaleDateString('en-US', options);

        // Set up the title
        pdf.setFontSize(12);
        pdf.text(`MONTHLY REPORT FOR THIS MONTH OF ${currentMonth.toUpperCase()}`, 40, 40);
        console.log("Title added to PDF");

        // Additional header details
        pdf.setFontSize(10);
        pdf.text("POLOMOLOK PUBLIC MARKET REPORTS", 40, 60);
        console.log("Header details added to PDF");

        const headings = [
            "Republic of the Philippines",
            "Province of South Cotabato",
            "MUNICIPALITY OF POLOMOLOK",
            "MUNICIPAL ECONOMIC ENTERPRISES & DEVELOPMENT OFFICE (Market Operation)"
        ];
        headings.forEach((text, index) => {
            const yPosition = 80 + (index * 12);
            const textWidth = pdf.getTextWidth(text);
            const x = (pdf.internal.pageSize.getWidth() - textWidth) / 2;
            pdf.text(text, x, yPosition);
            console.log(`Heading added: ${text}`);
        });

        // Line separator
        pdf.line(40, 130, pdf.internal.pageSize.getWidth() - 40, 130);
        console.log("Line separator added");

        // Function to draw a table manually
        function drawTable(startY, title, headers, data) {
            let pdfYPosition = startY;
            pdf.setFontSize(10);
            pdf.text(title, 20, pdfYPosition);
            pdfYPosition += 20;

            // Draw headers
            const headerWidths = [120, 100, 100, 150];
            headers.forEach((header, index) => {
                pdf.text(header, 40 + headerWidths.slice(0, index).reduce((a, b) => a + b, 0), pdfYPosition);
            });
            pdfYPosition += 20;

            // Draw separator line
            pdf.line(40, pdfYPosition, pdf.internal.pageSize.getWidth() - 40, pdfYPosition);
            pdfYPosition += 10;

            // Draw data rows
            data.forEach(row => {
                row.forEach((cell, index) => {
                    pdf.text(cell, 30 + headerWidths.slice(0, index).reduce((a, b) => a + b, 0), pdfYPosition);
                });
                pdfYPosition += 15;
            });

            return pdfYPosition + 15;
        }

        // Extract and add report table data
        const reportTable = document.getElementById("reportTable");
        if (!reportTable) {
            console.error("Table with ID 'reportTable' not found.");
            alert("Error: Report table not found.");
            return;
        }

        let reportData = Array.from(reportTable.rows).slice(1).map(row => {
            const cells = row.cells;
            return [cells[0].innerText.trim(), cells[1].innerText.trim()];
        });

        let pdfYPosition = drawTable(140, "Report Data", ["Column 1", "Column 2"], reportData);

        // Extract and add relocation requests table data
        const relocationTable = document.getElementById("relocationTable");
        if (!relocationTable) {
            console.error("Table with ID 'relocationTable' not found.");
            alert("Error: Relocation table not found.");
            return;
        }

        let relocationData = Array.from(relocationTable.rows).slice(1).map(row => {
            const cells = row.cells;
            return [
                cells[0].innerText.trim(),
                cells[1].innerText.trim(),
                cells[2].innerText.trim(),
                cells[3].innerText.trim()
            ];
        });

        pdfYPosition = drawTable(pdfYPosition, "Relocation Requests", ["Reason", "Relocation Date", "Approval Date", "Maintenance Description"], relocationData);

        // Extract and add rent applications table data
        const rentAppTable = document.getElementById("rentAppTable");
        if (!rentAppTable) {
            console.error("Table with ID 'rentAppTable' not found.");
            alert("Error: Rent Applications table not found.");
            return;
        }

        let rentAppData = Array.from(rentAppTable.rows).slice(1).map(row => {
            const cells = row.cells;
            return [
                cells[0].innerText.trim(),
                cells[1].innerText.trim(),
                cells[2].innerText.trim(),
                cells[3].innerText.trim(),
                cells[4].innerText.trim()
            ];
        });

        pdfYPosition = drawTable(pdfYPosition, "Rent Applications", ["First Name", "Middle Name", "Last Name", "commodities", "Date"], rentAppData);

        console.log("PDF saved as Monthly_Report.pdf");
        pdf.save(`Monthly_Reports${currentMonth.toUpperCase()}.pdf`);

        // Generate PDF as Base64
        const pdfBase64 = pdf.output('datauristring').split(',')[1]; // Remove the data header

        // Insert the Base64 string into the hidden input
        document.getElementById("pdfBase64Input").value = pdfBase64;

        // Submit the form
        document.getElementById("pdfForm").submit();


        
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