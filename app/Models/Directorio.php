<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Directorio extends Model
{
    use HasFactory;

    protected $fillable = ['cargo','inicio','termino','estado','user_id','rut_id'];


    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($directorio) {
            $directorio->user_id = auth()->id();
        });
        static::updating(function ($directorio) {
            $directorio->user_id = auth()->id();
        });
    }


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'rut_id','rut');
    }

    protected function inicio():Attribute
    {
        return new Attribute(
            get: function ($value){
                return date_format(now()->parse($value),"d-m-Y");
            }
        );
    }
    protected function termino():Attribute
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
