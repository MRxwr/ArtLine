<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\TenantScoped;

class ProductOption extends Model
{
    use HasFactory, TenantScoped;

    protected $fillable = [
        'store_id',
        'name',
        'input_type',
        'required',
        'text_price_delta',
    ];

    protected $casts = [
        'required' => 'boolean',
        'text_price_delta' => 'decimal:2',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function values(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_option_links');
    }
}
