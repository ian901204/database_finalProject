<?php
try{
    include __DIR__."/../../data_object/student.php";
    $student = new student();
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data["id"];
    unset($data["id"]);
    if ($student -> update_by_id($id, $data)){
        http_response_code(200);
        echo json_encode(array("status"=> "success"));
    }else{
        http_response_code(400);
        echo json_encode(array("status"=> "update failed!"));
    }
}catch(exception $e){
    http_response_code(500);
    echo json_encode(array("status"=> $e->getMessage()));
}
?>