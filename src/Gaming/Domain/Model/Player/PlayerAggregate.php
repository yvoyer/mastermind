<?php

declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Player;

use Star\Mastermind\Gaming\Domain\Model\Game\GameAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;

final class PlayerAggregate
{
    public function __construct(
        private readonly PlayerId $id,
        private string $name,
    ) {
    }

    public function getIdentity(): PlayerId
    {
        return $this->id;
    }

    public function matchesName(string $name): bool
    {
        return $this->name === $name;
    }

    public function createGame(
        GameId $id,
    ): GameAggregate {
        return new GameAggregate(
            $id,
            $this->id,
        );
    }
}
