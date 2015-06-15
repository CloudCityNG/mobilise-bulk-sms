<?php namespace App\Lib\Mobilise;

use GuzzleHttp\Client;

define('INI_CONFIG', config_path('ini/response_codes.ini'));

class UrlConnector {

    private $error = [];
    /**
     * @var
     */
    private $cookie_file;
    private $return_info;


    function __construct($cookie_file=null)
    {

        if ( !is_null($cookie_file) )
            $this->cookie_file = storage_path('cookies/service_portals');

        $this->cookie_file = $cookie_file;
    }


    public function get($url)
    {
        return $this->_get($url);
    }

    public function login($url, $post_fields)
    {
        return $this->post($url, $post_fields, $this->cookie_file);
    }


    private function _get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $output = curl_exec($ch);

        if (curl_exec($ch) === false)
        {
            $this->error[] = 'Curl error: ' . curl_error($ch);
        }

        $this->return_info = curl_getinfo($ch);

        curl_close($ch);
        return $output;
    }


    private function post($url, $post_fields, $cookie_file)
    {
        $ch = curl_init();
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $output = curl_exec($ch);

        if (curl_exec($ch) === false)
        {
            $this->error[] = 'Curl error: ' . curl_error($ch);
        }

        $this->return_info = curl_getinfo($ch);

        curl_close($ch);
        return $output;
    }

    public function get_http_status()
    {
        //dd($this->return_info);
        $http_codes = parse_ini_file(INI_CONFIG);
        return $this->return_info['http_code'] . " - " . $http_codes[$this->return_info['http_code']];
    }

    public function get_return_info()
    {
        return $this->return_info;
    }

} 