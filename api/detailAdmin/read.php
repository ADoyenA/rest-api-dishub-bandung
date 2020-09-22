<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/Database.php';
    include_once '../../class/detailAdmin.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new detailAdmin($db);

    $stmt = $items->getDatailAdmin();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $detailAdminArr = array();
        $detailAdminArr["body"] = array();
        $detailAdminArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "ID_detail_admin" => $ID_detail_admin,
                "nama" => $nama,
                "email" => $email,
                "alamat" => $alamat,
                "no_hp" => $no_hp
            );

            array_push($detailAdminArr["body"], $e);
        }
        echo json_encode($detailAdminArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>