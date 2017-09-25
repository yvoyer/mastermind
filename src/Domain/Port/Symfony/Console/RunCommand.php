<?php

namespace Star\Mastermind\Domain\Port\Symfony\Console;

use Star\Mastermind\Application\Translation\TranslationRegistry;
use Star\Mastermind\Domain\Model\MasterMind;
use Star\Mastermind\Domain\Model\Token;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

final class RunCommand extends Command
{
    public function __construct() {
        parent::__construct('run');
    }

    protected function configure()
    {
        $this->setDescription('Launch a game');
        $this->addOption(
            'locale',
            'l',
            InputOption::VALUE_REQUIRED,
            'The language to use for the questions. (available "en | fr").',
            'en'
        );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $game = new MasterMind($tokenNumber = 4, $maxTurns = 10);
        $hidden = array_rand(array_flip(Token::all()), 4);
        $game->start($hidden);
        $printer = new PrintGameInConsole(
            $output, $registry = new TranslationRegistry($input->getOption('locale'))
        );

        while (true) {
            /**
             * @var QuestionHelper $helper
             */
            $helper = $this->getHelper('question');
            $guess = [];
            $tokens = Token::all();

            for($i = 0; $i < $tokenNumber; $i++) {
                $game->printGame($printer);

                $output->writeln('');
                $table = new Table($output);
                $table->setStyle('compact');
                $table->setHeaders([$registry->get(TranslationRegistry::HEADER_CURRENT_GUESS)]);
                $table->addRow([new GuessCell($guess)]);
                $table->render();
                $output->writeln('');

                $answer = $helper->ask(
                    $input,
                    $output,
                    new ChoiceQuestion(
                        sprintf($registry->get(TranslationRegistry::QUESTION_MAIN), $i),
                        $tokens
                    )
                );

                // todo Translate colors
                $guess[$i] = $answer;
                unset($tokens[array_search($answer, $tokens)]);
                $tokens = array_values($tokens);
            }

            $result = $game->makeChoices($guess);
            if ($result->isEnded()) {
                break;
            }
        }

        $game->printGame($printer);

        return 0;
    }
}
