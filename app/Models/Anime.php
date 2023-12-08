<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'episodes',
        'release_date',
        'studio_id'
    ];

    public $timestamps = false;


    public function studio() 
    {
        return $this->belongsTo(Studio::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'anime_genre', 'anime_id', 'genre_id');
    }

    public function ratings()
    {
        return $this->belongsToMany(User::class, 'anime_ratings', 'anime_id', 'user_id')->withPivot('rating');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'anime_favs', 'anime_id', 'user_id');
    }
}
