<?php

use Illuminate\Database\Eloquent\Model;

// Response Model

class Response extends Model
{
    protected $table = 'responses';

    protected $fillable = [
        'session_id',
        'response_data',
        'created_at',
        'updated_at',
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}

