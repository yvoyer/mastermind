<?php

declare(strict_types=1);

namespace Star\Mastermind\Tests\Gaming\Application\Command\Game;

use PHPUnit\Framework\TestCase;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Application\Command\Game\CreateGame;
use Star\Mastermind\Gaming\Application\Command\Game\CreateGameHandler;
use Star\Mastermind\Gaming\Domain\Model\Game\GameAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Game\GameRepository;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final class CreateGameHandlerTest extends TestCase
{
    public function test_it_should_create_a_game(): void
    {
        $games = new class implements GameRepository {
            public ?GameAggregate $savedGame = null;

            public function saveGame(GameAggregate $game): void
            {
                $this->savedGame = $game;
            }
        };

        $handler = new CreateGameHandler($games);
        $handler(new CreateGame(
            $gameId = GameId::randomUUID(),
            $ownerId = PlayerId::randomUUID(),
            AppDateTime::fromNow(),
            AccountId::randomUUID(),
        ));

        self::assertNotNull($games->savedGame);
        self::assertTrue($games->savedGame->getIdentity()->matches($gameId));
        self::assertTrue($games->savedGame->isOwnedBy($ownerId));
    }
}
