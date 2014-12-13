<?php


namespace Dardarlt\Hangman\Tests\Game\Word;

class OriginalTest extends \PHPUnit_Framework_TestCase
{

    public function testWorks()
    {
        $this->assertTrue(true);
    }

    public function testGetSchemaIsArray()
    {
        $originalWord = "Nyan";
        $original = new \Dardarlt\Hangman\Game\Word\Original($originalWord);
        $this->assertTrue(is_array($original->getSchema()));
    }

    public function testGetSchemaReturnsCombinedArray()
    {
        $originalWord = "ab";
        $original = new \Dardarlt\Hangman\Game\Word\Original($originalWord);
        $this->assertSame(['a' => 'a', 'b' => 'b'], $original->getSchema());
    }

    public function hasLetterProvider()
    {
        $out = [];

        $out[] = [
            'abc',
            'a',
            true
        ];

        $out[] = [
            'abc',
            'A',
            true
        ];

        $out[] = [
            'abc',
            'd',
            false
        ];

        return $out;

    }

    /**
     * @dataProvider hasLetterProvider
     * @param $letter
     */
    public function testHasLetter($word, $letter, $expectedResult)
    {
        $original = new \Dardarlt\Hangman\Game\Word\Original($word);
        $this->assertEquals($expectedResult, $original->hasLetter($letter));
    }
}
