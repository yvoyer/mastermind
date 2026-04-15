<?php

declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Game;

use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final readonly class GameAggregate
{
    public function __construct(
        private GameId $id,
        private PlayerId $owner,
    ) {
    }

    public function getIdentity(): GameId
    {
        return $this->id;
    }

    public function isOwnedBy(PlayerId $player): bool
    {
        return $this->owner->matches($player);
    }
}
