<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $stores = Store::all();

        foreach ($stores as $store) {
            $categories = [
                [
                    'title' => 'Electronics',
                    'subtitle' => 'Latest gadgets and devices',
                    'description' => 'Discover the latest electronic devices and gadgets.',
                    'sort_order' => 1,
                    'active' => true,
                ],
                [
                    'title' => 'Fashion',
                    'subtitle' => 'Trendy clothing and accessories',
                    'description' => 'Stay fashionable with our latest clothing collection.',
                    'sort_order' => 2,
                    'active' => true,
                ],
                [
                    'title' => 'Home & Garden',
                    'subtitle' => 'Everything for your home',
                    'description' => 'Transform your home with our collection.',
                    'sort_order' => 3,
                    'active' => true,
                ],
            ];

            foreach ($categories as $category) {
                Category::create(array_merge($category, ['store_id' => $store->id]));
            }
        }
    }
}
