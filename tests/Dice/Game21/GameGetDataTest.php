<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;

/**
 * Test cases for the Game21 class
 */

class GameGetDataTest extends TestCase
{

    /**
     * Test that getData method returns array.
     *
     */
    public function testGameGetData()
    {
        $game = new Game21();

        $data = $game->getData();

        $this->assertTrue(is_array($data));
    }
}
