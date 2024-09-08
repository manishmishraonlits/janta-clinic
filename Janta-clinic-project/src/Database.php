<?php
// class for Database connectivity
class Database
{
    // Variable for connection name
    private $conn;
    // Constructor for setting up connection
    public function __construct()
    {
        // Setting connection
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // Connection Failed
        if ($this->conn->connect_error) {
            die("Connection failed" . $this->conn->error);
        } else {
        }
    }
    // Running query
    public function query($sql)
    {
        $mysqliResult_object = $this->conn->query($sql);
        if ($mysqliResult_object === false) {
            die("Query Failed: " . $this->conn->error);
        }
        return $mysqliResult_object;
    }
    // Avodining Sql injection
    public function escape($value)
    {
        return $this->conn->real_escape_string($value);
    }
    // mysqli build in property to get last id of runned query which have AUTO_INCREMENT as contraint
    public function getLastInsertId()
    {
        return $this->conn->insert_id;
    }
    // Method for begin transaction
    public function Transaction(){
        return $this->conn->begin_transaction();
    }
    // Method for commit transaction
    public function Commit(){
        return $this->conn->commit();
    }
    // ROLL BACK CHANGES if something goes wrong
    public function RollBack(){
        return $this->conn->rollback();
    }
    // closing connection
    public function close()
    {
        $this->conn->close();
    }
}
