<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Game;

use function sprintf;

final class GameNotFound extends GameException
{
    public function __construct(GameId $gameId)
    {
        parent::__construct(
            sprintf('Game with id "%s" could not be found.', $gameId->toString())
        );
    }
}
