<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Traits\StockTrait;
use Carbon\Carbon;
use Gate;

class OrderController extends Controller
{
    use StockTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $status = $_GET['status'];
        $orders = Order::where('status', $status)->get();

        if ($status == 'Shipment')
            $orders = Order::whereIn('status', ['On Shipping', 'Shipped'])->get();

        // if ($status == 'Canceled')
        //     $orders = Order::whereIn('status', ['Canceled', 'Returned'])->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $currentDate = Carbon::now()->timezone('Asia/Dhaka');
        $currentDate = $currentDate->toDateString();

        $status = $request->status;
        if ($status == 'on')
            $status = "Approved";

        if ($status == 'Returned')
            $order['return_status'] = 'Pending';

        if ($status == 'Shipped' || $status == 'Completed')
            $order['payment_status'] = 'Paid';

        $order['status'] = $status;
        $order->save();

        $order_detials = $order->orderDetails;
        if ($status == 'Canceled') {

            foreach ($order_detials as $item) {
                $product_id = $item->product_id;
                $qty = $item->qty;

                $this->stockIn($product_id, $qty, $flag = "Sale Canceled");
                $this->stock_report($product_id, $qty, $type = 'Sale', $currentDate);
            }
        }

        $request->session()->flash('status', 'Order ' . $status . ' successful!');

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function update_return_status(Request $request, $id)
    {
        $currentDate = Carbon::now()->timezone('Asia/Dhaka');
        $currentDate = $currentDate->toDateString();

        $order = Order::find($id);
        $status = $request->status;

        if ($status == 'Canceled')
            $order['status'] = 'Completed';

        $order['return_status'] = $status;
        $order->save();

        $order_detials = $order->orderDetails;
        if ($status == 'Approved') {

            foreach ($order_detials as $item) {
                $product_id = $item->product_id;
                $qty = $item->qty;

                $this->stockIn($product_id, $qty, $flag = "Sale Returned");
                $this->stock_report($product_id, $qty, $type = 'Sale Returned', $currentDate);
            }
        }

        $request->session()->flash('status', 'Order ' . $status . ' successful!');

        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invoicePrint($id)
    {
        $order = Order::find($id);
        return view('admin.orders.invoice', compact('order'));
    }
}
