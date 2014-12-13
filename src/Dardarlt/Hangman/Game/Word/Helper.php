<?php


namespace Dardarlt\Hangman\Game\Word;

class Helper
{
    public static function wordToSchema($word)
    {
        return str_split($word);
    }
}
