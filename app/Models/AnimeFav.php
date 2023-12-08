<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimeFav extends Model
{
    protected $table = 'anime_favs';

    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function animes()
    {
        return $this->belongsTo(Anime::class, 'anime_id');
    }
}
