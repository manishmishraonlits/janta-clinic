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
    require_once '../src/Service.php';
    require_once '../src/ServiceManager.php';
    $db = new Database();
    $servicemanager = new ServiceManager($db);
    $serviceid = $_GET['id'];
    $pageno = $_GET['page'];
    $service = $servicemanager->getServiceId($serviceid);
    include '../templates/header.php';
    include "../templates/sidebar.php";
    ?>
    <main>
        <div
            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Service Detail's</h2>
            <div class="mb-5 grid gap-3">
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Service ID - </span>
                    <span><?php echo htmlspecialchars($service->getServiceId()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Service Name - </span>
                    <span><?php echo htmlspecialchars($service->getServiceName()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Service Charge - </span>
                    <span><?php echo htmlspecialchars($service->getServiceCharge()); ?></span>
                </p>
                <p class="text-grey-500">
                    <span class="font-semibold text-green-500 dark:text-blue">Service Detail - </span>
                    <span><?php echo htmlspecialchars($service->getServiceDetail()); ?></span>
                </p>
            </div>
            <a href="../dashboard/update-service.php?id=<?php echo htmlspecialchars($service->getServiceId()); ?>&page=<?php echo htmlspecialchars($pageno); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </a>
            <a href="../dashboard/delete-service.php?id=<?php echo htmlspecialchars($service->getServiceId()); ?>" onclick="return confirmDeletion();"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Delete
            </a>
            <a href="../dashboard/service-detail.php?page=<?php echo htmlspecialchars($pageno) ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                Back to List
            </a>
        </div>
    </main>
    <script>
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this Service?");
        }
    </script>
    <?php include '../templates/footer.php' ?>
</body>
</html>