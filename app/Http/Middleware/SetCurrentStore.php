<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetCurrentStore
{
    public function handle(Request $request, Closure $next): Response
    {
        // Skip for superadmin routes
        if ($request->routeIs('filament.superadmin.*')) {
            return $next($request);
        }

        // For storefront routes, get store from slug
        if ($request->routeIs('storefront.*')) {
            $storeSlug = $request->route('storeSlug');
            $store = Store::where('slug', $storeSlug)->firstOrFail();
            session(['current_store_id' => $store->id, 'current_store' => $store]);
            return $next($request);
        }

        // For dashboard routes, get store from route parameter
        if ($request->routeIs('filament.admin.*')) {
            $storeId = $request->route('store') ?? $request->get('store');
            
            if ($storeId) {
                $store = Store::findOrFail($storeId);
                
                // Check if user has access to this store
                $user = Auth::user();
                if ($user && !$user->hasAccessToStore($store)) {
                    abort(403, 'Access denied to this store.');
                }
                
                session(['current_store_id' => $store->id, 'current_store' => $store]);
            }
        }

        return $next($request);
    }
}
