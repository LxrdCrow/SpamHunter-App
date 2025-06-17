<?php

namespace App\Models;

use Carbon\Carbon;

class GameSession
{
    private int $userId;
    private int $gameId;
    private ?string $gameData;
    private ?string $historyData;
    private ?float $gamePoint;
    private int $status;
    private ?Carbon $startedAt;
    private ?Carbon $endedAt;

    public function __construct(
        int $userId,
        int $gameId,
        ?string $gameData = null,
        ?string $historyData = null,
        ?float $gamePoint = null,
        int $status = 0,
        ?string $startedAt = null,
        ?string $endedAt = null
    ) {
        $this->userId = $userId;
        $this->gameId = $gameId;
        $this->gameData = $gameData;
        $this->historyData = $historyData;
        $this->gamePoint = $gamePoint;
        $this->status = $status;
        $this->startedAt = $startedAt ? Carbon::parse($startedAt) : null;
        $this->endedAt = $endedAt ? Carbon::parse($endedAt) : null;
    }

    // Getters e setters

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getGameId(): int
    {
        return $this->gameId;
    }

    public function setGameId(int $gameId): void
    {
        $this->gameId = $gameId;
    }

    public function getGameData(): ?string
    {
        return $this->gameData;
    }

    public function setGameData(?string $gameData): void
    {
        $this->gameData = $gameData;
    }

    public function getHistoryData(): ?string
    {
        return $this->historyData;
    }

    public function setHistoryData(?string $historyData): void
    {
        $this->historyData = $historyData;
    }

    public function getGamePoint(): ?string
    {
        return $this->gamePoint !== null ? number_format($this->gamePoint, 2, '.', '') : null;
    }


    public function setGamePoint(?float $gamePoint): void
    {
        $this->gamePoint = $gamePoint;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getStartedAt(): ?string
    {
        return $this->startedAt ? $this->startedAt->format('Y-m-d H:i:s') : null;
    }

    public function setStartedAt(?string $startedAt): void
    {
        $this->startedAt = $startedAt ? Carbon::parse($startedAt) : null;
    }

    public function getEndedAt(): ?string
    {
        return $this->endedAt ? $this->endedAt->format('Y-m-d H:i:s') : null;
    }

    public function setEndedAt(?string $endedAt): void
    {
        $this->endedAt = $endedAt ? Carbon::parse($endedAt) : null;
    }
}

