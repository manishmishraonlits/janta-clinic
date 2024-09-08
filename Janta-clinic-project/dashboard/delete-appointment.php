<?php
// Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Appointment.php';
require_once '../src/AppointmentManager.php';
$db = new Database();
$appointmentid = $_GET['id'];
$appointmentmanager = new AppointmentManager($db);
$appointmentmanager->deleteAppointment($appointmentid);
header("Location: http://localhost:8080/Janta-clinic/dashboard/appointment-detail.php");
exit();
// End output buffering and flush output
ob_end_flush();
