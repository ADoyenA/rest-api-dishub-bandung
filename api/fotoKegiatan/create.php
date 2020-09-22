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

    $item->foto = $data->foto;
    $item->ID_dokumentasi = $data->ID_dokumentasi;
    
    if($item->createFotoKegiatan()){
        echo 'Berhasil menambahkan data foto kegiatan.';
    } else{
        echo 'tidak bisa menambahkan data foto kegiatan.';
    }