<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;
use App\Dice\DiceHand;

/**
 * Test cases for the Game21 class
 */

class GamePlayerRollTest extends TestCase
{
    /**
     * Try to execute the playerRoll() method of class Game21
     * with textual dice test that it sets playerRoll
     *
     */
    public function testPlayerRollTextDiceSetsPlayerRoll()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->playerRoll();

        $data = $game->getData();

        $this->assertTrue(is_string($data["playerRoll"]));
    }

    /**
     * Try to execute the playerRoll() method of class Game21
     * with textual dice test that it sets playerRollHistory
     *
     */
    public function testPlayerRollTextDiceSetsPlayerRollHistory()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->playerRoll();

        $data = $game->getData();

        $this->assertTrue(is_string($data["playerRollHistory"]));
    }

    /**
     * Try to execute the playerRoll() method of class Game21
     * with textual dice test that it sets sumPlayerRoll
     *
     */
    public function testPlayerRollTextDiceSetsSumPlayerRoll()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->playerRoll();

        $data = $game->getData();

        $this->assertTrue(is_int($data["sumPlayerRoll"]));
    }

    /**
     * Try to execute the playerRoll() method of class Game21
     * with textual dice test that it sets playerTotal
     *
     */
    public function testPlayerRollTextDiceSetsPlayerTotal()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->playerRoll();

        $data = $game->getData();

        $this->assertTrue(is_int($data["playerTotal"]));
    }

    /**
     * Try to execute the playerRoll() method of class Game21
     * with graphical dice test that it sets playerRoll
     *
     */
    public function testPlayerRollGraphicalDiceSetsPlayerRoll()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $game->playerRoll();

        $data = $game->getData();

        $this->assertTrue(is_string($data["playerRoll"]));
    }

    /**
     * Try to execute the playerRoll() method of class Game21
     * with graphical dice test that it sets playerRollHistory
     *
     */
    public function testPlayerRollGraphicalDiceSetsPlayerRollHistory()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $game->playerRoll();

        $data = $game->getData();

        $this->assertTrue(is_string($data["playerRollHistory"]));
    }

    /**
     * Try to execute the playerRoll() method of class Game21
     * with graphical dice test that it sets sumPlayerRoll
     *
     */
    public function testPlayerRollGraphicalDiceSetsSumPlayerRoll()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $game->playerRoll();

        $data = $game->getData();

        $this->assertTrue(is_int($data["sumPlayerRoll"]));
    }

    /**
     * Try to execute the playerRoll() method of class Game21
     * with graphical dice test that it sets playerTotal
     *
     */
    public function testPlayerRollGraphicalDiceSetsPlayerTotal()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $game->playerRoll();

        $data = $game->getData();

        $this->assertTrue(is_int($data["playerTotal"]));
    }

    /**
     * Try to execute the playerRoll() method of class Game21
     * with graphical dice test that it sets playerRollGraphicRep
     *
     */
    public function testPlayerRollGraphicalDiceSetsPlayerRollGraphicRep()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $game->playerRoll();

        $data = $game->getData();

        $this->assertTrue(is_array($data["playerRollGraphicRep"]));
    }

    /**
     * Try to execute the playerRoll() method of class Game21
     * with graphical dice test that it sets playerRollGraphicHistory
     *
     */
    public function testPlayerRollGraphicalDiceSetsPlayerRollGraphicHistory()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "graphical", 5, 6);

        $game->playerRoll();

        $data = $game->getData();

        $this->assertTrue(is_array($data["playerRollGraphicHistory"]));
    }
}
