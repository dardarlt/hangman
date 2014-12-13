<?php

namespace Dardarlt\Hangman\Game\Word;

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

    CONST MASK = '.';

    public function __construct($word)
    {
        $this->word = strtolower($word);

        if (!isset($this->schema)) {
            $this->createSchema();
        }
    }

    public function getSchema()
    {
        return $this->schema;
    }

    public function createSchema()
    {
        $word =  str_split($this->word);
        $this->mask = array_fill(0, count($word), self::MASK);
        $this->schema = $word;
    }

    public function getMask()
    {
        return $this->mask;
    }

    public function hasLetter($letter)
    {
        return in_array(strtolower($letter), $this->getSchema());
    }
}
