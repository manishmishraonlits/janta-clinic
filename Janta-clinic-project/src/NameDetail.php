<?php
class Name
{
  protected $firstname;
  protected $middlename;
  protected $lastname;
  // Constructor
  protected function __construct($first, $middle, $last)
  {
    $this->firstname = $first;
    $this->middlename = $middle;
    $this->lastname = $last;
  }
  public function getFirstName()
  {
    return $this->firstname;
  }
  public function getMiddleName()
  {
    return $this->middlename;
  }
  public function getLastName()
  {
    return $this->lastname;
  }
  public function getFullName()
  {
    return trim("{$this->firstname} {$this->middlename} {$this->lastname}");
  }
}