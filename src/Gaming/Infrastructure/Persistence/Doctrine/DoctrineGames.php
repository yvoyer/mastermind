<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Infrastructure\Persistence\Doctrine;

use BadMethodCallException;
use Star\Mastermind\Gaming\Domain\Model\Game\GameAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameRepository;

final class DoctrineGames implements GameRepository
{
    public function saveGame(GameAggregate $game): void
    {
        throw new BadMethodCallException('Doctrine game persistence is not implemented yet.');
    }
}
