<?php declare(strict_types=1);

namespace Star\Mastermind\Account\Application\Command\Account;

use Star\Mastermind\Account\Domain\Model\AccountAggregate;
use Star\Mastermind\Account\Domain\Model\AccountRepository;

final readonly class CreateAccountHandler
{
    public function __construct(
        private AccountRepository $accounts,
    ) {
    }

    public function __invoke(CreateAccount $command): void
    {
        $this->accounts->saveAccount(
            AccountAggregate::createAccount(
                $command->accountId(),
                $command->createdAt(),
            ),
        );
    }
}
