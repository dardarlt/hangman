<?php

namespace Dardarlt\Hangman\Game\Word;

use Dardarlt\Hangman\Game\Exception\GuessFailedException;

class Guessable
{
    protected $word;
    protected $schema;

    public function __construct(Word $word, $state = null)
    {
        $this->word = $word;

        if (null === $this->schema) {
            $this->schema = $word->getSchema();
        }
    }

    public function guess($letter)
    {
        if ($this->word->hasLetter($letter)) {
            $this->updateSchemaWithLetter($letter);
        }

        throw new GuessFailedException(
            sprintf(
                "Letter %s not found in current word.",
                $letter
            )
        );
    }

    protected function updateSchemaWithLetter($letter)
    {

    }


}
