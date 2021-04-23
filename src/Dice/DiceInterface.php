<?php

declare(strict_types=1);

namespace App\Dice;

/* use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};
 */
/**
 * Interface Dice
 */
interface DiceInterface
{


    /**
     * Rolls the die
     *
     * @return int the rolled number
     */

    public function roll();

    /**
     * Gets the value of $roll (last roll)
     * @return int
     */
    public function getLastRoll();

    /**
     * Gets the last roll as a string
     * @return string
     */
    public function rollAsString();
}
