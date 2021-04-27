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

class DiceHandCreateObjectTest extends TestCase
{

    /**
     * Try to create the object
     */
    public function testCreateDiceHandObject()
    {
        $hand = new DiceHand();

        $this->assertInstanceOf("\App\Dice\DiceHand", $hand);

        $nrOfDice = $hand->getNrOfDice();

        $expNrOfDice = 0;

        $this->assertEquals($nrOfDice, $expNrOfDice);

        $dices = $hand->getDices();

        $this->assertEmpty($dices);

        $sum = $hand->getSum();

        $expSum = 0;

        $this->assertEquals($sum, $expSum);

        $result = $hand->getLastRoll();

        $this->assertEmpty($result);

        $history = $hand->getHistory();

        $this->assertEmpty($history);

        $rollAsStrings = $hand->getLastRollAsStrings();

        $this->assertEmpty($rollAsStrings);

        $historyStrings = $hand->getHistoryStrings();

        $this->assertEmpty($historyStrings);
    }
}
