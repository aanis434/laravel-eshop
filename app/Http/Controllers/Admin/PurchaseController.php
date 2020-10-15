<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Purchase;
use App\PurchaseDetail;
use App\Product;
use App\Supplier;
use App\Unit;
use App\Http\Traits\StockTrait;
use Illuminate\Support\Facades\Auth;
use Gate;

class PurchaseController extends Controller
{
    use StockTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('purchase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchases = Purchase::all();
        return view('admin.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('purchase_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('name', 'id');
        $suppliers = Supplier::all()->pluck('name', 'id');
        $units = Unit::all()->pluck('name', 'id');
        return view('admin.purchases.create', compact('suppliers', 'products', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        $inputs = $request->all();

        $purchaseInputs = $request->only(['date', 'memo_no', 'supplier_id', 'paid_amount']);
        $purchaseInputs['created_by'] = Auth::id();
        $purchase = Purchase::create($purchaseInputs);

        $total_price = 0;
        $paid_amount = $inputs['paid_amount'];

        for ($i = 0; $i < count($inputs['products']); $i++) {

            $purchaseDetailsInputs = [];
            $purchaseDetailsInputs['purchase_id'] = $purchase->id;
            $purchaseDetailsInputs['product_id'] = $product_id = $inputs['products'][$i];
            $purchaseDetailsInputs['price'] = $inputs['price'][$i];
            $purchaseDetailsInputs['qty'] = $qty = $inputs['qty'][$i];
            $purchaseDetailsInputs['total_price'] = $sub_total = $inputs['price'][$i] * $inputs['qty'][$i];
            $total_price += $sub_total;
            $purchaseDetailsInputs['unit_id'] = $inputs['units'][$i];

            $PurchaseDetails = PurchaseDetail::create($purchaseDetailsInputs);
            $this->stockIn($product_id, $qty, $flag = "Purchase");
            $this->stock_report($product_id, $qty, $type = 'Purchase', $inputs['date']);
        }

        $purchase['total_price'] = $total_price;
        $purchase['total_amount'] = $total_price;
        if ($total_price != $paid_amount && $total_price > $paid_amount) {
            $purchase['due_amount'] = $total_price - $paid_amount;
            $purchase['amt_to_pay'] = $total_price - $paid_amount;
        } else {
            $purchase['advance_amount'] = $paid_amount - $total_price;
        }

        $purchase->save();

        return redirect('admin/purchases')->with('status', 'Your Purchases Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        abort_if(Gate::denies('purchase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        abort_if(Gate::denies('purchase_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $products = Product::all()->pluck('name', 'id');
        $suppliers = Supplier::all()->pluck('name', 'id');
        $units = Unit::all()->pluck('name', 'id');
        return view('admin.purchases.edit', compact('suppliers', 'products', 'units', 'purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequest $request, $id)
    {
        $purchase = Purchase::find($id);
        $oldPurchaseItem = $purchase->purchaseDetails;
        $oldEntryDate = $purchase->date;

        # update first old stock and stock report information
        foreach ($oldPurchaseItem as $key => $item) {
            $this->stockOut($item['product_id'], $item['qty'], $flag = "delete purchase");
            $this->stock_report($item['product_id'], $item['qty'], $type = 'delete purchase', $oldEntryDate);
        };

        # remove all old purchase items
        PurchaseDetail::where('purchase_id', $id)->delete();

        $inputs = $request->all();
        $total_price = 0;
        $paid_amount = $inputs['paid_amount'];

        for ($i = 0; $i < count($inputs['products']); $i++) {

            $purchaseDetailsInputs = [];
            $purchaseDetailsInputs['purchase_id'] = $id;
            $purchaseDetailsInputs['product_id'] = $product_id = $inputs['products'][$i];
            $purchaseDetailsInputs['price'] = $inputs['price'][$i];
            $purchaseDetailsInputs['qty'] = $qty = $inputs['qty'][$i];
            $purchaseDetailsInputs['total_price'] = $sub_total = $inputs['price'][$i] * $inputs['qty'][$i];
            $total_price += $sub_total;
            $purchaseDetailsInputs['unit_id'] = $inputs['units'][$i];

            $PurchaseDetails = PurchaseDetail::create($purchaseDetailsInputs);
            $this->stockIn($product_id, $qty, $flag = "stock in");
            $this->stock_report($product_id, $qty, $type = 'purchase', $inputs['date']);
        }

        $purchase->total_price = $total_price;
        $purchase->total_amount = $total_price;
        $purchase->updated_by = Auth::id();

        if ($total_price != $paid_amount && $total_price > $paid_amount) {
            $purchase->due_amount = $total_price - $paid_amount;
            $purchase->amt_to_pay = $total_price - $paid_amount;
        } else {
            $purchase->advance_amount = $paid_amount - $total_price;
        }

        $purchase->save();

        return redirect('admin/purchases')->with('status', 'Your Purchase Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        abort_if(Gate::denies('purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $oldPurchaseItem = $purchase->purchaseDetails;
        $oldEntryDate = $purchase->date;

        # update first old stock and stock report information
        foreach ($oldPurchaseItem as $key => $item) {
            $this->stockOut($item['product_id'], $item['qty'], $flag = "delete purchase");
            $this->stock_report($item['product_id'], $item['qty'], $type = 'delete purchase', $oldEntryDate);
        };

        $purchase->delete();

        return back()->with('status', 'Your Purchases deleted Successfully!');
    }

    public function invoicePrint($id)
    {
        $purchase = Purchase::find($id);
        return view('admin.purchases.invoice', compact('purchase'));
    }
}
