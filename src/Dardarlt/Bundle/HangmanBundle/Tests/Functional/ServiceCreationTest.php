<?php
namespace Dardarlt\Bundle\HangmanBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServiceCreationTest extends WebTestCase
{
    /**
     * Test for container build
     */
    public function testServices()
    {
        self::createClient()->getContainer();
    }
}
