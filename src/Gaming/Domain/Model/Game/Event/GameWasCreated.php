<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Game\Event;

use Star\Component\DomainEvent\DomainEvent;
use Star\Component\DomainEvent\Serialization\Payload;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final readonly class GameWasCreated implements GameEvent
{
    public function __construct(
        private GameId $gameId,
        private PlayerId $ownerId,
        private AppDateTime $occurredAt,
        private AccountId $accountId,
    ) {
    }

    public function gameId(): GameId
    {
        return $this->gameId;
    }

    public function occurredAt(): AppDateTime
    {
        return $this->occurredAt;
    }

    public function ownerId(): PlayerId
    {
        return $this->ownerId;
    }

    public function accountId(): AccountId
    {
        return $this->accountId;
    }

    public static function fromPayload(Payload $payload): DomainEvent
    {
        throw new \RuntimeException(__METHOD__ . ' is not implemented yet.');
    }
}
