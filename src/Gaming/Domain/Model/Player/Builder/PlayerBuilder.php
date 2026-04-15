<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Player\Builder;

use Star\Mastermind\Gaming\Domain\Model\Player\PlayerAggregate;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;
use function uniqid;

final readonly class PlayerBuilder
{
    private function __construct(
        private PlayerAggregate $player
    ) {
    }

    public function getPlayer(): PlayerAggregate
    {
        return $this->player;
    }

    public static function newPlayer(
        PlayerId $id,
        string $name,
    ): self {
        return new self(new PlayerAggregate($id, $name));
    }

    public static function newRandomPlayer(): self
    {
        return self::newPlayer(
            PlayerId::randomUUID(),
            uniqid('name '),
        );
    }
}
