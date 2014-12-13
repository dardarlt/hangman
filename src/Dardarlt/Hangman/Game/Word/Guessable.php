<?php

namespace Dardarlt\Hangman\Game\Word;

class Guessable
{
    protected $original;
    protected $schema;

    public function __construct(Original $original)
    {
        $this->original = $original;
    }

    public function guess($letter)
    {
        if ($this->original->hasLetter($letter)) {
            $this->addLetter($letter);
        }
    }
}
