<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Scorebox;

/**
 * Test cases for the Scorebox class
 */

class ScoreboxTest extends TestCase
{

    /**
     * Try to create an object of the class without arguments.
     */
    public function testCreateScoreboxObject()
    {
        $scorebox = new Scorebox();

        $this->assertInstanceOf("\App\Dice\Scorebox", $scorebox);

        $name = $scorebox->getName();

        $expName = "";

        $this->assertEquals($name, $expName);

        $locked = $scorebox->isLocked();

        $expLocked = false;

        $this->assertEquals($locked, $expLocked);

        $score = $scorebox->getScore();

        $expScore = null;

        $this->assertEquals($score, $expScore);
    }

    /**
     * Try to execute the method setScore()
     */
    public function testMethodSetScore()
    {
        $scorebox = new Scorebox();

        $scorebox->setScore(1);

        $score = $scorebox->getScore();

        $expScore = 1;

        $this->assertEquals($score, $expScore);
    }

    /**
     * Try to execute the method getScore()
     */
    public function testMethodGetScore()
    {
        $scorebox = new Scorebox();

        $scorebox->setScore(1);

        $score = $scorebox->getScore();

        $expScore = 1;

        $this->assertEquals($score, $expScore);
    }

    /**
     * Try to execute the method setLocked()
     */
    public function testMethodSetLocked()
    {
        $scorebox = new Scorebox();

        $scorebox->setLocked(true);

        $status = $scorebox->isLocked();

        $expStatus = true;

        $this->assertEquals($status, $expStatus);
    }


    /**
     * Try to execute the method isLocked()
     */
    public function testMethodIsLocked()
    {
        $scorebox = new Scorebox();

        $scorebox->setLocked(true);

        $status = $scorebox->isLocked();

        $expStatus = true;

        $this->assertEquals($status, $expStatus);
    }

    /**
     * Try to execute the method setName()
     */
    public function testMethodSetName()
    {
        $scorebox = new Scorebox();

        $scorebox->setName("One");

        $name = $scorebox->getName();

        $expName = "One";

        $this->assertEquals($name, $expName);
    }

    /**
     * Try to execute the method getName()
     */
    public function testMethodGetName()
    {
        $scorebox = new Scorebox();

        $scorebox->setName("One");

        $name = $scorebox->getName();

        $expName = "One";

        $this->assertEquals($name, $expName);
    }
}
