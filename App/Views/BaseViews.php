<?php

namespace App\Views;

abstract class BaseViews{
    /**
     * Phương thức này dùng để in ra giao diện
    */
    abstract public static function render($data=null); 

}