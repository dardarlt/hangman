<?php

namespace Dardarlt\Bundle\HangmanBundle\Manager;

use Dardarlt\Bundle\HangmanBundle\Entity\Game as GameEntity;
use Doctrine\Common\Persistence\ManagerRegistry;

class GameStorage
{

    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
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

    /**
     * @return array|\Dardarlt\Bundle\HangmanBundle\Entity\Game[]
     */
    public function getAllGames()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @param $id
     *
     * @return GameEntity
     */
    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Return repository for Game entity class
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepository()
    {
        $entityManager = $this->managerRegistry->getManagerForClass('Dardarlt\Bundle\HangmanBundle\Entity\Game');

        return $entityManager->getRepository('DardarltHangmanBundle:Game');
    }

    /**
     * @param GameEntity $entity
     */
    protected function saveEntity($entity)
    {
        $entityManager = $this->managerRegistry->getManagerForClass(get_class($entity));
        $entityManager->persist($entity);
        $entityManager->flush();
    }
}
