<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperDashboardController extends Controller
{
    public function index()
    {
        // Mock data for now - will be replaced with real data later
        $stats = [
            'total_stores' => 5,
            'active_stores' => 4,
            'total_users' => 25,
            'total_products' => 150,
        ];

        $recent_stores = collect([
            (object) [
                'id' => 1,
                'slug' => 'demo-shop',
                'title' => 'Demo Shop',
                'busy' => false,
                'intl_shipping_method' => 'DHL',
                'created_at' => now()->subDays(5),
            ],
            (object) [
                'id' => 2,
                'slug' => 'alpha-shop',
                'title' => 'Alpha Store',
                'busy' => true,
                'intl_shipping_method' => 'ARAMEX',
                'created_at' => now()->subDays(10),
            ],
        ]);

        return view('admin.superdashboard.index', compact('stats', 'recent_stores'));
    }
}
