<?php
require_once __DIR__."/mysql_conn.php";
class course extends mysql_conn
{
    private static $table = "course";
    function __construct() {
        parent::__construct();
    }
    public function insert($id, $name, $credits){
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $name = $this::$conn -> quote($name);
            $credits = $this::$conn -> quote($credits);
            $result = $this::$conn -> exec("INSERT INTO $table VALUES($id, $name, $credits)");
            if ($result == 0){
                return FALSE;
            }elseif ($result == 1) {
                return TRUE;
            }
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function get_unselect($selected_course){
        // $selected_course = [[0] => "course_id" .....];
        try{
            $table = $this::$table;
            $in_array = implode("', '", $selected_course);
            $sql = $this::$conn -> prepare("SELECT * FROM $table WHERE id not in ('$in_array')");
            $sql -> execute();
            return $sql -> fetchAll();
        }catch(PDOException $e){
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
            $sql = $this::$conn -> prepare("SELECT * FROM $table WHERE id = $id");
            $sql -> execute();
            return $sql -> fetchAll();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function delete_by_id($id){
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $result = $this::$conn -> exec("DELETE FROM $table WHERE id = $id");
            if ($result == 0){
                return FALSE;
            }elseif ($result == 1){
                return TRUE;
            }
        }catch (PDOException $e) {
            $this::$conn -> rollBack();
            return $e -> getMessage();
        }
    }
    public function update_by_id($id, $update_data){
        // $update_data = [
        //     "name" => "updata data of name",
        //     "credits" => "update data of credits"
        // ]
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $sql = "UPDATE $table SET name=:name, credits=:credits WHERE id = $id";
            $sql = $this::$conn -> prepare($sql);
            $result = $sql -> execute($update_data);
            return $result;
        }catch(PDOException $e){
            return $e -> getMessage();
        }
    }
}
?>