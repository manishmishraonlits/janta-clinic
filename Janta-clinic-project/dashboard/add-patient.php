<?php
// Start output buffering
ob_start();
session_start(); // Start the session
require_once "../config/config.php";
require_once "../src/Database.php";
require_once "../src/Patient.php";
require_once "../src/address.php";
require_once "../src/PatientManager.php";
$db = new Database();
$patient_manager = new PatientManager($db);
$firsname = $_GET['firstname'];
$middlename = $_GET['middlename'];
$lastname = $_GET['lastname'];
$age = $_GET['age'];
$gender = $_GET['gender'];
$weight = $_GET['weight'];
$bmi = $_GET['bmi'];
$bloodgroup = $_GET['blood_group'];
$state = $_GET['state'];
$city = $_GET['city'];
$street = $_GET['street'];
$zipcode = $_GET['zipcode'];
$medicalhistory = $_GET['medical_history'];
// Increase patient register counter
if(!isset($_SESSION['Patient register'])){
    $_SESSION['Patient register'] = 0;
}
$_SESSION['Patient register'] += 1;
$patient_manager->addPatient($firsname, $middlename, $lastname, $age, $gender, $weight, $bmi, $bloodgroup, $medicalhistory, $street, $city, $state, $zipcode);
header("Location: http://localhost:8080/Janta-clinic/dashboard/patient-detail.php");
$db->close();
exit();
// End output buffering and flush output
ob_end_flush();
