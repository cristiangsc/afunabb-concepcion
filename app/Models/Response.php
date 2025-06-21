<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    protected $table = 'responses';
    protected $fillable = ['user_id', 'question_id', 'option_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($response) {
            $response->user_id = auth()->id();
        });
        static::updating(function ($response) {
            $response->user_id = auth()->id();
        });
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function question():BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
    public function option():BelongsTo
    {
        return $this->belongsTo(Option::class);
    }
}
