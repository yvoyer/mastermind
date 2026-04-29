<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Player\Builder;

use Star\Mastermind\Account\Domain\Model\AccountId;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerAggregate;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerId;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerName;
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
        ?AppDateTime $registeredAt = null,
        ?AccountId $accountId = null,
    ): self {
        return new self(
            PlayerAggregate::registeredPlayer(
                $id,
                PlayerName::fromString($name),
                $registeredAt ?? AppDateTime::fromNow(),
                $accountId ?? AccountId::randomUUID(),
            ),
        );
    }

    public static function newRandomPlayer(): self
    {
        return self::newPlayer(
            PlayerId::randomUUID(),
            uniqid('name '),
        );
    }
}
