<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'stock_symbol',
        'stock_name',
        'quantity',
        'purchase_price',
        'current_price',
        'purchase_date',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'purchase_date' => 'date',
        'purchase_price' => 'decimal:2',
        'current_price' => 'decimal:2',
    ];

    /**
     * Get the user that owns the portfolio entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate current value of this stock holding.
     */
    public function getCurrentValue(): float
    {
        return $this->quantity * ($this->current_price ?? $this->purchase_price);
    }

    /**
     * Calculate profit/loss for this holding.
     */
    public function getProfitLoss(): float
    {
        $currentPrice = $this->current_price ?? $this->purchase_price;
        return $this->quantity * ($currentPrice - $this->purchase_price);
    }

    /**
     * Scope to get only the authenticated user's portfolio.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
