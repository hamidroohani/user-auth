<?php

namespace App\Http;

class ValidationController
{
    public static function required($request, $field)
    {
        if (!isset($request[$field])) {
            return [$field => $field . " is required"];
        }
        return null;
    }

    public static function min($request, $field, $value)
    {
        if (!isset($request[$field]) || strlen($request[$field]) <= $value) {
            return [$field => "the " . $field . " field must be at least " . $value . " characters"];
        }
        return null;
    }
}