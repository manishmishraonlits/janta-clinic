<?php
// Start output buffering
ob_start();
include '../templates/header.php';
include "../templates/sidebar.php";
require_once "../config/config.php";
require_once "../src/Database.php";
require_once "../src/Appointment.php";
require_once "../src/AppointmentManager.php";
$db = new Database();
$appointmentmanager = new AppointmentManager($db);
$id = $_POST['id'];
$status = $_POST['Status'];
$doctor = $_POST['Doctor_name'];
$appointmentdate = $_POST['Appointment_date'];
$reason = $_POST['Reason'];
$pageNo = $_POST['page'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updatebtn'])) {
        $appointmentmanager->updateAppointment($id, $status, $doctor, $appointmentdate, $reason);
        header("Location: http://localhost:8080/Janta-clinic/dashboard/appointment-manage.php?id=". urlencode($id)."&page=".urldecode($pageNo));
        $db->close();
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
    <title>Appointment Updation</title>
</head>
<body>
    <main>
        <h3 class="text-xl font-bold dark:text-white mb-8">Appointment Updation Form</h3>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <?php
            require_once "../config/config.php";
            require_once "../src/Database.php";
            require_once "../src/Doctor.php";
            require_once "../src/DoctorManager.php";
            require_once "../src/Patient.php";
            require_once "../src/PatientManager.php";
            require_once "../src/Appointment.php";
            require_once "../src/AppointmentManager.php";
            $db = new Database();
            $Doctormanager = new DoctorManager($db);
            $Patientmanager = new PatientManager($db);
            $Appointmentmanager = new AppointmentManager($db);
            $appointment_id = $_GET['id'];
            $pageno = $_GET['page'];
            $appointment = $Appointmentmanager->getappointmentId($appointment_id);
            $doctors = $Doctormanager->getDoctors();
            ?>
            <div class="grid gap-6 mb-6 md:grid-cols-3">
                <div>
                    <input type="hidden" name="id"
                        value="<?php echo htmlspecialchars($appointment->AppointmentId()); ?>" />
                    <input type="hidden" name="page" value="<?php echo htmlspecialchars($pageno); ?>" />
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Patient
                        Name</label>
                    <input type="text" name="Patient_name" id="first_name" value="<?php
                                                                                    $patient_id = $appointment->getFK();
                                                                                    $patient = $Patientmanager->getPatient($patient_id);
                                                                                    echo htmlspecialchars($patient->getFullName());
                                                                                    ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required readonly />
                </div>
                <div>
                    <label for="Doctors"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctors</label>
                    <select id="Doctors" name="Doctor_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected><?php echo htmlspecialchars($appointment->getDoctorName()); ?></option>
                        <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor->getFullName() ?>"><?php echo $doctor->getFullName() ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment Date</label>
                    <input type="date" name="Appointment_date" id="company"
                        value="<?php echo htmlspecialchars($appointment->getAppointmentDate()); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                </div>
                <div>
                    <label for="Status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment
                        Status</label>
                    <select id="Specialization" name="Status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Scheduled" selected>Scheduled</option>
                        <option value="Completed">Completed </option>
                    </select>
                </div>
                <div>
                    <label for="Reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appointment
                        Reason</label>
                    <select id="Specialization" name="Reason"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected><?php echo htmlspecialchars($appointment->getReason()); ?></option>
                        <option value="Initial Consultation">Initial Consultation </option>
                        <option value="Follow-up Appointment">Follow-up Appointment</option>
                        <option value="Routine Check-up">Routine Check-up</option>
                        <option value="New Symptom or Concern">New Symptom or Concern</option>
                        <option value="Test Results Review">Test Results Review</option>
                        <option value="Prescription or Medication Review">Prescription or Medication Review</option>
                        <option value="Medical Procedure">Medical Procedure</option>
                        <option value="Emergency or Urgent Care">Emergency or Urgent Care</option>
                    </select>
                </div>
            </div>
            <button type="submit" name="updatebtn"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Update</button>
        </form>
    </main>
    <?php $db->close(); ?>
    <?php include '../templates/footer.php'; ?>
</body>
</html>