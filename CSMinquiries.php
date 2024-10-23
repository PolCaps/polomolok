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
          <a class="nav-link " href="CustomerService.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="CSMinquiries.php">
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
          <a class="nav-link " href="CSMarchivedinquiries.php">
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

    <button class="btn btn-primary" id="archiveBtn">Archive Selected</button>
    <button class="btn btn-danger" id="deleteBtn">Delete Selected</button>

    <div class="row my-4">
        <div class="col-lg-11 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6 class="text-info">Inquiries</h6>
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
                                        <input type="checkbox" id="select-all" onclick="toggleSelectAll(this)">
                                        <span class="px-1 py-2">Select All</span>
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Inquiry ID</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email Address</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Message</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sent Date</th>
                                </tr>
                            </thead>
                            <tbody id="data-table"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Inquiry Details -->
    <div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inquiryModalLabel">Inquiry Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                <form id="replyForm">
                    <div class="mb-3">
                        <label for="modalInquiryId" class="form-label">Inquiry ID</label>
                        <input type="text" class="form-control" id="modalInquiryId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modalName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="modalName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modalEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="modalEmail" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modalSubject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="modalSubject" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modalMessage" class="form-label">Message</label>
                        <textarea class="form-control" id="modalMessage" rows="4" readonly></textarea>
                    </div>
                    <hr>
                   
                        <div class="mb-3">
                            <label for="replyInput" class="form-label">Reply</label>
                            <textarea class="form-control" id="replyInput" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fetch and populate the inquiries table
        document.addEventListener('DOMContentLoaded', function () {
            fetch('get_inquiries.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById("data-table");
                    tableBody.innerHTML = ''; // Clear existing content

                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach(inquiry => {
                            const row = document.createElement("tr");
                            
                            // Checkbox for each row
                            const checkboxCell = document.createElement("td");
                            checkboxCell.className = "text-center";
                            checkboxCell.innerHTML = `<input type="checkbox" class="inquiry-checkbox" value="${inquiry.inq_id}">`;
                            row.appendChild(checkboxCell);

                            const idCell = document.createElement("td");
                            idCell.innerHTML = `<div class="text-center text-xs font-weight-bold mb-0">${inquiry.inq_id}</div>`;
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
                            messageCell.className = 'text-center text-xs font-weight-bold mb-0 message';
                            messageCell.innerHTML = `${inquiry.message.substring(0, 50)}...`;
                            row.appendChild(messageCell);

                            const statusCell = document.createElement("td");
                            statusCell.innerHTML = `<div class="text-center text-xs font-weight-bold mb-0">${inquiry.status}</div>`;
                            row.appendChild(statusCell);

                            const dateCell = document.createElement("td");
                            dateCell.className = 'text-center text-xs font-weight-bold mb-0';
                            dateCell.innerHTML = inquiry.sent_date;
                            row.appendChild(dateCell);

                            row.addEventListener('click', function() {
                                document.getElementById("modalInquiryId").value = inquiry.inq_id;
                                document.getElementById("modalName").value = inquiry.name;
                                document.getElementById("modalEmail").value = inquiry.email_add;
                                document.getElementById("modalSubject").value = inquiry.subject;
                                document.getElementById("modalMessage").value = inquiry.message;

                                const prefillReply = `Hello ${inquiry.name}! Thank you for reaching out to us. To reply to your question: [Specific].`;
                                document.getElementById("replyInput").value = prefillReply;

                                const modal = new bootstrap.Modal(document.getElementById('inquiryModal'));
                                modal.show();
                            });

                            tableBody.appendChild(row);
                        });
                    } else {
                        const row = document.createElement("tr");
                        const cell = document.createElement("td");
                        cell.colSpan = 9;
                        cell.className = 'text-center text-xs font-weight-bold mb-0';
                        cell.innerHTML = 'No inquiries found';
                        row.appendChild(cell);
                        tableBody.appendChild(row);
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        });

        function toggleSelectAll(source) {
            const checkboxes = document.querySelectorAll('.inquiry-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }

        // Event listener for the "Archive Selected" button
        document.getElementById("archiveBtn").addEventListener("click", function () {
            const selectedIds = [];
            document.querySelectorAll('input.inquiry-checkbox:checked').forEach(checkbox => {
                selectedIds.push(checkbox.value);
            });

            if (selectedIds.length > 0) {
                const idString = selectedIds.join(',');
                window.location.href = `CSMarchivedinquiries.php?ids=${idString}`;
            } else {
                alert("Please select at least one inquiry to archive.");
            }
        });

        // Event listener for the "Delete Selected" button
        document.getElementById("deleteBtn").addEventListener("click", function () {
            const selectedIds = [];
            document.querySelectorAll('input.inquiry-checkbox:checked').forEach(checkbox => {
                selectedIds.push(checkbox.value);
            });

            if (selectedIds.length > 0) {
                const confirmDelete = confirm("Are you sure you want to delete these inquiries?");
                if (confirmDelete) {
                    fetch('delete_inquiries.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ ids: selectedIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Reload to update the table
                        } else {
                            alert("Failed to delete inquiries. Please try again.");
                        }
                    })
                    .catch(error => console.error('Error deleting inquiries:', error));
                }
            } else {
                alert("Please select at least one inquiry to delete.");
            }
        });

     // Handle reply form submission
      document.getElementById("replyForm").addEventListener("submit", function(event) {
          event.preventDefault(); // Prevent the default form submission behavior
          const inquiryId = document.getElementById("modalInquiryId").value; // Get inquiry ID here
          const emailAdd = document.getElementById("modalEmail").value; 
          const subject = document.getElementById("modalSubject").value; 
          const replyMessage = document.getElementById("replyInput").value;

          fetch('phpMailer/send_reply.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
              },
              body: JSON.stringify({ id: inquiryId, email: emailAdd, emailsubject: subject, message: replyMessage })
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  showToastModal("Success", "Reply sent successfully.");
                  setTimeout(() => {
                      window.location.reload();
                  }, 3000);
              } else {
                  showToastModal("Error", "Failed to send reply: " + (data.message || 'Please try again.'));
              }
          })
          .catch(error => {
              showToastModal("Error", "An error occurred while sending the reply.");
              console.error('Error sending reply:', error);
          });
      });



// Function to show the modal acting like a toast
function showToastModal(title, message) {
    const toastModalElement = document.getElementById('toastModal');
    const toastModalTitle = document.getElementById('toastModalTitle');
    const toastModalBody = document.getElementById('toastModalBody');

    // Set the title and message for the toast-like modal
    toastModalTitle.textContent = title;
    toastModalBody.textContent = message;

    // Show the modal
    const toastModal = new bootstrap.Modal(toastModalElement, {
        backdrop: false // Remove backdrop
    });
    toastModal.show();

    // Automatically hide the modal after 3 seconds
    setTimeout(function() {
        toastModal.hide();
    }, 3000); // 3 seconds
}

    </script>
    <style>
    .modal-dialog-bottom-end {
    position: fixed;
    bottom: 1rem;
    right: 2rem;
    margin: 0;
    max-width: 300px;
    max-height: 150px; 
    z-index: 1055;
}

.modal-content {
    padding: 10px; /* Add some padding to the modal content */
    border-radius: 5px; /* Optional: round the corners */
}
    </style>
<!-- Modal acting like a toast -->
<div class="modal fade" id="toastModal" tabindex="-1" aria-labelledby="toastModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-bottom-end">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="toastModalTitle">Notification</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="toastModalBody">
                <span>This is body</span>
            </div>
        </div>
    </div>
</div>
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

</body>

</html>