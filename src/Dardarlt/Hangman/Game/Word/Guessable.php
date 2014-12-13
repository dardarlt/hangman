<?php

namespace Dardarlt\Hangman\Game\Word;

use Dardarlt\Hangman\Game\Exception\GuessFailedException;
use Dardarlt\Hangman\Game\Exception\LetterExistsException;
use Dardarlt\Hangman\Game\Validation;

/**
 * Class Guessable
 * @package Dardarlt\Hangman\Game\Word
 *
 * Class Guessable represents
 */
class Guessable
{
    protected $word;
    protected $state;

    /**
     * @param Word $word original word object
     * @param array $state represents current game state
     *
     * We do not pass any state, if word is newly created as it does not have any
     */
    public function __construct(Word $word, array $state = null)
    {
        $this->word = $word;

        if (null === $state) {
            $this->state = $this->word->getMask();
        } else {
            $this->state = $state;
        }
    }

    public function guess($letter)
    {
        if ($this->hasStateLetter($letter)) {
            throw new LetterExistsException(
                sprintf(
                    "Letter %s already exists in current word.",
                    $letter
                )
            );
        }

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

    protected function hasStateLetter($letter)
    {
        return Validation::hasLetter($letter, $this->state);
    }
}
