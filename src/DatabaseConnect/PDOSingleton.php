<?php
namespace App\DatabaseConnect;

use PDO;

class PDOSingleton{

    private static $instance = null;
    private $conn;

    private string $dsn = DSN;//'mysql:dbname=exercice;host=127.0.0.1;port=3306';
    private string $username =DB_USER;//'root';
    private string $password =DB_PASSWORD;//'';
    private array $options;

    private function __construct()
    {
        $this->conn = new PDO($this->dsn,$this->username,$this->password);
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
          self::$instance = new PDOSingleton();
        }
       
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

}
