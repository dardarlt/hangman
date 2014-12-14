<?php


namespace Dardarlt\Hangman\Game\Word;

class Helper
{
    /**
     * @param string $word
     * @return array
     */
    public static function wordToSchema($word)
    {
        return str_split($word);
    }
}
