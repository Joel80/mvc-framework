<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Game21;

/**
 * Test cases for the Game21 class
 */

class GameResetScoreTest extends TestCase
{

    /**
     * Try to execute the resetScore method
     * test that it sets computerWins to zero
     */
    public function testresetScoreSetsComputerScore()
    {
        $game = new Game21();

        $game->resetScore();

        $data = $game->getData();

        $this->assertEquals($data["computerWins"], 0);
    }

      /**
     * Try to execute the resetScore method
     * test that it sets playerWins to zero
     */
    public function testresetScoreSetsPlayerScore()
    {
        $game = new Game21();

        $game->resetScore();

        $data = $game->getData();

        $this->assertEquals($data["playerWins"], 0);
    }
}
