<?php

namespace Star\Mastermind\Application\Translation;

final class TranslationRegistry
{
    const QUESTION_MAIN = 'color_picker.question';

    const HEADER_CURRENT_GUESS = 'headers.current_guess';
    const HEADER_TURN_NUMBER_COLUMN = 'headers.turn_number_column';
    const HEADER_GUESS_COLUMN = 'headers.guess_column';
    const HEADER_ANSWER_COLUMN = 'headers.answer_column';
    const HEADER_SOLUTION = 'headers.solution';

    const END_GAME_VICTORY = 'message.end_game.victory';
    const END_GAME_LOST = 'message.end_game.lost';

    /**
     * @var string
     */
    private $locale;

    private $translations = [
        self::QUESTION_MAIN => [
            'en' => "Which color do you wish to play at position %d?",
            'fr' => "Quelle couleur voulez-vous utiliser à la position %d?",
        ],
        self::HEADER_ANSWER_COLUMN => [
            'en' => 'Answer',
            'fr' => 'Réponse',
        ],
        self::HEADER_CURRENT_GUESS => [
            'en' => 'Current guess',
            'fr' => 'Dernier éssai',
        ],
        self::HEADER_GUESS_COLUMN => [
            'en' => 'Guess',
            'fr' => ' Éssai',
        ],
        self::HEADER_SOLUTION => [
            'en' => 'Solution',
            'fr' => 'Solution',
        ],
        self::HEADER_TURN_NUMBER_COLUMN => [
            'en' => 'Turn',
            'fr' => 'Tour',
        ],
        self::END_GAME_LOST => [
            'en' => '<info>You failed.</info><comment> Restart, you can do it.</comment>',
            'fr' => '<info>Vous avez échoué.</info><comment> Recommencez, vous pouvez y arriver.</comment>',
        ],
        self::END_GAME_VICTORY => [
            'en' => '<info>Congratulation,</info><comment> you have won in %d turns.</comment>',
            'fr' => '<info>Félicitation,</info><comment> vous avez gagné en %d tours.</comment>',
        ],
    ];

    /**
     * @param string $locale
     */
    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get($key) {
        if (! isset($this->translations[$key])) {
            throw new \InvalidArgumentException("Translation '{$key}' for locale '{$this->locale}' is not defined.");
        }

        return $this->translations[$key][$this->locale];
    }
}
