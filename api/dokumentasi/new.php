<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/Database.php';
    include_once '../../class/Dokumentasi.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Dokumentasi($db);

    $stmt = $items->getNewDokumentasi();
    $itemCount = $stmt->rowCount();
    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $dokumentasiArr = array();
        $dokumentasiArr["body"] = array();
        $dokumentasiArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "ID_dokumentasi" => $ID_dokumentasi,
                "judul_dokumentasi" => $judul_dokumentasi,
                "img_cover" => $img_cover,
                "text_dokumentasi" => $text_dokumentasi,
                "waktu_upload" => $waktu_upload,
                "ID_admin" => $ID_admin
            );

            array_push($dokumentasiArr["body"], $e);
        }
        echo json_encode($dokumentasiArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>