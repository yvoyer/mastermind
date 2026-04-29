<?php

declare(strict_types=1);

namespace Star\Mastermind\Tests\Gaming\Application\Command\Game;

use PHPUnit\Framework\TestCase;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Application\Command\Game\CreateGame;
use Star\Mastermind\Gaming\Application\Command\Game\CreateGameHandler;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;
use Star\Mastermind\Gaming\Infrastructure\Persistence\InMemory\GameCollection;

final class CreateGameHandlerTest extends TestCase
{
    public function test_it_should_create_a_game(): void
    {
        $games = new GameCollection();
        self::assertCount(0, $games);

        $handler = new CreateGameHandler($games);
        $handler(new CreateGame(
            $gameId = GameId::randomUUID(),
            $ownerId = PlayerId::randomUUID(),
            AppDateTime::fromNow(),
            AccountId::randomUUID(),
        ));

        self::assertCount(1, $games);
        $game = $games->getGameWithId($gameId);
        self::assertTrue($game->getIdentity()->matches($gameId));
        self::assertTrue($game->isOwnedBy($ownerId));
    }
}
