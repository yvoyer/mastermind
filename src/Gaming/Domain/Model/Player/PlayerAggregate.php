<?php

declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Player;

use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Common\Domain\Model\BaseAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Player\Event\PlayerWasRegistered;

final class PlayerAggregate extends BaseAggregate
{
    private PlayerId $id;
    private PlayerName $name;
    private AccountId $accountId;

    public function getIdentity(): PlayerId
    {
        return $this->id;
    }

    public function matchesName(string $name): bool
    {
        return $this->name->toString() === $name;
    }

    public function createGame(
        GameId $gameId,
        AppDateTime $createdAt,
    ): GameAggregate {
        return GameAggregate::newGame(
            $gameId,
            $this->id,
            $createdAt,
            $this->accountId,
        );
    }

    public static function registeredPlayer(
        PlayerId $playerId,
        PlayerName $name,
        AppDateTime $registeredAt,
        AccountId $accountId,
    ): self {
        return self::fromStream(
            new PlayerWasRegistered(
                $playerId,
                $name,
                $registeredAt,
                $accountId,
            ),
        );
    }

    protected function onPlayerWasRegistered(PlayerWasRegistered $event): void
    {
        $this->id = $event->playerId();
        $this->name = $event->name();
        $this->accountId = $event->accountId();
    }
}
