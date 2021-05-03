<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Yatzy;
use App\Dice\YatzyHand;

/**
 * Test cases for the Yatzy class
 */

class YatzyLockDiceTest extends TestCase
{

    /**
     * Try to execute the getGameState method.
     */
    public function testYatzyLockDice()
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

        $yatzy->lockDice(array(0));

        $data = $yatzy->getData();

        $lockedDice = $data["lockedDice"];

        $exp = true;

        $actual = $lockedDice[0];

        $this->assertEquals($exp, $actual);
    }

        /**
     * Try to execute the getGameState method.
     */
    public function testYatzyLockDiceAllLocked()
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

        $yatzy->playerRoll();

        //$hand->lockDice(0);

        $positions = array(0, 1, 2, 3, 4);

        $yatzy->lockDice($positions);

        $data = $yatzy->getData();

        $lockedDice = $data["lockedDice"];

        $exp = [true, true, true, true, true];

        $actual = $lockedDice;

        $this->assertEquals($exp, $actual);

        $this->assertEquals($data["gameState"], "scoring");
    }
}
