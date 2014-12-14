<?php
namespace Dardarlt\Bundle\HangmanBundle\Tests\Manager;

use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class GameStoreTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $kernel = static::createKernel();
        $kernel->boot();

        /** @var  $doctrine */
        $doctrine = $kernel->getContainer()->get('doctrine');
        $em = $doctrine->getManager();
        $schemaTool = new SchemaTool($em);
        $metadata = $em->getMetadataFactory()->getAllMetadata();

        // Drop and recreate tables for all entities
        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);
    }


    public function testHasSavedGames()
    {
//        $games = $this->em
//            ->getRepository('DardarltHangmanBundle:Game')
//            ->findAll()
//        ;
//
//        $this->assertGreaterThan(0, $games);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }
}
