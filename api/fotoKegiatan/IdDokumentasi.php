<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/Database.php';
    include_once '../../class/fotoKegiatan.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new fotoKegiatan($db);

    $item->ID_dokumentasi = $_GET['ID_dokumentasi'];
  
    $stmt = $item->getByIdDokumentasi();

    $itemCount = $stmt->rowCount();


    if ($itemCount > 0) {

        $fotoKegiatanArr = array();
        $fotoKegiatanArr["body"] = array();
        $fotoKegiatanArr["itemCount"] = $itemCount;
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $e = array(
                "ID_foto_kegiatan" => $ID_foto_kegiatan,
                "foto" => $foto,
                "ID_dokumentasi" => $ID_dokumentasi
            );
    
            array_push($fotoKegiatanArr["body"], $e);
        }
        echo json_encode($fotoKegiatanArr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }