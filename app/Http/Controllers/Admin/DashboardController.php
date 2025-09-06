<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($storeSlug)
    {
        // Mock store data for now - will be replaced with real data later
        $store = (object) [
            'id' => 1,
            'slug' => $storeSlug,
            'title' => ucfirst(str_replace('-', ' ', $storeSlug)),
            'busy' => $storeSlug === 'alpha-shop', // Demo: alpha-shop is busy
        ];

        $stats = [
            'categories' => 8,
            'products' => 45,
            'orders' => 12,
            'vouchers' => 3,
        ];

        $recent_activities = collect([
            (object) [
                'action' => 'Product Created',
                'entity_type' => 'Product',
                'entity_id' => 123,
                'created_at' => now()->subMinutes(30),
                'actor' => (object) ['name' => 'John Doe'],
            ],
            (object) [
                'action' => 'Category Updated',
                'entity_type' => 'Category',
                'entity_id' => 45,
                'created_at' => now()->subHours(2),
                'actor' => (object) ['name' => 'Jane Smith'],
            ],
        ]);

        return view('admin.dashboard.index', compact('store', 'stats', 'recent_activities'));
    }
}
