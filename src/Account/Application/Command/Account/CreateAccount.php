<?php declare(strict_types=1);

namespace Star\Mastermind\Account\Application\Command\Account;

use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;

final readonly class CreateAccount
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
}
