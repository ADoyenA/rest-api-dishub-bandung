<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/Database.php';
    include_once '../../class/Dokumentasi.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Dokumentasi($db);

    $stmt = $items->getDokumentasi();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $DokumentasiArr = array();
        $DokumentasiArr["body"] = array();
        $DokumentasiArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if ($row['id_fokeg'] != null) {
                $fotoKegiatanArr = array(
                    "id" => $row['id_fokeg'],
                    "foto_kegiatan" => $row['foto_kegiatan'],
                    "ID_dokumentasi" => $row['ID_dokumentasi']
                );
            } else {
                $fotoKegiatanArr = null;
            }
            $e = array(
                "ID_dokumentasi" => $ID_dokumentasi,
                "judul_dokumentasi" => $judul_dokumentasi,
                "img_cover" => $img_cover,
                "text_dokumentasi" => $text_dokumentasi,
                "waktu_upload" => $waktu_upload,
                "ID_admin" => $ID_admin
            );

            array_push($DokumentasiArr["body"], $e);
        }
        echo json_encode($DokumentasiArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>