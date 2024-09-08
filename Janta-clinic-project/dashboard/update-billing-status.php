<?php 
// // Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/BillingManager.php';
$db = new Database();
$billingmanager = new BillingManager($db);
$billingid = $_GET['id'];
$paymentStatus = 'Paid';
$pageno = $_GET['page'];
$billingmanager->updatePayementStatus($billingid,$paymentStatus);
header("Location: http://localhost:8080/Janta-clinic/dashboard/billing-manage.php?id=".urldecode($billingid)."&page=".urlencode($pageno));
$db->close();
exit();
// End output buffering and flush output
ob_end_flush();