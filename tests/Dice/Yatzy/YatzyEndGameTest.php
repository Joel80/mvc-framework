<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Yatzy;
use App\Dice\YatzyHand;

/**
 * Test cases for the Yatzy class
 */

class YatzyEndGameTest extends TestCase
{

    /**
     * Test that the endGame method sets gameState to gameOver.
     */
    public function testEndGameStateGameOver()
    {
        $hand = new YatzyHand();
        for ($i = 0; $i < 5; $i++) {
            $hand->addDice(new GraphicalDice());
        }

        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox("Ones"));
        $scoreboard->addScorebox(new Scorebox("Twos"));
        $scoreboard->addScorebox(new Scorebox("Threes"));
        $scoreboard->addScorebox(new Scorebox("Fours"));
        $scoreboard->addScorebox(new Scorebox("Fives"));
        $scoreboard->addScorebox(new Scorebox("Sixes"));

        $yatzy = new Yatzy($hand, $scoreboard);

        for ($i = 0; $i < 6; $i++) {
            $yatzy->playerRoll();
            $yatzy->playerRoll();
            $yatzy->playerRoll();
            $yatzy->lockScore($i);
        }

        $data = $yatzy->getData();

        $exp = "gameOver";

        $actual = $data["gameState"];

        $this->assertEquals($exp, $actual);
    }
}
