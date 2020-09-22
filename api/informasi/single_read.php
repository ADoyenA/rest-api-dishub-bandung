<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/Database.php';
    include_once '../../class/Informasi.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Informasi($db);

    $item->ID_informasi = isset($_GET['ID_informasi']) ? $_GET['ID_informasi'] : die();
  
    $item->getSatuInformasi();

    if($item->judul_informasi != null){
        // create array
        $informasi_arr = array(
            "ID_informasi" =>  $item->ID_informasi,
            "img" => $item->img,
            "judul_informasi" => $item->judul_informasi,
            "kategori" => $item->kategori,
            "text_informasi" => $item->text_informasi,
            "waktu_upload" => $item->waktu_upload,
            "ID_admin" => $item->ID_admin
        );
      
        http_response_code(200);
        echo json_encode($informasi_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Informasi not found.");
    }
