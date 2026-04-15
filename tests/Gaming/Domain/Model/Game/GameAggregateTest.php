<?php

declare(strict_types=1);

namespace Star\Mastermind\Tests\Gaming\Domain\Model\Game;

use PHPUnit\Framework\TestCase;
use Star\Mastermind\Gaming\Domain\Model\Game\GameAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final class GameAggregateTest extends TestCase
{
    public function test_it_should_require_a_player(): void
    {
        $game = new GameAggregate(
            $id = GameId::randomUUID(),
            $owner = PlayerId::randomUUID(),
        );
        self::assertTrue($game->getIdentity()->matches($id));
        self::assertTrue($game->isOwnedBy($owner));
    }
}
