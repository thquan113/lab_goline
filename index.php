<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'routes/route.php';

use App\Route;

if ($_SERVER['REQUEST_URI'] === '/index.php' || $_SERVER['REQUEST_URI'] === '/') {
    header("Location: /property");
    exit(); 
}
// header('Content-Type: application/json'); //hiển thị dưới dạng Json

// Đăng ký route
Route::get('/property', 'App\Controllers\HomeController@index');
Route::get('/property/create', 'App\Controllers\HomeController@create');
Route::get('/property/edit/{id}', 'App\Controllers\HomeController@edit');
Route::post('/property/store', 'App\Controllers\HomeController@store');
Route::put('/property/update/{id}', 'App\Controllers\HomeController@update');
Route::delete('/property/remove/{id}', 'App\Controllers\HomeController@destroy');

Route::get('/search', 'App\Controllers\HomeController@search');
Route::get('/renderData', 'App\Controllers\HomeController@fetchData');
Route::get('/filter', 'App\Controllers\HomeController@filter');
Route::get('/renderPerPage', 'App\Controllers\HomeController@renderPerPage');
// Route::get('/getTotalPage', 'App\Controllers\HomeController@getTotalPages');
// Dispatch route
Route::dispatch();

