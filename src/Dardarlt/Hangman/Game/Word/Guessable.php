<?php

namespace Dardarlt\Hangman\Game\Word;

use Dardarlt\Hangman\Game\Exception\GuessFailedException;

/**
 * Class Guessable
 * @package Dardarlt\Hangman\Game\Word
 *
 * Class Guessable represents
 */
class Guessable
{
    protected $word;
    protected $schema;
    protected $state;

    public function __construct(Word $word, $state = null)
    {
        $this->word = $word;
        $this->schema = clone($word);

        if (null === $this->state) {
            $this->state = $this->schema->getMask();
        } else {
            $this->state = $state;
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

    public function updateSchemaWithLetter($replaceLetter)
    {
        $originalWord = $this->word->getSchema();
        $positions = array_keys($originalWord, $replaceLetter);

        for ($i = 0; $i < count($this->state); $i++) {
            if (in_array($i, $positions)) {
                $this->state[$i] = $originalWord[$i];
            }
        }
    }

    public function getRepresentation()
    {
        return $this->state;
    }
}
