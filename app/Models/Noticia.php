<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Noticia extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title','body','user_id'];

      protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($noticia) {
            $noticia->user_id = auth()->id();
        });
        static::updating(function ($noticia) {
            $noticia->user_id = auth()->id();
        });
    }

    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('title', 'like', '%' . $value . '%')
            ->with(['user'=> function ($query){
                $query->withTrashed();
        }])
            ->with('media');
    }
//15.191.366-0
    protected function createdAt():Attribute
    {
        return new Attribute(
            get: function ($value){
                return date_format(now()->parse($value),"d-m-Y  H:i");
            }
        );
    }
}
