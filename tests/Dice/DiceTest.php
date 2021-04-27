<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Dice;

/**
 * Test cases for the Dice class
 */

class DiceTest extends TestCase
{

    /**
     * Try to create the class without arguments.
     */
    public function testCreateDiceObjectNoArguments()
    {
        $die = new Dice();

        $this->assertInstanceOf("\App\Dice\Dice", $die);

        $sides = $die->getSides();

        $exp = 6;

        $this->assertEquals($sides, $exp);
    }

     /**
     * Try to create the class with argument
     */
    public function testCreateDiceObjectWithArgument()
    {
        $die = new Dice(10);

        $this->assertInstanceOf("\App\Dice\Dice", $die);

        $sides = $die->getSides();

        $exp = 10;

        $this->assertEquals($sides, $exp);
    }


    /**
     * Try to execute method getSides()
     */
    public function testMethodGetSides()
    {
        $die = new Dice();

        $actual = $die->getSides();
        $exp = 6;

        $this->assertEquals($exp, $actual);
    }

    /**
     * Try to execute method roll()
     */
    public function testMethodRoll()
    {
        $die = new Dice();

        $res = $die->roll();

        $this->assertIsInt($res);
    }

    /**
     * Try to execute method getLastRoll() without rolling
     */
    public function testMethodGetLastRollWithoutRolling()
    {
        $die = new Dice();

        $res = $die->getLastRoll();

        $this->assertNull($res);
    }

    /**
     * Try to execute method getLastRoll()
     */
    public function testMethodGetLastRollWithRolling()
    {
        $die = new Dice();

        $die->roll();

        $res = $die->getLastRoll();

        $this->assertIsInt($res);
    }

    /**
     * Try to execute method rollAsString()
     */
    public function testMethodRollAsString()
    {
        $die = new Dice();

        $die->roll();

        $res = $die->rollAsString();

        $this->assertIsString($res);
    }
}
