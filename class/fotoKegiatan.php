<?php

class fotoKegiatan {
    private $conn;
    
    private  $dbTable = "foto_kegiatan";


    public $ID_foto_kegiatan;
    public $foto;
    public $ID_dokumentasi;
 

    public function __construct($db)
    {
        $this->conn = $db;
    }

     // GET ALL
     public function getFotoKegiatan()
     {
        $sqlQuery = "SELECT * FROM ". $this->dbTable."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

     // CREATE
     public function createFotoKegiatan()
     {
        $sqlQuery = "INSERT INTO
                    ". $this->dbTable ."
                SET
                    ID_foto_kegiatan = :ID_foto_kegiatan, 
                    foto = :foto, 
                    ID_dokumentasi = :ID_dokumentasi";
    
        $stmt = $this->conn->prepare($sqlQuery);

        $this->ID_foto_kegiatan=htmlspecialchars(strip_tags($this->ID_foto_kegiatan));
        $this->foto=htmlspecialchars(strip_tags($this->foto));
        $this->ID_dokumentasi=htmlspecialchars(strip_tags($this->ID_dokumentasi));
    
        // bind data
        $stmt->bindParam(":ID_foto_kegiatan", $this->ID_foto_kegiatan);
        $stmt->bindParam(":foto", $this->foto);
        $stmt->bindParam(":ID_dokumentasi", $this->ID_dokumentasi);
        if($stmt->execute()){
           return true;
        }
        return false;
     }

     public function getByIdDokumentasi()
     {
        $sqlQuery = "SELECT
        ID_foto_kegiatan, 
        foto, 
        ID_dokumentasi
    FROM
        ". $this->dbTable ."
    WHERE 
        ID_dokumentasi = ?";

        $stmt = $this->conn->prepare($sqlQuery);

        // $this->begin = htmlspecialchars(strip_tags($this->begin));
        // $this->row_per_page = htmlspecialchars(strip_tags($this->row_per_page));
        $satu = "1";
        $dua = "5";
        //$stmt->bindParam(1, $this->orderBy, PDO::PARAM_STR, 10);
        $stmt->bindParam(1, $this->ID_dokumentasi, PDO::PARAM_INT);

        // $stmt->execute();
        $stmt->execute();
        return $stmt;
     }

     public function getSatuFotoKegiatan()
     {
        $sqlQuery = "SELECT
                    ID_foto_kegiatan, 
                    foto, 
                    ID_dokumentasi
                  FROM
                    ". $this->dbTable ."
                WHERE 
                ID_foto_kegiatan = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->ID_foto_kegiatan);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->ID_foto_kegiatan = $dataRow['ID_foto_kegiatan'];
        $this->foto = $dataRow['foto'];
        $this->ID_dokumentasi = $dataRow['ID_dokumentasi'];
    }      
    
     // UPDATE
     public function updateFotoKegiatan()
     {
        $sqlQuery = "UPDATE
                    ". $this->dbTable ."
              SET
              ID_foto_kegiatan = :ID_foto_kegiatan, 
              foto = :foto, 
              ID_dokumentasi = :ID_dokumentasi";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->ID_foto_kegiatan=htmlspecialchars(strip_tags($this->ID_foto_kegiatan));
        $this->foto=htmlspecialchars(strip_tags($this->foto));
        $this->ID_dokumentasi=htmlspecialchars(strip_tags($this->ID_dokumentasi));

        // bind data
        $stmt->bindParam(":ID_foto_kegiatan", $this->ID_foto_kegiatan);
        $stmt->bindParam(":foto", $this->foto);
        $stmt->bindParam(":ID_dokumentasi", $this->ID_dokumentasi);
        
        if($stmt->execute()){
           return true;
        }
        return false;
    }

     // DELETE
     function deleteFotoKegiatan()
     {
        $sqlQuery = "DELETE FROM " . $this->dbTable. " WHERE ID_foto_kegiatan = ?";
        $stmt = $this->conn->prepare($sqlQuery);
    
        $this->ID_foto_kegiatan=htmlspecialchars(strip_tags($this->ID_foto_kegiatan));
    
        $stmt->bindParam(1, $this->ID_foto_kegiatan);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }


}
