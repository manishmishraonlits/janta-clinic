<?php
class AppointmentManager
{
    private $db;
    // Constructor
    public function __construct($db)
    {
        $this->db = $db;
    }
    // Register Appointment
    public function bookAppointment($status, $doctor, $appointment_date, $reason, $fk)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            $fk = (int) $fk;
            // Sanitizing values
            $status = $this->db->escape($status);
            $doctor = $this->db->escape($doctor);
            $appointment_date = $this->db->escape($appointment_date);
            $reason = $this->db->escape($reason);
            $query = "
         INSERT INTO Appointment(status,doctor,appointment_date,reason,Patient_FK)
         VALUES('$status','$doctor','$appointment_date','$reason',$fk)";
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
    // get all appointment
    public function getAllAppointment()
    {
        $query = "SELECT * FROM Appointment";
        $result_object = $this->db->query($query);
        // Creating array object to store multiple object
        $appointments  = [];
        while ($row = $result_object->fetch_assoc()) {
            $appointments[] = new Appointment(
                $row['Appointment_ID'],
                $row['status'],
                $row['doctor'],
                $row['appointment_date'],
                $row['reason'],
                $row['Patient_FK']
            );
        }
        return $appointments;
    }
    // get all appointment
    public function getAllAppointmentPagination($offset, $limit)
    {
        $offset = (int) $offset;
        $limit = (int) $limit;
        $query = "SELECT * FROM Appointment LIMIT $offset,$limit";
        $result_object = $this->db->query($query);
        // Creating array object to store multiple object
        $appointments  = [];
        while ($row = $result_object->fetch_assoc()) {
            $appointments[] = new Appointment(
                $row['Appointment_ID'],
                $row['status'],
                $row['doctor'],
                $row['appointment_date'],
                $row['reason'],
                $row['Patient_FK']
            );
        }
        return $appointments;
    }
    // get all appointment
    public function getAllAppointmentPaginationToday($offset, $limit)
    {
        $offset = (int) $offset;
        $limit = (int) $limit;
        $query = "SELECT * FROM Appointment WHERE appointment_date = CURDATE()  LIMIT $offset,$limit";
        $result_object = $this->db->query($query);
        // Creating array object to store multiple object
        $appointments  = [];
        while ($row = $result_object->fetch_assoc()) {
            $appointments[] = new Appointment(
                $row['Appointment_ID'],
                $row['status'],
                $row['doctor'],
                $row['appointment_date'],
                $row['reason'],
                $row['Patient_FK']
            );
        }
        return $appointments;
    }
    // get appointment by id
    public function getappointmentId($id)
    {
        $id = (int) $id;
        $query = "SELECT * FROM Appointment WHERE Appointment_ID = {$id}";
        $result_object = $this->db->query($query);
        $row = $result_object->fetch_assoc();
        if ($row) {
            return new Appointment(
                $row['Appointment_ID'],
                $row['status'],
                $row['doctor'],
                $row['appointment_date'],
                $row['reason'],
                $row['Patient_FK']
            );
        } else {
            return null;
        }
    }
    // Update Appointment
    public function updateAppointment($id, $status, $doctor, $appointment_date, $reason)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            $id = (int) $id;
            // Sanitizing values
            $status = $this->db->escape($status);
            $doctor = $this->db->escape($doctor);
            $appointment_date = $this->db->escape($appointment_date);
            $reason = $this->db->escape($reason);
            $query = "
               UPDATE Appointment
               SET
                   status = '{$status}',
                   doctor = '{$doctor}',
                   appointment_date = '{$appointment_date}',
                   reason = '{$reason}'
               WHERE Appointment_ID = {$id}
            ";
            // running query
            $this->db->query($query);
            // commit the transaction
            $this->db->Commit();
            return true;
        } catch (Exception $e) {
            $this->db->RollBack();
            return false;
        }
    }
    // Delete Appointment 
    public function deleteAppointment($id)
    {
        try {
            // Beginnig of transaction 
            $this->db->Transaction();
            $id = (int) $id;
            $query = "DELETE FROM Appointment WHERE Appointment_ID = {$id}";
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
    // Get last 2 Appointment by id
    public function lastTwoAppointment($fk)
    {
        $fk = (int) $fk;
        $query = "
            SELECT * FROM Appointment
            WHERE Patient_FK = {$fk}
            ORDER BY appointment_date DESC
            LIMIT 2
        ";
        $result_object = $this->db->query($query);
        // Creating array object to store multiple object
        $appointments  = [];
        while ($row = $result_object->fetch_assoc()) {
            $appointments[] = new Appointment(
                $row['Appointment_ID'],
                $row['status'],
                $row['doctor'],
                $row['appointment_date'],
                $row['reason'],
                $row['Patient_FK']
            );
        }
        return $appointments;
    }
    // Checking status of Appointment
    public function checkAppointmentStatus($patient_id)
    {
        $patient_id = (int) $patient_id;
        $query = "SELECT * FROM Appointment WHERE Patient_FK = $patient_id";
        $result = $this->db->query($query);
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = new Appointment(
                $row['Appointment_ID'],
                $row['status'],
                $row['doctor'],
                $row['appointment_date'],
                $row['reason'],
                $row['Patient_FK']
            );
        }
        return $appointments;
    }
    // Function to report today appointment taken
    public function appointmentTakenToday()
    {
        $query = "SELECT COUNT(*) AS total_appointments  FROM Appointment WHERE appointment_date = CURDATE() AND status = 'Scheduled'";
        $result = $this->db->query($query);
        if ($result) {
            $total = $result->fetch_assoc();
            return $total['total_appointments'];
        } else {
            return 0;
        }
    }
    // function to get today appointments
    public function appointmentsTakenToday()
    {
        $query = "SELECT * FROM Appointment WHERE appointment_date = CURDATE()";
        $result_object = $this->db->query($query);
        // Creating array object to store multiple object
        $appointments  = [];
        while ($row = $result_object->fetch_assoc()) {
            $appointments[] = new Appointment(
                $row['Appointment_ID'],
                $row['status'],
                $row['doctor'],
                $row['appointment_date'],
                $row['reason'],
                $row['Patient_FK']
            );
        }
        return $appointments;
    }
    // Function future appointment
    public function AppointmentFuture()
    {
        $query = "SELECT COUNT(*) AS total_appointments FROM Appointment WHERE appointment_date > CURRENT_DATE";
        $result = $this->db->query($query);
        if ($row = $result->fetch_assoc()) {
            $count = $row['total_appointments'];
            return $count;
        } else return 0;
    }
    // get all future appointments
    public function AppointmentsFuture()
    {
        $query = "SELECT *  FROM Appointment WHERE appointment_date > CURRENT_DATE";
        $result_object = $this->db->query($query);
        // Creating array object to store multiple object
        $appointments  = [];
        while ($row = $result_object->fetch_assoc()) {
            $appointments[] = new Appointment(
                $row['Appointment_ID'],
                $row['status'],
                $row['doctor'],
                $row['appointment_date'],
                $row['reason'],
                $row['Patient_FK']
            );
        }
        return $appointments;
    }
    // Function to report today appointment completed
    public function appointmentTakenCompleted()
    {
        $query = "SELECT COUNT(*) AS total_appointments FROM Appointment WHERE appointment_date = CURDATE() AND status = 'Completed'";
        $result = $this->db->query($query);
        if ($row = $result->fetch_assoc()) {
            $count = $row['total_appointments'];
            return $count;
        } else return 0;
    }
    // Function to completed appointments
    public function appointmentsTakenCompleted()
    {
        $query = "SELECT * FROM Appointment WHERE appointment_date = CURDATE() AND status = 'Completed'";
        $result_object = $this->db->query($query);
        // Creating array object to store multiple object
        $appointments  = [];
        while ($row = $result_object->fetch_assoc()) {
            $appointments[] = new Appointment(
                $row['Appointment_ID'],
                $row['status'],
                $row['doctor'],
                $row['appointment_date'],
                $row['reason'],
                $row['Patient_FK']
            );
        }
        return $appointments;
    }
    // Function to get total appointment count
    public function getCountAppointment()
    {
        $query = "SELECT COUNT(*) AS Patient_Count FROM Appointment";
        $result = $this->db->query($query);
        if ($row = $result->fetch_assoc()) {
            $count = $row['Patient_Count'];
            return $count;
        } else {
            return 0;
        }
    }
}
