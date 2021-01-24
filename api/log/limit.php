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

//$item->ID_informasi = isset($_GET['ID_informasi']) ? $_GET['ID_informasi'] : die();
$item->ID_admin = isset($_GET['ID_admin']) ? $_GET['ID_admin'] : die();

//$item->begin = $page;

$stmt = $item->limitLog();
$itemCount = $stmt->rowCount();
//echo json_encode($itemCount);

if($itemCount > 0){
    
    $logArr = array();
    $logArr["body"] = array();
    $logArr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "ID_log" => $ID_log,
            "action" => $action,
            "data" => $data,
            "tanggal" => $tanggal,
            "ID_admin" => $ID_admin
        );

        array_push($logArr["body"], $e);
    }
    echo json_encode($logArr);
}

else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}


// if ($item->judul_informasi != null) {
//     // create array
//     $informasi_arr = array(
//         "ID_informasi" =>  $item->ID_informasi,
//         "img" => $item->img,
//         "judul_informasi" => $item->judul_informasi,
//         "kategori" => $item->kategori,
//         "text_informasi" => $item->text_informasi,
//         "waktu_upload" => $item->waktu_upload,
//         "ID_admin" => $item->ID_admin
//     );

//     http_response_code(200);
//     echo json_encode($informasi_arr);
// } else {
//     http_response_code(404);
//     echo json_encode("Informasi not found.");
// }
