<?php
class Appointment
{
    protected $id;
    protected $doctor_name;
    protected $appointment_date;
    protected $appointment_status;
    protected $reason;
    protected $fk;
    // Constructor
    public function __construct($id, $status, $doctor, $date, $reason,$fk)
    {
        $this->id = $id;
        $this->appointment_status = $status;
        $this->doctor_name = $doctor;
        $this->appointment_date = $date;
        $this->reason = $reason;
        $this->fk = $fk;
    }
    // Getter
    // Getter for getting id
    public function AppointmentId()
    {
        return $this->id;
    }
    public function getDoctorName()
    {
        return $this->doctor_name;
    }
    public function getAppointmentDate()
    {
        return $this->appointment_date;
    }
    public function getAppointmentStatus()
    {
        return $this->appointment_status;
    }
    public function getReason()
    {
        return $this->reason;
    }
    public function getFK(){
        return $this->fk;
    }
}
