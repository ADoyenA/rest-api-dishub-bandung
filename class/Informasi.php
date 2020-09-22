<?php

class Informasi{

    private $conn;
    
    private  $db_table = "informasi";

    public $ID_informasi;
    public $img;
    public $judul_informasi;
    public $kategori;
    public $text_informasi;
    public $waktu_upload;
    public $ID_admin;

    public function __construct($db)
    {
        $this->conn = $db;
    }

     // GET ALL
     public function getInformasi()
     {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

     // CREATE
     public function createInformasi()
     {
        $sqlQuery = "INSERT INTO
                    ". $this->db_table ."
                SET
                    img = :img, 
                    judul_informasi = :judul_informasi, 
                    kategori = :kategori, 
                    text_informasi = :text_informasi, 
                    waktu_upload = :waktu_upload, 
                    ID_admin = :ID_admin";
    
        $stmt = $this->conn->prepare($sqlQuery);

        $this->img=htmlspecialchars(strip_tags($this->img));
        $this->judul_informasi=htmlspecialchars(strip_tags($this->judul_informasi));
        $this->kategori=htmlspecialchars(strip_tags($this->kategori));
        $this->text_informasi=htmlspecialchars(strip_tags($this->text_informasi));
        $this->waktu_upload=htmlspecialchars(strip_tags($this->waktu_upload));
        $this->ID_admin=htmlspecialchars(strip_tags($this->ID_admin));
    
        // bind data
        $stmt->bindParam(":img", $this->img);
        $stmt->bindParam(":judul_informasi", $this->judul_informasi);
        $stmt->bindParam(":kategori", $this->kategori);
        $stmt->bindParam(":text_informasi", $this->text_informasi);
        $stmt->bindParam(":waktu_upload", $this->waktu_upload);
        $stmt->bindParam(":ID_admin", $this->ID_admin);
    
        if($stmt->execute()){
           return true;
        }
        return false;
     }

     public function getSatuInformasi()
     {
        $sqlQuery = "SELECT
                    ID_informasi, 
                    img, 
                    judul_informasi, 
                    kategori, 
                    text_informasi,
                    waktu_upload,  
                    ID_admin
                  FROM
                    ". $this->db_table ."
                WHERE 
                   ID_informasi = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->ID_informasi);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->img = $dataRow['img'];
        $this->judul_informasi = $dataRow['judul_informasi'];
        $this->kategori = $dataRow['kategori'];
        $this->text_informasi = $dataRow['text_informasi'];
        $this->waktu_upload = $dataRow['waktu_upload'];
        $this->ID_admin = $dataRow['ID_admin'];
    }      
    
     // UPDATE
     public function updateInformasi()
     {
        $sqlQuery = "UPDATE
                    ". $this->db_table ."
                SET
                    img = :img, 
                    judul_informasi = :judul_informasi, 
                    kategori = :kategori, 
                    text_informasi = :text_informasi,
                    waktu_upload = :waktu_upload, 
                    ID_admin = :ID_admin
                WHERE 
                    ID_informasi = :ID_informasi";
    
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->img=htmlspecialchars(strip_tags($this->img));
        $this->judul_informasi=htmlspecialchars(strip_tags($this->judul_informasi));
        $this->kategori=htmlspecialchars(strip_tags($this->kategori));
        $this->text_informasi=htmlspecialchars(strip_tags($this->text_informasi));
        $this->waktu_upload=htmlspecialchars(strip_tags($this->waktu_upload));
        $this->ID_admin=htmlspecialchars(strip_tags($this->ID_admin));
        $this->ID_informasi=htmlspecialchars(strip_tags($this->ID_informasi));
    
        // bind data
        $stmt->bindParam(":img", $this->img);
        $stmt->bindParam(":judul_informasi", $this->judul_informasi);
        $stmt->bindParam(":kategori", $this->kategori);
        $stmt->bindParam(":text_informasi", $this->text_informasi);
        $stmt->bindParam(":waktu_upload", $this->waktu_upload);
        $stmt->bindParam(":ID_admin", $this->ID_admin);
        $stmt->bindParam(":ID_informasi", $this->ID_informasi);
    
        if($stmt->execute()){
           return true;
        }
        return false;
    }

     // DELETE
     function deleteInformasi()
     {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE ID_informasi = ?";
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->ID_informasi=htmlspecialchars(strip_tags($this->ID_informasi));
    
        $stmt->bindParam(1, $this->ID_informasi);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }


}