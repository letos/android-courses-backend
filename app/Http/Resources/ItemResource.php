<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ItemResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $userId = Auth::id();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'created_at' => $this->created_at,
            'is_favorite' => $this->hasFavoriteUser($userId),
            'rating' => $this->rating(),
            'your_rating' => $this->userRating($userId)
        ];
    }
}
