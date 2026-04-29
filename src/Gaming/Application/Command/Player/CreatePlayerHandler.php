<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Application\Command\Player;

use Star\Mastermind\Gaming\Domain\Model\Player\PlayerAggregate;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerName;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerRepository;

final readonly class CreatePlayerHandler
{
    public function __construct(
        private PlayerRepository $players,
    ) {
    }

    public function __invoke(CreatePlayer $command): void
    {
        $this->players->savePlayer(
            PlayerAggregate::registeredPlayer(
                $command->playerId(),
                PlayerName::fromString($command->name()),
                $command->registeredAt(),
                $command->accountId(),
            ),
        );
    }
}
