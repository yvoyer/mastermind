<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Player;

final class PlayerNotFound extends PlayerDomainException
{
    public function __construct(PlayerId $playerId)
    {
        parent::__construct(
            sprintf('Player with id "%s" could not be found.', $playerId->toString())
        );
    }
}
