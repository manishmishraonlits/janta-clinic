<?php
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/StaffManager.php';
require_once '../src/Staff.php';
require_once '../src/DoctorManager.php';
require_once '../src/Doctor.php';
require_once '../src/PatientManager.php';
require_once '../src/Patient.php';
require_once '../src/BillingManager.php';
require_once '../src/Billing.php';
require_once '../src/AppointmentManager.php';
require_once '../src/Appointment.php';
require_once '../src/ServiceManager.php';
require_once '../src/Service.php';
require_once '../src/BillingServiceManager.php';
$db = new Database();
$patientmanager = new PatientManager($db);
$appointmentmanager = new AppointmentManager($db);
$doctormanager = new DoctorManager($db);
$staffmanager = new StaffManager($db);
$billingmanager = new BillingManager($db);
$patientcount = $patientmanager->getPatientsCount();
$appointmentcount = $appointmentmanager->getCountAppointment();
$doctorcount = $doctormanager->getDoctorCount();
$staffcount = $staffmanager->getStaffCount();
$totalmoney = $billingmanager->GetTotalMoney();
include '../templates/header.php';
include  "../templates/sidebar.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <main>
        <div class="">
            <h1
                class="mb-5 text-2xl font-extrabold leading-none tracking-tight text-gray-500 md:text-4xl lg:text-3xl dark:text-white">
                Admin Dashboard</h1>
                <a href="../dashboard/admin-dashboard-logout.php" 
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Logout</a>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 bt-4 mt-5">
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-600 dark:text-white mb-8">Total Patients
                        Registered</h5>
                    <h2 class="text-2xl font-extrabold dark:text-white text-red-700 mb-4 mt-2">
                        <?php echo htmlspecialchars($patientcount); ?></h2>
                </div>
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-600 dark:text-white mb-8">Total
                        Appointments Taken</h5>
                    <h2 class="text-2xl font-extrabold dark:text-white text-red-700 mb-4 mt-2">
                        <?php echo htmlspecialchars($appointmentcount); ?></h2>
                </div>
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-600 dark:text-white mb-8">Total Doctors
                        Registered</h5>
                    <h2 class="text-2xl font-extrabold dark:text-white text-red-700 mb-4 mt-2">
                        <?php echo htmlspecialchars($doctorcount); ?></h2>
                </div>
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-600 dark:text-white mb-8">Total Staff
                        Registered</h5>
                    <h2 class="text-2xl font-extrabold dark:text-white text-red-700 mb-4 mt-2">
                    <?php echo htmlspecialchars($staffcount); ?></h2>
                </div>
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-600 dark:text-white mb-8">Money Collected
                        from Services</h5>
                    <h2 class="text-2xl font-extrabold dark:text-white text-red-700 mb-4 mt-2">
<span>Rs</span> <?php echo htmlspecialchars($totalmoney); ?></h2>
                </div>
            </div>
        </div>
    </main>
</body>
</html>