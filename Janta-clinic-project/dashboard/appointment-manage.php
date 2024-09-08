<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Panel</title>
</head>
<body>
    <?php
    require_once '../config/config.php';
    require_once '../src/Database.php';
    require_once '../src/Appointment.php';
    require_once '../src/AppointmentManager.php';
    require_once '../src/Patient.php';
    require_once '../src/PatientManager.php';
    require_once '../src/Billing.php';
    require_once '../src/BillingManager.php';
    $db = new Database();
    $Appointmentmanager = new AppointmentManager($db);
    $Patientmanager = new PatientManager($db);
    $billlingmanager = new BillingManager($db);
    $appointmentsId = $_GET['id'];
    $pageno = $_GET['page'];
    $billingPresent = $billlingmanager->getAppointmentPresent($appointmentsId);
    $billing = $billlingmanager->getBiilingByAppointmentId($appointmentsId);
    $appointment = $Appointmentmanager->getappointmentId($appointmentsId);
    include '../templates/header.php';
    include "../templates/sidebar.php";
    ?>
    <main>
        <div
            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Appointment Detail's</h2>
            <div class="mb-5 grid gap-3">
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Appointment ID - </span>
                    <span><?php echo htmlspecialchars($appointment->AppointmentId()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Appointment Date - </span>
                    <span><?php echo htmlspecialchars($appointment->getAppointmentDate()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue"> Patient Name - </span>
                    <span>
                        <?
                        $patientid = $appointment->getFK();
                        $patientfullname = $Patientmanager->getPatient($patientid);
                        echo htmlspecialchars($patientfullname->getFullName());
                        ?>
                    </span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Seen By - </span> <span>Dr.</span>
                    <span><?php echo htmlspecialchars($appointment->getDoctorName()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Status - </span>
                    <span><?php echo htmlspecialchars($appointment->getAppointmentStatus()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Reason - </span>
                    <span><?php echo htmlspecialchars($appointment->getReason()); ?></span>
            </div>
            <a href="../dashboard/update-appointment.php?id=<?php echo htmlspecialchars($appointment->AppointmentId()); ?>&page=<?php echo htmlspecialchars($pageno); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </a>
            <a href="../dashboard/delete-appointment.php?id=<?php echo htmlspecialchars($appointment->AppointmentId()); ?>"
                onclick="return confirmDeletion();"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Delete
            </a>
            <a href="../dashboard/appointment-detail.php?page=<?php echo htmlspecialchars($pageno); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                Back to List
            </a>
            <?php if($appointment->getAppointmentStatus() === 'Scheduled'){ ?>
                <h3 class="p-2 mt-3 text-blue-800 rounded-lg bg-purple-100 dark:bg-gray-800 dark:text-blue-400">Appointment is scheduled</h3>         
             <?php }else{  ?>    
            <?php if ($billingPresent) { ?>
            <a href="../dashboard/register-billing.php?id=<?php echo htmlspecialchars($appointment->AppointmentId()); ?>&page=<?php echo htmlspecialchars($pageno);?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-yellow-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                Generate Bill
            </a>
            <?php }else{ ?>
                <h3 class="text-md  dark:text-white mt-4 text-red-700">Bill is already generated for this appointment</h3>
                <h3 class="text-md  dark:text-white  text-red-700">Billing ID - <span class=""><?php echo htmlspecialchars($billing->getBillingIdClass()); ?></span> </h3>
             <?php } }  ?>   
        </div>
    </main>
    <script>
    function confirmDeletion() {
        return confirm("Are you sure you want to delete this Appointment?");
    }
    </script>
    <?php include '../templates/footer.php' ?>
</body>
</html>