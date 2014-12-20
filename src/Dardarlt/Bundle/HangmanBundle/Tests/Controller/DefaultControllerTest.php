<?php

namespace Dardarlt\Bundle\HangmanBundle\Tests\Controller;

use Dardarlt\Bundle\HangmanBundle\Tests\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends KernelTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/games');
        //var_dump($client->getResponse()->getContent());
        //var_dump($crawler);
        $client->getResponse()->getContent();
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }
}
