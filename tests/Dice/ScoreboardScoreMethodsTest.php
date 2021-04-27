<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Scoreboard;
use App\Dice\Scorebox;

/**
 * Test cases for the Scorebox class
 */

class ScoreboardScoreMethodsTest extends TestCase
{
    /**
     * Try to execute the method setScore()
     */
    public function testMethodSetScore()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox("One"));

        $scoreboard->setScore(0, 1);

        $expScore = 1;

        $score =  $scoreboard->getScoreboxScore(0);

        $this->assertEquals($score, $expScore);
    }

    /**
     * Try to execute the method getScore()
     */
    public function testMethodGetScore()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox("One"));

        $scoreboard->setScore(0, 1);

        $expScore = 1;

        $score =  $scoreboard->getScoreboxScore(0);

        $this->assertEquals($score, $expScore);
    }

    /**
     * Try to execute the method calculateTotalScore()
     */
    public function testMethodCalculateTotalScore()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox("One"));

        $scoreboard->setScore(0, 1);

        $expScore = 1;

        $totalScore =  $scoreboard->calculateTotalScore(0);

        $this->assertEquals($totalScore, $expScore);
    }

     /**
     * Try to execute the method getTotalScore()
     */
    public function testMethodGetTotalScore()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox("One"));

        $scoreboard->setScore(0, 1);

        $expScore = 1;

        $scoreboard->calculateTotalScore(0);

        $totalScore = $scoreboard->getTotalScore();

        $this->assertTrue(is_int($totalScore));

        $this->assertEquals($totalScore, $expScore);
    }
}
