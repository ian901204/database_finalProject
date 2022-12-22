<?php
require_once __DIR__."/mysql_conn.php";
class student extends mysql_conn
{
    private static $table = "student";
    function __construct() {
        parent::__construct();
    }
    public function insert($id, $name, $major_id){
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $name = $this::$conn -> quote($name);
            $major_id = $this::$conn -> quote($major_id);
            $result = $this::$conn -> exec("INSERT INTO $table VALUES($id, $name, $major_id)");
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
            $id = $this::$conn -> quote($id);
            $result = $this::$conn -> exec("DELETE FROM $table WHERE id = $id");
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
            $sql = "UPDATE $table SET name=:name, major_id=:major_id where id = $id";
            $sql = $this::$conn -> prepare(sql);
            $result = $sql -> execute($update_data);
        }catch(PDOException $e){
            return $e -> getMessage();
        }
    }
}
?>