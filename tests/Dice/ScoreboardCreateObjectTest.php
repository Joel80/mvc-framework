<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Scoreboard;
use App\Dice\Scorebox;

/**
 * Test cases for the Scorebox class
 */

class ScoreboardCreateObjectTest extends TestCase
{

    /**
     * Try to create an object of the class without arguments.
     */
    public function testCreateScoreboardObject()
    {
        $scoreboard = new Scoreboard();

        $this->assertInstanceOf("\App\Dice\Scoreboard", $scoreboard);

        $totalScore = $scoreboard->getTotalScore();

        $exp = 0;

        $this->assertEquals($totalScore, $exp);

        $scoreboxes = $scoreboard->getAllScoreBoxes();

        $this->assertTrue(is_array($scoreboxes));

        $this->assertTrue(empty($scoreboxes));

        $scoreboxNames = $scoreboard->getAllScoreBoxNames();

        $this->assertTrue(is_array($scoreboxNames));

        $this->assertTrue(empty($scoreboxNames));

        $scoreboxScores = $scoreboard->getAllScoreBoxScores();

        $this->assertTrue(is_array($scoreboxScores));

        $this->assertTrue(empty($scoreboxScores));
    }
}
