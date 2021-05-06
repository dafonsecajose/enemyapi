<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Enemy extends Model
{
    use Slug;
    use HasFactory;

    protected $fillable = [
        'name', 'rank', 'level', 'affiliation', 'description'
    ];

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
