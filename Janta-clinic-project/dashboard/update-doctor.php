<?php
// Start output buffering
ob_start();
include '../templates/header.php';
include "../templates/sidebar.php";
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Doctor.php';
require_once '../src/DoctorManager.php';
$db = new Database();
$doctorManager = new DoctorManager($db);
$doctorId = $_POST['id'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$yearofexp = $_POST['yoe'];
$dataofjoin = $_POST['doj'];
$qualification = $_POST['qualification'];
$phoneNo = $_POST['phoneno'];
$specialization = $_POST['specialization'];
$email = $_POST['email'];
$pageno = $_POST['page'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updatebtn'])) {
        $doctorManager->updateDoctor($doctorId, $firstname, $middlename, $lastname, $email, $qualification, $yearofexp, $specialization, $dataofjoin, $phoneNo);
        header("Location: http://localhost:8080/Janta-clinic/dashboard/doctor-manage.php?id=". urldecode($doctorId)."&page=".urldecode($pageno));
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
    <title>Update Doctor</title>
</head>
<body>
    <main>
        <h3 class="text-xl font-bold dark:text-white mb-8">Doctor Updation Form</h3>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <?php
            require_once '../config/config.php';
            require_once '../src/Database.php';
            require_once '../src/Doctor.php';
            require_once '../src/DoctorManager.php';
            $db = new Database();
            $doctorManager = new DoctorManager($db);
            $doctor_id = $_GET['id'];
            $pageno = $_GET['page'];
            $doctor = $doctorManager->getDoctor($doctor_id);
            ?>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($doctor->getIdDoctor()) ?>" />
                    <input type="hidden" name="page" value="<?php echo htmlspecialchars($pageno); ?>" />
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                        name</label>
                    <input type="text" name="firstname" id="first_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ankit" required
                        value="<?php echo htmlspecialchars($doctor->firstNameDoctor()) ?>" />
                </div>
                <div>
                    <label for="middle_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Middle
                        Name</label>
                    <input type="text" name="middlename" id="first_name"
                        value="<?php echo htmlspecialchars($doctor->middleNameDoctor()) ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Arya" required />
                </div>
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                        name</label>
                    <input type="text" id="last_name" name="lastname"
                        value="<?php echo htmlspecialchars($doctor->lastNameDoctor()) ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Kumar" required />
                </div>
                <div>
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year of
                        experience</label>
                    <input type="number" name="yoe" id="company"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Y.O.E" required value="<?php echo htmlspecialchars($doctor->yoeDoctor()) ?>" />
                </div>
                <div>
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of
                        joining</label>
                    <input type="date" name="doj" id="company"
                        value="<?php echo htmlspecialchars($doctor->joinDateDoctor()) ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Y.O.E" required />
                </div>
                <div>
                    <label for="website"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qualification</label>
                    <input type="text" name="qualification" id="website"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="MBBS" required
                        value="<?php echo htmlspecialchars($doctor->getQualification()) ?>" />
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Number</label>
                    <input type="text" id="phone-input" name="phoneno" aria-describedby="helper-text-explanation"
                        value="<?php echo htmlspecialchars($doctor->phoneNoDoctor()) ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="123-456-7890" required />
                </div>
                <div>
                    <label for="Specialization"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Specialization</label>
                    <select id="Specialization" name="specialization"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected><?php echo htmlspecialchars($doctor->specialDoctor());  ?></option>
                        <option value="General Practitioner">General Practitioner </option>
                        <option value="Pediatrician">Pediatrician</option>
                        <option value="Cardiologist">Cardiologist</option>
                        <option value="Dermatologist">Dermatologist</option>
                        <option value="Psychiatrist">Psychiatrist</option>
                        <option value="Gastroenterologist">Gastroenterologist</option>
                    </select>
                </div>
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                    address</label>
                <input type="email" id="email" name="email"
                    value="<?php echo htmlspecialchars($doctor->getDoctorEmail()) ?>"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="john.doe@company.com" required />
            </div>
            <button type="submit" name="updatebtn"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
        </form>
        <?php $db->close() ?>
    </main>
    <?php include '../templates/footer.php'; ?>
</body>
</html>