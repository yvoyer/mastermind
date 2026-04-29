<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Player;

interface PlayerRepository
{
    /**
     * @throws PlayerNotFound
     */
    public function getPlayerWithId(PlayerId $playerId): PlayerAggregate;

    public function savePlayer(PlayerAggregate $player): void;
}
