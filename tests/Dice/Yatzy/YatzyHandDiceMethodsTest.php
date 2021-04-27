<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Dice;
use App\Dice\GraphicalDice;
use App\Dice\YatzyHand;

/**
 * Test cases for the YatzyHand class
 */

class YatzyHandDiceMethodsTest extends TestCase
{

    /**
     * Try to execute method addDice()
     */
    public function testMethodAddDice()
    {
        $hand = new YatzyHand();

        $hand->addDice(new Dice());

        $hand->addDice(new GraphicalDice());

        $result = $hand->getDices();

        $expNrOfDice = 2;

        $nrOfDice = $hand->getNrOfDice();

        $lockedDice = $hand->getLockedDice();

        $this->assertFalse($lockedDice[0]);

        $this->assertFalse($lockedDice[1]);

        $this->assertInstanceOf("\App\Dice\Dice", $result[0]);

        $this->assertInstanceOf("\App\Dice\GraphicalDice", $result[1]);

        $this->assertEquals($expNrOfDice, $nrOfDice);
    }


    /**
     * Try to execute method getDices()
     */
    public function testMethodGetDices()
    {
        $hand = new YatzyHand();

        $res = $hand->getDices();

        $this->assertTrue(is_array($res));
    }

    /**
     * Try to execute method getSum()
     */
    public function testMethodGetSum()
    {
        $hand = new YatzyHand();

        $res = $hand->getSum();

        $exp = 0;

        $this->assertTrue(is_int($res));

        $this->assertEquals($res, $exp);
    }

    /**
     * Try to execute method getNrOfDice()
     */
    public function testMethodGetNrOfDice()
    {
        $hand = new YatzyHand();

        $hand->addDice(new Dice());

        $hand->addDice(new GraphicalDice());

        $res = $hand->getNrOfDice();

        $exp = 2;

        $this->assertEquals($exp, $res);
    }

    /**
     * Try to execute method initLockedDice()
     */
    public function testMethodInitLockedDice()
    {
        $hand = new YatzyHand();

        $hand->addDice(new Dice());

        $hand->lockDice(0);

        $resBefore = $hand->getLockedDice();

        $this->assertTrue($resBefore[0]);

        $hand->initLockedDice();

        $resAfter = $hand->getLockedDice();

        $this->assertFalse(($resAfter[0]));
    }

    /**
     * Try to execute method getLockedDice()
     */
    public function testMethodGetLockedDice()
    {
        $hand = new YatzyHand();

        $hand->addDice(new Dice());

        $res = $hand->getLockedDice();

        $this->assertTrue(is_array($res));

        $this->assertFalse(($res[0]));
    }


    /**
     * Try to execute method LockDice()
     */
    public function testMethodLockDice()
    {
        $hand = new YatzyHand();

        $hand->addDice(new Dice());

        $hand->addDice(new GraphicalDice());

        $result =  $hand->roll();

        $hand->lockDice(0);

        $expLocked = $result[0];

        $result2 = $hand->roll();

        $firstOfResult2 = $result2[0];

        $this->assertEquals($expLocked, $firstOfResult2);
    }

    /**
     * Try to execute method getDiceWithValue()
     */
    public function testMethodGetDiceWithValue()
    {
        $hand = new YatzyHand();

        $hand->addDice(new Dice(1));

        $roll = $hand->roll();

        $firstResultOfRoll = $roll[0];

        $getDiceWithValueOne = $hand->getDiceWithValue(1);

        $this->assertEquals($firstResultOfRoll, $getDiceWithValueOne[0]);
    }
}
