<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;
    protected $fillable = ['name','fecha','vigencia','user_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($benefit) {
            $benefit->user_id = auth()->id();
        });
        static::updating(function ($benefit) {
            $benefit->user_id = auth()->id();
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

    protected function createdAt():Attribute
    {
        return new Attribute(
            get: function ($value){
                return date_format(now()->parse($value),"d-m-Y");
            }
        );
    }
}
