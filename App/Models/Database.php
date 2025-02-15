<?php
namespace App\Models;

use mysqli;
use Exception;

class Database {
    private $conn;

    public function __construct() {
        try {
            $config = include __DIR__ . '/../../config/config.php';

            $this->conn = new mysqli(
                $config['db']['host'],
                $config['db']['user'],
                $config['db']['pass'],
                $config['db']['name']
            );

            if ($this->conn->connect_error) {
                throw new Exception("Lỗi kết nối Database: " . $this->conn->connect_error);
            }

        } catch (Exception $e) {
            error_log($e->getMessage()); // Ghi log lỗi
            die("Lỗi hệ thống! Không thể kết nối database."); // Không hiển thị lỗi thô
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function close() {
        $this->conn->close();
    }
}
?>
