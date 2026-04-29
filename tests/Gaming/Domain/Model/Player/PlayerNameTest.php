<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Gaming\Domain\Model\Player;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Star\Mastermind\Gaming\Domain\Model\Player\InvalidPlayerName;
use Star\Mastermind\Gaming\Domain\Model\Player\PlayerName;

final class PlayerNameTest extends TestCase
{
    public function test_it_should_be_created_from_string(): void
    {
        $name = PlayerName::fromString('John Doe');

        self::assertSame('John Doe', $name->toString());
    }

    #[DataProvider('invalidNames')]
    public function test_it_should_not_be_empty(
        string $name,
        string $message,
    ): void {
        $this->expectException(InvalidPlayerName::class);
        $this->expectExceptionMessage($message);
        PlayerName::fromString($name);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function invalidNames(): iterable
    {
        yield 'empty' => ['', 'Player name "" cannot be empty.'];
        yield 'blank' => ['   ', 'Player name "   " cannot be empty.'];
    }
}
