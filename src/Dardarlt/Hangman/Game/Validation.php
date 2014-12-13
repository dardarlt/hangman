<?php


namespace Dardarlt\Hangman\Game;

class Validation
{
    public static function input($letter)
    {
        if (!preg_match('/^[a-z]$/', $letter)) {
            throw new \InvalidArgumentException('This symbol is not allowed.');
        }

        return true;
    }

    public static function hasLetter($letter, array $array)
    {
        return in_array(strtolower($letter), $array);
    }
}
