<?php

class logActivity{

    private $conn;
    
    private  $db_table = "log";

    public $ID_log;
    public $action;
    public $data;
    public $ID_admin;

    public function __construct($db)
    {
        $this->conn = $db;
    }

     // GET ALL
     public function getLog()
     {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

     // CREATE
     public function createLog()
     {
        $sqlQuery = "INSERT INTO
                    ". $this->db_table ."
                SET
                    action = :action, 
                    data = :data, 
                    ID_admin = :ID_admin";
    
        $stmt = $this->conn->prepare($sqlQuery);

        $this->action=htmlspecialchars(strip_tags($this->action));
        $this->data=htmlspecialchars(strip_tags($this->data));
        $this->ID_admin=htmlspecialchars(strip_tags($this->ID_admin));
    
        // bind data
        $stmt->bindParam(":action", $this->action);
        $stmt->bindParam(":data", $this->data);
        $stmt->bindParam(":ID_admin", $this->ID_admin);
    
        if($stmt->execute()){
           return true;
        }
        return false;
     }


     //ERROR DI BIND PARAM
     public function limitLog()
     {
        $sqlQuery = "SELECT *
                FROM " . $this->db_table . " 
                WHERE 
                    ID_admin = ? 
                ORDER BY 
                    ID_log DESC 
                limit 10";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->ID_admin);
            
        $stmt->execute();

        return $stmt;
        // $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        // $this->ID_log = $dataRow['ID_log'];
        // $this->action = $dataRow['action'];
        // $this->data = $dataRow['data'];
        // $this->ID_admin = $dataRow['ID_admin'];
     }

}