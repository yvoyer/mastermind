<?php declare(strict_types=1);

namespace Star\Mastermind\Common\Domain\Model;

use DateTimeImmutable;
use DateTimeInterface;

final readonly class AppDateTime
{
    private function __construct(
        private DateTimeInterface $dateTime,
    ) {
    }

    public function toDateString(): string
    {
        return $this->dateTime->format('Y-m-d');
    }

    public function toDateTimeString(): string
    {
        return $this->dateTime->format('Y-m-d H:i:s.u');
    }

    public function toDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }

    public static function fromDateTime(DateTimeInterface $date): self
    {
        return new self($date);
    }

    public static function fromString(string $date): self
    {
        return self::fromDateTime(new DateTimeImmutable($date));
    }

    public static function fromNow(): self
    {
        return self::fromString('now');
    }
}
