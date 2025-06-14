<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inversion extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion','documento','tipo','num_documento','monto','fecha','observacion','user_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($inversion) {
            $inversion->user_id = auth()->id();
        });
        static::updating(function ($inversion) {
            $inversion->user_id = auth()->id();
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
