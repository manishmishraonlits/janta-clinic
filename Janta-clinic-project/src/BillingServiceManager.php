<?php
class BillingServiceManager
{
    private $db;
    // Constructor
    public function __construct($db)
    {
        $this->db = $db;
    }
    // Linking each service to same billing id in billingservice
    public function addBillingService($billingId, $serviceId)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            $billingId = (int) $billingId;
            $serviceId = (int) $serviceId;
            $query = "INSERT INTO Billing_Service (Billing_id,Service_id)
                    VALUES
                   ('$billingId','$serviceId')";
            // Running query
            $this->db->query($query);
            // commit the transaction
            $this->db->Commit();
            return true;
        } catch (Exception $e) {
            $this->db->RollBack();
        }
    }
    // Get all serivce with billing id
    public function getServicesBilling($id)
    {
        $id = (int) $id;
        $query = "SELECT Service_id FROM Billing_Service WHERE Billing_id = {$id}";
        // Running query
        $result = $this->db->query($query);
        // Array to store indexes
        $services = [];
        while ($row = $result->fetch_assoc()) {
            $services[] = $row['Service_id'];
        }
        return $services;
    }
    // Delete all billingservice id refer to particular billing id
    public function deleteBillingServices($id)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            $id = (int) $id;
            $query = "DELETE FROM Billing_Service WHERE Billing_id = {$id}";
            // Running query
            $this->db->query($query);
            // commit the transaction
            $this->db->Commit();
            return true;
        } catch (Exception $e) {
            $this->db->RollBack();
        }
    }
}
