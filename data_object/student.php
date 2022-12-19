<?php
include "mysql_conn.php";
class student extends mysql_conn
{
    function __construct() {
        parent::__construct();
    }
    public function insert($id, $name, $major_id){
        try{
            $id = $this::$conn -> quote($id);
            $name = $this::$conn -> quote($name);
            $major_id = $this::$conn -> quote($major_id);
            $result = $this::$conn -> exec("insert into student VALUES($id, $name, $major_id)");
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
            return $this::$conn -> prepare("SELECT * FROM student") -> execute();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function get_by_id($column, $formula, $condition){
        try{
            $condition = $this::$conn -> quote($condition);
            $data = $this::$conn -> query("SELECT * FROM student WHERE $column $formula $condition");
            return $data -> fetchAll();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function delete_by_id($id){
        try{
            $id = $this::$conn -> quote($id);
            $result = $this::$conn -> exec("delete from student where id = $id");
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
    public function update_by_id($id, $update_data){
        // $update_data = [
        //     "name" => "update_name",
        //     "major_id" => "update_major_id"
        // ]
        try{
            $id = $this::$conn -> quote($id);
            $sql = "UPDATE student SET name=:name, major_id=:major_id where id = $id";
            $sql = $this::$conn -> prepare(sql);
            $result = $sql -> execute($update_data);
        }catch(PDOException $e){
            return $e -> getMessage();
        }
    }
    public function sqlQuery($sql){
        $sql = $this::$conn -> prepare($sql);
        return $sql -> execute();
    }
}
?>