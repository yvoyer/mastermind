<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Functional\Page;

use PHPUnit\Framework\Assert;
use Star\Mastermind\Tests\Functional\TestClient;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use function count;

abstract readonly class BasePage
{
    public function __construct(
        private TestClient $client,
        private KernelBrowser $browser,
    ) {
    }

    public function assertCurrentPageIsWelcomePage(): WelcomePage
    {
        return $this->client->assertCurrentPageIsWelcomePage();
    }

    public function assertSelectorContains(
        string $selector,
        string $text,
    ): self {
        $crawler = $this->browser
            ->getCrawler()
            ->filter($selector);
        Assert::assertGreaterThan(0, count($crawler));
        Assert::assertStringContainsString($text, $crawler->text());

        return $this;
    }
}
