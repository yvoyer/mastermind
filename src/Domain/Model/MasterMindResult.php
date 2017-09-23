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
        $response = array_fill(0, count($this->hiddenTokens), Token::NULL);
        foreach ($this->hiddenTokens as $position => $hiddenToken) {
            if ($this->currentGuess[$position] === $hiddenToken) {
                $response[$position] = Token::BLACK;
            } else if (in_array($this->currentGuess[$position], $this->hiddenTokens)) {
                $response[$position] = Token::WHITE;
            }
        }

        return $response;
    }
}
