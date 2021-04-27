<?php

declare(strict_types=1);

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use App\Dice\GraphicalDice;

/**
 * Test cases for the Dice class
 */

class GraphicalDiceTest extends TestCase
{

    /**
     * Try to create the class without arguments.
     */
    public function testCreateGraphicalDiceObject()
    {
        $die = new GraphicalDice();

        $this->assertInstanceOf("\App\Dice\GraphicalDice", $die);

        $sides = $die->getSides();

        $exp = 6;

        $this->assertEquals($sides, $exp);
    }

     /**
     * Try to execute method roll()
     */
    public function testMethodRoll()
    {
        $die = new GraphicalDice();

        $res = $die->roll();

        $this->assertIsInt($res);
    }

    /**
     * Try to execute method getLastRoll() without rolling
     */
    public function testMethodGetLastRollWithoutRolling()
    {
        $die = new GraphicalDice();

        $res = $die->getLastRoll();

        $this->assertNull($res);
    }

    /**
     * Try to execute method getLastRoll()
     */
    public function testMethodGetLastRollWithRolling()
    {
        $die = new GraphicalDice();

        $die->roll();

        $res = $die->getLastRoll();

        $this->assertIsInt($res);
    }

    /**
     * Try to execute method rollAsString()
     */
    public function testMethodRollAsString()
    {
        $die = new GraphicalDice();

        $die->roll();

        $res = $die->rollAsString();

        $this->assertIsString($res);

        $this->assertStringStartsWith("dice-", $res);
    }
}
