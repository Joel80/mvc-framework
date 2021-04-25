<?php

declare(strict_types=1);

namespace App\Dice;

/**
 * Class Scorebox
 */
class Scorebox
{
    /**
     * @var ?int $score holds the score of the scorebox
     * @var bool $locked holds the lock status of the scorebox
     * @var string $nam holds the name of the scorebox
     */
    private ?int $score = null;
    private bool $locked = false;
    private string $name = "";

    /**
     * Constructor
     */
    public function __construct(string $name = "")
    {
        $this->name = $name;
    }

    /**
     * Sets the score of the scorebox
     * @param int|null $score
     * @return void
     */
    public function setScore(?int $score): void
    {
        $this->score = $score;
    }

    /**
     * Gets the score of the scorebox
     * @return ?int the score
     */
    public function getScore(): ?int
    {
        return $this->score;
    }

    /**
     * Set the lock status of the scorebox
     * @param bool $locked the lock status
     */
    public function setLocked(bool $locked): void
    {
        $this->locked = $locked;
    }

    /**
     * Gets the lock status of the scorebox
     * @return bool lock status
     */
    public function isLocked(): bool
    {
        return $this->locked;
    }

    /**
     * Sets the name of the scorebox
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Gets the name of the scorebox
     * @return string the name
     */
    public function getName(): string
    {
        return $this->name;
    }
}
