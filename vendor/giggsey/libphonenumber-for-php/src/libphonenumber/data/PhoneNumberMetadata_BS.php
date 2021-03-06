<?php
/**
 * This file is automatically @generated by {@link BuildMetadataPHPFromXml}.
 * Please don't modify it directly.
 */


return array (
  'generalDesc' => 
  array (
    'NationalNumberPattern' => '[2589]\\d{9}',
    'PossibleNumberPattern' => '\\d{7}(?:\\d{3})?',
  ),
  'fixedLine' => 
  array (
    'NationalNumberPattern' => '
          242(?:
            3(?:
              02|
              [236][1-9]|
              4[0-24-9]|
              5[0-68]|
              7[3467]|
              8[0-4]|
              9[2-467]
            )|
            461|
            502|
            6(?:
              0[1-3]|
              12|
              7[67]|
              8[78]|
              9[89]
            )|
            7(?:
              02|
              88
            )
          )\\d{4}
        ',
    'PossibleNumberPattern' => '\\d{7}(?:\\d{3})?',
    'ExampleNumber' => '2423456789',
  ),
  'mobile' => 
  array (
    'NationalNumberPattern' => '
          242(?:
            3(?:
              5[79]|
              [79]5
            )|
            4(?:
              [2-4][1-9]|
              5[1-8]|
              6[2-8]|
              7\\d|
              81
            )|
            5(?:
              2[45]|
              3[35]|
              44|
              5[1-9]|
              65|
              77
            )|
            6[34]6|
            727
          )\\d{4}
        ',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '2423591234',
  ),
  'tollFree' => 
  array (
    'NationalNumberPattern' => '
          242300\\d{4}|
          8(?:
            00|
            44|
            55|
            66|
            77|
            88
          )[2-9]\\d{6}
        ',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '8002123456',
  ),
  'premiumRate' => 
  array (
    'NationalNumberPattern' => '900[2-9]\\d{6}',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '9002123456',
  ),
  'sharedCost' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'personalNumber' => 
  array (
    'NationalNumberPattern' => '
          5(?:
            00|
            33|
            44|
            66|
            77|
            88
          )[2-9]\\d{6}
        ',
    'PossibleNumberPattern' => '\\d{10}',
    'ExampleNumber' => '5002345678',
  ),
  'voip' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'pager' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'uan' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'emergency' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'voicemail' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'shortCode' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'standardRate' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'carrierSpecific' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'noInternationalDialling' => 
  array (
    'NationalNumberPattern' => 'NA',
    'PossibleNumberPattern' => 'NA',
  ),
  'id' => 'BS',
  'countryCode' => 1,
  'internationalPrefix' => '011',
  'nationalPrefix' => '1',
  'nationalPrefixForParsing' => '1',
  'sameMobileAndFixedLinePattern' => false,
  'numberFormat' => 
  array (
  ),
  'intlNumberFormat' => 
  array (
  ),
  'mainCountryForCode' => false,
  'leadingDigits' => '242',
  'leadingZeroPossible' => false,
  'mobileNumberPortableRegion' => false,
);
