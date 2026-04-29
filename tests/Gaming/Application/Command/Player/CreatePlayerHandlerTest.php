<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Gaming\Application\Command\Player;

use PHPUnit\Framework\TestCase;
use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Application\Command\Player\CreatePlayer;
use Star\Mastermind\Gaming\Application\Command\Player\CreatePlayerHandler;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;
use Star\Mastermind\Gaming\Infrastructure\Persistence\InMemory\PlayerCollection;

final class CreatePlayerHandlerTest extends TestCase
{
    public function test_it_should_create_a_player(): void
    {
        $players = new PlayerCollection();
        $handler = new CreatePlayerHandler($players);

        $handler(new CreatePlayer(
            $playerId = PlayerId::randomUUID(),
            'John Doe',
            AppDateTime::fromString('2026-04-28 12:34:56'),
            AccountId::randomUUID(),
        ));

        $player = $players->getPlayerWithId($playerId);

        self::assertTrue($player->getIdentity()->matches($playerId));
        self::assertTrue($player->matchesName('John Doe'));
    }
}
