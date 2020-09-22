<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/Database.php';
    include_once '../../class/detailAdmin.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new detailAdmin($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->nama = $data->nama;
    $item->email = $data->email;
    $item->alamat = $data->alamat;
    $item->no_hp = $data->no_hp;
    
    if($item->createDetailAdmin()){
        echo 'Berhasil menambahkan data detail admin.';
    } else{
        echo 'tidak bisa menambahkan data detail admin.';
    }