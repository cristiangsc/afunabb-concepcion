<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimony extends Model
{
    use HasFactory;

    protected $fillable = ['testimony','user_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($testimony) {
            $testimony->user_id = auth()->id();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function createdAt():Attribute
    {
        return new Attribute(
            get: function ($value){
                return date_format(now()->parse($value),"d-m-Y");
            }
        );
    }


}
