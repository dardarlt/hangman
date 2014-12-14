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
                'Nyan', 'N...', 'y', 9, 9
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
        $this->assertEquals(
            $expectedTries,
            $hangmanService->guess($word, $state, $letter, $tries)->getTries(),
            "Tries counting failed with parameters: "
            . var_export([$word, $state, $letter, $tries, $expectedTries], true)
        );
    }

    public function testGuessReturnsLetterIsGuessed()
    {
        $dictionary = $this->getDictionaryStub();

        $hangmanService = new Hangman($dictionary);
        $this->assertEquals('N.a.', $hangmanService->guess('Nyan', 'N...', 'a', 9)->getStateAsString());
    }

    public function testGuessReturnsOriginalWork()
    {
        $dictionary = $this->getDictionaryStub();

        $hangmanService = new Hangman($dictionary);
        $this->assertEquals('nyan', $hangmanService->guess('Nyan', 'N...', 'a', 9)->getWordAsString());
    }

    public function hangmanGuessStatusesProvider()
    {

        return [
            [
                'Nyan', 'ny.n', 'b', 1, 'fail'
            ],
            [
                'Nyan', 'nyan', 'a', 0, 'fail'
            ],
            [
                'Bus', 'B.s', 'u', 1, 'success'
            ],
            [
                'Bus', 'bus', 'u', 1, 'success'
            ],
            [
                'Nyan', 'ny.n', 'c', 9, 'busy'
            ]
        ];
    }

    /**
     * @dataProvider hangmanGuessStatusesProvider
     *
     * @param $word
     * @param $state
     * @param $letter
     * @param $tries
     * @param $expectedStatus
     */
    public function testGuessReturnsCorrectGameStatus($word, $state, $letter, $tries, $expectedStatus)
    {
        $hangmanService = new Hangman($this->getDictionaryStub());
        $this->assertEquals(
            $expectedStatus,
            $hangmanService->guess($word, $state, $letter, $tries)->getStatus(),
            "Guessing failes with parameters: " . var_export([$word, $state, $letter, $tries], true)
        );
    }

    /**
     * @return \Dardarlt\Bundle\HangmanBundle\Service\Dictionary
     */
    protected function getDictionaryStub()
    {
        return $this->getMock('Dardarlt\Bundle\HangmanBundle\Service\Dictionary');
    }
}
