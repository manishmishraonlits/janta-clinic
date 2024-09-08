<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Panel</title>
</head>
<body>
    <?php
    require_once "../config/config.php";
    require_once "../src/Database.php";
    require_once "../src/Patient.php";
    require_once "../src/address.php";
    require_once "../src/PatientManager.php";
    require_once "../src/Appointment.php";
    require_once "../src/AppointmentManager.php";
    $db = new Database();
    $patient_manager = new PatientManager($db);
    $appointmentmanager = new AppointmentManager($db);
    $patient_id  = $_GET['id'];
    $pageno = $_GET['page'];
    $patient = $patient_manager->getPatient($patient_id);
    $appointments = $appointmentmanager->checkAppointmentStatus($patient_id);
    $flag = true;
    foreach($appointments as $appointment){
        if($appointment->getAppointmentStatus() === "Scheduled"){
            $flag = false;
        }
    }
    include "../templates/header.php";
    include "../templates/sidebar.php";
    ?>
    <main>
        <div class="flex gap-12">
            <div
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ankit Kumar Details</h5>
      </a> -->
                <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Patient Details</h2>
                <div class="mb-5 grid gap-2">
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">ID - </span> <span> <?php echo htmlspecialchars(
                                                                                                            $patient->getPatientId()
                                                                                                        ); ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Name - </span>
                        <span><?php echo htmlspecialchars($patient->getFullName()); ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Age - </span>
                        <span><?php echo htmlspecialchars($patient->getPatientAge()); ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Gender - </span>
                        <span><?php echo htmlspecialchars($patient->getPatientGender()); ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Weight - </span>
                        <span><?php echo htmlspecialchars($patient->getPatientWeight()); ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">BMI - </span>
                        <span><?php echo htmlspecialchars($patient->getPatientBmi()); ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Blood Group - </span>
                        <span><?php echo  htmlspecialchars($patient->getPatientBlood());  ?></span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Address - </span>
                        <span> <?php
                                $address =  $patient->getAddress();
                                echo htmlspecialchars(
                                    $address->getStreet()
                                ); ?></span><br>
                        <span>
                            <?php
                            $address =  $patient->getAddress();
                            echo htmlspecialchars(
                                $address->getCity()
                            ); ?>
                        </span> <br>
                        <span>
                            <?php $address =  $patient->getAddress();
                            echo htmlspecialchars(
                                $address->getState()
                            ); ?>
                        </span> <br>
                        <span>
                            <?php $address =  $patient->getAddress();
                            echo htmlspecialchars(
                                $address->getZipcode()
                            ); ?>
                        </span>
                    </p>
                    <p class="text-grey-500">
                        <span class="font-semibold text-green-500 dark:text-blue">Medical History - </span> <span>
                            <blockquote>
                                <?php echo htmlspecialchars(
                                    $patient->getPatientHistory()
                                ); ?>
                        </span>
                    </p>
                </div>
                <a href="../dashboard/update-patient.php?id=<?php echo htmlspecialchars($patient->getPatientId()); ?>&page=<?php echo htmlspecialchars($pageno);?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Update
                </a>
                <a href="../dashboard/delete-patient.php?id=<?php echo htmlspecialchars($patient->getPatientId()); ?>"
                    onclick="return confirmDeletion();"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Delete
                </a>
                <a href="../dashboard/patient-detail.php?page=<?php echo htmlspecialchars($pageno); ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                    Back to List
                </a>
            </div>
            <div id="Appointment-div flex"
                class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <!-- <a href="#">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ankit Kumar Details</h5>
      </a> -->
                <?php
                require_once "../config/config.php";
                require_once "../src/Database.php";
                require_once "../src/Appointment.php";
                require_once "../src/AppointmentManager.php";
                $db = new Database();
                $patient_id  = $_GET['id'];
                $appointmentmanager = new AppointmentManager($db);
                $appointments = $appointmentmanager->lastTwoAppointment($patient_id);
                ?>
                <h2 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Appointment Detail</h2>
                <div class="grid gap-4">
                    <?php foreach ($appointments as $appointment) : ?>
                        <div class="h-auto max-w-full rounded-lg bg-pink-100 p-4">
                            <h4 class="text-xl font-semibold text-blue-500 mb-2">Previous Appointment</h4>
                            <p class="text-grey-500">
                                <span class="font-semibold text-green-500 dark:text-blue">Appointment Id - </span>
                                <span><?php echo htmlspecialchars($appointment->AppointmentId()); ?></span>
                            </p>
                            <p class="text-grey-500">
                                <span class="font-semibold text-green-500 dark:text-blue">Appointment Date - </span>
                                <span><?php echo htmlspecialchars($appointment->getAppointmentDate()); ?></span>
                            </p>
                            <p class="text-grey-500">
                                <span class="font-semibold text-green-500 dark:text-blue">Seen By - </span>
                                <span>Dr.</span>
                                <span><?php echo htmlspecialchars($appointment->getDoctorName()); ?></span>
                            </p>
                            <p class="text-grey-500">
                                <span class="font-semibold text-green-500 dark:text-blue">Status - </span>
                                <span><?php echo htmlspecialchars($appointment->getAppointmentStatus()); ?></span>
                            </p>
                            <p class="text-grey-500">
                                <span class="font-semibold text-green-500 dark:text-blue">Reason - </span>
                                <span><?php echo htmlspecialchars($appointment->getReason()); ?></span>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if($flag){ ?>
                <a href="../dashboard/appointment-register.php?id=<?php echo htmlspecialchars($patient->getPatientId()); ?>&page=<?php echo htmlspecialchars($pageno); ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 mt-4">
                    Book Appointment
                </a>
                <?php }else{ ?>
                 <p class="mt-4 text-red-700">Patient Appointment is already Sheduled</p>
                <?php } ?>    
            </div>
    </main>
    <script>
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this Patient?");
        }
    </script>
    <?php include '../templates/footer.php'  ?>
</body>
</html>