@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.purchase.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.purchases.update", [$purchase->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-4 form-group">
                    <label class="required" for="name">Entry Date</label>
                    <input type="date" name="date" id="date" value="{{ $purchase->date }}" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                    <label class="required" for="name">Supplier</label>
                    <select class="form-control select2" id="supplier_id" name="supplier_id">
                        <option value="">Choose Supplier</option>
                        @foreach($suppliers as $id => $supplier)
                        <option value="{{ $id }}" {{ $id==$purchase->supplier_id ? 'selected' : '' }}>{{ $supplier }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label class="required" for="name">Memo No</label>
                    <input type="text" name="memo_no" id="memo" class="form-control" value="{{ $purchase->memo_no }}" required>
                </div>
            </div>
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                </thead>
                <tbody id="purchaseTable">
                    @foreach($purchase->purchaseDetails as $key=>$value)
                    <tr id="rowId_{{ $key }}">
                        <td>
                            <select class="form-control select2" id="products_{{ $key }}" name="products[]">
                                <option value="">Choose Product</option>
                                @foreach($products as $id => $product)
                                <option value="{{ $id }}" {{ $id==$value['product_id'] ? 'selected' : '' }}>{{ $product }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control select2" id="units_{{ $key }}" name="units[]">
                                <option value="">Choose Unit</option>
                                @foreach($units as $id => $unit)
                                <option value="{{ $id }}" {{ $id==$value['unit_id'] ? 'selected' : '' }}>{{ $unit }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" id="price_{{ $key }}" min="0" onblur="totalPrice('{{ $key }}')" class="form-control" value="{{ $value['price'] }}" required>
                        </td>
                        <td>
                            <input type="number" name="qty[]" id="qty_{{ $key }}" min="0" onblur="totalPrice('{{ $key }}')" value="{{ $value['qty'] }}" class="form-control" required>
                        </td>
                        <td>
                            <input type="number" name="total_price[]" id="total_price_{{ $key }}" min="0" class="form-control" value="{{ $value['total_price'] }}" readonly>
                        </td>
                        <td class="form-inline">
                            <input type="button" value="+" class="btn btn-sm btn-success addRow" class="form-control" onclick="addRow('{{ $key }}')">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Total Amount</th>
                        <th>
                            <input type="number" name="total_amount" id="total_amount" min="0" class="form-control" value="{{ $purchase->total_price }}" readonly>
                        </th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Paid Amount</th>
                        <th>
                            <input type="number" name="paid_amount" id="paid_amount" min="0" class="form-control" value="{{ $purchase->paid_amount }}" onblur="amountToPay()" required>
                        </th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Amount To Pay</th>
                        <th>
                            <input type="number" name="amount_to_pay" id="amount_to_pay" min="0" class="form-control" value="{{ $purchase->amt_to_pay }}" readonly>
                        </th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
            <div class="form-group text-center">
                <a class="btn btn-info" href="{{ route('admin.purchases.index') }}">
                    Back
                </a>
                <button class="btn btn-success" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')

@include('admin.purchases.script')

@endsection