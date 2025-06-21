<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    protected $fillable = ['title', 'description', 'start_at', 'end_at'];
    protected $table = 'surveys';


    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($survey) {
            $survey->user_id = auth()->id();
        });
        static::updating(function ($survey) {
            $survey->user_id = auth()->id();
        });
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function questions():HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function responses():HasMany
    {
        return $this->hasMany(Response::class);
    }
}
