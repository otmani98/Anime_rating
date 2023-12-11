<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //calc avg of rating
        $collectionOfRating = new Collection();
        foreach ($this->ratings as $userRated) { 
            $collectionOfRating->push($userRated->pivot->rating);
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'episodes' => $this->title,
            'studio' => $this->studio,
            'genres' => $this->genres,
            'rating' => $collectionOfRating->avg(),
            'favorites_count' => $this->favorites->count(),
            'release_date' => $this->release_date,
        ];
    }
}
