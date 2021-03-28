<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorite_items');
    }

    public function ratedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'rating_items');
    }

    public function hasFavoriteUser($userId): bool
    {
        return $this->users()->where('users.id', $userId)->exists();
    }

    public function rating(): int
    {
        return $this->ratedUsers()->sum('value');
    }

    public function userLiked($userId): bool
    {
        return $this->ratedUsers()->where('users.id', $userId)->where('value', 1)->exists();
    }

    public function userDisliked($userId): bool
    {
        return $this->ratedUsers()->where('users.id', $userId)->where('value', -1)->exists();
    }

    public function userRating($userId): int
    {
        $rating = RatingItem::where('user_id', $userId)->where('item_id', $this->id)->first();
        if ($rating != null) {
            return $rating->value;
        } else {
            return 0;
        }
    }
}
