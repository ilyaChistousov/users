<?php

namespace App;
require_once __DIR__ . '/../../vendor/autoload.php';

$method = $argv[1];
$param = $argv[2];
$users = new Users();
if ($param) {
    $users->$method($param);
} else {
    $users->$method();
}