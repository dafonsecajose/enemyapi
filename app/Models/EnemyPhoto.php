<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnemyPhoto extends Model
{
    use HasFactory;


    protected $fillable = [
        'photo', 'position'
    ];


    public function enemy()
    {
        return $this->belongsTo(Enemy::class);
    }
}
