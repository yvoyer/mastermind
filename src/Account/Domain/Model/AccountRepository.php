<?php declare(strict_types=1);

namespace Star\Mastermind\Account\Domain\Model;

interface AccountRepository
{
    public function saveAccount(AccountAggregate $account): void;
}
