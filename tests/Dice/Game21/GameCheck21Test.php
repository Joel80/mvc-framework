<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;

/**
 * Test cases for the Game21 class
 */

class GameCheck21Test extends TestCase
{

    /**
     * Try to execute the check21 method with
     * the value 21.
     *
     */
    public function testCheck21With21()
    {
        $game = new Game21();

        $game->check21(21);

        $data = $game->getData();

        $this->assertFalse(is_null($data["twentyOne"]));
    }

    /**
     * Try to execute the check21 method with
     * a value that is not 21
     *
     */
    public function testCheck21WithOterValue()
    {
        $game = new Game21();

        $handOne = new DiceHand();

        $handTwo = new DiceHand();

        $game->setup($handOne, $handTwo, 1, "text", 5, 6);

        $game->check21(20);

        $data = $game->getData();

        $this->assertTrue(is_null($data["twentyOne"]));
    }
}
