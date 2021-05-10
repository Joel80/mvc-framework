<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\YatzyHighScore;
use App\Repository\YatzyHighScoreRepository;

class YatzyHighScoreController extends AbstractController
{
    /**
     * @Route("/yatzy/high/score", name="app_yatzy_high_score")
     */
    public function index(): Response
    {
        return $this->render('yatzy_high_score/index.html.twig', [
            'controller_name' => 'YatzyHighScoreController',
        ]);
    }

    /**
     * @Route("/yatzy/high/score/create", name="app_create_yatzy_high_score", methods={"POST"})
     */
    public function createYatzyHighScore(SessionInterface $session, EntityManagerInterface $entityManager, Request $request): Response
    {
        $game = $session->get("yatzy", null);

        if ($game) {
            $highScore = new YatzyHighScore();

            $score = $request->get("score");

            $name = $request->get("name");

            if ($score) {
                $highScore->setScore($score);
            }

            if ($name) {
                $highScore->setName($name);
            }

            $entityManager->persist($highScore);

            $entityManager->flush();

            $highScores = $entityManager
            ->getRepository(YatzyHighScore::class)
            ->/** @scrutinizer ignore-call */findAllOrderedByScore();

            if (count($highScores) > 5) {
                $lowestScore = $highScores[count($highScores) - 1];

                $entityManager->remove($lowestScore);

                $entityManager->flush();
            }

            $game->gameOver(true);
        }
        return $this->redirectToRoute('app_yatzy_play', [], 301);
    }

    /**
    * @Route("/yatzy/high/score/all", name="app_find_all_yatzy_high_score")
    */
    public function findAllYatzyHighScoreOrderedByScore(EntityManagerInterface $entityManager): Response
    {
        $highScores = $entityManager
            ->getRepository(YatzyHighScore::class)
            ->findAllOrderedByScore();

           // return $this->json($highScores);
            return $this->render('dice/yatzy_high_scores.html.twig', ['highScores' => $highScores]);
    }
}
