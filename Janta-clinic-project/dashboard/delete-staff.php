<?php
// Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Staff.php';
require_once '../src/StaffManager.php';
$db = new Database();
$staffid = $_GET['id'];
$staffmanager = new StaffManager($db);
$staffmanager->deleteStaff($staffid);
header("Location: http://localhost:8080/Janta-clinic/dashboard/staff-detail.php");
exit();
// End output buffering and flush output
ob_end_flush();
