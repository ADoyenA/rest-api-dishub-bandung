<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/Database.php';
    include_once '../../class/Admin.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Admin($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->ID_admin = $data->ID_admin;
    
    // Informasi values
    $item->username = $data->username;
    $item->pwd = $data->pwd;
    $item->ID_detail_admin = $data->ID_detail_admin;


    if($item->updateAdmin()){
        echo json_encode("Data admin telah dirubah.");
    } else{
        echo json_encode("Data admin tidak bisa dirubah");
    }