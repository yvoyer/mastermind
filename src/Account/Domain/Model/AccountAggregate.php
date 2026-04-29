<?php declare(strict_types=1);

namespace Star\Mastermind\Account\Domain\Model;

use Star\Mastermind\Account\Domain\Model\Event\AccountWasCreated;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Common\Domain\Model\BaseAggregate;

final class AccountAggregate extends BaseAggregate
{
    private AccountId $accountId;

    public function getIdentity(): AccountId
    {
        return $this->accountId;
    }

    public static function createAccount(
        AccountId $accountId,
        AppDateTime $createdAt,
    ): self {
        return self::fromStream(
            new AccountWasCreated(
                $accountId,
                $createdAt,
            ),
        );
    }

    protected function onAccountWasCreated(AccountWasCreated $event): void
    {
        $this->accountId = $event->accountId();
    }
}
