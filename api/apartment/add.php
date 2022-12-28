<?php
try{
    include __DIR__."/../../data_object/apartment.php";
    $apartment = new apartment();
    $data = json_decode(file_get_contents('php://input'), true);
    $result = $apartment -> insert($data["id"], $data["name"], $data["director"]);
    if ($result){
        http_response_code(200);
        echo json_encode(array("status"=> "success"));
    }else{
        http_response_code(400);
        echo json_encode(array("status"=> "insert failed!"));
    }
}catch(exception $e){
    http_response_code(500);
    echo json_encode(array("status"=> $e->getMessage()));
}
?>