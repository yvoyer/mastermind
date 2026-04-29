<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Application\Command\Game;

use Star\Mastermind\Gaming\Domain\Model\Game\GameAggregate;
use Star\Mastermind\Gaming\Domain\Model\Game\GameRepository;

final readonly class CreateGameHandler
{
    public function __construct(
        private GameRepository $games,
    ) {
    }

    public function __invoke(CreateGame $command): void
    {
        $this->games->saveGame(
            GameAggregate::newGame(
                $command->getGameId(),
                $command->getOwnerId(),
                $command->createdAt(),
                $command->accountId(),
            ),
        );
    }
}
