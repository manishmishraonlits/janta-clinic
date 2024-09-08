<?php
// Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Staff.php';
require_once '../src/StaffManager.php';
$db = new Database();
$staffmanager = new StaffManager($db);
$firstname = $_GET['firstname'];
$middlename = $_GET['middlename'];
$lastname = $_GET['lastname'];
$role = $_GET['role'];
$dateofhiring = $_GET['doh'];
$phoneno = $_GET['phoneno'];
$email = $_GET['email'];
$password = $_GET['password'];
$staffmanager->addStaff($firstname, $middlename, $lastname, $role, $phoneno, $email, $password, $dateofhiring);
header("Location: http://localhost:8080/Janta-clinic/dashboard/staff-detail.php");
$db->close();
exit();
// End output buffering and flush output
ob_end_flush();
