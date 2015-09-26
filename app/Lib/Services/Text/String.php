<?php
namespace App\Lib\Services\Text;


class String {


    public static function randomString($length=10)
    {
        $result = "";
        $chars = 'abcdefghijklmnopqrstuvwxyz$_?!-0123456789';
        $charArray = str_split($chars);
        for($i = 0; $i < $length; $i++){
            $randItem = array_rand($charArray);
            $result .= "".$charArray[$randItem];
        }
        return $result;
    }


    public static function replaceChar($string, $replace="_", $lower=true)
    {
        if ($lower) $string = strtolower($string);
        $string = preg_replace('/\s+/', $replace, $string);
        return $string;
    }

} 