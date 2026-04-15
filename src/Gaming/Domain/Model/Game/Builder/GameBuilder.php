<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Game\Builder;

use Star\Mastermind\Gaming\Domain\Model\Game\GameAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final readonly class GameBuilder
{
    private function __construct(
        private GameAggregate $game
    ) {
    }

    public function getGame(): GameAggregate
    {
        return $this->game;
    }

    public static function newGame(
        GameId $gameId,
        PlayerId $owner,
    ): self {
        return new self(new GameAggregate($gameId, $owner));
    }
}
