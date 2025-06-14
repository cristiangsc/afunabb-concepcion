<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sede extends Model
{
    use HasFactory;


    protected $fillable = ['name'];

    public function users(): hasMany
    {
        return $this->hasMany(User::class, 'sede_id');
    }

    public function aportes(): hasMany
    {
        return $this->hasMany(Aporte::class, 'sede_id');
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

