<?php

namespace App\Services;

use App\Helpers\GameHelper;

class GameLogicService
{
    private GameHelper $gameHelper;

    public function __construct()
    {
        $this->gameHelper = new GameHelper();
    }

    public function startGame(): string
    {
        return $this->gameHelper->initializeGame();
    }

    public function endGame(): string
    {
        return $this->gameHelper->finalizeGame();
    }
}
