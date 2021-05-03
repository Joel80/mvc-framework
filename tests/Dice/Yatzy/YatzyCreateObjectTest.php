<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Yatzy;
use App\Dice\YatzyHand;

/**
 * Test cases for the Yatzy class
 */

class YatzyCreateObjectTest extends TestCase
{
    /**
     * Try to create the object of the class without arguments.
     *
     */
    public function testCreateYatzyObjectNoArguments()
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

        $this->assertInstanceOf("\App\Dice\Yatzy", $yatzy);
    }

    /**
     * Try to create the object of the class without arguments.
     * test that it sets  gameState to playerTurn
     */
    public function testCreateYatzyObjectSetsPlayerTurn()
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

        $data = $yatzy->getData();

        $this->assertEquals($data["gameState"], "playerTurn");
    }

    /**
     * Try to create the object of the class without arguments.
     * test that it sets playerRoll
     */
    public function testCreateYatzyObjectSetsPlayerRoll()
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

        $data = $yatzy->getData();

        $this->assertTrue(is_null($data["playerRoll"]));
    }

    /**
     * Try to create the object of the class without arguments.
     * test that it sets scoreBoxNames
     */
    public function testCreateYatzyObjectSetsScoreBoxNames()
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

        $data = $yatzy->getData();

        $this->assertTrue(is_array($data["scoreboxNames"]));
    }

    /**
     * Try to create the object of the class without arguments.
     * test that it sets scoreBoxScores
     */
    public function testCreateYatzyObjectSetsScoreBoxScores()
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

        $data = $yatzy->getData();

        $this->assertTrue(is_array($data["scoreboxScores"]));
    }

    /**
     * Try to create the object of the class without arguments.
     * test that it sets rounds
     */
    public function testCreateYatzyObjectSetsRounds()
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

        $data = $yatzy->getData();

        $this->assertEquals($data["rounds"], 0);
    }

    /**
     * Try to create the object of the class without arguments.
     * test that it sets lockedScores
     */
    public function testCreateYatzyObjectSetsLockedScores()
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

        $data = $yatzy->getData();

        $this->assertTrue(is_array($data["lockedScores"]));
    }

     /**
     * Try to create the object of the class without arguments.
     * test that it sets lockedDice
     */
    public function testCreateYatzyObjectSetsLockedDice()
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

        $data = $yatzy->getData();

        $this->assertTrue(is_array($data["lockedDice"]));
    }

     /**
     * Try to create the object of the class without arguments.
     * test that it sets handSize
     */
    public function testCreateYatzyObjectSetsHandSize()
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

        $data = $yatzy->getData();

        $this->assertEquals($data["handSize"], 5);
    }

    /**
     * Try to create the object of the class without arguments.
     * test that it sets totalScore
     */
    public function testCreateYatzyObjectSetsTotalScore()
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

        $data = $yatzy->getData();

        $this->assertTrue(is_null($data["totalScore"]));
    }
}
