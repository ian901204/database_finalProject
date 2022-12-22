<?php
class mysql_conn{
    protected static $conn = null;
    function __construct(){ 
        try {
            $host = "localhost";
            $account = "root";
            $pwd = "";
            $database = "myeschooldb";
            $db = new PDO("mysql:host=$host;dbname=$database", $account, $pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            // set the PDO error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this::$conn = $db;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function sqlQuery($sql){
        $sql = $this::$conn -> prepare($sql);
        $sql -> execute();
        return $sql -> fetchAll();
    }
}
?>