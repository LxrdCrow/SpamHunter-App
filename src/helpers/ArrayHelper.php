<?php

namespace App\Helpers;

class ArrayHelper
{
    public static function clean(array $array): array
    {
        return array_filter($array, function ($value) {
            return !is_null($value) && $value !== '';
        });
    }

    public static function only(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }

    public static function uniqueInsensitive(array $array): array
    {
        return array_unique(array_map('strtolower', $array));
    }

    public static function toQueryString(array $params): string
    {
        return http_build_query($params);
    }
}
