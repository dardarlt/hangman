<?php


namespace Dardarlt\Hangman\Tests\Game;


use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\Word\Guessing;

class GuessingTest extends \PHPUnit_Framework_TestCase {


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidLetter()
    {

        $guessable = new Guessable('Nyan');
        $guessing = new Guessing($guessable);
        $guessing->addLetter('ab');
    }

}
 