<?php

namespace Dardarlt\Hangman\Game\Word;

use Dardarlt\Hangman\Game\Exception\GameIsWonException;
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
        $this->checkHasLetter($letter);

        if ($this->word->hasLetter($letter)) {
            $this->updateSchemaWithLetter($letter);

            if ($this->hasPlayerWon()) {
                throw new GameIsWonException('Game ended. You won.');
            }
            return null;
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

        $length = count($this->state);
        for ($i = 0; $i < $length; $i++) {
            if (in_array($i, $positions)) {
                $this->state[$i] = $originalWord[$i];
            }
        }
    }

    public function hasPlayerWon()
    {
        $diff = array_udiff($this->getWord(), $this->getState(), 'strcasecmp');
        return empty($diff);
    }

    public function getState()
    {
        return $this->state;
    }

    public function getWord()
    {
        return $this->word->getSchema();
    }

    protected function checkHasLetter($letter)
    {
        if (Validation::hasLetter($letter, $this->state)) {
            throw new LetterExistsException(
                sprintf(
                    "Letter %s already exists in current word.",
                    $letter
                )
            );
        }
    }
}
