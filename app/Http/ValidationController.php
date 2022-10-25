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

    public function confirm($request, $field, $value)
    {
        if (!isset($request[$field]) || !isset($request['confirm']) || $request['confirm'] !== $request[$field]) {
            return [$field => "the " . $field . " field is not match with confirm"];
        }
        return null;
    }

    public function email($request, $field, $value)
    {
        if (!isset($request[$field]) || !filter_var($request[$field], FILTER_VALIDATE_EMAIL)) {
            return [$field => "Invalid email format"];
        }
        return null;
    }
}