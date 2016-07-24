<?php

namespace App\Lib\Services\PhoneNumber;


use App\Lib\Services\Countries\CountriesWrapper;
use libphonenumber\geocoding\PhoneNumberOfflineGeocoder;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberToCarrierMapper;
use libphonenumber\PhoneNumberToTimeZonesMapper;
use libphonenumber\PhoneNumberUtil;

class PhoneUtil
{
    /**
     * @var PhoneNumberUtil
     */
    private $phoneUtil;
    private $number;
    private $parsedHandle;
    private $regionCode;
    private $region;
    private $numberType;
    private $country;
    private $timeZone;
    private $carrier;
    private $intlNumber;
    /**
     * @var CountriesWrapper
     */
    private $countriesWrapper;


    /**
     * PhoneUtil constructor.
     * @param PhoneNumberUtil $numberUtil
     */
    public function __construct()
    {
        $this->phoneUtil = PhoneNumberUtil::getInstance();
        $this->countriesWrapper = CountriesWrapper::getInstance();
    }


    /** International format of mobile number
     * @return mixed
     */
    public function getIntlNumber()
    {
        return $this->intlNumber;
    }


    /** Timezone of mobile number
     * @return mixed
     */
    public function getTimeZone()
    {
        return $this->timeZone[0];
    }


    public function getRegionCode()
    {
        return $this->regionCode;
    }


    /** Returns number typr, MOBILE, FIXED LINE etc
     * @return mixed
     */
    public function getNumberType()
    {
        return $this->numberType;
    }


    /** Full Country name of mobile number country
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }


    public function carrier()
    {
        $carrier = PhoneNumberToCarrierMapper::getInstance();
        $carrier = $carrier->getNameForNumber($this->parsedHandle, "en");
        if ($carrier == "")
            return 'unknown';
        return $carrier;
    }

    public function getRegion()
    {
        if (strtolower($this->country) == strtolower($this->region))
            return $this->country;
        elseif (trim($this->region) == "")
            return $this->country;
        else
            return $this->region . ' / ' . $this->country;
    }

    public function getCountryCode()
    {
        return $this->parsedHandle->getCountryCode();
    }

    /**
     * Check if the number is valid
     * @return bool
     */
    public function isValid()
    {
        return $this->phoneUtil->isValidNumber($this->parsedHandle);
    }

    private function parse($number)
    {
        $this->parsedHandle = $this->phoneUtil->parse($number, "en");
        //dd($this->parsedHandle);
        return $this;
    }

    public function number($number)
    {
        $this->number = (bool)($number[0] == '+') ? $number : "+" . $number;
        $this->parse($this->number);

        $this->intlNumber = $this->phoneUtil->format($this->parsedHandle, PhoneNumberFormat::E164);
        $this->numberType = $this->numberTypes()[$this->phoneUtil->getNumberType($this->parsedHandle)];
        $this->regionCode = $this->phoneUtil->getRegionCodeForNumber($this->parsedHandle);

        $timezoneMapper = PhoneNumberToTimeZonesMapper::getInstance();
        $this->timeZone = $timezoneMapper->getTimeZonesForNumber($this->parsedHandle);

        //Returns country name if available eg (Nigeria, Ghana etc)
        //When not available it returns region eg (Georgia)
        $region = PhoneNumberOfflineGeocoder::getInstance();
        $this->region = $region->getDescriptionForNumber($this->parsedHandle, "en");

        //returns country name from the two letter region code eg NG, GH, US etc
        $this->country = $this->countriesWrapper->getCountryFromCCA2($this->regionCode);//\getCountry($this->regionCode)->name;
        return $this;
    }


    private function getUnitForCountry($intlDialCode)
    {

    }


    private function numberTypes()
    {
        return [
            27 => 'EMERGENCY',
            0 => 'FIXED LINE',
            2 => 'FIXED LINE OR MOBILE',
            1 => 'MOBILE',
            8 => 'PAGER',
            7 => 'PERSONAL_NUMBER',
            4 => 'PREMIUM_RATE',
            5 => 'SHARED_COST',
            29 => 'SHORT_CODE',
            30 => 'STANDARD_RATE',
            3 => 'TOLL_FREE',
            9 => 'UAN',
            10 => 'UNKNOWN',
            28 => 'VOICEMAIL',
            6 => 'VOIP',
        ];
    }


    public function getChargeByDialingCode($currency = 'units')
    {
        $dialingCode = $this->getCountryCode();

        if ($currency == 'unit' || $currency == 'units'):
            if (array_key_exists($dialingCode, $this->unitChargeByDialingCode())):
                return $this->unitChargeByDialingCode()[$dialingCode];
            endif;
            return false;
        elseif ($currency == 'price' || $currency == 'kobo'):
            if (array_key_exists($dialingCode, $this->priceChargeByDialingCode())):
                return $this->priceChargeByDialingCode()[$dialingCode];
            endif;
            return false;
        endif;

    }


    private function unitChargeByDialingCode()
    {
        //prices in units
        return [
            "93" => 5,
            "355" => 5,
            "213" => 5,
            "234" => 1.5,
            "1" => 2,
        ];
    }


    private function priceChargeByDialingCode()
    {
        //price in kobo
        return [
            "93" => 500,
            "355" => 500,
            "213" => 500,
            "234" => 200,
            "1" => 250,
        ];
    }
}