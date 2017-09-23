<?php

namespace Star\Mastermind\Domain\Port\Symfony\Console;

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
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
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
        $table->setHeaders(['Turn', 'Guess', 'Response']);
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
     */
    public function printEndedGame($currentTurn, array $hidden)
    {
        throw new \RuntimeException('TODO manage end game');
        $table = new Table($this->output);
        $table->addRow([new GuessCell($hidden)]);

        $table->render();
    }
}
