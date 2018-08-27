<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 21/08/2018
 * Time: 13:18
 */

namespace Model;

class Conexao
{
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "cursophp";
    private $username = "root";
    private $password = "root";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new \PDO("mysql:host=" . $this->host . ";charset=utf8;dbname=" . $this->db_name, $this->username, $this->password);
        }catch(\PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}