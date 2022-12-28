<?php
try{
    include __DIR__."/../../data_object/course.php";
    $course = new course();
    $data = json_decode(file_get_contents('php://input'), true);
    $result = $course -> insert($data["id"], $data["name"], $data["credits"]);
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