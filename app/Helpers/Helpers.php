<?php

use App\Lib\Services\Flash\Notifier;


if (!function_exists('number_to_word')) {

    function number_to_word($number)
    {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}


if (!function_exists('echo_')) {

    function echo_($print, $length = 100, $cut_character = '...')
    {
        if (strlen($print) <= $length)
            return $print;
        else
            return substr($print, 0, $length) . $cut_character;
    }
}


if (!function_exists('flash')) {
    function flash()
    {
        return app(Notifier::class);
    }
}


if (!function_exists('mark_active')) {
    function mark_active($urlPath, $thisLink, $class = 1)
    {
        if ($urlPath == $thisLink) {
            if ($class)
                return 'active';
            else
                return 'uk-active';
        }
    }
}


if (!function_exists('create_object')) {

    /**Create an object from an array
     * @param array $array
     * @return Object
     */
    function create_object(array $array)
    {
        return json_decode(json_encode($array), false);
    }
}


if (!function_exists('get_gravatar')) {

    /**Get gravatar for supplied email
     * @param $email
     * @param int $s
     * @param string $d
     * @param string $r
     * @param bool $img
     * @param array $atts
     * @return string
     */
    function get_gravatar($email, $s = 50, $d = 'identicon', $r = 'g', $img = true, $atts = [])
    {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img class="uk-border-circle" src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

}


if (!function_exists('print_value')) {

    /**Print the value of a variable if not empty else print null
     * @param $value
     * @return null
     */
    function print_value($value)
    {
        return !empty($value) ? $value : NULL;
    }

}


if (!function_exists('set_null')) {

    /**Set the value of an array to NULL if it is empty
     * @param $value
     * @return null
     */
    function set_null($value)
    {
        if (empty($value)) {
            return NULL;
        } else {
            return $value;
        }
    }
}
