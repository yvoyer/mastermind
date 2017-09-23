<?php

namespace Star\Mastermind\Domain\Model;

interface PrintsGame
{
    /**
     * @param int $maxTurn
     * @param int $tokenNumber
     * @param array $guessHistory
     * @param array $answers
     */
    public function printActiveGame($maxTurn, $tokenNumber, array $guessHistory, array $answers);

    /**
     * @param int $currentTurn
     * @param array $hidden
     */
    public function printEndedGame($currentTurn, array $hidden);
}
