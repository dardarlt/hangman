<?php


namespace Dardarlt\Hangman\Tests\Game\Word;

use Dardarlt\Hangman\Game\Exception\LetterExistsException;
use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\Word\Word;

class GuessableTest extends \PHPUnit_Framework_TestCase
{
    public function statesProvider()
    {
        return
        [
            [
                'Nyan',
                [
                    'n',
                    Word::MASK,
                    Word::MASK,
                    'n',
                ],
                [
                    'n',
                    Word::MASK,
                    Word::MASK,
                    'n',
                ]
            ],
            [
                'Nyan',
                null,
                [
                    Word::MASK,
                    Word::MASK,
                    Word::MASK,
                    Word::MASK,
                ]
            ]
        ];
    }

    /**
     * @dataProvider statesProvider
     * @param $original
     * @param $state
     * @param $expected
     */
    public function testStateIsStored($original, $state, $expected)
    {
        $guessable = new Guessable(new Word($original), $state);
        $this->assertSame($expected, $guessable->getState());
    }

    /**
     * @expectedException \Dardarlt\Hangman\Game\Exception\LetterExistsException
     */
    public function testHasLetterThrowsLetterExistsException()
    {
        $guessable = new Guessable(new Word('Nyan'), ['.', '.', 'a', '.']);
        $guessable->guess('a');
    }

    /**
     * @expectedException \Dardarlt\Hangman\Game\Exception\GameIsWonException
     */
    public function testFullWordIsGuessed()
    {
        $guessable = new Guessable(new Word('Nyan'), ['n', 'y', '.', 'n']);
        $guessable->guess('a');
    }

    public function addUpdateSchemaWithLetterProvider()
    {
        return
        [
            [
                'Nyan',
                'a',
                [
                    Word::MASK,
                    Word::MASK,
                    'a',
                    Word::MASK,
                ],
            ],
            [
                'Nyan',
                'n',
                [
                    'n',
                    Word::MASK,
                    Word::MASK,
                    'n',
                ]
            ]
        ];
    }

    /**
     * @dataProvider addUpdateSchemaWithLetterProvider
     * @param $letter
     */
    public function testGetState($word, $letter, $expectedResult)
    {
        $guessable = new Guessable(new Word($word));
        $guessable->updateSchemaWithLetter($letter);
        $this->assertSame($expectedResult, $guessable->getState());
    }
}
