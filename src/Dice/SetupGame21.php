<?php

namespace App\Dice;

class SetupGame21
{
    private int $nrOfDice;
    private string $diceType;
    private int $bet;

    public function setNrOfDice(int $nrOfDice)
    {
        $this->nrOfDice = $nrOfDice;
    }

    public function setBet(int $bet)
    {
        $this->bet = $bet;
    }

    public function setDiceType(string $diceType)
    {
        $this->diceType = $diceType;
    }

    public function getNrOfDice()
    {
        return $this->nrOfDice;
    }

    public function getBet()
    {
        return $this->bet;
    }

    public function getDiceType()
    {
        return $this->diceType;
    }
}