<?php

// Start output buffering
ob_start();

// Variable to store value and errors
$firstName = $middleName = $lastName = $role = $doh = $contact  = $email = $password =  $passwordverify =  "";
$firstNameError = $middleNameError = $lastNameError = $roleError  = $dohError = $contactError =  $passwordError =  "";

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


    // Validate role
    if ($_POST['role'] === 'Role') {
        $roleError = "Please select role";
        $isValid = false;
    } else {
        $role = test_input($_POST['role']);
    }


    // Validate date of Hiring
    if (empty($_POST['doh'])) {
        $dohError = "Please select date of Hiring";
        $isValid = false;
    } else {
        $doh = test_input($_POST['doh']);
    }


    // Validate contact number
    if (empty($_POST['phoneno'])) {
        $contactError = "Please enter contact number";
        $isValid = false;
    } else {
        $contact = test_input($_POST['phoneno']);
    }


    if (!empty($_POST['email'])) {
        $email = test_input($_POST['email']);
    }

    // Validating password
    if ($_POST['password'] !== $_POST['passwordverify']) {
        $passwordError = "Password does not match";
        $isValid = false;
    } else {
        $password = test_input($_POST['password']);
    }

    // If all input are valid,proceed with data processing and validation
    if ($isValid) {

        $query = http_build_query(array(
            'firstname' => $firstName,
            'middlename' => $middleName,
            'lastname' => $lastName,
            'role' => $role,
            'doh' => $doh,
            'phoneno' => $contact,
            'email' => $email,
            'password' => $password
        ));

        // Redirect to another page
        header("Location: ../dashboard/add-staff.php?" . $query);
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

        <h3 class="text-xl font-bold dark:text-white mb-8">Staff Registration Form</h3>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                        name</label>
                    <input type="text" id="first_name" name="firstname" value="<?php echo htmlspecialchars($firstName); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ankit" required />
                    <span class="text-red-500 text-sm"><?php echo $firstNameErr; ?></span>
                </div>
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                        Name</label>
                    <input type="text" id="middle_name" name="middlename" value="<?php echo htmlspecialchars($middleName); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" />
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
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Your
                        Role</label>
                    <select id="role" name="role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Role</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Administractor">Administrator</option>
                        <option value="Lab Technician">Lab Technician</option>
                        <option value="Pharmacist">Pharmacist</option>
                    </select>
                    <span class="text-red-500 text-sm"><?php echo $roleError; ?></span>
                </div>

                <div>
                    <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of
                        Hiring</label>
                    <input type="date" name="doh" id="" min="<?php echo htmlspecialchars($currentDate); ?>" value="<?php echo htmlspecialchars($doh); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                    <span class="text-red-500 text-sm"><?php echo $dohError; ?></span>
                </div>

                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact
                        Number</label>
                    <input type="text" id="phone-input" name="phoneno" aria-describedby="helper-text-explanation" value="<?php echo htmlspecialchars($contact); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="123-456-7890" pattern="\d{10}" maxlength="10" required />
                    <span class="text-red-500 text-sm"><?php echo $contactError; ?></span>
                </div>



                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                        address</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="john.doe@company.com" required />
                </div>

                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Create
                        Password
                    </label>
                    <input type="password" id="website" name="password" value="<?php echo htmlspecialchars($password); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Password" maxlength="15" required />
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Type password again
                    </label>
                    <input type="password" id="website" name="passwordverify"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Password" maxlength="15" required />
                    <span class="text-red-500 text-sm"><?php echo $passwordError; ?></span>
                </div>

            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>


    </main>



    <?php include '../templates/footer.php'; ?>



</body>

</html>