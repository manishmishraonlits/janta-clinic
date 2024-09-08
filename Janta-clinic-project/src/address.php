<?php
class Address
{
    protected $street;
    protected $city;
    protected $state;
    protected $zipcode;
    // Constructor
    public function __construct($street, $city, $state, $zipcode)
    {
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zipcode = $zipcode;
    }
    public function getStreet()
    {
        return $this->street;
    }
    public function getCity()
    {
        return $this->city;
    }
    public function getState()
    {
        return $this->state;
    }
    public function getZipcode()
    {
        return $this->zipcode;
    }
}
