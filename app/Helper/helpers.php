<?php


use Illuminate\Support\Str;


if (!function_exists('str_limit')) {
    function str_limit(string $string): string
    {
        return Str::limit($string);
    }
}
