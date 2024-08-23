<?php
class Validator
{
    public static function string($value, $min = 1, $max = INF) //INF = infinity
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {
        //validates the email
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
