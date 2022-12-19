<?php 
try {
    include ("data_object/student.php");
    $student = new student();
    $data = $student -> get_all();
    print_r($data);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>