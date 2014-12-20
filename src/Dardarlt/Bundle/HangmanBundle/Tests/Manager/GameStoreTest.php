<?php
namespace Dardarlt\Bundle\HangmanBundle\Tests\Manager;

class GameStoreTest extends \Dardarlt\Bundle\HangmanBundle\Tests\KernelTestCase
{

    public function testHasSavedGames()
    {
        $client = static::createClient();
        $client->request('POST', '/api/games');

        $games = self::$entityManager
            ->getRepository('DardarltHangmanBundle:Game')
            ->findAll()
        ;

        $this->assertGreaterThan(0, count($games));
    }
}
