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
    
    $item->ID_detail_admin = $data->ID_detail_admin;
    
    if($item->deleteDetailAdmin()){
        echo json_encode("Behasil menghapus data detail admin");
    } else{
        echo json_encode("Gagal menghapus data detail admin");
    }
?>