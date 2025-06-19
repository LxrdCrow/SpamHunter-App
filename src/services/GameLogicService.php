<?php

namespace App\Services;

use App\Helpers\GameHelper;

class GameLogicService
{
    private array $currentGameState;

    public function startGame(): array
    {
        $this->currentGameState = GameHelper::generateGameData();
        return $this->currentGameState;
    }

    public function makeMove(array $move): array
    {
        if (!GameHelper::validateMove($move)) {
            return ['error' => 'Invalid move'];
        }

        // Simultation of a move in the game
        $direction = $move['direction'];
        switch ($direction) {
            case 'up':    $this->currentGameState['position'][1]--; break;
            case 'down':  $this->currentGameState['position'][1]++; break;
            case 'left':  $this->currentGameState['position'][0]--; break;
            case 'right': $this->currentGameState['position'][0]++; break;
        }

        // Update score based on the move
        $this->currentGameState['score'] += 10;

        return $this->currentGameState;
    }

    public function endGame(): string
    {
        $formattedScore = GameHelper::formatScore($this->currentGameState['score']);
        return "Game over! Final score: {$formattedScore}";
    }

    public function getCurrentState(): array
    {
        return $this->currentGameState;
    }
}

