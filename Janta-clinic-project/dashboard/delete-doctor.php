<?php
// Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Doctor.php';
require_once '../src/DoctorManager.php';
$db = new Database();
$doctorid = $_GET['id'];
$doctorManagar = new DoctorManager($db);
$doctorManagar->deleteDoctor($doctorid);
header("Location: http://localhost:8080/Janta-clinic/dashboard/doctor-detail.php");
exit();
// End output buffering and flush output
ob_end_flush();
