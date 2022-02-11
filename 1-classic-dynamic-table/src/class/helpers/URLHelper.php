<?php
namespace App\class\helpers;


class URLHelper {
    public static function bindParams(array $params, array $newParams): string
    {
        return http_build_query(array_merge($params, $newParams));
    }
}