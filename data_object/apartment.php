<?php
require_once __DIR__."/mysql_conn.php";
class apartment extends mysql_conn
{
    private static $table = 'apartment';
    function __construct() {
        parent::__construct();
    }
    public function insert($id, $name, $director){
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $name = $this::$conn -> quote($name);
            $director = $this::$conn -> quote($director);
            $result = $this::$conn -> exec("INSERT INTO $table (id, name, director) VALUES($id, $name, $director)");
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
            return $e -> getMessage();
        }
    }
    public function update_by_id($id, $data){
        //$data = [
        //  "name": "name",
        //  "director": "director"
        //]
        try{
            $table = $this::$table;
            $id = $this::$conn -> quote($id);
            $sql = $this::$conn -> prepare("UPDATE $table SET name = :name, director= :director WHERE id = $id");
            $result = $sql -> execute($data);
            return $result;
        }catch (PDOException $e) {
            return $e -> getMessage();
        }
    }
}
?>