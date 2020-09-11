<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/Database.php';
    include_once '../../class/Dokumentasi.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Dokumentasi($db);

    $item->ID_dokumentasi = isset($_GET['ID_dokumentasi']) ? $_GET['ID_dokumentasi'] : die();
  
    $item->getSatuDokumentasi();

    if($item->judul_dokumentasi != null){
        // create array
        $dokumentasi_arr = array(
            "ID_dokumentasi" => $ID_dokumentasi,
            "judul_dokumentasi" => $judul_dokumentasi,
            "img_cover" => $img_cover,
            "text_dokumentasi" => $text_dokumentasi,
            "waktu_upload" => $waktu_upload,
            "ID_admin" => $ID_admin
        );
      
        http_response_code(200);
        echo json_encode($dokumentasi_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Dokumentasi not found.");
    }
