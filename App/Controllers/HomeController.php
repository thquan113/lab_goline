<?php
namespace App\Controllers;

use App\Models\Property;
use App\Views\Layout\Head;
use App\Views\Layout\Scripts;
use App\Views\Home\Index;
use App\Views\Home\Edit;
use App\Views\Home\Create;
class HomeController
{
    protected $propertyModels;
    protected $limit;
    public function __construct()
    {
        $this->propertyModels = new Property();
        $this->limit = 4;
    }

    // private function render($view = null, $data = [])
    // {
    //     Head::render();
    //     if ($view) {
    //         $view::render($data);
    //     }
    //     Scripts::render();
    // }
    public function index()
    {
        $data = $this->propertyModels->getAll();
        Head::render();
        Index::render($data);
        Scripts::render();
    }

    public function create()
    {
        $scripts = ['scripts' => ['/public/assets/js/custom.js']];
        Head::render();
        Create::render();
        Scripts::render($scripts);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['store'])) {
            print_r($_POST);
            $uploadDir = 'public/assets/images/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
            $data = [
                'title' => $_POST['title'],
                'city' => $_POST['city'],
                'address' => $_POST['address'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'image' => $uploadFile,
                'status' => $_POST['status'],
            ];
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);
            if ($this->propertyModels->store($data)) {
                header("Location: /");
            } else {
                echo "Error adding property.";
            }
        }
    }

    public function edit($id)
    {
        $url = "https://provinces.open-api.vn/api/p/";
        $response = file_get_contents($url);
        $location = json_decode($response, true);
        $data = [
            'data' => $this->propertyModels->getById($id)[0],
            'location' => $location,
        ];
        $scripts = ['scripts' => ['/public/assets/js/custom.js']];
        Head::render();
        Edit::render($data);
        Scripts::render($scripts);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $id = $_POST['id'];
            $uploadDir = 'public/assets/images/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
            $data = [
                'title' => $_POST['title'],
                'city' => $_POST['city'],
                'address' => $_POST['address'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'image' => $uploadFile,
                'status' => $_POST['status'],
            ];
            if ($_FILES['image']['size'] > 0) {
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);
            } else {
                unset($data['image']);
            }
            if ($this->propertyModels->update($id, $data)) {
                header("Location: /");
            } else {
                echo "Error updating property.";
            }
        }
    }

    public function destroy()
    {
        $id = $_POST['id'];
        if ($this->propertyModels->destroy($id)) {
            header("Location: /");
        }
    }
    public function search()
    {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $results = $this->propertyModels->search($keyword);
            echo json_encode($results);
        } else {
            echo json_encode([]);
        }
    }
    public function fetchData()
    {
        $data = $this->propertyModels->getAll();
        $result = [
            'limit' => $this->limit,
            'data' => json_encode($data),
        ];
        echo json_encode($result);
    }
    public function filter()
    {
        $methood = isset($_GET['methood']) ? $_GET['methood'] : "created_at,desc";
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $data = $this->propertyModels->filter($page, $methood, $this->limit);
        echo $data;
    }
}
?>