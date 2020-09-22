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

    $item->ID_detail_admin = isset($_GET['ID_detail_admin']) ? $_GET['ID_detail_admin'] : die();
  
    $item->getSatuDetailAdmin();

    if($item->nama != null){
        // create array
        $detailAdminArr = array(
            "ID_detail_admin" =>  $item->ID_detail_admin,
            "nama" => $item->nama,
            "email" => $item->email,
            "alamat" => $item->alamat,
            "no_hp" => $item->no_hp
        );
      
        http_response_code(200);
        echo json_encode($detailAdminArr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("detail admin not found.");
    }
