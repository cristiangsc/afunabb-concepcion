<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CafeteriaIngreso extends Model
{
    use HasFactory;

    protected $fillable = ['caja','transbank','junaeb','observaciones','mes','anio','user_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($cafeteriaIngreso) {
            $cafeteriaIngreso->user_id = auth()->id();
        });
        static::updating(function ($cafeteriaIngreso) {
            $cafeteriaIngreso->user_id = auth()->id();
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
