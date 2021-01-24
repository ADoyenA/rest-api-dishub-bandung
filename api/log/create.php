<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/Database.php';
    include_once '../../class/logActivity.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new logActivity($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->action = $data->action;
    $item->data = $data->data;
    $item->tanggal = $data->tanggal;
    $item->ID_admin = $data->ID_admin;
    
    if($item->createLog()){
        echo 'Berhasil menambahkan data log aktivitas.';
    } else{
        echo 'tidak bisa menambahkan data log aktivitas.';
    }