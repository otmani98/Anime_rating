<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            'episodes' => $this->episodes,
            'studio' => $this->studio,
            'rating' => $this->pivot->rating,
            'release_date' => $this->release_date,
        ];
    }
}
