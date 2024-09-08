<?php
// Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Appointment.php';
require_once '../src/AppointmentManager.php';
$db = new Database();
// sending establish connection to your doctorManager  class with the helo of constructor
$Appointmentmanager = new AppointmentManager($db);
$id = $_GET['id'];
$doctorname = $_GET['doctors'];
$appointmentdate = $_GET['Appointment_date'];
$status = $_GET['Status'];
$reason = $_GET['reason'];
$pageno = $_GET['page'];
$Appointmentmanager->bookAppointment($status, $doctorname, $appointmentdate, $reason, $id);
header("Location: http://localhost:8080/Janta-clinic/dashboard/patient-manage.php?id=" . urlencode($id)."&page=".urldecode($pageno));
$db->close();
exit();
// End output buffering and flush output
ob_end_flush();
