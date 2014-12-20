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

    public function testCreatedGameIsReturned()
    {
        $client = static::createClient();
        $client->request('POST', '/api/games');
        $client->request('GET', '/api/games/1');

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }

    public function testGameReturnsRequestSucceededHeader()
    {
        $client = static::createClient();
        $client->request('POST', '/api/games');
        $client->request('GET', '/api/games/9999');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
    
    public function testGameOverviewReturnsJsonResponse()
    {
        $client = static::createClient();
        $client->request('POST', '/api/games');
        $client->request('GET', '/api/games');

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }

    public function testGuessActionReturnsSuccessResponse()
    {
        $client = static::createClient();
        $client->request('POST', '/api/games');
        $client->request('POST', '/api/games/1', ['char' => 'a']);

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }
}
