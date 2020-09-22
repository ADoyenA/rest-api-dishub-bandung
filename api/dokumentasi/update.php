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

    $data = json_decode(file_get_contents("php://input"));

    $item->ID_dokumentasi = $data->ID_dokumentasi;
    
    // Dokumentasi values
    $item->judul_dokumentasi = $data->judul_dokumentasi;
    $item->img_cover = $data->img_cover;
    $item->text_dokumentasi = $data->text_dokumentasi;
    $item->waktu_upload = date('Y-m-d');
    $item->ID_admin = $data->ID_admin;
    var_dump($item->updateDokumentasi());
    
    if($item->updateDokumentasi()){
        echo json_encode("Dokumentasi data telah dirubah.");
    } else{
        echo json_encode("Data dokumentasi tidak bisa dirubah");
    }