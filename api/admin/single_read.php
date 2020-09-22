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

    $item->ID_admin = isset($_GET['ID_admin']) ? $_GET['ID_admin'] : die();
  
    $item->getSatuAdmin();

    if($item->username != null){
        // create array
        $adminArr = array(
            "ID_admin" =>  $item->ID_admin,
            "username" => $item->username,
            "pwd" => $item->pwd,
            "ID_detail_admin" => $item->ID_detail_admin
        );
      
        http_response_code(200);
        echo json_encode($adminArr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Admin not found.");
    }
