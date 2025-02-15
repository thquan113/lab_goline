<?php
if (!function_exists('base_url')) {
    function base_url($path = '') {
        $config = include __DIR__ . '/../config/config.php';
        return rtrim($config['base_url'], '/') . '/' . ltrim($path, '/');
    }
}
?>
