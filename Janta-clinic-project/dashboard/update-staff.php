<?php
// Start output buffering
ob_start();
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Staff.php';
require_once '../src/StaffManager.php';
$db = new Database();
$staffmanager = new StaffManager($db);
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$role = $_POST['role'];
$dateofhiring = $_POST['doh'];
$phoneno = $_POST['phoneno'];
$email = $_POST['email'];
$password = $_POST['password'];
$staffid = $_POST['id'];
$pageNo = $_POST['page'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updatebtn'])) {
        $staffmanager->updateStaff($staffid,$firstname, $middlename, $lastname, $role, $phoneno, $email, $password, $dateofhiring);
        header("Location: http://localhost:8080/Janta-clinic/dashboard/staff-manage.php?id=" . urlencode($staffid)."&page=".urldecode($pageNo));
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
    require_once '../src/Staff.php';
    require_once '../src/StaffManager.php';
    $db = new Database();
    $staffmanager = new StaffManager($db);
    $staffid = $_GET['id'];
    $pageno = $_GET['page'];
    $staff = $staffmanager->getStaffId($staffid);
    include "../templates/header.php";
    include "../templates/sidebar.php";
    ?>
    <main>
        <h3 class="text-xl font-bold dark:text-white mb-8">Staff Updation Form</h3>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="grid gap-6 md:grid-cols-3">
                <div>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($staff->getStaffId()); ?>" />
                <input type="hidden" name="page" value="<?php echo htmlspecialchars($pageno); ?>" />
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                        name</label>
                    <input type="text" id="first_name" name="firstname" value="<?php echo $staff->getFirstName(); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ankit" required />
                </div>
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                        Name</label>
                    <input type="text" id="middle_name" name="middlename" value="<?php echo $staff->getMiddleName(); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" />
                </div>
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                        name</label>
                    <input type="text" id="last_name" name="lastname" value="<?php echo $staff->getLastName(); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Kumar" required />
                </div>
                <div>
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Your
                        Role</label>
                    <select id="role" name="role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected><?php echo $staff->getStaffRole(); ?></option>
                        <option value="Nurse">Nurse</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Administractor">Administrator</option>
                        <option value="Lab Technician">Lab Technician</option>
                        <option value="Pharmacist">Pharmacist</option>
                    </select>
                </div>
                <div>
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of
                        Hired</label>
                    <input type="date" name="doh" id="company" value="<?php echo $staff->getStaffDate(); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Number</label>
                    <input type="text" id="phone-input" name="phoneno" aria-describedby="helper-text-explanation"
                        value="<?php echo $staff->getStaffPhone(); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="123-456-7890" required />
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                        address</label>
                    <input type="email" id="email" name="email" value="<?php echo $staff->getStaffEmail(); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="john.doe@company.com" required />
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Create
                        New Password
                    </label>
                    <input type="text" id="website" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Password" maxlength="15" />
                </div>
            </div>
            <button type="submit" name="updatebtn"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
        </form>
    </main>
    <?php include '../templates/footer.php'; ?>
</body>
</html>