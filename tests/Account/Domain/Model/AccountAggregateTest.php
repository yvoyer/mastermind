<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Account\Domain\Model;

use PHPUnit\Framework\TestCase;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Account\Domain\Model\Builder\AccountBuilder;
use Star\Mastermind\Account\Domain\Model\Event\AccountWasCreated;
use Star\Mastermind\Common\Domain\Model\AppDateTime;

final class AccountAggregateTest extends TestCase
{
    public function test_it_should_be_identified_by_account_id(): void
    {
        $account = AccountBuilder::newAccount(
            $accountId = AccountId::randomUUID(),
            AppDateTime::fromNow(),
        )->getAccount();

        self::assertTrue($account->getIdentity()->matches($accountId));
    }

    public function test_it_should_record_account_was_created_event(): void
    {
        $account = AccountBuilder::newAccount(
            $accountId = AccountId::randomUUID(),
            AppDateTime::fromNow(),
        )->getAccount(false);

        self::assertCount(1, $events = $account->uncommitedEvents());
        $event = $events[0];
        self::assertInstanceOf(AccountWasCreated::class, $event);
        self::assertTrue($event->accountId()->matches($accountId));
    }
}
