<?php
// // Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/BillingManager.php';
require_once '../src/ServiceManager.php';
require_once '../src/Service.php';
require_once '../src/Billing_Service.php';
require_once '../src/BillingServiceManager.php';
$db = new Database();
$billingmanager = new BillingManager($db);
$billingservicemanager = new BillingServiceManager($db);
$billing_id = $_GET['id'];
// Delete billing services first
$billingservicemanager->deleteBillingServices($billing_id);
// Then bill
$billingmanager->DeleteBilling($billing_id);
header("Location: http://localhost:8080/Janta-clinic/dashboard/billing-detail.php");
$db->close();
exit();
// End output buffering and flush output
ob_end_flush();