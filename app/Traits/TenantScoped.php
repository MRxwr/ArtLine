<?php

namespace App\Traits;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Model;

trait TenantScoped
{
    protected static function bootTenantScoped(): void
    {
        static::addGlobalScope(new TenantScope);
        
        static::creating(function (Model $model) {
            if (session()->has('current_store_id') && !$model->store_id) {
                $model->store_id = session('current_store_id');
            }
        });
    }
}
