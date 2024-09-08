<?php
session_start();
$useridError = $passwordError = "";
// Check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  header("Location: main.php");
  exit;
}
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/Staff.php';
require_once '../src/StaffManager.php';
$db = new Database();
$staffmanager = new StaffManager($db);
$staffs = $staffmanager->getAllStaff();
$userid = false;
$password = false;
// Start validating
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $inputId = (int)$_POST['id'];
  $inputPassword = $_POST['password'];
  // Admin Login Check
  if ($inputId === 911) {
    $userid = true;
    if ($inputPassword === '123') {
      $_SESSION['loggedin'] = true;
      header("Location: main.php");
      exit;
    } else {
      $passwordError = "Wrong password";
    }
  }
  if ($staffs) {
    foreach ($staffs as $staff) {
      if ($staff->getStaffId() === $_POST['id']) {
        $userid = true;
        if (password_verify($_POST['password'], $staff->getStaffPassword())) {
          $password = true;
          $_SESSION['loggedin'] = true;
          header("Location: main.php");
          exit;
        } else {
          $passwordError = "Wrong password";
        }
        break;
      }
    }
  }
}
if (isset($_POST['id'])) {
  if (!$userid) {
    $useridError = "Enter valid clinic ID";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Admin Page</title>
</head>
<body>
    <main class="grid w-full md:grid-cols-2">
        <section class="text-center">
            <div>
                <h1
                    class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-6xl dark:text-white">
                    Janta Clinic</h1>
            </div>
            <p class="mb-6 text-lg font-normal text-blue-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
                Admin/Staff Login</p>
        </section>
        <section>
            <form class="max-w-sm mx-auto" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        Id</label>
                    <input type="number" name="id" id="username"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Enter your clinic ID" required />
                    <span class="text-red-500 text-sm"><?php echo $useridError; ?></span>
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        password</label>
                    <input type="password" id="password" name="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        required />
                    <span class="text-red-500 text-sm"><?php echo $passwordError; ?></span>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
            </form>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>
</html>