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
    public function getWordAsString();

    public function getStateAsString();

    public function getStatus();

    public function getTries();
}
