<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    protected  $table = 'options';
    protected $fillable = ['question_id', 'option_text'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
    public function responses():HasMany
    {
        return $this->hasMany(Response::class);
    }
}
