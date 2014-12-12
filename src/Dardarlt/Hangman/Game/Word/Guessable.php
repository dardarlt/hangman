<?php

namespace Dardarlt\Hangman\Game\Word;

class Guessable
{
    protected $guessable;

    public function __construct($guessable)
    {
        $this->guessable = $guessable;
    }

    public function getSchema()
    {
        $word =  str_split($this->guessable);
        return array_combine($word, $word);
    }
}
 