<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Account\Application\Command\Account;

use PHPUnit\Framework\TestCase;
use Star\Mastermind\Account\Application\Command\Account\CreateAccount;
use Star\Mastermind\Account\Application\Command\Account\CreateAccountHandler;
use Star\Mastermind\Account\Domain\Model\AccountAggregate;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Account\Domain\Model\AccountRepository;
use Star\Mastermind\Common\Domain\Model\AppDateTime;

final class CreateAccountHandlerTest extends TestCase
{
    public function test_it_should_create_an_account(): void
    {
        $accounts = new class implements AccountRepository {
            public ?AccountAggregate $savedAccount = null;

            public function saveAccount(AccountAggregate $account): void
            {
                $this->savedAccount = $account;
            }
        };

        $handler = new CreateAccountHandler($accounts);
        $handler(new CreateAccount(
            $accountId = AccountId::randomUUID(),
            AppDateTime::fromNow(),
        ));

        self::assertNotNull($accounts->savedAccount);
        self::assertTrue($accounts->savedAccount->getIdentity()->matches($accountId));
    }
}
