<?php

namespace Dardarlt\Bundle\HangmanBundle\Manager;

use Dardarlt\Bundle\HangmanBundle\Entity\Game as GameEntity;
use Doctrine\ORM\EntityManager;

class GameManager
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

    public function get($id)
    {
        return $this->getRepository()->findById($id);
    }

    protected function getRepository()
    {
        return $this->entityManager->getDoctrine()
            ->getRepository('DardarltHangmanBundle:Game');
    }

    protected function saveEntity($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
