<?php

declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Game;

use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Common\Domain\Model\BaseAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\Event\GameWasCreated;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final class GameAggregate extends BaseAggregate
{
    private GameId $gameId;
    private PlayerId $ownerId;

    public function getIdentity(): GameId
    {
        return $this->gameId;
    }

    public function isOwnedBy(PlayerId $player): bool
    {
        return $this->ownerId->matches($player);
    }

    public static function newGame(
        GameId $id,
        PlayerId $ownerId,
        AppDateTime $createdAt,
        AccountId $accountId,
    ): self {
        return self::fromStream(
            new GameWasCreated(
                $id,
                $ownerId,
                $createdAt,
                $accountId,
            ),
        );
    }

    protected function onGameWasCreated(GameWasCreated $event): void
    {
        $this->gameId = $event->gameId();
        $this->ownerId = $event->ownerId();
    }
}
