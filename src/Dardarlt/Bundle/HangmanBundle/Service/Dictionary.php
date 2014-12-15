<?php

namespace Dardarlt\Bundle\HangmanBundle\Service;

use Symfony\Component\Finder\Finder;

class Dictionary
{
    public function pickRandom()
    {
        $fileContent =  $this->getDictionary();
        $words = explode("\n", $fileContent);
        $randomize = array_rand($words);

        return $words[$randomize];
    }

    public function getDictionary()
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../Resources/dict/');

        $file = '';
        foreach ($finder as $file) {
            $file .=  $file->getContents();
        }

        return $file;
    }
}
