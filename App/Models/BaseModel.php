<?php
namespace App\Models;
use App\Models\Database;
use Exception;
class BaseModel extends Database
{
    protected $conn;
    protected $table;
    protected $id;
    protected $query;
    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
        $this->query = "SELECT * FROM {$this->table}";
    }
    public function getAll()
    {
        try {
            $sql = "SELECT * FROM $this->table";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $data;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    public function store($data)
    {
        try {
            $fields = implode(", ", array_keys($data));
            $values = implode("', '", array_values($data));
            $sql = "INSERT INTO $this->table ($fields) VALUES ('$values')";
            return $this->conn->query($sql);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    public function update($id, $data)
    {
        try {
            $set = [];
            foreach ($data as $key => $value) {
                $set[] = "$key = '$value'";
            }
            $setQuery = implode(", ", $set);
            $sql = "UPDATE $this->table SET $setQuery WHERE id = $id";
            return $this->conn->query($sql);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    public function destroy($id)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE id = $id";
            return $this->conn->query($sql);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE $this->id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $data;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    public function filter($page, $methood, $limit)
    {
        // Phân tích và lấy trường và điều kiện từ chuỗi methood
        $sortArr = explode(",", $methood);
        $field = $sortArr[0];
        $condition = $sortArr[1];
    
        try {
            if ($condition == "asc" || $condition == "desc") {
                // Sắp xếp theo trường và điều kiện
                $sql = "SELECT * FROM $this->table ORDER BY $field $condition";
                $stmt = $this->conn->prepare($sql);
            } else {
                // Lọc theo trường và điều kiện
                $sql = "SELECT * FROM $this->table WHERE $field = :condition";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':condition', $condition, \PDO::PARAM_STR);
            }
    
            // Thực thi câu lệnh
            $stmt->execute();
            
            // Lấy tất cả kết quả
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
            // Tạo kết quả trả về với pagination
            $post = [
                'countData' => count($data),
                'data' => $this->renderPerPage($page, $data, $limit),
                'limit' => $limit,
            ];
    
            echo json_encode($post);
    
        } catch (\PDOException $e) {
            // Log lỗi nếu có
            error_log($e->getMessage());
            echo json_encode(['error' => 'Lỗi truy vấn!']);
        }
    }
    

    public function renderPerPage($page = null, $data = null, $limit = null)
    {
        if ($data == null) {
            $data = $this->getAll();
        }
        $start = ((int) $page - 1) * $limit;
        $paginatedData = array_slice($data, $start, $limit);
        return $paginatedData;
    }
    public function search($key)
    {
        try {
            // Sử dụng dấu phần trăm để tìm kiếm theo kiểu LIKE
            $key = "%$key%";
            
            // Chuẩn bị câu lệnh SQL với PDO
            $sql = "SELECT * FROM $this->table WHERE title LIKE :key OR city LIKE :key OR address LIKE :key LIMIT 5";
            $stmt = $this->conn->prepare($sql);
            
            // Gắn giá trị vào tham số
            $stmt->bindParam(':key', $key, \PDO::PARAM_STR);
            
            // Thực thi câu lệnh
            $stmt->execute();
            
            // Lấy tất cả kết quả
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            return $data;
    
        } catch (\PDOException $e) {
            // Log lỗi nếu có
            error_log($e->getMessage());
            return [];
        }
    }
    
}
?>