<?php

class Dokumentasi{

    private $conn;
    
    private  $dbTable = "dokumentasi";
    private  $ddTableFoto = "dokumentasi";


    public $ID_dokumentasi;
    public $img_cover;
    public $judul_dokumentasi;
    public $waktu_upload;
    public $text_dokumentasi;
    public $foto_kegiatan;
    public $ID_admin;
    public $ID_foto_kegiatan;

    public function __construct($db)
    {
        $this->conn = $db;
    }

     // GET ALL
     public function getDokumentasi()
     {
        $sqlQuery = "SELECT d.ID_dokumentasi as dok_id, d.judul_dokumentasi, d.img_cover, d.text_dokumentasi, d.waktu_upload, foto-kegiatan.foto_kegiatan, foto-kegiatan.ID_foto_kegiatan as id_fokeg, d.ID_admin FROM " . $this->dbTable . " AS d
        LEFT JOIN foto-kegiatan ON foto-kegiatan.ID = d.dok_id";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

     // CREATE
     public function createDokumentasi()
     {
        $sqlQuery = "INSERT INTO
                    ". $this->dbTable ."
                SET
                    judul_dokumentasi = :judul_dokumentasi, 
                    img_cover = :img_cover, 
                    text_dokumentasi = :text_dokumentasi, 
                    waktu_upload = :waktu_upload, 
                    ID_admin = :ID_admin";
    
        $stmt = $this->conn->prepare($sqlQuery);

        $this->img_cover=htmlspecialchars(strip_tags($this->img_cover));
        $this->judul_dokumentasi=htmlspecialchars(strip_tags($this->judul_dokumentasi));
        $this->waktu_upload=htmlspecialchars(strip_tags($this->waktu_upload));
        $this->text_dokumentasi=htmlspecialchars(strip_tags($this->text_dokumentasi));
        $this->ID_admin=htmlspecialchars(strip_tags($this->ID_admin));
    
        // bind data
        $stmt->bindParam(":img_cover", $this->img_cover);
        $stmt->bindParam(":judul_dokumentasi", $this->judul_dokumentasi);
        $stmt->bindParam(":waktu_upload", $this->waktu_upload);
        $stmt->bindParam(":text_dokumentasi", $this->text_dokumentasi);
        $stmt->bindParam(":ID_admin", $this->ID_admin);
    
        if($stmt->execute()){
           return true;
        }
        return false;
     }

     public function getSatuDokumentasi()
     {
        $sqlQuery = "SELECT
                    ID_dokumentasi, 
                    judul_dokumentasi, 
                    img_cover, 
                    text_dokumentasi, 
                    waktu_upload, 
                    ID_admin
                  FROM
                    ". $this->dbTable ."
                WHERE 
                   ID_dokumentasi = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->ID_dokumentasi);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->judul_dokumentasi = $dataRow['judul_dokumentasi'];
        $this->img_cover = $dataRow['img_cover'];
        $this->text_dokumentasi = $dataRow['text_dokumentasi'];
        $this->waktu_upload = $dataRow['waktu_upload'];
        $this->ID_admin = $dataRow['ID_admin'];
    }      
    
     // UPDATE
     public function updateDokumentasi()
     {
        $sqlQuery = "UPDATE
                    ". $this->dbTable ."
                SET
                judul_dokumentasi = :judul_dokumentasi, 
                img_cover = :img_cover, 
                text_dokumentasi = :text_dokumentasi, 
                waktu_upload = :waktu_upload, 
                ID_admin = :ID_admin
                WHERE 
                    ID_dokumentasi = :ID_dokumentasi";
    
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->judul_dokumentasi=htmlspecialchars(strip_tags($this->judul_dokumentasi));
        $this->img_cover=htmlspecialchars(strip_tags($this->img_cover));
        $this->text_dokumentasi=htmlspecialchars(strip_tags($this->text_dokumentasi));
        $this->waktu_upload=htmlspecialchars(strip_tags($this->waktu_upload));
        $this->ID_admin=htmlspecialchars(strip_tags($this->ID_admin));
        $this->ID_dokumentasi=htmlspecialchars(strip_tags($this->ID_dokumentasi));
    
        // bind data
        $stmt->bindParam(":judul_dokumentasi", $this->judul_dokumentasi);
        $stmt->bindParam(":img_cover", $this->img_cover);
        $stmt->bindParam(":text_dokumentasi", $this->text_dokumentasi);
        $stmt->bindParam(":waktu_upload", $this->waktu_upload);
        $stmt->bindParam(":ID_admin", $this->ID_admin);
        $stmt->bindParam(":ID_dokumentasi", $this->ID_dokumentasi);
    
        if($stmt->execute()){
           return true;
        }
        return false;
    }

     // DELETE
     function deleteDokumentasi()
     {
        $sqlQuery = "DELETE FROM " . $this->dbTable. " WHERE ID_dokumentasi = ?";
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->ID_dokumentasi=htmlspecialchars(strip_tags($this->ID_dokumentasi));
    
        $stmt->bindParam(1, $this->ID_dokumentasi);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }


}