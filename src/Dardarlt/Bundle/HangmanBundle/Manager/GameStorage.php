<?php

namespace Dardarlt\Bundle\HangmanBundle\Manager;

use Dardarlt\Bundle\HangmanBundle\Entity\Game as GameEntity;
use Doctrine\ORM\EntityManager;

class GameStorage
{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function store(GameEntity $game)
    {
        $this->saveEntity($game);
    }

    public function storeAndReturnId(GameEntity $game)
    {
        $this->saveEntity($game);
        return $game->getId();
    }

    public function getAllGames()
    {
        return $this->getRepository()->findAll();
    }
    
    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    protected function getRepository()
    {
        return $this->entityManager->getRepository('DardarltHangmanBundle:Game');
    }

    protected function saveEntity($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
