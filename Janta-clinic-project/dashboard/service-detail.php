<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Panel</title>
</head>
<body>
    <?php
    require_once '../config/config.php';
    require_once '../src/Database.php';
    require_once '../src/Service.php';
    require_once '../src/ServiceManager.php';
    $db = new Database();
    $servicemanager  =  new ServiceManager($db);
    $services = $servicemanager->getServices();
    // Pagination code
    $limit = 4;
    $id = $_POST['id'];
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $offset = ($page - 1) * $limit;
    $servicepage = $servicemanager->getServicesPagination($offset, $limit);
    include "../templates/header.php";
    include "../templates/sidebar.php";
    ?>
    <main>
        <div>
            <h1
                class="mb-4 text-xl font-extrabold leading-none tracking-tight text-gray-500 md:text-2xl lg:text-2xl dark:text-white">
                Registered Services</h1>
            <div class="mb-4"> <a type="button" href="../dashboard/service-register.php"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2  dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Register
                    Service</a>
            </div>
            <form class="max-w-lg mb-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="flex">
        <input type="search" id="search-dropdown" name="id"
            class="w-full md:w-96 p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
            placeholder="Search by service Id..." required />
        <button type="submit"
            class="p-2.5 text-sm font-medium text-white bg-blue-700 border border-blue-700 rounded-r-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </button>
    </div>
</form>
            <?php if (isset($_POST['id'])) {
                $serivceSearch = $servicemanager->getServiceId($id);
                if (!empty($serivceSearch)) {
            ?>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-8">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Service ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Service Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Service Detail
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Charge
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
                                        <?php echo htmlspecialchars($serivceSearch->getServiceId()); ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($serivceSearch->getServiceName()); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($serivceSearch->getServiceDetail()); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo htmlspecialchars($serivceSearch->getServiceCharge()); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="../dashboard/service-manage.php?id=<?php echo htmlspecialchars($serivceSearch->getServiceId()); ?>&page=<?php echo $page; ?>"
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
                                Service ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Service Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Service Detail
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Charge
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Show
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicepage as $service): ?>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo htmlspecialchars($service->getServiceId()); ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo htmlspecialchars($service->getServiceName()); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo htmlspecialchars($service->getServiceDetail()); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo htmlspecialchars($service->getServiceCharge()); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="../dashboard/service-manage.php?id=<?php echo htmlspecialchars($service->getServiceId()); ?>&page=<?php echo $page; ?>"
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
                    <a href="../dashboard/service-detail.php?page=<?php echo htmlspecialchars($page - 1) ?> ?>"
                        class=" active flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>
            <?php } ?>
            <?php
            if (count($services) > 0) {
                $total_record = count($services);
                $total_pages = ceil($total_record / $limit);
            }
            // Running for loop
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = ($i == $page) ? "bg-gray-300 text-gray-700 dark:bg-gray-700 dark:text-white" : "";
            ?>
                <li class="<?php $active ?>">
                    <a href="../dashboard/service-detail.php?page=<?php echo htmlspecialchars($i); ?>"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white <?php echo $active ?> "><?php echo htmlspecialchars($i); ?></a>
                </li>
            <?php } ?>
            <?php if (($total_pages > $page)) { ?>
                <li>
                    <a href="../dashboard/service-detail.php?page=<?php echo htmlspecialchars($page + 1) ?> ?>"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            <?php } ?>
        </ul>
    </main>
    <?php $db->close(); ?>
    <?php include '../templates/footer.php'  ?>
</body>
</html>