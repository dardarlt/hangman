<?php

namespace Dardarlt\Bundle\HangmanBundle\Tests;

 use Doctrine\DBAL\Driver\AbstractSQLiteDriver;
 use Doctrine\ORM\Tools\SchemaTool;
 use Symfony\Bundle\FrameworkBundle\Test\WebTestCase ;

 abstract class KernelTestCase extends WebTestCase
 {
     protected static $entityManager;
     protected static $client;
     protected static $application;
     protected $container;
     protected static $isFirstTest;

     public function setUp()
     {
         $config = array('environment' => 'test', 'debug' => true);

         self::$kernel = self::createKernel($config);
         self::$kernel->boot();

         $this->databaseInit();
         $this->container = self::$kernel->getContainer();
     }

     /**
      * Ensure kernel is shudowned
      */
     public function tearDown()
     {
         if (self::$kernel === null) {
             return;
         }

         self::$kernel->shutdown();
     }

     /**
      * Initialize database
      */
     protected function databaseInit()
     {
         static::$entityManager = static::$kernel
             ->getContainer()
             ->get('doctrine.orm.entity_manager');

         static::$application = new \Symfony\Bundle\FrameworkBundle\Console\Application(static::$kernel);

         static::$application->setAutoExit(false);
         $this->runConsole("doctrine:schema:drop", array("--force" => true));
         $this->runConsole("doctrine:schema:create", array("--no-interaction" => true));
         $this->runConsole("doctrine:schema:update", array("--force" => true));
         $this->runConsole("cache:warmup");
     }

     /**
      * Executes a console command
      *
      * @param type $command
      * @param array $options
      * @return type integer
      */
     protected function runConsole($command, Array $options = array())
     {
         $options["--env"] = "test";
         $options["--quiet"] = null;
         $options["--no-interaction"] = null;
         $options = array_merge($options, array('command' => $command));
         return static::$application->run(new \Symfony\Component\Console\Input\ArrayInput($options));
     }
 }