<?php
/**
 * Created by PhpStorm.
 * User: ADRIE
 * Date: 20/08/2018
 * Time: 22:19
 */

namespace Model;

class conexaomysql
{
    public static $instance;
    private function __construct() {
        //
    }
    public static function getInstance() {
        try{
            if (!isset(self::$instance)) {
                // CONEXÃO LOCAL
                self::$instance = new PDO('mysql:host=localhost;dbname=cursophp', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            }

            return self::$instance;
        } catch(PDOException $pe){
            echo $pe->getMessage();
        }
    }
}