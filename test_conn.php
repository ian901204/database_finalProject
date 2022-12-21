<?php 
try {
    include ("data_object/student.php");
    $student = new student();
    $data = $student -> get_all("S0001");
    var_dump($data);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>