<?php


namespace Dardarlt\Hangman\Game;

use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\Validation;

class Guessing
{
    protected $guessable;

    public function __construct(Guessable $guessable)
    {
        $this->guessable = $guessable;
    }

    public function addLetter($letter)
    {
        if ($this->validate($letter)) {
            $this->guessable->guess($letter);
        }
    }

    protected function validate($letter)
    {
        return Validation::input($letter);
    }
}
