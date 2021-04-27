<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;

/**
 * Test cases for the Game21 class
 */

class GameGetGameStateTest extends TestCase
{

    /**
     * Try to execute the method getGameState() test
     * that it returns a string.
     *
     */
    public function testGetGameState()
    {
        $game = new Game21();

        $data = $game->getGameState();

        $this->assertTrue(is_string($data));
    }
}
