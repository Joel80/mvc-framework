<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Dice;
use App\Dice\GraphicalDice;
use App\Dice\DiceHand;

/**
 * Test cases for the DiceHand class
 */

class DiceHandMethodsTest extends TestCase
{
    /**
     * Try to execute method addDice()
     */
    public function testMethodAddDice()
    {
        $hand = new DiceHand();

        $hand->addDice(new Dice());

        $hand->addDice(new GraphicalDice());

        $result = $hand->getDices();

        $expNrOfDice = 2;

        $nrOfDice = $hand->getNrOfDice();

        $this->assertInstanceOf("\App\Dice\Dice", $result[0]);

        $this->assertInstanceOf("\App\Dice\GraphicalDice", $result[1]);

        $this->assertEquals($expNrOfDice, $nrOfDice);
    }

    /**
     * Try to execute method Roll()
     */
    public function testMethodRoll()
    {
        $hand = new DiceHand();

        $hand->addDice(new Dice());

        $hand->addDice(new GraphicalDice());

        $hand->roll();

        $result = $hand->getLastRoll();

        $this->assertTrue(is_array($result));

        $this->assertFalse(empty($result));

        $resultAsStrings = $hand->getLastRollAsStrings();

        $this->assertTrue(is_array($resultAsStrings));

        $this->assertFalse(empty($resultAsStrings));

        $history = $hand->getHistory();

        $this->assertTrue(is_array($history));

        $this->assertFalse(empty($history));

        $historyAsStrings = $hand->getHistoryStrings();

        $this->assertTrue(is_array($historyAsStrings));

        $this->assertFalse(empty($historyAsStrings));
    }

    /**
     * Try to execute method getDices()
     */
    public function testMethodGetDices()
    {
        $hand = new DiceHand();

        $res = $hand->getDices();

        $this->assertTrue(is_array($res));
    }

    /**
     * Try to execute method getLastRoll()
     */
    public function testMethodGetLastRoll()
    {
        $hand = new DiceHand();

        $res = $hand->getLastRoll();

        $this->assertTrue(is_array($res));
    }

    /**
     * Try to execute method getHistoryl()
     */
    public function testMethodGetHistory()
    {
        $hand = new DiceHand();

        $res = $hand->getHistory();

        $this->assertTrue(is_array($res));
    }


    /**
     * Try to execute method sumLastRoll()
     */
    public function testMethodSumLastRoll()
    {
        $hand = new DiceHand();

        $hand->addDice(new Dice(1));

        $hand->roll();

        $hand->sumLastRoll();

        $res = $hand->getSum();

        $exp = 1;

        $this->assertEquals($res, $exp);
    }

    /**
     * Try to execute method getSuml()
     */
    public function testMethodGetSum()
    {
        $hand = new DiceHand();

        $res = $hand->getSum();

        $exp = 0;

        $this->assertTrue(is_int($res));

        $this->assertEquals($res, $exp);
    }

    /**
     * Try to execute method getLastRollsAsStrings()
     */
    public function testMethodGetLastRollAsStrings()
    {
        $hand = new DiceHand();

        $hand->addDice(new Dice());

        $hand->addDice(new GraphicalDice());

        $hand->roll();

        $res = $hand->getLastRollAsStrings();

        $this->assertTrue(is_array($res));

        $this->assertTrue(is_string($res[0]));

        $this->assertTrue(is_string($res[1]));
    }

    /**
     * Try to execute method getHistoryStrings()
     */
    public function testMethodGetHistoryStrings()
    {
        $hand = new DiceHand();

        $hand->addDice(new Dice());

        $hand->addDice(new GraphicalDice());

        $hand->roll();

        $res = $hand->getHistoryStrings();

        $this->assertTrue(is_array($res));

        $this->assertTrue(is_string($res[0]));

        $this->assertTrue(is_string($res[1]));
    }

    /**
     * Try to execute method getNrOfDice()
     */
    public function testMethodGetNrOfDice()
    {
        $hand = new DiceHand();

        $hand->addDice(new Dice());

        $hand->addDice(new GraphicalDice());

        $res = $hand->getNrOfDice();

        $exp = 2;

        $this->assertEquals($exp, $res);
    }
}
