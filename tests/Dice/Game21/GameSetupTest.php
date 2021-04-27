<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;
use App\Dice\DiceHand;

/**
 * Test cases for the Game21 class
 */

class GameSetupTest extends TestCase
{
    /**
     * Try to execute the setup method of class Game21
     * with textual dice
     *
     */
    public function testSetupTextDice()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $handOneDice = $handOne->getDices();

        $handOneFirstDie  = $handOneDice[0];

        $handTwoDice = $handTwo->getDices();

        $handTwoFirstDie  = $handTwoDice[0];

        $this->assertInstanceOf("\App\Dice\Dice", $handOneFirstDie);

        $this->assertInstanceOf("\App\Dice\Dice", $handTwoFirstDie);
    }

    /**
     * Try to execute the setup method of class Game21
     * with graphical dice
     *
     */
    public function testSetupGraphicalDice()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $handOneDice = $handOne->getDices();

        $handOneFirstDie  = $handOneDice[0];

        $handTwoDice = $handTwo->getDices();

        $handTwoFirstDie  = $handTwoDice[0];

        $this->assertInstanceOf("\App\Dice\GraphicalDice", $handOneFirstDie);

        $this->assertInstanceOf("\App\Dice\GraphicalDice", $handTwoFirstDie);
    }
}
