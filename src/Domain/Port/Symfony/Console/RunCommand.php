<?php

namespace Star\Mastermind\Domain\Port\Symfony\Console;

use Star\Mastermind\Domain\Model\MasterMind;
use Star\Mastermind\Domain\Model\Token;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

final class RunCommand extends Command
{
    public function __construct() {
        parent::__construct('run');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $game = new MasterMind($tokenNumber = 4, $maxTurns = 12);
        $hidden = array_rand(array_flip(Token::all()), 4);
        $game->start($hidden);

        while (true) {
            $game->printGame(new PrintGameInConsole($output));

            /**
             * @var QuestionHelper $helper
             */
            $helper = $this->getHelper('question');
            $guess = [];
            $tokens = Token::all();

            for($i = 0; $i < $tokenNumber; $i++) {
                $answer = $helper->ask(
                    $input,
                    $output,
                    new ChoiceQuestion(
                        "Quel token voulez-vous utiliser à la position {$i} ?",
                        $tokens
                    )
                );
                $guess[$i] = $answer;
                unset($tokens[array_search($answer, $tokens)]);
                $tokens = array_values($tokens);
            }

            $result = $game->makeChoices($guess);
            if ($result->isEnded()) {
                break;
            }
        }

        $game->printGame(new PrintGameInConsole($output));

        return 0;
    }
}
