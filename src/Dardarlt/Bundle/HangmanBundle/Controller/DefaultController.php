<?php

namespace Dardarlt\Bundle\HangmanBundle\Controller;

use Dardarlt\Bundle\HangmanBundle\Entity\Game;
use Dardarlt\Hangman\Game\Word\Word;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $game = new Game();
        $game->setWord(new Word('testukas'));
        $this->get('hm.game_manager')->store($game);

        return $this->render('DardarltHangmanBundle:Default:index.html.twig', array('name' => $name));
    }
}
