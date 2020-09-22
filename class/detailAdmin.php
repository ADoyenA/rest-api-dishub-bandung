<?php

class detailAdmin{
    private $conn;
    
    private  $dbTable = "detail_admin";


    public $ID_detail_admin;
    public $nama;
    public $email;
    public $alamat;
    public $no_hp;

    public function __construct($db)
    {
        $this->conn = $db;
    }

     // GET ALL
     public function getDatailAdmin()
     {
        $sqlQuery = "SELECT * FROM ". $this->dbTable."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

     // CREATE
     public function createDetailAdmin()
     {
        $sqlQuery = "INSERT INTO
                    ". $this->dbTable ."
                SET
                    nama = :nama,
                    email = :email, 
                    alamat = :alamat,
                    no_hp = :no_hp";
    
        $stmt = $this->conn->prepare($sqlQuery);

        $this->nama=htmlspecialchars(strip_tags($this->nama));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->alamat=htmlspecialchars(strip_tags($this->alamat));
        $this->no_hp=htmlspecialchars(strip_tags($this->no_hp));
    
        // bind data
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":no_hp", $this->no_hp);

        if($stmt->execute()){
           return true;
        }
        return false;
     }

     public function getSatuDetailAdmin()
     {
        $sqlQuery = "SELECT
                    ID_detail_admin, 
                    nama, 
                    email, 
                    alamat,
                    no_hp
                  FROM
                    ". $this->dbTable ."
                WHERE 
                ID_detail_admin = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->ID_detail_admin);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->ID_detail_admin = $dataRow['ID_detail_admin'];
        $this->nama = $dataRow['nama'];
        $this->email = $dataRow['email'];
        $this->alamat = $dataRow['alamat'];
        $this->no_hp = $dataRow['no_hp'];
    }      
    
     // UPDATE
     public function updateDetailAdmin()
     {
        $sqlQuery = "UPDATE
                    ". $this->dbTable ."
              SET
              nama = :nama, 
              email = :email, 
              alamat = :alamat,
              no_hp = :no_hp
              WHERE 
                    ID_detail_admin = :ID_detail_admin";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->ID_detail_admin=htmlspecialchars(strip_tags($this->ID_detail_admin));
        $this->nama=htmlspecialchars(strip_tags($this->nama));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->alamat=htmlspecialchars(strip_tags($this->alamat));
        $this->no_hp=htmlspecialchars(strip_tags($this->no_hp));

        // bind data
        $stmt->bindParam(":ID_detail_admin", $this->ID_detail_admin);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":no_hp", $this->no_hp);
        
        if($stmt->execute()){
           return true;
        }
        return false;
    }

     // DELETE
     function deleteDetailAdmin()
     {
        $sqlQuery = "DELETE FROM " . $this->dbTable. " WHERE ID_detail_admin = ?";
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->ID_detail_admin=htmlspecialchars(strip_tags($this->ID_detail_admin));
    
        $stmt->bindParam(1, $this->ID_detail_admin);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    
}