<?php

declare(strict_types=1);

namespace App\Dice;

/**
 * Class DiceHand
 */
class DiceHand
{
    /**
     * @var array $dices stores the dice
     * @var int $sum stores the sum of the roled dice
     */
    protected array $dices = [];
    protected ?int $sum = 0;
    protected ?int $nrOfDice = 0;
    protected array $result = [];
    protected array $history = [];
    protected array $resultAsStrings = [];
    protected array $historyAsStrings = [];

    public function addDice(DiceInterface $dice)
    {
        $this->nrOfDice++;
        $this->dices[] = $dice;
    }
    /**
     * Rolls the hand and adds the results to history
     * @return array $result An array with the rolled results
     */
    public function roll(): array
    {
        $len = $this->nrOfDice;

        for ($i = 0; $i < $len; $i++) {
            $this->dices[$i]->roll();
            $this->result[$i] = $this->dices[$i]->getLastRoll();
            $this->resultAsStrings[$i] = $this->dices[$i]->rollAsString();
            $this->history[] = $this->dices[$i]->getLastRoll();
            $this->historyAsStrings[] = $this->dices[$i]->rollAsString();
        }

        return $this->result;
    }

    /**
     * Returns an array with the DiceInterface objects
     * @return array $dices
     */
    public function getDices(): array
    {
        return $this->dices;
    }


    /**
     * Returns an array with last roll of the hand
     * @return array $result The result of the last roll
     */
    public function getLastRoll(): array
    {
        return $this->result;
    }

    /**
     * Returns an array with all rolls made by the hand
     * @return array $history all rolls made by the hand
     */
    public function getHistory(): array
    {
        return $this->history;
    }

    /**
     * Sums the last roll of the hand
     */
    public function sumLastRoll(): int
    {
        $len = $this->nrOfDice;
        $this->sum = 0;

        for ($i = 0; $i < $len; $i++) {
            $this->sum += $this->dices[$i]->getLastRoll();
        }

        return $this->sum;
    }

     /**
     * Returns an int holding the sum of the last roll of the hand
     * @return int $sum The sum of the last roll
     */
    public function getSum(): int
    {
        return $this->sum;
    }

    /**
     * Returns the  result of the last rolled hand
     *
     * @return array An array with last roll of the hand
     * as strings
     */
    public function getLastRollAsStrings(): array
    {
        return $this->resultAsStrings;
    }

    /**
     * Returns the  result of all rolled hands
     * as a comma separated string
     * @return array An array with all rolls of the hand
     * as strings
     */
    public function getHistoryStrings(): array
    {
        return $this->historyAsStrings;
    }

    /**
     * Get nr of dice
     * @return int the number of dice in this hand
     */
    public function getNrOfDice(): int
    {
        return $this->nrOfDice;
    }
}
