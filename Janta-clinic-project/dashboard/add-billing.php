<?php
// Start output buffering
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
$servicemanger = new ServiceManager($db);
$billingservicemanager = new BillingServiceManager($db);
// collect form data
$billername = $_POST['billername'];
$appointmentDate = $_POST['doa'];
$BillingDate = $_POST['dob'];
$paymentStatus = $_POST['paymentstatus'];
// Array of serivces id
$selectedServices = $_POST['services'];
$appointmentId = $_POST['appointment_id'];
$patientId = $_POST['patient_id'];
// Calculating total amount
$totalamount = 0;
foreach ($selectedServices as $serviceId) {
    $service = $servicemanger->getServiceId($serviceId);
    // If service exist
    if ($service) {
        $totalamount += $service->getServiceCharge();
    }
}
// Adding data in billing table
$billing_id = $billingmanager->addBilling($appointmentId, $patientId, $totalamount, $BillingDate, $paymentStatus);
if ($billing_id) {
    $errors = [];
    // Link the services to the billing
    foreach ($selectedServices as $serviceId) {
        $success = $billingservicemanager->addBillingService($billing_id, $serviceId);
        if (!$success) {
            $errors[] = "Error linking service ID $serviceId to billing ID $billing_id";
        }
    }
    if (empty($errors)) {
        echo "Billing and services added successfully. Billing ID: $billing_id";
    } else {
        echo "Billing added successfully (ID: $billing_id), but there were errors linking services:<br>";
        echo implode("<br>", $errors);
    }
} else {
    echo "Error: Failed to add billing record.";
}
header("Location: http://localhost:8080/Janta-clinic/dashboard/billing-detail.php");
$db->close();
exit();
// End output buffering and flush output
ob_end_flush();
