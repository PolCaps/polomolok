const togglePasswordAdminStaff = document.querySelector('#togglePasswordformAdminStaff');
const passwordAdminStaff = document.querySelector('#password');
togglePasswordAdminStaff.addEventListener('click', () => {
  const type = passwordAdminStaff.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordAdminStaff.setAttribute('type', type);
  togglePasswordAdminStaff.classList.toggle('bi-eye-fill');
});

const togglePasswordVendor = document.querySelector('#togglePasswordformVendor');
const passwordVendor = document.querySelector('#password');
togglePasswordVendor.addEventListener('click', () => {
  const type = passwordVendor.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordVendor.setAttribute('type', type);
  togglePasswordVendor.classList.toggle('bi-eye-fill');
});


function checkBuildingSelected() {
    var building = document.getElementById('building_type').value;
    if (!building) {
      alert('Please select a building first.');
      document.getElementById('building_type').focus();
      return false;
    }
    return true;
  }


  document.getElementById('account_type').addEventListener('change', function () {
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


  document.getElementById('building_type').addEventListener('change', function () {
    var building = this.value;
    var stallSelect = document.getElementById('stall_no');
    var floorSelect = document.getElementById('building_floor');
    var rent = document.getElementById('monthly_rentals');

    stallSelect.innerHTML = '<option value="">Select Stall</option>';
    floorSelect.innerHTML = '<option value="">Select Building Floor</option>';
    rent.value = '';

    if (building) {
      $.ajax({
        url: window.location.href,
        type: 'GET',
        data: { building: building },
        success: function (data) {
          var stalls = JSON.parse(data);
          var floors = new Set();

          stalls.forEach(function (stall) {
            if (stall.stall_status === 'Vacant' && !stall.vendor_id) {
              var option = document.createElement('option');
              option.value = stall.stall_no;
              option.text = stall.stall_no;
              stallSelect.appendChild(option);

              floors.add(stall.building_floor);
            }
          });

          floors.forEach(function (floor) {
            var option = document.createElement('option');
            option.value = floor;
            option.text = floor;
            floorSelect.appendChild(option);
          });
        }
      });
    }
  });

  document.getElementById('stall_no').addEventListener('change', function () {
    var stallNo = this.value;
    var building = document.getElementById('building_type').value;
    var rent = document.getElementById('monthly_rentals');

    if (stallNo && building) {
      $.ajax({
        url: window.location.href,
        type: 'GET',
        data: { building: building },
        success: function (data) {
          var stalls = JSON.parse(data);
          var selectedStall = stalls.find(stall => stall.stall_no === stallNo);

          if (selectedStall) {
            rent.value = selectedStall.monthly_rentals;
          } else {
            rent.value = '';
          }
        }
      });
    } else {
      rent.value = '';
    }
  });

  document.getElementById('building_floor').addEventListener('click', function () {
    if (!checkBuildingSelected()) {
      this.blur(); // Remove focus if building is not selected
    }
  });

  document.getElementById('stall_no').addEventListener('click', function () {
    if (!checkBuildingSelected()) {
      this.blur(); // Remove focus if building is not selected
    }
  });

  document.getElementById('monthly_rentals').addEventListener('click', function () {
    if (!checkBuildingSelected()) {
      this.blur(); // Remove focus if building is not selected
    }
  });

  $(document).ready(function () {
    $('#submit').on('click', function (e) {
      e.preventDefault(); // Prevent default form submission

      var buildingType = $('#building_type').val();
      var stallNo = $('#stall_no').val();
      var monthlyRentals = $('#monthly_rentals').val();
      var startedDate = $('#started_date').val();
      var endDate = $('#end_date').val();

      $.ajax({
        url: 'process_formVendor.php', // The server-side script URL
        type: 'POST',
        data: {
          building_type: buildingType,
          stall_no: stallNo,
          monthly_rentals: monthlyRentals,
          started_date: startedDate,
          end_date: endDate
        },
        success: function (response) {
          var result = JSON.parse(response);
          if (result.status === 'success') {
            alert(result.message);
          } else {
            alert(result.message);
          }
        },
        error: function () {
          alert('An error occurred while processing the request.');
        }
      });
    });
  });


  