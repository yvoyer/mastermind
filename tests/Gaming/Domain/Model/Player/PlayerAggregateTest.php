<?php

declare(strict_types=1);

namespace Star\Mastermind\Tests\Gaming\Domain\Model\Player;

use PHPUnit\Framework\TestCase;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Player\Builder\PlayerBuilder;
use Star\Mastermind\Gaming\Domain\Model\Player\Event\PlayerWasRegistered;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final class PlayerAggregateTest extends TestCase
{
    public function test_it_should_have_a_name(): void
    {
        $player = PlayerBuilder::newPlayer(
            $playerId = PlayerId::randomUUID(),
            'John Doe',
        )->getPlayer();

        self::assertTrue($player->getIdentity()->matches($playerId));
        self::assertTrue($player->matchesName('John Doe'));
        self::assertFalse($player->matchesName('Jane Doe'));
    }

    public function test_it_should_record_registered_player_event_content(): void
    {
        $playerId = PlayerId::randomUUID();
        $registeredAt = AppDateTime::fromString('2026-04-28 12:34:56');
        $accountId = AccountId::randomUUID();

        $player = PlayerBuilder::newPlayer(
            $playerId,
            'John Doe',
            $registeredAt,
            $accountId,
        )->getPlayer();

        self::assertCount(1, $events = $player->uncommitedEvents());
        $event = $events[0];
        self::assertInstanceOf(PlayerWasRegistered::class, $event);
        self::assertTrue($event->playerId()->matches($playerId));
        self::assertSame('John Doe', $event->name()->toString());
        self::assertSame('2026-04-28 12:34:56.000000', $event->occurredAt()->toDateTimeString());
        self::assertTrue($event->accountId()->matches($accountId));
    }

    public function test_it_should_be_able_to_create_a_game(): void
    {
        $player = PlayerBuilder::newRandomPlayer()->getPlayer();
        $game = $player->createGame(
            $gameId = GameId::randomUUID(),
            AppDateTime::fromNow(),
        );

        self::assertTrue($game->getIdentity()->matches($gameId));
        self::assertTrue($game->isOwnedBy($player->getIdentity()));
    }
}
