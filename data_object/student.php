<?php
require_once __DIR__."/mysql_conn.php";
require __DIR__."/course_log.php";
class student extends mysql_conn
{
    private static $table = "student";
    function __construct() {
        parent::__construct();
    }
    public function insert($id, $name, $apartment_id){
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $name = $this::$conn -> quote($name);
            $apartment_id = $this::$conn -> quote($apartment_id);
            $result = $this::$conn -> exec("INSERT INTO $table VALUES($id, $name, $apartment_id)");
            if ($result == 0){
                return FALSE;
            }elseif ($result == 1) {
                return TRUE;
            }
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function get_all(){
        try{
            $table = $this::$table;
            return $this::$conn -> query("SELECT * FROM $table") -> fetchAll();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function get_by_id($id){
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $data = $this::$conn -> query("SELECT * FROM $table WHERE id = $id");
            return $data -> fetchAll();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function delete_by_id($id){
        try{
            $table = $this::$table;
            $course_log = new course_log();
            $result = $course_log -> delete_by_student_id($id);
            if (!is_int($result)){
                return $result;
            }
            $id = $this::$conn -> quote($id);
            $sql = $this::$conn -> prepare("DELETE FROM $table WHERE id = $id");
            $result = $sql -> execute();
            if ($result == 0){
                return FALSE;
            }elseif ($result == 1){
                return TRUE;
            }
        }catch (PDOException $e) {
            return $e -> getMessage();
        }
    }
    public function update_by_id($id, $update_data){
        // $update_data = [
        //     "name" => "update_name",
        //     "apartment_id" => "update_apartment_id"
        // ]
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $sql = "UPDATE $table SET name=:name, apartment_id=:apartment_id where id = $id";
            $sql = $this::$conn -> prepare($sql);
            $result = $sql -> execute($update_data);
            return $result;
        }catch(PDOException $e){
            return $e -> getMessage();
        }
    }
}
?>