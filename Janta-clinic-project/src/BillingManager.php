<?php
class BillingManager
{
    private $db;
    // Constructor
    public function __construct($db)
    {
        $this->db = $db;
    }
    // get all billing info
    public function getBilling()
    {
        // Query
        $query = "SELECT * FROM Billing";
        // running query
        $result_object = $this->db->query($query);
        // Array of object to store
        $billing = [];
        while ($row = $result_object->fetch_assoc()) {
            $billing[] = new Billing(
                $row['Billing_ID'],
                $row['Appointment_FK'],
                $row['Patient_FK'],
                $row['total_amount'],
                $row['billing_date'],
                $row['payment_status']
            );
        }
        return $billing;
    }
    // get all billing info
    public function getBillingPagination($offset, $limit)
    {
        $offset = (int) $offset;
        $limit = (int) $limit;
        // Query
        $query = "SELECT * FROM Billing LIMIT $offset,$limit";
        // running query
        $result_object = $this->db->query($query);
        // Array of object to store
        $billing = [];
        while ($row = $result_object->fetch_assoc()) {
            $billing[] = new Billing(
                $row['Billing_ID'],
                $row['Appointment_FK'],
                $row['Patient_FK'],
                $row['total_amount'],
                $row['billing_date'],
                $row['payment_status']
            );
        }
        return $billing;
    }
    // Get billing by id
    public function getBillingId($id)
    {
        $id = (int) $id;
        $query = "SELECT * FROM Billing WHERE Billing_ID = {$id}";
        $row = $this->db->query($query)->fetch_assoc();
        if ($row) {
            return new Billing(
                $row['Billing_ID'],
                $row['Appointment_FK'],
                $row['Patient_FK'],
                $row['total_amount'],
                $row['billing_date'],
                $row['payment_status']
            );
        } else {
            return null;
        }
    }
    // Add billing 
    public function addBilling($fk1, $fk2, $totalAmount, $billingDate, $paymentStatus)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            // Sanitizing all value
            $fk1 = $this->db->escape($fk1);
            $fk2 = $this->db->escape($fk2);
            $totalAmount = $this->db->escape($totalAmount);
            $billingDate = $this->db->escape($billingDate);
            $paymentStatus = $this->db->escape($paymentStatus);
            $query = "INSERT INTO Billing (Appointment_FK,Patient_FK,total_amount,billing_date,payment_status)
                  VALUES
                  ('{$fk1}','{$fk2}','{$totalAmount}','{$billingDate}','{$paymentStatus}')";
            // Running query
            $this->db->query($query);
            // Retrieve the last inserted ID
            $lastInsertId = $this->db->getLastInsertId();
            // commit the transaction
            $this->db->Commit();
            return $lastInsertId;
        } catch (Exception $e) {
            $this->db->RollBack();
            error_log("Error in addBilling: " . $e->getMessage());
            return false;
        }
    }
    // Update billing
    public function updateBilling($id, $fk1, $fk2, $totalAmount, $billingDate, $paymentStatus)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            $id = (int) $id;
            // Sanitizing all value
            $fk1 = (int) $this->db->escape($fk1);
            $fk2 = (int) $this->db->escape($fk2);
            $totalAmount = $this->db->escape($totalAmount);
            $billingDate = $this->db->escape($billingDate);
            $paymentStatus = $this->db->escape($paymentStatus);
            $query = "UPDATE Billing
            SET 
            Appointment_FK = {$fk1},
            Patient_FK = {$fk2},
            total_amount = {$totalAmount},
            billing_date = {$billingDate},
            payment_status = '{$paymentStatus}'
            WHERE Billing_ID = {$id}
          ";
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
    // Delete Billing
    public function DeleteBilling($id)
    {
        try {
            // Beginnig of transaction 
            $this->db->Transaction();
            $id = (int) $id;
            // Running query
            $query = "DELETE FROM Billing WHERE Billing_ID = {$id}";
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
    // Function to update payment status using billing id
    public function updatePayementStatus($billingid, $status)
    {
        try {
            // Beginnig of transaction 
            $this->db->Transaction();
            // Santitizing input
            $billingid = (int) $this->db->escape($billingid);
            $status = $this->db->escape($status);
            // Update Query
            $query = "UPDATE Billing SET payment_status = '{$status}' WHERE Billing_ID = {$billingid}";
            // Execute the query
            $this->db->query($query);
            // Commit the transaction
            $this->db->Commit();
            return true;
        } catch (Exception $e) {
            $this->db->RollBack();
            return false;
        }
    }
    // Function to prevent billing of same appointment more than 1
    public function getAppointmentPresent($id)
    {
        $id = (int) $id;
        $query = "SELECT * FROM Billing WHERE Appointment_FK = $id ";
        $result = $this->db->query($query)->fetch_assoc();
        if ($result) return false;
        else return true;
    }
    // Get billing by appointment id
    public function getBiilingByAppointmentId($id)
    {
        $id = (int) $id;
        $query = "SELECT * FROM Billing WHERE Appointment_FK = $id ";
        $row = $this->db->query($query)->fetch_assoc();
        if ($row) {
            return new Billing(
                $row['Billing_ID'],
                $row['Appointment_FK'],
                $row['Patient_FK'],
                $row['total_amount'],
                $row['billing_date'],
                $row['payment_status']
            );
        } else {
            return false;
        }
    }
    // function to get total money collection current date
    public function getMoneyCollectedToday(){
        $query = "SELECT total_amount FROM Billing WHERE billing_date = CURDATE() AND payment_status = 'Paid'";
        $result = $this->db->query($query);
        $totalCollectionToday = 0;
        while($row = $result->fetch_assoc()){
            $totalCollectionToday += $row['total_amount'];
        }
        return $totalCollectionToday;
    }
     // Function to get total money count
     public function GetTotalMoney(){
        $query = "SELECT total_amount FROM Billing";
        $result = $this->db->query($query);
        $totalamount = 0;
        while($row = $result->fetch_assoc()){
            $totalamount += $row['total_amount'];
        }
        return $totalamount;
     }
}
