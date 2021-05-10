<?php

declare(strict_types=1);

namespace App\Dice;

/**
 * Class Scoreboard
 */
class Scoreboard
{
    /**
     * @var ?int $totalScore holds the total score of scoreboard
     * @var array $scoreboxes holds the scoreboxes of the scoreboard
     * @var array $scoreboxeNames holds the scorebox names of the scoreboard
     * @var array $scoreboxeScores holds the scorebox scores of the scoreboard
     *
     */
    private ?int $totalScore = 0;
    private array $scoreboxes = [];
    private array $scoreboxNames = [];
    private array $scoreboxScores = [];

    /**
     * Adds a new scorebox to the scoreboard
     * @param Scorebox $scorebox the scorebox to add
     * @return void
     */
    public function addScorebox(Scorebox $scorebox): void
    {
        $this->scoreboxes[] = $scorebox;
    }

    /**
     * Gets a scorebox from the scoreboxes array
     * @param int $position the position of the scorebox in the scoreboxes array
     * @return Scorebox the scorebox at $position
     */
    public function getScorebox(int $position): Scorebox
    {
        return $this->scoreboxes[$position];
    }

    /**
     * Gets all scoreboxes in the scoreboard
     * @return array with the scoreboxes
     */
    public function getAllScoreboxes(): array
    {
        return $this->scoreboxes;
    }

    /**
     * Gets an array with all scorebox names
     * @return array with all scorebox names
     */
    public function getAllScoreboxNames(): array
    {
        $len = count($this->scoreboxes) - 1;

        for ($i = 0; $i <= $len; $i++) {
            $this->scoreboxNames[$i] = $this->scoreboxes[$i]->getName();
        }

        return $this->scoreboxNames;
    }

     /**
     * Gets the name of a scorebox at a certain position in the scoreboard
     * @return string the name of a scorebox at a certain position in the scoreboard
     */
    public function getScoreboxName($position): string
    {
        return $this->scoreboxes[$position]->getName();
    }

    /**
     * Gets an array with all scorebox scores
     * @return array with all scorebox scores
     */
    public function getAllScoreboxScores(): array
    {
        $len = count($this->scoreboxes) - 1;

        for ($i = 0; $i <= $len; $i++) {
            $this->scoreboxScores[$i] = $this->scoreboxes[$i]->getScore();
        }

        return $this->scoreboxScores;
    }

     /**
     * Gets the score me of a scorebox at a certain position in the scoreboxes array
     * @return int|null the score of a scorebox at a certain position in the scoreboxes array
     */
    public function getScoreboxScore(int $position): ?int
    {
        return $this->scoreboxes[$position]->getScore();
    }

    /**
     * Gets the status of a scorebox at a certain position in the scoreboxes array
     * if it is locked or not
     * @return bool lock status of scorebox
     */
    public function scoreboxLocked(int $position): bool
    {
        return $this->scoreboxes[$position]->isLocked();
    }

    /**
     * Sets the score of a scorebox at a certain position
     * in the scoreboard
     * @param int $position of the scorebox in the scoreboxes array
     * @return void
     */
    public function setScore(int $position, int $score): void
    {

        $this->scoreboxes[$position]->setScore($score);
    }

    /**
     * Sets the lock status of a scorebox at a certain position
     * in the scorebox array to true
     * @param int $position of the scorebox in the scoreboxes array
     * @return void
     */
    public function lockScoreBox(int $position): void
    {

        $this->scoreboxes[$position]->setLocked(true);
    }

    /**
     * Sets the lock status of a scorebox at a certain position
     * in the scorebox array to false
     * @param int $position of the scorebox in the scoreboxes array
     * @return void
     */
    public function unlockScoreBox(int $position): void
    {

        $this->scoreboxes[$position]->setLocked(false);
    }

    /**
     * Calculates the total score of all scoreboxes in the scoreboxes array
     * @return int with the total score
     */
    public function calculateTotalScore(): int
    {

        $len = count($this->scoreboxes) - 1;
        $this->totalScore = 0;

        for ($i = 0; $i <= $len; $i++) {
            $this->totalScore += $this->scoreboxes[$i]->getScore();
        }

        return $this->totalScore;
    }

    /**
     * Gets the total score of this scoreboard
     * @return int|null the total score of the scoreboard
     */

    public function getTotalScore(): ?int
    {
        return $this->totalScore;
    }
}
