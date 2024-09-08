<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Billing</title>
</head>
<body>
    <?php
    require_once '../config/config.php';
    require_once '../src/Database.php';
    require_once '../src/Service.php';
    require_once '../src/ServiceManager.php';
    require_once "../src/Appointment.php";
    require_once "../src/AppointmentManager.php";
    require_once "../src/Patient.php";
    require_once "../src/PatientManager.php";
    $db = new Database($db);
    $appointment_id = $_GET['id'];
    $pageno = $_GET['page'];
    $patientmaneger = new PatientManager($db);
    $appointmentmanager = new AppointmentManager($db);
    $appointment = $appointmentmanager->getappointmentId($appointment_id);
    $servicemanager = new ServiceManager($db);
    $services = $servicemanager->getServices();
    include '../templates/header.php';
    include "../templates/sidebar.php";
    ?>
    <main>
        <h3 class="text-xl font-bold dark:text-white mb-8">Generate Bill</h3>
        <form action="../dashboard/add-billing.php" method="post">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="mr-3">
                    <input type="hidden" name="patient_id"
                        value="<?php echo htmlspecialchars($appointment->getFK()); ?>" />
                    <input type="hidden" name="appointment_id"
                        value="<?php echo htmlspecialchars($appointment->AppointmentId()); ?>" />
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biller
                        Name</label>
                    <input type="text" name="billername" id="first_name" value="<?php
                                                                                $patientid = $appointment->getFK();
                                                                                $patient = $patientmaneger->getPatient($patientid);
                                                                                echo htmlspecialchars($patient->getFullName());
                                                                                ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ankit" required readonly />
                </div>
                <div>
                    <label for="company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment
                        Date</label>
                    <input type="date" name="doa" id="company"
                        value="<?php echo htmlspecialchars($appointment->getAppointmentDate()) ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" required readonly />
                </div>
                <div class="mr-3">
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        Billing Date</label>
                    <input type="date" name="dob" id="company"
                        value="<?php echo htmlspecialchars($appointment->getAppointmentDate()) ?>" min="<?php echo htmlspecialchars($appointment->getAppointmentDate()) ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Billing date" required />
                </div>
                <div>
                    <label for="payment"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment</label>
                    <select id="Specialization" name="paymentstatus"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Unpaid" selected>Unpaid</option>
                        <option value="Paid">Paid </option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <h3 class="mb-2 font-semibold text-gray-900 dark:text-white">Services</h3>
                <ul
                    class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <?php foreach ($services as $service): ?>
                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="vue-checkbox" type="checkbox" name="services[]"
                                value="<?php echo htmlspecialchars($service->getServiceId());  ?>"
                                class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="vue-checkbox"
                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"><?php echo htmlspecialchars($service->getServiceName()); ?></label>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <button type="submit"
                class="text-white bg-pink-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Genrate</button>
                <a href="../dashboard/appointment-manage.php?page=<?php echo htmlspecialchars($pageno); ?>&id=<?php echo htmlspecialchars($appointment_id); ?>"
                class="inline-flex items-center px-3 py-2.5 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 ">
                Back to List
            </a>
        </form>
    </main>
    <?php include '../templates/footer.php'; ?>
</body>
</html>