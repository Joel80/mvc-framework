<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;

/**
 * Test cases for the Game21 class
 */

class GameCreateObjectTest extends TestCase
{
    /**
     * Try to create the object of the class without arguments.
     *
     */
    public function testCreateGameObjectNoArguments()
    {
        $game = new Game21();

        $this->assertInstanceOf("\App\Dice\Game21", $game);

        $expData = array("header" => "Dice", "message" => "The dice game!", "maxBet" => 5, "computerBitCoin" => 100, "playerBitCoin" => 10, "gameState" => 'setup');

        $data = $game->getData();

        $this->assertEquals($expData, $data);
    }

    /**
     * Try to create the object of the class with one argument.
     * @runInSeparateProcess
     */
    public function testCreateGameObjectOneArgument()
    {
        $game = new Game21(50);

        $this->assertInstanceOf("\App\Dice\Game21", $game);

        $expData = array("header" => "Dice", "message" => "The dice game!", "maxBet" => 5, "computerBitCoin" => 50, "playerBitCoin" => 10, "gameState" => 'setup');

        $data = $game->getData();

        $this->assertEquals($expData, $data);
    }

    /**
     * Try to create the object of the class with both arguments.
     * @runInSeparateProcess
     */
    public function testCreateGameObjectBothArguments()
    {
        $game = new Game21(50, 5);

        $this->assertInstanceOf("\App\Dice\Game21", $game);

        $expData = array("header" => "Dice", "message" => "The dice game!", "maxBet" => 2, "computerBitCoin" => 50, "playerBitCoin" => 5, "gameState" => 'setup');

        $data = $game->getData();

        $this->assertEquals($expData, $data);
    }
}
