<?php

namespace App\Utils;

use Exception;

class ParseJsonData
{
    public static function get(): string
    {
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);
        if (count($data) > 1) {
            throw new Exception('Too much params');
        }
        return $data['name'];
    }
}
