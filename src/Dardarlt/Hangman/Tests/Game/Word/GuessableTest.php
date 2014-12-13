<?php


namespace Dardarlt\Hangman\Tests\Game\Word;


use Dardarlt\Hangman\Game\Word\Word;

class GuessableTest extends \PHPUnit_Framework_TestCase {


    public function addLetterProvider()
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

        return $out;

    }

    /**
     * @dataProvider addLetterProvider
     * @param $letter
     */
    public function testGetRepresentation($letter)
    {

    }
}
 