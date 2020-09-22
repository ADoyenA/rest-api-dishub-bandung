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

    $item->judul_dokumentasi = $data->judul_dokumentasi;
    $item->img_cover = $data->img_cover;
    $item->text_dokumentasi = $data->text_dokumentasi;
    $item->waktu_upload = date('Y-m-d');
    $item->ID_admin = $data->ID_admin;
    
    if($item->createDokumentasi()){
        echo 'Berhasil menambahkan data dokumentasi .';
    } else{
        echo 'tidak bisa menambahkan data dokumentasi.';
    }