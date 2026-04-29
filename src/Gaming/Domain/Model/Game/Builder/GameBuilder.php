<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Game\Builder;

use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Domain\Model\Game\GameAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameId;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;

final readonly class GameBuilder
{
    private function __construct(
        private GameAggregate $game
    ) {
    }

    public function getGame(
        bool $resetEvents = true,
    ): GameAggregate {
        if ($resetEvents) {
            $this->game->uncommitedEvents();
        }

        return $this->game;
    }

    public static function newGame(
        GameId $gameId,
        PlayerId $owner,
        AppDateTime $createdAt,
        AccountId $createdBy,
    ): self {
        return new self(
            GameAggregate::newGame(
                $gameId,
                $owner,
                $createdAt,
                $createdBy,
            ),
        );
    }

    public static function newGameFixture(): self
    {
        return self::newGame(
            GameId::randomUUID(),
            PlayerId::randomUUID(),
            AppDateTime::fromNow(),
            AccountId::randomUUID(),
        );
    }
}
