<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dice\Game21;
use App\Dice\DiceHand;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller for the game21 routes.
 */
class Game21Controller extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function playGame(/* SessionInterface $session */): Response
    {

        $game = $this->session->get('game', null);

        if (!$game) {
            $game = new Game21();
            $this->session->set('game', $game);
        }

        //var_dump($this->session);

        $data = $game->getData();

        $twig = 'dice/game21.html.twig';

        $content = $this->renderView($twig, ['data' => $data,]);

        return new Response($content);
    }

    public function setup(Request $request/* , SessionInterface $session */): Response
    {
        $game = $this->session->get('game', null);

        $data = [];

        $data["gameState"] = null;

        if ($game) {
            $data = $game->getData();
        }

        if ($data["gameState"] !== "setup") {
            return $this->redirectToRoute('app_game21_play', [], 301);
        }

        $playerHand = new DiceHand();
        $computerHand = new DiceHand();
        $nrOfDice = intval($request->get("dice"));
        $diceType = $request->get("diceType");
        $bet = intval($request->get("bet"));
        $sides = intval($request->get("sides"));

        if ($game) {
            $game->setup($playerHand, $computerHand, $nrOfDice, $diceType, $bet, $sides);
        }

        return $this->redirectToRoute('app_game21_play', [], 301);
    }

    public function playerRoll(/* SessionInterface $session */): Response
    {
        $game = $this->session->get('game', null);

        if ($game) {
            $game->playerRoll();
        }

        return $this->redirectToRoute('app_game21_play', [], 301);
    }

    public function computerRoll(/* SessionInterface $session */): Response
    {
        $game = $this->session->get('game', null);

        if ($game) {
            $game->computerRoll();
        }

        return $this->redirectToRoute('app_game21_play', [], 301);
    }


    public function playAgain(/* SessionInterface $session */): Response
    {
        $game = $this->session->get('game', null);

        if ($game) {
            $game->playAgain();
        }


        return $this->redirectToRoute('app_game21_play', [], 301);
    }

    public function resetScore(/* SessionInterface $session */): Response
    {
        $game = $this->session->get('game', null);

        if ($game) {
            $game->resetScore();
        }


        return $this->redirectToRoute('app_game21_play', [], 301);
    }

    public function resetBitcoins(/* SessionInterface $session */): Response
    {
        $game = $this->session->get('game', null);

        if ($game) {
            $game->resetBitCoins();
        }

        return $this->redirectToRoute('app_game21_play', [], 301);
    }
}
