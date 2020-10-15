@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="#">
            Orders
        </a>
    </div>
    @if (session('status'))
    <div style="margin-top: 10px;" class="col-lg-12 alert alert-success">
        {{ session('status') }}
    </div>
    @endif
</div>
<div class="card">
    <div class="card-header">
        Order List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Order">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>
                            #SL
                        </th>
                        <th>
                            Order Date
                        </th>
                        <th>
                            Order No
                        </th>
                        <th>
                            Total Amount
                        </th>
                        <th>
                            Payment Status
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Return Status
                        </th>
                        <th>
                            Action
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $order)
                    <tr data-entry-id="{{ $order->id }}">
                        <td>
                        </td>
                        <td>
                            {{ $key+1 }}
                        </td>
                        <td>
                            {{ $order->date ?? '' }}
                        </td>
                        <td>
                            {{ $order->order_no ?? '' }}
                        </td>
                        <td>
                            {{ $order->total_amount ?? '' }}
                        </td>
                        <td>
                            {{ $order->payment_status ?? '' }}
                        </td>
                        <td>
                            {{ $order->status ?? '' }}
                        </td>
                        <td>
                            {{ $order->return_status ?? '' }}
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary mb-2" href="{{ route('admin.orders.show', $order->id) }}">
                                {{ trans('global.view') }}
                            </a>

                            <input type="hidden" name="order_id" id="order_id_{{$key}}" value="{{ $order->id }}">
                            @if($order->status=='Pending')
                            <div>
                                <label class="c-switch c-switch-label c-switch-primary">
                                    <input class="c-switch-input" name="status" onclick="updateStatus('{{$key}}')" id="status_id_{{$key}}" type="checkbox" unchecked="true"><span class="c-switch-slider" data-checked="✓" data-unchecked="✕" title="Click to Approved"></span>
                                </label>
                            </div>
                            @elseif($order->status=='Returned')
                            <select class="form-control select2 select2-hidden-accessible" name="status" id="status_id_{{$key}}" onchange="updateReturnStatus('{{$key}}')">
                                <option value="">Update Status</option>
                                <option value="Pending" {{ $order->return_status=='Pending' ? 'disabled' : ''}}>Pending</option>
                                <option value="Approved" {{ $order->return_status=='Approved' ? 'disabled' : ''}}>Approved</option>
                                <option value="Canceled" {{ $order->return_status=='Canceled' ? 'disabled' : ''}}>Canceled</option>
                            </select>
                            @elseif($order->status=='Canceled')
                            {{ '' }}
                            @else
                            <select class="form-control select2 select2-hidden-accessible" name="status" id="status_id_{{$key}}" onchange="updateStatus('{{$key}}')">
                                <option value="">Update Status</option>
                                <option value="Pending" {{ $order->status=='Pending' ? 'disabled' : ''}}>Pending</option>
                                <option value="Approved" {{ $order->status=='Approved' ? 'disabled' : ''}}>Approved</option>
                                <option value="Processing" {{ $order->status=='Processing' ? 'disabled' : ''}}>Processing</option>
                                <option value="On Shipping" {{ $order->status=='On Shipping' ? 'disabled' : ''}}>On Shipping</option>
                                <option value="Shipped" {{ $order->status=='Shipped' ? 'disabled' : ''}}>Shipped</option>
                                <option value="Canceled" {{ $order->status=='Canceled' ? 'disabled' : ''}}>Canceled</option>
                                <option value="Returned" {{ $order->status=='Returned' ? 'disabled' : ''}}>Returned</option>
                                <option value="Completed" {{ $order->status=='Completed' ? 'disabled' : ''}}>Completed</option>
                            </select>
                            @endif
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
        let table = $('.datatable-Order:not(.ajaxTable)').DataTable({
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

    function updateStatus(key) {
        let status = $(`#status_id_${key}`).val();
        let id = $(`#order_id_${key}`).val();
        let input = $(`#status_id_${key}`).attr('type');

        if (status == '') {
            return;
        }

        let url = "{{ route('admin.orders.update',['id']) }}".replace('id', id);

        if (confirm("Are you sure you want to do this?")) {
            $.ajax({
                    headers: {
                        'x-csrf-token': _token
                    },
                    method: 'POST',
                    url: url,
                    data: {
                        status: status,
                        _method: 'PUT'
                    }
                })
                .done(function() {
                    location.reload()
                })
        } else {
            if (input)
                location.reload();
        }
    }

    function updateReturnStatus(key) {
        let status = $(`#status_id_${key}`).val();
        let id = $(`#order_id_${key}`).val();

        if (status == '') {
            return;
        }

        let url = "{{ route('admin.orders.update-return-status',['id']) }}".replace('id', id);

        if (confirm("Are you sure you want to do this?")) {
            $.ajax({
                    headers: {
                        'x-csrf-token': _token
                    },
                    method: 'POST',
                    url: url,
                    data: {
                        status: status,
                        _method: 'POST'
                    }
                })
                .done(function() {
                    location.reload()
                })
        }
    }
</script>
@endsection