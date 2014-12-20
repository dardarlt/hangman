<?php

namespace Dardarlt\Bundle\HangmanBundle\Controller;

use Dardarlt\Bundle\HangmanBundle\Entity\Game;
use Dardarlt\Hangman\Game\HangmanGame;
use Dardarlt\Hangman\Game\Word\StorableInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GamesController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function newGameAction()
    {
        /** @var HangmanGame $hangman */
        $hangman =  $this->get('hm.hangman_manager')->newGame();

        $gameEntity = $this->convertGameEntity($hangman);
        
        return new JsonResponse(
            [
                'id' =>  $this->get('hm.storage_manager')->storeAndReturnId($gameEntity),
                'word' => $hangman->getStateAsString(),
                'status' => $hangman->getStatus()
            ]
        );
    }

    /**
     * @return JsonResponse
     */
    public function overviewAction()
    {

        $gameEntities = $this->get('hm.storage_manager')->getAllGames();

        $games = [];
        foreach ($gameEntities as $game) {
            $games[] = $this->convertEntityToArray($game);
        }

        return new JsonResponse($games);
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function gameAction($id)
    {
        $gameEntity = $this->get('hm.storage_manager')->get($id);

        if (!$gameEntity) {
            return $this->notFoundResponse('Game does not exist');
        }

        $hangman =  $this->get('hm.hangman_manager')->game(
            $gameEntity->getWord(),
            $gameEntity->getState()
        );

        return new JsonResponse($hangman->jsonSerialize());
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function guessAction($id, Request $request)
    {
        $gameEntity = $this->get('hm.storage_manager')->get($id);

        if (!$gameEntity) {
            return $this->notFoundResponse('Game does not exist');
        }

        $hangman =  $this->get('hm.hangman_manager')->guess(
            $gameEntity->getWord(),
            $gameEntity->getState(),
            $request->request->get('char'),
            $gameEntity->getTries()
        );

        $this->saveStoreHangmanAsGame($gameEntity, $hangman);

        return new JsonResponse(
            [
                'word' => $hangman->getStateAsString(),
                'tries' => $hangman->getTries(),
                'status' => $hangman->getStatus()
            ]
        );
    }

    protected function convertEntityToArray(Game $game)
    {
        return [
            'id' => $game->getId(),
            'state' => $game->getState(),
            'last_update' => $game->getDateAdded()->format('Y-m-d H:i:s')
        ];
    }

    protected function convertGameEntity(StorableInterface $hangman)
    {
        $gameEntity = new Game();
        $gameEntity
            ->setWord($hangman->getWordAsString())
            ->setState($hangman->getStateAsString())
            ->setTries($hangman->getTries())
            ->setStatus($hangman->getStatus());
        return $gameEntity;
    }

    private function notFoundResponse($message)
    {
        return new JsonResponse(
            [
                'error' => true,
                'message' => $message
            ],
            404
        );
    }

    /**
     * @param $gameEntity
     * @param $hangman
     */
    protected function saveStoreHangmanAsGame($gameEntity, $hangman)
    {
        $gameEntity
            ->setState($hangman->getStateAsString())
            ->setStatus($hangman->getStatus())
            ->setTries($hangman->getTries());

        $this
            ->get('hm.storage_manager')
            ->store($gameEntity);
    }
}
