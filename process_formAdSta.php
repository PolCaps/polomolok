<?php
session_start();
require_once 'database_config.php'; // Include your database connection file

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception

                $account_type = $_POST['account_type'];
                $user = $_POST['username'];
                $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing password
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];
                $age = $_POST['age'];
                $contact_number = $_POST['contact_number'];
                $address = $_POST['address'];
                $stall_no = $_POST['stall_no'];
                $email_add = $_POST['email_add'];
                $building_type = $_POST['building_type'];
                $monthly_rentals = $_POST['monthly_rentals'];
                $building_floor = $_POST['building_floor'];
                $started_date = $_POST['started_date'];
                $end_date = $_POST['end_date'];

                // Handle file uploads
                $upload_dir = 'uploads/'; // Directory to save uploaded files
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $lease_agreements_path = $upload_dir . basename($_FILES['lease_agreements']['name']);
                $business_permits_path = $upload_dir . basename($_FILES['business_permits']['name']);
                $business_licenses_path = $upload_dir . basename($_FILES['business_licenses']['name']);
                $receipts_path = $upload_dir . basename($_FILES['receipts']['name']);

                move_uploaded_file($_FILES['lease_agreements']['tmp_name'], $lease_agreements_path);
                move_uploaded_file($_FILES['business_permits']['tmp_name'], $business_permits_path);
                move_uploaded_file($_FILES['business_licenses']['tmp_name'], $business_licenses_path);
                move_uploaded_file($_FILES['receipts']['tmp_name'], $receipts_path);

                // Insert data into vendors table
                $sql = "INSERT INTO vendors (account_type, username, password, first_name, middle_name, last_name, age, contact_number, address, stall_no, email_add, building_type, lease_agreements, business_permits, business_licenses, receipts, monthly_rentals, building_floor, started_date, end_date)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([$account_type, $user, $pass, $first_name, $middle_name, $last_name, $age, $contact_number, $address, $stall_no, $email_add, $building_type, $lease_agreements_path, $business_permits_path, $business_licenses_path, $receipts_path, $monthly_rentals, $building_floor, $started_date, $end_date]);

                // Success message
                $_SESSION['alert_class'] = 'alert-success';
                $_SESSION['alert_message'] = 'Vendor created successfully!';
                } catch (PDOException $e) {
                if ($e->getCode() == 23000) { // 23000 is the code for a duplicate entry
                    $_SESSION['alert_class'] = 'alert-danger';
                    $_SESSION['alert_message'] = 'Username already exists. Please choose a different username.';
                } else {
                    $_SESSION['alert_class'] = 'alert-danger';
                    $_SESSION['alert_message'] = 'An error occurred: ' . $e->getMessage();
                }
                }

                // Redirect back to the form page
                header('Location: AMvendor.php');
                exit();
                ?>