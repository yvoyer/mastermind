<?php

namespace Star\Mastermind\Domain\Model;

final class MasterMindTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MasterMind
     */
    private $game;

    /**
     * @var array Fixture
     */
    private $hidden;

    /**
     * @var array
     */
    private $invalidGuess;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|PrintsGame
     */
    private $printer;

    public function setUp()
    {
        $this->printer = $this->getMockBuilder(PrintsGame::class)->getMock();
        $this->game = new MasterMind(4, 12);
        $this->hidden = [
            Token::RED,
            Token::BLUE,
            Token::YELLOW,
            Token::BLACK,
        ];
        $this->invalidGuess = [
            Token::GREEN,
            Token::CYAN,
            Token::MAGENTA,
            Token::WHITE,
        ];
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Cannot make guesses when game not started.
     */
    public function test_it_should_not_allow_to_guess_when_game_not_started()
    {
        $this->game->makeChoices([]);
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Guesses must contains exactly 4 colors, 3 given.
     */
    public function test_it_should_not_allow_to_guess_lower_than_configured_token_number()
    {
        $this->game->start($this->hidden);
        $this->game->makeChoices([Token::BLACK, Token::BLUE, Token::GREEN]);
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Guesses must contains exactly 4 colors, 5 given.
     */
    public function test_it_should_not_allow_to_guess_higher_than_configured_token_number()
    {
        $this->game->start($this->hidden);
        $this->game->makeChoices([Token::BLACK, Token::BLUE, Token::GREEN, Token::YELLOW, Token::RED]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Guess must contains supported colors, 'invalid' given.
     */
    public function test_it_should_not_allow_to_guess_a_not_supported_color()
    {
        $this->game->start($this->hidden);
        $this->game->makeChoices([Token::BLACK, Token::BLUE, 'invalid', Token::YELLOW]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Hidden tokens must contains supported colors, 'invalid' given.
     */
    public function test_it_should_not_allow_to_start_a_game_with_not_supported_color()
    {
        $this->game->start([Token::BLACK, Token::BLUE, 'invalid', Token::YELLOW]);
    }

    public function test_it_should_not_allow_to_make_choices_when_game_ended()
    {
        $this->game = new MasterMind(4, 2);
        $this->game->start($this->hidden);
        $this->game->makeChoices($this->invalidGuess);
        $this->game->makeChoices($this->invalidGuess);

        $this->setExpectedException(
            \LogicException::class,
            'Cannot make guesses when game not started.'
        );
        $this->game->makeChoices($this->invalidGuess);
    }

    public function test_it_should_place_token_on_game_start()
    {
        $this->game->start($this->hidden);
        $result = $this->game->makeChoices($this->invalidGuess);

        $this->assertInstanceOf(MasterMindResult::class, $result);
        $this->assertFalse($result->isWon());
        $this->assertFalse($result->isEnded());
    }

    public function test_it_should_end_the_game_when_user_provides_exact_tokens()
    {
        $this->game->start($this->hidden);
        $result = $this->game->makeChoices($this->hidden);

        $this->assertTrue($result->isWon());
        $this->assertTrue($result->isEnded());
    }

    public function test_it_should_end_the_game_when_user_provides_maximum_allowed_guesses()
    {
        $this->game = new MasterMind(4, 2);
        $this->assertNotEquals($this->invalidGuess, $this->hidden);
        $this->game->start($this->hidden);
        $this->game->makeChoices($this->invalidGuess);
        $result = $this->game->makeChoices($this->invalidGuess);

        $this->assertTrue($result->isEnded());
        $this->assertFalse($result->isWon());
    }

    public function test_it_should_return_no_token_for_not_present_color()
    {
        $this->game->start($this->hidden);
        $result = $this->game->makeChoices(
            [
                Token::MAGENTA,
                Token::GREEN,
                Token::CYAN,
                Token::WHITE,
            ]
        );
        $this->assertEquals([], $result->responseTokens());
    }

    public function test_it_should_return_white_token_for_valid_color_at_invalid_position()
    {
        $this->game->start($this->hidden);
        $result = $this->game->makeChoices(
            [
                $this->hidden[3],
                $this->hidden[2],
                $this->hidden[1],
                $this->hidden[0],
            ]
        );
        $this->assertEquals(
            [
                Token::WHITE,
                Token::WHITE,
                Token::WHITE,
                Token::WHITE,
            ],
            $result->responseTokens()
        );
    }

    public function test_it_should_return_black_token_for_valid_color_at_correct_position()
    {
        $this->game->start($this->hidden);
        $result = $this->game->makeChoices(
            [
                $this->hidden[0],
                $this->hidden[1],
                $this->hidden[2],
                $this->hidden[3],
            ]
        );
        $this->assertEquals(
            [
                Token::BLACK,
                Token::BLACK,
                Token::BLACK,
                Token::BLACK,
            ],
            $result->responseTokens()
        );
    }

    public function test_it_should_return_response_tokens_without_saying_the_position()
    {
        $this->game->start($this->hidden);
        $result = $this->game->makeChoices(
            [
                $this->hidden[0], // black
                Token::GREEN, // no token
                $this->hidden[1], // white
                Token::MAGENTA, // no token
            ]
        );
        $this->assertEquals(
            [
                Token::WHITE,
                Token::BLACK,
            ],
            $result->responseTokens()
        );
    }

    /**
     * @group example
     */
    public function test_example_a()
    {
        $this->game->start(
            [
                Token::RED,
                Token::WHITE,
                Token::BLUE,
                Token::GREEN,
            ]
        );
        $result = $this->game->makeChoices(
            [
                Token::WHITE,
                Token::YELLOW,
                Token::BLUE,
                Token::BLACK,
            ]
        );
        $this->assertEquals(
            [
                Token::WHITE,
                Token::BLACK,
            ],
            $result->responseTokens()
        );
    }

    /**
     * @group example
     */
    public function test_example_b()
    {
        $this->game->start(
            [
                Token::RED,
                Token::BLUE,
                Token::GREEN,
                Token::BLACK,
            ]
        );
        $result = $this->game->makeChoices(
            [
                Token::WHITE,
                Token::YELLOW,
                Token::GREEN,
                Token::GREEN,
            ]
        );
        $this->assertEquals(
            [
                Token::BLACK,
            ],
            $result->responseTokens()
        );
    }

    /**
     * @group example
     */
    public function test_example_c()
    {
        $this->game->start(
            [
                Token::YELLOW,
                Token::BLUE,
                Token::YELLOW,
                Token::BLACK,
            ]
        );
        $result = $this->game->makeChoices(
            [
                Token::RED,
                Token::YELLOW,
                Token::GREEN,
                Token::WHITE,
            ]
        );
        $this->assertEquals(
            [
                Token::WHITE,
            ],
            $result->responseTokens()
        );
    }

    /**
     * @group example
     */
    public function test_example_d()
    {
        $this->game->start(
            [
                Token::RED,
                Token::BLUE,
                Token::RED,
                Token::YELLOW,
            ]
        );
        $result = $this->game->makeChoices(
            [
                Token::GREEN,
                Token::RED,
                Token::RED,
                Token::WHITE,
            ]
        );
        $this->assertEquals(
            [
                Token::WHITE,
                Token::BLACK,
            ],
            $result->responseTokens()
        );
    }

    public function test_it_should_print_active_game_when_started() {
        $this->game->start($this->hidden);
        $this->printer
            ->expects($this->once())
            ->method('printActiveGame');
        $this->printer
            ->expects($this->never())
            ->method('printEndedGame');

        $this->game->printGame($this->printer);
    }

    public function test_it_should_print_ended_game_when_won() {
        $this->game->start($this->hidden);
        $this->game->makeChoices($this->hidden);

        $this->printer
            ->expects($this->once())
            ->method('printEndedGame');
        $this->game->printGame($this->printer);
    }

    public function test_it_should_print_ended_game_when_ended() {
        $this->game = new MasterMind(4, 1);
        $this->game->start($this->hidden);
        $this->game->makeChoices($this->invalidGuess);

        $this->printer
            ->expects($this->once())
            ->method('printEndedGame');
        $this->game->printGame($this->printer);
    }
}
