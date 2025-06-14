<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Constancia extends Model
{
    use HasFactory ;

    protected $fillable = ['descripcion', 'inicio', 'termino', 'user_id', 'rut_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($constancia) {
            $constancia->user_id = auth()->id();
        });
        static::updating(function ($constancia) {
            $constancia->user_id = auth()->id();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rut_id', 'rut');
    }

    public function reparticion(): hasOneThrough
    {
        return $this->hasOneThrough(Reparticion::class, User::class,'rut','id','rut_id','reparticion_id');
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
