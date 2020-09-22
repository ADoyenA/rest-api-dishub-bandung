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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->ID_foto_kegiatan = $data->ID_foto_kegiatan;
    
    // IFoto kegiatan values
    $item->foto = $data->foto;
    $item->ID_dokumentasi = $data->ID_dokumentasi;

    if($item->updateFotoKegiatan()){
        echo json_encode("Data foto kegiatan telah dirubah.");
    } else{
        echo json_encode("Data foto kegiatan tidak bisa dirubah");
    }