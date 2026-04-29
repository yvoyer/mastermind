<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Player\Event;

use Star\Component\DomainEvent\DomainEvent;
use Star\Component\DomainEvent\Serialization\Payload;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerName;

final class PlayerWasRegistered implements PlayerDomainEvent
{
    public function __construct(
        private PlayerId $playerId,
        private PlayerName $name,
        private AppDateTime $occurredAt,
        private AccountId $accountId,
    ) {
    }

    public function playerId(): PlayerId
    {
        return $this->playerId;
    }

    public function name(): PlayerName
    {
        return $this->name;
    }

    public function occurredAt(): AppDateTime
    {
        return $this->occurredAt;
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
