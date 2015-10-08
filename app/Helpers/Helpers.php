<?php

if (! function_exists('create_object')) {

    function create_object(array $array)
    {
        return json_decode( json_encode($array), false );
    }
}


if (! function_exists('get_gravatar') ) {

    function get_gravatar( $email, $s = 45, $d = 'identicon', $r = 'g', $img = true, $atts = [] ) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

}