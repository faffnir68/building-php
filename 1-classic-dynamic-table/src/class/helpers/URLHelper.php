<?php
namespace App\class\helpers;


class URLHelper {
    public static function withParam(array $data, string $key, string $value): string
    {
        return http_build_query(array_merge($data, [$key => $value]));
    }

    public static function withParams(array $data, array $params): string
    {
        return http_build_query(array_merge($data, $params));
    }
}