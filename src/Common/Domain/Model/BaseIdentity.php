<?php declare(strict_types=1);

namespace Star\Mastermind\Common\Domain\Model;

use Star\Component\Identity\StringIdentity;
use Symfony\Component\Uid\Uuid;
use function get_class;

abstract class BaseIdentity extends StringIdentity
{
    public function matches(BaseIdentity $identity): bool
    {
        return $identity->toString() === $this->toString()
            && $identity->entityClass() === $this->entityClass();
    }

    final public function entityClass(): string
    {
        return get_class($this);
    }

    public static function fromString(string $string): static
    {
        return new static($string);
    }

    public static function randomUUID(): static
    {
        return static::fromString(Uuid::v7()->toString());
    }
}
