<?php

// src/Dice/ThrowDice.php
namespace App\Dice;

/**
 * Class DiceThrower
 */
class DiceThrower
{
    private array $data = [];
    private DiceHand $hand;

    public function __construct(int $dice = 2)
    {
        $this->hand = new DiceHand();

        for ($i = 0; $i < $dice; $i++) {
            $this->hand->addDice(new GraphicalDice());
        }
    }

    public function roll(): array
    {
        $roll = $this->hand->roll();

        $sum = $this->hand->sumLastRoll();

        $graphicDice = $this->hand->getLastRollAsStrings();

        $this->data["roll"] = $roll;
        $this->data["sum"] = $sum;
        $this->data["graphicDice"] = $graphicDice;

        return $this->getData();
    }

    public function getData(): array
    {
        return $this->data;
    }
}
