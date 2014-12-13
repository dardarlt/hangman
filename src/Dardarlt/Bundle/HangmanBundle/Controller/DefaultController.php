<?php

namespace Dardarlt\Bundle\HangmanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return new Response('test');
        return $this->render('DardarltHangmanBundle:Default:index.html.twig', array('name' => $name));
    }
}
