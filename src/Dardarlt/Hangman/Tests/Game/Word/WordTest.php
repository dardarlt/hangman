<?php


namespace Dardarlt\Hangman\Tests\Game\Word;

use Dardarlt\Hangman\Game\Word\Word;

class WordTest extends \PHPUnit_Framework_TestCase
{

    public function testGetSchemaIsArray()
    {
        $word = new \Dardarlt\Hangman\Game\Word\Word("Nyan");
        $this->assertTrue(is_array($word->getSchema()));
    }

    public function getMaskProvider()
    {
        return
            [
                [
                    'Nyan',
                        [
                            Word::MASK,
                            Word::MASK,
                            Word::MASK,
                            Word::MASK
                        ],
                ],
                [
                    'Cat',
                    [
                        Word::MASK,
                        Word::MASK,
                        Word::MASK
                    ],
                ]
        ];
    }

    /**
     * @dataProvider getMaskProvider
     * @param $originalWord
     * @param $expectedResult
     */
    public function testGetMask($originalWord, $expectedResult)
    {
        $original = new \Dardarlt\Hangman\Game\Word\Word($originalWord);
        $this->assertSame(
            $expectedResult,
            $original->getMask()
        );
    }

    public function getSchemaProvider()
    {
        $out = [];

        $out[] = [
            'Nyan',
            [
                'n',
                'y',
                'a',
                'n'
            ],
        ];
        return $out;

    }

    /**
     * @dataProvider getSchemaProvider
     * @param $originalWord
     * @param $expectedResult
     */
    public function testGetSchema($originalWord, $expectedResult)
    {
        $word = new \Dardarlt\Hangman\Game\Word\Word($originalWord);
        $this->assertSame(
            $expectedResult,
            $word->getSchema()
        );
    }

    public function hasLetterProvider()
    {
        return [
            [
                'abc',
                'a',
                true
            ],
            [
                'abc',
                'A',
                true
            ],
            [
                'abc',
                'd',
                false
            ]
        ];
    }

    /**
     * @dataProvider hasLetterProvider
     * @param $letter
     */
    public function testHasLetter($word, $letter, $expectedResult)
    {
        $word = new \Dardarlt\Hangman\Game\Word\Word($word);
        $this->assertEquals($expectedResult, $word->hasLetter($letter));
    }
}
