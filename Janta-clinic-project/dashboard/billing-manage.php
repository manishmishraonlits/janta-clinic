<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Panel</title>
</head>
<body>
    <?php
    require_once '../config/config.php';
    require_once '../src/Database.php';
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
    $billingmanager = new BillingManager($db);
    $patientmanager = new PatientManager($db);
    $appointmentmanager = new AppointmentManager($db);
    $servicemanager = new ServiceManager($db);
    $billingservicemanager = new BillingServiceManager($db);
    $billing_id = $_GET['id'];
    $pageno = $_GET['page'];
    $billing = $billingmanager->getBillingId($billing_id);
    $patientid = $billing->getBillingPatientId();
    $patient = $patientmanager->getPatient($patientid);
    $address = $patient->getAddress();
    $servicesids =  $billingservicemanager->getServicesBilling($billing_id);
    $counter = 0;
    include "../templates/header.php";
    include "../templates/sidebar.php";
    ?>
    <main>
        <div class="flex gap-12">
            <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ankit Kumar Details</h5>
      </a> -->
                <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Billing Details</h2>
                <div class="mb-5 grid gap-2">
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Billing ID - </span>
                        <span><?php echo htmlspecialchars($billing->getBillingIdClass()); ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Biller Name - </span>
                        <span><?php
                                echo htmlspecialchars($patient->getFullName());
                                ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Appointment ID - </span>
                        <span><?php echo htmlspecialchars($billing->getBillingAppointmentId()); ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Appointment Date - </span>
                        <span><?php
                                $appointmentid = $billing->getBillingAppointmentId();
                                $appointment = $appointmentmanager->getappointmentId($appointmentid);
                                echo htmlspecialchars($appointment->getAppointmentDate());
                                ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Billing Date - </span>
                        <span><?php echo htmlspecialchars($billing->getBillingDate()); ?> </span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Total Amount - </span>
                        <span><?php echo htmlspecialchars($billing->getTotalAmount()); ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Payment Status - </span>
                        <span><?php echo htmlspecialchars($billing->getPaymentStatus()); ?> </span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Biller Address - </span>
                        <span><?php
                                echo htmlspecialchars($address->getStreet());
                                ?></span><br>
                        <span>
                            <?php echo htmlspecialchars($address->getCity()); ?>
                        </span> <br>
                        <span>
                            <?php echo htmlspecialchars($address->getState()); ?>
                        </span> <br>
                        <span>
                            <?php echo htmlspecialchars($address->getZipcode()); ?>
                        </span>
                    </p>
                    <?php
                    if ($billing->getPaymentStatus() === "Unpaid") {
                    ?>
                    <p class="text-red-600">Biller payment is unpaid</p>
                    <a href="../dashboard/update-billing-status.php?id=<?php echo htmlspecialchars($billing->getBillingIdClass()); ?>&page=<?php echo htmlspecialchars($pageno);?>"
                        class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Change
                        Payment Status</a>
                    <?php } ?>
                </div>
                <a href="../dashboard/delete-billing.php?id=<?php echo htmlspecialchars($billing->getBillingIdClass()); ?>"
                    onclick="return confirmDeletion();"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Delete
                </a>
                <?php if ($billing->getPaymentStatus() === "Paid") { ?>
                <a href="../dashboard/billing-pdf.php?id=<?php echo htmlspecialchars($billing->getBillingIdClass()); ?>" target="_blank"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-yellow-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                    Generate PDF
                </a>
                <?php } ?>
                <a href="../dashboard/billing-detail.php?page=<?php echo htmlspecialchars($pageno); ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                    Back to List
                </a>
            </div>
            <div id="Appointment-div flex"
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <?php
                ?>
                <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Services</h2>
                <div class="grid gap-4">
                    <?php foreach ($servicesids as $serviceid):
                        if ($counter >= 4) {
                            break;
                        }
                    ?>
                    <div class="h-auto max-w-full rounded-lg bg-pink-100 p-3">
                        <?php
                            $service = $servicemanager->getServiceId($serviceid);
                            ?>
                        <p class="text-grey-500">
                            <span class="font-semibold text-green-500 dark:text-blue">Service Name - </span>
                            <span><?php echo htmlspecialchars($service->getServiceName()); ?></span>
                        </p>
                        <p class="text-grey-500">
                            <span class="font-semibold text-green-500 dark:text-blue">Service Amount - </span>
                            <span>Rs.</span>
                            <span><?php echo htmlspecialchars($service->getServiceCharge()); ?></span>
                        </p>
                    </div>
                    <?php
                        $counter++;
                    endforeach; ?>
                    <h3 class="text-md font-bold text-green-600 dark:text-white">Total Services - <span
                            class="text-blue-600"><?php echo htmlspecialchars(count($servicesids)); ?></span> </h3>
                </div>
            </div>
        </div>
    </main>
    <script>
    function confirmDeletion() {
        return confirm("Are you sure you want to delete this Bill?");
    }
    </script>
    <?php include '../templates/footer.php'  ?>
</body>
</html>