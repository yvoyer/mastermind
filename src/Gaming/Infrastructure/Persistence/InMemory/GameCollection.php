<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Infrastructure\Persistence\InMemory;

use Countable;
use Star\Mastermind\Gaming\Domain\Model\Game\GameAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Game\GameNotFound;
use Star\Mastermind\Gaming\Domain\Model\Game\GameRepository;
use function array_key_exists;

final class GameCollection implements GameRepository, Countable
{
    /**
     * @var array<string, GameAggregate>
     */
    private array $games = [];

    public function getGameWithId(GameId $gameId): GameAggregate
    {
        if (!array_key_exists($gameId->toString(), $this->games)) {
            throw new GameNotFound($gameId);
        }

        return $this->games[$gameId->toString()];
    }

    public function saveGame(GameAggregate $game): void
    {
        $this->games[$game->getIdentity()->toString()] = $game;
    }

    public function count(): int
    {
        return count($this->games);
    }
}
