<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;

/**
 * Test cases for the Game21 class
 */

class GameCheckBustTest extends TestCase
{

    /**
     * Try to execute the checkBust method with
     * value over 21.
     *
     */
    public function testCheckBustWith22()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->checkBust(22);

        $data = $game->getData();

        $this->assertFalse(is_null($data["result"]));
    }

    /**
     * Try to execute the checkBust method with
     * value 21
     *
     */
    public function testCheckBustWith21()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->checkBust(21);

        $data = $game->getData();

        $this->assertTrue(is_null($data["result"]));
    }
}
