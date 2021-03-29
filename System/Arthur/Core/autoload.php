<?php
/**
 * @author Adam Arthur Faizal
 *
 **/

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