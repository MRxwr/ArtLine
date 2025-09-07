<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'code',
        'start_date',
        'end_date',
        'usage_limit_total',
        'usage_limit_per_user',
        'discount_amount',
        'discount_type',
        'applies_to',
        'active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'usage_limit_total' => 'integer',
        'usage_limit_per_user' => 'integer',
        'discount_amount' => 'decimal:2',
        'active' => 'boolean',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'voucher_stores');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'voucher_products');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'voucher_categories');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    public function isValidForStore(Store $store): bool
    {
        if ($this->store_id === null) {
            return true; // Global voucher
        }

        if ($this->store_id === $store->id) {
            return true; // Store-specific voucher
        }

        return $this->stores()->where('store_id', $store->id)->exists();
    }
}
