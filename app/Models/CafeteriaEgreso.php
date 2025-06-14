<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static selectRaw(string $string)
 * @method static find(mixed $id)
 * @method static create(array[] $fields)
 */
class CafeteriaEgreso extends Model
{
    use HasFactory;

    protected $fillable = ['facturas','impuestos','comision_junaeb','remuneraciones','imposiciones','honorarios','observaciones','mes','anio','user_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($cafeteriaEgreso) {
            $cafeteriaEgreso->user_id = auth()->id();
        });
        static::updating(function ($cafeteriaEgreso) {
            $cafeteriaEgreso->user_id = auth()->id();
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
