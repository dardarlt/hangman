<?php


namespace Dardarlt\Hangman\Tests\Game\Word;

use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\Word\Word;

class GuessableTest extends \PHPUnit_Framework_TestCase
{


    public function addUpdateSchemaWithLetter()
    {
        $out = [];

        $out[] = [
            'Nyan',
            'a',
            [
                Word::MASK,
                Word::MASK,
                'a',
                Word::MASK,
            ]
        ];

        $out[] = [
            'Nyan',
            'n',
            [
                'n',
                Word::MASK,
                Word::MASK,
                'n',
            ]
        ];

        return $out;

    }

    /**
     * @dataProvider addUpdateSchemaWithLetter
     * @param $letter
     */
    public function testGetRepresentation($word, $letter, $expectedResult)
    {
        $guessable = new Guessable(new Word($word));
        $guessable->updateSchemaWithLetter($letter);
        $this->assertSame($expectedResult, $guessable->getRepresentation());
    }
}
