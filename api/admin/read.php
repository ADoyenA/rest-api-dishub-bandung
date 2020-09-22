<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/Database.php';
    include_once '../../class/Admin.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Admin($db);

    $stmt = $items->getAdmin();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $AdminArr = array();
        $AdminArr["body"] = array();
        $AdminArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "ID_admin" => $ID_admin,
                "username" => $username,
                "pwd" => $pwd,
                "ID_detail_admin" => $ID_detail_admin
            );

            array_push($AdminArr["body"], $e);
        }
        echo json_encode($AdminArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>