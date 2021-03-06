<?php

namespace Dardarlt\Hangman\Game\Word;

use Dardarlt\Hangman\Game\Validation;

/**
 * Class Word
 * @package Dardarlt\Hangman\Game\Word
 *
 * class creates object which provides word word, his mask
 * and creates schema for it
 */
class Word
{
    protected $word;

    protected $schema;

    protected $mask;

    const MASK = '.';

    public function __construct($word)
    {
        $this->word = strtolower($word);

        if (!isset($this->schema)) {
            $this->createDefaultObject();
        }
    }

    public function getSchema()
    {
        return $this->schema;
    }

    public function createDefaultObject()
    {
        $word =  Helper::wordToSchema($this->word);
        $this->mask = array_fill(0, count($word), self::MASK);
        $this->schema = $word;
    }

    public function getMask()
    {
        return $this->mask;
    }

    public function hasLetter($letter)
    {
        return Validation::hasLetter($letter, $this->getSchema());
    }
}
