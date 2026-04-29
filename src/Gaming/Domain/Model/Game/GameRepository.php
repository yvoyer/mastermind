<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Game;

interface GameRepository
{
    /**
     * @throws GameNotFound
     */
    public function getGameWithId(GameId $gameId): GameAggregate;

    public function saveGame(GameAggregate $game): void;
}
