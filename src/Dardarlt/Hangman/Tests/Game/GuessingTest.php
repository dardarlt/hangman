<?php


namespace Dardarlt\Hangman\Tests\Game;

use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\Guessing;
use Dardarlt\Hangman\Game\Word\Original;

class GuessingTest extends \PHPUnit_Framework_TestCase
{


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidLetter()
    {
        $guessable = new Guessable(new Original('Nyan'));
        $guessing = new Guessing($guessable);
        $guessing->addLetter('ab');
        $guessing->addLetter(3);
        $guessing->addLetter('-');
    }
}
