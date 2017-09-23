<?php

namespace Star\Mastermind\Domain\Port\Symfony\Console;

use Star\Mastermind\Domain\Model\MasterMind;
use Star\Mastermind\Domain\Model\Token;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

final class RunCommand extends Command
{
    public function __construct() {
        parent::__construct('run');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $game = new MasterMind($tokenNumber = 4, $maxTurns = 12);
        $game->start(
            [
                Token::BLUE,
                Token::CYAN,
                Token::GREEN,
                Token::RED,
            ]
        );

        while (true) {
            $game->printGame(new PrintGameInConsole($output));

            // todo print current state
            /**
             * @var \Symfony\Component\Console\Helper\QuestionHelper $helper
             */
            $helper = $this->getHelper('question');
            $guess = [];
            for($i = 0; $i < $tokenNumber; $i++) {
                $answer = $helper->ask(
                    $input,
                    $output,
                    new ChoiceQuestion(
                        "Quel token voulez-vous utiliser à la position {$i} ?",
                        Token::all()
                    )
                );
                $guess[$i] = $answer;
            }

            $result = $game->makeChoices($guess);

            if ($result->isEnded()) {
                break;
            }
        }

        // print result
        $game->printGame(new PrintGameInConsole($output));
        // todo print end state
        $output->writeln('Game was ended with result : TODO');

        return 0;
    }
}
