<?php

declare(strict_types=1);

namespace Star\Mastermind\Tests\Gaming\Domain\Model\Game;

use PHPUnit\Framework\TestCase;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Domain\Model\Game\Builder\GameBuilder;
use Star\Mastermind\Gaming\Domain\Model\Game\Event\GameWasCreated;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final class GameAggregateTest extends TestCase
{
    public function test_it_should_require_a_player(): void
    {
        $game = GameBuilder::newGame(
            $id = GameId::randomUUID(),
            $owner = PlayerId::randomUUID(),
            AppDateTime::fromNow(),
            AccountId::randomUUID(),
        )->getGame(false);

        self::assertTrue($game->getIdentity()->matches($id));
        self::assertTrue($game->isOwnedBy($owner));
        $events = $game->uncommitedEvents();
        self::assertCount(1, $events);
        self::assertInstanceOf(GameWasCreated::class, $events[0]);
    }
}
