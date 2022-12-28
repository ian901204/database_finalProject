<?php 
try {
    include ("data_object/student.php");
    $student = new student();
    for ($i = 1;$i<=50;$i++){
        $data = $student -> insert("S00".(($i < 10)?"0".$i:$i), "test", "");
    }
    var_dump($data);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>