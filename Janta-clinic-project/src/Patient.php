<?php
include_once '../src/NameDetail.php';
include_once '../src/address.php';
class Patient extends Name
{
   private $patient_ID;
   private $age;
   private $gender;
   private $weight;
   private $bmi;
   private $bloodGroup;
   private $medicalHistory;
   private $address;
   // constructor
   public function __construct($patient_ID, $firstname, $middlename, $lastname, $age, $gender, $weight, $bmi, $bloodGroup, $medicalHistory, Address $address)
   {
      // Setting values
      $this->patient_ID = $patient_ID;
      $this->firstname = $firstname;
      $this->middlename = $middlename;
      $this->lastname = $lastname;
      $this->age = $age;
      $this->gender = $gender;
      $this->weight = $weight;
      $this->bmi = $bmi;
      $this->bloodGroup = $bloodGroup;
      $this->medicalHistory = $medicalHistory;
      $this->address = $address;
   }
   public function getPatientId()
   {
      return $this->patient_ID;
   }
   public function getPatientAge()
   {
      return $this->age;
   }
   public function getPatientGender()
   {
      return $this->gender;
   }
   public function getPatientWeight()
   {
      return $this->weight;
   }
   public function getPatientBmi()
   {
      return $this->bmi;
   }
   public function getPatientBlood()
   {
      return $this->bloodGroup;
   }
   public function getPatientHistory()
   {
      return $this->medicalHistory;
   }
   public function getAddress()
   {
      return $this->address;
   }
}
