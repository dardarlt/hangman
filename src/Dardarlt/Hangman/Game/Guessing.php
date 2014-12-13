<?php


namespace Dardarlt\Hangman\Game;


use Dardarlt\Hangman\Game\Word\Guessable;

class Guessing
{
    protected $guessable;

    public function __construct(Guessable $guessable)
    {
        $this->guessable = $guessable;
    }

    public function addLetter($letter)
    {
        $this->validate($letter);
        $this->guessable->guess($letter);
    }

    protected function validate($letter)
    {
        if (!preg_match('/^[a-z]$/', $letter)) {
            throw new \InvalidArgumentException('This symbol is not allowed.');
        }
    }
}
