<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Panel</title>
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
    $db = new Database();
    $billingmanager = new BillingManager($db);
    $patientmanager = new PatientManager($db);
    $appointmentmanager = new AppointmentManager($db);
    $billings = $billingmanager->getBilling();
    // Pagination code
    $limit = 4;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $offset = ($page - 1) * $limit;
    $billingpage = $billingmanager->getBillingPagination($offset, $limit);
    include "../templates/header.php";
    include "../templates/sidebar.php";
    ?>
    <main>
        <div>
            <h1
                class="mb-3 text-xl font-extrabold leading-none tracking-tight text-gray-500 md:text-2xl lg:text-2xl dark:text-white">
                Registered Bill</h1>
<form class="max-w-lg mb-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="flex">
        <input type="search" id="search-dropdown" name="id"
            class="flex-grow p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
            placeholder="Search by billing id..." required />
        <button type="submit"
            class="p-2.5 text-sm font-medium text-white bg-blue-700 border border-blue-700 rounded-r-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </button>
    </div>
</form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
                $id = $_POST['id'];
                $billingSearch = $billingmanager->getBillingId($id);
                if ($billingSearch) {
            ?>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-8">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Billing ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Patient Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Appointment Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Billing Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        PaymentStatus
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Show
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo htmlspecialchars($billingSearch->getBillingIdClass()); ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php
                                        $patientid = $billingSearch->getBillingPatientId();
                                        $patient = $patientmanager->getPatient($patientid);
                                        echo htmlspecialchars($patient->getFullName());
                                        ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php
                                        $appointmentid = $billingSearch->getBillingAppointmentId();
                                        $appointment = $appointmentmanager->getappointmentId($appointmentid);
                                        echo htmlspecialchars($appointment->getAppointmentDate());
                                        ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($billingSearch->getBillingDate()); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($billingSearch->getTotalAmount()); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($billingSearch->getPaymentStatus()); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="../dashboard/billing-manage.php?id=<?php echo htmlspecialchars($billingSearch->getBillingIdClass()); ?>&page=<?php echo htmlspecialchars($page); ?>"
                                            class="focus:outline-none text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Show</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php } else {  ?>
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        <span class="">No record found!</span>
                    </div>
            <?php }
            } ?>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Billing ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Patient Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Appointment Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Billing Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                PaymentStatus
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Show
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($billingpage as $billing): ?>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo htmlspecialchars($billing->getBillingIdClass()); ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php
                                    $patientid = $billing->getBillingPatientId();
                                    $patient = $patientmanager->getPatient($patientid);
                                    echo htmlspecialchars($patient->getFullName());
                                    ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                    $appointmentid = $billing->getBillingAppointmentId();
                                    $appointment = $appointmentmanager->getappointmentId($appointmentid);
                                    echo htmlspecialchars($appointment->getAppointmentDate());
                                    ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo htmlspecialchars($billing->getBillingDate()); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo htmlspecialchars($billing->getTotalAmount()); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo htmlspecialchars($billing->getPaymentStatus()); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="../dashboard/billing-manage.php?id=<?php echo htmlspecialchars($billing->getBillingIdClass()); ?>&page=<?php echo htmlspecialchars($page); ?>"
                                        class="focus:outline-none text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Show</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <ul class="inline-flex -space-x-px text-base h-10 mt-10">
            <?php if ($page > 1) { ?>
                <li>
                    <a href="../dashboard/billing-detail.php?page=<?php echo htmlspecialchars($page - 1) ?> ?>"
                        class=" active flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>
            <?php } ?>
            <?php
            if (count($billings) > 0) {
                $total_record = count($billings);
                $total_pages = ceil($total_record / $limit);
            }
            // Running for loop
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = ($i == $page) ? "bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-white" : "";
            ?>
                <li class="<?php $active ?>">
                    <a href="../dashboard/billing-detail.php?page=<?php echo htmlspecialchars($i); ?>"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?php echo $active ?>"><?php echo htmlspecialchars($i); ?></a>
                </li>
            <?php } ?>
            <?php if (($total_pages > $page)) { ?>
                <li>
                    <a href="../dashboard/billing-detail.php?page=<?php echo htmlspecialchars($page + 1) ?> ?>"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            <?php } ?>
        </ul>
    </main>
    <?php include '../templates/footer.php'  ?>
</body>
</html>