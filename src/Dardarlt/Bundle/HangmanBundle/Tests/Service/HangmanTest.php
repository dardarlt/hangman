<?php

namespace Dardarlt\Bundle\HangmanBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use \Mockery as m;
use \Dardarlt\Bundle\HangmanBundle\Service\Hangman;

class HangmanTest extends WebTestCase
{

    public function testNewGameIsCreated()
    {
        $dictionary = $this->getDictionaryStub();
        $dictionary
            ->expects($this->once())
            ->method('pickRandom')
            ->willReturn('Nyan');

        $hangmanService = new Hangman($dictionary);

        $this->assertInstanceOf('\Dardarlt\Hangman\Game\HangmanGame', $hangmanService->newGame());
    }


    public function testNewGameHasDefaultTries()
    {
        $dictionary = $this->getDictionaryStub();
        $dictionary
            ->expects($this->once())
            ->method('pickRandom')
            ->willReturn('Nyan');

        $hangmanService = new Hangman($dictionary);

        $this->assertEquals(11, $hangmanService->newGame()->getTries());
    }

    public function testNewGameHasDefaultStatus()
    {
        $dictionary = $this->getDictionaryStub();
        $dictionary
            ->expects($this->once())
            ->method('pickRandom')
            ->willReturn('Nyan');

        $hangmanService = new Hangman($dictionary);

        $this->assertEquals('busy', $hangmanService->newGame()->getStatus());
    }

    public function testGameReturnsHangmanGame()
    {
        $dictionary = $this->getDictionaryStub();
        $hangmanService = new Hangman($dictionary);

        $this->assertInstanceOf('\Dardarlt\Hangman\Game\HangmanGame', $hangmanService->game('Nyan', '....'));
    }

    public function hangmanGuessTriesProvider()
    {

        return [
            [
                'Nyan', 'N...', 'a', 9, 8
            ],
            [
                'Nyan', 'N...', 'b', 9, 8
            ],
            [
                'Nyan', 'N.a.', 'a', 9, 9
            ],
            [
                'Nyan', 'N.a.', 'b', 1, 0
            ]
        ];
    }

    /**
     *
     * @dataProvider HangmanGuessTriesProvider
     *
     * @param $word
     * @param $state
     * @param $letter
     * @param $tries
     * @param $expectedTries
     */
    public function testGuessReturnsCorrectTries($word, $state, $letter, $tries, $expectedTries)
    {
        $dictionary = $this->getDictionaryStub();

        $hangmanService = new Hangman($dictionary);
        $this->assertEquals($expectedTries, $hangmanService->guess($word, $state, $letter, $tries)->getTries());
    }

    public function testGuessReturnsLetterIsGuessed()
    {
        $dictionary = $this->getDictionaryStub();

        $hangmanService = new Hangman($dictionary);
        $this->assertEquals('N.a.', $hangmanService->guess('Nyan', 'N...', 'a', 9)->getStateAsString());
    }

    public function testGuessReturnsGameFailed()
    {
        $hangmanService = new Hangman($this->getDictionaryStub());
        $this->assertEquals('fail', $hangmanService->guess('Nyan', 'Nyan', 'b', 1)->getStatus());
    }

    public function testGuessReturnsGameFailedIfNoTriesLeft()
    {
        $hangmanService = new Hangman($this->getDictionaryStub());
        $this->assertEquals('fail', $hangmanService->guess('Nyan', 'Nyan', 'a', 0)->getStatus());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function getDictionaryStub()
    {
        return $this->getMock('Dardarlt\Bundle\HangmanBundle\Service\Dictionary');
    }
}
