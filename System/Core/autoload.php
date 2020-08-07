<?php
//if (isset($_SERVER['CONTEXT_PREFIX']))
define("BASE_URL", "http://{$_SERVER['SERVER_NAME']}{$_SERVER['CONTEXT_PREFIX']}");

spl_autoload_register(static function ($class) {
    $array = explode('\\', $class);
    $file = __DIR__ . "/App/" . end($array) . ".php";
    if (file_exists($file)) require_once $file;
});

spl_autoload_register(static function ($class) {
    $array = explode('\\', $class);
    $file = __DIR__ . "/Helper/" . end($array) . ".php";
    if (file_exists($file)) require_once $file;
});