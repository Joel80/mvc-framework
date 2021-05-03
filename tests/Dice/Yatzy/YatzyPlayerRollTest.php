<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Yatzy;
use App\Dice\YatzyHand;

/**
 * Test cases for the Yatzy class
 */

class YatzyPlayerRollTest extends TestCase
{

    /**
     * Try to execute the getGameState method.
     */
    public function testYatzyPlayerRoll()
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

        $nrOfHighScores = 1;

        $lowestScore = 1;

        $yatzy = new Yatzy($hand, $scoreboard, $nrOfHighScores, $lowestScore);

        $dataBeforeRoll = $yatzy->getData();

        $roundsBeforeRoll = $dataBeforeRoll["rounds"];

        $yatzy->playerRoll();

        $data = $yatzy->getData();

        $roundsAfterRoll = $data["rounds"];

        $this->assertTrue(is_array($data["playerRoll"]));

        $this->assertEquals($roundsBeforeRoll, $roundsAfterRoll - 1);
    }
}
