<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ErrorPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'error_code',
        'title',
        'description'
    ];

    /**
     * Get the user that owns the stock entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get only the authenticated user's stocks.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
