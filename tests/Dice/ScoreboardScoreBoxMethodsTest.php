<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Scoreboard;
use App\Dice\Scorebox;

/**
 * Test cases for the Scorebox class
 */

class ScoreboardScoreBoxMethodsTest extends TestCase
{
    /**
     * Try to execute the method addScorebox()
     */
    public function testMethodAddScorebox()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox());

        $scorebox = $scoreboard->getScorebox(0);

        $this->assertInstanceOf("\App\Dice\Scorebox", $scorebox);
    }

    /**
     * Try to execute the method getScorebox()
     */
    public function testMethodGetScorebox()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox());

        $scorebox = $scoreboard->getScorebox(0);

        $this->assertInstanceOf("\App\Dice\Scorebox", $scorebox);
    }

    /**
     * Try to execute the method getAllScorebox()
     */
    public function testMethodGetAllScoreboxes()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox());

        $scoreboxes = $scoreboard->getAllScoreboxes();

        $this->assertTrue(is_array($scoreboxes));

        $this->assertInstanceOf("\App\Dice\Scorebox", $scoreboxes[0]);
    }

    /**
     * Try to execute the method getAllScoreboxNames()
     */
    public function testMethodGetAllScoreboxNames()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox("One"));

        $scoreboxNames = $scoreboard->getAllScoreboxNames();

        $expName = "One";

        $actualName = $scoreboxNames[0];

        $this->assertTrue(is_array($scoreboxNames));

        $this->assertEquals($expName, $actualName);
    }

    /**
     * Try to execute the method getScoreboxName()
     */
    public function testMethodGetScoreboxName()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox("One"));

        $expName = "One";

        $actualName = $scoreboard->getScoreboxName(0);

        $this->assertTrue(is_string($actualName));

        $this->assertEquals($expName, $actualName);
    }

    /**
     * Try to execute the method lockScoreBox()
     */
    public function testMethodLockScoreBox()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox("One"));

        $scoreboard->lockScoreBox(0);

        $boxStatus = $scoreboard->scoreboxLocked(0);

        $expBoxStatus = true;

        $this->assertEquals($boxStatus, $expBoxStatus);
    }

    /**
     * Try to execute the method scoreBoxLocked()
     */
    public function testMethodScoreBoxLocked()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox("One"));

        $scoreboard->lockScoreBox(0);

        $boxStatus = $scoreboard->scoreboxLocked(0);

        $this->assertTrue($boxStatus);
    }

    /**
     * Try to execute the method unlockScoreBox()
     */
    public function testMethodUnlockScoreBox()
    {
        $scoreboard = new Scoreboard();

        $scoreboard->addScorebox(new Scorebox("One"));

        $scoreboard->lockScoreBox(0);

        $boxStatus = $scoreboard->scoreboxLocked(0);

        $this->assertTrue($boxStatus);

        $boxStatus = $scoreboard->unlockScorebox(0);

        $this->assertNull($boxStatus);
    }
}
