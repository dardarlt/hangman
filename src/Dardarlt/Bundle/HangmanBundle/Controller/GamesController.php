<?php

namespace Dardarlt\Bundle\HangmanBundle\Controller;

use Dardarlt\Bundle\HangmanBundle\Entity\Game;
use Dardarlt\Hangman\Game\HangmanGame;
use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\Word\StorableInterface;
use Dardarlt\Hangman\Game\Word\Word;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class GamesController extends Controller
{
    public function newGameAction()
    {
        /** @var HangmanGame $hangman */
        $hangman =  $this->get('hm.hangman_manager')->newGame();

        $gameEntity = $this->createGameEntity($hangman);
        
        return new JsonResponse(
            [
                'id' =>  $this->get('hm.storage_manager')->storeAndReturnId($gameEntity),
                'word' => $hangman->getStateAsString()
            ]
        );
    }

    public function overviewAction()
    {

        $gameEntities = $this->get('hm.storage_manager')->getAllGames();

        $games = [];
        foreach ($gameEntities as $game) {
            $games[] = $this->convertEntityToArray($game);
        }

        return new JsonResponse($games);
    }

    public function gameAction($id)
    {
        $gameEntity = $this->get('hm.storage_manager')->get($id);

        $hangman =  $this->get('hm.hangman_manager')->game(
            $gameEntity->getWord(),
            $gameEntity->getState()
        );

        return new JsonResponse($hangman->jsonSerialize());
    }

    public function guessAction($id)
    {
        return new JsonResponse('works');
    }

    protected function convertEntityToArray(Game $game)
    {
        return [
            'id' => $game->getId(),
            'state' => $game->getState(),
            'last_update' => $game->getDateAdded()->format('Y-m-d H:i:s')
        ];
    }

    protected function createGameEntity(StorableInterface $hangman)
    {
        $gameEntity = new Game();
        $gameEntity
            ->setWord($hangman->getWordAsString())
            ->setState($hangman->getStateAsString())
            ->setTries($hangman->getTries())
            ->setStatus($hangman->getStatus());
        return $gameEntity;
    }
}
