<?php

declare(strict_types=1);

namespace App\Dice;

use App\Dice\Dice;
use App\Dice\GraphicalDice;
use App\Dice\DiceHand;
use App\Dice\GraphicalDiceHand;


/**
 * Class Game
 */
class Game21
{
    /**
     * @var string $gameState stores the state of the game
     * @var string $gameState stores the diceType
     * @var object $playerHand handle for the players hand
     * @var object $computerHand handle for the computers hand
     * @var int $playerTotal stores the total value of the players rolls
     * @var int $computerTotal stores the total value of the computers rolls
     * @var int $computerWins stores the number of wins for computer
     * @var int $playerWins stores the number of wins for player
     * @var int $computerBitCoin stores the number of bitcoins for computer
     * @var int $playerBitCoin stores the number of bitcoins for player
     * @var int $initComputerBitCoin stores the initial number of bitcoins for computer
     * @var int $initPlayerBitCoin stores the initial number of bitcoins for player
     * @var int $bet stores the amount of the current bet
     * @var int $maxBet stores the max amount that is possible to bet
     * @var array $data stores the data sent to the renderView function
     */
    private string $gameState = "";
    private string $diceType = "";
    private ?object $playerHand = null;
    private ?object $computerHand = null;
    private int $playerTotal = 0;
    private int $computerTotal = 0;
    private int $playerWins = 0;
    private int $computerWins = 0;
    private int $initComputerBitCoin = 0;
    private int $initPlayerBitCoin = 0;
    private int $computerBitCoin = 0;
    private int $playerBitCoin = 0;
    private int $bet =  0;
    private int $maxBet = 0;
    private array $data = [
        "header" => "Dice",
        "message" => "The dice game!",
    ];
    /**
     * Constructor
     * @param int $computerBitCoin the amount of bitcoins for computer
     * @param int $playerBitCoin the amount of bitcoins for player
     *
     */
    public function __construct(int $computerBitCoin = 100, int $playerBitCoin = 10)
    {
        //Set values for member variables
        $this->computerBitCoin = $computerBitCoin;
        $this->playerBitCoin = $playerBitCoin;
        $this->initComputerBitCoin = $computerBitCoin;
        $this->initPlayerBitCoin = $playerBitCoin;
        $this->maxBet = intval($this->playerBitCoin / 2);

        //Set values for member variable data
        $this->data["maxBet"] = $this->maxBet;
        $this->data["computerBitCoin"] = $this->computerBitCoin;
        $this->data["playerBitCoin"] = $this->playerBitCoin;

        //Store the game object in session
        $_SESSION["game"] = $this;

        //Set gamestate to setup
        $this->gameState = "setup";
    }

    public function getData(): array
    {
        $this->data["gameState"] = $this->getGameState();
        return $this->data;
    }

    public function getGameState(): string
    {
        return $this->gameState;
    }
/*
    public function setGameState(string $state): void
    {
        $this->gameState = $state;
    }
 */
    /**
     * Setup for the game
     * @param int $nrOfDice the number of dice used
     * @param string $diceType the type of dice
     * @param int $bet the amount bet
     * @param int $sides the number of sides on the dice
     *
     * @return void
     */
    public function setup(DiceHand $playerHand, DiceHand $computerHand, int $nrOfDice, string $diceType, int $bet, int $sides = null): void
    {
        //Set member variables
        $this->diceType = $diceType;
        $this->bet = $bet;
        $this->playerHand = $playerHand;
        $this->computerHand = $computerHand;

        //Check for dicetype and create corresponding type of hand
        if ($this->diceType === "text") {
            for ($i = 0; $i < $nrOfDice; $i++) {
                $this->playerHand->addDice(new Dice($sides));
                $this->computerHand->addDice(new Dice($sides));
            }
        } elseif ($this->diceType === "graphical") {
            for ($i = 0; $i < $nrOfDice; $i++) {
                $this->playerHand->addDice(new GraphicalDice());
                $this->computerHand->addDice(new GraphicalDice());
            }
        }

        //Set values four member variable data
        $this->data["playerRoll"] = null;
        $this->data["sumPlayerRoll"] = null;
        $this->data["playerTotal"] = null;
        $this->data["playerRollGraphicRep"] = null;
        $this->data["playerRollHistory"] = null;
        $this->data["playerRollGraphicHistory"] = null;

        $this->data["computerRoll"] = null;
        $this->data["sumComputerRoll"] = null;
        $this->data["computerTotal"] = null;
        $this->data["computerRollGraphicRep"] = null;
        $this->data["computerRollHistory"] = null;
        $this->data["computerRollGraphicHistory"] = null;
        $this->data["twentyOne"] = null;
        $this->data["result"] = null;

        //Set gameState to playerTurn
        $this->gameState = "playerTurn";
    }
    /**
     * Rolls the players hand
     * @return void
     */
    public function playerRoll(): void
    {
        //Roll
        $this->playerHand->roll();

        //Store a string rep of the roll in data
        $this->data["playerRoll"] = implode(", ", $this->playerHand->getLastRoll());

        //Store a string rep of all rolls in data
        $this->data["playerRollHistory"] = implode(", ", $this->playerHand->getHistory());

        //Sum the roll
        $this->playerHand->sumLastRoll();

        //Store the sum in data
        $this->data["sumPlayerRoll"] = $this->playerHand->getSum();

        //Increase the total rolled with the sum of the roll
        $this->playerTotal += $this->playerHand->getSum();

        //Store the total amount rolled in data
        $this->data["playerTotal"] = $this->playerTotal;

        //If using graphical dice store a representation of those in data
        if ($this->diceType === "graphical") {
            $this->data["playerRollGraphicRep"] = $this->playerHand->getLastRollAsStrings();
            $this->data["playerRollGraphicHistory"] = $this->playerHand->getHistoryStrings();
        }

        //Check if player has rolled 21
        $this->check21($this->playerTotal);

        //Check if player bust
        $this->checkBust($this->playerTotal);
    }

    /**
     * Check 21
     */
    public function check21(int $score)
    {
        if ($score === 21) {
            //Store a message in data
            $this->data["twentyOne"] = "Congratulations you got 21!";
        }
        return;
    }

    /**
     * Check bust
     */
    public function checkBust(int $score)
    {
        if ($score > 21) {
            //Set gameState to gameOver
            $this->gameState = "gameOver";
            //Store the result in data
            $this->data["result"] = "You bust - computer won!";
            //Increase computerWins
            $this->computerWins ++;
            //Decrease playerBitCoin with the current bet
            $this->playerBitCoin -= $this->bet;
            //Increase computerBitCoin with the current bet
            $this->computerBitCoin += $this->bet;
            //Store information in data
            $this->data["computerWins"] = $this->computerWins;
            $this->data["playerWins"] = $this->playerWins;
            $this->data["playerBitCoin"] = $this->playerBitCoin;
            $this->data["computerBitCoin"] = $this->computerBitCoin;

            //Check if someone broke
            $this->broke($this->computerBitCoin, $this->playerBitCoin);
        }
        return;
    }

    /**
     * Rolls for computer until computer wins or busts
     * @return void
     */
    public function computerRoll(): void
    {
        //Roll for computer until computer wins or busts
        while ($this->computerTotal < $this->playerTotal && $this->computerTotal <= 21) {
            //Roll
            $this->computerHand->roll();
            //Store a string rep of the roll in data
            //$this->data["computerRoll"] = $this->computerHand->getLastRoll();

            //Store a string rep of all rolls in data
            $this->data["computerRollHistory"] = implode(", ", $this->computerHand->getHistory());

            //Sum the roll
            $this->computerHand->sumLastRoll();

            //Store the sum in data
            //$this->data["sumComputerRoll"] = $this->computerHand->getSum();

            //Increase the total rolled with the sum of the roll
            $this->computerTotal += $this->computerHand->getSum();

            //Store the total amount rolled in data
            $this->data["computerTotal"] = $this->computerTotal;

            //If using graphical dice store a representation of those in data
            if ($this->diceType === "graphical") {
                $this->data["computerRollGraphicRep"] = $this->computerHand->getLastRollAsStrings();
                $this->data["computerRollGraphicHistory"] = $this->computerHand->getHistoryStrings();
            }

            //Set gameState to computerTurn
            $this->gameState = "computerTurn";
        }

        //Check if computer or player won and store result in data
        $this->checkWin($this->computerTotal, $this->playerTotal);

        /* if ($this->computerTotal <= 21 && $this->computerTotal >= $this->playerTotal) {
            $this->data["result"] = "Computer won!";
            $this->computerWins ++;
            $this->playerBitCoin -= $this->bet;
            $this->computerBitCoin += $this->bet;
        } else if ($this->computerTotal > 21 || $this->computerTotal < $this->playerTotal) {
            $this->data["result"] = "Player won!";
            $this->playerWins ++;
            $this->playerBitCoin += $this->bet;
            $this->computerBitCoin -= $this->bet;
        } */

        $this->data["computerWins"] = $this->computerWins;
        $this->data["playerWins"] = $this->playerWins;
        $this->data["playerBitCoin"] = $this->playerBitCoin;
        $this->data["computerBitCoin"] = $this->computerBitCoin;

        //Check if someone broke
        $this->broke($this->computerBitCoin, $this->playerBitCoin);

        //Set gameState to gameOver
        $this->gameState = "gameOver";
    }

    /**
     * Check who won
     * @param int $computerTotal - computer score
     * @param int $playerTotal - player score
     * @return void
     */
    public function checkWin(int $computerTotal, int $playerTotal): void
    {
        //Check if computer or player won and store result in data
        if ($computerTotal <= 21 && $computerTotal >= $playerTotal) {
            $this->data["result"] = "Computer won!";
            $this->computerWins ++;
            $this->playerBitCoin -= $this->bet;
            $this->computerBitCoin += $this->bet;
        } else if ($computerTotal > 21 || $computerTotal < $playerTotal) {
            $this->data["result"] = "Player won!";
            $this->playerWins ++;
            $this->playerBitCoin += $this->bet;
            $this->computerBitCoin -= $this->bet;
        }

        return;
    }

    /**
     * Sets the game up for a new round
     * @return void
     */
    public function playAgain(): void
    {
        //Reset member variables
        $this->gameState = "setup";
        $this->diceType = "";
        $this->playerHand = null;
        $this->computerHand = null;
        $this->playerTotal = 0;
        $this->computerTotal = 0;
        $this->maxBet = intval($this->playerBitCoin / 2);
        if ($this->playerBitCoin === 1) {
            $this->maxBet = 1;
        }
        $this->data = [
            "header" => "Dice",
            "message" => "The dice game!",
        ];

        $this->data["maxBet"] = $this->maxBet;
    }

    /**
     * Checks if someone broke
     * @param int $computerBitCoin
     * @param int $playerBitCoin
     * @return void
     */
    public function broke(int $computerBitCoin, int $playerBitCoin): void
    {
        //Set broke to null
        $this->data["broke"] = null;

        //Check if someones bitcoin is below 0 and set data
        if ($computerBitCoin <= 0) {
            $this->data["broke"] = "Computer broke - please reset bitcoins";
        } elseif ($playerBitCoin <= 0) {
            $this->data["broke"] = "Player broke - please reset bitcoins";
        }
    }

    /**
     * Resets the score (won rounds)
     * @return void
     */
    public function resetScore(): void
    {
        //Reset member variables
        $this->playerWins = 0;
        $this->computerWins = 0;
        $this->data["computerWins"] = $this->computerWins;
        $this->data["playerWins"] = $this->playerWins;
    }

    /**
     * Resets the bitcoins
     * @return void
     */
    public function resetBitCoins(): void
    {
        //Reset member variables
        $this->playerBitCoin = $this->initPlayerBitCoin;
        $this->computerBitCoin = $this->initComputerBitCoin;
        $this->data["computerBitCoin"] = $this->initComputerBitCoin;
        $this->data["playerBitCoin"] = $this->initPlayerBitCoin;
        $this->data["broke"] = null;
    }
}
