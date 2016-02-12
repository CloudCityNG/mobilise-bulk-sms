<?php

use App\Lib\Services\Flash\Notifier;


function echo_($print, $length=100, $cut_character='...')
{
    if ( strlen($print) <= $length )
        return $print;
    else
        return substr($print, 0, $length) . $cut_character;
}


function flash()
{
    return app(Notifier::class);
}


if (!function_exists('mark_active'))
{
    function mark_active($urlPath, $thisLink, $class=1)
    {
        if ( $urlPath == $thisLink )
        {
            if ( $class )
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
        if ( empty($value) ) {
            return NULL;
        } else {
            return $value;
        }
    }
}
