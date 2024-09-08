<?php
class ServiceManager
{
    private $db;
    // Constructor
    public function __construct($db)
    {
        $this->db = $db;
    }
    // Get ALl services
    public function getServices()
    {
        $query = "SELECT * FROM Services";
        // Running query
        $result_object = $this->db->query($query);
        // Storing in array object
        $Services = [];
        while ($row = $result_object->fetch_assoc()) {
            $Services[] = new Service(
                $row['Service_ID'],
                $row['service_name'],
                $row['detail'],
                $row['charge']
            );
        }
        return $Services;
    }
      // Get ALl services
      public function getServicesPagination($offset,$limit)
      {
         $offset = (int) $offset;
         $limit = (int) $limit; 
          $query = "SELECT * FROM Services LIMIT $offset,$limit";
          // Running query
          $result_object = $this->db->query($query);
          // Storing in array object
          $Services = [];
          while ($row = $result_object->fetch_assoc()) {
              $Services[] = new Service(
                  $row['Service_ID'],
                  $row['service_name'],
                  $row['detail'],
                  $row['charge']
              );
          }
          return $Services;
      }
    // Get service by id
    public function getServiceId($id)
    {
        $id = (int) $id;
        $query = "SELECT * FROM Services WHERE Service_ID = {$id}";
        // Running query
        $row = $this->db->query($query)->fetch_assoc();
        if ($row) {
            return new Service(
                $row['Service_ID'],
                $row['service_name'],
                $row['detail'],
                $row['charge']
            );
        } else return null;
    }
    // Add new service
    public function addService($servicename, $detail, $charge)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            // Sanitizing all value
            $servicename = $this->db->escape($servicename);
            $detail = $this->db->escape($detail);
            $charge = $this->db->escape($charge);
            $query = "INSERT INTO Services (service_name,detail,charge)
                  VALUES
                  ('{$servicename}','{$detail}','{$charge}')";
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
    // Update service
    public function updateService($id, $servicename, $detail, $charge)
    {
        try {
            // Beginning our transaction
            $this->db->Transaction();
            // Sanitizing all value
            $servicename = $this->db->escape($servicename);
            $detail = $this->db->escape($detail);
            $charge = $this->db->escape($charge);
            $id = (int) $this->db->escape($id);
            $query = "UPDATE Services
            SET 
            service_name = '{$servicename}',
            detail = '{$detail}',
            charge = '{$charge}'
            WHERE Service_ID = '{$id}'
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
    // delete service
    public function deleteService($id)
    {
        try {
            // Beginnig of transaction 
            $this->db->Transaction();
            $id = (int) $id;
            $query = "DELETE FROM Services WHERE Service_ID = {$id}";
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
}
