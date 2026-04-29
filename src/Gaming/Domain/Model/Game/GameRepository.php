<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Game;

interface GameRepository
{
    public function saveGame(GameAggregate $game): void;
}
