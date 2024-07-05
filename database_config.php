<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'polomolokmarket';


$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
                      
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// $db_host = 'polomolokpublicmarket';
// $db_user = 'nvhsudih_admin';
// $db_password = 'O?7i$*)nIX;~';
// $db_name = 'nvhsudih_polomolokpublicmarket';

?>

