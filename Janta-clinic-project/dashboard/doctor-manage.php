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
    require_once '../src/Doctor.php';
    require_once '../src/DoctorManager.php';
    // establishing connection
    $db = new Database();
    // sending establish connection to your doctorManager  class with the helo of constructor
    $doctorManager = new DoctorManager($db);
    // Getting id from get variable
    $doctorid = $_GET['id'];
    $pageno = $_GET['page'];
    // Get associative array of provided id from get
    $doctor = $doctorManager->getDoctor($doctorid);
    include '../templates/header.php';
    include "../templates/sidebar.php";
    ?>
    <main>
        <div
            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <!-- <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ankit Kumar Details</h5>
      </a> -->
            <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Doctor Details</h2>
            <div class="mb-5 grid gap-3">
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">ID - </span>
                    <span><?php echo htmlspecialchars($doctor->getIdDoctor()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Name - </span>
                    <span><?php echo htmlspecialchars($doctor->getFullName()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Specialization - </span>
                    <span><?php echo htmlspecialchars($doctor->specialDoctor()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Qualification - </span>
                    <span><?php echo htmlspecialchars($doctor->getQualification()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">D.O.J - </span>
                    <span><?php echo htmlspecialchars($doctor->joinDateDoctor()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">YOE - </span>
                    <span><?php echo htmlspecialchars($doctor->yoeDoctor()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Phone No - </span>
                    <span><?php echo htmlspecialchars($doctor->phoneNoDoctor()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Email ID - </span>
                    <span><?php echo htmlspecialchars($doctor->getDoctorEmail()); ?></span>
                </p>
            </div>
            <a href="../dashboard/update-doctor.php?id=<?php echo htmlspecialchars($doctor->getIdDoctor()); ?>&page=<?php echo htmlspecialchars($pageno); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </a>
            <a href="../dashboard/delete-doctor.php?id=<?php echo htmlspecialchars($doctor->getIdDoctor()); ?>" onclick="return confirmDeletion();"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Delete
            </a>
            <a href="../dashboard/doctor-detail.php?page=<?php  echo htmlspecialchars($pageno); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                Back to List
            </a>
        </div>
    </main>
    <script>
    function confirmDeletion() {
        return confirm("Are you sure you want to delete this doctor?");
    }
    </script>
    <?php include '../templates/footer.php' ?>
</body>
</html>