<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class BeneficioSocio extends Model
{
    use HasFactory;

    protected $fillable = ['monto','fecha_asignacion','observacion','rut_id','benefit_id','user_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($beneficioSocio) {
            $beneficioSocio->user_id = auth()->id();
        });
        static::updating(function ($beneficioSocio) {
            $beneficioSocio->user_id = auth()->id();
        });
    }

    protected function fechaAsignacion():Attribute
    {
        return new Attribute(
            get: function ($value){
                return date_format(now()->parse($value),"d-m-Y");
            }
        );
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'rut_id', 'rut');
    }

    public function beneficio():BelongsTo
    {
        return $this->belongsTo(Benefit::class,'benefit_id','id');
    }

    public function reparticion(): hasOneThrough
    {
        return $this->hasOneThrough(Reparticion::class, User::class,'rut','id','rut_id','reparticion_id');
    }

    protected function fecha_asignacion():Attribute
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
