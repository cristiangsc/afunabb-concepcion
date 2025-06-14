<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;

    protected $fillable = [
        'rut',
        'nombre',
        'paterno',
        'materno',
        'telefono',
        'fecha_nacimiento',
        'fecha_ingreso_ubb',
        'fecha_ingreso_afunabb',
        'num_cuenta',
        'direccion',
        'calidad',
        'sede_id',
        'reparticion_id',
        'cargo_id',
        'comuna_id',
        'cuenta_id',
        'banco_id',
        'profile_photo_path',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
        'full_name',
        'full_name_reverse'
    ];

    public function fullNameReverse():Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => strtoupper(sprintf("%s %s %s", $attributes['paterno'], $attributes['materno'], $attributes['nombre'])));
    }

    public function fullName():Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => strtoupper(sprintf("%s %s %s", $attributes['nombre'], $attributes['paterno'], $attributes['materno'])));
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('nombre', 'like', '%' . $value . '%')
        ->orWhere('rut', 'like', '%' . $value . '%')
        ->orWhere('paterno', 'like', '%' . $value . '%')
        ->orWhere('materno', 'like', '%' . $value . '%')
        ->withTrashed()
        ->with('sede');
    }

    public function sede():belongsTo
    {
        return $this->belongsTo(Sede::class);
    }

    public function cargo():belongsTo
    {
        return $this->belongsTo(Cargo::class);
    }

    public function banco():belongsTo
    {
        return $this->belongsTo(Banco::class);
    }

    public function cuenta():belongsTo
    {
        return $this->belongsTo(Cuenta::class);
    }

    public function comuna():belongsTo
    {
        return $this->belongsTo(Comuna::class);
    }


    public function constancias():hasMany
    {
        return $this->hasMany(Constancia::class, 'rut','rut_id');
    }

    public function BeneficiosSocios():hasMany
    {
        return $this->hasMany(BeneficioSocio::class, 'rut','rut_id');
    }

    public function reparticion():belongsTo
    {
        return $this->belongsTo(Reparticion::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimony::class);
    }

    protected function fechaNacimiento():Attribute
    {
        return new Attribute(
            get: function ($value){
                return date_format(now()->parse($value),"d-m-Y");
            }
        );
    }

    protected function fechaIngresoUbb():Attribute
    {
        return new Attribute(
            get: function ($value){
                return date_format(now()->parse($value),"d-m-Y");
            }
        );
    }

    protected function fechaIngresoAfunabb():Attribute
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
