<?php
namespace App\Controllers;

class CategoryController {
    public function index() {
        echo json_encode(["categories" => ["Table", "Chair", "Sofa"]]);
    }
}

?>