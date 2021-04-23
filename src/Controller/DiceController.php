<?php
// src/Controller/DiceController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Dice\Dice;
use App\Dice\GraphicalDice;
use App\Dice\DiceHand;
use App\Dice\DiceThrower;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class DiceController extends AbstractController
{
    /**
     * Throws dice
     */
    public function throwDice(): Response
    {

        $diceThrower = new DiceThrower(2);

        $data = $diceThrower->roll();

        return $this->render(
            'dice/dice_throw.html.twig', ['data' => $data, 'lastNumber' => $lastNumber
            ]);
    }
}