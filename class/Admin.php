<?php

class Admin{
    private $conn;
    
    private  $dbTable = "admin";


    public $ID_admin;
    public $username;
    public $pwd;
    public $ID_detail_admin;

    public function __construct($db)
    {
        $this->conn = $db;
    }

     // GET ALL
     public function getAdmin()
     {
        $sqlQuery = "SELECT * FROM ".$this->dbTable."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

     // CREATE
     public function createAdmin()
     {
        $sqlQuery = "INSERT INTO
                    ". $this->dbTable ."
                SET
                    username = :username, 
                    pwd = :pwd, 
                    ID_detail_admin = :ID_detail_admin";
    
        $stmt = $this->conn->prepare($sqlQuery);

        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->pwd=htmlspecialchars(strip_tags(md5($this->pwd)));
        $this->ID_detail_admin=htmlspecialchars(strip_tags($this->ID_detail_admin));
       
        // bind data
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":pwd", $this->pwd);
        $stmt->bindParam(":ID_detail_admin", $this->ID_detail_admin);
    
        if($stmt->execute()){
           return true;
        }
        return false;
     }

     public function getSatuAdmin()
     {
        $sqlQuery = "SELECT
                    ID_admin, 
                    username, 
                    pwd, 
                    ID_detail_admin
                  FROM
                    ". $this->dbTable ."
                WHERE 
                   ID_admin = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->ID_admin);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->username = $dataRow['username'];
        $this->pwd = $dataRow['pwd'];
        $this->ID_detail_admin = $dataRow['ID_detail_admin'];
        $this->ID_admin = $dataRow['ID_admin'];
    }      
    
     // UPDATE
     public function updateAdmin()
     {
        $sqlQuery = "UPDATE
                    ". $this->dbTable ."
                SET
                    username = :username, 
                    pwd = :pwd, 
                    ID_detail_admin = :ID_detail_admin
                WHERE 
                    ID_admin = :ID_admin";
    
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->pwd=htmlspecialchars(strip_tags(md5($this->pwd)));
        $this->ID_detail_admin=htmlspecialchars(strip_tags($this->ID_detail_admin));
        $this->ID_admin=htmlspecialchars(strip_tags($this->ID_admin));
    
        // bind data
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":pwd", $this->pwd);
        $stmt->bindParam(":ID_detail_admin", $this->ID_detail_admin);
        $stmt->bindParam(":ID_admin", $this->ID_admin);
    
        if($stmt->execute()){
           return true;
        }
        return false;
    }

     // DELETE
     function deleteAdmin()
     {
        $sqlQuery = "DELETE FROM " . $this->dbTable. " WHERE ID_admin = ?";
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->ID_admin=htmlspecialchars(strip_tags($this->ID_admin));
    
        $stmt->bindParam(1, $this->ID_admin);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }


    
}