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
            $id = $this::$conn -> quote($id);
            $name = $this::$conn -> quote($name);
            $credits = $this::$conn -> quote($credits);
            $result = $this::$conn -> exec("INSERT INTO $this::$table VALUES($id, $name, $credits)");
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
    public function get_by_id($id){
        try{
            $id = $this::$conn -> quote($id);
            $data = $this::$conn -> query("SELECT * FROM $this::$table WHERE id = $id");
            return $data -> fetchAll();
        }catch (PDOException $e){
            return $e -> getMessage();
        }
    }
    public function delete_by_id($id){
        try{
            $id = $this::$conn -> quote($id);
            $result = $this::$conn -> exec("DELETE FROM $this::$table WHERE id = $id");
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
        //     "name" => "updata data of name",
        //     "credits" => "update data of credits"
        // ]
        try{
            $id = $this::$conn -> quote($id);
            $sql = "UPDATE $this::$table SET name=:name, credits=:credits WHERE id = $id";
            $sql = $this::$conn -> prepare(sql);
            $result = $sql -> execute($update_data);
        }catch(PDOException $e){
            return $e -> getMessage();
        }
    }
}
?>