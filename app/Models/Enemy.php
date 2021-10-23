<?php

namespace App\Models;

use App\swagger\Models\EnemyInterface;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enemy extends Model implements EnemyInterface
{
    use HasFactory;

    protected $fillable = [
        'name', 'rank', 'level', 'affiliation', 'description'
    ];

    protected static function booted()
    {
        static::creating(function ($enemy) {
            $enemy->slug = Str::slug($enemy->name);
        });
        static::updating(function ($enemy) {
            $enemy->slug = Str::slug($enemy->name);
        });
    }

    /**
    * Relationship between enemies and enimyphotos
    *
    * @return EnemyPhoto|null
    */
    public function photos()
    {
        return $this->hasMany(EnemyPhoto::class);
    }
}
