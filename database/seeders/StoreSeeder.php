<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $stores = [
            [
                'slug' => 'demo-store',
                'title' => 'Demo Store',
                'busy' => false,
                'intl_shipping_method' => 'DHL',
            ],
            [
                'slug' => 'artisan-crafts',
                'title' => 'Artisan Crafts',
                'busy' => false,
                'intl_shipping_method' => 'ARAMEX',
            ],
            [
                'slug' => 'tech-gadgets',
                'title' => 'Tech Gadgets Store',
                'busy' => false,
                'intl_shipping_method' => 'COMPANY',
            ],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }
    }
}
