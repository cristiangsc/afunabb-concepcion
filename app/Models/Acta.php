<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Acta extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title','fecha','user_id'];


    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($acta) {
            $acta->user_id = auth()->id();
        });
        static::updating(function ($acta) {
            $acta->user_id = auth()->id();
        });
    }


    protected function fecha():Attribute
    {
        return new Attribute(
            get: function ($value){
                return date_format(now()->parse($value),"d-m-Y");
            }
        );
    }
}
