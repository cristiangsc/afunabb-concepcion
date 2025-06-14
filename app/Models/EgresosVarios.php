<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EgresosVarios extends Model
{
    use HasFactory;

    protected $fillable = ['monto','fecha','observacion','user_id','egreso_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($egresosVarios) {
            $egresosVarios->user_id = auth()->id();
        });
        static::updating(function ($egresosVarios) {
            $egresosVarios->user_id = auth()->id();
        });
    }

    public function egreso():BelongsTo
    {
        return $this->belongsTo(Egreso::class);
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
