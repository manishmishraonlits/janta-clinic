<?php
// Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Patient.php';
require_once '../src/PatientManager.php';
$db = new Database();
$patientid = $_GET['id'];
 $patientmanager = new PatientManager($db);
 $patientmanager->deletePatient($patientid);
header("Location: http://localhost:8080/Janta-clinic/dashboard/patient-detail.php");
exit();
// End output buffering and flush output
ob_end_flush();