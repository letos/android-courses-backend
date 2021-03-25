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

    public function hasFavoriteUser($userId): bool
    {
        return $this->users()->where('users.id', $userId)->exists();
    }
}
