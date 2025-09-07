<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TenantScoped;

class Category extends Model
{
    use HasFactory, SoftDeletes, TenantScoped;

    protected $fillable = [
        'store_id',
        'logo_url',
        'cover_url',
        'title',
        'subtitle',
        'description',
        'sort_order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function vouchers()
    {
        return $this->belongsToMany(Voucher::class, 'voucher_categories');
    }
}
