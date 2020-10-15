<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\StockReport;

class ReportsController extends Controller
{
    public function index()
    {
        $from_date = request()->query('from_date');
        $to_date = request()->query('to_date');
        $product_id = '';

        $products = Product::all()->pluck('name', 'id');
        $data = StockReport::all();

        if (!empty(request()->query('product_id'))) {
            $product_id = request()->query('product_id');
            $data = StockReport::where('product_id', $product_id)->whereBetween('date', [$from_date, $to_date])->get();
        }

        return view('admin.reports.index', compact('data', 'from_date', 'to_date', 'product_id', 'products'));
    }
}
