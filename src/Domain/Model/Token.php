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
    const NULL = '';

    /**
     * @return array
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
}
