<?php
// Start output buffering
ob_start();
require_once "../config/config.php";
require_once "../src/Database.php";
require_once "../src/Doctor.php";
require_once "../src/DoctorManager.php";
$db = new Database();
// sending establish connection to your doctorManager  class with the helo of constructor
$doctorManager = new DoctorManager($db);
$firstname = $_GET["firstname"];
$middlename = $_GET["middlename"];
$lastname = $_GET["lastname"];
$yearofexp = $_GET["yoe"];
$dataofjoin = $_GET["doj"];
$qualification = $_GET["qualification"];
$phoneNo = $_GET["phoneno"];
$specialization = $_GET["specialization"];
$email = $_GET["email"];
$doctorManager->addDoctor($firstname, $middlename, $lastname, $email, $qualification, $yearofexp, $specialization, $dataofjoin, $phoneNo);
header(
    "Location: http://localhost:8080/Janta-clinic/dashboard/doctor-detail.php"
);
$db->close();
exit();
// End output buffering and flush output
ob_end_flush();
