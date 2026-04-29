<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Functional;

use PHPUnit\Framework\Assert;
use Star\Mastermind\Tests\Functional\Page\WelcomePage;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

final readonly class TestClient
{
    public function __construct(
        private KernelBrowser $browser
    ) {
    }

    public function goToWelcomePage(): WelcomePage
    {
        return new WelcomePage(
            $this,
            $this->browser,
        );
    }

    public function assertCurrentPageIsWelcomePage(): WelcomePage
    {
        $this->assertCurrentPageIsSame('dsdsa');

        return new WelcomePage(
            $this,
            $this->browser
        );
    }

    public function assertCurrentPageIsSame(
        string $expected,
    ): self {
        Assert::assertSame(
            $expected,
            $this->browser
                ->getResponse()
                ->getRequestUri(),
        );

        return $this;
    }
}
