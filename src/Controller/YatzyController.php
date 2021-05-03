<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Dice\Yatzy as Yatzy;
use App\Dice\YatzyHand as YatzyHand;
use App\Dice\Scoreboard as Scoreboard;
use App\Dice\Scorebox as Scorebox;
use App\Dice\GraphicalDice as GraphicalDice;
use App\Entity\YatzyHighScore;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Controller for the game21 routes.
 */
class YatzyController extends AbstractController
{
    public function playGame(SessionInterface $session): Response
    {

        $game = $session->get('yatzy', null);

        if (!$game) {
            $playerHand = new YatzyHand();
            for ($i = 0; $i < 5; $i++) {
                $playerHand->addDice(new GraphicalDice());
            }

            $scoreboard = new Scoreboard();

            $scoreboard->addScorebox(new Scorebox("Ones"));
            $scoreboard->addScorebox(new Scorebox("Twos"));
            $scoreboard->addScorebox(new Scorebox("Threes"));
            $scoreboard->addScorebox(new Scorebox("Fours"));
            $scoreboard->addScorebox(new Scorebox("Fives"));
            $scoreboard->addScorebox(new Scorebox("Sixes"));

            $entityManager = $this->getDoctrine()->getManager();

            $highScores = $entityManager
                ->getRepository(YatzyHighScore::class)
                ->findAllScores();


            $nrOfHighScores = count($highScores);

            $lowestHighScore = 0;
            if ($nrOfHighScores > 0) {
                $lowestHighScore = $highScores[$nrOfHighScores - 1]['score'];
            }


            $game = new Yatzy($playerHand, $scoreboard, $nrOfHighScores, $lowestHighScore);

            $session->set('yatzy', $game);
        }

        $data = $game->getData();

        $data["gameState"] = $game->getGameState();

        return $this->render(
            'dice/yatzy.html.twig',
            ['data' => $data,
            ]
        );
    }

    public function playerRoll(SessionInterface $session): Response
    {
        $game = $session->get('yatzy');

        $game->playerRoll();

        return $this->redirectToRoute('app_yatzy_play', [], 301);
    }

    public function lockDice(Request $request, SessionInterface $session): Response
    {
        $lockedDice = $request->get("lockedDice") ?? [];

        $positions = [];

        foreach ($lockedDice as $die) {
            $positions[] = intval($die);
        }

        $game = $session->get('yatzy');


        $game->lockDice($positions);

        return $this->redirectToRoute('app_yatzy_play', [], 301);
    }

    public function lockScore(Request $request, SessionInterface $session): Response
    {
        //$lockedScore = isset($_POST["lockScore"]) ? intval($_POST["lockScore"]) : null;

        $lockedScore = $request->get("lockScore");

        $lockedScore = intval($lockedScore);

        $game = $session->get('yatzy');

        $game->lockScore($lockedScore);

        return $this->redirectToRoute('app_yatzy_play', [], 301);
    }

    public function newGame(SessionInterface $session): Response
    {
        $session->remove('yatzy');

        /* $game = isset($_SESSION["yatzy"]) ? $_SESSION["yatzy"] : null;

        $game->newGame(); */

        return $this->redirectToRoute('app_yatzy_play', [], 301);
    }

 /*    public function computerRoll(): Response
    {
        $game = isset($_SESSION["game"]) ? $_SESSION["game"] : null;

        $game->computerRoll();

        return $this->redirect((url("/dice")));
    } */

/*     public function playAgain(): Response
    {
        $game = isset($_SESSION["game"]) ? $_SESSION["game"] : null;

        $game->playAgain();

        return $this->redirect((url("/dice")));
    }

    public function resetScore(): Response
    {
        $game = isset($_SESSION["game"]) ? $_SESSION["game"] : null;

        $game->resetScore();

        return $this->redirect((url("/dice")));
    }

    public function resetBitcoins(): Response
    {
        $game = isset($_SESSION["game"]) ? $_SESSION["game"] : null;

        $game->resetBitCoins();

        return $this->redirect((url("/dice")));
    } */
}
