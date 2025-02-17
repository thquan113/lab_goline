<?php
namespace App\Models;

use mysqli;
use Exception;

class Database
{
    private $conn;

    public function __construct()
    {
        try {
            $config = include __DIR__ . '/../../config/config.php';
            $this->conn = new \PDO("mysql:host={$config['db']['host']};dbname={$config['db']['name']};charset=utf8", $config['db']['user'], $config['db']['pass']);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>