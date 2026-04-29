<?php declare(strict_types=1);

namespace Star\Mastermind\Account\Domain\Model\Event;

use RuntimeException;
use Star\Component\DomainEvent\DomainEvent;
use Star\Component\DomainEvent\Serialization\Payload;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;

final readonly class AccountWasCreated implements AccountEvent
{
    public function __construct(
        private AccountId $accountId,
        private AppDateTime $createdAt,
    ) {
    }

    public function accountId(): AccountId
    {
        return $this->accountId;
    }

    public function createdAt(): AppDateTime
    {
        return $this->createdAt;
    }

    public static function fromPayload(Payload $payload): DomainEvent
    {
        throw new RuntimeException(__METHOD__ . ' is not implemented yet.');
    }
}
