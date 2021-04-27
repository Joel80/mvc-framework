<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;
use App\Dice\DiceHand;

/**
 * Test cases for the Game21 class
 */

class GameComputerRollTest extends TestCase
{
    /**
     * Try to execute the computerRoll() method of class Game21
     * with textual dice test that computerRollHistory is set.
     *
     */
    public function testComputerRollTextDiceSetsComputerRollHistory()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->playerRoll();

        $game->computerRoll();

        $data = $game->getData();

        $this->assertTrue(is_string($data["computerRollHistory"]));
    }

     /**
     * Try to execute the computerRoll() method of class Game21
     * with textual dice test that computerTotal is set.
     *
     */
    public function testComputerRollTextDiceSetsComputerTotal()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->playerRoll();

        $game->computerRoll();

        $data = $game->getData();

        $this->assertTrue(is_int($data["computerTotal"]));
    }

    /**
     * Try to execute the computerRoll() method of class Game21
     * with graphical dice test that computerRollHistory is set.
     *
     */
    public function testcomputerRollGraphicalDiceSetsComputerRollHistory()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $game->playerRoll();

        $game->computerRoll();

        $data = $game->getData();

        $this->assertTrue(is_string($data["computerRollHistory"]));
    }

    /**
     * Try to execute the computerRoll() method of class Game21
     * with graphical dice test that computerRollTotal is set.
     *
     */
    public function testcomputerRollGraphicalDiceSetsComputerTotal()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $game->playerRoll();

        $game->computerRoll();

        $data = $game->getData();

        $this->assertTrue(is_int($data["computerTotal"]));
    }

    /**
     * Try to execute the computerRoll() method of class Game21
     * with graphical dice test that computerRollGraphicRep is set.
     *
     */
    public function testcomputerRollGraphicalDiceSetsComputerRollGraphicRep()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $game->playerRoll();

        $game->computerRoll();

        $data = $game->getData();

        $this->assertTrue(is_array($data["computerRollGraphicRep"]));
    }

    /**
     * Try to execute the computerRoll() method of class Game21
     * with graphical dice test that ccomputerRollGraphicHistory is set.
     *
     */
    public function testcomputerRollGraphicalDiceSetsComputerRollGraphicHistory()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $game->playerRoll();

        $game->computerRoll();

        $data = $game->getData();

        $this->assertTrue(is_array($data["computerRollGraphicHistory"]));
    }
}
