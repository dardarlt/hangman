<?php

namespace Dardarlt\Bundle\HangmanBundle\Service;

use Dardarlt\Hangman\Game\HangmanGame;
use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\Word\Helper;
use Dardarlt\Hangman\Game\Word\Word;

/**
 * Adapter service for Hangman library management in symfony 2
 *
 * Class Hangman
 * @package Dardarlt\Bundle\HangmanBundle\Service
 */
class Hangman
{
    protected $dictionary;

    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * Return new game schema
     * @return HangmanGame
     */
    public function newGame()
    {
        $word = $this->dictionary->pickRandom();
        $guessable = new Guessable(new Word($word));

        return new HangmanGame($guessable);
    }

    /**
     * @param string $word
     * @param string $state
     *
     * @return HangmanGame
     */
    public function game($word, $state)
    {
        $hangmanGame = new HangmanGame(
            new Guessable(new Word($word), Helper::wordToSchema($state))
        );

        return $hangmanGame;
    }

    /**
     * Return object of guessed word
     * @param $word
     * @param $state
     * @param $letter
     *
     * @return HangmanGame
     */
    public function guess($word, $state, $letter, $tries)
    {
        $guessable = new Guessable(new Word($word), Helper::wordToSchema($state));

        $hangmanGame = new HangmanGame($guessable);
        $hangmanGame
            ->setTries($tries)
            ->addLetter($letter);

        return $hangmanGame;
    }
}
