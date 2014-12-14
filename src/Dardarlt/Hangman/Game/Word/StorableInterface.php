<?php
namespace Dardarlt\Hangman\Game\Word;

/**
 * Class Guessable
 * @package Dardarlt\Hangman\Game\Word
 *
 * Class Guessable represents
 */
interface StorableInterface
{
    /**
     * @return string
     */
    public function getWordAsString();

    /**
     * @return string
     */
    public function getStateAsString();

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @return integer
     */
    public function getTries();
}
