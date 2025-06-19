<?php

namespace App\Models;

use Carbon\Carbon;

class GameSessionScore
{
    private int $sessionId;
    private float $score;
    private ?Carbon $createdAt;
    private ?Carbon $updatedAt;

    public function __construct(
        int $sessionId,
        float $score,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ) {
        $this->sessionId = $sessionId;
        $this->setScore($score);
        $this->createdAt = $createdAt ? Carbon::parse($createdAt) : null;
        $this->updatedAt = $updatedAt ? Carbon::parse($updatedAt) : null;
    }

    public function getSessionId(): int
    {
        return $this->sessionId;
    }

    public function setSessionId(int $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    public function getScore(): string
    {
        return number_format($this->score, 2);
    }

    public function setScore(float $score): void
    {
        $this->score = (float) number_format($score, 2, '.', '');
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt ? $this->createdAt->format('Y-m-d H:i:s') : null;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt ? Carbon::parse($createdAt) : null;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt ? $this->updatedAt->format('Y-m-d H:i:s') : null;
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt ? Carbon::parse($updatedAt) : null;
    }
}

