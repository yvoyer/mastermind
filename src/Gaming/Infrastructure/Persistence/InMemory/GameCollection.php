<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Infrastructure\Persistence\InMemory;

use Star\Mastermind\Gaming\Domain\Model\Game\GameAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameRepository;

final class GameCollection implements GameRepository
{
    /**
     * @var array<string, GameAggregate>
     */
    private array $games = [];

    public function saveGame(GameAggregate $game): void
    {
        $this->games[$game->getIdentity()->toString()] = $game;
    }
}
