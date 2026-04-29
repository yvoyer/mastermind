<?php declare(strict_types=1);

namespace Star\Mastermind\Gaming\Domain\Model\Player;

use function sprintf;
use function trim;

final readonly class PlayerName
{
    private function __construct(
        private string $name,
    ) {
        if (trim($name) === '') {
            throw new InvalidPlayerName(
                sprintf('Player name "%s" cannot be empty.', $name)
            );
        }
    }

    public function toString(): string
    {
        return $this->name;
    }

    public static function fromString(string $name): self
    {
        return new self($name);
    }
}
