<?php

namespace Star\Mastermind\Domain\Model;

final class MasterMindResult {
    /**
     * @var int
     */
    private $maxTurns;

    /**
     * @var int
     */
    private $currentTurn;

    /**
     * @var array Collection of Token::COLORS
     */
    private $hiddenTokens = [];

    /**
     * @var array Collection of Token::COLORS
     */
    private $currentGuess = [];

    /**
     * @param int $maxTurns
     * @param int $currentTurn
     * @param array $hiddenTokens
     * @param array $currentGuess
     */
    public function __construct(
        $maxTurns,
        $currentTurn,
        array $hiddenTokens,
        array $currentGuess
    ) {
        $this->maxTurns = $maxTurns;
        $this->currentTurn = $currentTurn;
        $this->hiddenTokens = $hiddenTokens;
        $this->currentGuess = $currentGuess;
    }

    /**
     * @return bool
     */
    public function isWon() {
        return $this->hiddenTokens == $this->currentGuess;
    }

    /**
     * @return bool
     */
    public function isEnded() {
        return ($this->currentTurn >= $this->maxTurns) || $this->isWon();
    }

    /**
     * @return string[] List of token
     */
    public function responseTokens() {
        $attempt = $this->currentGuess;
        $hidden = $this->hiddenTokens;

        // handle blacks
        $blackResponse = [];
        foreach ($hidden as $position => $hiddenToken) {
            if ($attempt[$position] === $hiddenToken) {
                $blackResponse[$position] = Token::BLACK;
            }
        }

        $whiteResponse = [];
        foreach ($attempt as $position => $guess) {
            if (isset($blackResponse[$position])) {
                continue;
            }

            if (in_array($guess, $hidden)) {
                $whiteResponse[$guess] = Token::WHITE;
            }
        }

        return array_values(array_merge($whiteResponse, $blackResponse));
    }
}
