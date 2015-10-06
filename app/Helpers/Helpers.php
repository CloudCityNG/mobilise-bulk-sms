<?php

if (! function_exists('create_object')) {

    function create_object(array $array)
    {
        return json_decode( json_encode($array), false );
    }
}