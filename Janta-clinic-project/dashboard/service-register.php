<?php 
// Start output buffering
ob_start();
// Variable to store value and errors
$serviceName = $charge  = $textbox =  "";
$serviceNameError = $chargeError = "";
// Start validating
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Creating a flag if something happen
    $isValid = true;
    // Validate Service Name
    if (empty($_POST["servicename"])) {
        $serviceNameError = "Serivce name is required";
        $isValid = false;
    }
    // the first name contains only letters
    else if (!preg_match("/^[a-zA-Z]+$/", $_POST["servicename"])) {
        $serviceNameError = "Service name must contain only letters";
        $isValid = false;
    } else {
        $serviceName = test_input($_POST["servicename"]);
    }
    // Validate charge
    if($_POST['amount'] > 50000){
        $chargeError = "Please enter valid amount";
        $isValid = false;
    } else{
        $charge = test_input($_POST['amount']);
    }
    // validate textbox
    if(empty($_POST['service_detail'])){
        $isValid = false;
    } else{
        $textbox = test_input($_POST['service_detail']);
    }
    // If all input are valid,proceed with data processing and validation
    if ($isValid) {
        $query = http_build_query(array(
            'servicename' => $serviceName,
            'amount' => $charge,
            'service_detail' => $textbox
        ));
        // Redirect to another page
         header("Location: ../dashboard/add-service.php?" . $query);
         exit;
    }
}
// Get the current date in YYYY-MM-DD format
$currentDate = date('Y-m-d');
include '../templates/header.php';
include "../templates/sidebar.php";
ob_end_flush();
// Function to sanitize
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
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
        <h3 class="text-xl font-bold dark:text-white mb-8">Service Registration Form</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="grid gap-8 md:grid-cols-3">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service
                        Name</label>
                    <input type="text" id="middle_name" name="servicename" value="<?php echo htmlspecialchars($serviceName); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Service name" />
                        <span class="text-red-500 text-sm"><?php echo $serviceNameError; ?></span>
                </div>
                <div>
                    <label for="company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Charge</label>
                    <input type="number" name="amount" id="" step="any" value="<?php echo htmlspecialchars($charge); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required placeholder="Rs." />
                        <span class="text-red-500 text-sm"><?php echo $chargeError; ?></span>
                </div>
            </div>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">Service
                Detail</label>
            <textarea id="message" rows="4" name="service_detail" 
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 my-4"
                placeholder="Write your Service Detail..." required><?php echo htmlspecialchars($textbox); ?></textarea>
            <button type="submit" 
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </main>
    <?php include '../templates/footer.php'; ?>
</body>
</html>