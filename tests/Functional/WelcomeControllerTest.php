<?php declare(strict_types=1);

namespace Star\Mastermind\Tests\Functional;

final class WelcomeControllerTest extends AppFunctionalTestCase
{
    public function test_it_should_render_the_mastermind_welcome_page(): void
    {
        $client = $this->createTestClient();
        $client->goToWelcomePage()
            ->assertCurrentPageIsWelcomePage()
            ->assertSelectorContains('h1', 'Mastermind')
            ->assertSelectorContains('#welcome-menu', 'New Game')
            ->assertSelectorContains('#welcome-menu', 'Load Game')
            ->assertSelectorContains('#welcome-menu', 'Credits')
            ->assertSelectorContains('#welcome-menu', 'Rules')
        ;
    }
}
