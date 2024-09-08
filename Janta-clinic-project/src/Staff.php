<?php
include_once '../src/NameDetail.php';
class Staff extends Name{
    private $id;
    private $role;
    private $phoneNo;
    private $email;
    private $password;
    private $hiredate;
    // Constructor
    public function __construct($id,$firstname,$middlename,$lastname,$role,$phone,$email,$password,$hiredate)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->middlename = $middlename;
        $this->lastname = $lastname;
        $this->role = $role;
        $this->phoneNo = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->hiredate = $hiredate;
    }
    // Getters
    public function getStaffId(){
        return $this->id;
    }
    public function getStaffRole(){
        return $this->role;
    }
    public function getStaffPhone(){
        return $this->phoneNo;
    }
    public function getStaffEmail(){
        return $this->email;
    }
    public function getStaffDate(){
        return $this->hiredate;
    }
    public function getStaffPassword(){
        return $this->password;
    }
}