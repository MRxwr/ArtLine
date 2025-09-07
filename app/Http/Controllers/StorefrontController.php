<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function home(Request $request, $storeSlug)
    {
        $store = session('current_store');
        $banners = Banner::where('store_id', $store->id)
            ->active()
            ->orderBy('created_at', 'desc')
            ->get();
        
        $categories = Category::where('store_id', $store->id)
            ->where('active', true)
            ->orderBy('sort_order')
            ->get();

        return view('storefront.home', compact('store', 'banners', 'categories'));
    }

    public function category(Request $request, $storeSlug, Category $category)
    {
        $store = session('current_store');
        
        $products = Product::where('store_id', $store->id)
            ->where('active', true)
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
            ->paginate(12);

        return view('storefront.category', compact('store', 'category', 'products'));
    }

    public function product(Request $request, $storeSlug, Product $product)
    {
        $store = session('current_store');
        
        $product->load(['options.values', 'categories']);
        
        return view('storefront.product', compact('store', 'product'));
    }
}
