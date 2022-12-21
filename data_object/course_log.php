<?php
require_once __DIR__."/mysql_conn.php";
class course_log extends mysql_conn
{
    private static $table = "course_log";
    function __construct() {
        parent::__construct();
    }
    public function insert($studen_id, $course_id){
        try{
            $student_id = $this::$conn -> quote($student_id);
            $course_id = $this::$conn -> quote($course_id);
            $result = $this::$conn -> exec("INSERT INTO $this::$table VALUES($student_id, $course_id)");
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
            return $this::$conn -> query("SELECT * FROM $this::$table") -> fetchAll();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function get_by_student_id($id){
        try{
            $data = $this::$conn -> query("SELECT * FROM $this::$table WHERE student_id = $id");
            return $data -> fetchAll();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function get_by_course_id($id){
        try{
            $id = $this::$conn -> quote($id);
            $data = $this::$conn -> query("SELECT * FROM $this::$table WHERE course_id = $id");
            return $data -> fetchAll();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function delete_by_student_id($id){
        try{
            $id = $this::$conn -> quote($id);
            $result = $this::$conn -> exec("DELETE FROM $this::$table WHERE student_id = $id");
            if ($result == 0){
                return FALSE;
            }elseif ($result == 1){
                $this::$conn->commit();
                return TRUE;
            }
        }catch (PDOException $e) {
            $this::$conn -> rollBack();
            return $e -> getMessage();
        }
    }
    public function delete_by_course_id($id){
        try{
            $id = $this::$conn -> quote($id);
            $result = $this::$conn -> exec("DELETE FROM $this::$table WHERE course_id = $id");
            if ($result == 0){
                return FALSE;
            }elseif ($result == 1){
                $this::$conn->commit();
                return TRUE;
            }
        }catch (PDOException $e) {
            $this::$conn -> rollBack();
            return $e -> getMessage();
        }
    }
    public function score_update_by_student_id($id, $score){
        try{
            $id = $this::$conn -> quote($id);
            $sql = "UPDATE $this::$table SET score=:score WHERE student_id = $id";
            $sql = $this::$conn -> prepare(sql);
            $result = $sql -> execute(["score" => $update_data]);
        }catch(PDOException $e){
            return $e -> getMessage();
        }
    }
}
?>