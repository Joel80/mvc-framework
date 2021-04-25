<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dice\Game21;
use App\Dice\DiceHand;
use App\Dice\SetupGame21;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Form\Type\SetupGame21Type;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Controller for the game21 routes.
 */
class Game21Controller extends AbstractController
{

    public function playGame(Request $request, SessionInterface $session): Response
    {

        $game = $session->get('game', null);

        if (!$game) {
            $game = new Game21();
            $session->set('game', $game);
        }
        

        $data = $game->getData();

        if ($data["gameState"] === "setup") {
            return $this->redirectToRoute('app_game21_setup', [], 301);
        }

        //var_dump($data);

        //$data["gameState"] = $game->getGameState();

        $defaultDataPlayerRoll = ['message' => 'Player roll'];
        $formPlayerRoll = $this->createFormBuilder($defaultDataPlayerRoll)
            ->add('Roll', SubmitType::class)
            ->setAction($this->generateUrl('app_game21_player_roll'))
            ->getForm();
        
        $formPlayerRoll->handleRequest($request);

        $defaultDataPlayerStop = ['message' => 'Player stop'];
        $formPlayerStop = $this->createFormBuilder($defaultDataPlayerStop)
            ->add('Stop', SubmitType::class)
            ->setAction($this->generateUrl('app_game21_computer_roll'))
            ->getForm();
        
        $formPlayerStop->handleRequest($request);

        $defaultDataPlayAgain = ['message' => 'Play again'];
        $formPlayAgain = $this->createFormBuilder($defaultDataPlayAgain)
            ->add('playAgain', SubmitType::class)
            ->setAction($this->generateUrl('app_game21_play_again'))
            ->getForm();
        
        $formPlayAgain->handleRequest($request);

        $defaultDataResetScore = ['message' => 'Reset score'];
        $formResetScore = $this->createFormBuilder($defaultDataResetScore)
            ->add('resetScore', SubmitType::class)
            ->setAction($this->generateUrl('app_game21_reset_score'))
            ->getForm();
        
        $formResetScore->handleRequest($request);

        $defaultDataResetBitCoins = ['message' => 'Reset bitcoins'];
        $formResetBitCoins = $this->createFormBuilder($defaultDataResetBitCoins)
            ->add('resetBitcoins', SubmitType::class)
            ->setAction($this->generateUrl('app_game21_reset_bitcoins'))
            ->getForm();
        
        $formResetScore->handleRequest($request);

        return $this->render(
        'dice/game21.html.twig', ['data' => $data,  'formPlayerRoll' => $formPlayerRoll->createView(),
        'formPlayerStop' => $formPlayerStop->createView(), 'formPlayAgain' => $formPlayAgain->createView(),
        'formResetScore' => $formResetScore->createView(), 'formResetBitCoins' => $formResetBitCoins->createView(),
        ]);
    }

     public function setup(Request $request, SessionInterface $session): Response
    {
        $game = $session->get('game');

        $data = $game->getData();
        if ($data["gameState"] !== "setup") {
            return $this->redirectToRoute('app_game21_play', [], 301);
        }


        $defaultData = ['message' => 'Game setup'];
        $form = $this->createFormBuilder($defaultData)
            ->add('nrOfDice', ChoiceType::class, 
                ['choices' => [
                'One die' => 1,
                'Two dice' =>2,
                ],
                'expanded' => true
                ])

            ->add('diceType', ChoiceType::class, 
                ['choices' => ['Text dice' => 'text',
                'Graphical dice' => 'graphical'],
                'expanded' => true])
            ->add('bet', IntegerType::class)
            ->add('sides', IntegerType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $playerHand = new DiceHand();
            $computerHand = new DiceHand();
            $nrOfDice = $formData['nrOfDice'];
            $typeOfDice = $formData['diceType'];
            $bet = intval($formData['bet']);
            $sides = intval($formData['sides']) ?? 6;

            $game->setup($playerHand, $computerHand, $nrOfDice, $typeOfDice, $bet, $sides);

            return $this->redirectToRoute('app_game21_play', [], 301);
        }

        return $this->render(
            'dice/game21_setup.html.twig', ['data' => $data, 
            'form' => $form->createView(),
            ]);
    }

    public function playerRoll(Request $request, SessionInterface $session): Response
    {
        $game = $session->get('game');

        $game->playerRoll();

        $data = $game->getData();

        return $this->redirectToRoute('app_game21_play', [], 301);
    }

    public function computerRoll(Request $request, SessionInterface $session): Response
    {
        $game = $session->get('game');

        $game->computerRoll();

        return $this->redirectToRoute('app_game21_play', [], 301);
    }


    public function playAgain(Request $request, SessionInterface $session): Response
    {
        $game = $session->get('game');

        $game->playAgain();

        return $this->redirectToRoute('app_game21_play', [], 301);
    }

    public function resetScore(Request $request, SessionInterface $session): Response
    {
        $game = $session->get('game');

        $game->resetScore();

        return $this->redirectToRoute('app_game21_play', [], 301);
    }

    public function resetBitcoins(Request $request, SessionInterface $session): Response
    {
        $game = $session->get('game');

        $game->resetBitCoins();

        return $this->redirectToRoute('app_game21_play', [], 301);
    }
}
