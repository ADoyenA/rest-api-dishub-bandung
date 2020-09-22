<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/Database.php';
    include_once '../../class/Dokumentasi.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Dokumentasi($db);

    $item->ID_dokumentasi = isset($_GET['ID_dokumentasi']) ? $_GET['ID_dokumentasi'] : die();
  
    $item->getSatuDokumentasi();

    if($item->judul_dokumentasi != null){
        // create array
        $dokumentasiArr = array(
            "ID_dokumentasi" => $item->ID_dokumentasi,
            "judul_dokumentasi" => $item->judul_dokumentasi,
            "img_cover" => $item->img_cover,
            "text_dokumentasi" => $item->text_dokumentasi,
            "waktu_upload" => $item->waktu_upload,
            "ID_admin" => $item->ID_admin
        );

        http_response_code(200);
        echo json_encode($dokumentasiArr);
    }
    else{
        http_response_code(404);
        echo json_encode("Dokumentasi not found.");
    }



    // header("Access-Control-Allow-Origin: *");
    // header("Content-Type: application/json; charset=UTF-8");
    // header("Access-Control-Allow-Methods: POST");
    // header("Access-Control-Max-Age: 3600");
    // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // include_once '../../config/Database.php';
    // include_once '../../class/Dokumentasi.php';
    // include_once '../../class/fotoKegiatan.php';

    // $database = new Database();
    // $db = $database->getConnection();

    // $item = new Dokumentasi($db);
    // $items2 = new fotoKegiatan($db);

    // $item->ID_dokumentasi = isset($_GET['ID_dokumentasi']) ? $_GET['ID_dokumentasi'] : die();
  
    // $item->getSatuDokumentasi();

    // $dokumentasiArr = array();

    // if($item->judul_dokumentasi != null){
    //     // create array
    //     $dokumentasiArr['dokumentasi'][$item->ID_dokumentasi] = array(
    //         "ID_dokumentasi" => $item->ID_dokumentasi,
    //         "judul_dokumentasi" => $item->judul_dokumentasi,
    //         "img_cover" => $item->img_cover,
    //         "text_dokumentasi" => $item->text_dokumentasi,
    //         "waktu_upload" => $item->waktu_upload,
    //         "ID_admin" => $item->ID_admin
    //     );

        
    //     $stmt2 = $items2->getFotoKegiatan($item->ID_dokumentasi);
    //     while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    //         $dokumentasiArr['dokumentasi'][$item->ID_dokumentasi]['foto_kegiatan'][] = $row2;
    //     }     
        
    //     http_response_code(200);
    //     $dokumentasiArr["dokumentasi"] = array_values($dokumentasiArr["dokumentasi"]);

    //     echo json_encode($dokumentasiArr);
    // }
      
    // else{
    //     http_response_code(404);
    //     echo json_encode("Dokumentasi not found.");
    // }
