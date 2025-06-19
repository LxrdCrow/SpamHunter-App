<?php

namespace App\Helpers;

class GameHelper
{
    public static function validateMove(array $move): bool
    {
        return isset($move['direction']) && in_array($move['direction'], ['up', 'down', 'left', 'right']);
    }

    public static function formatScore(int $score): string
    {
        return number_format($score, 2, '.', '');
    }

    public static function generateGameData(): array
    {
        return [
            'position' => [0, 0],
            'lives' => 3,
            'score' => 0,
        ];
    }
}
