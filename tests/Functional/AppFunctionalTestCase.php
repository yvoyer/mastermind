<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AppFunctionalTestCase extends WebTestCase
{
    public function createTestClient(array $options = [], array $server = []): TestClient
    {
        return new TestClient(
            self::createClient($options, $server)
        );
    }
}
