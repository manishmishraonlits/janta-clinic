<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Appointment</title>
</head>
<body>
    <?php
    require_once '../config/config.php';
    require_once '../src/Database.php';
    require_once '../src/Appointment.php';
    require_once '../src/AppointmentManager.php';
    require_once '../src/Patient.php';
    require_once '../src/PatientManager.php';
    $db = new Database();
    $Appointmentmanager = new AppointmentManager($db);
    $Patientmanager = new PatientManager($db);
    $appointmentids = $_POST['id'];
    $appointments = $Appointmentmanager->AppointmentsFuture();
    $appointmentsearch = $Appointmentmanager->getappointmentId($appointmentids);
    include "../templates/header.php";
    include "../templates/sidebar.php";
    ?>
    <main>
        <div>
            <h1
                class="mb-3 text-xl font-extrabold leading-none tracking-tight text-gray-500 md:text-2xl lg:text-2xl dark:text-white">
                Upcoming Appointment</h1>
            <form class="max-w-lg mb-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="flex">
                    <input type="search" id="search-dropdown" name="id"
                        class="w-full md:w-96 p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="Search by Appointment Id..." required />
                    <button type="submit"
                        class="p-2.5 text-sm font-medium text-white bg-blue-700 border border-blue-700 rounded-r-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST['id'])) {
                if ($appointmentsearch) { ?>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-8">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Appointment Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Patient Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Appointment Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Doctor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo htmlspecialchars($appointmentsearch->AppointmentId()); ?>
                            </th>
                            <td class="px-6 py-4">
                                <?
                                        $patientid = $appointmentsearch->getFK();
                                        $patientfullname = $Patientmanager->getPatient($patientid);
                                        echo htmlspecialchars($patientfullname->getFullName());
                                        ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo htmlspecialchars($appointmentsearch->getAppointmentDate()); ?>
                            </td>
                            <td class="px-6 py-4">
                                Dr <span><?php echo htmlspecialchars($appointmentsearch->getDoctorName()); ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo htmlspecialchars($appointmentsearch->getAppointmentStatus()); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php } else { ?>
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
                                Appointment Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Patient Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Appointment Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Doctor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment): ?>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo htmlspecialchars($appointment->AppointmentId()); ?>
                            </th>
                            <td class="px-6 py-4">
                                <?
                                    $patientid = $appointment->getFK();
                                    $patientfullname = $Patientmanager->getPatient($patientid);
                                    echo htmlspecialchars($patientfullname->getFullName());
                                    ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo htmlspecialchars($appointment->getAppointmentDate()); ?>
                            </td>
                            <td class="px-6 py-4">
                                Dr <span><?php echo htmlspecialchars($appointment->getDoctorName()); ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo htmlspecialchars($appointment->getAppointmentStatus()); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php $db->close(); ?>
    <?php include "../templates/footer.php"; ?>
</body>
</html>