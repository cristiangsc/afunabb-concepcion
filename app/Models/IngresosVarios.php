<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IngresosVarios extends Model
{
    use HasFactory;

    protected $fillable = ['monto','fecha','observacion','user_id','ingreso_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($ingresosVarios) {
            $ingresosVarios->user_id = auth()->id();
        });
        static::updating(function ($ingresosVarios) {
            $ingresosVarios->user_id = auth()->id();
        });
    }

    public function ingreso():BelongsTo
    {
        return $this->belongsTo(Ingreso::class);
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
