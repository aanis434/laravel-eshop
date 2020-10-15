@extends('layouts.admin')
@section('content')

<form method="get">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-md-3 form-group">
            <label class="required" for="name">Product</label>
            <select class="form-control select2" id="product_id" name="product_id">
                <option value="">Choose Product</option>
                @foreach($products as $id => $name)
                <option value="{{ $id }}" {{ $id==$product_id ? 'Selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label class="required" for="name">From Date</label>
            <input type="date" name="from_date" id="from_date" value="{{ $from_date ?? date('Y-m-d') }}" class="form-control">
        </div>
        <div class="col-md-3 form-group">
            <label class="required" for="name">To Date</label>
            <input type="date" name="to_date" id="to_date" value="{{ $to_date ?? date('Y-m-d') }}" class="form-control">
        </div>
        <div class="col-md-2">
            <label for="">&nbsp;</label>
            <input type="submit" class="form-control" value="Submit">
        </div>
        @if (session('status'))
        <div style="margin-top: 10px;" class="col-lg-12 alert alert-success">
            {{ session('status') }}
        </div>
        @endif


    </div>
</form>
<div class="card">
    <div class="card-header">
        Reports
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Purchase">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            #SL
                        </th>
                        <th>
                            Product Name
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Opening Stock
                        </th>
                        <th>
                            Purchase Qty
                        </th>
                        <th>
                            Purchase Return Qty
                        </th>
                        <th>
                            Sale Qty
                        </th>
                        <th>
                            Sale Return Qty
                        </th>
                        <th>
                            Closing Stock
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr data-entry-id="{{ $item->id }}">
                        <td>
                        </td>
                        <td>
                            {{ $key+1 }}
                        </td>
                        <td>
                            {{ $item->product_name ?? '' }}
                        </td>
                        <td>
                            {{ $item->date ?? '' }}
                        </td>
                        <td>
                            {{ $item->opening_stock ?? '' }}
                        </td>
                        <td>
                            {{ $item->purchase_qty ?? '' }}
                        </td>
                        <td>
                            {{ $item->purchase_return_qty ?? '' }}
                        </td>
                        <td>
                            {{ $item->sale_qty ?? '' }}
                        </td>
                        <td>
                            {{ $item->sale_return_qty ?? '' }}
                        </td>
                        <td>
                            {{ (($item->purchase_qty - $item->purchase_return_qty - $item->sale_qty) + $item->sale_return_qty)  }}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [
                [1, 'desc']
            ],
            pageLength: 100,
        });
        let table = $('.datatable-Purchase:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        $('.datatable thead').on('input', '.search', function() {
            let strict = $(this).attr('strict') || false
            let value = strict && this.value ? "^" + this.value + "$" : this.value
            table
                .column($(this).parent().index())
                .search(value, strict)
                .draw()
        });
    })
</script>
@endsection