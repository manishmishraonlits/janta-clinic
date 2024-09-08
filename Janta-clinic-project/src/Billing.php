<?php
class Billing
{
    private $id;
    private $id_appointment;
    private $id_patient;
    private $totalAmount;
    private $billingDate;
    private $paymentStatus;
    // constructor
    public function __construct($id, $fk1, $fk2, $totalAmount, $billingDate, $paymentStatus)
    {
        $this->id = $id;
        $this->id_appointment = $fk1;
        $this->id_patient = $fk2;
        $this->totalAmount = $totalAmount;
        $this->billingDate = $billingDate;
        $this->paymentStatus = $paymentStatus;
    }
    // Getters
    public function getBillingIdClass()
    {
        return $this->id;
    }
    public function getBillingPatientId()
    {
        return $this->id_patient;
    }
    public function getBillingAppointmentId()
    {
        return $this->id_appointment;
    }
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }
    public function getBillingDate()
    {
        return $this->billingDate;
    }
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }
}
