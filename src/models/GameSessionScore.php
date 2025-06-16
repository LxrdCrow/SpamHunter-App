<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class GameSessionScore extends Model
{
    protected $table = 'game_session_scores';

    protected $fillable = [
        'session_id',
        'score',
        'created_at',
        'updated_at',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(GameSession::class, 'session_id');
    }

    public function getScoreAttribute($value)
    {
        return number_format($value, 2);
    }

    public function setScoreAttribute($value)
    {
        $this->attributes['score'] = number_format($value, 2, '.', '');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getSessionIdAttribute($value)
    {
        return (int) $value;
    }
}
