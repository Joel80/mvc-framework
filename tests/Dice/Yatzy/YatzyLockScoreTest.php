<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Yatzy;
use App\Dice\YatzyHand;

/**
 * Test cases for the Yatzy class
 */

class YatzyLockScoreTest extends TestCase
{

    /**
     * Try to execute the lockScore method, turn is not over.
     *
     */
    public function testLockScore()
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

        $yatzy->lockScore(0);

        $data = $yatzy->getData();

        $lockedScores = $data["lockedScores"];

        $exp = [true, false, false, false, false, false];

        $actual = $lockedScores;

        $this->assertEquals($exp, $actual);
    }

    /**
     * Try to execute the lockScore method
     *
     */
    public function testLockScoreLockAll()
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
            $yatzy->lockScore($i);
        }

        $data = $yatzy->getData();

        $lockedScores = $data["lockedScores"];

        $exp = [true, true, true, true, true, true];

        $actual = $lockedScores;

        //var_dump($data);
        $this->assertEquals($exp, $actual);
    }
}
