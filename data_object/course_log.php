<?php
require_once __DIR__."/mysql_conn.php";
class course_log extends mysql_conn
{
    private static $table = 'course_log';
    function __construct() {
        parent::__construct();
    }
    public function insert($student_id, $course_id){
        try{
            $table = $this::$table;
            $student_id = $this::$conn -> quote($student_id);
            $course_id = $this::$conn -> quote($course_id);
            $result = $this::$conn -> exec("INSERT INTO $table (student_id, course_id) VALUES($student_id, $course_id)");
            if ($result == 0){
                return FALSE;
            }elseif ($result == 1) {
                $this::$conn -> commit();
                return TRUE;
            }
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function get_all(){
        try{
            $table = $this::$table;
            $sql = $this::$conn -> prepare("SELECT * FROM $table");
            $sql -> execute();
            $res = $sql -> fetchAll();
            return $res;
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function get_by_student_id($id){
        try{
            $table = $this::$table;
            $data = $this::$conn -> query("SELECT * FROM $table WHERE student_id = '".$id."'");
            return $data -> fetchAll();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function get_by_course_id($id){
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $data = $this::$conn -> query("SELECT * FROM $table WHERE course_id = $id");
            return $data -> fetchAll();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function delete($student_id, $course_id){
        try{
            $table = $this::$table;
            $student_id = $this::$conn -> quote($student_id);
            $course_id = $this::$conn -> quote($course_id);
            $result = $this::$conn -> exec("DELETE FROM $table WHERE student_id = $student_id AND course_id = $course_id");
            if ($result == 0){
                return FALSE;
            }elseif ($result == 1){
                $this::$conn->commit();
                return TRUE;
            }
        }catch (PDOException $e) {
            return $e -> getMessage();
        }
    }
    public function delete_by_course_id($id){
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $result = $this::$conn -> exec("DELETE FROM $table WHERE course_id = $id");
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
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $sql = "UPDATE $table SET score=:score WHERE student_id = $id";
            $sql = $this::$conn -> prepare(sql);
            $result = $sql -> execute(["score" => $update_data]);
        }catch(PDOException $e){
            return $e -> getMessage();
        }
    }
}
?>