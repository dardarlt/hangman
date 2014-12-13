<?php


namespace Dardarlt\Hangman\Tests\Game;

use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\Guessing;
use Dardarlt\Hangman\Game\Word\Word;

class GuessingTest extends \PHPUnit_Framework_TestCase
{


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidLetter()
    {
        $guessable = new Guessable(new Word('Nyan'));
        $guessing = new Guessing($guessable);
        $guessing->addLetter('ab');
        $guessing->addLetter(3);
        $guessing->addLetter('-');
    }
}
