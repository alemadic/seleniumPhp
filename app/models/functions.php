<?php 

    // OLD PHP VERSION

    // function __autoload($class) {
    //     $class = strtolower($class);
    //     $path = "includes/{$class}.php";

    //     if(file_exists($path)) {
    //         require_once $path;
    //     } else {
    //         die("This file named {$class}.php was not found");
    //     }
    // }

    function my_autoloader($class) {
        $class = strtolower($class);
        $path = MODELS . "/{$class}.php";

        if(is_file($path) && !class_exists($class)) {
            include $path;
        } else {
            die("The file named {$class}.php was not found");
        }
    }
    
    spl_autoload_register('my_autoloader');

    function redirect($location) {
        header("Location: {$location}");
    }

    function jsonHeaders() {
        header("Content-Type: application/json");
    }

    function goodHttpResponse() {
        http_response_code(200);
    }

    function badHttpRequest() {
        http_response_code(400);
    }


?>