<?php
// Start output buffering
ob_start();
include "../templates/header.php";
include "../templates/sidebar.php";
require_once "../config/config.php";
require_once "../src/Database.php";
require_once "../src/Patient.php";
require_once "../src/address.php";
require_once "../src/PatientManager.php";
$db = new Database();
$patient_manager = new PatientManager($db);
$firsname = $_POST["firstname"];
$middlename = $_POST["middlename"];
$lastname = $_POST["lastname"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$weight = $_POST["weight"];
$bmi = $_POST["bmi"];
$bloodgroup = $_POST["blood_group"];
$state = $_POST["state"];
$city = $_POST["city"];
$street = $_POST["street"];
$zipcode = $_POST["zipcode"];
$medicalhistory = $_POST["medical_history"];
$patient_id = $_POST["id"];
$pageNO = $_POST['page'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["updatebtn"])) {
        $patient_manager->updatePatient(
            $patient_id,
            $firsname,
            $middlename,
            $lastname,
            $age,
            $gender,
            $weight,
            $bmi,
            $bloodgroup,
            $medicalhistory,
            $street,
            $city,
            $state,
            $zipcode
        );
        header(
            "Location: http://localhost:8080/Janta-clinic/dashboard/patient-manage.php?id=" .
                urlencode($patient_id)."&page=".urldecode($pageNO));
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
    <main>
        <h3 class="text-xl font-bold dark:text-white mb-8">Patient Updation Form</h3>
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
            <?php
            require_once "../config/config.php";
            require_once "../src/Database.php";
            require_once "../src/Patient.php";
            require_once "../src/PatientManager.php";
            $db = new Database();
            $patientManager = new PatientManager($db);
            $patient_id = $_GET["id"];
            $pageno = $_GET['page'];
            $patient = $patientManager->getPatient($patient_id);
            $address = $patient->getAddress();
            ?>
            <div class="grid gap-6 mb-6 md:grid-cols-3">
                <div>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars(
                        $patient->getPatientId()
                    ); ?>" />
                    <input type="hidden" name="page" value="<?php echo htmlentities($pageno);
                     ?>" />
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                        name</label>
                    <input type="text" id="first_name" name="firstname" value="<?php echo htmlspecialchars(
                            $patient->getFirstName()
                        ); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ankit" required />
                </div>
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                        Name</label>
                    <input type="text" id="middle_name" name="middlename" value="<?php echo htmlspecialchars(
                            $patient->getMiddleName()
                        ); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" />
                </div>
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                        name</label>
                    <input type="text" id="last_name" name="lastname" value="<?php echo htmlspecialchars(
                            $patient->getLastName()
                        ); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Kumar" required />
                </div>
                <div>
                    <label for="company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                    <input type="text" id="company" name="age" value="<?php echo htmlspecialchars(
                            $patient->getPatientAge()
                        ); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Age" required />
                </div>
                <div>
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Your
                        Gender</label>
                    <select id="countries" name="gender"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected><?php echo htmlspecialchars(
                            $patient->getPatientGender()
                        ); ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div>
                    <label for="company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight</label>
                    <input type="text" id="company" name="weight" value="<?php echo htmlspecialchars(
                            $patient->getPatientWeight()
                        ); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="In Kg" required />
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">BMI</label>
                    <input type="text" id="text" name="bmi" value="<?php echo htmlspecialchars(
                            $patient->getPatientBmi()
                        ); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="BMI" required />
                </div>
                <div>
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Blood Group</label>
                    <select id="countries" name="blood_group"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected><?php echo htmlspecialchars(
                            $patient->getPatientBlood()
                        ); ?></option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <div>
                    <label for="website"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State</label>
                    <input type="text" id="website" name="state" value="<?php echo htmlspecialchars(
                            $address->getState()
                        ); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Bihar" required />
                </div>
                <div>
                    <label for="website"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                    <input type="text" id="website" name="city" value="<?php echo htmlspecialchars(
                            $address->getCity()
                        ); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Muzaffarpur" required />
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street
                        Name</label>
                    <input type="text" id="website" name="street" value="<?php echo htmlspecialchars(
                            $address->getStreet()
                        ); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Street Name" required />
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip
                        Code</label>
                    <input type="text" id="website" name="zipcode" value="<?php echo htmlspecialchars(
                            $address->getZipcode()
                        ); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="12345" pattern="\d{6}" maxlength="6" required />
                </div>
            </div>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medical
                History</label>
            <textarea id="message" rows="4" name="medical_history"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 my-4"
                placeholder="Write your Medical History..."><?php echo htmlspecialchars(
                    $patient->getPatientHistory()
                ); ?></textarea>
            <button type="submit" name="updatebtn"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
        </form>
        <?php $db->close(); ?>
    </main>
    <?php include "../templates/footer.php"; ?>
</body>
</html>