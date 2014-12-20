<?php

namespace Dardarlt\Bundle\HangmanBundle\Tests\Controller;

use Dardarlt\Bundle\HangmanBundle\Tests\KernelTestCase;

class GameControllerTest extends KernelTestCase
{
    public function testNewGameActionReturnsJsonResponse()
    {
        $client = static::createClient();

        $client->request('POST', '/api/games');

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }
}
