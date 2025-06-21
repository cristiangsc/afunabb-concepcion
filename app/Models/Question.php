<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = ['question', 'survey_id'];
    protected $table = 'questions';

    public function survey():BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    public function options():HasMany
    {
        return $this->hasMany(Option::class);
    }



}
