<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/Database.php';
    include_once '../../class/fotoKegiatan.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new fotoKegiatan($db);

    $stmt = $items->getFotoKegiatan();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $fotoKegiatanArr = array();
        $fotoKegiatanArr["body"] = array();
        $fotoKegiatanArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "ID_foto_kegiatan" => $ID_foto_kegiatan,
                "foto" => $foto,
                "ID_dokumentasi" => $ID_dokumentasi,
            );

            array_push($fotoKegiatanArr["body"], $e);
        }
        echo json_encode($fotoKegiatanArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>