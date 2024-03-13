<?php

namespace App\Utils;

use Exception;

class UrlParser
{
    public static function parse(string $url, string $requestMethod)
    {
        $method = explode('/', $url);
        if (count($method) > 3) {
            throw new Exception('Bad url');
        }
        if ($requestMethod === 'POST') {
            return [
                'method' => $method[1],
                'param' => ParseJsonData::get()
            ];
        }
        return [
            'method' => $method[1],
            'param' => $method[2] ?? null
        ];

    }

}
