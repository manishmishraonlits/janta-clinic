<?php
// Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Service.php';
require_once '../src/ServiceManager.php';
$db = new Database();
$servicemanager = new ServiceManager($db);
$servicename = $_GET['servicename'];
$amount = $_GET['amount'];
$servicedetail = $_GET['service_detail'];
$servicemanager->addService($servicename,$servicedetail,$amount);
header("Location: http://localhost:8080/Janta-clinic/dashboard/service-detail.php");
$db->close();
exit();
// End output buffering and flush output
ob_end_flush();
