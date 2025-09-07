<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $stores = Store::all();

        foreach ($stores as $store) {
            $products = [
                [
                    'title' => 'Smartphone Pro',
                    'details' => 'Latest smartphone with advanced features including high-resolution camera, fast processor, and long-lasting battery.',
                    'images' => ['smartphone1.jpg', 'smartphone2.jpg'],
                    'main_image_index' => 0,
                    'price' => 999.99,
                    'cost' => 700.00,
                    'sku' => 'PHONE-001',
                    'active' => true,
                ],
                [
                    'title' => 'Wireless Headphones',
                    'details' => 'Premium wireless headphones with noise cancellation and superior sound quality.',
                    'images' => ['headphones1.jpg', 'headphones2.jpg'],
                    'main_image_index' => 0,
                    'price' => 299.99,
                    'cost' => 150.00,
                    'sku' => 'AUDIO-001',
                    'discount_amount' => 50.00,
                    'discount_type' => 'FIXED',
                    'active' => true,
                ],
                [
                    'title' => 'Laptop Ultra',
                    'details' => 'High-performance laptop perfect for work and gaming with latest processor and graphics.',
                    'images' => ['laptop1.jpg', 'laptop2.jpg', 'laptop3.jpg'],
                    'main_image_index' => 0,
                    'price' => 1599.99,
                    'cost' => 1200.00,
                    'sku' => 'LAPTOP-001',
                    'active' => true,
                ],
            ];

            foreach ($products as $product) {
                Product::create(array_merge($product, ['store_id' => $store->id]));
            }
        }
    }
}
