<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class GameSession extends Model
{
    protected $table = 'game_session';

    protected $fillable = [
        'user_id',
        'game_id',
        'game_data',
        'history_data',
        'game_point',
        'status',
        'started_at',
        'ended_at',
    ];

    // RELAZIONS
    /**
     * The user who owns the game session.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */ 

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function scores(): HasMany
    {
        return $this->hasMany(GameSessionScore::class, 'session_id');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(GameAction::class, 'session_id');
    }

    // ACCESSOR / MUTATOR

    public function getStartedAt()
    {
        return Carbon::parse($this->attributes['started_at'])->format('Y-m-d H:i:s');
    }

    public function setStartedAt($value)
    {
        $this->attributes['started_at'] = Carbon::parse($value)->toDateTimeString();
    }

    public function getEndedAt()
    {
        return $this->attributes['ended_at'] 
            ? Carbon::parse($this->attributes['ended_at'])->format('Y-m-d H:i:s')
            : null;
    }

    public function setEndedAt($value)
    {
        $this->attributes['ended_at'] = $value 
            ? Carbon::parse($value)->toDateTimeString()
            : null;
    }
}
