<?php
namespace App\Lib\Services\Text;
/**
 * Class calculates the total number of characters in a textarea
 * it can return the full length, total lines, total line breaks
 * and a correct number of total characters.
 *
 * note that php counts line breaks as two characters (in windows machine)
 * @author shegun.babs
 *
 */
class CharacterCounter
{
    const _1page = 160;
    const _2page = 320;
    const _3page = 480;
    const _4page = 640;

    private $length;
    private $total_lines;
    private $total_breaks;
    private $total_characters;

    private $pages;

    //use magic methods to get
    public function __get($field)
    {
        return $this->$field;
    }

    public function __set($field, $value)
    {
        $this->field = $value;
    }

    public static function countXters($xters)
    {
        $x = new self();

        $x->length = strlen($xters);

        preg_match_all("/(\n)+/", $xters, $matches);

        $x->total_lines = count($matches[0]) + 1;

        $x->total_breaks = (int)$x->total_lines - 1;

        $x->total_characters = $x->length - $x->total_breaks;

        return $x;
    }

    public static function countPage($xters)
    {
        $x = self::countXters($xters);
        switch (TRUE) {
            case ($x->total_characters <= self::_1page) :
                $x->pages = 1;
                break;
            case ($x->total_characters <= self::_2page) :
                $x->pages = 2;
                break;
            case ($x->total_characters <= self::_3page):
                $x->pages = 3;
                break;
            case ($x->total_characters <= self::_4page):
                $x->pages = 4;
                break;
        }
        return $x;
    }
}