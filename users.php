<?php

spl_autoload_register(function (string $className) {
    require $className . '.php';
});

try {
    $method = $argv[1];
    $param = $argv[2];
    $users = new Users();
    if ($param) {
        $users->$method($param);
    } else {
        $users->$method();
    }
} catch (Error $e) {
    echo "Method $method must have one parameter \n";
}

