<?php
try{
    include __DIR__."/../../data_object/course.php";
    $course = new course();
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data["id"];
    $result = $course -> delete_by_id($id);
    if (!is_bool($result)){
        http_response_code(400);
        echo json_encode(array("status"=> $result));
        die();
    }
    if ($result){
        http_response_code(200);
        echo json_encode(array("status"=> "success"));
    }else{
        http_response_code(400);
        echo json_encode(array("status"=> "delete failed!"));
    }
}catch(exception $e){
    http_response_code(500);
    echo json_encode(array("status"=> $e->getMessage()));
}
?>