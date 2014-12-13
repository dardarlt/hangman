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
}
