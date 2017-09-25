<?php

namespace Star\Mastermind\Domain\Port\Symfony\Console;

use Star\Mastermind\Application\Translation\TranslationRegistry;
use Star\Mastermind\Domain\Model\MasterMindResult;
use Star\Mastermind\Domain\Model\PrintsGame;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Output\OutputInterface;

final class PrintGameInConsole implements PrintsGame
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var TranslationRegistry
     */
    private $translations;

    /**
     * @param OutputInterface $output
     * @param TranslationRegistry $translations
     */
    public function __construct(OutputInterface $output, TranslationRegistry $translations)
    {
        $this->output = $output;
        $this->translations = $translations;
    }

    /**
     * @param int $maxTurn
     * @param int $tokenNumber
     * @param array $guessHistory
     * @param array $answers
     */
    public function printActiveGame($maxTurn, $tokenNumber, array $guessHistory, array $answers)
    {
        $table = new Table($this->output);
        $table->setHeaders(
            [
                $this->translations->get(TranslationRegistry::HEADER_TURN_NUMBER_COLUMN),
                $this->translations->get(TranslationRegistry::HEADER_GUESS_COLUMN),
                $this->translations->get(TranslationRegistry::HEADER_ANSWER_COLUMN),
            ]
        );
        $cellWidth = $tokenNumber * 2 - 1;
        $table->setColumnWidths([4, $cellWidth, $cellWidth]);

        for ($i = 0; $i < $maxTurn; $i++) {
            $table->addRow(
                [
                    $i + 1,
                    (isset($guessHistory[$i])) ? new GuessCell($guessHistory[$i]) : '',
                    (isset($answers[$i])) ? new GuessCell($answers[$i]) : '',
                ]
            );

            if ($i != $maxTurn - 1) { // not last line
                $table->addRow(new TableSeparator());
            }
        }

        $table->render();
    }

    /**
     * @param int $currentTurn
     * @param array $hidden
     * @param MasterMindResult $result
     */
    public function printEndedGame($currentTurn, array $hidden, MasterMindResult $result)
    {
        $this->output->writeln('');

        if ($result->isWon()) {
            $this->output->writeln(
                sprintf(
                    $this->translations->get(TranslationRegistry::END_GAME_VICTORY),
                    $currentTurn
                )
            );
        } else {
            $this->output->writeln($this->translations->get(TranslationRegistry::END_GAME_LOST));
        }

        $this->output->writeln('');

        $table = new Table($this->output);
        $table->setStyle('compact');
        $table->setHeaders([$this->translations->get(TranslationRegistry::HEADER_SOLUTION)]);
        $table->addRow([new GuessCell($hidden)]);
        $table->render();
    }
}
