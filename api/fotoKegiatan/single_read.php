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

    $item->ID_foto_kegiatan = isset($_GET['ID_foto_kegiatan']) ? $_GET['ID_foto_kegiatan'] : die();
  
    $item->getSatuFotoKegiatan();

    if($item->foto != null){
        // create array
        $fotoKegiatanArr = array(
            "ID_foto_kegiatan" => $item->ID_foto_kegiatan,
            "foto" => $item->foto,
            "ID_dokumentasi" => $item->ID_dokumentasi,
        );
      
        http_response_code(200);
        echo json_encode($fotoKegiatanArr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("foto kegiatan not found.");
    }
