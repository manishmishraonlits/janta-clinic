<?php
class StaffManager
{
    private $db;
    // constructor
    public function __construct($db)
    {
        $this->db = $db;
    }
    // Get all staff
    public function getAllStaff()
    {
        $query = "SELECT * FROM Staff";
        $result_object = $this->db->query($query);
        // Array object to store values of staff
        $Staffs = [];
        while ($row = $result_object->fetch_assoc()) {
            // Create a new Staff object and add it to the Staffs array
            $Staffs[] = new Staff(
                $row['Staff_ID'],
                $row['first_name'],
                $row['middle_name'],
                $row['last_name'],
                $row['role'],
                $row['phone_number'],
                $row['email'],
                $row['password_hash'],
                $row['hire_date']
            );
        }
        return $Staffs;
    }
    // Get all staff
    public function getAllStaffPagination($offset, $limit)
    {
        $offset = (int) $offset;
        $limit = (int) $limit;
        $query = "SELECT * FROM Staff LIMIT $offset,$limit";
        $result_object = $this->db->query($query);
        // Array object to store values of staff
        $Staffs = [];
        while ($row = $result_object->fetch_assoc()) {
            // Create a new Staff object and add it to the Staffs array
            $Staffs[] = new Staff(
                $row['Staff_ID'],
                $row['first_name'],
                $row['middle_name'],
                $row['last_name'],
                $row['role'],
                $row['phone_number'],
                $row['email'],
                $row['password_hash'],
                $row['hire_date']
            );
        }
        return $Staffs;
    }
    // Add new staff
    public function addStaff($firstname, $middlename, $lastname, $role, $phone, $email, $password, $hiredate)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            // Sanitizing all value
            $firstname = $this->db->escape($firstname);
            $middlename = $this->db->escape($middlename);
            $lastname = $this->db->escape($lastname);
            $role = $this->db->escape($role);
            $phone = $this->db->escape($phone);
            $email = $this->db->escape($email);
            $password = $this->db->escape($password);
            $hiredate = $this->db->escape($hiredate);
            // Hashing the password using Bcrypt
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO Staff (first_name, middle_name, last_name, role, phone_number, email, password_hash, hire_date)
                  VALUES
                  ('{$firstname}','{$middlename}','{$lastname}','{$role}','{$phone}','{$email}','{$hashedPassword}','{$hiredate}')";
            // Running query
            $this->db->query($query);
            // commit the transaction
            $this->db->Commit();
            return true;
        } catch (Exception $e) {
            $this->db->RollBack();
            return false;
        }
    }
    // Get staff by id
    public function getStaffId($id)
    {
        $id = (int) $id;
        $query = "SELECT * FROM Staff WHERE Staff_ID = {$id} ";
        $result_object = $this->db->query($query);
        $row = $result_object->fetch_assoc();
        if ($row) {
            return new Staff(
                $row['Staff_ID'],
                $row['first_name'],
                $row['middle_name'],
                $row['last_name'],
                $row['role'],
                $row['phone_number'],
                $row['email'],
                $row['password_hash'],
                $row['hire_date']
            );
        } else return null;
    }
    // Update staff
    public function updateStaff($id, $firstname, $middlename, $lastname, $role, $phone, $email, $password, $hiredate)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            $id = (int) $id;
            // Sanitizing all value
            $firstname = $this->db->escape($firstname);
            $middlename = $this->db->escape($middlename);
            $lastname = $this->db->escape($lastname);
            $role = $this->db->escape($role);
            $phone = $this->db->escape($phone);
            $email = $this->db->escape($email);
            $password = $this->db->escape($password);
            $hiredate = $this->db->escape($hiredate);
            // Hashing the password using Bcrypt
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE Staff
              SET 
              first_name = '{$firstname}',
              middle_name = '{$middlename}',
              last_name = '{$lastname}',
              role = '{$role}',
              phone_number = '{$phone}',
              email = '{$email}',
              password_hash = '{$hashedPassword}',
              hire_date = '{$hiredate}'
              WHERE Staff_ID = '{$id}'
            ";
            // Running query
            $this->db->query($query);
            // commit the transaction
            $this->db->Commit();
            return true;
        } catch (Exception $e) {
            $this->db->RollBack();
            return false;
        }
    }
    // function to delete staff
    public function deleteStaff($id)
    {
        try {
            // Beginnig of transaction 
            $this->db->Transaction();
            $id = (int) $id;
            $query = "DELETE FROM Staff WHERE Staff_ID = {$id}";
            // Running Query
            $this->db->query($query);
            // commit the transaction
            $this->db->Commit();
            return true;
        } catch (Exception $e) {
            $this->db->RollBack();
            return false;
        }
    }
    // function to get staff by id and firstname
    public function getstaffSearch($searchvalue)
    {
        $searchvalue =  $this->db->escape($searchvalue);
        // If search value is id
        if (is_numeric($searchvalue)) {
            $query = "SELECT * FROM Staff WHERE Staff_ID = '$searchvalue' ";
        } else {
            $query = "SELECT * FROM Staff WHERE LOWER(first_name) LIKE LOWER('%$searchvalue%')";
        }
        $result_object = $this->db->query($query);
        // Array object to store values of staff
        $Staffs = [];
        while ($row = $result_object->fetch_assoc()) {
            // Create a new Staff object and add it to the Staffs array
            $Staffs[] = new Staff(
                $row['Staff_ID'],
                $row['first_name'],
                $row['middle_name'],
                $row['last_name'],
                $row['role'],
                $row['phone_number'],
                $row['email'],
                $row['password_hash'],
                $row['hire_date']
            );
        }
        return $Staffs;
    }
    // function to get staff count
    public function getStaffCount(){
        $query = "SELECT COUNT(*) AS Patient_Count FROM Staff";
        $result = $this->db->query($query);
        if ($row = $result->fetch_assoc()) {
            $count = $row['Patient_Count'];
            return $count;
        } else {
            return 0;
        }
    }
}
