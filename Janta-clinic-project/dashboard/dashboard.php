<?php
// start session
session_start(); // start session
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/PatientManager.php';
require_once '../src/Patient.php';
require_once '../src/BillingManager.php';
require_once '../src/Billing.php';
require_once '../src/AppointmentManager.php';
require_once '../src/Appointment.php';
require_once '../src/ServiceManager.php';
require_once '../src/Service.php';
require_once '../src/BillingServiceManager.php';
$totalPatientToday = isset($_SESSION['Patient register']) ? $_SESSION['Patient register'] : 0;
$db = new Database();
$appointmentmanager = new AppointmentManager($db);
$appointmentcounttoday = $appointmentmanager->appointmentTakenToday();
$appointmentFuture = $appointmentmanager->AppointmentFuture();
$appointmentcountcompleted = $appointmentmanager->appointmentTakenCompleted();
$billingmanager = new BillingManager($db);
$billingtoday = $billingmanager->getMoneyCollectedToday();
include '../templates/header.php';
include  "../templates/sidebar.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <main class="">
        <div class="">
            <h1
                class="mb-6 mt-6 text-2xl font-extrabold leading-none tracking-tight text-gray-500 md:text-4xl lg:text-3xl dark:text-white">
                Dashboard</h1>
            <a href="../dashboard/report-pdf.php?id=<?php echo htmlspecialchars($totalPatientToday);?>" target="_blank"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Generate Report</a>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 bt-4 mt-6">
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-500 dark:text-white mb-8">Overall report
                        janta clinic</h5>
                    <a href="../dashboard/dashboard-admin-login.php"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Show
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-500 dark:text-white">Today's
                            Patients Registered</h5>
                    </a>
                    <h2 class="text-2xl font-extrabold dark:text-white text-red-700 mb-4 mt-2">
                        <?php echo htmlspecialchars($totalPatientToday); ?></h2>
                </div>
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-500 dark:text-white">Today's
                            Appointments Schedule</h5>
                    </a>
                    <h2 class="text-2xl font-extrabold dark:text-white text-red-700 mb-4 mt-2">
                        <?php echo htmlspecialchars($appointmentcounttoday); ?></h2>
                    <a href="../dashboard/today-appoinment.php"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        More detail
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-500 dark:text-white">Today's Money
                            Collected</h5>
                    </a>
                    <h2 class="text-2xl font-extrabold dark:text-white text-red-700 mb-4 mt-2"> <span>Rs
                        </span><?php echo htmlspecialchars($billingtoday); ?></h2>
                </div>
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-500 dark:text-white">Upcoming
                            Appointments</h5>
                    </a>
                    <h2 class="text-2xl font-extrabold dark:text-white text-red-700 mb-4 mt-2">
                        <?php echo htmlspecialchars($appointmentFuture); ?></h2>
                    <a href="../dashboard/upcoming-appointment.php"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        More detail
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
                <div
                    class="max-w-sm p-6 bg-white border border-grey-700 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-500 dark:text-white">Completed
                            Appointments</h5>
                    </a>
                    <h2 class="text-2xl font-extrabold dark:text-white text-red-700 mb-4 mt-2">
                        <?php echo htmlspecialchars($appointmentcountcompleted); ?></h2>
                    <a href="../dashboard/completed-appointment.php"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        More detail
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>
            <!-- Chart Section -->
          <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-500 dark:text-white mb-4">Clinic Performance Overview</h2>
            <canvas id="clinicChart"></canvas>
        </div>
        </div>
    </main>
    <?php include '../templates/footer.php'  ?>
     <!-- Chart.js Initialization Script -->
     <script>
        const ctx = document.getElementById('clinicChart').getContext('2d');
        const clinicChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Today\'s Patients', 'Today\'s Appointments', 'Upcoming Appointments', 'Completed Appointments'],
                datasets: [{
                    label: 'Counts',
                    data: [
                        <?php echo htmlspecialchars($totalPatientToday); ?>,
                        <?php echo htmlspecialchars($appointmentcounttoday); ?>,
                        <?php echo htmlspecialchars($appointmentFuture); ?>,
                        <?php echo htmlspecialchars($appointmentcountcompleted); ?>
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>