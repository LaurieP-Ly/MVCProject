<?php

namespace app\Config;


use PDOException;

class Database{

    // specify your own database credentials
    private $_host = "localhost";
    private $_db_name = "Site";
    private $_username = "user";
    private $_password = "user";
    private $_conn;


    // get the database connection
    public function getConnexion(){

        $this->_conn = null;

        try{
            $this->_conn = new \PDO("mysql:host=" . $this->_host . ";dbname=" . $this->_db_name, $this->_username, $this->_password);
            $this->_conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->_conn;
    }
}
?>