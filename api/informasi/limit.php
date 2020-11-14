<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../class/Informasi.php';

$database = new Database();
$db = $database->getConnection();

$item = new Informasi($db);

//$item->ID_informasi = isset($_GET['ID_informasi']) ? $_GET['ID_informasi'] : die();
$page = $_GET['page'];
$item->row_per_page = $_GET['row_per_page'];


$item->begin = ($page * $item->row_per_page) - $item->row_per_page;

//$item->begin = $page;

$stmt = $item->limitInformasi();

$itemCount = $stmt->rowCount();

var_dump($stmt);

//echo json_encode($itemCount);

if ($itemCount > 0) {

    $informasiArr = array();
    $informasiArr["body"] = array();
    $informasiArr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $e = array(
            "ID_informasi" => $ID_informasi,
            "img" => $img,
            "judul_informasi" => $judul_informasi,
            "kategori" => $kategori,
            "text_informasi" => $text_informasi,
            "waktu_upload" => $waktu_upload,
            "ID_admin" => $ID_admin
        );

        array_push($informasiArr["body"], $e);
    }
    echo json_encode($informasiArr);
} else {
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
