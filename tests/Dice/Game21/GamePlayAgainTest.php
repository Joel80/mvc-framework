<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;

/**
 * Test cases for the Game21 class
 */

class GamePlayAgainTest extends TestCase
{

    /**
     * Try to execute the playAgain method
     * with more than one bitcoin
     *
     */
    public function testPlayAgain10BitCoins()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->playAgain();

        $data = $game->getData();

        $expData = array("header" => "Dice", "message" => "The dice game!", "maxBet" => 5, "gameState" => 'setup');

        $this->assertEquals($expData, $data);
    }

    /**
     * Try to execute the playAgain method
     * with one bitcoin
     *
     */
    public function testPlayAgain1BitCoin()
    {
        $game = new Game21(100, 1);

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->playAgain();

        $data = $game->getData();

        $expData = array("header" => "Dice", "message" => "The dice game!", "maxBet" => 1, "gameState" => 'setup');

        $this->assertEquals($expData, $data);
    }
}
