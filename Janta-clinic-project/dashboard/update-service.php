<?php
// Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Service.php';
require_once '../src/ServiceManager.php';
$db = new Database();
$servicemanager = new ServiceManager($db);
$serviceid = $_POST['id'];
$servicename = $_POST['servicename'];
$amount = $_POST['amount'];
$servicedetail = $_POST['service_detail'];
$pageNO = $_POST['page'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updatebtn'])) { 
        $servicemanager->updateService($serviceid,$servicename,$servicedetail,$amount);
        header("Location: http://localhost:8080/Janta-clinic/dashboard/service-manage.php?id=" . urlencode($serviceid)."&page=".urldecode($pageNO));
        exit();
    }
}
// End output buffering and flush output
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janta Clinic Patient Registration</title>
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
    include "../templates/header.php";
    include "../templates/sidebar.php";
    ?>
    <main>
        <h3 class="text-xl font-bold dark:text-white mb-8">Service Registration Form</h3>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="grid gap-6 md:grid-cols-3">
                <div>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($service->getServiceId()); ?>" />
                <input type="hidden" name="page" value="<?php echo htmlspecialchars($pageno); ?>" />
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service
                        Name</label>
                    <input type="text" id="middle_name" name="servicename" value="<?php echo htmlspecialchars($service->getServiceName());?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Service name" />
                </div>
                <div>
                    <label for="company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Charge</label>
                    <input type="number" name="amount" id="" step="any" value="<?php echo htmlspecialchars($service->getServiceCharge());?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required placeholder="Rs." />
                </div>
            </div>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">Service
                Detail</label>
            <textarea id="message" rows="4" name="service_detail"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 my-4"
                placeholder="Write your Service Detail..."><?php echo htmlspecialchars($service->getServiceDetail());?></textarea>
            <button type="submit" name="updatebtn"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
        </form>
    </main>
    <?php include '../templates/footer.php'; ?>
</body>
</html>