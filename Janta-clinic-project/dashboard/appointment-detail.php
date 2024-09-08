<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Panel</title>
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
    $appointments = $Appointmentmanager->getAllAppointment();
    $appointmentids = $_POST['id'];
    $appointmentsearch = $Appointmentmanager->getappointmentId($appointmentids);
    // Pagination code
    $limit = 4;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $offset = ($page - 1) * $limit;
    $appointmentpage = $Appointmentmanager->getAllAppointmentPagination($offset, $limit);
    include "../templates/header.php";
    include "../templates/sidebar.php";
    ?>
    <main>
        <div>
            <h1
                class="mb-3 text-xl font-extrabold leading-none tracking-tight text-gray-500 md:text-2xl lg:text-2xl dark:text-white">
                Appointment Detail's</h1>
            <form class="max-w-lg mb-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="flex">
        <input type="search" id="search-dropdown" name="id"
            class="w-full md:w-96 p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
            placeholder="Search by appointment Id..." required />
        <button type="submit"
            class="p-2.5 text-sm font-medium text-white bg-blue-700 border border-blue-700 rounded-r-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
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
                                    <td class="px-6 py-4">
                                        <a href="../dashboard/appointment-manage.php?id=<?php echo htmlspecialchars($appointmentsearch->AppointmentId()); ?>&page=<?php echo $page; ?>"
                                            class="focus:outline-none text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Show</a>
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
                            <th scope="col" class="px-6 py-3">
                                Show
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointmentpage as $appointment): ?>
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
                                <td class="px-6 py-4">
                                    <a href="../dashboard/appointment-manage.php?id=<?php echo htmlspecialchars($appointment->AppointmentId()); ?>&page=<?php echo $page; ?>"
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
                    <a href="../dashboard/appointment-detail.php?page=<?php echo htmlspecialchars($page - 1) ?> ?>"
                        class=" active flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>
            <?php } ?>
            <?php
            if (count($appointments) > 0) {
                $total_record = count($appointments);
                $total_pages = ceil($total_record / $limit);
            }
            // Running for loop
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = ($i == $page) ? "bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-white" : "";
            ?>
                <li class="<?php $active ?>">
                    <a href="../dashboard/appointment-detail.php?page=<?php echo htmlspecialchars($i); ?>"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?php echo $active ?> "><?php echo htmlspecialchars($i); ?></a>
                </li>
            <?php } ?>
            <?php if (($total_pages > $page)) { ?>
                <li>
                    <a href="../dashboard/appointment-detail.php?page=<?php echo htmlspecialchars($page + 1) ?> ?>"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            <?php } ?>
        </ul>
    </main>
    <?php $db->close(); ?>
    <?php include "../templates/footer.php"; ?>
</body>
</html>