<?php
header("Access-Control-Allow-Origin: https://quanth.id.vn");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'routes/route.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use routes\route;
if ($_SERVER['REQUEST_URI'] === '/index.php' || $_SERVER['REQUEST_URI'] == '/') {
    header("Location: /property");
    exit(); 
}
// header('Content-Type: application/json'); //hiển thị dưới dạng Json

// Đăng ký route
route::get('/property', 'App\Controllers\HomeController@index');
route::get('/property/create', 'App\Controllers\HomeController@create');
route::get('/property/edit/{id}', 'App\Controllers\HomeController@edit');
route::post('/property/store', 'App\Controllers\HomeController@store');
route::put('/property/update/{id}', 'App\Controllers\HomeController@update');
route::delete('/property/remove/{id}', 'App\Controllers\HomeController@destroy');

route::get('/search', 'App\Controllers\HomeController@search');
route::get('/renderData', 'App\Controllers\HomeController@fetchData');
route::get('/filter', 'App\Controllers\HomeController@filter');
route::get('/renderPerPage', 'App\Controllers\HomeController@renderPerPage');
// route::get('/getTotalPage', 'App\Controllers\HomeController@getTotalPages');

// Dispatch route
route::dispatch();

