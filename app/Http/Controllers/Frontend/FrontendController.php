<?php

namespace App\Http\Controllers\Frontend;

use App\FaqQuestion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;
use App\Order;
use App\Slider;
use App\Http\Requests\TrackOrderRequest;

use App\Http\Controllers\Traits\CategoriesTrait;

class FrontendController extends Controller
{
    use CategoriesTrait;

    public function index()
    {
        $sliders = Slider::orderBy('nav_serial', 'asc')->get();

        $category = ProductCategory::getParentCategory()->pluck('id');
        $subcategory = ProductCategory::getSubCategory($category)->pluck('id');

        $parent_categories = ProductCategory::
                with(['products', 'childrenCategory.products'])
            ->where('parent_category_id', NULL)
            ->whereHas('products', function ($query) use ($category, $subcategory) {
                    $query->where('products.status', 'Active')
                        ->whereHas('stock', function ($query) {
                            $query->where('stock', '>', 0);
                        })->inRandomOrder()->limit(12);
                })->get();

        $parent_categories = Product::join('product_product_category', 'product_product_category.product_id', '=', 'products.id')
            ->whereHas('stock', function ($query) {
                        $query->where('stock', '>', 0);
                    })->whereIn('product_category_id', $parent_categories)
                    ->whereIn('product_category_id', $subcategory)
                        ->inRandomOrder()
                        ->limit(12)
                        ->get();


        $products = Product::join('product_product_category', 'product_product_category.product_id', '=', 'products.id')
            ->join('product_categories', 'product_product_category.product_category_id', '=', 'product_categories.id')
            ->join('stocks', 'stocks.product_id', '=', 'products.id')
            ->where('products.status', 'Active')
            ->where('stocks.stock', '>', 0)
            ->where('product_categories.parent_category_id', NULL)
            ->get('products.*', 'product_categories.name as category_name');

//dd($parent_categories);

        return view('frontend.index', compact('parent_categories', 'sliders'));
    }

    public function trackOrder()
    {
        return view('frontend.track_order');
    }

    public function trackOrderDetails(TrackOrderRequest $request)
    {
        $order = Order::where('order_no', $request->order_no)->first();
        return view('frontend.track_order_details', compact('order'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function faq()
    {
        $faqs = FaqQuestion::all()->groupBy('category_id');
        return view('frontend.faq', compact('faqs'));
    }

    public function search(Request $request)
    {
        $products = Product::join('product_product_category', 'product_product_category.product_id', '=', 'products.id')
            ->join('product_categories', 'product_product_category.product_category_id', '=', 'product_categories.id')
            ->Where('products.name', 'like', '%' . $request->name . '%')
            ->Where('products.status', 'Active')
            ->orWhere('product_categories.name', 'like', '%' . $request->name . '%')
            ->get('products.*');

        return view('frontend.search_products', compact('products'));
    }
}
