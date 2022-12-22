<?php
try{
    include __DIR__."/../../data_object/course_log.php";
    include __DIR__."/../../data_object/course.php";
    $course_log = new course_log();
    $course = new course();
    $student_id = $_GET["student_id"];
    $log_data = $course_log -> get_by_student_id($student_id);
    if ($log_data != []){
        $return_data= [];
        foreach($log_data as $data){
            $course_data = $course -> get_by_id($data["course_id"])[0];
            array_push($return_data, ["id"=>$course_data["id"], "name" => $course_data["name"], "credits" => $course_data["credits"]]);
        }
        http_response_code(200);
        echo json_encode($return_data,JSON_UNESCAPED_UNICODE);
    }else{
        http_response_code(400);
        echo json_encode(array("status"=> "failed"));
    }
}catch(exception $e){
    echo json_encode(array("status"=> $e->getMessage()));
    http_response_code(500);
}

?>