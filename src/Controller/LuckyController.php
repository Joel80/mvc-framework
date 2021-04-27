<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/number", name = "app_lucky_number")
     */
    public function number(SessionInterface $session): Response
    {
        $lastNumber = $session->get('last') /* ?? null */;
        $number = random_int(0, 100);

        $session->set('last', $number);

        return $this->render(
            'lucky/number.html.twig',
            ['number' => $number, 'lastNumber' => $lastNumber
            ]
        );
    }
}
