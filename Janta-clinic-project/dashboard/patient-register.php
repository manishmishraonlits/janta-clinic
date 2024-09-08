<?php
// Start output buffering
ob_start();
// Initialize variable to store input values and error message
$firstName = $middleName = $lastName = $age = $gender = $weight = $bmi = $bloodGroup = $state = $city = $street = $zipcode = $medicalHistory = "";
$firstNameErr = $middleNameErr = $lastNameErr = $ageErr = $genderErr = $weightErr = $bmiErr = $bloodGroupErr = $stateErr = $cityErr = $streetErr = $zipcodeErr = $medical_error = "";
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Creating a flag to if something happen
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
    // Validate Age
    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
        $isValid = false;
    } elseif (!is_numeric($_POST["age"]) || $_POST["age"] <= 0 || $_POST["age"] >= 120) {
        $ageErr = "Invalid age";
        $isValid = false;
    } else {
        $age = test_input($_POST["age"]);
    }
    // Validate Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        $isValid = false;
    } elseif ($_POST['gender'] === "Gender") {
        $genderErr = "Select your gender";
        $isValid = false;
    } else {
        $gender = test_input($_POST["gender"]);
    }
    // Validate Weight
    if (empty($_POST["weight"])) {
        $weightErr = "Weight is required";
        $isValid = false;
    } elseif (!is_numeric($_POST["weight"]) || $_POST["weight"] <= 0 || $_POST["weight"] >= 727) {
        $weightErr = "Invalid weight";
        $isValid = false;
    } else {
        $weight = test_input($_POST["weight"]);
    }
    // Validate BMI
    if (empty($_POST["bmi"])) {
        $bmiErr = "BMI is required";
        $isValid = false;
    } elseif (!is_numeric($_POST["bmi"]) || $_POST["bmi"] <= 0 || $_POST["bmi"] >= 186) {
        $bmiErr = "Invalid BMI";
        $isValid = false;
    } else {
        $bmi = test_input($_POST["bmi"]);
    }
    // Validate Blood Group
    if (empty($_POST["blood_group"])) {
        $bloodGroupErr = "Blood group is required";
        $isValid = false;
    } elseif (strlen($_POST['blood_group']) > 3) {
        $bloodGroupErr = "Select your blood group";
        $isValid = false;
    } else {
        $bloodGroup = test_input($_POST["blood_group"]);
    }
    // Validate State
    if (empty($_POST["state"])) {
        $stateErr = "State is required";
        $isValid = false;
    } else if (!preg_match("/^[a-zA-Z]+$/", $_POST["state"])) {
        $stateErr = "State name must contain only letters";
        $isValid = false;
    } else {
        $state = test_input($_POST["state"]);
    }
    // Validate City
    if (empty($_POST["city"])) {
        $cityErr = "City is required";
        $isValid = false;
    } else if (!preg_match("/^[a-zA-Z]+$/", $_POST["city"])) {
        $cityErr = "City name must contain only letters";
        $isValid = false;
    } else {
        $city = test_input($_POST["city"]);
    }
    // Validate Street
    if (empty($_POST["street"])) {
        $streetErr = "Street is required";
        $isValid = false;
    } else {
        $street = test_input($_POST["street"]);
    }
    // Validate Zip Code
    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "Zip code is required";
        $isValid = false;
    } elseif (!preg_match("/^\d{6}$/", $_POST["zipcode"])) {
        $zipcodeErr = "Invalid zip code";
        $isValid = false;
    } else {
        $zipcode = test_input($_POST["zipcode"]);
    }
    // Validate medical history
    if (empty($_POST['medical_history'])) {
        $medical_error = "Medical History can't be Empty";
        $isValid = false;
    } else {
        $medicalHistory = test_input($_POST['medical_history']);
    }
    // If all input are valid,proceed with data processing and validation
    if ($isValid) {
        $query = http_build_query(array(
            'firstname' => $firstName,
            'middlename' => $middleName,
            'lastname' => $lastName,
            'age' => (int)$age,
            'gender' => $gender,
            'weight' => (int) $weight,
            'bmi' => $bmi,
            'blood_group' => $bloodGroup,
            'state' => $state,
            'city' => $city,
            'street' => $street,
            'zipcode' => $zipcode,
            'medical_history' => $medicalHistory
        ));
        // Example: Redirect to another page
        header("Location: ../dashboard/add-patient.php?" . $query);
        exit;
    }
}
include '../templates/header.php';
include '../templates/sidebar.php';
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
        <h3 class="text-xl font-bold dark:text-white mb-8">Patient Registration Form</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="grid gap-6 mb-6  md:grid-cols-3 ">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                        name</label>
                    <input type="text" id="first_name" name="firstname"
                        value="<?php echo htmlspecialchars($firstName); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ankit" required />
                    <span class="text-red-500 text-sm"><?php echo $firstNameErr; ?></span>
                </div>
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                        Name</label>
                    <input type="text" id="middle_name" name="middlename"
                        value="<?php echo htmlspecialchars($middleName); ?>"
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
                    <label for="company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                    <input type="number" id="company" name="age" value="<?php echo htmlspecialchars($age); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Age" required />
                    <span class="text-red-500 text-sm"><?php echo $ageErr; ?></span>
                </div>
                <div>
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Your
                        Gender</label>
                    <select id="countries" name="gender"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <span class="text-red-500 text-sm"><?php echo $genderErr; ?></span>
                </div>
                <div>
                    <label for="company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight</label>
                    <input type="number" id="company" name="weight" value="<?php echo htmlspecialchars($weight); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="In Kg" required />
                    <span class="text-red-500 text-sm"><?php echo $weightErr; ?></span>
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">BMI</label>
                    <input type="text" id="text" name="bmi" value="<?php echo htmlspecialchars($bmi); ?>" step="0.01"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="BMI" required />
                    <span class="text-red-500 text-sm"><?php echo $bmiErr; ?></span>
                </div>
                <div>
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Blood Group</label>
                    <select id="countries" name="blood_group"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    <span class="text-red-500 text-sm"><?php echo $bloodGroupErr; ?></span>
                </div>
                <div>
                    <label for="website"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State</label>
                    <input type="text" id="website" name="state" value="<?php echo htmlspecialchars($state); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Bihar" required />
                    <span class="text-red-500 text-sm"><?php echo $stateErr; ?></span>
                </div>
                <div>
                    <label for="website"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                    <input type="text" id="website" name="city" value="<?php echo htmlspecialchars($city); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Muzaffarpur" required />
                    <span class="text-red-500 text-sm"><?php echo $cityErr; ?></span>
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street
                        Name</label>
                    <input type="text" id="website" name="street" value="<?php echo htmlspecialchars($street); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Street Name" required />
                    <span class="text-red-500 text-sm"><?php echo $streetErr; ?></span>
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip
                        Code</label>
                    <input type="text" id="website" name="zipcode" value="<?php echo htmlspecialchars($zipcode); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="12345" pattern="\d{6}" maxlength="6" required />
                    <span class="text-red-500 text-sm"><?php echo $zipcodeErr; ?></span>
                </div>
            </div>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medical
                History</label>
            <textarea id="message" rows="4" name="medical_history"
                class="block p-2.5  text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 my-4"
                placeholder="Write your Medical History..."><?php echo htmlspecialchars($medicalHistory); ?></textarea>
            <span class="text-red-500 text-sm mr-2"><?php echo $medical_error ?></span>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </main>
    <?php include '../templates/footer.php'; ?>
</body>
</html>