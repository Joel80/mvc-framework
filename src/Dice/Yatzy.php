<?php

declare(strict_types=1);

namespace App\Dice;

use App\Dice\Dice;
use App\Dice\YatzyHand;
use App\Dice\Scoreboard;

/**
 * Class Yatzy
 */
class Yatzy
{
    /**
     * @var YatzyHand $playerHand the players hand
     * @var Scoreboard $scoreboard the scoreboard
     * @var int $rounds holds the number of the round
     * @var string $gamestate the state of the game
     * @var array $data holds the game data used to render the view
     * @var array $lockedDice keeps track of which dice are locked
     * @var array $lockedScores keeps track of which scores are locked
     * @var int $handSize the number of dice in the hand
     * @var int $totalScore holds the total score
     * @var int $bonus holds the value of the bonus
     *
     */
    private YatzyHand $playerHand;
    private Scoreboard $scoreboard;
    private int $rounds = 0;
    private string $gameState = "";
    private array $data = [];
    private array $lockedDice = [];
    private array $lockedScores = [];
    private int $handSize = 0;
    private int $totalScore = 0;
    private int $bonus = 0;

    /**
     * Constructor
     * @param Yatzyhand $playerHand the players hand
     * @param Scoreboard $scoreboard the scoreboard
     */
    public function __construct(YatzyHand $playerHand, Scoreboard $scoreboard)
    {
        //Set playerhand
        $this->playerHand = $playerHand;
        //Set scoreboard
        $this->scoreboard = $scoreboard;
        //Initialize the player hand array with locked dice all
        //get the lock status false
        $this->playerHand->initLockedDice();

        //Set the size of the hand
        $this->handSize = $this->playerHand->getNrOfDice();

        //Init the lockedScores array all scores are unlocked
        $len = count($this->scoreboard->getAllScoreBoxes());

        for ($i = 0; $i < $len; $i++) {
            $this->lockedScores[$i] = false;
        }

        //Init the lockedDice array - all dice are unlocked
        $this->lockedDice = $this->playerHand->getLockedDice();

        //Init data with the header
        $this->data = [
            "header" => "Yatzi"
        ];

        //Init gameState to playerTurn
        $this->gameState = "playerTurn";

        //Store game state in data for rendering
        $this->data["gameState"] = $this->gameState;

        //Set playerRoll in data to null for rendering
        $this->data["playerRoll"] = null;

        //Store the scorebox names in data for rendering
        $this->data["scoreboxNames"] = $this->scoreboard->getAllScoreboxNames();

        //Store the scorebox scores in data for rendering
        $this->data["scoreboxScores"] = $this->scoreboard->getAllScoreboxScores();

        //Store the round number in data for rendering
        $this->data["rounds"] = $this->rounds;

        //Store the lockedScores in data for rendering
        $this->data["lockedScores"] = $this->lockedScores;

        //Store the lockedDice in data for rendering
        $this->data["lockedDice"] = $this->lockedDice;

        //Store the handSize in data for rendering
        $this->data["handSize"] = $this->handSize;

        //Init the totalScore in data for rendering
        $this->data["totalScore"] = null;

        //Store this instance of yatzi in $_SESSION
        $_SESSION["yatzy"] = $this;
    }

    /**
     * Gets the data array
     * @return array data
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Gets the game state
     * @return string game state
     */
    public function getGameState(): string
    {
        return $this->gameState;
    }

    /**
     * Rolls the dice
     * @return void
     */
    public function playerRoll(): void
    {
        //Roll
        $this->playerHand->roll();

        //Store an array of string reps of the roll in data
        $this->data["playerRoll"] = $this->playerHand->getLastRollAsStrings();

        //Increase rounds
        $this->rounds++;

        //Store rounds in data for rendering
        $this->data["rounds"] = $this->rounds;

        //Start new round
        $this->newRound();
    }

    /**
     * Locks dice at certain positions
     * @param array $positions the positions to lock
     * @return void
     */
    public function lockDice(array $positions): void
    {
        //Reset all dice to unlocked
        $this->playerHand->initLockedDice();

        //(Re)set the lockedDice array
        $this->lockedDice = $this->playerHand->getLockedDice();

        //For each position to lock
        foreach ($positions as $position) {
            //Lock the die at the position
            $this->playerHand->lockDice($position);

            //Update the lockedDice array
            $this->lockedDice[$position] = true;
        }

        //Store the lockedDice array in data for rendering
        $this->data["lockedDice"] = $this->lockedDice;

        //Check if turn is over (all dice locked)
        if ($this->turnOver()) {
            //Set game state to scoring
            $this->gameState = "scoring";

            //Store game state in data for rendering
            $this->data["gameState"] = $this->gameState;
        }
    }

    /**
     * Setup for a new round
     * @return void
     */
    private function newRound(): void
    {
        //Check if the turn is over
        if ($this->turnOver()) {
            //Set gamestate to scoring
            $this->gameState = "scoring";

            //Store game state in data for rendering
            $this->data["gameState"] = $this->gameState;
        }

        //Reset locked dice
        $this->playerHand->initLockedDice();

        //Update the lockedDice array
        $this->lockedDice = $this->playerHand->getLockedDice();

        //Store the array lockedDice in data for rendering
        $this->data["lockedDice"] = $this->lockedDice;
    }

    /**
     * Checks if turn is over
     * @return bool true if turn is over else false
     */
    private function turnOver(): bool
    {
        //Check if all dice are locked
        $allDiceLocked = $this->allDiceLocked();

        //If there has been 3 rounds or all dice are locked
        if ($this->rounds >= 3 || $allDiceLocked) {
            //Prepare scoring
            $this->scoring();
            //Return
            return true;
        }

        //Return false
        return false;
    }

    /**
     * Checks if all dice are locked
     * @return bool true if all dice are locked else false
     */
    private function allDiceLocked(): bool
    {
        //Get the array with status of the dice
        $lockedDice = $this->playerHand->getLockedDice();

        //For each die
        foreach ($lockedDice as $locked) {
            //If it is not locked
            if (!$locked) {
                //Return false
                return false;
            }
        }
        //Return true
        return true;
    }

    /**
     * Prepares the scoring
     * @return void
     */
    private function scoring(): void
    {
        //Array to hold the scores for each result
        $scores = [];

        //Get all dice matching 1
        $ones = $this->playerHand->getDiceWithValue(1);
        //Sum the dice
        $sumOnes = $this->sumArray($ones);

        //Store the sum in $scores
        $scores[] =  $sumOnes;

        //Get all dice matching 2
        $twos = $this->playerHand->getDiceWithValue(2);
        //Sum the dice
        $sumTwos = $this->sumArray($twos);

        //Store the sum in $scores
        $scores[] =  $sumTwos;

        //Get all dice matching 3
        $threes = $this->playerHand->getDiceWithValue(3);
        //Sum the dice
        $sumThrees = $this->sumArray($threes);

        //Store the sum in $scores
        $scores[] =  $sumThrees;

        //Get all dice matching 4
        $fours = $this->playerHand->getDiceWithValue(4);
        //Sum the dice
        $sumFours = $this->sumArray($fours);

        //Store the sum in $scores
        $scores[] =  $sumFours;

        //Get all dice matching 5
        $fives = $this->playerHand->getDiceWithValue(5);
        //Sum the dice
        $sumFives = $this->sumArray($fives);

        //Store the sum in $scores
        $scores[] =  $sumFives;

        //Get all dice matching 6
        $sixes = $this->playerHand->getDiceWithValue(6);
        //Sum the dice
        $sumSixes = $this->sumArray($sixes);

        //Store the sum in $scores
        $scores[] =  $sumSixes;

        //Store the scores array in data for rendering
        $this->data["scores"] = $scores;

        //Loop through scoreboxes
        $len = count($this->scoreboard->getAllScoreBoxes());

        for ($i = 0; $i < $len; $i++) {
            $scorebox = $this->scoreboard->getScorebox($i);
            //If the scorebox is not locked
            if (!$scorebox->isLocked()) {
                //Set the scorebox to the score in the scores array
                $scorebox->setScore($scores[$i]);
            }
        }
        //Store the scores in data for rendering
        $this->data["scoreboxScores"] = $this->scoreboard->getAllScoreboxScores();
    }

    /**
     * Sums the values in an array
     * @param array $arrayToSum
     * @return int $sum of the values in the array
     */
    private function sumArray(array $arrayToSum): int
    {
        //Get the length of the array
        $len = count($arrayToSum);

        //Set sum to 0
        $sum = 0;

        //For the length of the array
        for ($i = 0; $i < $len; $i++) {
            //Increase sum with the value at i
            $sum += $arrayToSum[$i];
        }

        //Return sum
        return $sum;
    }
    /**
     * Locks a score
     * @param int|null $position of the scorebox in the scoreboard
     * @return void
     */
    public function lockScore(?int $position): void
    {

      /*   if ($position === null) {
            return;
        } */

        //Get the scorebox from the scoreboard
        $scorebox = $this->scoreboard->getScorebox($position);

        //Lock the scorebox
        $scorebox->setLocked(true);

        //Update the lockedScores array
        $this->lockedScores[$position] = true;

        //Store the lockedScores array in data for rendering
        $this->data["lockedScores"] = $this->lockedScores;

        //Start new turn
        $this->newTurn();
    }

    /**
     * Set up for new turn (a new set of rounds)
     * @return void
     */
    private function newTurn(): void
    {
        //Reset all unlocked scores to null
        $len = count($this->scoreboard->getAllScoreBoxes());

        for ($i = 0; $i < $len; $i++) {
            $scorebox = $this->scoreboard->getScorebox($i);
            if (!$scorebox->isLocked()) {
                $scorebox->setScore(null);
            }
        }

        //If all scoreboxes are locked (scored)
        if ($this->allScored()) {
            //End game
            $this->endGame();

            //Return
            return;
        }

        //Reset rounds to 0
        $this->rounds = 0;

        //Unlock all dice
        $this->playerHand->initLockedDice();
        $this->lockedDice = $this->playerHand->getLockedDice();

        //Store rounds in data for rendering
        $this->data["rounds"] = $this->rounds;

        //Store the scoreboxScores i data for rendering
        $this->data["scoreboxScores"] = $this->scoreboard->getAllScoreboxScores();

        //Reset player roll
        $this->data["playerRoll"] = null;

        //Set game state to plaryerTurn
        $this->gameState = "playerTurn";

        //Store gamestate in data for rendering
        $this->data["gameState"] = $this->gameState;
    }

    /**
     * End game calculates scoring and ends the game
     * @return void
     */
    private function endGame(): void
    {
        //Calculate the total score of the scoreboard
        $this->totalScore = $this->scoreboard->calculateTotalScore();

        //Calculate bonus
        $this->bonus = $this->calculateBonus($this->totalScore);

        //Add bonus to total score
        $this->totalScore += $this->bonus;

        //Store the total score in data for rendering
        $this->data["totalScore"] = $this->totalScore;

        //Store the bonus in data for rendering
        $this->data["bonus"] = $this->bonus;

        //Set game state to gameOver
        $this->gameState = "gameOver";

        //Store the game state in data for rendering
        $this->data["gameState"] = $this->gameState;
    }

    /**
     * Checks if all scores are scored
     * @return bool true if all scores are scored else false
     */
    public function allScored(): bool
    {
        //Get all scores
        $scores = $this->scoreboard->getAllScoreboxScores();

        //For each score
        foreach ($scores as $score) {
            //If score equals null
            if ($score === null) {
                //Return false
                return false;
            }
        }
        //Return true
        return true;
    }

    /**
     * Calculates bonus
     * @param int $score to see if bonus is achieved
     * @returns int $bonus
     */
    private function calculateBonus(int $score)
    {
        $bonus = 0;

        if ($score >= 63) {
            $bonus = 50;
        }

        return $bonus;
    }

    /**
     * Restarts game
     * @return void
     */
    /* public function newGame(): void
    {
        //Unset session variable "yatzy"
        unset($_SESSION["yatzy"]);
    } */
}
