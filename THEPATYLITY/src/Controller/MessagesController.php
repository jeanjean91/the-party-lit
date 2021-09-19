<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{
    /**
     * @Route("/messages-index", name="messages.index")
     */
    public function index()
    {
        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }

    /**
     * @Route("/messages-compose", name="messages.compose")
     */
    public function compose()
    {
        return $this->render('messages/compose.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }
}

