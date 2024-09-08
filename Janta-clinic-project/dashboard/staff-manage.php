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
    require_once '../src/Staff.php';
    require_once '../src/StaffManager.php';
    $db = new Database();
    $staffmanager = new StaffManager($db);
    $staffid = $_GET['id'];
    $pageno = $_GET['page'];
    $staff = $staffmanager->getStaffId($staffid);
    include '../templates/header.php';
    include "../templates/sidebar.php";
    ?>
    <main>
        <div
            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Staff Detail's</h2>
            <div class="mb-5 grid gap-3">
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Staff ID - </span>
                    <span><?php echo htmlspecialchars($staff->getStaffId()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Name - </span>
                    <span><?php echo htmlspecialchars($staff->getFullName()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Role - </span>
                    <span><?php echo htmlspecialchars($staff->getStaffRole()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Phone Number - </span>
                    <span><?php echo htmlspecialchars($staff->getStaffPhone()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Email ID - </span>
                    <span><?php echo htmlspecialchars($staff->getStaffEmail()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Date of Hiring - </span>
                    <span><?php echo htmlspecialchars($staff->getStaffDate()); ?></span>
                </p>
            </div>
            <a href="../dashboard/update-staff.php?id=<?php echo htmlspecialchars($staff->getStaffId()); ?>&page=<?php echo htmlspecialchars($pageno); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </a>
            <a href="../dashboard/delete-staff.php?id=<?php echo htmlspecialchars($staff->getStaffId()); ?>" onclick="return confirmDeletion();"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Delete
            </a>
            <a href="../dashboard/staff-detail.php?page=<?php echo htmlspecialchars($pageno); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                Back to List
            </a>
        </div>
    </main>
    <script>
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this Staff?");
        }
    </script>
    <?php include '../templates/footer.php' ?>
</body>
</html>