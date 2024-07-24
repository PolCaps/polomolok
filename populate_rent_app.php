<?php
                  header('Content-Type: application/json');
                  include('database_config.php');

                  // Create a connection
                  $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                  // Check connection
                  if ($conn->connect_error) {
                      die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
                  }

                  // Fetch data
                  $sql = "SELECT applicant_id, first_name, middle_name, last_name, contact_no, email, building_type, stall_no, address, rentapp_file, applied_date FROM rent_application";
                  $result = $conn->query($sql);

                  $data = [];

                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          $data[] = $row;
                      }
                  } else {
                      $data = ['message' => 'No records found'];
                  }

                  $conn->close();

                  // Output data in JSON format
                  echo json_encode($data);
?>