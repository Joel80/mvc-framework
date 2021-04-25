<?php

declare(strict_types=1);

namespace App\Dice;

/**
 * Class YatzyHand
 */
class YatzyHand extends DiceHand
{
    /**
     * @var array $lockedDice holds the lock status of the
     * locked dice in the hand
     */
    private array $lockedDice = [];

    public function addDice(DiceInterface $dice)
    {
        $this->nrOfDice++;
        $this->dices[] = $dice;

        $this->initLockedDice();
    }

    /**
     * Sets the lock status of all dice to false
     * @return void
     */
    public function initLockedDice(): void
    {
        $len = $this->nrOfDice;

        for ($i = 0; $i < $len; $i++) {
            $this->lockedDice[$i] = false;
        }
    }

    /**
     * Gets an array with the lock status of all dice
     * @return array
     */
    public function getLockedDice(): array
    {
        return $this->lockedDice;
    }

    /**
     * Locks a die in a certain position
     * @param int $position of the die to lock
     * @return void
     */
    public function lockDice(int $position): void
    {
        $this->lockedDice[$position] = true;
    }

    /**
     * Rolls unlocked dice in the hand and adds the results to history
     * @return array $result An array with the rolled results
     */
    public function roll(): array
    {
        $len = $this->nrOfDice;

        for ($i = 0; $i < $len; $i++) {
            if (!$this->lockedDice[$i]) {
                $this->dices[$i]->roll();
                $this->result[$i] = $this->dices[$i]->getLastRoll();
                $this->resultAsStrings[$i] = $this->dices[$i]->rollAsString();
                $this->history[] = $this->dices[$i]->getLastRoll();
                $this->historyAsStrings[] = $this->dices[$i]->rollAsString();
            }
        }

        return $this->result;
    }

    /**
     * Gets all dice with a certain value in hand
     * @param int $value the value to look for
     * @return array $dice
     *
     * */
    public function getDiceWithValue(int $value): array
    {
        $len = $this->nrOfDice;

        $dice = [];

        for ($i = 0; $i < $len; $i++) {
            if ($this->result[$i] === $value) {
                $dice[] = $this->result[$i];
            }
        }

        return $dice;
    }
}
