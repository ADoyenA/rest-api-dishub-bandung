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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->ID_informasi = $data->ID_informasi;
    
    // Informasi values
    $item->img = $data->img;
    $item->judul_informasi = $data->judul_informasi;
    $item->kategori = $data->kategori;
    $item->text_informasi = $data->text_informasi;
    $item->ID_admin = $data->ID_admin;
    
    if($item->updateInformasi()){
        echo json_encode("informasi data telah dirubah.");
    } else{
        echo json_encode("Data informasi tidak bisa dirubah");
    }