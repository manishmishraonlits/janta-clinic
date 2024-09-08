<?php
// Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Service.php';
require_once '../src/ServiceManager.php';
$db = new Database();
$serviceid = $_GET['id'];
$servicemanager  = new ServiceManager($db);
$servicemanager->deleteService($serviceid);
header("Location: http://localhost:8080/Janta-clinic/dashboard/service-detail.php");
exit();
// End output buffering and flush output
ob_end_flush();
