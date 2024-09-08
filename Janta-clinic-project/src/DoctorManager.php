<?php
class DoctorManager
{
    private $db;
    // Constructor
    public function __construct($db)
    {
        $this->db = $db;
    }
    // Get all Doctors
    public function getDoctors()
    {
        // Running query to get all doctors information in clinic
        $result_obj = $this->db->query("SELECT * FROM Doctor");
        // Creating array object to store all information in key-value pair
        $doctors = [];
        while ($row = $result_obj->fetch_assoc()) {
            $doctors[] = new Doctor(
                $row['Doctor_ID'],
                $row['first_name'],
                $row['middle_name'],
                $row['last_name'],
                $row['email'],
                $row['qualification'],
                $row['year_of_exp'],
                $row['specialization'],
                $row['joining_data'],
                $row['phone_number']
            );
        }
        return $doctors;
    }
    // Get all Doctors
    public function getDoctorsPagination($offset, $limit)
    {
        $offset = (int) $offset;
        $limit = (int)  $limit;
        // Running query to get all doctors information in clinic
        $result_obj = $this->db->query("SELECT * FROM Doctor LIMIT $offset,$limit");
        // Creating array object to store all information in key-value pair
        $doctors = [];
        while ($row = $result_obj->fetch_assoc()) {
            $doctors[] = new Doctor(
                $row['Doctor_ID'],
                $row['first_name'],
                $row['middle_name'],
                $row['last_name'],
                $row['email'],
                $row['qualification'],
                $row['year_of_exp'],
                $row['specialization'],
                $row['joining_data'],
                $row['phone_number']
            );
        }
        return $doctors;
    }
    // Add doctor
    public function addDoctor($firstname, $middlename, $lastname, $email, $qualification, $yearofExp, $specialization, $joiningDate, $phoneNo)
    {
        // Sanitizing for preventing sql injection
        $firstname = $this->db->escape($firstname);
        $middlename = $this->db->escape($middlename);
        $lastname = $this->db->escape($lastname);
        $email = $this->db->escape($email);
        $qualification = $this->db->escape($qualification);
        $yearofExp = $this->db->escape($yearofExp);
        $specialization = $this->db->escape($specialization);
        $joiningDate = $this->db->escape($joiningDate);
        $phoneNo = $this->db->escape($phoneNo);
        // Adding new tuple into doctor
        return $this->db->query(
            "INSERT INTO Doctor (first_name, middle_name, last_name, email, qualification, year_of_exp, specialization, joining_data, phone_number)
         VALUES
         ('{$firstname}','$middlename','$lastname','$email','$qualification','$yearofExp','$specialization','$joiningDate','$phoneNo')
        "
        );
    }
    // Get Doctor by ID
    public function getDoctor($id)
    {
        $id = (int)$id;
        $result = $this->db->query("SELECT * FROM Doctor WHERE Doctor_ID = {$id}");
        $row = $result->fetch_assoc();
        if ($row) {
            return
                new Doctor(
                    $row['Doctor_ID'],
                    $row['first_name'],
                    $row['middle_name'],
                    $row['last_name'],
                    $row['email'],
                    $row['qualification'],
                    $row['year_of_exp'],
                    $row['specialization'],
                    $row['joining_data'],
                    $row['phone_number']
                );
        } else return null;
    }
    // Update doctor
    public function updateDoctor($id, $firstname, $middlename, $lastname, $email, $qualification, $yearofExp, $specialization, $joiningDate, $phoneNo)
    {
        // escape return a string thats why not sanitzing
        $id = (int)$id;
        // Sanitizing for preventing sql injection
        $firstname = $this->db->escape($firstname);
        $middlename = $this->db->escape($middlename);
        $lastname = $this->db->escape($lastname);
        $email = $this->db->escape($email);
        $qualification = $this->db->escape($qualification);
        $yearofExp = $this->db->escape($yearofExp);
        $specialization = $this->db->escape($specialization);
        $joiningDate = $this->db->escape($joiningDate);
        $phoneNo = $this->db->escape($phoneNo);
        return $this->db->query(
            "
          UPDATE Doctor
          SET
              first_name = '{$firstname}',
              middle_name = '{$middlename}',
              last_name = '{$lastname}',
              email = '{$email}',
              qualification = '{$qualification}',
              year_of_exp = '{$yearofExp}',
              specialization = '{$specialization}',
              joining_data = '{$joiningDate}',
              phone_number = '{$phoneNo}'
          WHERE Doctor_ID =  {$id};
        "
        );
    }
    // Delete Doctor 
    public function deleteDoctor($id)
    {
        $id = (int)$id;
        return $this->db->query("DELETE FROM Doctor WHERE Doctor_ID = {$id}");
    }
    // Function to search doctors by ID or first name
    public function getDoctorSearch($searchvalue)
    {
        // Sanitize the search value
        $searchvalue = $this->db->escape($searchvalue);
        // Prepare the query to search by Doctor_ID or first name
        $query = "
        SELECT * 
        FROM Doctor 
        WHERE Doctor_ID = '$searchvalue'
        OR LOWER(first_name) LIKE LOWER('%$searchvalue%')
    ";
        // Execute the query
        $result_obj = $this->db->query($query);
        // Array to store doctor objects
        $doctors = [];
        // Loop through the results and create Doctor objects
        while ($row = $result_obj->fetch_assoc()) {
            $doctors[] = new Doctor(
                $row['Doctor_ID'],
                $row['first_name'],
                $row['middle_name'],
                $row['last_name'],
                $row['email'],
                $row['qualification'],
                $row['year_of_exp'],
                $row['specialization'],
                $row['joining_data'],
                $row['phone_number']
            );
        }
        return $doctors;
    }
    // Function to get doctor count
    public function getDoctorCount()
    {
        $query = "SELECT COUNT(*) AS Patient_Count FROM Doctor";
        $result = $this->db->query($query);
        if ($row = $result->fetch_assoc()) {
            $count = $row['Patient_Count'];
            return $count;
        } else {
            return 0;
        }
    }
}
