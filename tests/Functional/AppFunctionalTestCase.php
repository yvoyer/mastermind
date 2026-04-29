<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Functional;

use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AppFunctionalTestCase extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return Kernel::class;
    }

    public function createTestClient(array $options = [], array $server = []): TestClient
    {
        return new TestClient(
            self::createClient($options, $server)
        );
    }
}
