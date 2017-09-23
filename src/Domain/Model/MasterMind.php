<?php

namespace Star\Mastermind\Domain\Model;

use Star\Component\State\Builder\StateBuilder;
use Star\Component\State\StateContext;
use Star\Component\State\StateMachine;

class MasterMind implements StateContext {
    /**
     * @var array Collection of Token::COLORS.
     */
    private $hidden;

    /**
     * @var array Collection of user guesses.
     */
    private $history = [];

    /**
     * @var array Collection of answers based on guesses.
     */
    private $answers = [];

    /**
     * @var int
     */
    private $tokenNumber;

    /**
     * @var int
     */
    private $maxTurns;

    /**
     * @var MasterMindResult|null
     */
    private $lastResult;

    /**
     * @var string
     */
    private $state = 'pending';

    /**
     * @param int $tokenNumber
     * @param int $maxTurns
     */
    public function __construct($tokenNumber, $maxTurns)
    {
        $this->tokenNumber = $tokenNumber;
        $this->maxTurns = $maxTurns;
    }

    /**
     * @param array $hidden
     */
    public function start(array $hidden)
    {
        $this->assertTokensAreAllSupported('Hidden tokens', $hidden);
        $this->state = $this->state()->transitContext('start', $this);

        $this->hidden = $hidden;
    }

    /**
     * @param array $guess
     *
     * @return MasterMindResult
     */
    public function makeChoices(array $guess)
    {
        if (! $this->isStarted()) {
            throw new \LogicException("Cannot make guesses when game not started.");
        }

        if (count($guess) != $this->tokenNumber) {
            throw new \LogicException(
                sprintf(
                   "Guesses must contains exactly %d colors, %d given.",
                   $this->tokenNumber,
                   count($guess)
                )
            );
        }

        $this->assertTokensAreAllSupported('Guess', $guess);

        $this->history[] = $guess;
        if ($this->currentTurn() > $this->maxTurns) {
            throw new \LogicException('Maximum allowed number of guesses exceeded.');
        }

        $this->lastResult = new MasterMindResult(
            $this->maxTurns,
            $this->currentTurn(),
            $this->hidden,
            $guess
        );
        $this->answers[] = $this->lastResult->responseTokens();

        if ($this->lastResult->isEnded()) {
            $this->state = $this->state()->transitContext('end', $this);
        }

        return $this->lastResult;
    }

    /**
     * @param PrintsGame $printer
     */
    public function printGame(PrintsGame $printer)
    {
        $printer->printActiveGame(
            $this->maxTurns,
            $this->tokenNumber,
            $this->history,
            $this->answers
        );

        if ($this->isEnded()) {
            $printer->printEndedGame($this->currentTurn(), $this->hidden);
        }
    }

    /**
     * @return bool
     */
    private function isStarted()
    {
        return $this->state()->hasAttribute('is_started');
    }

    /**
     *
     * @return bool
     */
    private function isEnded()
    {
        return $this->state()->hasAttribute('is_ended');
    }

    /**
     * @param string $type
     * @param array $tokens
     */
    private function assertTokensAreAllSupported($type, array $tokens)
    {
        $supported = Token::all();
        foreach ($tokens as $token) {
            if (false === array_search($token, $supported)) {
                throw new \InvalidArgumentException($type . " must contains supported colors, '{$token}' given.");
            }
        }
    }

    /**
     *
     * @return int
     */
    private function currentTurn()
    {
        return count($this->history);
    }

    /**
     * @return StateMachine
     */
    private function state()
    {
        return StateBuilder::build()
            ->allowTransition('end', 'started', 'ended')
            ->allowTransition('start', 'pending', 'started')
            ->addAttribute('is_started', 'started')
            ->addAttribute('is_ended', 'ended')
            ->create($this->state);
    }
}

