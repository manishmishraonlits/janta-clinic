<?php
class PatientManager
{
    private $db;
    // Constructor
    public function __construct($db)
    {
        $this->db = $db;
    }
    // get all patients
    public function getPatients()
    {
        // Query to get all patient information along with address details
        $query = "
     SELECT 
         Patient.Patient_ID, 
         Patient.first_name, 
         Patient.middle_name, 
         Patient.last_name, 
         Patient.age, 
         Patient.gender, 
         Patient.weight, 
         Patient.bmi, 
         Patient.blood_group, 
         Patient.medical_history,
         Address.street, 
         Address.city, 
         Address.state, 
         Address.zipcode
     FROM Patient
     INNER JOIN Address ON Address.Patient_ID_FK = Patient.Patient_ID
 ";
        // Running query to get all Patient information
        $result_obj = $this->db->query($query);
        // Array object to hold all patient object
        $Patients = [];
        while ($row = $result_obj->fetch_assoc()) {
            // Creating address object
            $address_obj = new Address(
                $row['street'],
                $row['city'],
                $row['state'],
                $row['zipcode']
            );
            // Creating Patient object with address object
            $patient_obj = new Patient(
                $row['Patient_ID'],
                $row['first_name'],
                $row['middle_name'],
                $row['last_name'],
                $row['age'],
                $row['gender'],
                $row['weight'],
                $row['bmi'],
                $row['blood_group'],
                $row['medical_history'],
                $address_obj // Pass Address object to Patient
            );
            $Patients[] = $patient_obj;
        }
        return $Patients;
    }
    // get patient by limit and offset
    public function getPatientsPagination($offset, $limit)
    {
        $offset = (int) $offset;
        $limit = (int) $limit;
        // Query to get all patient information along with address details
        $query = "
     SELECT 
         Patient.Patient_ID, 
         Patient.first_name, 
         Patient.middle_name, 
         Patient.last_name, 
         Patient.age, 
         Patient.gender, 
         Patient.weight, 
         Patient.bmi, 
         Patient.blood_group, 
         Patient.medical_history,
         Address.street, 
         Address.city, 
         Address.state, 
         Address.zipcode
     FROM Patient
     INNER JOIN Address ON Address.Patient_ID_FK = Patient.Patient_ID
     LIMIT $offset,$limit
 ";
        // Running query to get all Patient information
        $result_obj = $this->db->query($query);
        // Array object to hold all patient object
        $Patients = [];
        while ($row = $result_obj->fetch_assoc()) {
            // Creating address object
            $address_obj = new Address(
                $row['street'],
                $row['city'],
                $row['state'],
                $row['zipcode']
            );
            // Creating Patient object with address object
            $patient_obj = new Patient(
                $row['Patient_ID'],
                $row['first_name'],
                $row['middle_name'],
                $row['last_name'],
                $row['age'],
                $row['gender'],
                $row['weight'],
                $row['bmi'],
                $row['blood_group'],
                $row['medical_history'],
                $address_obj // Pass Address object to Patient
            );
            $Patients[] = $patient_obj;
        }
        return $Patients;
    }
    // Get patient by id
    public function getPatient($id)
    {
        $id = (int)$id;
        // Query to get all patient information along with address details
        $query = "
     SELECT 
         Patient.Patient_ID, 
         Patient.first_name, 
         Patient.middle_name, 
         Patient.last_name, 
         Patient.age, 
         Patient.gender, 
         Patient.weight, 
         Patient.bmi, 
         Patient.blood_group, 
         Patient.medical_history,
         Address.street, 
         Address.city, 
         Address.state, 
         Address.zipcode
     FROM Patient
     INNER JOIN Address ON Address.Patient_ID_FK = Patient.Patient_ID WHERE Patient_ID = {$id}
 ";
        $result_obj = $this->db->query($query);
        $result = $result_obj->fetch_assoc();
        if ($result) {
            // Creating address object
            $address_obj = new Address(
                $result['street'],
                $result['city'],
                $result['state'],
                $result['zipcode']
            );
            // Creating Patient object with address object
            $patient_obj = new Patient(
                $result['Patient_ID'],
                $result['first_name'],
                $result['middle_name'],
                $result['last_name'],
                $result['age'],
                $result['gender'],
                $result['weight'],
                $result['bmi'],
                $result['blood_group'],
                $result['medical_history'],
                $address_obj // Pass Address object to Patient
            );
        } else return null;
        return $patient_obj;
    }
    // Add patient
    public function addPatient($firstname, $middlename, $lastname, $age, $gender, $weight, $bmi, $blood_group, $medical_history, $street, $city, $state, $zipcode)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            // Sanitizing each value (avoid sql injection)
            $firstname = $this->db->escape($firstname);
            $middlename = $this->db->escape($middlename);
            $lastname = $this->db->escape($lastname);
            $age = $this->db->escape($age);
            $gender = $this->db->escape($gender);
            $weight = $this->db->escape($weight);
            $bmi = $this->db->escape($bmi);
            $blood_group = $this->db->escape($blood_group);
            $medical_history = $this->db->escape($medical_history);
            $street = $this->db->escape($street);
            $city = $this->db->escape($city);
            $state = $this->db->escape($state);
            $zipcode = $this->db->escape($zipcode);
            $query = "
                 INSERT INTO Patient (first_name, middle_name, last_name, age, gender, weight, bmi, blood_group, medical_history)
                 VALUES
                 ('$firstname','$middlename','$lastname','$age','$gender','$weight','$bmi','$blood_group','$medical_history');";
            // Execute the Query
            $this->db->query($query);
            // Get the last inserted patient id
            $last_patient_id = $this->db->getLastInsertId();
            // Address query
            $address_query = "
                 INSERT INTO Address (street, city, state, zipcode, Patient_ID_FK)
                 VALUES
                 ('$street','$city','$state','$zipcode','$last_patient_id');";
            // Executing address query
            $this->db->query($address_query);
            // commit the transaction
            $this->db->Commit();
            return true;
        } catch (Exception $e) {
            // Rollback transaction if any error occurs
            $this->db->RollBack();
            return false;
        }
    }
    // Update Patient
    public function updatePatient($id, $firstname, $middlename, $lastname, $age, $gender, $weight, $bmi, $blood_group, $medical_history, $street, $city, $state, $zipcode)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            $id = (int) $id;
            // Sanitizing each value (avoid sql injection)
            $firstname = $this->db->escape($firstname);
            $middlename = $this->db->escape($middlename);
            $lastname = $this->db->escape($lastname);
            $age = $this->db->escape($age);
            $gender = $this->db->escape($gender);
            $weight = $this->db->escape($weight);
            $bmi = $this->db->escape($bmi);
            $blood_group = $this->db->escape($blood_group);
            $medical_history = $this->db->escape($medical_history);
            $street = $this->db->escape($street);
            $city = $this->db->escape($city);
            $state = $this->db->escape($state);
            $zipcode = $this->db->escape($zipcode);
            $query = "
            UPDATE Patient
            SET 
            first_name = '$firstname', 
            middle_name = '$middlename', 
            last_name = '$lastname', 
            age = '$age', 
            gender = '$gender', 
            weight = '$weight', 
            bmi = '$bmi', 
            blood_group = '$blood_group', 
            medical_history = '$medical_history'
            WHERE Patient_ID = '$id';";
            // Execute the Query
            $this->db->query($query);
            // Address query
            $address_query = "
            UPDATE Address
            SET 
            street = '$street', 
            city = '$city', 
            state = '$state', 
            zipcode = '$zipcode'
            WHERE Patient_ID_FK = '$id';";
            // Executing address query
            $this->db->query($address_query);
            // commit the transaction
            $this->db->Commit();
            return true;
        } catch (Exception $e) {
            // Rollback transaction if any error occurs
            $this->db->RollBack();
            return false;
        }
    }
    // Delete patient
    public function deletePatient($id)
    {
        try {
            // Begin Transaction
            $this->db->Transaction();
            // Sanitizing the id
            $id = (int) $id;
            // Delete address associated with patient first
            $addressQuery = "DELETE FROM Address WHERE Patient_ID_FK = '$id';";
            // Running query 
            $this->db->query($addressQuery);
            $patientQuery = "DELETE FROM Patient WHERE Patient_ID = '$id';";
            // Running query
            $this->db->query($patientQuery);
            // Commit the transaction
            $this->db->Commit();
            return true;
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->db->RollBack();
            return false;
        }
    }
    // Function for search patient
    public function searchPatients($searchvalue)
    {
        // Sanitizing it
        $searchvalue = $this->db->escape($searchvalue);
        // Check if serach term is numeric
        if (is_numeric($searchvalue)) {
            // Query for search with patient id
            $query = "
        SELECT 
            Patient.Patient_ID, 
            Patient.first_name, 
            Patient.middle_name, 
            Patient.last_name, 
            Patient.age, 
            Patient.gender, 
            Patient.weight, 
            Patient.bmi, 
            Patient.blood_group, 
            Patient.medical_history,
            Address.street, 
            Address.city, 
            Address.state, 
            Address.zipcode
        FROM Patient
        INNER JOIN Address ON Address.Patient_ID_FK = Patient.Patient_ID
        WHERE Patient.Patient_ID = '$searchvalue'";
        } else {
            // Query for search with first name
            // Query to search by first name (case insensitive)
            $query = "
            SELECT 
                Patient.Patient_ID, 
                Patient.first_name, 
                Patient.middle_name, 
                Patient.last_name, 
                Patient.age, 
                Patient.gender, 
                Patient.weight, 
                Patient.bmi, 
                Patient.blood_group, 
                Patient.medical_history,
                Address.street, 
                Address.city, 
                Address.state, 
                Address.zipcode
            FROM Patient
            INNER JOIN Address ON Address.Patient_ID_FK = Patient.Patient_ID
            WHERE LOWER(Patient.first_name) LIKE LOWER('%$searchvalue%')";
        }
        // Execute the query
        $result_obj = $this->db->query($query);
        // Array to hold data
        $patients = [];
        // Loop through resutl and create patient objects
        while ($row = $result_obj->fetch_assoc()) {
            // Creating address object
            $address_obj = new Address(
                $row['street'],
                $row['city'],
                $row['state'],
                $row['zipcode']
            );
            // Creating patient object with address object
            $patient_obj = new Patient(
                $row['Patient_ID'],
                $row['first_name'],
                $row['middle_name'],
                $row['last_name'],
                $row['age'],
                $row['gender'],
                $row['weight'],
                $row['bmi'],
                $row['blood_group'],
                $row['medical_history'],
                $address_obj // Pass Address object to Patient
            );
            // Add to patients
            $patients[] = $patient_obj;
        }
        return $patients;
    }
    // Function to get total patient count
    public function getPatientsCount()
    {
        $query = "SELECT COUNT(*) AS Patient_Count FROM Patient";
        $result = $this->db->query($query);
        if ($row = $result->fetch_assoc()) {
            $count = $row['Patient_Count'];
            return $count;
        } else {
            return 0;
        }
    }
}
