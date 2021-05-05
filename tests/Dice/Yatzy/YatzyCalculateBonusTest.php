<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Yatzy;
use App\Dice\YatzyHand;

/**
 * Test cases for the Yatzy class
 */

class YatzyCalculateBonusTest extends TestCase
{
    /**
     * Check that bonus is calculated when
     * score is high enough
     *
     */
    public function testCalcuLateBonus()
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

        for ($i = 0; $i < 6; $i++) {
            $yatzy->playerRoll();
            $yatzy->playerRoll();
            $yatzy->playerRoll();
            $scoreboard->setScore($i, 15);
            $yatzy->lockScore($i);
        }

        $data = $yatzy->getData();
        $expBonus = 50;
        $actualBonus = $data["bonus"];

        $this->assertEquals($expBonus, $actualBonus);
    }

    /**
     * Check that bonus is not calculated when
     * score is not high enough
     *
     */
    public function testCalcuLateBonusNoBonus()
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


        for ($i = 0; $i < 6; $i++) {
            $yatzy->playerRoll();
            $yatzy->playerRoll();
            $yatzy->playerRoll();
            $scoreboard->setScore($i, 0);
            $yatzy->lockScore($i);
        }

        $data = $yatzy->getData();
        $expBonus = 0;
        $actualBonus = $data["bonus"];

        $this->assertEquals($expBonus, $actualBonus);
    }
}
