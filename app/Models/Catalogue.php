<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catalogue extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(Bookmark::class);
    }
}