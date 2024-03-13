<?php

namespace App;

use App\Controller\UsersController;
use App\Db\JsonDB;
use App\Db\MysqlDB;
use App\Utils\UrlParser;
use Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

$env = parse_ini_file(__DIR__ . '/../../.env');
$db = match ($env['DB_TYPE']) {
    'mysql' => new MysqlDB(),
    'json' => new JsonDB(),
    default => throw new Exception('Unknown db type'),
};
$users = new UsersController($db);

if(php_sapi_name() == 'cli') {
    $method = $argv[1];
    $param = $argv[2];
    if ($param) {
        $users->$method($param);
    } else {
        $users->$method();
    }
} else {
    $url = $_SERVER['REQUEST_URI'];
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    try {
        $methodWithParam = UrlParser::parse($url, $requestMethod);
        match ($methodWithParam['method']) {
            'all' => $users->all(),
            'getOne' => $users->getOne($methodWithParam['param']),
            'create' => $users->create($methodWithParam['param']),
            'delete' => $users->delete($methodWithParam['param']),
            default => throw new Exception('Bad url'),
        };
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
