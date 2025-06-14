<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gallery extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title','user_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($gallery) {
            $gallery->user_id = auth()->id();
        });
        static::updating(function ($gallery) {
            $gallery->user_id = auth()->id();
        });
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
