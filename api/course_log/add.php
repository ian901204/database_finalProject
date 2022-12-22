<?php
try{
    include __DIR__."/../../data_object/course_log.php";
    $course_log = new course_log();
    $data = json_decode(file_get_contents('php://input'), true);
    if ($course_log -> insert($data["student_id"], $data["course_id"])){
        http_response_code(200);
        echo json_encode(array("status"=> "success"));
    }else{
        http_response_code(400);
        echo json_encode(array("status"=> "failed"));
    }
}catch(exception $e){
    echo json_encode(array("status"=> $e->getMessage()));
    http_response_code(500);
}

?>