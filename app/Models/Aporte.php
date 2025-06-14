<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aporte extends Model
{
    use HasFactory;

    protected $fillable = ['socios','monto','mes','anio','fecha','user_id','sede_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($aporte) {
            $aporte->user_id = auth()->id();
        });
        static::updating(function ($aporte) {
            $aporte->user_id = auth()->id();
        });
    }
    public function sede():BelongsTo
    {
        return $this->belongsTo(Sede::class);
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
