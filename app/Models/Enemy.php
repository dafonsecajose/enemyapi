<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Api\Controllers\EnemySeachController;
use App\Traits\Slug;

class Enemy extends Model
{
    use Slug;
    use HasFactory;

    protected $fillable = [
        'name', 'rank', 'level', 'affiliation', 'description'
    ];


    public function photos()
    {
        return $this->hasMany(EnemyPhoto::class);
    }
}
