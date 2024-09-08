<?php
// Start output buffering
ob_start();
// Variable to store value and errors
$doctorName = $appointmentDate  = $appointmentReason = "";
$doctorNameError = $appointmentReasonError = "";
// Start validating
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Creating a flag if something happen
    $isValid = true;
    // Validate doctors
    if ($_POST['doctors'] === 'Doctors') {
        $doctorNameError = "Please select doctor";
        $isValid = false;
    } else {
        $doctorName = test_input($_POST['doctors']);
    }
    // Validate doctors
    if ($_POST['reason'] === 'Appointment Reason') {
        $appointmentReasonError = "Please select appointment";
        $isValid = false;
    } else {
        $appointmentReason = test_input($_POST['reason']);
    }
    // If all input are valid,proceed with data processing and validation
    if ($isValid) {
        $query = http_build_query(array(
            'Status' => $_POST['Status'],
            'doctors' => $doctorName,
            'Appointment_date' => $_POST['Appointment_date'],
            'reason' => $appointmentReason,
            'id' => $_POST['id'],
            'page' => $_POST['page']
        ));
        // Redirect to another page
        header("Location: ../dashboard/add-appointment.php?" . $query);
        exit;
    }
}
ob_end_flush();
// Function to sanitize
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
include '../templates/header.php';
include "../templates/sidebar.php";
?>
<?php
require_once "../config/config.php";
require_once "../src/Database.php";
require_once "../src/Doctor.php";
require_once "../src/DoctorManager.php";
require_once "../src/Patient.php";
require_once "../src/PatientManager.php";
$db = new Database();
$Doctormanager = new DoctorManager($db);
$Patientmanager = new PatientManager($db);
$patient_id = $_GET['id'];
$pageno = $_GET['page'];
$patient = $Patientmanager->getPatient($patient_id);
$doctors = $Doctormanager->getDoctors();
// Get the current date in YYYY-MM-DD format
$currentDate = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
</head>
<body>
    <main>
        <h3 class="text-xl font-bold dark:text-white mb-8">Appointment Booking Form</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo urlencode($_GET['id']); ?>&page=<?php echo urlencode($_GET['page']); ?>" method="post">
            <div class="grid gap-6 mb-6 md:grid-cols-3">
                <div class="mr-3">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($patient->getPatientId()); ?>" />
                    <input type="hidden" name="page" value="<?php echo htmlspecialchars($pageno); ?>" />
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Patient
                        Name</label>
                    <input type="text" name="Patient_name" id="first_name"
                        value="<?php echo $patient->getFullName(); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required readonly />
                </div>
                <div class="mr-8"> 
                    <label for="Doctors"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctors</label>
                    <select id="Doctors" name="doctors"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Doctors</option>
                        <?php foreach ($doctors as $doctor): ?>
                            <option value="<?php echo $doctor->getFullName() ?>"><?php echo $doctor->getFullName() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-red-500 text-sm"><?php echo $doctorNameError; ?></span>
                </div>
                <div class="ml-3">
                    <label for="company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment Date</label>
                    <input type="date" name="Appointment_date" id="company" value="<?php echo htmlspecialchars($appointmentDate); ?>"
                        min="<?php echo htmlspecialchars($currentDate); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                </div>
                <div class="mr-8">
                    <label for="Status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment
                        Status</label>
                    <select id="Specialization" name="Status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Scheduled" selected>Scheduled</option>
                    </select>
                </div>
                <div class="">
                    <label for="Reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment
                        Reason</label>
                    <select id="Specialization" name="reason"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Appointment Reason</option>
                        <option value="Initial Consultation">Initial Consultation </option>
                        <option value="Follow-up Appointment">Follow-up Appointment</option>
                        <option value="Routine Check-up">Routine Check-up</option>
                        <option value="New Symptom or Concern">New Symptom or Concern</option>
                        <option value="Test Results Review">Test Results Review</option>
                        <option value="Prescription or Medication Review">Prescription or Medication Review</option>
                        <option value="Medical Procedure">Medical Procedure</option>
                        <option value="Emergency or Urgent Care">Emergency or Urgent Care</option>
                    </select>
                    <span class="text-red-500 text-sm"><?php echo $appointmentReasonError; ?></span>
                </div>
            </div>
            <button type="submit"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Book</button>
        </form>
    </main>
    <?php $db->close(); ?>
    <?php include '../templates/footer.php'; ?>
</body>
</html>