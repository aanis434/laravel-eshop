@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.purchase.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.purchases.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 form-group">
                    <label class="required" for="name">Entry Date</label>
                    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                    <label class="required" for="name">Supplier</label>
                    <select class="form-control select2" id="supplier_id" name="supplier_id">
                        <option value="">Choose Supplier</option>
                        @foreach($suppliers as $id => $supplier)
                        <option value="{{ $id }}" {{ in_array($id, old('supplier', [])) ? 'selected' : '' }}>{{ $supplier }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label class="required" for="name">Memo No</label>
                    <input type="text" name="memo_no" id="memo" class="form-control" value="" required>
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
                    <tr id="rowId_0">
                        <td>
                            <select class="form-control select2" id="products_0" name="products[]">
                                <option value="">Choose Product</option>
                                @foreach($products as $id => $product)
                                <option value="{{ $id }}" {{ in_array($id, old('product', [])) ? 'selected' : '' }}>{{ $product }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control select2" id="units_0" name="units[]">
                                <option value="">Choose Unit</option>
                                @foreach($units as $id => $unit)
                                <option value="{{ $id }}" {{ in_array($id, old('unit', [])) ? 'selected' : '' }}>{{ $unit }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" id="price_0" min="0" onblur="totalPrice('0')" class="form-control" value="" required>
                        </td>
                        <td>
                            <input type="number" name="qty[]" id="qty_0" min="0" onblur="totalPrice('0')" class="form-control" required>
                        </td>
                        <td>
                            <input type="number" name="total_price[]" id="total_price_0" min="0" class="form-control" readonly>
                        </td>
                        <td class="form-inline">
                            <input type="button" value="+" class="btn btn-sm btn-success addRow" class="form-control" onclick="addRow('0')">
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Total Amount</th>
                        <th>
                            <input type="number" name="total_amount" id="total_amount" min="0" class="form-control" readonly>
                        </th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Paid Amount</th>
                        <th>
                            <input type="number" name="paid_amount" id="paid_amount" min="0" class="form-control" onblur="amountToPay()" required>
                        </th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Amount To Pay</th>
                        <th>
                            <input type="number" name="amount_to_pay" id="amount_to_pay" min="0" class="form-control" readonly>
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
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')

@include('admin.purchases.script')

@endsection