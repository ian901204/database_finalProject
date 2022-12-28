<?php
try{
    include __DIR__."/../../data_object/student.php";
    $student = new student();
    $data = json_decode(file_get_contents('php://input'), true);
    $result = $student -> insert($data["id"], $data["name"], $data["apartment_id"]);
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