<?php

declare(strict_types=1);

namespace Star\Mastermind\Tests\Gaming\Domain\Model\Player;

use PHPUnit\Framework\TestCase;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Player\Builder\PlayerBuilder;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerAggregate;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final class PlayerAggregateTest extends TestCase
{
    public function test_it_should_have_a_name(): void
    {
        $player = new PlayerAggregate(PlayerId::randomUUID(), 'John Doe');
        self::assertTrue($player->matchesName('John Doe'));
        self::assertFalse($player->matchesName('Jane Doe'));
    }

    public function test_it_should_be_able_to_create_a_game(): void
    {
        $player = PlayerBuilder::newRandomPlayer()->getPlayer();
        $game = $player->createGame($gameId = GameId::randomUUID());

        self::assertTrue($game->getIdentity()->matches($gameId));
        self::assertTrue($game->isOwnedBy($player->getIdentity()));
    }
}
