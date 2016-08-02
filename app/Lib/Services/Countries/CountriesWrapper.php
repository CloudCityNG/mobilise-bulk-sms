<?php
namespace App\Lib\Services\Countries;

class CountriesWrapper
{

    private static $instance;
    private $jsonToLoad;


    public static function getInstance()
    {
        if (null == static::$instance):
            static::$instance = new CountriesWrapper();
        endif;
        return static::$instance;
    }


    private function __construct()
    {
        $file = base_path('vendor/mledoze/countries/dist/countries.json');
        ob_start();
        include $file;
        $file = ob_get_clean();
        $this->jsonToLoad = json_decode($file);
    }


    public function countryList()
    {
        $result = [];
        foreach ($this->jsonToLoad as $country) {
            $result[] = $country->name->common;
        }
        return $result;
    }


    public function hasCountryCCA2($cca2)
    {
        $result = [];
        for ($z = 0; sizeof($this->jsonToLoad) > $z; $z++):
            if ($this->jsonToLoad[$z]->cca2 == strtoupper($cca2))
                return true;
        endfor;
        return false;
    }


    public function getCountryFromCCA2($cca2)
    {
        for ($z = 0; sizeof($this->jsonToLoad) > $z; $z++):
            if ($this->jsonToLoad[$z]->cca2 == strtoupper($cca2))
                return $this->jsonToLoad[$z]->name->common;
        endfor;
    }


    public function getCountry($country)
    {
        $result = [];
        for ($i = 0; sizeof($this->jsonToLoad) > $i; $i++):
            if ($this->jsonToLoad[$i]->name->common == $country)
                return true;
        endfor;
        return false;
    }


    private function __clone()
    {
        //Stopping Clonning of Object
    }


    private function __wakeup()
    {
        //Stopping unserialize of object
    }

}