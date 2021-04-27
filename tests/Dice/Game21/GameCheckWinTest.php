<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;

/**
 * Test cases for the Game21 class
 */

class GameCheckWinTest extends TestCase
{

    /**
     * Try to execute the checkWin method with
     * first score higher than second
     *
     */
    public function testCheckComputerWinFirstScoreHigher()
    {
        $game = new Game21();

        $game->checkWin(20, 5);

        $data = $game->getData();

        $expResult = "Computer won!";

        $result = $data["result"];

        $this->assertEquals($expResult, $result);
    }

    /**
     * Try to execute the checkWin method with
     * second score higher than first
     *
     */
    public function testChecWinSecondScoreHigher()
    {
        $game = new Game21();

        $game->checkWin(5, 20);

        $data = $game->getData();

        $expResult = "Player won!";

        $result = $data["result"];

        $this->assertEquals($expResult, $result);
    }

     /**
     * Try to execute the checkWin method with
     * equal scores
     *
     */
    public function testCheckWinEqualScores()
    {
        $game = new Game21();

        $game->checkWin(5, 5);

        $data = $game->getData();

        $expResult = "Computer won!";

        $result = $data["result"];

        $this->assertEquals($expResult, $result);
    }
}
