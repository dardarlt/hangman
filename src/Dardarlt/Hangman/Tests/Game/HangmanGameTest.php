<?php


namespace Dardarlt\Hangman\Tests\Game;

use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\HangmanGame;
use Dardarlt\Hangman\Game\Word\Word;

class HangmanGameTest extends \PHPUnit_Framework_TestCase
{


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidLetter()
    {
        $guessable = new Guessable(new Word('Nyan'));
        $hangmanGame = new HangmanGame($guessable);
        $hangmanGame->addLetter('ab');
        $hangmanGame->addLetter(3);
        $hangmanGame->addLetter('-');
    }

    public function testGetDefaultStatus()
    {
        $guessable = new Guessable(new Word('Nyan'));
        $hangmanGame = new HangmanGame($guessable);
        $this->assertSame('busy', $hangmanGame->getStatus());
    }
}
