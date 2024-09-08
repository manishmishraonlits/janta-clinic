<?php
class BillingService
{
    private $id;
    private $billingId;
    private $serviceId;
    // Constuctor 
    public function __construct($id, $billingId, $serviceId)
    {
        $this->id = $id;
        $this->billingId = $billingId;
        $this->serviceId = $serviceId;
    }
    //  Getter
    public function getBillingServiceId()
    {
        return $this->id;
    }
    public function getBillinId()
    {
        return $this->billingId;
    }
    public function getServiceId()
    {
        return $this->serviceId;
    }
}
