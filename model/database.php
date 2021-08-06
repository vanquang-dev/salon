<?php
class Database {
    private $host = "localhost";
    private $db_name = "salon";
    private $username = "root";
    private $password = "";
    public $connection;
 
    public function get_connection(){
        $this->connection = new mysqli($this->host,$this->username,$this->password,$this->db_name) or die("Connected Wrong (･´з`･)");
        mysqli_set_charset($this->connection, "utf8");
        return $this->connection;
    }
}
?>