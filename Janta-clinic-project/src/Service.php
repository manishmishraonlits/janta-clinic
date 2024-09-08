<?php
class Service
{
    private $id;
    private $service_name;
    private $detail;
    private $charge;
    // Constructor
    public function __construct($id, $service, $detail, $charge)
    {
        $this->id = $id;
        $this->service_name = $service;
        $this->detail = $detail;
        $this->charge = $charge;
    }
    // Getter
    public function getServiceId()
    {
        return $this->id;
    }
    public function getServiceName()
    {
        return $this->service_name;
    }
    public function getServiceDetail()
    {
        return $this->detail;
    }
    public function getServiceCharge()
    {
        return $this->charge;
    }
}
