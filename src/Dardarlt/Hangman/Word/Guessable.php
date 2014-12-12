<?php

namespace Dardarlt\Hangman\Word;

class Guessable
{
    protected $guessable;

    public function __construct($guessable)
    {
        $this->guessable = $guessable;
    }

    public function getSchema()
    {
        return ['t' => 'a'];
    }
}
 