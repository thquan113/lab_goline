<?php

namespace routes;

class route
{
    private static $routes = [];

    // Đăng ký route GET
    public static function get($url, $controllerMethod)
    {
        self::addRoute('GET', $url, $controllerMethod);
    }

    // Đăng ký route POST
    public static function post($url, $controllerMethod)
    {
        self::addRoute('POST', $url, $controllerMethod);
    }

    // Đăng ký route PUT
    public static function put($url, $controllerMethod)
    {
        self::addRoute('PUT', $url, $controllerMethod);
    }

    // Đăng ký route DELETE
    public static function delete($url, $controllerMethod)
    {
        self::addRoute('DELETE', $url, $controllerMethod);
    }

    // Phương thức chung để thêm route
    private static function addRoute($method, $url, $controllerMethod)
    {
        self::$routes[] = [
            'method' => strtoupper($method),
            'url' => trim($url, '/'),
            'action' => $controllerMethod,
        ];
    }

    // Xử lý dispatch
    public static function dispatch()
    {
        // $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $baseFolder = trim(str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_NAME'])), '/');
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        if (!empty($baseFolder) && strpos($requestUri, $baseFolder) === 0) {
            $requestUri = trim(substr($requestUri, strlen($baseFolder)), '/');
        }
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }
        foreach (self::$routes as $route) {
            if ($route['method'] === $requestMethod && self::matchUrl($route['url'], $requestUri)) {
                list($controller, $method) = explode('@', $route['action']);
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    call_user_func_array([$controllerInstance, $method], self::extractParams($route['url'], $requestUri));
                    return;
                }
            }
        }

        http_response_code(404);
        echo json_encode(['message' => 'Page not foundss']);
    }


    // So khớp URL với tham số động
    private static function matchUrl($routeUrl, $requestUri)
    {
        // Thay thế {param} bằng regex để khớp tham số động
        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $routeUrl);
        // var_dump($pattern); 
        return preg_match("#^$pattern$#", $requestUri);
    }

    // Trích xuất tham số động từ URL
    private static function extractParams($routeUrl, $requestUri)
    {
        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $routeUrl);
        preg_match("#^$pattern$#", $requestUri, $matches);
        array_shift($matches); // Bỏ phần tử đầu tiên (URL đầy đủ)
        return $matches;
    }
}
