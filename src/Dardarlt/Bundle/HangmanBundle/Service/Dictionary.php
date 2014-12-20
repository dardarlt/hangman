<?php


namespace Dardarlt\Bundle\HangmanBundle\Service;

class Dictionary
{
    protected $kernel;

    public function __construct(\AppKernel $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @return string
     */
    public function pickRandom()
    {
        $fileContent =  $this->getDictionary();
        $words = explode("\n", $fileContent);
        $randomize = array_rand($words);
        return $words[$randomize];
    }

    /**
     * @return string
     */
    public function getDictionary()
    {
        $filePath = $this->kernel->locateResource('@DardarltHangmanBundle/Resources/dict/words.english');
        return file_get_contents($filePath);
    }
}
