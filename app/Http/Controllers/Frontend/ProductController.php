<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;

class ProductController extends Controller
{
    public function categoryBasedProduct($categorySlug = '')
    {
        $products = Product::join('product_product_category', 'product_product_category.product_id', '=', 'products.id')
            ->join('product_categories', 'product_product_category.product_category_id', '=', 'product_categories.id')
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->Where('products.status', 'Active')
            ->where('stocks.stock', '>', 0)
            ->where('product_categories.slug', $categorySlug)
            ->orWhere('products.name', 'like', '%' . $categorySlug . '%')
            ->get(['products.*', 'product_categories.name as category_name', 'stocks.stock']);

        // dd($products);
        return view('frontend.products', compact('products'));
    }

    public function productDetails($productSlug = '')
    {
        $product = Product::where('slug', $productSlug)->first();

        return view('frontend.product_details', compact('product'));
    }

    public function categories($slug)
    {
        $categories = ProductCategory::with('childrenRecursive')->where('slug', $slug)->get();
        // dd($categories);
        return view('frontend.categories', compact('categories'));
    }
}
