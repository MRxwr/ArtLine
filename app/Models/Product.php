<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TenantScoped;

class Product extends Model
{
    use HasFactory, SoftDeletes, TenantScoped;

    protected $fillable = [
        'store_id',
        'title',
        'details',
        'images',
        'main_image_index',
        'video_url',
        'price',
        'cost',
        'sku',
        'height',
        'width',
        'weight',
        'length',
        'discount_amount',
        'discount_type',
        'active',
    ];

    protected $casts = [
        'images' => 'array',
        'main_image_index' => 'integer',
        'price' => 'decimal:2',
        'cost' => 'decimal:2',
        'height' => 'decimal:2',
        'width' => 'decimal:2',
        'weight' => 'decimal:2',
        'length' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'active' => 'boolean',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class, 'product_option_links');
    }

    public function vouchers(): BelongsToMany
    {
        return $this->belongsToMany(Voucher::class, 'voucher_products');
    }

    public function getMainImageAttribute(): ?string
    {
        if (empty($this->images)) {
            return null;
        }

        $index = $this->main_image_index ?? 0;
        return $this->images[$index] ?? $this->images[0] ?? null;
    }

    public function getFinalPriceAttribute(): float
    {
        if (!$this->discount_amount) {
            return $this->price;
        }

        if ($this->discount_type === 'FIXED') {
            return max(0, $this->price - $this->discount_amount);
        }

        if ($this->discount_type === 'PERCENT') {
            return $this->price * (1 - $this->discount_amount / 100);
        }

        return $this->price;
    }
}
