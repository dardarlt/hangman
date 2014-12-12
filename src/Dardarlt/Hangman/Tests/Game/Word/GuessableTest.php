<?php


class GuessableTest extends \PHPUnit_Framework_TestCase {

    public function testWorks()
    {
        $this->assertTrue(true);
    }

    public function testGetSchemaIsArray()
    {
        $guessableWord = "Nyan";
        $guessable = new \Dardarlt\Hangman\Game\Word\Guessable($guessableWord);
        $this->assertTrue(is_array($guessable->getSchema()));
    }

    public function testGetSchemaReturnsCombinedArray()
    {
        $guessableWord = "ab";
        $guessable = new \Dardarlt\Hangman\Game\Word\Guessable($guessableWord);
        $this->assertSame(['a' => 'a', 'b' => 'b'], $guessable->getSchema());
    }
}
 