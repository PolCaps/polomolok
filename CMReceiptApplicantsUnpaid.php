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
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-list"
          viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg>
        <span class="ms-2 font-weight-bold">Menu</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="Cashier.php">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-shop"
                viewBox="0 0 16 16">
                <path
                  d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        
        <li class="nav-item">
  <a class="nav-link collapsed active" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReceipt"
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
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-file-earmark-richtext" viewBox="0 0 16 16">
                <path
                  d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                <path
                  d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m1.639-3.708 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V8.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8s1.54-1.274 1.639-1.208M6.25 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5" />
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
          <img src="image/profile.jpg" alt="profile"
            style="min-width: 20px; min-height: 20px; height: 100px; width: 100px; border-radius: 10px; margin-left: 40px;">
          <h5 class="text-center">
            <?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['middle_name']) . ' ' . htmlspecialchars($user['last_name']); ?>
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Cashier</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Modules</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Vendor Approvals</h6>
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
            <?php 
            include('Notification/CashierNotif.php');
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

      <div class="container-fluid py-4">

          <!-- Modal for viewing and updating payment details -->
          <div class="modal fade" id="paymentDetailsModal" tabindex="-1" aria-labelledby="paymentDetailsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentDetailsLabel">Payment Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="paymentDetailsForm">
          <!-- Applicant ID -->
          <div class="mb-3">
            <label for="modalApplicantId" class="form-label">Applicant's ID</label>
            <input type="text" class="form-control" id="modalApplicantId" readonly>
          </div>

          <!-- Full Name (First, Middle, Last) -->
          <div class="mb-3">
            <label for="modalFirstName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="modalFirstName" readonly>
          </div>

          <!-- Payment Status -->
          <div class="mb-3">
            <label for="modalPaymentStatus" class="form-label">Payment Status</label>
            <select id="modalPaymentStatus" class="form-select">
              <option value="Unpaid">Unpaid</option>
              <option value="Paid">Paid</option>
            </select>
          </div>

          <!-- Proof of Payment -->
          <div class="mb-3">
            <label for="modalProofOfPayment" class="form-label">Proof of Payment</label>
            <input type="file" class="form-control" id="modalProofOfPayment">
          </div>

          <!-- OR Number -->
          <div class="mb-3">
            <label for="modalORNumber" class="form-label">OR Number</label>
            <input type="text" class="form-control" id="modalORNumber">
          </div>

          <div class="mb-3">
            <label for="modalPaymentDate" class="form-label">Payment Date</label>
            <input type="datetime-local" id="modalPaymentDate" name="modalPaymentDate" class="form-control" required>
          </div>

          <input type="hidden" id="email">
          <!-- Save Button -->
          <button type="button" class="btn btn-primary" id="saveChangesBtn">Save and Notify</button>
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
                      <input type="text" class="form-control px-1" id="searchInput" placeholder="Search for...">

                      <script>
                        document.getElementById('searchInput').addEventListener('keyup', function() {
                            var filter = this.value.toLowerCase();
                            var rows = document.querySelectorAll('#dataTableBodyReceipt tr');

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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Applicant ID</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Full Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email Address</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Proof Of Payment</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Official Reciept No.</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Date</th>
                    </tr>
                  </thead>
                  <tbody id="dataTableBodyReceipt">
                  
                </tbody>
                </table>
              </div>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
    fetch('populate_rentapp_paymentUnpaid.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('dataTableBodyReceipt');
            tableBody.innerHTML = ''; 
            
            if (data.success) {
                if (data.data.length > 0) {
                    data.data.forEach(item => {
                        const row = document.createElement('tr');
                        
                        row.innerHTML = `
                            <td class="text-center">
                                <div class="avatar-group mt-1">
                                    <h6 class="text-xs text-center">${item.applicant_id}</h6>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="avatar-group mt-1">
                                    <h6 class="text-xs text-center">
                                        ${item.first_name} ${item.middle_name ? item.middle_name + ' ' : ''}${item.last_name}
                                    </h6>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="avatar-group mt-1">
                                    <h6 class="text-xs text-center">${item.email || 'N/A'}</h6>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="avatar-group mt-1">
                                    <h6 class="text-xs text-center">${item.payment_status || 'N/A'}</h6>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="avatar-group mt-1">
                                    <h6 class="text-xs text-center">${item.proof_of_payment || 'N/A'}</h6>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="avatar-group mt-1">
                                    <h6 class="text-xs text-center">${item.OR_no || 'N/A'}</h6>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="avatar-group mt-1">
                                    <h6 class="text-xs text-center">${item.payment_date || 'N/A'}</h6>
                                </div>
                            </td>
                        `;
                        
                        tableBody.appendChild(row);
                    });
                } else {
                    // No applicants found, add a message row
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td colspan="9" class="text-center">
                            <h6 class="text-xs text-center">No Approved Rent Applicants Available.</h6>
                        </td>
                    `;
                    tableBody.appendChild(row);
                }
            } else {
                console.error('Failed to fetch data:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
});
          </script>

           <script>
           document.addEventListener('DOMContentLoaded', function () {
    // Handle table row click to populate the modal
    document.getElementById('dataTableBodyReceipt').addEventListener('click', function (event) {
        if (event.target.closest('tr')) {
            const row = event.target.closest('tr');
            const cells = row.getElementsByTagName('td');

            // Extract data from the row
            const applicantId = cells[0].textContent.trim();
            const fullName = cells[1].textContent.trim(); // Assuming full name is in cell[1]
            const email = cells[2].textContent.trim(); // Assuming full name is in cell[1]
            const paymentStatus = cells[3].textContent.trim(); // Assuming payment status is in cell[2]

            // Populate modal fields
            document.getElementById('modalApplicantId').value = applicantId;
            document.getElementById('modalFirstName').value = fullName;
            document.getElementById('modalPaymentStatus').value = paymentStatus;
            document.getElementById('email').value = email;

            // Show the modal
            new bootstrap.Modal(document.getElementById('paymentDetailsModal')).show();
        }
    });

    // Handle form submission and file upload
    document.getElementById('saveChangesBtn').addEventListener('click', function () {
        const applicantId = document.getElementById('modalApplicantId').value.trim();
        const applicantName = document.getElementById('modalFirstName').value.trim();
        const email = document.getElementById('email').value;
        const paymentStatus = document.getElementById('modalPaymentStatus').value;
        const proofOfPayment = document.getElementById('modalProofOfPayment').files[0]; // File input
        const ORNumber = document.getElementById('modalORNumber').value.trim();
        const paymentDate = document.getElementById('modalPaymentDate').value;

        // Validate required fields
        if (!applicantId || !paymentStatus) {
            alert('Applicant ID and Payment Status are required.');
            return;
        }

        // Create FormData object to send file and form data
        const formData = new FormData();
        formData.append('applicant_id', applicantId);
        formData.append('applicant_name', applicantName);
        formData.append('email', email);
        formData.append('payment_status', paymentStatus);
        if (proofOfPayment) {
            formData.append('proof_of_payment', proofOfPayment);
        }
        formData.append('OR_no', ORNumber);
        formData.append('payment_date', paymentDate);

        // Send the AJAX request
        fetch('phpMailer/verify_payment.php', {
            method: 'POST',
            body: formData // FormData handles multipart/form-data automatically
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Payment details updated successfully.');
                location.reload(); // Reload the page after successful submission
            } else {
                alert('Failed to update payment details: ' + data.message);
            }
        })
        .catch(error => {
            alert('An error occurred. Please try again.');
            console.error('Error:', error);
        });
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
        <a class="btn bg-gradient-info w-85 text-white mx-4" href="">Edit Profile</a>
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