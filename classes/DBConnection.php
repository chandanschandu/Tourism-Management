<?php
if(!defined('DB_SERVER')){
    require_once("../initialize.php");
}
class DBConnection{

    private $host = '127.0.0.1:3308';
    private $username = 'root';
    private $password1 = '';
    private $database = 'tourism_db';
    
    public $conn;
    
    public function __construct(){

        if (!isset($this->conn)) {
            
            $this->conn =new mysqli($this->host, $this->username, $this->password1, $this->database);
            
            if ($this->conn->connect_error) {
                echo 'Connection failed: ' . $this->conn->connect_error;
                exit;
            }
                      
        }    
        
    }
    public function __destruct(){
        $this->conn->close();
    }
}
?>