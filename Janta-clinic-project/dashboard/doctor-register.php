<?php
// Start output buffering
ob_start();
// Variable to store value and errors
$firstName = $middleName = $lastName = $yoe = $doj = $qualification = $contact = $specialization = $email = "";
$firstNameError = $middleNameError = $lastNameError = $yoeError = $dobError = $qualificationError = $contactError = $specializationError = "";
// Start validating
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Creating a flag if something happen
    $isValid = true;
    // Validate First Name
    if (empty($_POST["firstname"])) {
        $firstNameErr = "First name is required";
        $isValid = false;
    }
    // the first name contains only letters
    else if (!preg_match("/^[a-zA-Z]+$/", $_POST["firstname"])) {
        $firstNameErr = "First name must contain only letters";
        $isValid = false;
    } else {
        $firstName = test_input($_POST["firstname"]);
    }
    // For Middle Name (optional)
    if (!empty($_POST["middlename"])) {
        if (!preg_match("/^[a-zA-Z]+$/", $_POST['middlename'])) {
            $middleNameErr = "Middle name must contain only letters";
            $isValid = false;
        } else {
            $middleName = test_input($_POST["middlename"]);
        }
    } else {
        $middleName = "";
    }
    // Validate Last Name
    if (empty($_POST["lastname"])) {
        $lastNameErr = "Last name is required";
        $isValid = false;
    }
    // the Last name contains only letters
    else if (!preg_match("/^[a-zA-Z]+$/", $_POST['lastname'])) {
        $lastNameErr = "Last name must contain only letters";
        $isValid = false;
    } else {
        $lastName = test_input($_POST["lastname"]);
    }
    // Validate year of experience
    if (empty($_POST['yoe'])) {
        $yoeError = "Please enter experience";
        $isValid = false;
    } else if ($_POST['yoe'] < 0 || $_POST['yoe'] > 50) {
        $yoeError = "Please enter valid experience!";
        $isValid = false;
    } else {
        $yoe = test_input($_POST['yoe']);
    }
    // Validate date of joining
    if (empty($_POST['doj'])) {
        $dobError = "Please select date of joining";
        $isValid = false;
    } else {
        $doj = test_input($_POST['doj']);
    }
    // Validate qualification
    if (empty($_POST['qualification'])) {
        $qualificationError = "Please enter qualification";
        $isValid = false;
    } else if (!preg_match("/^[a-zA-Z]+$/", $_POST['qualification'])) {
        $qualificationError = "Qualification must contain only letters";
        $isValid = false;
    } else {
        $qualification = test_input($_POST['qualification']);
    }
    // Validate contact number
    if (empty($_POST['phoneno'])) {
        $contactError = "Please enter contact number";
        $isValid = false;
    } else {
        $contact = test_input($_POST['phoneno']);
    }
    // Validate specialization
    if ($_POST['specialization'] === 'Specialization') {
        $specializationError = "Please select specialization";
        $isValid = false;
    } else {
        $specialization = test_input($_POST['specialization']);
    }
    if (!empty($_POST['email'])) {
        $email = test_input($_POST['email']);
    }
    // If all input are valid,proceed with data processing and validation
    if ($isValid) {
        $query = http_build_query(array(
            'firstname' => $firstName,
            'middlename' => $middleName,
            'lastname' => $lastName,
            'yoe' => $yoe,
            'doj' => $doj,
            'qualification' => $qualification,
            'phoneno' => $contact,
            'specialization' => $specialization,
            'email' => $email
        ));
        // Example: Redirect to another page
        header("Location: ../dashboard/add-doctor.php?" . $query);
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
    <title>Doctor Registration</title>
</head>
<body>
    <main>
        <h3 class="text-xl font-bold dark:text-white mb-8">Doctor Registration Form</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                        name</label>
                    <input type="text" name="firstname" id="first_name" value="<?php echo htmlspecialchars($firstName); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ankit" required />
                    <span class="text-red-500 text-sm"><?php echo $firstNameErr; ?></span>
                </div>
                <div>
                    <label for="middle_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Middle
                        Name</label>
                    <input type="text" name="middlename" id="first_name" value="<?php echo htmlspecialchars($middleName); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Arya" />
                    <span class="text-red-500 text-sm"><?php echo $middleNameErr; ?></span>
                </div>
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                        name</label>
                    <input type="text" id="last_name" name="lastname" value="<?php echo htmlspecialchars($lastName); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Kumar" required />
                    <span class="text-red-500 text-sm"><?php echo $lastNameErr; ?></span>
                </div>
                <div>
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year of
                        experience</label>
                    <input type="number" name="yoe" id="company" value="<?php echo htmlspecialchars($yoe); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Y.O.E" required />
                    <span class="text-red-500 text-sm"><?php echo $yoeError; ?></span>
                </div>
                <div>
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of
                        joining</label>
                    <input type="date" name="doj" id="company" min="<?php echo htmlspecialchars($currentDate); ?>" value="<?php echo htmlspecialchars($doj); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Y.O.E" required />
                    <span class="text-red-500 text-sm"><?php echo $dobError; ?></span>
                </div>
                <div>
                    <label for="website"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qualification</label>
                    <input type="text" name="qualification" id="website" value="<?php echo htmlspecialchars($qualification); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="MBBS" required />
                    <span class="text-red-500 text-sm"><?php echo $qualificationError; ?></span>
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Number</label>
                    <input type="text" id="phone-input" name="phoneno" aria-describedby="helper-text-explanation" value="<?php echo htmlspecialchars($contact); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="123-456-7890" pattern="\d{10}" maxlength="10" required />
                    <span class="text-red-500 text-sm"><?php echo $contactError; ?></span>
                </div>
                <div>
                    <label for="Specialization"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Specialization</label>
                    <select id="Specialization" name="specialization"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Specialization</option>
                        <option value="General Practitioner">General Practitioner </option>
                        <option value="Pediatrician">Pediatrician</option>
                        <option value="Cardiologist">Cardiologist</option>
                        <option value="Dermatologist">Dermatologist</option>
                        <option value="Psychiatrist">Psychiatrist</option>
                        <option value="Gastroenterologist">Gastroenterologist</option>
                    </select>
                    <span class="text-red-500 text-sm"><?php echo $specializationError; ?></span>
                </div>
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                    address</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="john.doe@company.com" required />
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </main>
    <?php include '../templates/footer.php'; ?>
</body>
</html>