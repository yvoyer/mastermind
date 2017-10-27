<?php

namespace Star\Mastermind\Domain\Port\Symfony\Console;

use Star\Mastermind\Application\Translation\TranslationRegistry;
use Star\Mastermind\Domain\Model\Token;
use Symfony\Component\Console\Question\ChoiceQuestion;

final class ColorQuestion extends ChoiceQuestion
{
    public function __construct(TranslationRegistry $registry)
    {
        parent::__construct(
            $registry->get(TranslationRegistry::QUESTION_MAIN),
            Token::all()
        );
        $this->setMultiselect(true);
        $this->setAutocompleterValues([]);
    }
}
