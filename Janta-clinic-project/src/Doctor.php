<?php
include_once '../src/NameDetail.php';
class Doctor extends Name{
    protected $Doctor_ID;
    protected $email;
    protected $qualification;
    protected $yearofExp;
    protected $phoneNo;
    protected $specialization;
    protected $joiningDate;
    // Constructor
    public function __construct($doctor_id,$firstname,$middlename,$lastname,$email,$qualification,$yearofExp,$specialization,$joiningDate,$phoneNo)
    {
         $this->Doctor_ID = $doctor_id;
         $this->firstname = $firstname;
         $this->middlename = $middlename;
         $this->lastname = $lastname;
         $this->qualification = $qualification;
         $this->yearofExp = $yearofExp; 
         $this->phoneNo = $phoneNo;
         $this->specialization = $specialization;
         $this->joiningDate = $joiningDate;
         $this->email = $email;
    }
    public function getIdDoctor(){
        return $this->Doctor_ID;
    }
    public function firstNameDoctor(){
        return $this->firstname;
    }
    public function middleNameDoctor(){
        return $this->middlename;
    }
    public function lastNameDoctor(){
        return $this->lastname;
    }
    public function getQualification(){
        return $this->qualification;
    }
    public function yoeDoctor(){
        return $this->yearofExp;
    }
    public function phoneNoDoctor(){
        return $this->phoneNo;
    }
    public function specialDoctor(){
         return $this->specialization;
    }
    public function joinDateDoctor(){
         return $this->joiningDate;
    }
    public function getDoctorEmail(){
        return $this->email;
    }
}