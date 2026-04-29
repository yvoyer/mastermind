<?php declare(strict_types=1);

namespace Star\Mastermind\Account\Domain\Model\Builder;

use Star\Mastermind\Account\Domain\Model\AccountAggregate;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;

final readonly class AccountBuilder
{
    private function __construct(
        private AccountAggregate $account,
    ) {
    }

    public function getAccount(
        bool $resetEvents = true,
    ): AccountAggregate {
        if ($resetEvents) {
            $this->account->uncommitedEvents();
        }

        return $this->account;
    }

    public static function newAccount(
        AccountId $accountId,
        AppDateTime $createdAt,
    ): self {
        return new self(
            AccountAggregate::createAccount(
                $accountId,
                $createdAt,
            ),
        );
    }

    public static function newAccountFixture(): self
    {
        return self::newAccount(
            AccountId::randomUUID(),
            AppDateTime::fromNow(),
        );
    }
}
