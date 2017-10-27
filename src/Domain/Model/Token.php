<?php

namespace Star\Mastermind\Domain\Model;

final class Token
{
    // Easy Difficulty = 6, with no double allowed
    // Normal difficulty = 6, with double color
    // Hard Difficulty = 8, with double colors
    const RED = 'red';
    const BLUE = 'blue';
    const GREEN = 'green';
    const YELLOW = 'yellow';
    const BLACK = 'black';
    const CYAN = 'cyan';
    const MAGENTA = 'magenta';
    const WHITE = 'white';

    /**
     * @var string
     */
    private $id;

    /**
     * @var array Key value pair, where key is locale, and value is label
     */
    private $translations;

    private function __construct($id, array $translations)
    {
        $this->id = $id;
        $this->translations = $translations;
    }

    /**
     * @return string[]
     */
    public static function all() {
        return [
            self::BLACK,
            self::BLUE,
            self::CYAN,
            self::GREEN,
            self::RED,
            self::MAGENTA,
            self::WHITE,
            self::YELLOW,
        ];
    }

    /**
     * @return Token[]
     */
    public static function allTokens() {
        return [
            new self(self::BLACK, ['en' => 'Black', 'fr' => 'Noir']),
            new self(self::BLUE, ['en' => 'Blue', 'fr' => 'Bleu']),
            new self(self::CYAN, ['en' => 'Cyan', 'fr' => 'Cyan']),
            new self(self::GREEN, ['en' => 'Green', 'fr' => 'Vert']),
            new self(self::RED, ['en' => 'Red', 'fr' => 'Rouge']),
            new self(self::MAGENTA, ['en' => 'Magenta', 'fr' => 'Mauve']),
            new self(self::WHITE, ['en' => 'White', 'fr' => 'Blanc']),
            new self(self::YELLOW, ['en' => 'Yellow', 'fr' => 'Jaune']),
        ];
    }
}
