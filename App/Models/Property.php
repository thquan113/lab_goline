<?php
namespace App\Models;

use App\Models\BaseModel;
use App\Traits\QueryScope;
class Property extends BaseModel{
    protected $conn;
    protected $table = "properties";
    protected $id = "id";
    
}