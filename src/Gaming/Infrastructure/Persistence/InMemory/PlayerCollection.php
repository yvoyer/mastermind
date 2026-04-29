<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Infrastructure\Persistence\InMemory;

use Star\Mastermind\Gaming\Domain\Model\Player\PlayerAggregate;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerNotFound;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerRepository;

final class PlayerCollection implements PlayerRepository
{
    /**
     * @var array<string, PlayerAggregate>
     */
    private array $players = [];

    public function getPlayerWithId(PlayerId $playerId): PlayerAggregate
    {
        return $this->players[$playerId->toString()]
            ?? throw new PlayerNotFound($playerId);
    }

    public function savePlayer(PlayerAggregate $player): void
    {
        $this->players[$player->getIdentity()->toString()] = $player;
    }
}
