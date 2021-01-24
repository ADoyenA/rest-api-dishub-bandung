<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/Database.php';
    include_once '../../class/Informasi.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Informasi($db);

    $stmt = $items->getNewInformasi();
    $itemCount = $stmt->rowCount();
    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $informasiArr = array();
        $informasiArr["body"] = array();
        $informasiArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "ID_informasi" => $ID_informasi,
                "img" => $img,
                "judul_informasi" => $judul_informasi,
                "kategori" => $kategori,
                "text_informasi" => $text_informasi,
                "waktu_upload" => $waktu_upload,
                "ID_admin" => $ID_admin
            );

            array_push($informasiArr["body"], $e);
        }
        echo json_encode($informasiArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>