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
        $this->conn = new Database();
        $this->query = "SELECT * FROM {$this->table}";
    }
    public function getAll()
    {
        try {
            $sql = "SELECT * FROM $this->table";
            $result = $this->conn->query($sql);
            if (!$result) {
                throw new Exception("Lỗi truy vấn...");
            }
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
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
            $sql = "SELECT * FROM $this->table where $this->id = $id";
            $result = $this->conn->query($sql);
            if (!$result) {
                throw new Exception("Lỗi truy vấn...");
            }
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    public function filter($page, $methood, $limit)
    {
        $sortArr = explode(",", $methood);
        $field = $sortArr[0];
        $condition = $sortArr[1];
        if ($condition == "asc" || $condition == "desc") {
            $sql = "SELECT * FROM $this->table ORDER BY $field $condition";
            $result = $this->conn->query($sql);
        } else {
            $sql = "SELECT * FROM $this->table WHERE $field = '$condition'";
            $result = $this->conn->query($sql);
        }
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        $post = [
            'countData' => count($data),
            'data' => $this->renderPerPage($page, $data, $limit),
            'limit' => $limit,
        ];
        echo json_encode($post);
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
        $key = "%$key%";
        $sql = "SELECT * FROM $this->table WHERE title LIKE '$key' OR city LIKE '$key' OR address LIKE '$key' LIMIT 5";
        $result = $this->conn->query($sql);
        if (!$result) {
            throw new Exception("Lỗi truy vấn...");
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>