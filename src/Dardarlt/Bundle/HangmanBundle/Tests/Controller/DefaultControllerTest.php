<?php

namespace Dardarlt\Bundle\HangmanBundle\Tests\Controller;

use Dardarlt\Bundle\HangmanBundle\Entity\Game;
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

        $hangman  = $this->hangmanStorageServiceMock();
        $hangman
            ->expects($this->once())
            ->method('get')
            ->willReturn(
                $this->getGameEntityMock()
            )
        ;

        static::$kernel->getContainer()->set('hm.storage_manager', $hangman);

        $client->request('GET', '/api/games/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGameReturnsRequestNotFoundHeader()
    {
        $client = static::createClient();
        $client->request('GET', '/api/games/1');

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

    protected function getGameEntityMock()
    {
        $game = $this
            ->getMockBuilder('Dardarlt\Bundle\HangmanBundle\Entity\Game')
            ->getMock()
        ;

        $game
            ->expects($this->atLeastOnce())
            ->method('getWord')
            ->willReturn('Test')
        ;

        $game
            ->expects($this->atLeastOnce())
            ->method('getState')
            ->willReturn('Test')
        ;

        return $game;
    }
    
    protected function hangmanStorageServiceMock()
    {
        return $this
            ->getMockBuilder('Dardarlt\Bundle\HangmanBundle\Manager\GameStorage')
            ->disableOriginalConstructor()
            ->getMock()
        ;
    }
}
