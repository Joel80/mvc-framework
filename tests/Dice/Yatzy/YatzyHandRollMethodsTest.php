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

class YatzyHandRollMethodsTest extends TestCase
{
    /**
     * Try to execute method roll dice without locked dice()
     */
    public function testMethodRollWithOutLockedDice()
    {
        $hand = new YatzyHand();

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
     * Try to execute method roll dice with locked dice()
     */
    public function testMethodRollWithLockedDice()
    {
        $hand = new YatzyHand();

        $hand->addDice(new Dice());

        $hand->addDice(new GraphicalDice());

        $hand->roll();

        $result = $hand->getLastRoll();

        $hand->lockDice(0);

        $expLocked = $result[0];

        $result2 = $hand->roll();

        $firstOfResult2 = $result2[0];

        $this->assertEquals($expLocked, $firstOfResult2);

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
     * Try to execute method getLastRoll()
     */
    public function testMethodGetLastRoll()
    {
        $hand = new YatzyHand();

        $res = $hand->getLastRoll();

        $this->assertTrue(is_array($res));
    }

    /**
     * Try to execute method getHistory()
     */
    public function testMethodGetHistory()
    {
        $hand = new YatzyHand();

        $res = $hand->getHistory();

        $this->assertTrue(is_array($res));
    }


    /**
     * Try to execute method sumLastRoll()
     */
    public function testMethodSumLastRoll()
    {
        $hand = new YatzyHand();

        $hand->addDice(new Dice(1));

        $hand->roll();

        $hand->sumLastRoll();

        $res = $hand->getSum();

        $exp = 1;

        $this->assertEquals($res, $exp);
    }

    /**
     * Try to execute method getLastRollsAsStrings()
     */
    public function testMethodGetLastRollAsStrings()
    {
        $hand = new YatzyHand();

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
        $hand = new YatzyHand();

        $hand->addDice(new Dice());

        $hand->addDice(new GraphicalDice());

        $hand->roll();

        $res = $hand->getHistoryStrings();

        $this->assertTrue(is_array($res));

        $this->assertTrue(is_string($res[0]));

        $this->assertTrue(is_string($res[1]));
    }
}
