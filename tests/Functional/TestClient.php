<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Functional;

use PHPUnit\Framework\Assert;
use Star\Mastermind\Tests\Functional\Page\WelcomePage;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use function parse_url;
use const PHP_URL_PATH;

final readonly class TestClient
{
    public function __construct(
        private KernelBrowser $browser
    ) {
    }

    public function goToWelcomePage(): WelcomePage
    {
        $this->browser->request('GET', '/');

        return new WelcomePage(
            $this,
            $this->browser,
        );
    }

    public function assertCurrentPageIsWelcomePage(): WelcomePage
    {
        $this->assertCurrentPageIsSame('/');

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
            parse_url(
                $this->browser
                    ->getInternalRequest()
                    ->getUri(),
                PHP_URL_PATH,
            ),
        );

        return $this;
    }
}
