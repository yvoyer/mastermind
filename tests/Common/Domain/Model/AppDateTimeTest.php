<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Common\Domain\Model;

use DateTimeInterface;
use Star\Mastermind\Common\Domain\Model\AppDateTime;
use PHPUnit\Framework\TestCase;

final class AppDateTimeTest extends TestCase
{
    public function test_it_should_be_created_from_string(): void
    {
        $date = AppDateTime::fromString('2000-01-01');
        self::assertSame('2000-01-01', $date->toDateString());
        self::assertSame('2000-01-01 00:00:00.000000', $date->toDateTimeString());
        self::assertInstanceOf(DateTimeInterface::class, $date->toDateTime());
    }

    public function test_it_should_be_created_from_now(): void
    {
        $date = AppDateTime::fromNow();
        self::assertSame(date('Y-m-d'), $date->toDateString());
        self::assertInstanceOf(DateTimeInterface::class, $date->toDateTime());
    }
}
