<?php

namespace Star\Mastermind\Domain\Port\Symfony\Console;

use Symfony\Component\Console\Helper\TableCell;

final class GuessCell extends TableCell
{
    /**
     * @param array $guess Collection of Token::COLORS
     */
    public function __construct(array $guess)
    {
        parent::__construct($this->guessAsString($guess));
    }

    /**
     * @param array $guesses
     *
     * @return string
     */
    private function guessAsString(array $guesses)
    {
        $colors = [];
        foreach ($guesses as $color) {
            $colors[] = (empty($color)) ? ' ' : "<bg={$color}> </>";
        }

        return implode(' ', $colors);
    }
}
