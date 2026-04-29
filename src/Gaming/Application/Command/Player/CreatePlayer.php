<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Application\Command\Player;

use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final readonly class CreatePlayer
{
    public function __construct(
        private PlayerId $playerId,
        private string $name,
        private AppDateTime $registeredAt,
        private AccountId $accountId,
    ) {
    }

    public function playerId(): PlayerId
    {
        return $this->playerId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function registeredAt(): AppDateTime
    {
        return $this->registeredAt;
    }

    public function accountId(): AccountId
    {
        return $this->accountId;
    }
}
