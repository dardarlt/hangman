<?php

namespace Dardarlt\Hangman\Game\Word;

class Original
{
    protected $word;
    protected $schema;

    public function __construct($word)
    {
        $this->word = strtolower($word);
    }

    public function getSchema()
    {

        if (!isset($this->schema)) {
            $word =  str_split($this->word);
            $this->schema = array_combine($word, $word);
        }

        return $this->schema;
    }

    public function hasLetter($letter)
    {
        return in_array(strtolower($letter), $this->getSchema());
    }
}
