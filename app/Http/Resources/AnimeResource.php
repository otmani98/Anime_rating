<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'episodes' => $this->title,
            'studio' => $this->studio,
            'genres' => $this->genres,
            'rating' => $this->ratings,
            'favorites_count' => $this->usersFav,
            'release_date' => $this->release_date,
        ];
    }
}
